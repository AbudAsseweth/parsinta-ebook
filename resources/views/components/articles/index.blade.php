@empty(!$articles)
    @foreach ($articles->chunk(3) as $chunk)
        <div class="row mb-4">
            @foreach ($chunk as $article)
                <x-articles.single :article="$article" />
            @endforeach
        </div>
    @endforeach

    @if ($articles instanceof \Illuminate\Pagination\LengthAwarePaginator)
        {{ $articles->links() }}
    @endif
@else
    <div class="alert alert-info">Tidak ada data</div>
@endempty
