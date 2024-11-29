<x-app-layout title="Create new tag">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <x-card>
                    @slot('title')
                        Create Tag
                    @endslot

                    @slot('subtitle')
                        Create New Tag
                    @endslot

                    <form action="{{ route('tags.store') }}" method="POST">
                        @csrf

                        @include('tags.form', ['action' => 'Create'])
                    </form>
                </x-card>
            </div>

            <div class="col-md-4">
                <a class="btn btn-primary w-100" href="{{ route('tags.index') }}">
                    Table of tags
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
