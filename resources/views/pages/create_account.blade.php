@extends('layouts.app')

@section('style-section')
  <link rel="stylesheet" href="/css/create_account.css">
@endsection

@section('body')
<div class="container">
    <h1>Create Your Profile</h1>
    
    <form id="profile-form">
        <div class="form-group">
            <label for="profile-image" class="required">Profile Image</label>
            <div class="image-upload" id="image-upload-area">
                <img id="preview-image" src="/api/placeholder/150/150" alt="Profile Image">
                <input type="file" id="file-input" accept="image/*">
                <button type="button" class="upload-btn">Upload Photo</button>
            </div>
        </div>
        
        <div class="form-group">
            <label for="name" class="required">Full Name</label>
            <input type="text" id="name" name="name" required>
        </div>
        
        <div class="form-group">
            <label for="email" class="required">Email Address</label>
            <input type="email" id="email" name="email" required>
        </div>
        
        <div class="form-group">
            <label for="address">Address</label>
            <textarea id="address" name="address"></textarea>
        </div>
        
        <div class="form-group">
            <label for="interests" class="required">Mathematical Interests <span class="interest-count" id="interest-count">0/5</span></label>
            <div class="custom-select-container">
                <div class="custom-select" id="interests-select">
                    <span>Select interests (1-5)</span>
                    <div class="select-arrow"></div>
                </div>
                <div class="options-container" id="options-container">
                    <!-- Options will be populated by JavaScript -->
                </div>
            </div>
            <div class="error-message" id="interests-error">Please select at least one interest</div>
            <div class="interests-container" id="interests-container">
                <!-- Selected interests will appear here -->
            </div>
        </div>
        
        <div class="form-group">
            <label for="achievements">Achievements</label>
            <textarea id="achievements" name="achievements" placeholder="List any mathematical achievements, competitions, or awards"></textarea>
        </div>
        
        <div class="form-group">
            <label for="social-media">Social Media</label>
            <div class="social-media-container">
                <div class="social-media-item">
                    <div class="social-icon">📘</div>
                    <input type="url" placeholder="Facebook URL">
                </div>
                <div class="social-media-item">
                    <div class="social-icon">🐦</div>
                    <input type="url" placeholder="Twitter URL">
                </div>
                <div class="social-media-item">
                    <div class="social-icon">🔗</div>
                    <input type="url" placeholder="LinkedIn URL">
                </div>
                <div class="social-media-item">
                    <div class="social-icon">📹</div>
                    <input type="url" placeholder="YouTube URL">
                </div>
            </div>
        </div>
        
        <button type="submit" class="submit-btn">Create Profile</button>
    </form>
</div>
@endsection

@section('script-section')
    <script>
               const imageUploadArea = document.getElementById('image-upload-area');
        const fileInput = document.getElementById('file-input');
        const previewImage = document.getElementById('preview-image');
        
        imageUploadArea.addEventListener('click', () => {
            fileInput.click();
        });
        
        fileInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (event) => {
                    previewImage.src = event.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
        
        // Mathematical interests dropdown
        const mathInterests = [
            "Arithmetic", 
            "Pre-Algebra", 
            "Algebra", 
            "Geometry",
            "Trigonometry", 
            "Calculus", 
            "Linear Algebra", 
            "Discrete Mathematics",
            "Applied Mathematics", 
            "Probability and Statistics", 
            "Differential Equations", 
            "Abstract Algebra",
            "Number Theory", 
            "Real and Complex Analysis", 
            "Mathematical Logic and Foundations", 
            "Topology"
        ];
        
        const interestsSelect = document.getElementById('interests-select');
        const optionsContainer = document.getElementById('options-container');
        const interestsContainer = document.getElementById('interests-container');
        const interestCount = document.getElementById('interest-count');
        const interestsError = document.getElementById('interests-error');
        
        let selectedInterests = [];
        const MAX_INTERESTS = 5;
        
        // Populate options
        mathInterests.forEach(interest => {
            const option = document.createElement('div');
            option.className = 'option';
            option.textContent = interest;
            option.dataset.value = interest;
            
            option.addEventListener('click', () => {
                if (selectedInterests.includes(interest)) {
                    // Remove if already selected
                    removeInterest(interest);
                } else if (selectedInterests.length < MAX_INTERESTS) {
                    // Add if under max limit
                    addInterest(interest);
                }
            });
            
            optionsContainer.appendChild(option);
        });
        
        // Toggle dropdown
        interestsSelect.addEventListener('click', () => {
            interestsSelect.classList.toggle('active');
            optionsContainer.classList.toggle('show');
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!interestsSelect.contains(e.target) && !optionsContainer.contains(e.target)) {
                interestsSelect.classList.remove('active');
                optionsContainer.classList.remove('show');
            }
        });
        
        // Add interest tag
        function addInterest(interest) {
            selectedInterests.push(interest);
            
            const tag = document.createElement('div');
            tag.className = 'interest-tag';
            tag.innerHTML = `${interest} <span>✕</span>`;
            
            tag.querySelector('span').addEventListener('click', () => {
                removeInterest(interest);
            });
            
            interestsContainer.appendChild(tag);
            updateInterestCount();
            updateOptionsState();
        }
        
        // Remove interest tag
        function removeInterest(interest) {
            selectedInterests = selectedInterests.filter(item => item !== interest);
            
            // Remove tag from container
            const tags = interestsContainer.querySelectorAll('.interest-tag');
            tags.forEach(tag => {
                if (tag.textContent.replace('✕', '').trim() === interest) {
                    tag.remove();
                }
            });
            
            updateInterestCount();
            updateOptionsState();
        }
        
        // Update interest count display
        function updateInterestCount() {
            interestCount.textContent = `${selectedInterests.length}/5`;
            
            // Show error if no interests selected
            if (selectedInterests.length === 0) {
                interestsError.style.display = 'block';
            } else {
                interestsError.style.display = 'none';
            }
        }
        
        // Update options state (disable when max reached)
        function updateOptionsState() {
            const options = optionsContainer.querySelectorAll('.option');
            
            options.forEach(option => {
                const value = option.dataset.value;
                
                if (selectedInterests.includes(value)) {
                    option.style.backgroundColor = (--gray-light);
                    option.style.fontWeight = 'bold';
                } else {
                    option.style.backgroundColor = '';
                    option.style.fontWeight = 'normal';
                }
                
                if (selectedInterests.length >= MAX_INTERESTS && !selectedInterests.includes(value)) {
                    option.classList.add('disabled-option');
                } else {
                    option.classList.remove('disabled-option');
                }
            });
        }
        
        // Form submission
        const profileForm = document.getElementById('profile-form');
        
        profileForm.addEventListener('submit', (e) => {
            e.preventDefault();
            
            // Validate interests (at least one required)
            if (selectedInterests.length === 0) {
                interestsError.style.display = 'block';
                interestsSelect.style.borderColor = 'red';
                return;
            }
            
            // Collect form data
            const formData = new FormData(profileForm);
            formData.append('interests', JSON.stringify(selectedInterests));
            
            // Here you would normally send this data to your server
            console.log('Form submitted!');
            console.log('Interests:', selectedInterests);
            
            // Show success message
            alert('Profile created successfully!');
        });
    </script>
@endsection
