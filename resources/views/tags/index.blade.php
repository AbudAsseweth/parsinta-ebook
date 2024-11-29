<x-app-layout title="Tags">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <x-card title="Tags" subtitle="List of all tag">
                    <a href="{{ route('tags.create') }}" class="btn btn-primary">Create Tag</a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tag Name</th>
                                <th scope="col">Slug</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tags as $tag)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $tag->name }}</td>
                                    <td>{{ $tag->slug }}</td>
                                    <td><a href="{{ route('tags.edit', $tag) }}">Edit</a></td>
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
