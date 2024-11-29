<x-app-layout title="Create new category">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <x-card>
                    @slot('title')
                        Create Category
                    @endslot

                    @slot('subtitle')
                        Create New Category
                    @endslot

                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="form-label">Category Name</label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Create Category</button>
                    </form>
                </x-card>
            </div>
        </div>
    </div>
</x-app-layout>
