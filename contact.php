<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Alexandria Guide</title>
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
            <h2>Contact Us</h2>
            <p>We'd love to hear from you!</p>
        </div>

        <div class="contact-container">
            <div class="contact-info">
                <h3>📍 Get in Touch</h3>
                <div class="info-item"><span>🏢</span><p><strong>Address:</strong> Corniche Road, Alexandria, Egypt</p></div>
                <div class="info-item"><span>📞</span><p><strong>Phone:</strong> +20 123 456 789</p></div>
                <div class="info-item"><span>✉️</span><p><strong>Email:</strong> info@alexandriaguide.com</p></div>
                <div class="map-placeholder">
                    <h4>📍 Location Map</h4>
                    <p>🗺️ Alexandria, Mediterranean Coast, Egypt</p>
                </div>
            </div>

            <div class="contact-form">
                <h3>📧 Send us a Message</h3>
                <form id="contactForm">
                    <input type="text" id="contactName" placeholder="Your Name" required>
                    <input type="email" id="contactEmail" placeholder="Your Email" required>
                    <input type="text" id="contactSubject" placeholder="Subject" required>
                    <textarea id="contactMessage" rows="5" placeholder="Your Message" required></textarea>
                    <button type="submit">Send Message</button>
                </form>
                <div id="formFeedback"></div>
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
    // Direct contact form handler - NO external script needed
    document.getElementById('contactForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const name = document.getElementById('contactName').value;
        const email = document.getElementById('contactEmail').value;
        const subject = document.getElementById('contactSubject').value;
        const message = document.getElementById('contactMessage').value;
        
        if (!name || !email || !subject || !message) {
            alert('Please fill all fields');
            return;
        }
        
        const feedback = document.getElementById('formFeedback');
        feedback.innerHTML = '<div style="background:#ff6b35; color:white; padding:1rem; border-radius:5px;">Sending...</div>';
        
        fetch('contact_send.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'name=' + encodeURIComponent(name) + 
                  '&email=' + encodeURIComponent(email) + 
                  '&subject=' + encodeURIComponent(subject) + 
                  '&message=' + encodeURIComponent(message)
        })
        .then(response => response.text())
        .then(data => {
            if (data === 'success') {
                feedback.innerHTML = '<div style="background:#4CAF50; color:white; padding:1rem; border-radius:5px;">✅ Message sent successfully!</div>';
                document.getElementById('contactForm').reset();
                setTimeout(() => feedback.innerHTML = '', 3000);
            } else {
                feedback.innerHTML = '<div style="background:#f44336; color:white; padding:1rem; border-radius:5px;">❌ Error: ' + data + '</div>';
            }
        })
        .catch(error => {
            feedback.innerHTML = '<div style="background:#f44336; color:white; padding:1rem; border-radius:5px;">❌ Connection error</div>';
        });
    });
    </script>
</body>
</html>