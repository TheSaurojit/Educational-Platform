@extends('layouts.app')

@section('style-section')
  <link rel="stylesheet" href="/css/profile.css">
@endsection

@section('body')
<div class="container">
    <!-- Back button -->
    <a href="/" class="back-link">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M19 12H6M12 5l-7 7 7 7"></path>
        </svg>
        Back to Home
    </a>

    <!-- Profile section -->
    <div class="profile-section">
        <img src="{{ $profile->profile_image }}" alt="Profile picture" class="profile-image">
        
        <div class="profile-info">
            <div class="profile-header">
                <div>
                    <h1 class="profile-name">{{ Auth::user()->name }}</h1>
                  
                    <div class="location">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>

                        {{ $profile->address }}

                   

                    </div>
                    {{-- <p class="bio">Math major at Columbia University with a passion for number theory and abstract algebra. I enjoy solving complex mathematical puzzles and participating in math competitions.</p> --}}
                </div>

                <a href="{{ route('create-profile') }}" class="edit-profile-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                    </svg>
                    Edit Profile
                </a>
            </div>
            
            <div class="social-links">
                <a href="#" class="social-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                    </svg>
                </a>
                <a href="#" class="social-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                    </svg>
                </a>
                <a href="#" class="social-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"></path>
                        <polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon>
                    </svg>
                </a>
                <a href="#" class="social-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                        <rect x="2" y="9" width="4" height="12"></rect>
                        <circle cx="4" cy="4" r="2"></circle>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Content grid -->
    <div class="content-grid">
        <!-- Left column with Interests and Achievements -->
        <div>
            <!-- Interests card -->
            <div class="card">
                <h2 class="card-title">Mathematical Interests</h2>
                <div class="tag-list">

                    @foreach ( $profile->mathematical_interests as $interest )
                        
                    <div class="tag">{{ $interest }}</div>
                    @endforeach
                </div>
            </div>

            <!-- Achievements card -->
            <div class="card">
                <h2 class="card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#2962ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="8" r="7"></circle>
                        <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>
                    </svg>
                    Achievements
                </h2>
                <ul class="achievement-list">
                    <li class="achievement-item">
                        {{ $profile->achievements }}
                    </li>
                    {{-- <li class="achievement-item">First Place, National Mathematics Competition 2019</li>
                    <li class="achievement-item">Published paper on prime number distribution in undergraduate journal</li> --}}
                </ul>
            </div>
        </div>

        <!-- Right column with Subscription -->
        <div>
            <!-- Subscription card -->
           

            <!-- Matches section -->
            {{-- <div class="card">
                <h2 class="card-title">Your Matches</h2>
                
                <div class="match-item">
                    <img src="https://thispersondoesnotexist.com/" alt="Aisha Patel" class="match-image">
                    <div class="match-info">
                        <div class="match-name">Aisha Patel</div>
                        <div class="match-detail">Matched on <span class="match-tag">Number Theory</span></div>
                        <div class="match-messages">2 messages</div>
                    </div>
                </div>
                
                <a href="#" class="view-all-btn">View All Matches</a>
            </div> --}}
        </div>
    </div>

    <!-- Looking for more connections section -->
    <div class="connections-card">
        <h2 class="connections-title">Looking for more connections?</h2>
        <p class="connections-subtitle">Explore potential matches based on your mathematical interests.</p>
        <a href="#" class="explore-btn">Explore Matches</a>
    </div>
</div>
@endsection

@section('script-section')
    <script>
     
        
        // Placeholder image fallback
        const profileImage = document.querySelector('.profile-image');
        
        profileImage.onerror = function() {
            this.src = 'data:image/svg+xml;charset=UTF-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22180%22%20height%3D%22180%22%20viewBox%3D%220%200%20180%20180%22%3E%3Crect%20fill%3D%22%23ddd%22%20width%3D%22180%22%20height%3D%22180%22%2F%3E%3Ctext%20fill%3D%22%23888%22%20font-family%3D%22Arial%2CVerdana%2CSans-serif%22%20font-size%3D%2220%22%20text-anchor%3D%22middle%22%20x%3D%2290%22%20y%3D%2290%22%3EAlex%20Johnson%3C%2Ftext%3E%3C%2Fsvg%3E';
        };
        
        // Match image fallback
        const matchImage = document.querySelector('.match-image');
        
        matchImage.onerror = function() {
            this.src = 'data:image/svg+xml;charset=UTF-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2260%22%20height%3D%2260%22%20viewBox%3D%220%200%2060%2060%22%3E%3Crect%20fill%3D%22%23ddd%22%20width%3D%2260%22%20height%3D%2260%22%2F%3E%3Ctext%20fill%3D%22%23888%22%20font-family%3D%22Arial%2CVerdana%2CSans-serif%22%20font-size%3D%2210%22%20text-anchor%3D%22middle%22%20x%3D%2230%22%20y%3D%2230%22%3EAP%3C%2Ftext%3E%3C%2Fsvg%3E';
        };
    </script>
@endsection
