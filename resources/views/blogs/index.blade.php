@extends('layouts.app')

@section('content')
<div class="container">
    <form method="GET" action="{{ route('blogs.index') }}">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search blogs...">
        <button type="submit">Search</button>
    </form>

    <div class="d-flex">
        @foreach($blogs as $blog)
            <div class="mr-5">
                <img src="{{ asset('images/' . $blog->image) }}" alt="">
                <h2>{{ $blog->title }}</h2>
                <p>{{ $blog->content }}</p>
                <p>Category: {{ $blog->category->name }}</p>
                <a href="{{ route('blogs.edit', $blog) }}">Edit</a>
                <form action="{{ route('blogs.destroy', $blog) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"
                        onclick="return confirm('Are you sure you want to delete this blog?');">Delete</button>
                </form>
            </div>
        @endforeach
    </div>



    <div class="d-flex justify-content-center">
        {{ $blogs->links() }}
    </div>
</div>


@endsection