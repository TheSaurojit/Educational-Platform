
// Notification animation
const notification = document.querySelector('.notification');

function pulseAnimation() {
    notification.style.transform = 'scale(1.2)';
    setTimeout(() => {
        notification.style.transform = 'scale(1)';
    }, 200);
}

// Pulse notification every 5 seconds
setInterval(pulseAnimation, 5000);

// Button hover effect enhancement

// Mobile menu toggle
const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
const navLinks = document.querySelector('.nav-links');

mobileMenuBtn.addEventListener('click', () => {
    navLinks.classList.toggle('active');
});

// Close mobile menu when clicking outside
document.addEventListener('click', (event) => {
    if (!event.target.closest('.mobile-menu-btn') && !event.target.closest('.nav-links')) {
        navLinks.classList.remove('active');
    }
});
document.addEventListener('DOMContentLoaded', function() {
const questions = document.querySelectorAll('.faq-question');

questions.forEach(question => {
    question.addEventListener('click', function() {
        // Toggle the active class on the question
        this.classList.toggle('active');
        
        // Toggle the active class on the answer
        const answer = this.nextElementSibling;
        answer.classList.toggle('active');
    });
});
});