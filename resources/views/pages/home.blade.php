@extends('layouts.app')

@section('style-section')
    <link rel="stylesheet" href="/css/home.css">
@endsection

@section('body')
    <div class="overlay"></div>

    <!-- Hero Section -->
    <section class="hero">
        <h1>Connect Through <span>Mathematics</span></h1>
        <p>Find fellow math enthusiasts from around the world. Share your passion, collaborate on problems, and make
            meaningful connections.</p>
        <div class="cta-buttons">
            <a href="{{ route('profile') }}"><button class="primary-btn">Profile</button></a>
            <a href="/matches"><button class="secondary-btn">Explore Matches</button></a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="section-header">
            <h2>Why Maths-matchmaker?</h2>
            <p>Our platform is designed specifically for mathematics enthusiasts to find like-minded peers.</p>
        </div>

        <div class="feature-cards">
            <div class="feature-card">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
                <h3>Global Connections</h3>
                <p>Connect with math enthusiasts from different cultures and backgrounds across the globe.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="8" r="7"></circle>
                        <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>
                    </svg>
                </div>
                <h3>Showcase Achievements</h3>
                <p>Highlight your mathematical achievements and expertise to find perfect collaboration partners.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                    </svg>
                </div>
                <h3>Meaningful Discussions</h3>
                <p>Engage in deep conversations about the mathematical topics you're passionate about.</p>
            </div>
        </div>
    </section>
    <section class="featured-mathematicians">
        <div class="section-header">
            <h2>Featured Mathematicians</h2>
            <p>Discover some of the brilliant minds already on our platform.</p>
            {{-- <a href="#" class="view-all">View all mathematicians <svg xmlns="http://www.w3.org/2000/svg"
                    width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg></a> --}}
        </div>

        <div class="mathematician-cards">

            @foreach ($mathematicians as $user)
                
                @php
                    $image = $user->profile->profile_image;
                    $name = $user->name;
                    $interests = $user->profile->mathematical_interests;
                    $achievements = $user->profile->achievements;
                    $address = $user->profile->address ;

                @endphp



                <div class="mathematician-card">
                    <div class="mathematician-image">
                        <img src="{{ $image }}" alt="Alex Johnson" />
                    </div>
                    <div class="mathematician-info">
                        <h3>{{ $name }}</h3>
                        <div class="location">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            <span>{{ $address }}</span>
                        </div>

                        <div class="interests-section">
                            <h4>Interests</h4>
                            <div class="interest-tags">
                                @foreach ($interests as $int)
                                    <span class="interest-tag">{{ $int }}</span>
                                @endforeach
                            </div>
                        </div>

                        <div class="achievements-section">
                            <h4>Achievements</h4>
                            <ul class="achievements-list">
                                <li>{{ $achievements }}</li>
                                
                            </ul>
                        </div>

                        <a href="#" class="view-profile-btn">View Profile</a>
                    </div>
                </div>
            @endforeach



        </div>
    </section>
    <section class="explore-fields">
        <div class="section-header">
            <h2>Explore Mathematical Fields</h2>
            <p>From pure abstraction to practical applications, find your mathematical passion.</p>
        </div>

        <div class="field-tags-container">
            <div class="field-tags">
                <span class="field-tag">Number Theory</span>
                <span class="field-tag">Abstract Algebra</span>
                <span class="field-tag">Calculus</span>
                <span class="field-tag">Real Analysis</span>
                <span class="field-tag">Complex Analysis</span>
                <span class="field-tag">Topology</span>
                <span class="field-tag">Differential Geometry</span>
                <span class="field-tag">Linear Algebra</span>
                <span class="field-tag">Combinatorics</span>
                <span class="field-tag">Graph Theory</span>
                <span class="field-tag">Probability Theory</span>
                <span class="field-tag">Statistics</span>
                <span class="field-tag">Applied Mathematics</span>
                <span class="field-tag">Mathematical Physics</span>
                <span class="field-tag">Mathematical Logic</span>
            </div>

            {{-- <button class="discover-more-btn">Discover More Fields</button> --}}
        </div>
    </section>
    <section class="faq-section">
        <div class="faq-header">
            <h2 class="faq-title">Frequently Asked Questions</h2>
            <p class="faq-subtitle">Find answers to common questions about our mathematical community platform and how to
                get the most out of your experience.</p>
        </div>

        <div class="faq-container">
            <div class="faq-item">
                <div class="faq-question">How do I find collaboration partners?</div>
                <div class="faq-answer">Our matching algorithm pairs you with mathematicians who share similar interests
                    and research areas. Navigate to the Matches section to see your recommended connections, or use the
                    Discover feature to browse profiles by specialty, research topic, or academic focus.</div>
            </div>

            <div class="faq-item">
                <div class="faq-question">Can I showcase my published papers?</div>
                <div class="faq-answer">Absolutely! In your profile, you can add links to your published papers, attach
                    PDFs of your work, and highlight key mathematical achievements. This helps potential collaborators
                    understand your expertise and research interests.</div>
            </div>

            <div class="faq-item">
                <div class="faq-question">How do I join discussion groups?</div>
                <div class="faq-answer">Visit the Discover section to browse available discussion groups organized by
                    mathematical fields. You can join existing conversations or create your own topic to engage with
                    like-minded mathematicians around specific problems or areas of study.</div>
            </div>

            <div class="faq-item">
                <div class="faq-question">Is Maths-matchmaker free to use?</div>
                <div class="faq-answer">Maths-matchmaker offers both free and premium membership options. The free version
                    gives you access to basic features, while our premium subscription unlocks advanced matching algorithms,
                    unlimited messaging, and participation in exclusive virtual meetups and workshops.</div>
            </div>

            <div class="faq-item">
                <div class="faq-question">How do I update my mathematical interests?</div>
                <div class="faq-answer">You can update your interests at any time through your Profile settings. We
                    recommend keeping your mathematical specialties, current research topics, and collaboration preferences
                    up-to-date to ensure you get the most relevant connection suggestions.</div>
            </div>

            <div class="faq-item">
                <div class="faq-question">Can I connect with mathematicians internationally?</div>
                <div class="faq-answer">Yes! Maths-matchmaker has a global community of mathematicians from diverse
                    backgrounds and cultures. Our platform supports multiple languages and time zone coordination to
                    facilitate international collaboration and knowledge exchange.</div>
            </div>
        </div>
    </section>
    <!-- Call to Action Section -->
    <section class="cta-section">
        <div class="cta-content">
            <h2>Ready to Find Your Mathematical Match?</h2>
            <p>Join our community of math enthusiasts and discover connections that will inspire and challenge you.</p>
            <a href="#" class="create-profile-btn">
                Create Your Profile
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </a>
        </div>
    </section>
