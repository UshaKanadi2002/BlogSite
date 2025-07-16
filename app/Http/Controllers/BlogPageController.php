<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPage;
use App\Models\User;

class BlogPageController extends Controller
{
    // Display all blog posts
    public function index()
    {
        $blogPages = BlogPage::with('author')->latest()->get();
        return view('blog_pages.index', compact('blogPages'));
    }

    // Show blog creation form with author dropdown
    public function create()
    {
        $users = User::all(); // ✅ Get authors
        return view('blog_pages.create', compact('users'));
    }

    // Store new blog post
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'         => 'required|string|max:255',
            'slug'          => 'required|string|unique:blog_pages,slug',
            'excerpt'       => 'nullable|string',
            'content'       => 'required|string',
            'author_id'     => 'required|exists:users,id',
            'is_published'  => 'required|boolean',
            'published_at'  => 'nullable|date',
            'image'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blog_images', 'public');
            $data['image_url'] = $imagePath;
        }

        BlogPage::create($data);

        return redirect()->route('blog_pages.index')
                        ->with('success', 'Blog post created successfully.');
    }

    // Show edit form
    public function edit(BlogPage $blog_page)
    {
        return view('blog_pages.edit', ['blog' => $blog_page]);
    }

    // Update blog post
    public function update(Request $request, BlogPage $blog_page)
    {
        $data = $request->validate([
            'title'         => 'required|string|max:255',
            'slug'          => 'required|string|max:255|unique:blog_pages,slug,' . $blog_page->id,
            'excerpt'       => 'nullable|string',
            'content'       => 'required|string',
            'author_id'     => 'required|exists:users,id',
            'is_published'  => 'required|boolean',
            'published_at'  => 'nullable|date',
            'image'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blog_images', 'public');
            $data['image_url'] = $imagePath;
        }

        $blog_page->update($data);

        return redirect()->route('blog_pages.index')
                         ->with('success', 'Blog post updated successfully.');
    }

    // Delete blog post
    public function destroy(BlogPage $blog_page)
    {
        $blog_page->delete();

        return redirect()->route('blog_pages.index')
                        ->with('success', 'Blog post deleted successfully.');
    }
}
