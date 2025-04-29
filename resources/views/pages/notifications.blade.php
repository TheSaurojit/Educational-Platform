@extends('layouts.app')

@section('style-section')
    <link rel="stylesheet" href="/css/notifications.css">
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

        <h1 class="page-title">Connection Requests</h1>
        <p class="page-subtitle">Manage your pending connection requests from fellow math enthusiasts.</p>

        <div class="top-actions">
            <a href="/matches">
                <button class="get-matches-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    Get New Matches
                </button>
            </a>
        </div>


        <div id="connections-container">

            @foreach ($requests as $user)
                @php
                    $userId = $user->sender->id;
                    $image = $user->sender->profile->profile_image;
                    $name = $user->sender->name;
                    $interests = $user->sender->profile->mathematical_interests;
                    $achievements = $user->sender->profile->achievements;
                @endphp

                <div class="connection-card">
                    <div class="user-info">
                        <div class="profile-pic">
                            <img src="{{ $image }}" alt="ProfEuler42">
                        </div>
                        <div class="user-details">
                            <h3 class="username">{{ $name }}</h3>
                            <div class="interests">
                                @foreach ($interests as $int)
                                    <div class="interest-tag">{{ $int }}</div>
                                @endforeach


                            </div>
                            {{-- <div class="social-links">
                                <span class="social-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path
                                            d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z">
                                        </path>
                                    </svg>
                                </span>
                                <span class="social-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path
                                            d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z">
                                        </path>
                                        <rect x="2" y="9" width="4" height="12"></rect>
                                        <circle cx="4" cy="4" r="2"></circle>
                                    </svg>
                                </span>
                                <span class="social-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path
                                            d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22">
                                        </path>
                                    </svg>
                                </span>
                            </div> --}}
                            <div class="achievements">{{ $achievements }}</div>

                        </div>
                    </div>
                    <div class="action-buttons">
                        <x-post-button url="{{ route('friend.accept',['senderId' => $userId])}}" label="Accept" class="accept-btn"></x-post-button>
                        <x-post-button url="{{ route('friend.reject',['senderId' => $userId])}}" label="Reject" class="reject-btn"></x-post-button>


                    </div>
                </div>
            @endforeach



            <div class="empty-state" style="display: none;">
                <div class="empty-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
                <h2 class="empty-title">No pending connection requests</h2>
                <p class="empty-text">When fellow math enthusiasts want to connect with you, their requests will appear
                    here.</p>

                <a href="/discover"><button class="find-connections-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        Find New Connections
                    </button>
                </a>
            </div>
        </div>
    </main>
@endsection

@section('script-section')
    <script>
        // Simplified JavaScript for handling accept/reject actions
        function handleRequest(id, action) {
            if (action === 'accept') {
                alert(`Accepted connection request from user ID: ${id}`);
            } else {
                alert(`Rejected connection request from user ID: ${id}`);
            }

            // Find the card to remove
            const card = document.querySelector(`.connection-card:nth-child(${id})`);
            if (card) {
                card.remove();
            }

            // Check if there are any cards left
            const remainingCards = document.querySelectorAll('.connection-card');
            if (remainingCards.length === 0) {
                // Show empty state
                document.querySelector('.empty-state').style.display = 'block';
            }
        }

        // Toggle between empty state and connection requests for demo purposes
        let showConnections = true;

        function toggleConnectionDisplay() {
            const cards = document.querySelectorAll('.connection-card');
            const emptyState = document.querySelector('.empty-state');

            if (showConnections) {
                // Hide all cards
                cards.forEach(card => card.style.display = 'none');
                // Show empty state
                emptyState.style.display = 'block';
            } else {
                // Show all cards
                cards.forEach(card => card.style.display = 'block');
                // Hide empty state
                emptyState.style.display = 'none';
            }
            showConnections = !showConnections;
        }

        // Add event listener to toggle between states (for demonstration)
        document.querySelector('.get-matches-btn').addEventListener('click', toggleConnectionDisplay);
        document.addEventListener('click', event => {
            if (event.target.classList.contains('find-connections-btn')) {
                toggleConnectionDisplay();
            }
        });
    </script>
@endsection
