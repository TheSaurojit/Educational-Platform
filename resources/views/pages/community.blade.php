@extends('layouts.app')

@section('style-section')
  <link rel="stylesheet" href="/css/community.css">
@endsection

@section('body')
<main class="container">
    <div class="community-header">
    <a href="/" class="back-link">
        <span class="back-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
        </span>
        Back to Home
    </a>
    <a href="/createpost" class="create-post-btn">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="12" y1="5" x2="12" y2="19"></line>
            <line x1="5" y1="12" x2="19" y2="12"></line>
        </svg>
        Create Post
    </a>
    </div>
    <h1 class="page-title">Community</h1>
    <p class="page-subtitle">Share ideas and connect with fellow math enthusiasts.</p>

    <div class="community-feed" id="community-feed">
       
    </div>
</main>
@endsection

@section('script-section')
<script>
    // Sample data for community posts
    const posts = [
        {
            id: 1,
            author: {
                name: "ProfEuler42",
                profilePic: "data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%232563eb' stroke-width='2'><circle cx='12' cy='8' r='5'/><path d='M20 21v-2a7 7 0 0 0-14 0v2'/></svg>"
            },
            timestamp: "2 hours ago",
            title: "Fascinating Connection Between Fibonacci and Nature",
            content: "I've been exploring the golden ratio in natural patterns and found some incredible examples of Fibonacci sequences in sunflower seed arrangements. Check out this image showing the spiral patterns - they follow the sequence perfectly!",
            image: "/api/placeholder/800/500",
            likes: 42,
            comments: [
                {
                    id: 1,
                    author: {
                        name: "MathWhiz",
                        profilePic: "data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%232563eb' stroke-width='2'><circle cx='12' cy='8' r='5'/><path d='M20 21v-2a7 7 0 0 0-14 0v2'/></svg>"
                    },
                    text: "Amazing observation! I've been studying this phenomenon in my research as well. The golden angle (approx. 137.5°) is key to this pattern formation."
                },
                {
                    id: 2,
                    author: {
                        name: "GeometryLover",
                        profilePic: "data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%232563eb' stroke-width='2'><circle cx='12' cy='8' r='5'/><path d='M20 21v-2a7 7 0 0 0-14 0v2'/></svg>"
                    },
                    text: "Have you also looked at pine cones and pineapples? They show the same pattern with consecutive Fibonacci numbers in their spiral counts!"
                }
            ],
            isLiked: false,
            commentsVisible: false
        },
        {
            id: 2,
            author: {
                name: "CalculusQueen",
                profilePic: "data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%232563eb' stroke-width='2'><circle cx='12' cy='8' r='5'/><path d='M20 21v-2a7 7 0 0 0-14 0v2'/></svg>"
            },
            timestamp: "Yesterday",
            title: "Elegant Solution to the Basel Problem",
            content: "I've been revisiting Euler's solution to the Basel problem (finding the exact sum of the reciprocals of the squares of natural numbers). The connection to π² is simply beautiful! Here's my visualization of the proof using Fourier analysis.",
            image: "/api/placeholder/800/400",
            likes: 37,
            comments: [
                {
                    id: 3,
                    author: {
                        name: "AnalysisNerd",
                        profilePic: "data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%232563eb' stroke-width='2'><circle cx='12' cy='8' r='5'/><path d='M20 21v-2a7 7 0 0 0-14 0v2'/></svg>"
                    },
                    text: "Euler was truly ahead of his time. Using the Fourier series approach makes this so much clearer!"
                }
            ],
            isLiked: true,
            commentsVisible: false
        }
    ];

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

    // Function to convert existing comments to new format
    function convertExistingComments() {
        posts.forEach(post => {
            post.comments = post.comments.map(comment => {
                return createComment(
                    comment.id,
                    comment.author,
                    comment.text
                );
            });
        });
    }

    // Function to render all posts
    function renderPosts() {
        const feedContainer = document.getElementById('community-feed');
        feedContainer.innerHTML = '';

        posts.forEach(post => {
            const postElement = document.createElement('div');
            postElement.className = 'post-card';
            postElement.innerHTML = `
                <div class="post-header">
                    <img src="${post.author.profilePic}" alt="${post.author.name}" class="post-author-pic">
                    <div class="post-author-info">
                        <div class="post-author-name">${post.author.name}</div>
                        <div class="post-timestamp">${post.timestamp}</div>
                    </div>
                </div>
                ${post.image ? `<img src="${post.image}" alt="Post image" class="post-image">` : ''}
                <div class="post-content">
                    <h3 class="post-content-title">${post.title}</h3>
                    <p class="post-content-text">${post.content}</p>
                </div>
                <div class="post-stats">
                    
                  
                </div>
                <div class="post-actions">
                 
                  
                </div>
                <div class="post-comments ${post.commentsVisible ? 'comments-visible' : ''}">
                    <form class="comment-form" onsubmit="addComment(event, ${post.id})">
                        <input type="text" class="comment-input" placeholder="Write a comment..." required>
                        <button type="submit" class="comment-submit">Send</button>
                    </form>
                    <div class="comments-list">
                        ${renderComments(post.comments)}
                    </div>
                </div>
            `;
            feedContainer.appendChild(postElement);
        });
    }

    function renderComments(comments) {
        if (comments.length === 0) {
            return `<div class="no-comments">No comments yet. Be the first to comment!</div>`;
        }

        // Filter top-level comments (those without a parentId)
        const topLevelComments = comments.filter(comment => !comment.parentId);

        let commentHTML = '';

        // For each top level comment
        topLevelComments.forEach(comment => {
            // Add the comment
            commentHTML += `
                <div class="comment" data-comment-id="${comment.id}">
                    <img src="${comment.author.profilePic}" alt="${comment.author.name}" class="comment-author-pic">
                    <div class="comment-content">
                        <div class="comment-author-name">${comment.author.name}</div>
                        <div class="comment-text">${comment.text}</div>
                        <div class="comment-actions">
                            <span class="comment-action" onclick="toggleReplyForm(${comment.id})">Reply</span>
                        </div>
                        ${comment.isReplyFormVisible ? 
                            `<form class="reply-form" onsubmit="addReply(event, ${comment.id})">
                                <input type="text" class="comment-input" placeholder="Write a reply..." required>
                                <button type="submit" class="comment-submit">Reply</button>
                            </form>` : ''
                        }
                    </div>
                </div>
            `;
            
            // Find all replies for this comment, direct and indirect (all descendants)
            const getAllDescendantReplies = (commentId) => {
                // Get direct replies
                const directReplies = comments.filter(c => c.parentId === commentId);
                
                // For each direct reply, get its replies recursively
                let allReplies = [...directReplies];
                directReplies.forEach(reply => {
                    const childReplies = getAllDescendantReplies(reply.id);
                    allReplies = [...allReplies, ...childReplies];
                });
                
                return allReplies;
            };
            
            // Get all replies for this comment in flattened order
            const allReplies = getAllDescendantReplies(comment.id);
            
            // Sort replies by timestamp or ID to ensure proper order
            // Assuming newer replies (higher IDs) should appear below older ones
            allReplies.sort((a, b) => a.id - b.id);
            
            // Add all replies sequentially
            allReplies.forEach(reply => {
                commentHTML += `
                    <div class="reply" data-comment-id="${reply.id}" data-parent-id="${reply.parentId}">
                        <img src="${reply.author.profilePic}" alt="${reply.author.name}" class="comment-author-pic reply-author-pic">
                        <div class="comment-content">
                            <div class="comment-author-name">${reply.author.name}</div>
                            <div class="reply-indicator">Replying to @${findCommentAuthorName(comments, reply.parentId)}</div>
                            <div class="comment-text">${reply.text}</div>
                            <div class="comment-actions">
                                <span class="comment-action" onclick="toggleReplyForm(${reply.id})">Reply</span>
                            </div>
                            ${reply.isReplyFormVisible ? 
                                `<form class="reply-form" onsubmit="addReply(event, ${reply.id})">
                                    <input type="text" class="comment-input" placeholder="Write a reply..." required>
                                    <button type="submit" class="comment-submit">Reply</button>
                                </form>` : ''
                            }
                        </div>
                    </div>
                `;
            });
        });

        return commentHTML;
    }

    function findCommentAuthorName(comments, commentId) {
        const comment = comments.find(c => c.id === commentId);
        return comment ? comment.author.name : "Unknown";
    }

    // Function to toggle like on a post
    window.toggleLike = function(postId) {
        const post = posts.find(p => p.id === postId);
        if (post) {
            post.isLiked = !post.isLiked;
            post.likes += post.isLiked ? 1 : -1;
            renderPosts();
        }
    }

    // Function to toggle comments visibility
    window.toggleComments = function(postId) {
        const post = posts.find(p => p.id === postId);
        if (post) {
            post.commentsVisible = !post.commentsVisible;
            renderPosts();
        }
    }

    // Helper function to find a comment by ID (in flat structure)
    function findCommentById(comments, commentId) {
        return comments.find(comment => comment.id === commentId);
    }

    // Function to toggle the reply form
    window.toggleReplyForm = function(commentId) {
        // Find the comment in all posts
        for (const post of posts) {
            // Find the comment in the flat structure
            const comment = findCommentById(post.comments, commentId);
            if (comment) {
                comment.isReplyFormVisible = !comment.isReplyFormVisible;
                renderPosts();
                return;
            }
        }
    }

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
                        Date.now(),
                        {
                            name: "You",
                            profilePic: "data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%232563eb' stroke-width='2'><circle cx='12' cy='8' r='5'/><path d='M20 21v-2a7 7 0 0 0-14 0v2'/></svg>"
                        },
                        replyText,
                        parentCommentId
                    );
                    
                    // Add the reply to the post's comments array (flat structure)
                    post.comments.push(newReply);
                    
                    // Close the reply form
                    parentComment.isReplyFormVisible = false;
                    
                    // Clear the input and refresh the view
                    replyInput.value = '';
                    renderPosts();
                    return;
                }
            }
        }
    }

    // Function to add a new comment
    window.addComment = function(event, postId) {
        event.preventDefault();
        const commentInput = event.target.querySelector('.comment-input');
        const commentText = commentInput.value.trim();
        
        if (commentText) {
            const post = posts.find(p => p.id === postId);
            if (post) {
                const newComment = createComment(
                    Date.now(),
                    {
                        name: "You",
                        profilePic: "data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%232563eb' stroke-width='2'><circle cx='12' cy='8' r='5'/><path d='M20 21v-2a7 7 0 0 0-14 0v2'/></svg>"
                    },
                    commentText
                );
                
                post.comments.push(newComment);
                commentInput.value = '';
                renderPosts();
            }
        }
    }

    // Initialize the feed when the page loads
    document.addEventListener('DOMContentLoaded', function() {
        convertExistingComments(); // Convert existing comments to the new format
        renderPosts(); // Render all posts

        window.addEventListener('resize', function() {
            // You might need to re-render or adjust UI elements on resize
            // This depends on your specific requirements
        });
    });
</script>
@endsection