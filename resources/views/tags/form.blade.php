<div class="mb-4">
    <label for="name" class="form-label">Tag Name</label>
    <input type="text" name="name" id="name" value="{{ old('name', $tag?->name) }}"
        class="form-control @error('name') is-invalid @enderror">
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<button type="submit" class="btn btn-primary">{{ $action }} Tag</button>
