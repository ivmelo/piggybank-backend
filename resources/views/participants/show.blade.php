<x-layouts.app>
    <div class="container">
        @include('partials.experiment-tabs')

        <div>
            <h3 class="mt-4 mb-4">Participants</h3>
        </div>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th colspan="2">Participant Details</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>#</th>
                    <td>{{ $participant->id }}</td>
                </tr>
                <tr>
                    <th>Code</th>
                    <td>{{ $participant->code }}</td>
                </tr>
                <tr>
                    <th>Birthdate</th>
                    <td>{{ $participant->birthdate }}</td>

                </tr>
                <tr>
                    <th>Version</th>
                    <td>{{ $participant->version }}</td>
                </tr>
                <tr>
                    <th>Host</th>
                    <td>{{ $participant->host->name }}</td>
                </tr>
                <tr>
                    <th>Notes</th>
                    <td>{{ $participant->notes }}</td>
                </tr>
                <tr>
                    <th>Created By</th>
                    <td>{{ $participant->author->name }}</td>
                </tr>
                <tr>
                    <th>Updated By</th>
                    <td>{{ $participant->editor->name }}</td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td>{{ $participant->created_at }}</td>
                </tr>
                <tr>
                    <th>Updated At</th>
                    <td>{{ $participant->updated_at }}</td>
                </tr>
            </tbody>
        </table>

        <h3 class="mt-4 mb-4">Participant Responses ({{ $participant->responses->count() }}/{{ $participant->experiment->fields->count() }})</h3>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Field Name</th>
                    <th scope="col">Response Value</th>
                    <th scope="col">Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($participant->responses as $response)
                    <tr>
                        <td>{{ $response->id }}</td>
                        <td>{{ $response->field->name }}</td>
                        <td>{{ $response->value }}</td>
                        <td>{{ $response->updated_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</x-layouts.app>
