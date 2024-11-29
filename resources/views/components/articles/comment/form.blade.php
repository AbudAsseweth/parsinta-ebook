@auth
    <form class="mb-4" action="{{ $action }}" method="POST">
        @csrf
        @method($method)

        <textarea class="form-control" name="body" id="body"
            placeholder="Hi {{ auth()->user()?->username }}. What's on your mind ?"></textarea>
        <div class="mt-2 text-end">
            <button type="submit" class="btn btn-primary">Comment</button>
        </div>
    </form>
@else
    <a href="{{ route('login') }}">Login</a> to make a comment.
@endauth
