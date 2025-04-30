@extends('layouts.app')

@section('style-section')
    <link rel="stylesheet" href="/css/discover.css">
@endsection

@section('body')
    <main class="container">
        <a href="/" class="back-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 12H5"></path>
                <path d="M12 19l-7-7 7-7"></path>
            </svg>
            Back to Home
        </a>

        <h1 class="page-title">Discover Mathematicians</h1>
        <p class="page-description">Browse all potential connections and send match requests. If interests align, matches
            will be automatically accepted.</p>

        <div class="search-section">
            <div class="search-bar">
                <div class="search-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </div>
                <input type="text" placeholder="Search mathematicians...">
            </div>
            <button class="filter-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="4" y1="21" x2="4" y2="14"></line>
                    <line x1="4" y1="10" x2="4" y2="3"></line>
                    <line x1="12" y1="21" x2="12" y2="12"></line>
                    <line x1="12" y1="8" x2="12" y2="3"></line>
                    <line x1="20" y1="21" x2="20" y2="16"></line>
                    <line x1="20" y1="12" x2="20" y2="3"></line>
                    <line x1="1" y1="14" x2="7" y2="14"></line>
                    <line x1="9" y1="8" x2="15" y2="8"></line>
                    <line x1="17" y1="16" x2="23" y2="16"></line>
                </svg>
                Filter by Interest
            </button>
        </div>

        @foreach ($mathematicians as $user)
            @php
                $url = route('others.profile', ['userId' => $user->id]);

                $userId = $user->id;
                $image = $user->profile->profile_image;
                $name = $user->name;
                $interests = $user->profile->mathematical_interests;
                $achievements = $user->profile->achievements;

            @endphp

            <a href="{{ $url }}">

                <div class="mathematician-card">



                    <img src="{{ $image }}" alt="Sophia Chen" class="mathematician-photo">
                    <div class="mathematician-info">
                        <h2 class="mathematician-name">{{ $name }}</h2>
                        <p class="mathematician-bio">{{ $achievements }} </p>

                        <p class="interests-label">Interests:</p>
                        <div class="interests-tags">

                            @foreach ($interests as $int)
                                <div class="interest-tag">{{ $int }}</div>
                            @endforeach

                        </div>


                        <x-post-button url="{{ route('friend.send', ['receiverId' => $userId]) }}" label="Send Request"
                            class="connect-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="8.5" cy="7" r="4"></circle>
                                <line x1="20" y1="8" x2="20" y2="14"></line>
                                <line x1="23" y1="11" x2="17" y2="11"></line>
                            </svg>
                        </x-post-button>

                        {{-- <button class="connect-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="8.5" cy="7" r="4"></circle>
                            <line x1="20" y1="8" x2="20" y2="14"></line>
                            <line x1="23" y1="11" x2="17" y2="11"></line>
                        </svg>
                        Send Request
                    </button> --}}
                    </div>
                </div>
            </a>
  
        @endforeach




        <div id="mathematician-list">
            <!-- Additional mathematicians will be added here via JavaScript -->
        </div>

    </main>
@endsection

