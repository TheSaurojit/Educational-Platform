@extends('layouts.app')

@section('style-section')
    <link rel="stylesheet" href="/css/matches.css">
@endsection

@section('body')
<main class="container">
    <a href="/" class="back-link">
        <span class="back-icon">←</span> Back to Home
    </a>

    <h1 class="page-title">Mathematical Connections</h1>
    <p class="page-subtitle">Discover and connect with math enthusiasts who share your interests.</p>

    <div class="tabs">
        <div class="tab" id="potential-tab">Potential Matches</div>
        <div class="tab" id="your-tab">Your Matches</div>
    </div>

    <div class="search-filter">
        <div class="search-bar">
            <span class="search-icon">🔍</span>
            <input type="text" class="search-input" id="search-input" placeholder="Search matches...">
        </div>
        <button class="filter-btn">
            <span class="filter-icon">≡</span> Filter by Interest
        </button>
    </div>

    <div id="matches-container">
        <!-- Content will be loaded here with JavaScript -->
    </div>
</main>
@endsection

@section('script-section')
    <script>
    document.addEventListener("DOMContentLoaded", function () {
  const potentialTab = document.getElementById('potential-tab');
  const yourTab = document.getElementById('your-tab');
  const searchInput = document.getElementById('search-input');
  const matchesContainer = document.getElementById('matches-container');
  const filterBtn = document.querySelector('.filter-btn');

  // Initially set the potential tab as active and load its content
  let activeTab = 'potential';
  potentialTab.classList.add('active');
  loadContent(activeTab);

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
    "Mathematical Physics",
    "Algebraic Geometry",
    "Cryptography",
    "Mathematical Biology",
    "Data Science",
    "Numerical Analysis",
    "Optimization",
    "Machine Learning",
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
      
      // Always reload content before filtering to ensure we have the base content
      if (activeTab === 'your') {
        loadYourMatchesContent();
      }
      
      filterMatches();
    });
    
    interestsContainer.appendChild(interestPill);
  });

  filterDropdown.appendChild(interestsContainer);

  // Add the dropdown to the DOM
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
  
  // Make sure to append to the parent with proper positioning
  const searchFilter = document.querySelector(".search-filter");
  searchFilter.style.position = "relative";
  searchFilter.appendChild(filterDropdown);

  // Toggle filter dropdown when clicking the filter button
  filterBtn.addEventListener("click", function (e) {
    e.stopPropagation();
    const isVisible = filterDropdown.style.display === "block";
    filterDropdown.style.display = isVisible ? "none" : "block";
    
    // Position the dropdown relative to the button
    if (!isVisible) {
      const btnRect = filterBtn.getBoundingClientRect();
      filterDropdown.style.top = (btnRect.bottom + window.scrollY - searchFilter.getBoundingClientRect().top) + "px";
      filterDropdown.style.right = "0";
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
    
    // Always reload content when clearing filters
    loadContent(activeTab);
  });

  // Close dropdown when clicking outside
  document.addEventListener("click", function (event) {
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
        <span class="filter-icon">≡</span> Filters (${selectedInterests.length})
      `;
      filterBtn.style.backgroundColor = "#1677ff";
      filterBtn.style.color = "white";
    } else {
      filterBtn.innerHTML = `
        <span class="filter-icon">≡</span> Filter by Interest
      `;
      filterBtn.style.backgroundColor = "";
      filterBtn.style.color = "";
    }
  }
  
  // Function to load only "Your Matches" content
  function loadYourMatchesContent() {
    matchesContainer.innerHTML = `
      <div class="match-card">
        <img src="https://via.placeholder.com/400x300" class="profile-image" alt="Profile picture">
        <div class="profile-info">
          <h2 class="profile-name">Aisha Patel</h2>
          <p class="matched-on">Matched on <a href="#" class="match-tag">Number Theory</a></p>
          <p class="profile-description">
            Professor of Mathematics specializing in combinatorics and graph theory. I'm passionate about 
            mathematical education and making mathematics accessible to underprivileged communities.
          </p>
          <p class="interests-title">All Interests:</p>
          <div class="interest-tags">
            <span class="interest-tag">Combinatorics</span>
            <span class="interest-tag">Graph Theory</span>
            <span class="interest-tag active">Number Theory</span>
          </div>
          <div class="match-footer">
            <div class="date">Apr 12, 2023</div>
            <div class="message-count">
              <span class="message-icon">💬</span> 2 messages
            </div>
            <a href="/chat">
            <button class="chat-now-btn">
              <span class="chat-icon">💬</span> Chat Now
            </button>
            </a>
          </div>
        </div>
      </div>
    `;
  }

  // Function to filter matches based on selected interests
  function filterMatches() {
    const selectedInterests = Array.from(
      document.querySelectorAll(".interest-pill.active")
    ).map((pill) => pill.dataset.interest);

    const allCards = document.querySelectorAll(".match-card");
    const activeFilters = selectedInterests.length > 0;
    
    let visibleCardsCount = 0;

    if (allCards.length === 0 && activeTab === 'potential') {
      // No cards to filter in potential tab - return early
      return;
    }

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
    
    // Show empty state if no matches found
    showNoMatchesMessage(visibleCardsCount === 0 && activeTab === 'your');
  }

  // Function to show/hide the no matches message
  function showNoMatchesMessage(show) {
    if (show) {
      matchesContainer.innerHTML = `
        <div class="match-card-empty">
          <div class="profile-icon">🔍</div>
          <h2 class="empty-message">No matches found</h2>
          <p class="empty-description">
            Try adjusting your filter criteria or search terms
          </p>
        </div>
      `;
    }
  }

  // Function to load the appropriate content based on the active tab
  function loadContent(tab) {
    if (tab === 'your') {
      // Display the "Your Matches" content
      loadYourMatchesContent();
      searchInput.placeholder = "Search matches...";
    } else {
      // Display the "Potential Matches" content (empty state)
      matchesContainer.innerHTML = `
        <div class="match-card-empty">
          <div class="profile-icon">👤</div>
          <h2 class="empty-message">No potential matches found</h2>
          <p class="empty-description">
            Try adjusting your filter criteria or add more interests to your profile
          </p>
        </div>
      `;
      searchInput.placeholder = "Search potential matches...";
    }
    
    // After loading content, apply any active filters
    filterMatches();
  }

  // Search functionality
  searchInput.addEventListener("input", function() {
    // Always reload content before applying search to ensure we have the base content
    if (activeTab === 'your') {
      loadYourMatchesContent();
    }
    
    const searchTerm = this.value.toLowerCase();
    const allCards = document.querySelectorAll(".match-card");
    
    if (allCards.length === 0) {
      // No cards to search through - return early
      return;
    }
    
    let visibleCardsCount = 0;
    
    allCards.forEach(card => {
      const name = card.querySelector(".profile-name").textContent.toLowerCase();
      const description = card.querySelector(".profile-description").textContent.toLowerCase();
      const interests = Array.from(card.querySelectorAll(".interest-tag"))
        .map(tag => tag.textContent.toLowerCase());
      
      const matchesSearch = 
        name.includes(searchTerm) || 
        description.includes(searchTerm) ||
        interests.some(interest => interest.includes(searchTerm));
      
      card.style.display = matchesSearch ? "flex" : "none";
      if (matchesSearch) visibleCardsCount++;
    });
    
    // Show empty state if no matches found
    showNoMatchesMessage(visibleCardsCount === 0 && activeTab === 'your');
    
    // Apply any active filters after search
    filterMatches();
  });

  // Event listeners for tab switching
  potentialTab.addEventListener('click', () => {
    if (activeTab !== 'potential') {
      activeTab = 'potential';
      potentialTab.classList.add('active');
      yourTab.classList.remove('active');
      loadContent(activeTab);
      
      // Clear search and filters when switching tabs
      searchInput.value = '';
      const activePills = document.querySelectorAll(".interest-pill.active");
      activePills.forEach(pill => {
        pill.classList.remove("active");
        pill.style.backgroundColor = "#f5f5f5";
        pill.style.color = "#333";
        pill.style.border = "1px solid transparent";
      });
      updateFilterDisplay();
    }
  });

  yourTab.addEventListener('click', () => {
    if (activeTab !== 'your') {
      activeTab = 'your';
      yourTab.classList.add('active');
      potentialTab.classList.remove('active');
      loadContent(activeTab);
      
      // Clear search and filters when switching tabs
      searchInput.value = '';
      const activePills = document.querySelectorAll(".interest-pill.active");
      activePills.forEach(pill => {
        pill.classList.remove("active");
        pill.style.backgroundColor = "#f5f5f5";
        pill.style.color = "#333";
        pill.style.border = "1px solid transparent";
      });
      updateFilterDisplay();
    }
  });

  // Add responsive styles
  const style = document.createElement("style");
  style.textContent = `
    .filter-btn {
      display: flex;
      align-items: center;
      gap: 8px;
      cursor: pointer;
      transition: all 0.2s;
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
