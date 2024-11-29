<x-app-layout>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <x-card title='Change Password' subtitle='Change password for {{ $user->name }} account'>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('change-password') }}" method="post">
                        @method('put')
                        @csrf

                        <div class="mb-4">
                            <label for="current-password" class="form-label">Old Password</label>
                            <input type="password" name="current_password" id="current-password"
                                class="form-control @error('current_password') is-invalid @enderror"" />

                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" name="password" id="password"
                                class="form-control @error('password') is-invalid @enderror" />
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="confirm-password" class="form-label">Confirm New Password</label>
                            <input type="password" name="password_confirmation" id="confirm-password"
                                class="form-control" />
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Update Password
                        </button>
                    </form>
                </x-card>
            </div>
        </div>
    </div>
</x-app-layout>
