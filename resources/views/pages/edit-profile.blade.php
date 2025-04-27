@extends('layouts.app')

@section('style-section')
    <link rel="stylesheet" href="/css/create_account.css">
@endsection

@section('body')
    <div class="container">
        <h1>
            @if ($data)
                Update
            @else
                Create
            @endif

            Your Profile
        </h1>


        <form id="profile-form" method="POST" enctype="multipart/form-data"
            action="{{ $data ? route('update-profile') : route('create-profile') }}">
            @csrf
            <div class="form-group">
                <label for="profile-image" class="required">Profile Image</label>
                <div class="image-upload" id="image-upload-area">


                    <img id="preview-image" src="{{ $data ? $data['profile_image'] : '/default/img.png' }} "
                        alt="Profile Image">


                    <input type="file" id="file-input" accept="image/*" name="profile_image">
                    <button type="button" class="upload-btn">Upload Photo</button>
                </div>
            </div>



            <div class="form-group">
                <label class="required">Are you a mathematician?</label>
                <div class="radio-group">
                    <div class="radio-option">
                        <input type="radio" id="mathematician-yes" name="is_mathematician" value="true"
                            {{ $data && $data['is_mathematician'] == true ? 'checked' : '' }}>
                        <span class="radio-custom"></span>
                        <label for="mathematician-yes">Yes</label>
                    </div>
                    <div class="radio-option">
                        <input type="radio" id="mathematician-no" name="is_mathematician" value="false"
                            {{ $data && $data['is_mathematician'] == false ? 'checked' : '' }}>
                        <span class="radio-custom"></span>
                        <label for="mathematician-no">No</label>
                    </div>
                </div>
                <div class="error-message" id="mathematician-error" style="display: none;">Please select an option</div>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <textarea id="address" name="address">
                    {{ $data ? $data['address'] : '' }} 
                </textarea>
            </div>

            <div class="form-group">
                <label for="interests" class="required">Mathematical Interests <span class="interest-count"
                        id="interest-count">0/5</span></label>
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
                <textarea id="achievements" name="achievements"
                    placeholder="List any mathematical achievements, competitions, or awards">
                
                    {{ $data ? $data['achievements'] : '' }} 

                </textarea>
            </div>

            <div class="form-group">
                <label for="social-media">Social Media</label>
                <div class="social-media-container">
                    <div class="social-media-item">
                        <div class="social-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#1877F2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                            </svg>
                        </div>
                        <input type="url" placeholder="Facebook URL" name="facebook" value="{{ $data ? $data['facebook'] : '' }} ">
                    </div>
                    <div class="social-media-item">
                        <div class="social-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#E4405F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                            </svg>
                        </div>
                        <input type="url" placeholder="Instagram URL" name="instagram" value="{{ $data ? $data['instagram'] : '' }} ">
                    </div>
                    <div class="social-media-item">
                        <div class="social-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#0A66C2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                                <rect x="2" y="9" width="4" height="12"></rect>
                                <circle cx="4" cy="4" r="2"></circle>
                            </svg>
                        </div>
                        <input type="url" placeholder="LinkedIn URL" name="linkedin" value="{{ $data ? $data['linkedin'] : '' }} ">
                    </div>
                    <div class="social-media-item">
                        <div class="social-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#FF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"></path>
                                <polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02" fill="#FF0000"></polygon>
                            </svg>
                        </div>
                        <input type="url" placeholder="YouTube URL" name="youtube" value="{{ $data ? $data['youtube'] : '' }} ">
                    </div>
                </div>
            </div>

            <button type="submit" class="submit-btn">
                @if ($data)
                    Update
                @else
                    Create
                @endif
                Profile
            </button>
        </form>
    </div>
@endsection

@section('script-section')
    <script>
     
    const prevSelectedInterests = <?= json_encode($data ? $data['mathematical_interests'] : []) ?>;

        const imageUploadArea = document.getElementById('image-upload-area');
        const fileInput = document.getElementById('file-input');
        const previewImage = document.getElementById('preview-image');
        const mathematicianError = document.getElementById('mathematician-error');

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

        // Handle radio button highlighting
        const radioOptions = document.querySelectorAll('.radio-option');
        radioOptions.forEach(option => {
            option.addEventListener('click', function() {
                const radio = this.querySelector('input[type="radio"]');
                radio.checked = true;
                mathematicianError.style.display = 'none';
            });
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

        prevSelectedInterests.map(prev => addInterest(prev) )


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


        function addInterest(interest) {
            selectedInterests.push(interest);

            const tag = document.createElement('div');
            tag.className = 'interest-tag';
            tag.innerHTML = `${interest} <span>✕</span>`;


            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'mathematical_interests[]';
            hiddenInput.value = interest;
            hiddenInput.className = 'interest-hidden-input';
            tag.appendChild(hiddenInput);

            tag.querySelector('span').addEventListener('click', () => {
                removeInterest(interest);
            });

            interestsContainer.appendChild(tag);
            updateInterestCount();
            updateOptionsState();
        }


        function removeInterest(interest) {
            selectedInterests = selectedInterests.filter(item => item !== interest);


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
                    option.style.backgroundColor = '#f0f0f0';
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
    </script>
@endsection
