<?php

namespace App\Http\Controllers;

use App\Models\Experiment;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Experiment  $experiment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Experiment $experiment)
    {
        //
    }
}
