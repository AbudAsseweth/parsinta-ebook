<div class="row">
    <div class="col-md-4">
        <div class="mb-4">
            <label for="category_id" class="form-label">Category</label>
            <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" required
                name="category_id">
                <option selected disabled value="">Select Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ $category->id == old('category_id', $article?->category_id) ? 'selected' : '' }}>
                        {{ $category->name }}</option>
                @endforeach
            </select>

            @error('category_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="tags" class="form-label">Tag</label>
            <select id="tags"
                class="form-select @error('tags') is-invalid @enderror @error('tags.*') is-invalid @enderror" multiple
                aria-label="tags select" name="tags[]">
                @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}"
                        {{ collect(old('tags', $article?->tags->pluck('id')))->contains($tag->id) ? 'selected' : '' }}>
                        {{ $tag->name }}</option>
                @endforeach
            </select>

            @error('tags.*')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

            @error('tags')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="picture" class="form-label">Upload Image</label>
            <input class="form-control" type="file" id="picture" name="picture">
        </div>
    </div>

    <div class="col-md-8">
        <div class="mb-4">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title"
                class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $article?->title) }}">
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="body" class="form-label">Body</label>
            <textarea name="body" id="body" rows="15"
                class="form-control @error('body') is-invalid
            @enderror">{{ old('body', $article?->body) }}</textarea>

            @error('body')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="text-end">
        <button type="submit" class="btn btn-primary">{{ $action }}</button>
    </div>
</div>



@pushOnce('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endPushOnce

@pushOnce('scripts')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    <script>
        $('#tags').select2({
            theme: 'bootstrap-5'
        });
    </script>
@endPushOnce
