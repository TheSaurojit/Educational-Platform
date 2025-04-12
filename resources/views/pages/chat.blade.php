@extends('layouts.app')

@section('style-section')
  <link rel="stylesheet" href="/css/chat.css">
@endsection

@section('body')
<div class="container">
    <div class="chat-section">
        <a href="/matches" class="back-button">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
            Back to Matches
        </a>
        
        <div class="chat-header">
            <h1 class="chat-title">Chat with Aisha Patel</h1>
            <p class="match-info">You matched on <a href="#">Number Theory</a></p>
        </div>
        
        <div class="user-profile">
            <div class="profile-picture">
                <img src="/api/placeholder/60/60" alt="Aisha Patel">
            </div>
            <div class="user-info">
                <h2>Aisha Patel</h2>
                <p>Mumbai, India</p>
            </div>
        </div>
        
        <div class="chat-container">
            <div class="messages-container" id="messages-container">
                <!-- Messages will be added here by JavaScript -->
            </div>
            
            <div class="typing-indicator" id="typing-indicator">
                <div class="typing-dots">
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                </div>
            </div>
            
            <div class="input-container">
                <textarea class="message-input" placeholder="Message Aisha Patel..." id="message-input"></textarea>
                <button class="send-button" id="send-button">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="22" y1="2" x2="11" y2="13"></line>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script-section')
    <script>
          document.addEventListener('DOMContentLoaded', function() {
            const messagesContainer = document.getElementById('messages-container');
            const messageInput = document.getElementById('message-input');
            const sendButton = document.getElementById('send-button');
            const typingIndicator = document.getElementById('typing-indicator');
            
            // Initial messages
            const initialMessages = [
                {
                    text: "Hey Aisha! I saw we both love Number Theory. What are you working on these days?",
                    time: "Apr 12, 9:15 PM",
                    type: "sent"
                },
                {
                    text: "Hi Alex! I'm currently exploring some interesting patterns in prime number distribution. How about you?",
                    time: "Apr 12, 9:32 PM",
                    type: "received"
                }
            ];
            
            // Function to add a message to the chat
            function addMessage(text, time, type, animate = true) {
                const messageElement = document.createElement('div');
                messageElement.className = `message message-${type}`;
                
                if (!animate) {
                    messageElement.style.animation = 'none';
                }
                
                messageElement.innerHTML = `
                    <div class="message-content">${text}</div>
                    <div class="message-time">${time}</div>
                `;
                
                messagesContainer.appendChild(messageElement);
                scrollToBottom();
                
                return messageElement;
            }
            
            // Add initial messages without animation
            initialMessages.forEach(msg => {
                addMessage(msg.text, msg.time, msg.type, false);
            });
            
            // Auto-resize textarea
            messageInput.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight) + 'px';
                
                // Reset height if empty
                if (this.value === '') {
                    this.style.height = 'auto';
                }
            });
            
            // Function to show typing indicator
            function showTypingIndicator() {
                typingIndicator.style.display = 'block';
                scrollToBottom();
                
                // Hide after random time (1.5-3 seconds)
                const typingTime = Math.random() * 1500 + 1500;
                return new Promise(resolve => {
                    setTimeout(() => {
                        typingIndicator.style.display = 'none';
                        resolve();
                    }, typingTime);
                });
            }
            
            // Send message function
            function sendMessage() {
                const message = messageInput.value.trim();
                if (message) {
                    // Get current time
                    const now = new Date();
                    const hours = now.getHours();
                    const minutes = now.getMinutes().toString().padStart(2, '0');
                    const period = hours >= 12 ? 'PM' : 'AM';
                    const formattedHours = (hours % 12) || 12;
                    const timeString = `Apr ${now.getDate()}, ${formattedHours}:${minutes} ${period}`;
                    
                    // Add sent message
                    addMessage(message, timeString, 'sent');
                    
                    // Clear input and reset height
                    messageInput.value = '';
                    messageInput.style.height = 'auto';
                    
                    // Show typing indicator then response
                    setTimeout(() => {
                        showTypingIndicator().then(() => {
                            // Generate a response based on the message
                            let response;
                            
                            if (message.toLowerCase().includes('prime')) {
                                response = "Yes, prime number distribution is fascinating! Have you looked into the Riemann Hypothesis? It's closely related to understanding prime patterns.";
                            } else if (message.toLowerCase().includes('number') || message.toLowerCase().includes('theory')) {
                                response = "Number theory is such a deep field! I've been particularly interested in Diophantine equations lately. What aspects are you most curious about?";
                            } else if (message.toLowerCase().includes('math')) {
                                response = "Mathematics connects us all! Besides number theory, I also enjoy combinatorics and graph theory. Do you explore other mathematical areas too?";
                            } else {
                                response = "That's interesting! Speaking of mathematics, have you been to any conferences or seminars recently? I find them so inspiring.";
                            }
                            
                            // Add received message
                            addMessage(response, timeString, 'received');
                        });
                    }, 500);
                }
            }
            
            // Scroll to bottom function
            function scrollToBottom() {
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
            }
            
            // Send message on button click
            sendButton.addEventListener('click', sendMessage);
            
            // Send message on Enter (but allow Shift+Enter for new line)
            messageInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    sendMessage();
                }
            });
            
            // Button effects
            sendButton.addEventListener('mousedown', function() {
                this.style.transform = 'scale(0.95)';
            });
            
            sendButton.addEventListener('mouseup', function() {
                this.style.transform = 'scale(1.05)';
                setTimeout(() => {
                    this.style.transform = 'scale(1)';
                }, 200);
            });
            
            // Add entrance animation to messages
            document.querySelectorAll('.message').forEach((msg, index) => {
                setTimeout(() => {
                    msg.style.animationName = msg.classList.contains('message-sent') ? 'messageInRight' : 'messageInLeft';
                }, 100 * index);
            });
            
            // Initial scroll to bottom
            scrollToBottom();
        });
    </script>
@endsection
