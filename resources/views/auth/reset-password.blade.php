<x-app-layout title="Reset Password">
    <div class="container">
        <div class="col-md-6">
            <x-card title="Reset Password" subtitle="Change your password with new password">
                <form action="{{ route('password.update') }}" method="post">
                    @csrf

                    <input type="text" name="token" value="{{ $token }}" hidden>

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

                    <div class="mb-4">
                        <label for="confirm-password" class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="confirm-password"
                            class="form-control" />
                    </div>

                    <button type="submit" class="btn btn-primary">Reset Password</button>
                </form>
            </x-card>
        </div>
    </div>
</x-app-layout>
