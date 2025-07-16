<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Blog</title>
</head>

<body>
    <h1>Create a Blog Post</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('blog_pages.store') }}">
        @csrf

        <div>
            <label for="title">Title:</label>
            <input type="text" name="title" placeholder="Title" value="{{ old('title') }}" required>
        </div>

        <div>
            <label for="content">Content:</label>
            <textarea name="content" placeholder="Write your blog content here..."
                required>{{ old('content') }}</textarea>
        </div>

        <div>
            <label for="author_name">Author Name:</label>
            <input type="text" name="author_name" placeholder="Author Name" value="{{ old('author_name') }}" required>
        </div>

        <div>
            <label for="published_date">Published Date:</label>
            <input type="date" name="published_date" value="{{ old('published_date') }}" required>
        </div>

        <div>
            <label for="status">Status (e.g., Draft/Published):</label>
            <input type="text" name="status" value="{{ old('status') }}" required>
        </div>

        <div>
            <button type="submit">Add Blog Post</button>
        </div>
    </form>
</body>

</html>