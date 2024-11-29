<div class="col-md-4">
    <div class="overflow-hidden rounded border">
        <a href="{{ route('articles.show', $article) }}">
            <img class="w-100"
                src="{{ $article->picture ? asset('storage/' . $article->picture) : 'https://placehold.co/1280x720' }}"
                alt="">
        </a>
        <div class="bg-light p-4">
            <small class="d-flex align-items-center justify-content-between mb-2">
                <small class="text-muted">{{ $article->created_at->format('d F, Y') }}</small>
                <a href="{{ route('users.show', $article->author) }}" class="text-muted text-decoration-none">
                    {{ $article->author->name }}
                </a>
            </small>

            <a class="d-block text-dark text-decoration-none font-semibold"
                href="{{ route('articles.show', $article) }}">
                {{ $article->title }}
            </a>

            <div class="d-flex align-items-center mt-2">
                <a class="text-decoration-none"
                    href="{{ route('categories.show', $article->category) }}">{{ $article->category->name }}</a>
                <small class="text-muted mx-2">/</small>
                @empty(!$article->tags)
                    <small class="d-block">
                        @foreach ($article->tags as $tag)
                            <a class="text-decoration-none" href="{{ route('tags.show', $tag) }}">{{ $tag->name }}</a>
                        @endforeach
                    </small>
                @endempty
            </div>
        </div>
    </div>
</div>
