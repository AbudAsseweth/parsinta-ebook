<x-app-layout title="Edit tag">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <x-card>
                    @slot('title')
                        Edit Tag
                    @endslot

                    @slot('subtitle')
                        Edit {{ $tag->name }} tag
                    @endslot

                    <form action="{{ route('tags.update', $tag) }}" method="POST">
                        @csrf
                        @method('PUT')

                        @include('tags.form', ['action' => 'Update'])
                    </form>
                </x-card>
            </div>

            <div class="col-md-4">
                <a class="btn btn-primary w-100" href="{{ route('tags.index') }}">
                    Table of tags
                </a>
                <button type="button" class="btn btn-danger w-100 mt-2" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    Delete
                </button>
                <div class="modal fade" id="exampleModal" tabindex="-1" arialabelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="modal-title" id="exampleModalLabel">Tag: {{ $tag->name }}</div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p class="text-muted text-center">Are you really sure you want
                                    to delete it?</p>
                                <div class="d-flex align-items-center justify-content-center gap-2">
                                    <form action="{{ route('tags.destroy', $tag) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">
                                            Yes
                                        </button>
                                    </form>
                                    <button type="button" class="btn btn-secondary" data-bsdismiss="modal"
                                        aria-label="Close">No</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