@section('script-section')
    <script>
        // Sample data for additional mathematicians
        // Sample data for additional mathematicians
        const mathematicians = [{
                name: "David Rodriguez",
                photo: "/api/placeholder/400/400",
                bio: "Professor at MIT working on algebraic geometry and number theory. Published over 40 papers and passionate about mentoring young mathematicians.",
                interests: ["Algebraic Geometry", "Number Theory", "Cryptography"],
            },
            {
                name: "Aisha Patel",
                photo: "/api/placeholder/400/400",
                bio: "Applied mathematician specializing in differential equations and their applications to biological systems. Currently researching epidemic modeling.",
                interests: [
                    "Differential Equations",
                    "Mathematical Biology",
                    "Data Science",
                ],
            },
            {
                name: "Michael Zhang",
                photo: "/api/placeholder/400/400",
                bio: "Computational mathematician with expertise in numerical methods and optimization. Developing algorithms for machine learning applications.",
                interests: ["Numerical Analysis", "Optimization", "Machine Learning"],
            },
        ];

        // Function to create mathematician cards
        function createMathematicianCard(mathematician) {
            const card = document.createElement("div");
            card.className = "mathematician-card";

            const interestTags = mathematician.interests
                .map((interest) => `<div class="interest-tag">${interest}</div>`)
                .join("");

            card.innerHTML = `
          <img src="${mathematician.photo}" alt="${mathematician.name}" class="mathematician-photo">
          <div class="mathematician-info">
              <h2 class="mathematician-name">${mathematician.name}</h2>
              <p class="mathematician-bio">${mathematician.bio}</p>
              
              <p class="interests-label">Interests:</p>
              <div class="interests-tags">
                  ${interestTags}
              </div>
              
              <button class="connect-btn">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                      <circle cx="8.5" cy="7" r="4"></circle>
                      <line x1="20" y1="8" x2="20" y2="14"></line>
                      <line x1="23" y1="11" x2="17" y2="11"></line>
                  </svg>
                  Send Request
              </button>
          </div>
      `;

            return card;
        }

        // Add event listeners
        document.addEventListener("DOMContentLoaded", function() {
            const mathematicianList = document.getElementById("mathematician-list");

            // // Add sample mathematicians to the page
            // mathematicians.forEach((mathematician) => {
            //     const card = createMathematicianCard(mathematician);
            //     mathematicianList.appendChild(card);
            // });

            // Search functionality
            const searchInput = document.querySelector(".search-bar input");
            searchInput.addEventListener("input", function(e) {
                const searchTerm = e.target.value.toLowerCase();
                const allCards = document.querySelectorAll(".mathematician-card");

                let visibleCardsCount = 0;

                allCards.forEach((card) => {
                    const name = card
                        .querySelector(".mathematician-name")
                        .textContent.toLowerCase();
                    const bio = card
                        .querySelector(".mathematician-bio")
                        .textContent.toLowerCase();
                    const interests = card.querySelectorAll(".interest-tag");

                    let matchesSearch =
                        name.includes(searchTerm) || bio.includes(searchTerm);

                    if (!matchesSearch) {
                        interests.forEach((tag) => {
                            if (tag.textContent.toLowerCase().includes(searchTerm)) {
                                matchesSearch = true;
                            }
                        });
                    }

                    card.style.display = matchesSearch ? "flex" : "none";
                    if (matchesSearch) visibleCardsCount++;
                });

                // Handle no matches found
                showNoMatchesMessage(visibleCardsCount === 0);
            });



            // Get references to elements for filter
            const filterBtn = document.querySelector(".filter-btn");
            const searchSection = document.querySelector(".search-section");

            // Create filter dropdown
            const filterDropdown = document.createElement("div");
            filterDropdown.className = "filter-dropdown";
            filterDropdown.style.display = "none";

            // Math interests
            const interests = [
                "Number Theory",
    "Abstract Algebra",
    "Calculus",
    "Real Analysis",
    "Complex Analysis",
    "Topology",
    "Differential Geometry",
    "Linear Algebra",
    "Combinatorics",
    "Graph Theory",
    "Probability Theory",
    "Statistics",
    "Applied Mathematics",
    "Mathematical Physics",
    "Mathematical Logic"
];



            // Create header
            const header = document.createElement("h3");
            header.textContent = "Math Interests";
            header.style.marginTop = "0";
            header.style.marginBottom = "15px";
            header.style.fontSize = "18px";
            filterDropdown.appendChild(header);

            // Create clear filter button
            const clearBtn = document.createElement("button");
            clearBtn.textContent = "Clear Filter";
            clearBtn.className = "clear-filter-btn";
            clearBtn.style.backgroundColor = "#f5f5f5";
            clearBtn.style.border = "1px solid #ddd";
            clearBtn.style.padding = "8px 15px";
            clearBtn.style.borderRadius = "20px";
            clearBtn.style.cursor = "pointer";
            clearBtn.style.fontSize = "14px";
            clearBtn.style.marginBottom = "15px";
            clearBtn.style.fontWeight = "normal";
            clearBtn.style.color = "#333";
            filterDropdown.appendChild(clearBtn);

            // Container for interest pills
            const interestsContainer = document.createElement("div");
            interestsContainer.style.display = "flex";
            interestsContainer.style.flexWrap = "wrap";
            interestsContainer.style.gap = "10px";
            interestsContainer.style.maxHeight = "300px";
            interestsContainer.style.overflowY = "auto";
            interestsContainer.style.paddingRight = "5px";

            // Add interest pills
            interests.forEach((interest) => {
                const interestPill = document.createElement("div");
                interestPill.className = "interest-pill";
                interestPill.textContent = interest;
                interestPill.dataset.interest = interest;
                interestPill.style.padding = "8px 15px";
                interestPill.style.backgroundColor = "#f5f5f5";
                interestPill.style.borderRadius = "20px";
                interestPill.style.cursor = "pointer";
                interestPill.style.transition = "all 0.2s";
                interestPill.style.fontSize = "14px";

                interestPill.addEventListener("click", function() {
                    this.classList.toggle("active");

                    if (this.classList.contains("active")) {
                        this.style.backgroundColor = "#e6f4ff";
                        this.style.color = "#1677ff";
                        this.style.border = "1px solid #1677ff";
                    } else {
                        this.style.backgroundColor = "#f5f5f5";
                        this.style.color = "#333";
                        this.style.border = "1px solid transparent";
                    }

                    updateFilterDisplay();
                    filterMathematicians();
                });

                interestsContainer.appendChild(interestPill);
            });

            filterDropdown.appendChild(interestsContainer);

            // Add the dropdown to the DOM
            filterBtn.style.position = "relative";
            filterDropdown.style.position = "absolute";
            filterDropdown.style.top = "40px";
            filterDropdown.style.right = "0";
            filterDropdown.style.backgroundColor = "white";
            filterDropdown.style.border = "1px solid #ddd";
            filterDropdown.style.borderRadius = "8px";
            filterDropdown.style.padding = "15px";
            filterDropdown.style.minWidth = "300px";
            filterDropdown.style.boxShadow = "0 2px 10px rgba(0,0,0,0.1)";
            filterDropdown.style.zIndex = "100";

            // Add dropdown arrow indicator
            const dropdownArrow = document.createElement("div");
            dropdownArrow.style.position = "absolute";
            dropdownArrow.style.top = "-8px";
            dropdownArrow.style.right = "15px";
            dropdownArrow.style.width = "16px";
            dropdownArrow.style.height = "16px";
            dropdownArrow.style.backgroundColor = "white";
            dropdownArrow.style.transform = "rotate(45deg)";
            dropdownArrow.style.borderTop = "1px solid #ddd";
            dropdownArrow.style.borderLeft = "1px solid #ddd";
            dropdownArrow.style.zIndex = "-1"; // Place behind the dropdown content
            filterDropdown.appendChild(dropdownArrow);

            // Make sure to append to the parent, not to the button itself
            document.querySelector(".search-section").appendChild(filterDropdown);

            // Toggle filter dropdown when clicking the filter button
            filterBtn.addEventListener("click", function(e) {
                e.stopPropagation();
                const isVisible = filterDropdown.style.display === "block";
                filterDropdown.style.display = isVisible ? "none" : "block";

                // Position the dropdown relative to the button
                if (!isVisible) {
                    const btnRect = filterBtn.getBoundingClientRect();
                    filterDropdown.style.top = (btnRect.bottom + window.scrollY) + "px";
                    filterDropdown.style.right = (window.innerWidth - btnRect.right) + "px";
                }
            });

            // Clear filter button functionality
            clearBtn.addEventListener("click", function(e) {
                e.stopPropagation(); // Prevent dropdown from closing

                const activePills = document.querySelectorAll(".interest-pill.active");
                activePills.forEach(pill => {
                    pill.classList.remove("active");
                    pill.style.backgroundColor = "#f5f5f5";
                    pill.style.color = "#333";
                    pill.style.border = "1px solid transparent";
                });

                updateFilterDisplay();
                filterMathematicians();
            });

            // Close dropdown when clicking outside
            document.addEventListener("click", function(event) {
                if (!filterDropdown.contains(event.target) && event.target !== filterBtn) {
                    filterDropdown.style.display = "none";
                }
            });

            // Function to update filter button text
            function updateFilterDisplay() {
                const selectedInterests = document.querySelectorAll(".interest-pill.active");
                const activeFilters = selectedInterests.length > 0;

                if (activeFilters) {
                    filterBtn.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="4" y1="21" x2="4" y2="14"></line>
          <line x1="4" y1="10" x2="4" y2="3"></line>
          <line x1="12" y1="21" x2="12" y2="12"></line>
          <line x1="12" y1="8" x2="12" y2="3"></line>
          <line x1="20" y1="21" x2="20" y2="16"></line>
          <line x1="20" y1="12" x2="20" y2="3"></line>
          <line x1="1" y1="14" x2="7" y2="14"></line>
          <line x1="9" y1="8" x2="15" y2="8"></line>
          <line x1="17" y1="16" x2="23" y2="16"></line>
        </svg>
        Filters (${selectedInterests.length})
      `;
                    filterBtn.style.backgroundColor = "#1677ff";
                    filterBtn.style.color = "white";
                } else {
                    filterBtn.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="4" y1="21" x2="4" y2="14"></line>
          <line x1="4" y1="10" x2="4" y2="3"></line>
          <line x1="12" y1="21" x2="12" y2="12"></line>
          <line x1="12" y1="8" x2="12" y2="3"></line>
          <line x1="20" y1="21" x2="20" y2="16"></line>
          <line x1="20" y1="12" x2="20" y2="3"></line>
          <line x1="1" y1="14" x2="7" y2="14"></line>
          <line x1="9" y1="8" x2="15" y2="8"></line>
          <line x1="17" y1="16" x2="23" y2="16"></line>
        </svg>
        Filter by Interest
      `;
                    filterBtn.style.backgroundColor = "#f5f5f5";
                    filterBtn.style.color = "#333";
                }
            }

            // Function to filter mathematicians based on selected interests
            function filterMathematicians() {
                const selectedInterests = Array.from(
                    document.querySelectorAll(".interest-pill.active")
                ).map((pill) => pill.dataset.interest);

                const allCards = document.querySelectorAll(".mathematician-card");
                const activeFilters = selectedInterests.length > 0;

                // Keep track of visible cards
                let visibleCardsCount = 0;

                allCards.forEach((card) => {
                    if (!activeFilters) {
                        card.style.display = "flex";
                        visibleCardsCount++;
                        return;
                    }

                    const cardInterests = Array.from(
                        card.querySelectorAll(".interest-tag")
                    ).map((tag) => tag.textContent);

                    const hasMatchingInterest = selectedInterests.some((interest) =>
                        cardInterests.includes(interest)
                    );

                    card.style.display = hasMatchingInterest ? "flex" : "none";
                    if (hasMatchingInterest) visibleCardsCount++;
                });

                // Handle no matches found
                showNoMatchesMessage(visibleCardsCount === 0);
            }

            // Function to show/hide the no matches message
            function showNoMatchesMessage(show) {
                // Check if the message already exists
                let noMatchesMsg = document.getElementById("no-matches-message");

                // If it doesn't exist, create it
                if (!noMatchesMsg) {
                    noMatchesMsg = document.createElement("div");
                    noMatchesMsg.id = "no-matches-message";
                    noMatchesMsg.className = "no-matches-message";
                    noMatchesMsg.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="11" cy="11" r="8"></circle>
          <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
          <line x1="8" y1="11" x2="14" y2="11" stroke-width="2"></line>
        </svg>
        <h3>No matches found</h3>
        <p>Try adjusting your search or filters</p>
      `;
                    // Insert after the search section
                    const searchSection = document.querySelector(".search-section");
                    searchSection.insertAdjacentElement('afterend', noMatchesMsg);
                }

                // Show or hide the message
                noMatchesMsg.style.display = show ? "flex" : "none";
            }

            // Add responsive styles
            const style = document.createElement("style");
            style.textContent = `
    .filter-btn {
      background-color: #f5f5f5;
      border: 1px solid #ddd;
      border-radius: 30px;
      padding: 8px 16px;
      display: flex;
      align-items: center;
      gap: 8px;
      cursor: pointer;
      transition: all 0.2s;
      font-size: 14px;
    }
    
    .filter-dropdown {
      min-width: 280px;
    }
    
    .interest-pill {
      border: 1px solid transparent;
    }
    
    .interest-pill.active {
      background-color: #e6f4ff !important;
      color: #1677ff !important;
      border: 1px solid #1677ff !important;
    }
    
    .no-matches-message {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 40px 20px;
      margin: 20px 0;
      background-color: #f9f9f9;
      border-radius: 8px;
      color: #666;
      text-align: center;
    }
    
    .no-matches-message svg {
      margin-bottom: 16px;
      color: #bbb;
    }
    
    .no-matches-message h3 {
      margin: 0 0 8px 0;
      font-size: 18px;
      font-weight: 500;
    }
    
    .no-matches-message p {
      margin: 0;
      font-size: 14px;
    }
    
    @media (max-width: 768px) {
      .filter-dropdown {
        width: calc(100% - 30px);
        right: 15px !important;
        left: 15px;
        margin: 0 auto;
      }
    }
  `;
            document.head.appendChild(style);
        });
    </script>
@endsection
