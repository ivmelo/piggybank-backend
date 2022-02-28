<x-layouts.app>
    <div class="container container-form">
        <div class="card">
            <h5 class="card-header">Add Experiment</h5>
            <div class="card-body">
                <form action="{{ route('experiments.store') }}" method="POST">
                    <div class="mb-3">
                        @csrf
                        <label for="name" class="form-label">Name</label>
                        <input class="form-control @error('name') is-invalid @enderror" type="name" name="name" id="name" placeholder="Experiment name" value="{{ old('name') }}">
                        @error('name')
                            <div id="validation-name-error" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col d-grid mx-auto">
                            <a href="{{ route('experiments.index') }}" class="btn btn-danger">Go back</a>
                        </div>
                        <div class="col d-grid mx-auto">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
          </div>
    </div>
</x-layouts.app>
