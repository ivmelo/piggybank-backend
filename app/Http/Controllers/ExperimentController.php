<?php

namespace App\Http\Controllers;

use App\Models\Experiment;
use App\Models\Response;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ExperimentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('experiments.index', [
            'experiments' => Experiment::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('update-experiment')) {
            abort(403);
        }

        return view('experiments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! Gate::allows('update-experiment')) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|min:2|max:255',
        ]);

        $experiment = new Experiment($validated);
        $experiment->save();

        session()->flash('success', 'Your experiment has been saved.');
        return redirect()->route('experiments.fields.index', $experiment->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Experiment  $experiment
     * @return \Illuminate\Http\Response
     */
    public function show(Experiment $experiment)
    {
        return view('experiments.show', [
            'experiment' => $experiment
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Experiment  $experiment
     * @return \Illuminate\Http\Response
     */
    public function edit(Experiment $experiment)
    {
        if (! Gate::allows('update-experiment')) {
            abort(403);
        }

        return view('experiments.edit', [
            'experiment' => $experiment,
            'types' => [
                'int' => 'Integer',
                'string' => 'String',
                'bool' => 'Boolean'
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Experiment  $experiment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Experiment $experiment)
    {
        if (! Gate::allows('update-experiment')) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|min:2|max:255',
        ]);

        $experiment->name = $validated['name'];
        $experiment->save();

        session()->flash('success', 'Your experiment has been saved.');
        return redirect()->route('experiments.edit', $experiment->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Experiment  $experiment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Experiment $experiment)
    {
        if (! Gate::allows('update-experiment')) {
            abort(403);
        }
    }

    /**
     * Shows the view for downloading the CSV file with participant responses.
     *
     * @param  \App\Models\Experiment  $experiment
     * @return \Illuminate\Http\Response
     */
    public function downloadCsv($experiment_id)
    {
        return view('experiments.download-csv', [
            'experiment' => Experiment::findOrFail($experiment_id)
        ]);
    }

    /**
     * Returns the CSV with responses.
     *
     * @param  \App\Models\Experiment  $experiment
     * @return \Illuminate\Http\Response
     */
    public function downloadResponsesCsv($experiment_id)
    {
        // Fetch experiment fields.
        $experiment = Experiment::with('fields', 'participants')->findOrFail($experiment_id);
        $fields = $experiment->fields;
        $participants = $experiment->participants;

        $file_name = 'experiment-responses-' . Carbon::now()->format('Ymd-His') . '.csv';

        // Request headers for downloading CSV.
        $headers = [
            'Content-type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename=' . $file_name,
            'Pragma'              => 'no-cache',
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Expires'             => '0'
        ];

        // Creates CSV file structure and add data.
        $csvStream = function() use($participants, $fields) {
            $file = fopen('php://output', 'w');

            fputcsv($file, ['code', 'birthdate', 'version', 'name', ...$fields->pluck('name')->toArray()]);

            // Go through each participant...
            foreach ($participants as $participant) {
                // Add default participant data to csv.
                $row = [
                    $participant->code,
                    $participant->birthdate,
                    $participant->version,
                    $participant->host->name
                ];

                // Now add the custom fields.
                foreach ($fields as $field) {
                    $response = Response::where('participant_id', $participant->id)
                        ->where('field_id', $field->id)
                        ->first();

                    $row[] = $response ? $response->value : null;
                }
                fputcsv($file, $row);
            }
            fclose($file);
        };

        return response()->stream($csvStream, 200, $headers);
    }

    /**
     * Returns the CSV with responses.
     *
     * @param  \App\Models\Experiment  $experiment
     * @return \Illuminate\Http\Response
     */
    public function downloadFieldsCsv($experiment_id)
    {
        // Fetch experiment fields.
        $experiment = Experiment::with('fields')->findOrFail($experiment_id);
        $fields = $experiment->fields;

        $file_name = 'experiment-fields-' . Carbon::now()->format('Ymd-His') . '.csv';

        // Request headers for downloading CSV.
        $headers = [
            'Content-type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename=' . $file_name,
            'Pragma'              => 'no-cache',
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Expires'             => '0'
        ];

        // Column headers for CSV file.
        $csvHeaders = [
            'field_name',
            'field_type'
        ];

        // Creates CSV file structure and add data.
        $csvStream = function() use($fields, $csvHeaders) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $csvHeaders);

            foreach ($fields as $field) {
                $row = [$field->name, $field->type];
                fputcsv($file, $row);
            }
            fclose($file);
        };

        return response()->stream($csvStream, 200, $headers);
    }
}
