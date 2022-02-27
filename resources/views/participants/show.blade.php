<x-layouts.app>
    <div class="container">
        <h1>{{ $participant->code }}</h1>
        <h2>{{ $participant->birthdate }}</h2>
        <h3>{{ $participant->version }}</h3>

        <hr>

        <h4>Responses ({{ $participant->responses->count() }}/{{$participant->experiment->fields->count()}})</h4>
        

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
