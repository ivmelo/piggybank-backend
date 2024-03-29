<?php

namespace App\Http\Controllers;

use App\Models\Experiment;
use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class FieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($experiment_id)
    {
        return view('fields.index', [
            'experiment' => Experiment::findOrFail($experiment_id),
            'types' => [
                'int' => 'Integer',
                'string' => 'String',
                'bool' => 'Boolean'
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $experiment_id)
    {
        if (! Gate::allows('update-field')) {
            abort(403);
        }

        $experiment = Experiment::with('fields')->findOrFail($experiment_id);

        $validated = $request->validate([
            'name' => 'required|alpha_dash|min:2|max:255',
            'type' => 'required|in:int,string,bool'
        ]);
        
        $field = new Field($validated);
        $field->order = $experiment->fields->count(); // Order starts at zero.

        $experiment->fields()->save($field);

        session()->flash('success', 'Your field has been saved.');

        return redirect()->route('experiments.fields.index', $experiment->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function show(Field $field)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function edit(Field $field)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Field $field)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Field  $field
     * @return \Illuminate\Http\Response
     */
    public function destroy($experiment_id, $field_id)
    {
        if (! Gate::allows('update-field')) {
            abort(403);
        }

        $field = Field::findOrFail($field_id);
        $field->delete();
        
        $experiment = Experiment::findOrFail($experiment_id);
        
        $order = 0;

        foreach($experiment->fields as $field) {
            $field->order = $order++;
            $field->save();
        }

        session()->flash('success', 'Your field has been deleted.');
        return redirect()->route('experiments.fields.index', $experiment->id);
    }

    /**
     * Sort the received fields.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sort(Request $request, $experiment_id) {
        if (! Gate::allows('update-experiment')) {
            abort(403);
        }

        $field_ids = $request->get('field_ids');

        $experiment = Experiment::findOrFail($experiment_id);

        $fields = Field::whereIn('id', $field_ids)->orderByRaw('FIELD(id, ' . implode(", " , $field_ids) . ')')->get();

        $order = 0;
        foreach ($fields as $field) {
            $field->order = $order++;
            $field->save();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'The order of your fields has been updated.'
        ]);
    }
}
