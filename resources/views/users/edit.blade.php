<x-layouts.app>
    <div class="container container-form">
        <div class="card">
            <h5 class="card-header">Edit User</h5>
            <div class="card-body">
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    <div class="mb-3">
                        @method('put')
                        @csrf
                        <label for="name" class="form-label">Name</label>
                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" placeholder="Full Name" value="{{ old('name', $user->name) }}">
                        @error('name')
                            <div id="validation-name-error" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        @csrf
                        <label for="email" class="form-label">Email</label>
                        <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" id="email" placeholder="user@email.com" value="{{ old('email', $user->email) }}">
                        @error('email')
                            <div id="validation-email-error" class="invalid-feedback">
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
                                    @if (old('role', ($user->is_admin ? 'admin' : 'user')) == $key) selected @endif>{{ $role }}
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
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">Go back</a>
                        </div>
                        <div class="col d-grid mx-auto">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
          </div>

          <div class="card mt-5">
            <h5 class="card-header">Update Password</h5>
            <div class="card-body">
                <form action="{{ route('users.update-password', $user->id) }}" method="POST">
                    <div class="mb-3">
                        @csrf
                        @method('put')
                        <label for="password" class="form-label">Password</label>
                        <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" id="password" value="">
                        @error('password')
                            <div id="validation-password-error" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        @csrf
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" id="password_confirmation" value="">
                        @error('password_confirmation')
                            <div id="validation-password_confirmation-error" class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col d-grid mx-auto">
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">Go back</a>
                        </div>
                        <div class="col d-grid mx-auto">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
