<?php

namespace App\Http\Controllers;

use App\Models\Experiment;
use App\Models\Participant;
use Illuminate\Http\Request;
use App\Models\User;

class ParticipantController extends Controller
{
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
        $experiment = Experiment::findOrFail($experiment_id);
        $hosts = User::all()->pluck('name', 'id');

        return view('participants.create', [
            'experiment' => $experiment,
            'versions' => ['m1' => 'M1', 'm2' => 'M2'],
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
        $experiment = Experiment::with('fields')->findOrFail($experiment_id);

        $validated = $request->validate([
            'code' => 'required|string|unique:participants|min:7|max:8',
            'birthdate' => 'required|string|size:8',
            'version' => 'required|in:m1,m2',
            'host_id' => 'required|exists:users,id'
        ]);

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
    public function edit(Participant $participant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Participant $participant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Participant $participant)
    {
        //
    }
}
