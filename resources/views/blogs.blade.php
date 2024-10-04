@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Blogs</h1>

    <form method="GET" action="{{ route('blogs.index') }}">
        <div class="input-group mb-3">
            <input type="text" name="search" class="form-control" placeholder="Search blogs..." value="{{ request()->get('search') }}">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </form>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Content</th>
                <th>Category</th>
                <th>Tag</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($blogs as $blog)
                <tr>
                    <td>{{ $blog->title }}</td>
                    <td>{{ Str::limit($blog->content, 100) }}</td>
                    <td>{{ $blog->category->name }}</td>
                    <td>{{ $blog->tag->name }}</td>
                    <td>{{ ucfirst($blog->status) }}</td>
                    <td>
                        <a href="{{ route('blogs.edit', $blog) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('blogs.destroy', $blog) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this blog?');">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No blogs found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $blogs->links() }}
    </div>
</div>
@endsection
