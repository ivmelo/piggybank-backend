<x-layouts.guest>
    <div class="container signin-card">
        <div class="card mt-5">
            <h4 class="card-header">
                Sign in
            </h4>
            <div class="card-body">
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" id="email" placeholder="your@email.com" value="{{ old('email') }}">
                        @error('email')
                        <div id="validation-email-error" class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" id="password" placeholder="YourPassword123!" value="{{ old('password') }}">
                        @error('password')
                        <div id="validation-password-error" class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                <label class="form-check-label" for="remember">
                                    Remember me
                                </label>
                            </div>
                        </div>
                        <div class="col-6 d-grid mx-auto">
                            <button type="submit" class="btn btn-primary">Sign in</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.guest>
