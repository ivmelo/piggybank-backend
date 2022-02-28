<x-layouts.app>
    <div class="container">
        <div>
            <a href="{{ route('experiments.create') }}" class="btn btn-primary float-end">Add Experiment</a>
            <h1 class="mb-4">Experiments</h1>
        </div>

        <div class="row">
            @foreach ($experiments as $experiment)
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $experiment->name }}</h5>
                        <p>{{ $experiment->fields->count() }} field(s) | {{ $experiment->participants->count() }} participant(s)</p>
                        <p class="card-text">{{ $experiment->created_at->format(config('app.dtdisplayformat')) }}</p>
                        <div class="row">
                            <div class="col d-grid gap-2">
                                <a href="{{ route('experiments.show', $experiment->id) }}" class="btn btn-primary">View</a>
                            </div>
                            <div class="col d-grid gap-2">
                                <a href="{{ route('experiments.edit', $experiment->id) }}" class="btn btn-secondary">Edit</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</x-layouts.app>
