<x-app-layout title="Categories">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <x-card title="Categories" subtitle="List of all category">
                    <a href="{{ route('categories.create') }}" class="btn btn-primary">Create Category</a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Number of Article</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>{{ $category->articles_count }}</td>
                                    <td><a href="{{ route('categories.edit', $category) }}">Edit</a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">There is no data at the moment</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </x-card>
            </div>
        </div>
    </div>
</x-app-layout>
