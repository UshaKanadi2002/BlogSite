<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>📰 BlogPage - Clean View</title>

    <!-- ✅ Google Roboto Font -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: #ffffff;
            margin: 0;
            padding: 2rem;
            color: #202124;
        }

        h1 {
            text-align: center;
            font-size: 2.8rem;
            font-weight: bold;
            margin-bottom: 2rem;
            border-bottom: 2px solid #e0e0e0;
            padding-bottom: 0.5rem;
        }

        .blog-list {
            display: flex;
            flex-direction: column;
            gap: 40px;
            max-width: 960px;
            margin: 0 auto;
        }

        .card {
            background: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .card img {
            width: 100%;
            height: 260px;
            object-fit: cover;
            border-bottom: 1px solid #e0e0e0;
        }

        .card-content {
            padding: 1.5rem;
        }

        .title {
            font-size: 1.9rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .meta {
            font-size: 0.9rem;
            color: #5f6368;
            margin-bottom: 1rem;
        }

        .content-preview {
            font-size: 1.05rem;
            line-height: 1.7;
            color: #3c4043;
            margin-bottom: 1rem;
        }

        .read-more {
            color: #1a73e8;
            text-decoration: none;
            font-weight: bold;
            cursor: pointer;
        }

        .read-more:hover {
            text-decoration: underline;
        }

        .actions {
            margin-top: 1.2rem;
        }

        .actions a,
        .actions button {
            font-size: 0.9rem;
            text-decoration: none;
            background: none;
            border: none;
            cursor: pointer;
            margin-right: 10px;
        }

        .actions a {
            color: #1a73e8;
        }

        .actions button {
            color: red;
        }

        .success {
            background-color: #e6f4ea;
            color: #137333;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 1.5rem;
            text-align: center;
            max-width: 960px;
            margin-inline: auto;
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background: #f1f3f4;
            padding: 0.7rem;
            text-align: center;
            font-size: 0.9rem;
            border-top: 1px solid #e0e0e0;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 99;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fff;
            margin: 5% auto;
            padding: 2rem;
            border: 1px solid #ccc;
            width: 80%;
            max-width: 800px;
            border-radius: 8px;
        }

        .close {
            float: right;
            font-size: 1.5rem;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <h1>📰 Site where you post you stories </h1>

    @if (session()->has('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    <div class="blog-list">
        @foreach ($blogPages as $page)
            <div class="card">
                @if($page->image_url)
                    <img src="{{ asset('storage/' . $page->image_url) }}" alt="Blog Image">
                @else
                    <p style="padding: 1rem; color: red;">❌ No image available</p>
                @endif

                <div class="card-content">
                    <div class="title">{{ $page->title }}</div>
                    <div class="meta">
                        By {{ $page->author->name ?? 'Anonymous' }} |
                        {{ \Carbon\Carbon::parse($page->published_at)->format('M d, Y') }} |
                        Published: {{ $page->is_published ? '✅ Yes' : '❌ No' }}
                    </div>

                    <div class="content-preview">
                        {{ Str::limit(strip_tags($page->content), 200) }}
                    </div>

                    <span class="read-more" onclick="openModal({{ $page->id }})">Read More →</span>

                    <div class="actions">
                        <a href="{{ route('blog_pages.edit', $page) }}">✏️ Edit</a>
                        <form method="POST" action="{{ route('blog_pages.destroy', $page) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button>🗑️ Delete</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal for Full Content -->
            <div id="modal-{{ $page->id }}" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal({{ $page->id }})">&times;</span>
                    <h2>{{ $page->title }}</h2>
                    <p><em>By {{ $page->author->name ?? 'Anonymous' }} on
                            {{ \Carbon\Carbon::parse($page->published_at)->format('M d, Y') }}</em></p>
                    <hr>
                    <div>{!! nl2br(e($page->content)) !!}</div>
                </div>
            </div>
        @endforeach
    </div>

    <footer>
        &copy; {{ date('Y') }} BlogPage. All rights reserved.
    </footer>

    <!-- JS for modal -->
    <script>
        function openModal(id) {
            document.getElementById('modal-' + id).style.display = 'block';
        }

        function closeModal(id) {
            document.getElementById('modal-' + id).style.display = 'none';
        }

        window.onclick = function (event) {
            document.querySelectorAll('.modal').forEach(modal => {
                if (event.target == modal) modal.style.display = "none";
            });
        }
    </script>

</body>

</html>