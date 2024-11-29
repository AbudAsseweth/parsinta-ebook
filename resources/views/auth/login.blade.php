<x-app-layout title="Login">
    <div class="container">
        <div class="col-md-6">
            <x-card title="Login" subtitle="Login to your account">
                <form action="{{ route('login') }}" method="post">
                    @csrf

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="mb-4">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" name="email" id="email"
                            class="form-control @error('email') is-invalid @enderror" />
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password"
                            class="form-control @error('password') is-invalid @enderror" />
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember-me" />
                        <label class="form-check-label" for="remember-me"> Remember me </label>

                        <a href="{{ route('password.request') }}" class="text-muted">Forgot password?</a>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </x-card>
        </div>
    </div>
</x-app-layout>
