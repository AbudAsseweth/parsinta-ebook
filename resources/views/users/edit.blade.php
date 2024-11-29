<x-app-layout title="Settings / Profile">
    <div class="container">
        <div class="col-md-8">
            <x-card title='Profile' subtitle='The information you enter will appear on the
    profile page.'>
                <form action="{{ route('users.update', $user) }}" method="post">
                    @method('put')
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="name" class="form-label">Name</label>
                                <input value="{{ old('name', auth()->user()->name) }}" type="text" name="name"
                                    id="name" class="form-control @error('name') is-invalid @enderror">

                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="username" class="form-label">Username</label>
                                <div class="input-group @error('username') is-invalid @enderror">
                                    <span class="input-group-text" id="username">
                                        domain.com/
                                    </span>
                                    <input value="{{ old('username', auth()->user()->username) }}" type="text"
                                        name="username" id="username"
                                        class="form-control @error('username') is-invalid @enderror">
                                </div>

                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="form-label">Email address</label>
                        <input value="{{ old('email', auth()->user()->email) }}" type="text" name="email"
                            id="email" class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>
                </form>
            </x-card>
        </div>
    </div>
</x-app-layout>
