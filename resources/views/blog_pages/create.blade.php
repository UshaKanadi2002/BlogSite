<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Blog Page</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
        }

        .form-wrapper {
            max-width: 800px;
            margin: 50px auto;
        }

        .card {
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }

        .form-label {
            font-weight: 600;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
        }

        .btn-primary {
            border-radius: 10px;
            padding: 10px 30px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: 600;
        }

        ul {
            list-style-type: disc;
            padding-left: 20px;
        }

        .alert ul {
            margin-bottom: 0;
        }
    </style>
</head>

<body>

    <div class="form-wrapper">
        <h1>Create Blog Post</h1>

        <!-- Show Validation Errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Blog Create Form with Image Upload -->
        <div class="card">
            <form method="POST" action="{{ route('blog_pages.store') }}" enctype="multipart/form-data">
                @csrf
                @method('POST')

                <!-- ✅ Corrected: Author Dropdown -->
                <div class="mb-3">
                    <label for="author_id" class="form-label">Author</label>
                    <select name="author_id" class="form-select" required>
                        <option value="">-- Select Author --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('author_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} (ID: {{ $user->id }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Blog Title"
                        value="{{ old('title') }}" required>
                </div>

                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" name="slug" class="form-control" placeholder="URL Slug" value="{{ old('slug') }}"
                        required>
                </div>

                <div class="mb-3">
                    <label for="excerpt" class="form-label">Excerpt</label>
                    <input type="text" name="excerpt" class="form-control" placeholder="Short summary"
                        value="{{ old('excerpt') }}" required>
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea name="content" class="form-control" placeholder="Full blog content" rows="5"
                        required>{{ old('content') }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="image" class="form-label">Blog Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>

                <div class="mb-3">
                    <label for="is_published" class="form-label">Is Published?</label>
                    <select name="is_published" class="form-select">
                        <option value="1" {{ old('is_published') == '1' ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ old('is_published') == '0' ? 'selected' : '' }}>No</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="published_at" class="form-label">Publish Date</label>
                    <input type="datetime-local" name="published_at" class="form-control"
                        value="{{ old('published_at') }}">
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Add Blog</button>
                </div>
            </form>
        </div>


        <!-- Optional: Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>