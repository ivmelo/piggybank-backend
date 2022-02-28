<x-layouts.app>
    <div class="container">
        @include('partials.experiment-tabs')

        <div>
            <h3 class="mt-4 mb-4">Participants</h3>
        </div>

        <div class="card">
            <h5 class="card-header">Edit Participant</h5>
            <div class="card-body">
                <form action="{{ route('participants.update', $participant->id) }}" method="POST">
                    <div class="mb-3">
                        @csrf
                        @method('put')
                        <label for="code" class="form-label">Code</label>
                        <input class="form-control @error('code') is-invalid @enderror" type="code" name="code" id="code" placeholder="000000U" value="{{ old('code', $participant->code) }}">
                        @error('code')
                            <div id="validation-code-error" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        @csrf
                        <label for="birthdate" class="form-label">Birthdate</label>
                        <input class="form-control @error('birthdate') is-invalid @enderror" type="birthdate" name="birthdate" id="birthdate" placeholder="01012015" value="{{ old('birthdate', $participant->birthdate) }}">
                        @error('birthdate')
                            <div id="validation-birthdate-error" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="version" class="form-label">Version</label>
                        <select class="form-select @error('version') is-invalid @enderror" aria-label="Version"
                            name="version" id="version">
                            @foreach ($versions as $key => $version)
                                <option value="{{ $key }}"
                                    @if (old('version', $participant->version) == $key) selected @endif>{{ $version }}
                                </option>
                            @endforeach
                        </select>
                        @error('version')
                            <div id="validation-version" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="host_id" class="form-label">Host</label>
                        <select class="form-select @error('host_id') is-invalid @enderror" aria-label="Host"
                            name="host_id" id="host_id">
                            @foreach ($hosts as $key => $host)
                                <option value="{{ $key }}"
                                    @if (old('host_id', $participant->host_id) == $key) selected @endif>{{ $host }}
                                </option>
                            @endforeach
                        </select>
                        @error('host_id')
                            <div id="validation-host_id" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        @csrf
                        <label for="notes" class="form-label">Notes</label>
                        <textarea class="form-control @error('notes') is-invalid @enderror" type="notes" name="notes" id="notes" placeholder="Participant notes..." rows="2">{{ old('notes', $participant->notes) }}</textarea>
                        @error('notes')
                            <div id="validation-notes-error" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col d-grid mx-auto">
                            <a href="{{ route('experiments.show', $experiment->id) }}" class="btn btn-secondary">Go back</a>
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
