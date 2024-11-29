<x-app-layout title="Register">
    <div class="container">
        <div class="col-md-6">
            <x-card title="Register" subtitle="Create new account">
                <form action="{{ route('register') }}" method="post">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name"
                            class="form-control @error('name') is-invalid @enderror" />
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

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

                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
            </x-card>
        </div>
    </div>
</x-app-layout>
