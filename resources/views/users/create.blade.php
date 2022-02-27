<x-layouts.app>
    <div class="container container-form">
        <div class="card">
            <h5 class="card-header">Add User</h5>
            <div class="card-body">
                <form action="{{ route('users.store') }}" method="POST">
                    <div class="mb-3">
                        @csrf
                        <label for="name" class="form-label">Name</label>
                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" placeholder="Full Name" value="{{ old('name') }}">
                        @error('name')
                            <div id="validation-name-error" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        @csrf
                        <label for="email" class="form-label">Email</label>
                        <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" id="email" placeholder="user@email.com" value="{{ old('email') }}">
                        @error('email')
                            <div id="validation-email-error" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        @csrf
                        <label for="password" class="form-label">Temporary Password</label>
                        <input class="form-control @error('password') is-invalid @enderror" type="text" name="password" id="password" readonly value="{{ $temporary_password }}">
                        @error('password')
                            <div id="validation-password-error" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-select @error('role') is-invalid @enderror" aria-label="role"
                            name="role" id="role">
                            @foreach ($roles as $key => $role)
                                <option value="{{ $key }}"
                                    @if (old('role') == $key) selected @endif>{{ $role }}
                                </option>
                            @endforeach
                        </select>
                        @error('role')
                            <div id="validation-role" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col d-grid mx-auto">
                            <a href="{{ route('users.index') }}" class="btn btn-danger">Go back</a>
                        </div>
                        <div class="col d-grid mx-auto">
                            <button type="submit" class="btn btn-primary">Create User</button>
                        </div>
                    </div>
                </form>
            </div>
          </div>
    </div>
</x-layouts.app>
