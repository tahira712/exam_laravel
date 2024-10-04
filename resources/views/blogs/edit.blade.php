@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Blog</h2>

    <form method="POST" action="{{ route('blogs.update', $blog) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $blog->title) }}" required>
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" class="form-control" required>{{ old('content', $blog->content) }}</textarea>
        </div>

        <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id" class="form-control" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $blog->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="tag_id">Tag</label>
            <select name="tag_id" class="form-control" required>
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}" {{ $blog->tag_id == $tag->id ? 'selected' : '' }}>
                        {{ $tag->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" class="form-control">
            @if($blog->image)
                <img src="{{ asset('storage/' . $blog->image) }}" alt="Current Image" style="max-width: 100px;">
            @endif
        </div>

    

        <button type="submit" class="btn btn-primary">Update Blog</button>
    </form>
</div>
@endsection
