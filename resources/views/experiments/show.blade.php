<x-layouts.app>
    <div class="container">
        @include('partials.experiment-tabs')

        <div>
            <h3 class="float-start mt-4 mb-4">Participants</h3>
            @can('add-participant')
            <a href="{{ route('participants.create', $experiment->id) }}" class="btn btn-primary float-end mt-4 mb-4">Add Participant</a>
            @endcan
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Code</th>
                    <th scope="col">Birthdate</th>
                    <th scope="col">Version</th>
                    <th scope="col">Host</th>
                    <th scope="col">Created By</th>
                    <th scope="col">Updated By</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($experiment->participants as $participant)
                    <tr>
                        <td>{{ $participant->id }}</td>
                        <td><a
                                href="{{ route('participants.show', $participant->id) }}">{{ $participant->code }}</a>
                        </td>
                        <td>{{ $participant->birthdate }}</td>
                        <td>{{ $participant->version }}</td>
                        <td>{{ $participant->host->name }}</td>
                        <td>{{ $participant->author->name }}</td>
                        <td>{{ $participant->editor->name }}</td>
                        <td>{{ $participant->created_at->format(config('app.dtdisplayformat')) }}</td>
                        <td>{{ $participant->updated_at->format(config('app.dtdisplayformat')) }}</td>
                        <td>
                            @if ($participant->responses->count() === 0)
                                <span class="badge bg-secondary">Not Started</span>
                            @elseif($participant->responses->count() >= $experiment->fields->count())
                                <span class="badge bg-success">Completed</span>
                            @else
                                <span class="badge bg-primary">In Progress</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts.app>
