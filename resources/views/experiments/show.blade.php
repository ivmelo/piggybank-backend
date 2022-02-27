<x-layouts.app>
    <div class="container">

        <h1>{{ $experiment->name }}</h1>

        <a href="{{ route('experiments.edit', $experiment->id) }}" class="btn btn-primary">Edit Experiment</a>

        <hr>

        <h2>Participants</h2>

        <hr>

        <a href="{{ route('participants.create', $experiment->id) }}" class="btn btn-primary">Add Participant</a>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Code</th>
                    <th scope="col">Birthdate</th>
                    <th scope="col">Version</th>
                    <th scope="col">Created By</th>
                    <th scope="col">Updated By</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($experiment->participants as $participant)
                    <tr>
                        <td>{{ $participant->id }}</td>
                        <td>{{ $participant->code }}</td>
                        <td>{{ $participant->birthdate }}</td>
                        <td>{{ $participant->version }}</td>
                        <td>{{ $participant->author->name }}</td>
                        <td>{{ $participant->editor->name }}</td>
                        <td>{{ $participant->created_at->format(config('app.dtdisplayformat')) }}</td>
                        <td>{{ $participant->updated_at->format(config('app.dtdisplayformat')) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>


    </div>
</x-layouts.app>
