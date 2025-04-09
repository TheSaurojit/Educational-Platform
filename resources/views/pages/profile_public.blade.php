@extends('layouts.app')

@section('style-section')
  <link rel="stylesheet" href="/css/profile_public.css">
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
        <img src="https://thispersondoesnotexist.com/" alt="Profile picture" class="profile-image">
        
        <div class="profile-info">
            <div class="profile-header">
                <div>
                    <h1 class="profile-name">Alex Johnson</h1>
                    <div class="premium-tag">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="gold" stroke="gold" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                        </svg>
                        Premium Member
                    </div>
                    <div class="location">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                        New York, USA
                    </div>
                    <p class="bio">Math major at Columbia University with a passion for number theory and abstract algebra. I enjoy solving complex mathematical puzzles and participating in math competitions.</p>
                </div>

                
            </div>
            
            <div class="social-links">
                <a href="#" class="social-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                        <rect x="2" y="9" width="4" height="12"></rect>
                        <circle cx="4" cy="4" r="2"></circle>
                    </svg>
                </a>
                <a href="#" class="social-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <circle cx="12" cy="12" r="4"></circle>
                        <line x1="21.17" y1="8" x2="12" y2="8"></line>
                        <line x1="3.95" y1="6.06" x2="8.54" y2="14"></line>
                        <line x1="10.88" y1="21.94" x2="15.46" y2="14"></line>
                    </svg>
                </a>
                <a href="#" class="social-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path>
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
                    <div class="tag">Number Theory</div>
                    <div class="tag">Abstract Algebra</div>
                    <div class="tag">Cryptography</div>
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
                    <li class="achievement-item">Gold Medal, International Mathematical Olympiad 2020</li>
                    <li class="achievement-item">First Place, National Mathematics Competition 2019</li>
                    <li class="achievement-item">Published paper on prime number distribution in undergraduate journal</li>
                </ul>
            </div>
        </div>

        <!-- Right column with Subscription -->
        <div>
            <!-- Subscription card -->
            

            <!-- Matches section -->
            <div class="card">
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
            </div>
        </div>
    </div>

    <!-- Looking for more connections section -->
  
</div>
@endsection

@section('script-section')
    <script>
         const editProfileBtn = document.querySelector('.edit-profile-btn');
        
        editProfileBtn.addEventListener('click', () => {
            alert('Edit profile functionality would go here');
        });
        
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
