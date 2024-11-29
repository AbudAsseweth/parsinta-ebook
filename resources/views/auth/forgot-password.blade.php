<x-app-layout title="Forgot Password Recovery">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <x-card title="Forgot Password Recovery" subtitle="Recover your account">
                    <form action="{{ route('password.email') }}" method="post">
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

                        <button type="submit" class="btn btn-primary">Send Email</button>
                    </form>
                </x-card>
            </div>
        </div>
    </div>
</x-app-layout>
