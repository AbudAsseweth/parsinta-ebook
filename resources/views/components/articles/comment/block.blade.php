@if ($comments->count())
    @foreach ($comments as $comment)
        <div class="border-top mb-4 mt-4 pt-4">
            {!! str($comment->body)->markdown() !!}

            <small class="text-muted d-flex align-items-center gap-2">
                {{ $comment->user->name }} &middot; {{ $comment->created_at->diffForHumans() }}
                &middot; {{ $comment->likes_count . ' ' . Str::plural('like', $comment->likes_count) }}

                <!-- Like button -->
                @auth
                    &middot; <form method="POST" action="{{ route('comments.like', $comment) }}">
                        @csrf

                        <a class="text-primary text-decoration-none" href="{{ route('comments.like', $comment) }}"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ $comment->alreadyLiked() ? 'Unlike' : 'Like' }}
                        </a>
                    </form>
                @endauth

                <!-- Delete button -->
                @if (Auth::user()?->id == $comment->user_id)
                    &middot; <form method="POST" action="{{ route('comments.delete', $comment) }}">
                        @csrf
                        @method('DELETE')
                        <a class="text-danger text-decoration-none" href="{{ route('comments.delete', $comment) }}"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            Delete
                        </a>
                    </form>
                @endif


            </small>

        </div>
    @endforeach
@else
    <p class="text-muted">Be the first to comment!</p>
@endif
