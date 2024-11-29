<x-app-layout title="New article">
    <div class="container">
        <div class="row">
            <x-card class="mb-4" title="New" subtitle="Create new article">
                <form method='post' action="{{ route('articles.store') }}" enctype="multipart/form-data">
                    @csrf

                    @include('articles.form', ['action' => 'Create New Article'])
                </form>
            </x-card>
        </div>
    </div>
</x-app-layout>
