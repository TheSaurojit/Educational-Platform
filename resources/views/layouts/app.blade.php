<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maths-matchmaker</title>
    <style>
        .toast-container {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 9999;
            max-width: 350px;
        }

        .toast {
            display: flex;
            flex-direction: column;
            position: relative;
            margin-bottom: 1rem;
            padding: 16px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            animation: slideIn 0.3s ease-out forwards;
        }

        .toast-content {
            display: flex;
            align-items: flex-start;
            padding-right: 24px;
        }

        .toast-error {
            background-color: #fff1f0;
            border-left: 4px solid #ff4d4f;
        }

        .toast-success {
            background-color: #f6ffed;
            border-left: 4px solid #52c41a;
        }

        .toast-icon {
            flex-shrink: 0;
            margin-right: 12px;
        }

        .toast-error .toast-icon svg {
            stroke: #ff4d4f;
        }

        .toast-success .toast-icon svg {
            stroke: #52c41a;
        }

        .toast-message {
            flex-grow: 1;
        }

        .toast-message strong {
            display: block;
            margin-bottom: 4px;
        }

        .toast-message ul {
            margin: 8px 0 0 0;
            padding-left: 20px;
        }

        .toast-close {
            position: absolute;
            top: 12px;
            right: 12px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .toast-close svg {
            width: 16px;
            height: 16px;
            stroke: #999;
            transition: stroke 0.2s;
        }

        .toast-close:hover svg {
            stroke: #333;
        }

        .toast-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            width: 100%;
            animation: progressBar 5s linear forwards;
        }

        .toast-error .toast-progress {
            background-color: #ff4d4f;
        }

        .toast-success .toast-progress {
            background-color: #52c41a;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes progressBar {
            from {
                width: 100%;
            }

            to {
                width: 0%;
            }
        }
    </style>

    <link rel="stylesheet" href="/css/navbar.css">

    <link rel="stylesheet" href="/css/footer.css">
    @yield('style-section')
</head>

<body>
    <!-- Navigation -->
    <nav>
        <a href="/" class="logo">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="#2962ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                <path d="M8 7h8"></path>
                <path d="M8 12h8"></path>
                <path d="M8 17h8"></path>
            </svg>
            Maths-matchmaker
        </a>

        <button class="mobile-menu-btn">☰</button>

        <div class="nav-links">
            <a href="/">Home</a>
            <a href="/community">Community</a>
            <a href="/discover">Discover</a>
            <a href="/matches">Matches</a>

            @auth

                <a href="{{ route('profile') }}">Profile</a>
                <a href="/notifications">

                    <div class="notification">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                        @if (Auth::user()->receivedFriendRequests->count())
                        <span class="notification-badge">
                            {{Auth::user()->receivedFriendRequests->count()}}
                        </span>
                            
                        @endif
                    </div>

                </a>
            @endauth

            @auth
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button class="sign-in-btn" >Sign Out</button>
            </form>


            @endauth

            @guest
                <a href="{{ route('register') }}"><button class="sign-in-btn" >Sign In</button></a>
            @endguest
        </div>
    </nav>

    <div id="toast-container" class="toast-container">
        @if ($errors->any())
            <div class="toast toast-error" role="alert">
                <div class="toast-content">
                    <div class="toast-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="15" y1="9" x2="9" y2="15"></line>
                            <line x1="9" y1="9" x2="15" y2="15"></line>
                        </svg>
                    </div>
                    <div class="toast-message">
                        <strong>Error</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <button class="toast-close" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
                <div class="toast-progress"></div>
            </div>
        @endif

        @if (session('success'))
            <div class="toast toast-success" role="alert">
                <div class="toast-content">
                    <div class="toast-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                    </div>
                    <div class="toast-message">
                        <strong>Success</strong>
                        <p>{{ session('success') }}</p>
                    </div>
                </div>
                <button class="toast-close" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
                <div class="toast-progress"></div>
            </div>
        @endif
    </div>

    @yield('body')
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-section">
                <div class="footer-logo">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="#2962ff" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                        <path d="M8 7h8"></path>
                        <path d="M8 12h8"></path>
                        <path d="M8 17h8"></path>
                    </svg>
                    Maths-matchmaker
                </div>
                <p class="footer-tagline">Connecting math enthusiasts around the world. Share, learn, and grow
                    together.
                </p>
                <div class="social-icons">
                    <a href="https://www.facebook.com/samujjal.barman.9" aria-label="Facebook"><svg xmlns="http://www.w3.org/2000/svg" width="20"
                            height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                        </svg></a>
                    <a href="http://x.com/samujjal176422" aria-label="Twitter"><svg xmlns="http://www.w3.org/2000/svg" width="20"
                            height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z">
                            </path>
                        </svg></a>
                    <a href="https://www.instagram.com/@bsamujjal" aria-label="Instagram"><svg xmlns="http://www.w3.org/2000/svg" width="20"
                            height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                        </svg></a>
                    {{-- <a href="#" aria-label="YouTube"><svg xmlns="http://www.w3.org/2000/svg" width="20"
                            height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z">
                            </path>
                            <polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon>
                        </svg></a> --}}
                    <a href="https://www.linkedin.com/in/samujjal-barman-9886b310b" aria-label="LinkedIn"><svg xmlns="http://www.w3.org/2000/svg" width="20"
                            height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z">
                            </path>
                            <rect x="2" y="9" width="4" height="12"></rect>
                            <circle cx="4" cy="4" r="2"></circle>
                        </svg></a>
                  
                </div>
            </div>

            <div class="footer-section">
                <h3 class="footer-heading">Navigation</h3>
                <ul class="footer-links">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Profile</a></li>
                    <li><a href="#">Matches</a></li>
                    <li><a href="#">Discover</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3 class="footer-heading">Resources</h3>
                <ul class="footer-links">
                    <li><a href="#">Math Topics</a></li>
                    <li><a href="#">Community</a></li>
                    <li><a href="#">FAQs</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3 class="footer-heading">Legal</h3>
                <ul class="footer-links">
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Cookie Policy</a></li>
                    {{-- <li><a href="#">Contact Us</a></li> --}}
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>© 2025 Maths-matchmaker. All rights reserved.</p>
            <p>Made with <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                    fill="#ff79c6" stroke="#ff79c6" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path
                        d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z">
                    </path>
                </svg> for mathematical minds</p>
        </div>
    </footer>

    <script src="/js/navbar.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toasts = document.querySelectorAll('.toast');

            toasts.forEach(toast => {
                // Auto-remove toast after 5 seconds
                setTimeout(() => {
                    toast.style.animation = 'slideOut 0.3s ease-in forwards';
                    setTimeout(() => {
                        toast.remove();
                    }, 300);
                }, 5000);

                // Close button functionality
                const closeBtn = toast.querySelector('.toast-close');
                if (closeBtn) {
                    closeBtn.addEventListener('click', () => {
                        toast.style.animation = 'slideOut 0.3s ease-in forwards';
                        setTimeout(() => {
                            toast.remove();
                        }, 300);
                    });
                }
            });
        });

        // Add slideOut animation
        const style = document.createElement('style');
        style.textContent = `
          @keyframes slideOut {
            from {
              transform: translateX(0);
              opacity: 1;
            }
            to {
              transform: translateX(100%);
              opacity: 0;
            }
          }
        `;
        document.head.appendChild(style);
    </script>
    @yield('script-section')
</body>

</html>
