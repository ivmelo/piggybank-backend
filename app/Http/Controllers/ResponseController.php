<?php

namespace App\Http\Controllers;

use App\Models\Response;
use Illuminate\Http\Request;
use App\Models\Participant;
use App\Models\Field;

class ResponseController extends Controller
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
        $validated = $request->validate([
            'token' => 'required|string',
        ]);

        $participant = Participant::where('token', $validated['token'])->firstOrFail();

        $responses = [];

        foreach ($request->except('token') as $key => $value) {
            // Fetch field.
            $field = Field::where('name', $key)
                ->where('experiment_id', $participant->experiment->id)
                ->firstOrFail();

            // Validate field.
            $validated = $request->validate([
                $key => $field->type . '|required'
            ]);

            // Create or update existing response.
            $response = Response::where('participant_id', $participant->id)
                ->where('field_id', $field->id)
                ->firstOrNew();

            // Fill out response.
            $response->value = $value;
            $response->participant()->associate($participant);
            $response->field()->associate($field);

            $responses[] = $response;
        }

        foreach($responses as $response) {
            $response->save();
        }

        return([
            'status' => 'success',
            'message' => 'Response saved!'
        ]);      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function show(Response $response)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function edit(Response $response)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Response $response)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function destroy(Response $response)
    {
        //
    }
}
