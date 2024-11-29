@include('layouts.hljs')

<x-app-layout title="{{ $article->title }} | Articles">
    <div class="bg-dark border-bottom mb-5 py-5 text-white" style="margin-top: -24px">
        <div class="container">
            <div class="d-flex align-items-center gap-5 pb-1 pt-4">
                <div class="col-md-7">
                    <div class="me-auto">
                        <div class="d-flex align-items-center mb-2 gap-2">
                            <a class="btn btn-primary btn-sm" href="{{ route('categories.show', $article->category) }}">
                                {{ $article->category->name }}
                            </a>
                            @foreach ($article->tags as $tag)
                                <a class="btn btn-secondary btn-sm" href="{{ route('tags.show', $tag) }}">
                                    {{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                        <h1 class="display-6 fw-semibold mb-4">{{ $article->title }}</h1>
                        <p class="text-light lead">{{ str($article->body)->limit(110) }}</p>
                        <div class="d-flex align-items-center justify-content-between mt-4">
                            <div class="text-white-50">
                                {{ $article->created_at->format('d F, Y') }}
                                by <a class="text-white" href="{{ route('users.show', $article->author) }}">
                                    {{ $article->author->name }}
                                </a>
                                &middot;
                                {{ $article->likes_count }} {{ str('like')->plural($article->likes_count) }}
                            </div>
                            @auth
                                <div class="d-flex align-items-center gap-2">
                                    <form method="POST" action="{{ route('articles.like', $article) }}">
                                        @csrf

                                        <a class="btn btn-primary btn-sm text-decoration-none"
                                            href="{{ route('articles.like', $article) }}"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                            {{ $article->alreadyLiked() ? 'Unlike' : 'Like' }}
                                        </a>
                                    </form>

                                    @can('update', $article)
                                        <a class="btn btn-primary btn-sm" href="{{ route('articles.edit', $article) }}">
                                            Edit artikel
                                        </a>
                                    @endcan
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <img class='w-100 rounded' src="{{ asset('storage/' . $article->picture) }}" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="fw-light lead lh-base">
                    {!! str($article->body)->markdown() !!}
                </div>

                <x-articles.comment.block :comments="$comments" />

                <x-articles.comment.form :action="route('comments.store', $article)" method="POST" />
            </div>
        </div>
    </div>
</x-app-layout>
