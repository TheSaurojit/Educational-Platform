@extends('layouts.app')

@section('style-section')
    <link rel="stylesheet" href="/css/create_post.css">
@endsection

@section('body')
    <main class="container">
        <a href="/" class="back-link">
            <span class="back-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
            </span>
            Back to Home
        </a>

        <h1 class="page-title">Community</h1>
        <p class="page-subtitle">Share ideas and connect with fellow math enthusiasts.</p>

        <!-- Post Creation Section -->
        <div class="create-post-container">
            <div class="create-post-header">
                <h2 class="create-post-title">Create a Post</h2>
            </div>
            <form action="{{ route('create-community') }} " method="POST" enctype="multipart/form-data"
                class="create-post-form" id="create-post-form">

                @csrf

                <input type="text" name="title" class="post-input" id="post-title" placeholder="Post title" required>
                <textarea class="post-input post-textarea" id="post-content"
                    placeholder="Share your mathematical insights, questions, or interesting discoveries..." name="body"  required></textarea>
                <div class="file-upload">
                    <input type="file" name="image" id="post-image" class="file-upload-input" accept="image/*"
                        onchange="previewImage(this)">
                    <label for="post-image" class="file-upload-label">
                        <svg class="upload-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                            <polyline points="21 15 16 10 5 21"></polyline>
                        </svg>
                        Add Image
                    </label>
                </div>
                <div class="image-upload-container" id="image-container">
                    <div class="remove-image-btn" onclick="removeImage()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </div>
                    <img id="image-preview" class="image-preview" src="#" alt="Preview">
                </div>
                <button type="submit" class="post-btn">Post</button>
            </form>
        </div>
    </main>
@endsection

@section('script-section')
    <script>
        // Function to preview the image before posting
        function previewImage(input) {
            const container = document.getElementById('image-container');
            const preview = document.getElementById('image-preview');
            const file = input.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    container.classList.add('visible');
                }
                reader.readAsDataURL(file);
            }
        }
        // Function to remove the image
        function removeImage() {
            const container = document.getElementById('image-container');
            const preview = document.getElementById('image-preview');
            const fileInput = document.getElementById('post-image');

            // Clear the file input
            fileInput.value = '';

            // Hide the container
            container.classList.remove('visible');

            // Clear the preview
            preview.src = '#';
        }
        document.getElementById('post-image').addEventListener('change', function() {
            previewImage(this);
        });
    </script>
@endsection
