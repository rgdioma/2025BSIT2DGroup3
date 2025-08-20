<?php

$page_title = "HeatGuard - Traffic Enforcer Heat Safety System";
$additional_js = ['assets/js/main.js']; 

include 'header.php';
?>

<!-- Hero Section -->
<section id="home" class="hero">
<div class="hero-container">
<div class="hero-content">
<h1>HeatGuard for Traffic Enforcers</h1>
<p>Protect yourself from heat-related illness with real-time monitoring, break reminders, and emergency alerts designed specifically for traffic enforcement professionals.</p>
<button class="cta-button" onclick="window.location.href='auth.php'">Start Your Shift Safely</button>
</div>

<div class="weather-widget">
<div class="weather-location">BACOLOD CITY</div>
<div class="current-temp">40°C</div>
<div class="heat-warning">⚠️ EXTREME HEAT WARNING</div>
<div class="forecast">
<div class="forecast-item">
<div class="forecast-day">Today</div>
<div class="forecast-temp">43°C</div>
</div>
<div class="forecast-item">
<div class="forecast-day">Tomorrow</div>
<div class="forecast-temp">37°C</div>
</div>
<div class="forecast-item">
<div class="forecast-day">Wed</div>
<div class="forecast-temp">40°C</div>
</div>
</div>
</div>
</div>
</section>

<!-- Features Section -->
<section id="features" class="features">
<div class="container">
<div class="section-header">
<h2 class="section-title">Essential Tools for Traffic Enforcers</h2>
<p class="section-subtitle">Stay safe on duty with features designed specifically for traffic enforcement professionals</p>
</div>

<div class="features-grid">
<div class="feature-card">
<div class="feature-icon">
<img src="https://img.icons8.com/ios-filled/50/user.png" alt="Officer Profile">
</div>
<h3 class="feature-title">Officer Profile Management</h3>
<p class="feature-description">Personal safety profiles with shift tracking, health monitoring, and emergency contact information for each traffic enforcer.</p>
</div>

<div class="feature-card">
<div class="feature-icon">
<img src="https://img.icons8.com/ios-filled/50/temperature.png" alt="Heat Monitoring">
</div>
<h3 class="feature-title">Heat Index Monitoring</h3>
<p class="feature-description">Real-time heat index tracking for your specific location with personalized alerts when conditions become dangerous.</p>
</div>

<div class="feature-card">
<div class="feature-icon">
<img src="https://img.icons8.com/ios-filled/50/clock.png" alt="Break Scheduler">
</div>
<h3 class="feature-title">Smart Break Reminders</h3>
<p class="feature-description">Automated break scheduling based on heat conditions, with hydration reminders and cool-down location suggestions.</p>
</div>

<div class="feature-card">
<div class="feature-icon">
<img src="https://img.icons8.com/ios-filled/50/bell.png" alt="Safety Alerts">
</div>
<h3 class="feature-title">Safety Alerts & Guidelines</h3>
<p class="feature-description">Instant notifications about heat warnings, safety protocols, and best practices for staying safe during traffic duty.</p>
</div>

<div class="feature-card">
<div class="feature-icon">
<img src="https://img.icons8.com/ios-filled/50/emergency.png" alt="Emergency">
</div>
<h3 class="feature-title">Emergency Response</h3>
<p class="feature-description">One-tap emergency alerts to supervisors and medical teams with GPS location and immediate response coordination.</p>
</div>

<div class="feature-card">
<div class="feature-icon">
<img src="https://img.icons8.com/ios-filled/50/health-checkup.png" alt="Health Tracking">
</div>
<h3 class="feature-title">Health Monitoring</h3>
<p class="feature-description">Track symptoms, hydration levels, and overall wellness during shifts with personalized health recommendations.</p>
</div>
</div>
</div>
</section>

<!-- About Section -->
<section id="about" class="about">
<div class="container">
<div class="about-content">
<div class="about-text">
<h2>Protecting Our Traffic Heroes</h2>
<p>Traffic enforcers face extreme heat conditions daily while keeping our roads safe. HeatGuard was specifically designed to protect these essential workers from heat-related health risks.</p>
<p>Our system understands the unique challenges of traffic enforcement - long hours under direct sunlight, heavy uniforms, and the inability to seek immediate shelter. We provide the tools needed to stay safe and healthy on duty.</p>

<div class="about-stats">
<div class="stat-item">
<div class="stat-number">1000+</div>
<div class="stat-label">Traffic Enforcers Protected</div>
</div>
<div class="stat-item">
<div class="stat-number">50+</div>
<div class="stat-label">Cities Covered</div>
</div>
<div class="stat-item">
<div class="stat-number">24/7</div>
<div class="stat-label">Heat Monitoring</div>
</div>
<div class="stat-item">
<div class="stat-number">95%</div>
<div class="stat-label">Heat Illness Prevention</div>
</div>
</div>
</div>

<div class="about-image">
<img src="https://assets.cat5.com/images/tactical-experts/officers-guide-to-traffic-control-fundamentals/officers-guide-to-traffic-control-fundamentals.jpg" alt="Traffic enforcer on duty in hot weather" style="width: 100%; height: 100%; object-fit: cover; border-radius: 20px;">
</div>
</div>
</div>
</section>

<!-- Contact Section -->
<section id="contact" class="contact">
<div class="container">
<div class="contact-content">
<div class="contact-info">
<h2>Ready to Protect Your Team?</h2>
<p>Join hundreds of traffic enforcement units already using HeatGuard to keep their officers safe. Contact us to set up your department today.</p>

<div class="contact-details">
<div class="contact-item">
<img src="https://img.icons8.com/material-outlined/24/phone.png" alt="Phone">
<span>+63 123 456 7890</span>
</div>
<div class="contact-item">
<img src="https://img.icons8.com/material-outlined/24/email.png" alt="Email">
<span>traffic@heatguard.ph</span>
</div>
<div class="contact-item">
<img src="https://img.icons8.com/material-outlined/24/marker.png" alt="Location">
<span>Bacolod City, Philippines</span>
</div>
<div class="contact-item">
<img src="https://img.icons8.com/material-outlined/24/time.png" alt="Hours">
<span>24/7 Emergency Support</span>
</div>
</div>
</div>

<form class="contact-form" id="contactForm">
<div class="success-message" id="successMessage">
✅ Thank you! Your request has been submitted successfully. We'll contact you within 24 hours.
</div>
<div class="form-group">
<label for="department">Department/Unit</label>
<input type="text" id="department" name="department" placeholder="e.g., Bacolod Traffic Management Unit" required>
</div>
<div class="form-group">
<label for="supervisor">Supervisor Name</label>
<input type="text" id="supervisor" name="supervisor" placeholder="Department Head/Supervisor" required>
</div>
<div class="form-group">
<label for="email">Contact Email</label>
<input type="email" id="email" name="email" placeholder="department@email.com" required>
</div>
<div class="form-group">
<label for="officers">Number of Officers</label>
<select id="officers" name="officers" required>
<option value="">Select number of officers</option>
<option value="1-10">1-10 officers</option>
<option value="11-25">11-25 officers</option>
<option value="26-50">26-50 officers</option>
<option value="51-100">51-100 officers</option>
<option value="100+">100+ officers</option>
</select>
</div>
<div class="form-group">
<label for="message">Additional Requirements</label>
<textarea id="message" name="message" rows="4" placeholder="Tell us about your specific needs, locations, or special requirements..."></textarea>
</div>
<button type="submit" class="submit-btn">Request Department Setup</button>
</form>
</div>
</div>
</section>

<?php
include 'footer.php';
?>