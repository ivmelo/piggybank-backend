<?php

namespace App\Http\Controllers;

use App\Models\Experiment;
use App\Models\Participant;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use App\Models\Response;

class ParticipantController extends Controller
{
    private $experimentVersions = [
        'm1' => 'M1',
        'm2' => 'M2',
	    'taigan' => 'TAIGAN',
    ];

    private $validationRules = [
        'code' => 'required|string|unique:participants|min:6|max:8',
        'birthdate' => 'required|string|size:8',
        'version' => 'required|in:m1,m2,taigan',
        'host_id' => 'required|exists:users,id',
        'notes' => 'nullable|min:2|max:2000'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($experiment_id)
    {
        if (! Gate::allows('update-experiment')) {
            abort(403);
        }

        $experiment = Experiment::findOrFail($experiment_id);
        $hosts = User::all()->pluck('name', 'id');

        return view('participants.create', [
            'experiment' => $experiment,
            'versions' => $this->experimentVersions,
            'hosts' => $hosts
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $experiment_id)
    {
        if (! Gate::allows('update-experiment')) {
            abort(403);
        }

        $experiment = Experiment::with('fields')->findOrFail($experiment_id);

        $validated = $request->validate($this->validationRules);

        $host = User::findOrFail($validated['host_id']);
        
        $participant = new Participant($validated);
        $participant->generateToken();
        $participant->host()->associate($host);
        $experiment->participants()->save($participant);

        session()->flash('success', 'Your participant has been added.');

        return redirect()->route('experiments.show', $experiment->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function show($participant_id)
    {
        $participant = Participant::with('experiment')->findOrFail($participant_id);

        return view('participants.show', [
            'participant' => $participant,
            'experiment' => $participant->experiment
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function edit($participant_id)
    {
        $participant = Participant::with('experiment')->findOrFail($participant_id);
        $hosts = User::all()->pluck('name', 'id');

        return view('participants.edit', [
            'participant' => $participant,
            'experiment' => $participant->experiment,
            'versions' => $this->experimentVersions,
            'hosts' => $hosts
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $participant_id)
    {
        $participant = Participant::findOrFail($participant_id);

        $this->validationRules['code'] = 'required|string|unique:participants,id,' . $participant->id . '|min:6|max:8';
        $validated = $request->validate($this->validationRules);
        $participant->fill($validated);

        $host = User::findOrFail($validated['host_id']);
        $participant->host()->associate($host);
        $participant->save();

        session()->flash('success', 'Your participant has been updated.');
        return redirect()->route('participants.show', $participant->id);
    }

    /**
     * Remove the specified participant, but only if they haven't started the experiment.
     *
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function destroy($participant_id)
    {
        $participant = Participant::with('experiment')->findOrFail($participant_id);
        $experiment = $participant->experiment;
        
        if ($participant->responses->count() === 0) {
            $participant->delete();
            session()->flash('success', 'Your participant has been added.');
            return redirect()->route('experiments.show', $experiment->id);
        }

        session()->flash('success', 'This participant cannot be deleted.');
        return redirect()->back();
    }

    /**
     * Authenticates the participant and returns a token to be used in subsequent requests from construct.
     * Also returns the name of the last field submitted by the user.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticateExperiment(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|min:7|max:8',
            'birthdate' => 'required|string|size:8',
        ]);

        $participant = Participant::where('code', $validated['code'])
            ->where('birthdate', $validated['birthdate'])
            ->firstOrFail();

        $last_response = null;

        if ($participant->responses->count() > 0) {
            $lastResponse = Response::with('field')
                ->where('participant_id', $participant->id)
                ->orderBy('created_at', 'desc')
                ->first();

            $last_response = $lastResponse->field->name;
        }

        return response([
            'status' => 'success',
            'token' => $participant->token,
            'version' => $participant->version,
            'last_response' => $last_response,
            'total_responses' => $participant->responses->count()
        ]);
    }
}
