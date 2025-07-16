<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog Post</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
        }

        .card {
            border-radius: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .form-label {
            font-weight: 500;
        }

        .form-control,
        .form-select {
            border-radius: 12px;
        }

        .btn-primary {
            border-radius: 12px;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="mb-4 text-center">✏️ Edit Blog Post</h2>

                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Card UI Form -->
                <div class="card p-4">
                    <form method="POST" action="{{ route('blog_pages.update', $blog->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" class="form-control"
                                value="{{ old('title', $blog->title) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" name="slug" class="form-control" value="{{ old('slug', $blog->slug) }}"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="excerpt" class="form-label">Excerpt</label>
                            <input type="text" name="excerpt" class="form-control"
                                value="{{ old('excerpt', $blog->excerpt) }}">
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Content</label>
                            <textarea name="content" class="form-control" rows="5"
                                required>{{ old('content', $blog->content) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="author_id" class="form-label">Author ID</label>
                            <input type="number" name="author_id" class="form-control"
                                value="{{ old('author_id', $blog->author_id) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="is_published" class="form-label">Is Published?</label>
                            <select name="is_published" class="form-select">
                                <option value="1" {{ old('is_published', $blog->is_published) == 1 ? 'selected' : '' }}>
                                    Yes</option>
                                <option value="0" {{ old('is_published', $blog->is_published) == 0 ? 'selected' : '' }}>No
                                </option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="published_at" class="form-label">Publish Date</label>
                            <input type="datetime-local" name="published_at" class="form-control"
                                value="{{ old('published_at', \Carbon\Carbon::parse($blog->published_at)->format('Y-m-d\TH:i')) }}">
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary px-5">Update Blog</button>
                        </div>
                    </form>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('blog_pages.index') }}" class="text-decoration-none">← Back to Blog List</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (optional if not using JS features) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>