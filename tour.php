<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plan Your Tour - Alexandria Guide</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="logo">
            <h1>🌊 Alexandria Guide</h1>
            <p>Pearl of the Mediterranean</p>
        </div>
        <nav>
            <ul class="menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="tour.php">Plan Your Tour</a></li>
                <li><a href="reviews.php">Reviews</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="page-header">
            <h2>Plan Your Perfect Tour</h2>
            <p>Sign up to create your personalized itinerary</p>
        </div>

        <div class="tour-container">
            <div class="auth-forms">
                <div class="form-card">
                    <h3>📝 Sign Up</h3>
                    <form id="signupForm">
                        <input type="text" id="signupName" placeholder="Full Name" required>
                        <input type="email" id="signupEmail" placeholder="Email" required>
                        <input type="password" id="signupPassword" placeholder="Password" required>
                        <button type="submit">Register</button>
                    </form>
                    <p class="form-note">Already have an account? <a href="#" id="showSigninLink">Sign in here</a></p>
                </div>

                <div class="form-card" id="signinCard" style="display:none;">
                    <h3>🔐 Sign In</h3>
                    <form id="signinForm">
                        <input type="email" id="signinEmail" placeholder="Email" required>
                        <input type="password" id="signinPassword" placeholder="Password" required>
                        <button type="submit">Login</button>
                    </form>
                    <p class="form-note">Don't have an account? <a href="#" id="showSignupLink">Sign up here</a></p>
                </div>
            </div>

            <div class="tour-planner" id="tourPlanner" style="display:none;">
                <div class="welcome-message" id="tourMessage"></div>
                <div class="itinerary">
                    <h3>✨ Create Your Custom Itinerary</h3>

                    <div class="form-group">
                        <label>📅 Select tour date:</label>
                        <input type="date" id="tourDate">
                    </div>

                    <div class="form-group">
                        <label>👥 Number of travelers:</label>
                        <div class="traveler-control">
                            <button type="button" class="traveler-btn" id="minusTravelers">−</button>
                            <input type="number" id="travelers" min="1" max="20" value="2" readonly>
                            <button type="button" class="traveler-btn" id="plusTravelers">+</button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>⭐ Select attractions:</label>
                        <div class="attractions-grid">
                            <label class="attraction-option">
                                <input type="checkbox" class="attraction-check" value="Bibliotheca Alexandrina" data-price="15">
                                <span class="checkmark"></span>
                                <span class="attraction-name">📚 Bibliotheca Alexandrina</span>
                                <span class="attraction-price">$15</span>
                            </label>
                            <label class="attraction-option">
                                <input type="checkbox" class="attraction-check" value="Qaitbay Citadel" data-price="10">
                                <span class="checkmark"></span>
                                <span class="attraction-name">🏰 Qaitbay Citadel</span>
                                <span class="attraction-price">$10</span>
                            </label>
                            <label class="attraction-option">
                                <input type="checkbox" class="attraction-check" value="Montazah Gardens" data-price="8">
                                <span class="checkmark"></span>
                                <span class="attraction-name">🌳 Montazah Gardens</span>
                                <span class="attraction-price">$8</span>
                            </label>
                            <label class="attraction-option">
                                <input type="checkbox" class="attraction-check" value="Alexandria Corniche" data-price="0">
                                <span class="checkmark"></span>
                                <span class="attraction-name">🌊 Alexandria Corniche</span>
                                <span class="attraction-price free">Free</span>
                            </label>
                            <label class="attraction-option">
                                <input type="checkbox" class="attraction-check" value="Roman Amphitheater" data-price="12">
                                <span class="checkmark"></span>
                                <span class="attraction-name">🏛️ Roman Amphitheater</span>
                                <span class="attraction-price">$12</span>
                            </label>
                            <label class="attraction-option">
                                <input type="checkbox" class="attraction-check" value="Pompey's Pillar" data-price="8">
                                <span class="checkmark"></span>
                                <span class="attraction-name">🏺 Pompey's Pillar</span>
                                <span class="attraction-price">$8</span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>🏨 Accommodation:</label>
                        <select id="accommodation" class="modern-select">
                            <option value="50">🏨 Budget Hotel - $50/night</option>
                            <option value="100">⭐⭐ Standard Hotel - $100/night</option>
                            <option value="250">⭐⭐⭐⭐ Luxury Resort - $250/night</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>🚗 Transportation:</label>
                        <select id="transport" class="modern-select">
                            <option value="5">🚌 Public Bus - $5/day</option>
                            <option value="20">🚕 Taxi - $20/day</option>
                            <option value="50">🚙 Private Driver - $50/day</option>
                        </select>
                    </div>

                    <div class="total-cost-card">
                        <span>💰 Total Trip Cost</span>
                        <span id="totalCostDisplay">$0</span>
                    </div>

                    <button id="saveTourBtn" class="save-btn">💾 Save My Tour Plan</button>
                    <div id="savedPlan"></div>
                </div>
            </div>
        </div>

        <div class="back-to-top">
            <a href="#">↑ Back to Top</a>
        </div>
    </main>

    <footer>
        <p>&copy; 2026 Alexandria Guide. All rights reserved.</p>
        <p><a href="index.php">Back to Home</a> | <a href="contact.php">Contact Us</a></p>
    </footer>

    <script>
    // Show/Hide Sign In/Sign Up forms
    document.getElementById('showSigninLink')?.addEventListener('click', function(e) {
        e.preventDefault();
        document.querySelector('.form-card:first-child').style.display = 'none';
        document.getElementById('signinCard').style.display = 'block';
    });
    
    document.getElementById('showSignupLink')?.addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('signinCard').style.display = 'none';
        document.querySelector('.form-card:first-child').style.display = 'block';
    });

    // SIGN UP
    document.getElementById('signupForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        const name = document.getElementById('signupName').value;
        const email = document.getElementById('signupEmail').value;
        const password = document.getElementById('signupPassword').value;
        
        fetch('tour_api.php?action=signup', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ name, email, password })
        })
        .then(res => res.json())
        .then(data => {
            if(data.success) {
                alert('✅ Registration successful! Please sign in.');
                document.getElementById('signinCard').style.display = 'block';
                document.querySelector('.form-card:first-child').style.display = 'none';
            } else {
                alert('❌ ' + data.message);
            }
        })
        .catch(err => alert('Connection error: ' + err));
    });

    // SIGN IN
    document.getElementById('signinForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        const email = document.getElementById('signinEmail').value;
        const password = document.getElementById('signinPassword').value;
        
        fetch('tour_api.php?action=signin', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ email, password })
        })
        .then(res => res.json())
        .then(data => {
            if(data.success) {
                localStorage.setItem('currentUser', JSON.stringify(data.user));
                document.querySelector('.auth-forms').style.display = 'none';
                document.getElementById('tourPlanner').style.display = 'block';
                document.getElementById('tourMessage').innerHTML = '<div class="welcome-message" style="background:#e8f4f8; padding:1rem;">✨ Welcome ' + data.user.name + '! Plan your dream tour below.</div>';
            } else {
                alert('❌ ' + data.message);
            }
        })
        .catch(err => alert('Connection error: ' + err));
    });

    // Traveler counter
    let travelerCount = 2;
    const travelersInput = document.getElementById('travelers');
    const minusBtn = document.getElementById('minusTravelers');
    const plusBtn = document.getElementById('plusTravelers');
    
    if(minusBtn && plusBtn && travelersInput) {
        minusBtn.addEventListener('click', () => {
            let val = parseInt(travelersInput.value);
            if(val > 1) { travelersInput.value = val - 1; travelerCount = val - 1; calculateTotalCost(); }
        });
        plusBtn.addEventListener('click', () => {
            let val = parseInt(travelersInput.value);
            if(val < 20) { travelersInput.value = val + 1; travelerCount = val + 1; calculateTotalCost(); }
        });
    }

    function calculateTotalCost() {
        let attractionsTotal = 0;
        document.querySelectorAll('.attraction-check:checked').forEach(cb => {
            attractionsTotal += parseInt(cb.getAttribute('data-price'));
        });
        const accommodationPrice = parseInt(document.getElementById('accommodation').value) || 0;
        const transportPrice = parseInt(document.getElementById('transport').value) || 0;
        const travelers = parseInt(document.getElementById('travelers').value) || 1;
        const totalCost = (attractionsTotal + accommodationPrice + transportPrice) * travelers;
        document.getElementById('totalCostDisplay').textContent = '$' + totalCost;
        return totalCost;
    }

    document.querySelectorAll('.attraction-check').forEach(cb => cb.addEventListener('change', calculateTotalCost));
    document.getElementById('accommodation')?.addEventListener('change', calculateTotalCost);
    document.getElementById('transport')?.addEventListener('change', calculateTotalCost);

    // SAVE TOUR PLAN
    document.getElementById('saveTourBtn')?.addEventListener('click', function() {
        const tourDate = document.getElementById('tourDate').value;
        if(!tourDate) { alert('Please select a tour date!'); return; }
        
        const selectedAttractions = [];
        document.querySelectorAll('.attraction-check:checked').forEach(cb => {
            selectedAttractions.push(cb.value);
        });
        if(selectedAttractions.length === 0) { alert('Please select at least one attraction!'); return; }
        
        const user = JSON.parse(localStorage.getItem('currentUser'));
        if(!user) { alert('Please sign in first!'); return; }
        
        const totalCost = calculateTotalCost();
        const accommodation = document.getElementById('accommodation').options[document.getElementById('accommodation').selectedIndex].text;
        const transport = document.getElementById('transport').options[document.getElementById('transport').selectedIndex].text;
        const travelers = document.getElementById('travelers').value;
        
        fetch('tour_api.php?action=save', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                email: user.email,
                date: tourDate,
                travelers: travelers,
                attractions: selectedAttractions,
                accommodation: accommodation,
                transport: transport,
                totalCost: totalCost
            })
        })
        .then(res => res.json())
        .then(data => {
            const savedPlanDiv = document.getElementById('savedPlan');
            if(data.success) {
                savedPlanDiv.innerHTML = '<div class="success-card" style="background:#4CAF50; color:white; padding:1rem; border-radius:10px; text-align:center;">✅ Tour Plan Saved!<br>📅 ' + tourDate + '<br>👥 ' + travelers + ' travelers<br>💰 $' + totalCost + '</div>';
                setTimeout(() => savedPlanDiv.innerHTML = '', 5000);
            } else {
                savedPlanDiv.innerHTML = '<div class="error-card" style="background:#f44336; color:white; padding:1rem; border-radius:10px;">❌ Error: ' + data.message + '</div>';
            }
        })
        .catch(err => alert('Error: ' + err));
    });

    calculateTotalCost();
    </script>
</body>
</html>