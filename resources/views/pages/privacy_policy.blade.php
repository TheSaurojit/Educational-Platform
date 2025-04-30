@extends('layouts.app')

@section('style-section')
    <link rel="stylesheet" href="/css/privacy.css">
@endsection

@section('body')
<div class="container">
    <div class="privacy-header">
        <h1 class="privacy-title">Privacy Policy</h1>
        <p class="privacy-subtitle">At Maths Matchmaker, we take your privacy seriously. This policy explains how we collect, use, and protect your information.</p>
        <div class="effective-date">Last Updated: April 29, 2025</div>
    </div>

    <div class="privacy-content">
        <div class="privacy-section">
            <h2 class="section-title"><span class="section-number">1</span> Information We Collect</h2>
            <div class="section-content">
                <div class="data-category">
                    <div class="data-category-label">Account Information</div>
                    <p>Name, email address, academic background, mathematical interests, and achievements.</p>
                </div>
                
                <div class="data-category">
                    <div class="data-category-label">Profile Content</div>
                    <p>User-uploaded profile pictures, research interests, papers, achievements, and other content you choose to share.</p>
                </div>
                
                <div class="data-category">
                    <div class="data-category-label">Usage Information</div>
                    <p>Pages visited, matches explored, time spent on platform, interaction with features, and discussion participation.</p>
                </div>
                
                <div class="data-category">
                    <div class="data-category-label">Device and Technical Information</div>
                    <p>IP address, browser type, operating system, device information, and other technical identifiers.</p>
                </div>
            </div>
        </div>

        <div class="privacy-section">
            <h2 class="section-title"><span class="section-number">2</span> How We Use Your Information</h2>
            <div class="section-content">
                <p>We use the information we collect for the following purposes:</p>
                <ul class="bullet-list">
                    <li>To create and manage your user profile</li>
                    <li>To provide personalized match recommendations based on your mathematical interests</li>
                    <li>To facilitate discussions and collaborations between users with similar interests</li>
                    <li>To send platform updates, announcements, and newsletters (with your consent)</li>
                    <li>To improve our platform features and user experience through analysis of usage patterns</li>
                    <li>To respond to your inquiries and provide user support</li>
                    <li>To ensure the security and proper functioning of our platform</li>
                </ul>
            </div>
        </div>

        <div class="privacy-section">
            <h2 class="section-title"><span class="section-number">3</span> Sharing of Information</h2>
            <div class="section-content">
                <p>We may share your information in the following circumstances:</p>
                <ul class="bullet-list">
                    <li><span class="highlight">With other users</span> — Your profile information will be visible to other users as part of the matching process, according to your privacy settings</li>
                    <li><span class="highlight">With service providers</span> — We work with trusted third parties who assist us with hosting, email delivery, analytics, and other technical services</li>
                    <li><span class="highlight">Legal requirements</span> — We may disclose information if required by law enforcement requests, court orders, or other legal obligations</li>
                </ul>
                
                <div class="info-card">
                    <div class="info-card-title">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="16" x2="12" y2="12"></line>
                            <line x1="12" y1="8" x2="12.01" y2="8"></line>
                        </svg>
                        Important Note
                    </div>
                    <p>We never sell your personal information to third parties for marketing or advertising purposes.</p>
                </div>
            </div>
        </div>

        <div class="privacy-section">
            <h2 class="section-title"><span class="section-number">4</span> Data Retention</h2>
            <div class="section-content">
                <p>We retain your personal data as long as your account is active or as needed to provide you with our services. You may request deletion of your data at any time by contacting us.</p>
                <p>After account deletion, some information may remain in our backup systems for a limited time, but we will not use this data for any active purposes.</p>
            </div>
        </div>

        <div class="privacy-section">
            <h2 class="section-title"><span class="section-number">5</span> Your Rights</h2>
            <div class="section-content">
                <p>Depending on your location, you may have certain rights regarding your personal information:</p>
                <ul class="bullet-list">
                    <li>Access your data and receive information about how it is processed</li>
                    <li>Correct or update inaccurate or incomplete information</li>
                    <li>Request deletion of your personal information</li>
                    <li>Object to certain types of processing</li>
                    <li>Request restrictions on how your data is processed</li>
                    <li>Withdraw consent previously provided</li>
                </ul>
                <p>To exercise any of these rights, please contact us using the information in Section 10.</p>
            </div>
        </div>

        <div class="privacy-section">
            <h2 class="section-title"><span class="section-number">6</span> Cookies and Tracking Technologies</h2>
            <div class="section-content">
                <p>We use cookies and similar technologies to:</p>
                <ul class="bullet-list">
                    <li>Maintain your session when logged in</li>
                    <li>Remember your preferences</li>
                    <li>Analyze traffic and usage patterns</li>
                    <li>Improve platform performance</li>
                </ul>
                <p>You can adjust your browser settings to reject cookies, but this may limit some functionality of our platform.</p>
            </div>
        </div>

        <div class="privacy-section">
            <h2 class="section-title"><span class="section-number">7</span> Security Measures</h2>
            <div class="section-content">
                <p>We implement industry-standard security practices to protect your information, including:</p>
                <ul class="bullet-list">
                    <li>Encryption of data in transit and at rest</li>
                    <li>Regular security assessments and updates</li>
                    <li>Access controls for our systems and databases</li>
                    <li>Employee training on security and privacy practices</li>
                </ul>
                <p>However, no method of transmission over the Internet or electronic storage is 100% secure. While we strive to protect your personal information, we cannot guarantee absolute security.</p>
            </div>
        </div>

        <div class="privacy-section">
            <h2 class="section-title"><span class="section-number">8</span> International Users</h2>
            <div class="section-content">
                <p>If you are accessing Maths Matchmaker from outside India, you consent to the transfer of your data to India, where our servers are located. We ensure appropriate safeguards are in place to protect your information in compliance with applicable data protection laws.</p>
            </div>
        </div>

        <div class="privacy-section">
            <h2 class="section-title"><span class="section-number">9</span> Changes to this Policy</h2>
            <div class="section-content">
                <p>We may revise this Privacy Policy from time to time. Changes will be posted on this page, and significant changes will be notified via email or through a notice on our platform.</p>
                <p>We encourage you to periodically review this Privacy Policy to stay informed about how we are protecting your information.</p>
            </div>
        </div>

        <div class="privacy-section">
            <h2 class="section-title"><span class="section-number">10</span> Contact Us</h2>
            <div class="section-content">
                <p>For any questions or concerns about this Privacy Policy or our data practices, please contact us:</p>
                <div class="contact-box">
                    <p><span class="highlight">Email:</span> samujjal.barman@mathsmatchmaker.com</p>
                </div>
                <p>We will respond to your inquiry as soon as possible and within the timeframe required by applicable law.</p>
            </div>
        </div>
    </div>
</div>
@endsection

