// API URL for PHP
const API_URL = 'http://localhost/alexandria/api.php';

// Display current date
function displayCurrentDate() {
    const dateElement = document.getElementById('currentDate');
    if (dateElement) {
        const now = new Date();
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        dateElement.textContent = now.toLocaleDateString('en-US', options);
    }
}

// Anchor link
function setupAnchorLink() {
    const mapLink = document.getElementById('mapLink');
    if (mapLink) {
        mapLink.addEventListener('click', function(e) {
            e.preventDefault();
            const mapInfo = document.getElementById('mapInfo');
            if (mapInfo.style.display === 'none' || mapInfo.style.display === '') {
                mapInfo.style.display = 'block';
                mapLink.textContent = 'Hide Map Info ↑';
            } else {
                mapInfo.style.display = 'none';
                mapLink.textContent = 'Click to view location details';
            }
        });
    }
}

// Sign Up with PHP
function setupAuth() {
    const signupForm = document.getElementById('signupForm');
    if (signupForm) {
        signupForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            const name = document.getElementById('signupName').value;
            const email = document.getElementById('signupEmail').value;
            const password = document.getElementById('signupPassword').value;
            
            if (name && email && password) {
                try {
                    const response = await fetch(`${API_URL}?action=signup`, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ name, email, password })
                    });
                    const data = await response.json();
                    
                    if (data.success) {
                        alert('✅ Registration successful! Please sign in.');
                        signupForm.reset();
                    } else {
                        alert(data.message);
                    }
                } catch(error) {
                    alert('Connection error. Make sure XAMPP is running.');
                }
            }
        });
    }
    
    const signinForm = document.getElementById('signinForm');
    if (signinForm) {
        signinForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            const email = document.getElementById('signinEmail').value;
            const password = document.getElementById('signinPassword').value;
            
            try {
                const response = await fetch(`${API_URL}?action=signin`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ email, password })
                });
                const data = await response.json();
                
                if (data.success) {
                    localStorage.setItem('currentUser', JSON.stringify(data.user));
                    alert(`🎉 Welcome back, ${data.user.name}!`);
                    document.getElementById('signinForm').reset();
                    showTourPlanner(data.user.name);
                    loadSavedTourPlan();
                } else {
                    alert('❌ ' + data.message);
                }
            } catch(error) {
                alert('Connection error. Make sure XAMPP is running.');
            }
        });
    }
}

function showTourPlanner(userName) {
    const authForms = document.querySelector('.auth-forms');
    const tourPlanner = document.getElementById('tourPlanner');
    const tourMessage = document.getElementById('tourMessage');
    
    if (authForms && tourPlanner) {
        authForms.style.display = 'none';
        tourPlanner.style.display = 'block';
        tourMessage.innerHTML = `<div style="background:#e8f4f8; padding:1rem; border-radius:5px;">✨ Welcome ${userName}! Plan your dream tour below:</div>`;
    }
}

function calculateTotal() {
    const checkboxes = document.querySelectorAll('.attraction-check:checked');
    let total = 0;
    checkboxes.forEach(cb => {
        if (cb.value.includes('$15')) total += 15;
        else if (cb.value.includes('$10')) total += 10;
        else if (cb.value.includes('$8')) total += 8;
    });
    return total;
}

function setupTourPlanner() {
    const saveBtn = document.getElementById('saveTourBtn');
    if (saveBtn) {
        saveBtn.addEventListener('click', async function() {
            const checkboxes = document.querySelectorAll('.attraction-check:checked');
            const selectedAttractions = Array.from(checkboxes).map(cb => cb.value);
            const tourDate = document.getElementById('tourDate').value;
            const travelers = document.getElementById('travelers').value;
            const accommodation = document.getElementById('accommodation').value;
            const transport = document.getElementById('transport').value;
            const totalCost = calculateTotal() * travelers;
            
            if (selectedAttractions.length === 0) {
                alert('Please select at least one attraction!');
                return;
            }
            
            if (!tourDate) {
                alert('Please select a tour date!');
                return;
            }
            
            const user = JSON.parse(localStorage.getItem('currentUser'));
            if (user) {
                try {
                    const response = await fetch(`${API_URL}?action=save-tour`, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({
                            email: user.email,
                            attractions: selectedAttractions,
                            tourDate: tourDate,
                            travelers: travelers,
                            accommodation: accommodation,
                            transport: transport,
                            totalCost: totalCost
                        })
                    });
                    const data = await response.json();
                    
                    if (data.success) {
                        document.getElementById('savedPlan').innerHTML = `
                            <div style="background:#4CAF50; color:white; padding:1rem; margin-top:1rem; border-radius:5px;">
                                <h4>✅ Tour Plan Saved to Database!</h4>
                                <p><strong>Date:</strong> ${tourDate}</p>
                                <p><strong>Travelers:</strong> ${travelers}</p>
                                <p><strong>Cost:</strong> $${totalCost}</p>
                            </div>
                        `;
                    }
                } catch(error) {
                    alert('Error saving tour plan.');
                }
            }
        });
    }
}

function setupContactForm() {
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            const name = document.getElementById('contactName').value;
            const email = document.getElementById('contactEmail').value;
            const subject = document.getElementById('contactSubject').value;
            const message = document.getElementById('contactMessage').value;
            
            if (name && email && subject && message) {
                try {
                    const response = await fetch(`${API_URL}?action=contact`, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ name, email, subject, message })
                    });
                    const data = await response.json();
                    
                    if (data.success) {
                        document.getElementById('formFeedback').innerHTML = '<div style="background:#4CAF50; color:white; padding:1rem; border-radius:5px;">✅ Message sent! We\'ll get back to you soon.</div>';
                        contactForm.reset();
                        setTimeout(() => {
                            document.getElementById('formFeedback').innerHTML = '';
                        }, 3000);
                    }
                } catch(error) {
                    alert('Error sending message.');
                }
            }
        });
    }
}

async function loadSavedTourPlan() {
    const user = JSON.parse(localStorage.getItem('currentUser'));
    if (user && document.getElementById('savedPlan')) {
        try {
            const response = await fetch(`${API_URL}?action=get-tour&email=${encodeURIComponent(user.email)}`);
            const data = await response.json();
            
            if (data.success && data.plan) {
                const plan = data.plan;
                const attractions = Array.isArray(plan.attractions) ? plan.attractions.join(', ') : plan.attractions;
                document.getElementById('savedPlan').innerHTML = `
                    <div style="background:#e8f4f8; padding:1rem; margin-top:1rem; border-radius:5px;">
                        <h4>📅 Your Saved Tour (from Database)</h4>
                        <p><strong>Date:</strong> ${plan.tour_date}</p>
                        <p><strong>Travelers:</strong> ${plan.travelers}</p>
                        <p><strong>Attractions:</strong> ${attractions}</p>
                    </div>
                `;
            }
        } catch(error) {
            console.error('Error loading tour plan:', error);
        }
    }
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    displayCurrentDate();
    setupAuth();
    setupTourPlanner();
    setupContactForm();
    setupAnchorLink();
    loadSavedTourPlan();
});