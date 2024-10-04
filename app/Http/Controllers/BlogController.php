<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
// use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\Tag;


class BlogController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $blogs = Blog::with(['category', 'tag'])
            ->where('title', 'like', "%{$search}%")
            ->orWhere('content', 'like', "%{$search}%")
            ->paginate(1);

        return view('blogs.index', compact('blogs', 'search'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('blogs.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|integer|exists:categories,id',
            'tag_id' => 'required|integer|exists:tags,id',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $validated['image'] = $path;
        }

        Blog::create($validated);

        return redirect()->route('blogs.index')->with('success', 'Blog created successfully.');
    }

    public function edit(Blog $blog)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('blogs.edit', compact('blog', 'categories', 'tags'));
    }

    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|integer|exists:categories,id',
            'tag_id' => 'required|integer|exists:tags,id',
            'image' => 'nullable|image|max:2048',
            'status' => 'required|in:published,draft,pending',
        ]);

        if ($request->hasFile('image')) {
            if ($blog->image) {
                \Storage::disk('public')->delete($blog->image);
            }
            $path = $request->file('image')->store('images', 'public');
            $validated['image'] = $path;
        }

        $blog->update($validated);

        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully.');
    }
   
    
    public function destroy(Blog $blog)
    {
        if ($blog->image) {
            \Storage::disk('public')->delete($blog->image);
        }
        
        $blog->delete();

        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully.');
    }
}
