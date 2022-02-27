<x-layouts.app>
    <div class="container">

        <h1>Experiments</h1>

        <div class="row">
            @foreach ($experiments as $experiment)
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $experiment->name }}</h5>
                        <p class="card-text">{{ $experiment->updated_at->diffForHumans() }}</p>
                        <a href="{{ route('experiments.show', $experiment->id) }}" class="btn btn-primary">View</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</x-layouts.app>
