<x-app-layout title="Edit category {{ $category->name }}">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <x-card>
                    @slot('title')
                        Edit Category {{ $category->name }}
                    @endslot

                    @slot('subtitle')
                        Edit
                    @endslot

                    <form action="{{ route('categories.update', $category) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="name" class="form-label">Category Name</label>
                            <input type="text" name="name" id="name"
                                value="{{ old('name', $category->name) }}"
                                class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Update Category</button>
                    </form>
                </x-card>
            </div>

            <div class="col-md-4">
                <a class="btn btn-primary w-100" href="{{ route('categories.index') }}">
                    Table of categories
                </a>
                <button type="button" class="btn btn-danger w-100 mt-2" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    Delete
                </button>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="modal-title" id="exampleModalLabel">Category: {{ $category->name }}</div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p class="text-muted text-center">Are you really sure you want to delete
                                    it?</p>
                                <div class="d-flex align-items-center justify-content-center gap-2">
                                    <form action="{{ route('categories.destroy', $category) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">
                                            Yes
                                        </button>
                                    </form>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
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
