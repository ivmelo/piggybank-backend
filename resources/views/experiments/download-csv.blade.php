<x-layouts.app>
    <div class="container">
        @include('partials.experiment-tabs')

        <div>
            <h2 class="float mt-4 mb-4">Download CSV</h2>
        </div>

        <h3>Responses</h3>
        <p>Press the button below to download the responses of this experiment as a .csv file.</p>
        <a href="{{ route('experiments.download-csv', $experiment->id) }}" class="btn btn-success">Download Responses CSV</a>

        <h3 class="mt-5">Fields</h3>
        <p>Press the button below to download the list of fields of this experiment as a .csv file.</p>
        <a href="{{ route('experiments.download-csv', $experiment->id) }}" class="btn btn-success">Download Fields CSV</a>
    </div>
</x-layouts.app>
