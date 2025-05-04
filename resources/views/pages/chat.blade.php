@extends('layouts.app')

@section('style-section')
    <link rel="stylesheet" href="/css/chat.css">
@endsection

@section('body')
    <div class="container">
        <div class="chat-section">
            <a href="{{ route('matches') }}" class="back-button">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 12H5M12 19l-7-7 7-7" />
                </svg>
                Back to Matches
            </a>

            @php
                $currentUserId = Auth::id();

                $chatId = $chat->id;

                $otherUser = $chat->userOne->id === $currentUserId ? $chat->userTwo : $chat->userOne;

                $name = $otherUser->name;
                $image = $otherUser->profile->profile_image;
                $address = $otherUser->profile->address;

            @endphp


            <div class="chat-header">
                <h1 class="chat-title">Chat with {{ $name }}</h1>
                {{-- <p class="match-info">You matched on <a href="#">Number Theory</a></p> --}}
            </div>

            <div class="user-profile">
                <div class="profile-picture">
                    <img src="{{ $image }}" alt="{{ $name }}">
                </div>
                <div class="user-info">
                    <h2>{{ $name }}</h2>
                    <p>From : {{ $address }}</p>
                </div>
            </div>

            <div class="chat-container">
                <div class="messages-container" id="messages-container">
                    <!-- Messages will be added here by JavaScript -->

                    @foreach ($messages as $msg)
                        @php
                            $body = $msg->message;
                            $senderId = $msg->sender_id;
                            $time = $msg->created_at->format('d F, h:i a');
                        @endphp

                        @if ($senderId == $currentUserId)
                            <div class="message message-sent"
                                style="animation: auto ease 0s 1 normal none running messageInRight;">
                                <div class="message-content">{{ $body }}</div>
                                <div class="message-time">{{ $time }}</div>
                            </div>
                        @else
                            <div class="message message-received"
                                style="animation: auto ease 0s 1 normal none running messageInLeft;">
                                <div class="message-content">{{ $body }}</div>
                                <div class="message-time">{{ $time }}</div>
                            </div>
                        @endif
                    @endforeach



                </div>

                <div class="typing-indicator" id="typing-indicator">
                    <div class="typing-dots">
                        <div class="dot"></div>
                        <div class="dot"></div>
                        <div class="dot"></div>
                    </div>
                </div>

                <div class="input-container">
                    <textarea class="message-input" placeholder="Message {{ $name }}..." id="message-input"></textarea>
                    <button class="send-button" id="send-button">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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


            async function getMessagesFromBackend() {
                try {
                    const response = await fetch('{{ route('getNewMsg', ['chatId' => $chatId]) }}');
                    const {
                        messages
                    } = await response.json();

                    messages.forEach((msg) => {
                        const date = new Date(msg.created_at);

                        const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
                            "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
                        ];
                        const day = date.getDate().toString().padStart(2, '0');
                        const month = months[date.getMonth()];
                        const hours = date.getHours();
                        const minutes = date.getMinutes().toString().padStart(2, '0');
                        const period = hours >= 12 ? 'pm' : 'am';
                        const formattedHours = ((hours % 12) || 12).toString().padStart(2, '0');

                        const timeString = `${day} ${month}, ${formattedHours}:${minutes} ${period}`;
                        const message = msg.message;

                        addMessage(message, timeString, 'received');
                    });

                } catch (error) {
                    console.log("Error in getting messages:", error);
                }
            }

            setInterval(() => {
                getMessagesFromBackend()
            }, 4000);


            function sendMessageToBackend(message) {
                fetch('{{ route('storeMsg', ['chatId' => $chatId]) }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '<?= csrf_token() ?>'
                        },
                        body: JSON.stringify({
                            message: message,
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Response:', data);
                    })
                    .catch(err => console.log(err));

            }

            // Initial messages
            const initialMessages = [

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

                    const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
                        "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
                    ];
                    const day = now.getDate().toString().padStart(2, '0');
                    const month = months[now.getMonth()];
                    const hours = now.getHours();
                    const minutes = now.getMinutes().toString().padStart(2, '0');
                    const period = hours >= 12 ? 'pm' : 'am';
                    const formattedHours = ((hours % 12) || 12).toString().padStart(2, '0');

                    const timeString = `${day} ${month}, ${formattedHours}:${minutes} ${period}`;

                    try {

                        setTimeout(() => {
                            sendMessageToBackend(message);
                        }, 1000)
                        
                        addMessage(message, timeString, 'sent');
                    } catch (error) {
                        console.log(error);

                    }

                    // Clear input and reset height
                    messageInput.value = '';
                    messageInput.style.height = 'auto';

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
                    msg.style.animationName = msg.classList.contains('message-sent') ?
                        'messageInRight' : 'messageInLeft';
                }, 100 * index);
            });

            // Initial scroll to bottom
            scrollToBottom();
        });
    </script>
@endsection
