@extends('layouts.app')

@section('style-section')
    <link rel="stylesheet" href="/css/community.css">
@endsection

@section('body')
    <main class="container">
        <div class="community-header">
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
            <a href="{{ route('create-community') }}" class="create-post-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Create Post
            </a>
        </div>
        <h1 class="page-title">Community</h1>
        <p class="page-subtitle">Share ideas and connect with fellow math enthusiasts.</p>

        <div class="community-feed" id="community-feed">

            @php
                $userId = Auth::id();
                $postData = [];
            @endphp

            @foreach ($posts as $post)
                @php
                    $title = $post?->title;
                    $image = $post?->image;
                    $body = $post?->body;
                    $time = $post?->created_at?->format('d  M , Y');
                    $name = $post?->user?->name;
                    $profile_image = $post?->user?->profile?->profile_image;
                @endphp

                <div class="post-card" data-post-id="{{ $post->id }}">
                    <div class="post-header">
                        <img src="{{ $profile_image }}" alt="{{ $name }}" class="post-author-pic">
                        <div class="post-author-info">
                            <div class="post-author-name">{{ $name }}</div>
                            <div class="post-timestamp">{{ $time }}</div>
                        </div>
                    </div>
                    <!-- Check if post.image exists -->
                    @if ($image)
                        <img src="{{ $image }}" alt="Post image" class="post-image">
                    @endif
                    <div class="post-content">
                        <h3 class="post-content-title">{{ $title }}</h3>
                        <p class="post-content-text">{{ $body }}</p>
                    </div>
                    <div class="post-stats">
                        <div class="post-stat">
                            <svg class="post-stat-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3H14z">
                                </path>
                                <path d="M7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path>
                            </svg>
                            <span class="like-count">{{ $post->likes->count() }}</span> likes
                        </div>
                        <div class="post-stat">
                            <svg class="post-stat-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                            </svg>
                            <span class="comment-count">{{ $post->comments->count() }}</span> comments
                        </div>
                    </div>

                    @php
                        $likesArray = $post->likes->map(fn($like) => $like->user_id);
                    @endphp


                    <div class="post-actions">
                        <div class="post-action {{ $likesArray->contains(Auth::id()) ? 'liked' : '' }} " data-action="like"
                            onclick="toggleLike('{{ $post->id }}')">
                            <svg class="post-action-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3H14z">
                                </path>
                                <path d="M7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path>
                            </svg>
                            Like
                        </div>
                        <div class="post-action" data-action="comment" onclick="toggleComments('{{ $post->id }}')">
                            <svg class="post-action-icon" xmlns="http://www.w3.org/2000/svg" width="18"
                                height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                            </svg>
                            Comment
                        </div>
                    </div>
                </div>

                @php
                    $postData[] = [
                        'id' => $post->id,
                        'likes' => $post->likes->count(),
                        'isLiked' => $likesArray->contains($userId),
                        'comments' => $post->comments
                            ->map(function ($comment) {
                                return [
                                    'id' => $comment->id,
                                    'author' => [
                                        'name' => optional($comment->user)->name ?? 'Unknown',
                                        'profilePic' =>
                                            optional(optional($comment->user)->profile)->profile_image ??
                                            "data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%232563eb' stroke-width='2'><circle cx='12' cy='8' r='5'/><path d='M20 21v-2a7 7 0 0 0-14 0v2'/></svg>",
                                    ],
                                    'text' => $comment->body,
                                    'parentId' => null,
                                    'isReplyFormVisible' => false,
                                ];
                            })
                            ->toArray(),
                    ];
                @endphp
            @endforeach



        </div>
    </main>

    <!-- Comment Modal -->
    <div id="comment-modal" class="comment-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Comments</h2>
                <span class="close-modal">&times;</span>
            </div>
            <div class="modal-body">
                <div id="modal-comments-list" class="comments-list">
                    <!-- Comments will be appended here -->
                    <div class="no-comments" id="no-comments-message">No comments yet. Be the first to comment!</div>
                </div>
                <form id="modal-comment-form" class="comment-form">
                    <input type="text" class="comment-input" placeholder="Write a comment..." required>
                    <button type="submit" class="comment-submit">Send</button>
                </form>
            </div>
        </div>
    </div>

    <!-- HTML Templates (hidden by default) -->
    <template id="comment-template">
        <div class="comment" data-comment-id="">
            <img src="" alt="" class="comment-author-pic">
            <div class="comment-content">
                <div class="comment-author-name"></div>
                <div class="comment-text"></div>
                <!-- Reply functionality removed -->
            </div>
        </div>
    </template>

    <template id="reply-template">
        <div class="reply" data-comment-id="" data-parent-id="">
            <img src="" alt="" class="comment-author-pic reply-author-pic">
            <div class="comment-content">
                <div class="comment-author-name"></div>
                <div class="reply-indicator">Replying to @<span class="parent-author"></span></div>
                <div class="comment-text"></div>
                <div class="comment-actions">
                    <span class="comment-action reply-action">Reply</span>
                </div>
                <div class="reply-form-container" style="display: none;">
                    <form class="reply-form">
                        <input type="text" class="comment-input" placeholder="Write a reply..." required>
                        <button type="submit" class="comment-submit">Reply</button>
                    </form>
                </div>
            </div>
        </div>
    </template>
