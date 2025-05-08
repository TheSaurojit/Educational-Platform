@extends('layouts.app')

@section('style-section')
    <link rel="stylesheet" href="/css/contact_us.css">
@endsection

@section('body')
<div class="container">
<main class="contact-container">
    <div class="contact-header">
        <h1>Connect With</h1>
        <h2>Our Team</h2>
    </div>
    
    <p class="contact-description">
        Have questions about Maths-matchmaker? Want to report an issue or suggest a new feature? 
        We'd love to hear from you! Fill out the form below and our team will get back to you 
        <span class="math-symbol">∞</span> times faster.
    </p>
    
    <div class="contact-form-container">
        <div class="contact-form">
            <form method="POST" id="contactForm">
                @csrf
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" placeholder="Your name" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="your.email@example.com" required>
                </div>
                
                <div class="form-group">
                    <label for="message">Your Message</label>
                    <textarea id="message" name="message" placeholder="Let us know how we can help you..." required></textarea>
                </div>
                
                <div class="form-group" style="text-align: center;">
                    <button type="submit" class="contact-button">Send Message</button>
                </div>
            </form>
            
            <div class="success-message" id="successMessage">
                <h3>Thank you for your message!</h3>
                <p>We've received your inquiry and will get back to you as soon as possible.</p>
            </div>
        </div>
    </div>
    
    <div class="contact-info">
        <div class="info-item">
            <div class="info-icon">✉</div>
            <h3>Email</h3>
            <p>support@maths-matchmaker.com<br/>samujjal.barman@mathsmatchmaker.com</p>
        </div>
        
        <div class="info-item">
            <div class="info-icon">⏱</div>
            <h3>Response Time</h3>
            <p>Within 24-48 hours</p>
        </div>
    </div>
</main>
</div>

@endsection

@section('script-section')
   
@endsection
