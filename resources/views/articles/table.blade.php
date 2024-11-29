<x-app-layout title="Table of Articles">
    <div class="container">
        <x-card title="Table of Articles" subtitle="Do anything here, because you're the super
    admin!">

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <table class="table">
                <thead>
                    <th>#</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Author</th>
                    <th>Created at</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($articles as $article)
                        <tr>
                            <td>{{ $articles->firstItem() + $loop->index }}</td>
                            <td><a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a></td>

                            @if ($article->isStatus('APPROVED'))
                                <td><span class="badge bg-success">{{ $article->status->name }}</span></td>
                            @elseif($article->isStatus('PENDING'))
                                <td><span class="badge bg-danger">{{ $article->status->name }}</span></td>
                            @endif

                            <td>{{ $article->author->name }}</td>
                            <td>{{ $article->created_at->format('d F, Y') }}</td>
                            @hasRole('admin')
                                <td>
                                    <x-table.dropdown-menu>
                                        <li>
                                            @if ($article->isStatus('APPROVED'))
                                                <form action="{{ route('articles.update-status', $article) }}"
                                                    method="POST">
                                                    @method('PUT')
                                                    @csrf
                                                    <input type="hidden" name="status"
                                                        value="{{ App\Enums\ArticleStatus::PENDING }}">

                                                    <a class="dropdown-item" href="#"
                                                        onclick="event.preventDefault(); this.closest('form').submit()">Unpublish</a>
                                                </form>
                                            @endif

                                            @if ($article->isStatus('PENDING'))
                                                <form action="{{ route('articles.update-status', $article) }}"
                                                    method="POST">
                                                    @method('PUT')
                                                    @csrf
                                                    <input type="hidden" name="status"
                                                        value="{{ App\Enums\ArticleStatus::APPROVED }}">

                                                    <a class="dropdown-item" href="#"
                                                        onclick="event.preventDefault(); this.closest('form').submit()">Publish</a>
                                                </form>
                                            @endif
                                        </li>
                                    </x-table.dropdown-menu>
                                </td>
                            @endHasRole
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $articles->links() }}
        </x-card>
    </div>
</x-app-layout>
