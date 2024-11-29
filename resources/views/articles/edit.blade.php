<x-app-layout title="Edit artikel: {{ $article->title }}">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <x-card class="mb-4" title="Edit artikel" subtitle="{{ $article->title }}">
                    <form method='post' action="{{ route('articles.update', $article) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        @include('articles.form', ['action' => 'Update Article'])
                    </form>
                </x-card>
            </div>
        </div>
    </div>
</x-app-layout>
