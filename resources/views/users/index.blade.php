<x-app-layout title="Users">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <x-card title='Users' subtitle='Table of users'>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th class="text-center">Roles</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td class="text-center">
                                        {{ $user->roles->count() ? $user->roles->implode('name', ', ') : '-' }}
                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-transparent border-0 p-0" type="button"
                                                id="user-action" data-bs-toggle="dropdown" aria-expanded="false">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-three-dots-vertical"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                                </svg>
                                            </button>
                                            <ul class="dropdown-menu">
                                                @foreach ($roles as $role)
                                                    @if ($user->roles->pluck('id')->contains($role->id))
                                                        <form action="{{ route('roles.assign', $user) }}"
                                                            method="POST">
                                                            @csrf

                                                            <input type="hidden" name="role_id"
                                                                value="{{ $role->id }}">

                                                            <a class="dropdown-item" href="#"
                                                                onclick="event.preventDefault(); this.closest('form').submit()">Remove
                                                                {{ $role->name }}</a></li>
                                                        </form>
                                                    @else
                                                        <form action="{{ route('roles.assign', $user) }}"
                                                            method="POST">
                                                            @csrf

                                                            <input type="hidden" name="role_id"
                                                                value="{{ $role->id }}">

                                                            <a class="dropdown-item" href="#"
                                                                onclick="event.preventDefault(); this.closest('form').submit()">Assign
                                                                {{ $role->name }}</a></li>
                                                        </form>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">
                                        <div class="text-center">Data is currently empty.</div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </x-card>
            </div>
        </div>
    </div>
</x-app-layout>
