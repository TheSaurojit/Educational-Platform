@extends('layouts.app')

@section('style-section')
    <link rel="stylesheet" href="/css/matches.css">
@endsection

@section('body')
    <main class="container">
        <a href="/" class="back-link">
            <span class="back-icon">←</span> Back to Home
        </a>

        <h1 class="page-title">Mathematical Connections</h1>
        <p class="page-subtitle">Discover and connect with math enthusiasts who share your interests.</p>

        <div class="tabs">
            <div class="tab" id="potential-tab">Potential Matches</div>
            <div class="tab active" id="your-tab">Your Matches</div>
        </div>

        <div class="search-filter">
            <div class="search-bar">
                <span class="search-icon">🔍</span>
                <input type="text" class="search-input" id="search-input" placeholder="Search matches...">
            </div>
            <button class="filter-btn" id="filter-btn">
                <span class="filter-icon">≡</span> Filter by Interest
            </button>

            <!-- Filter Dropdown -->
            <div class="filter-dropdown" id="filter-dropdown">
                <div class="dropdown-arrow"></div>
                <h3 style="margin-top: 0; margin-bottom: 15px; font-size: 18px;">Math Interests</h3>
                <button class="clear-filter-btn" id="clear-filter-btn">Clear Filter</button>

                <div class="interests-container">
                    @foreach ([ "Number Theory",
                    "Abstract Algebra",
                    "Calculus",
                    "Real Analysis",
                    "Complex Analysis",
                    "Topology",
                    "Differential Geometry",
                    "Linear Algebra",
                    "Combinatorics",
                    "Graph Theory",
                    "Probability Theory",
                    "Statistics",
                    "Applied Mathematics",
                    "Mathematical Physics",
                    "Mathematical Logic"] as $interest)
                        <div class="interest-pill" data-interest="{{ $interest }}">{{ $interest }}</div>
                    @endforeach
                </div>
            </div>
        </div>


        <div id="potential-matches-content" style="display: none;">

            @foreach ($NotYourMatches as $user)
                @php
                    $url = route('others.profile', ['userId' => $user->id]);
                    $userId = $user->id;
                    $image = $user->profile->profile_image;
                    $name = $user->name;
                    $interests = $user->profile->mathematical_interests;
                    $achievements = $user->profile->achievements;

                @endphp

                <a href="{{ $url }}">

                    <div class="mathematician-card">
                        <img src="{{ $image }}" alt="Sophia Chen" class="mathematician-photo">
                        <div class="mathematician-info">
                            <h2 class="mathematician-name">{{ $name }}</h2>
                            <p class="mathematician-bio">
                                {{ $achievements }}
                            </p>

                            <p class="interests-label">Interests:</p>
                            <div class="interests-tags">
                                @foreach ($interests as $int)
                                    <div class="interest-tag">{{ $int }}</div>
                                @endforeach

                            </div>

                            <x-post-button url="{{ route('friend.send', ['receiverId' => $userId]) }}" label="Send Request"
                                class="connect-btn">

                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="8.5" cy="7" r="4"></circle>
                                    <line x1="20" y1="8" x2="20" y2="14"></line>
                                    <line x1="23" y1="11" x2="17" y2="11"></line>
                                </svg>
                            </x-post-button>

                        </div>
                    </div>

                </a>
            @endforeach


            <div class="match-card-empty" id="potential-empty-state" style="display: none;">
                <h2 class="empty-message">No potential matches found</h2>
            </div>
        </div>

        <div id="matches-container">

            <div id="your-matches-content">

                @foreach ($YourMatches as $user)
                    @php
                        $url = route('others.profile', ['userId' => $user->id]);

                        $userId = $user->id;
                        $image = $user->profile->profile_image;
                        $name = $user->name;
                        $interests = $user->profile->mathematical_interests;
                        $achievements = $user->profile->achievements;

                    @endphp

                    <a href="{{ $url }}">

                        <div class="match-card">
                            <img src="{{ $image }}" class="profile-image" alt="Profile picture">
                            <div class="profile-info">
                                <h2 class="profile-name">{{ $name }}</h2>
                                {{-- <p class="matched-on">Matched on <a href="#" class="match-tag">Number Theory</a></p> --}}
                                <p class="profile-description">
                                    {{ $achievements }}

                                </p>
                                <p class="interests-title">All Interests:</p>
                                <div class="interest-tags">
                                    @foreach ($interests as $int)
                                        <span class="interest-tag">{{ $int }}</span>
                                    @endforeach
                                </div>
                                <div class="match-footer">
                                {{-- <div class="date">Apr 12, 2023</div>
                                <div class="message-count">
                                    <span class="message-icon">💬</span> 2 messages
                                </div>
                                <a href="{{ route('chat',['user'=>$userId])}}">
                                    <button class="chat-now-btn">
                                        <span class="chat-icon">💬</span> Chat Now
                                    </button>
                                </a> --}}
                            </div>
                            </div>
                        </div>
                    </a>
                @endforeach


            </div>

            <!-- Potential Matches Content (Empty State) -->
            <div id="potential-matches-content" style="display: none;">
                <div class="match-card-empty">
                    <div class="profile-icon">👤</div>
                    <h2 class="empty-message">No potential matches found</h2>
                    <p class="empty-description">
                        Try adjusting your filter criteria or add more interests to your profile
                    </p>
                </div>
            </div>


            <div id="no-matches-content" style="display: none;">
                <div class="match-card-empty">
                    <div class="profile-icon">🔍</div>
                    <h2 class="empty-message">No matches found</h2>
                    <p class="empty-description">
                        Try adjusting your filter criteria or search terms
                    </p>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script-section')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // DOM Elements
            const potentialTab = document.getElementById('potential-tab');
            const yourTab = document.getElementById('your-tab');
            const searchInput = document.getElementById('search-input');
            const filterBtn = document.getElementById('filter-btn');
            const filterDropdown = document.getElementById('filter-dropdown');
            const clearFilterBtn = document.getElementById('clear-filter-btn');
            const interestPills = document.querySelectorAll('.interest-pill');
            const yourMatchesContent = document.getElementById('your-matches-content');
            const potentialMatchesContent = document.getElementById('potential-matches-content');
            const noMatchesContent = document.getElementById('no-matches-content');

            // Track active tab
            let activeTab = 'your';

            // Tab switching
            potentialTab.addEventListener('click', function() {
                if (activeTab !== 'potential') {
                    activeTab = 'potential';
                    potentialTab.classList.add('active');
                    yourTab.classList.remove('active');

                    // Show potential matches content
                    potentialMatchesContent.style.display = 'block';
                    yourMatchesContent.style.display = 'none';
                    noMatchesContent.style.display = 'none';

                    // Reset search and filters
                    searchInput.value = '';
                    clearFilters();
                }
            });

            yourTab.addEventListener('click', function() {
                if (activeTab !== 'your') {
                    activeTab = 'your';
                    yourTab.classList.add('active');
                    potentialTab.classList.remove('active');

                    // Show your matches content
                    yourMatchesContent.style.display = 'block';
                    potentialMatchesContent.style.display = 'none';
                    noMatchesContent.style.display = 'none';

                    // Reset search and filters
                    searchInput.value = '';
                    clearFilters();
                }
            });

            // Filter dropdown toggle
            filterBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                filterDropdown.style.display = filterDropdown.style.display === 'block' ? 'none' : 'block';
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!filterDropdown.contains(e.target) && e.target !== filterBtn) {
                    filterDropdown.style.display = 'none';
                }
            });

            // Interest pill selection
            interestPills.forEach(pill => {
                pill.addEventListener('click', function() {
                    this.classList.toggle('active');

                    if (this.classList.contains('active')) {
                        this.style.backgroundColor = '#e6f4ff';
                        this.style.color = '#1677ff';
                        this.style.border = '1px solid #1677ff';
                    } else {
                        this.style.backgroundColor = '#f5f5f5';
                        this.style.color = '#333';
                        this.style.border = '1px solid transparent';
                    }

                    updateFilterDisplay();
                    filterMatches();
                });
            });

            // Clear filters
            clearFilterBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                clearFilters();
            });

            // Search functionality
            searchInput.addEventListener('input', function() {
                filterMatches();
            });

            // Function to update filter button text
            function updateFilterDisplay() {
                const selectedInterests = document.querySelectorAll('.interest-pill.active');
                const activeFilters = selectedInterests.length > 0;

                if (activeFilters) {
                    filterBtn.innerHTML =
                        `<span class="filter-icon">≡</span> Filters (${selectedInterests.length})`;
                    filterBtn.style.backgroundColor = '#1677ff';
                    filterBtn.style.color = 'white';
                } else {
                    filterBtn.innerHTML = `<span class="filter-icon">≡</span> Filter by Interest`;
                    filterBtn.style.backgroundColor = '';
                    filterBtn.style.color = '';
                }
            }

            // Function to clear all filters
            function clearFilters() {
                const activePills = document.querySelectorAll('.interest-pill.active');
                activePills.forEach(pill => {
                    pill.classList.remove('active');
                    pill.style.backgroundColor = '#f5f5f5';
                    pill.style.color = '#333';
                    pill.style.border = '1px solid transparent';
                });

                updateFilterDisplay();
                filterMatches();
            }

            // Function to filter matches based on search and selected interests
            // Function to filter matches based on search and selected interests
            function filterMatches() {
                const searchTerm = searchInput.value.toLowerCase();
                const selectedInterests = Array.from(
                    document.querySelectorAll('.interest-pill.active')
                ).map(pill => pill.dataset.interest);

                // Get the appropriate content container based on active tab
                const contentContainer = activeTab === 'your' ? yourMatchesContent : potentialMatchesContent;
                const emptyStateElement = activeTab === 'your' ? noMatchesContent :
                    document.getElementById('potential-empty-state');

                // Select all cards in the active container
                const allCards = activeTab === 'your' ?
                    contentContainer.querySelectorAll('.match-card') :
                    contentContainer.querySelectorAll('.mathematician-card');

                let visibleCardsCount = 0;

                allCards.forEach(card => {
                    const name = card.querySelector(activeTab === 'your' ? '.profile-name' :
                            '.mathematician-name')
                        .textContent.toLowerCase();
                    const description = card.querySelector(activeTab === 'your' ? '.profile-description' :
                            '.mathematician-bio')
                        .textContent.toLowerCase();
                    const interests = Array.from(card.querySelectorAll('.interest-tag'))
                        .map(tag => tag.textContent.toLowerCase());

                    // Check if card matches search
                    const matchesSearch = searchTerm === '' ||
                        name.includes(searchTerm) ||
                        description.includes(searchTerm) ||
                        interests.some(interest => interest.includes(searchTerm));

                    // Check if card matches selected interests
                    const hasMatchingInterest = selectedInterests.length === 0 ||
                        selectedInterests.some(interest =>
                            interests.includes(interest.toLowerCase()));

                    // Show card only if it matches both search and filters
                    card.style.display = (matchesSearch && hasMatchingInterest) ? 'flex' : 'none';

                    if (matchesSearch && hasMatchingInterest) {
                        visibleCardsCount++;
                    }
                });

                // Show empty state if needed
                if (visibleCardsCount === 0) {
                    contentContainer.style.display = 'block';

                    // Show the appropriate empty state
                    if (activeTab === 'your') {
                        noMatchesContent.style.display = 'block';
                        yourMatchesContent.style.display = 'none';
                    } else {
                        // For potential matches tab
                        document.getElementById('potential-empty-state').style.display = 'block';

                        // Hide any cards in potential matches
                        contentContainer.querySelectorAll('.mathematician-card').forEach(card => {
                            card.style.display = 'none';
                        });
                    }
                } else {
                    // Show content and hide empty state
                    contentContainer.style.display = 'block';

                    if (activeTab === 'your') {
                        noMatchesContent.style.display = 'none';
                    } else {
                        document.getElementById('potential-empty-state').style.display = 'none';
                    }
                }
            }
        });
    </script>
@endsection
