<nav class="navbar navbar-expand-lg navbar-dark mb-4 bg-black py-3">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">Laravel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbarNavDropdown">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('articles.index') }}">Articles</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                        aria-expanded="false">Categories</a>
                    <ul class="dropdown-menu">
                        @foreach ($categories as $category)
                            <li>
                                <a class="dropdown-item" href="{{ route('categories.show', $category) }}">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
            <ul class="navbar-nav">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                            aria-expanded="false">{{ Auth::user()->name }}</a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('users.edit', auth()->user()) }}">Settings</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('change-password.edit') }}">Change password</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>

                            @hasAnyRoles(['writer', 'admin'])
                            <li>
                                <a class="dropdown-item" href="{{ route('articles.create') }}">Create New Article</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('articles.table') }}">Articles Table</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            @endHasAnyRoles

                            @hasRole('admin')
                                <li>
                                    <a class="dropdown-item" href="{{ route('categories.create') }}">Create New Category</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('tags.create') }}">Create New Tag</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('users.index') }}">Users</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                            @endHasRole

                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();this.closest('form').submit();">Logout</a>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}"> Register </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}"> Login </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