@endsection

@section('script-section')
    <script>
        const overlay = document.querySelector('.overlay');



        overlay.addEventListener('click', () => {
            navContainer.classList.remove('active');
            overlay.classList.remove('active');
            document.body.style.overflow = 'auto';
        });
        const buttons = document.querySelectorAll('.primary-btn, .secondary-btn, .signin-btn');

        buttons.forEach(button => {
            button.addEventListener('mouseenter', () => {
                button.style.transition = 'all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
            });

            button.addEventListener('mouseleave', () => {
                button.style.transition = 'all 0.3s ease';
            });
        });

        // Feature card animations
        const featureCards = document.querySelectorAll('.feature-card');

        featureCards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                const icon = card.querySelector('.feature-icon');
                icon.style.transition = 'all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
                card.style.transform = 'translateY(-10px)';
                card.style.boxShadow = '0 15px 30px rgba(0, 0, 0, 0.1)';
                card.style.borderColor = '#b6d4ff';
            });

            card.addEventListener('mouseleave', () => {
                const icon = card.querySelector('.feature-icon');
                icon.style.transition = 'all 0.3s ease';
                card.style.transform = 'translateY(0)';
                card.style.boxShadow = 'none';
                card.style.borderColor = '#e9ecef';
            });
        });

        // Scroll animation for feature cards
        function checkScroll() {
            const featureSection = document.querySelector('.features');
            const featureCards = document.querySelectorAll('.feature-card');

            const featureSectionPosition = featureSection.getBoundingClientRect().top;
            const screenPosition = window.innerHeight / 1.3;

            if (featureSectionPosition < screenPosition) {
                featureCards.forEach((card, index) => {
                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, 200 * index);
                });
                window.removeEventListener('scroll', checkScroll);
            }
        }

        // Initialize feature cards for animation
        document.addEventListener('DOMContentLoaded', () => {
            const featureCards = document.querySelectorAll('.feature-card');
            featureCards.forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'all 0.6s ease';
            });

            // Check initial scroll position
            checkScroll();

            // Add scroll event listener
            window.addEventListener('scroll', checkScroll);
        });
    </script>
@endsection
