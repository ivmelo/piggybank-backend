<x-layouts.app>
    <div class="container">
        @include('partials.experiment-tabs')

        <div>
            <h3 class="float mt-4 mb-4">Edit</h3>
        </div>

        <div class="card">
            <h5 class="card-header">Edit Experiment</h5>
            <div class="card-body">
                <form action="{{ route('experiments.update', $experiment->id) }}" method="POST">
                    <div class="mb-3">
                        @method('put')
                        @csrf
                        <label for="name" class="form-label">Name</label>
                        <input class="form-control @error('name') is-invalid @enderror" type="name" name="name" id="name" placeholder="Experiment name" value="{{ old('name', $experiment->name) }}">
                        @error('name')
                            <div id="validation-name-error" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-3 offset-md-9">
                            <button class="btn btn-primary float-end" type="submit">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-layouts.app>