@endsection

@section('script-section')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get the posts data from the server-side rendered variable


            const userId = "<?= Auth::user()->id ?>";

            const userName = "<?= Auth::user()->name ?>";
            const userProfilePic = "<?= Auth::user()->profile->profile_image ?>";


            // Create a consistent posts data structure
            // const posts = rawPosts.map(post => ({
            //     id: post.id,
            //     likes: post.likes ? post.likes.length : 0,
            //     isLiked: Array.isArray(post.likes) && post.likes.some(like => like.user_id === userId),
            //     comments: Array.isArray(post.comments) ? post.comments.map(comment => ({
            //         id: comment.id,
            //         author: {
            //             name: comment.user?.name || "Unknown",
            //             profilePic: comment.user?.profile?.profile_image ||
            //                 "data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%232563eb' stroke-width='2'><circle cx='12' cy='8' r='5'/><path d='M20 21v-2a7 7 0 0 0-14 0v2'/></svg>"
            //         },
            //         text: comment.body,
            //         parentId: null, // Add support for reply hierarchy
            //         isReplyFormVisible: false
            //     })) : []
            // }));


            const posts = @json($postData);


            // Get modal elements
            const modal = document.getElementById('comment-modal');
            const closeModalBtn = document.querySelector('.close-modal');
            const commentsList = document.getElementById('modal-comments-list');
            const commentForm = document.getElementById('modal-comment-form');
            const noCommentsMessage = document.getElementById('no-comments-message');

            // Get template elements
            const commentTemplate = document.getElementById('comment-template');
            const replyTemplate = document.getElementById('reply-template');

            // Event listeners for modal
            closeModalBtn.addEventListener('click', function() {
                modal.style.display = 'none';
            });

            window.addEventListener('click', function(event) {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });

            //send comment to backend
            function sendComment(postId, comment) {
                fetch("{{ route('add-comment') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '<?= csrf_token() ?>'
                        },
                        body: JSON.stringify({
                            post_id: postId,
                            comment: comment,
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        // console.log('Response:', data);
                    })
                    .catch(err => console.log(err));

            }

            //send like to backend
            function sendLike(postId) {
                fetch("{{ route('add-like') }}", {
                    method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '<?= csrf_token() ?>'
                        },
                        body: JSON.stringify({
                            post_id: postId,
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        // console.log('Response:', data);
                    })
                    .catch(err => console.log(err));

            }

            // Comment helper functions
            function createComment(id, author, text, parentId = null) {
                return {
                    id: id,
                    author: author,
                    text: text,
                    parentId: parentId,
                    isReplyFormVisible: false
                };
            }

            // Function to render comments using HTML templates
            function renderComments(comments) {
                // Clear existing comments
                while (commentsList.firstChild) {
                    commentsList.removeChild(commentsList.firstChild);
                }

                if (comments.length === 0) {
                    noCommentsMessage.style.display = 'block';
                    return;
                }

                noCommentsMessage.style.display = 'none';

                // Filter top-level comments (those without a parentId)
                const topLevelComments = comments.filter(comment => !comment.parentId);

                // For each top level comment
                topLevelComments.forEach(comment => {
                    // Clone comment template
                    const commentNode = commentTemplate.content.cloneNode(true);
                    const commentElement = commentNode.querySelector('.comment');

                    // Set comment data
                    commentElement.dataset.commentId = comment.id;
                    commentElement.querySelector('img').src = comment.author.profilePic;
                    commentElement.querySelector('img').alt = comment.author.name;
                    commentElement.querySelector('.comment-author-name').textContent = comment.author
                        .name;
                    commentElement.querySelector('.comment-text').textContent = comment.text;

                    // Set up reply button - handle missing reply button in template
                    const replyButton = commentElement.querySelector('.reply-action');
                    if (replyButton) {
                        replyButton.onclick = function() {
                            toggleReplyForm(comment.id);
                        };
                    }

                    // Add comment to DOM
                    commentsList.appendChild(commentElement);

                    // Find all replies for this comment
                    const replies = comments.filter(c => c.parentId === comment.id);

                    // Add replies (keeping it simpler - just direct replies for now)
                    replies.forEach(reply => {
                        // Clone reply template
                        const replyNode = replyTemplate.content.cloneNode(true);
                        const replyElement = replyNode.querySelector('.reply');

                        // Set reply data
                        replyElement.dataset.commentId = reply.id;
                        replyElement.dataset.parentId = reply.parentId;
                        replyElement.querySelector('img').src = reply.author.profilePic;
                        replyElement.querySelector('img').alt = reply.author.name;
                        replyElement.querySelector('.comment-author-name').textContent = reply
                            .author.name;

                        // Find parent comment author name
                        const parentComment = comments.find(c => c.id === reply.parentId);
                        const parentAuthor = parentComment ? parentComment.author.name :
                            "Unknown";

                        const parentAuthorSpan = replyElement.querySelector('.parent-author');
                        if (parentAuthorSpan) {
                            parentAuthorSpan.textContent = parentAuthor;
                        }

                        replyElement.querySelector('.comment-text').textContent = reply.text;

                        // Set up reply button
                        const replyButton = replyElement.querySelector('.reply-action');
                        if (replyButton) {
                            replyButton.onclick = function() {
                                toggleReplyForm(reply.id);
                            };
                        }

                        // Add reply to DOM
                        commentsList.appendChild(replyElement);
                    });
                });

                // Set up reply forms
                comments.forEach(comment => {
                    if (comment.isReplyFormVisible) {
                        const commentElement = commentsList.querySelector(
                            `[data-comment-id="${comment.id}"]`);
                        if (commentElement) {
                            const replyFormContainer = commentElement.querySelector(
                                '.reply-form-container');
                            if (replyFormContainer) {
                                replyFormContainer.style.display = 'block';

                                // Set up form submission
                                const replyForm = replyFormContainer.querySelector('.reply-form');
                                if (replyForm) {
                                    replyForm.onsubmit = function(event) {
                                        event.preventDefault();
                                        addReply(event, comment.id);
                                    };
                                }
                            }
                        }
                    }
                });
            }

            // Helper function to find comment author name
            function findCommentAuthorName(comments, commentId) {
                const comment = comments.find(c => c.id === commentId);
                return comment ? comment.author.name : "Unknown";
            }

            // Define global like toggling function
            window.toggleLike = function(postId) {
                const post = posts.find(p => p.id == postId);
                if (post) {
                    post.isLiked = !post.isLiked;
                    post.likes += post.isLiked ? 1 : -1;
                    updatePostStats(postId, post);


                    sendLike(postId);
                    // Here you would make an AJAX call to update likes on the server
                    // console.log(`Post ${postId} like toggled. New likes count: ${post.likes}`);
                }
            };

            // Define global comments toggling function
            window.toggleComments = function(postId) {
                // console.log("Opening comments for post:", postId);

                // Find post by ID
                const post = posts.find(p => p.id == postId);

                if (post) {
                    // Set the current post ID as a data attribute
                    commentForm.dataset.postId = postId;

                    // Render comments using templates
                    renderComments(post.comments);

                    // Display modal
                    modal.style.display = 'flex';

                    // Set up submit event handler for adding comments
                    commentForm.onsubmit = function(event) {
                        event.preventDefault();
                        addComment(event, postId);
                    };
                } else {
                    console.error("Post not found with ID:", postId);
                }
            };

            // Function to update post statistics display
            function updatePostStats(postId, post) {
                const postElement = document.querySelector(`.post-card[data-post-id="${postId}"]`);
                if (postElement) {
                    // Update like count
                    const likeCountElement = postElement.querySelector('.like-count');
                    if (likeCountElement) {
                        likeCountElement.textContent = post.likes;
                    }

                    // Update like button appearance
                    const likeButton = postElement.querySelector('.post-action[data-action="like"]');
                    if (likeButton) {
                        if (post.isLiked) {
                            likeButton.classList.add('liked');
                            const svg = likeButton.querySelector('svg');
                            if (svg) {
                                svg.setAttribute('fill', '#2563eb');
                            }
                        } else {
                            likeButton.classList.remove('liked');
                            const svg = likeButton.querySelector('svg');
                            if (svg) {
                                svg.setAttribute('fill', 'none');
                            }
                        }
                    }
                }
            }

            // Helper function to find a comment by ID
            function findCommentById(comments, commentId) {
                return comments.find(comment => comment.id == commentId);
            }

            // Function to toggle the reply form
            window.toggleReplyForm = function(commentId) {
                let commentFound = false;

                // Find which post this comment belongs to
                for (const post of posts) {
                    // Find the comment in the flat structure
                    const comment = findCommentById(post.comments, commentId);
                    if (comment) {
                        commentFound = true;
                        comment.isReplyFormVisible = !comment.isReplyFormVisible;
                        // Update the UI
                        renderComments(post.comments);
                        break;
                    }
                }

                if (!commentFound) {
                    console.error("Comment not found with ID:", commentId);
                }
            };

            // Function to add a reply to a comment
            window.addReply = function(event, parentCommentId) {
                event.preventDefault();
                const replyInput = event.target.querySelector('.comment-input');
                const replyText = replyInput.value.trim();

                if (replyText) {
                    // Find which post this comment belongs to
                    for (const post of posts) {
                        const parentComment = findCommentById(post.comments, parentCommentId);

                        if (parentComment) {
                            // Create a new reply comment
                            const newReply = createComment(
                                Date.now(), // Use timestamp as ID
                                {
                                    name: "You",
                                    profilePic: "data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%232563eb' stroke-width='2'><circle cx='12' cy='8' r='5'/><path d='M20 21v-2a7 7 0 0 0-14 0v2'/></svg>"
                                },
                                replyText,
                                parentCommentId
                            );

                            // Add the reply to the post's comments array
                            post.comments.push(newReply);

                            // Close the reply form
                            parentComment.isReplyFormVisible = false;

                            // Clear the input and refresh the view
                            replyInput.value = '';

                            // Update the UI
                            renderComments(post.comments);

                            // Update comment count in post
                            updateCommentCount(post);


                            // Here you would make an AJAX call to save the reply on the server
                            // console.log(`Added reply to comment ${parentCommentId}: ${replyText}`);
                            return;
                        }
                    }
                }
            };

            // Function to add a new comment
            window.addComment = function(event, postId) {
                event.preventDefault();
                const commentInput = event.target.querySelector('.comment-input');
                const commentText = commentInput.value.trim();

                if (commentText) {
                    const post = posts.find(p => p.id == postId);
                    if (post) {
                        const newComment = createComment(
                            Date.now(), // Use timestamp as ID
                            {
                                name: userName,
                                profilePic: userProfilePic
                            },
                            commentText
                        );

                        post.comments.push(newComment);
                        commentInput.value = '';

                        // Update the UI
                        renderComments(post.comments);

                        // Update comment count in post
                        updateCommentCount(post);

                        //send data to backend
                        sendComment(postId, commentText)


                        // Here you would make an AJAX call to save the comment on the server
                    }
                }
            };

            // Function to update comment count in post display
            function updateCommentCount(post) {
                const postElement = document.querySelector(`.post-card[data-post-id="${post.id}"]`);
                if (postElement) {
                    const commentCountElement = postElement.querySelector('.comment-count');
                    if (commentCountElement) {
                        commentCountElement.textContent = post.comments.length;
                    }
                }
            }

            // Add CSS for highlighting liked posts
            const style = document.createElement('style');
            style.textContent = `
        .post-action.liked {
            color: #2563eb;
            font-weight: bold;
        }
    `;
            document.head.appendChild(style);
        });
    </script>
@endsection
