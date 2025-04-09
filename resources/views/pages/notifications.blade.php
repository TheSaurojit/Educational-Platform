@extends('layouts.app')

@section('style-section')
  <link rel="stylesheet" href="/css/notifications.css">
@endsection

@section('body')
<main class="container">
    <a href="/" class="back-link">
        <span class="back-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
            Get New Matches
        </button>
        </a>
    </div>

    <!-- Connection requests container -->
    <div id="connections-container">
        <!-- Empty initially, will be filled with JavaScript -->
    </div>
</main>
@endsection

@section('script-section')
    <script>
       const connectionRequests = [
            {
                id: 1,
                username: "ProfEuler42",
                profilePic: "data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%232563eb' stroke-width='2'><circle cx='12' cy='8' r='5'/><path d='M20 21v-2a7 7 0 0 0-14 0v2'/></svg>",
                interests: ["Number Theory", "Calculus", "Topology"],
                socialMedia: ["twitter", "linkedin", "github"],
                achievements: "Fields Medal Nominee, Published in Mathematics Journal",
                description: "I'm passionate about exploring the connections between number theory and topology. Looking for collaborators on my latest research paper."
            },
            {
                id: 2,
                username: "CalculusQueen",
                profilePic: "data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%232563eb' stroke-width='2'><circle cx='12' cy='8' r='5'/><path d='M20 21v-2a7 7 0 0 0-14 0v2'/></svg>",
                interests: ["Calculus", "Mathematical Physics", "Differential Equations"],
                socialMedia: ["facebook", "instagram"],
                achievements: "PhD in Applied Mathematics, Author of 'Calculus Made Simple'",
                description: "Mathematics professor specializing in applications of calculus to real-world physics problems. Looking to connect with fellow educators."
            }
        ];

        // Function to render connection requests
        function renderConnectionRequests() {
            const container = document.getElementById('connections-container');
            container.innerHTML = '';

            if (connectionRequests.length === 0) {
                // Render empty state
                container.innerHTML = `
                    <div class="empty-state">
                        <div class="empty-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                        </div>
                        <h2 class="empty-title">No pending connection requests</h2>
                        <p class="empty-text">When fellow math enthusiasts want to connect with you, their requests will appear here.</p>
                        
                        <a href="/discover"><button class="find-connections-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            Find New Connections
                        </button>
                        </a>
                    </div>
                `;
            } else {
                // Render connection requests
                connectionRequests.forEach(request => {
                    const card = document.createElement('div');
                    card.className = 'connection-card';
                    card.innerHTML = `
                        <div class="user-info">
                            <div class="profile-pic">
                                <img src="${request.profilePic}" alt="${request.username}">
                            </div>
                            <div class="user-details">
                                <h3 class="username">${request.username}</h3>
                                <div class="interests">
                                    ${request.interests.map(interest => `<span class="interest-tag">${interest}</span>`).join('')}
                                </div>
                                <div class="social-links">
                                    ${renderSocialIcons(request.socialMedia)}
                                </div>
                                <div class="achievements">${request.achievements}</div>
                                <p class="description">${request.description}</p>
                            </div>
                        </div>
                        <div class="action-buttons">
                            <button class="accept-btn" onclick="handleRequest(${request.id}, 'accept')">Accept</button>
                            <button class="reject-btn" onclick="handleRequest(${request.id}, 'reject')">Reject</button>
                        </div>
                    `;
                    container.appendChild(card);
                });
            }
        }

        // Function to render social media icons
        function renderSocialIcons(socialMedia) {
            const icons = {
                twitter: '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>',
                facebook: '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>',
                linkedin: '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>',
                github: '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg>',
                instagram: '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>'
            };

            return socialMedia.map(platform => `<span class="social-icon">${icons[platform] || ''}</span>`).join('');
        }

        // Function to handle accept/reject actions
        function handleRequest(id, action) {
            if (action === 'accept') {
                alert(`Accepted connection request from user ID: ${id}`);
            } else {
                alert(`Rejected connection request from user ID: ${id}`);
            }

            // Remove the request from the array
            const index = connectionRequests.findIndex(request => request.id === id);
            if (index !== -1) {
                connectionRequests.splice(index, 1);
                renderConnectionRequests();
            }
        }

        // Toggle between empty state and connection requests for demo purposes
        let showConnections = true;
        
        function toggleConnectionDisplay() {
            if (showConnections) {
                renderConnectionRequests();
            } else {
                // Clear connection requests array for demo
                connectionRequests.splice(0, connectionRequests.length);
                renderConnectionRequests();
            }
            showConnections = !showConnections;
        }

        // Initial render
        renderConnectionRequests();

        // Add event listener to toggle between states (for demonstration)
        document.querySelector('.get-matches-btn').addEventListener('click', toggleConnectionDisplay);
        document.addEventListener('click', event => {
            if (event.target.classList.contains('find-connections-btn')) {
                toggleConnectionDisplay();
            }
        });
    </script>
@endsection
