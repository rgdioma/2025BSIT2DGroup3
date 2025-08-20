<!-- Footer -->
<footer class="footer">
<div class="container">
<div class="footer-content">
<div class="footer-section">
<h3>HeatGuard Traffic Safety</h3>
<p>Dedicated to protecting traffic enforcers across the Philippines with advanced heat monitoring and safety management systems.</p>
<div class="social-links">
<a href="#"><img src="https://img.icons8.com/ios-filled/50/facebook-new.png" alt="Facebook"></a>
<a href="#"><img src="https://img.icons8.com/ios-filled/50/twitter.png" alt="Twitter"></a>
<a href="#"><img src="https://img.icons8.com/ios-filled/50/linkedin.png" alt="LinkedIn"></a>
</div>
</div>

<div class="footer-section">
<h3>For Traffic Departments</h3>
<p><a href="#features">System Features</a></p>
<p><a href="#setup">Department Setup</a></p>
<p><a href="#training">Officer Training</a></p>
<p><a href="#support">24/7 Support</a></p>
</div>

<div class="footer-section">
<h3>Safety Resources</h3>
<p><a href="#">Heat Safety Guidelines</a></p>
<p><a href="#">Emergency Protocols</a></p>
<p><a href="#">Training Materials</a></p>
<p><a href="#">Best Practices</a></p>
</div>

<div class="footer-section">
<h3>Emergency Contact</h3>
<p>📞 Emergency Hotline: 911</p>
<p>📱 HeatGuard Support: +63 123 456 7890</p>
<p>✉️ traffic@heatguard.ph</p>
<p>📍 Coverage: All Major Philippine Cities</p>
</div>
</div>

<div class="footer-bottom">
<p>&copy; <?php echo date('Y'); ?> HeatGuard Traffic Safety System. All rights reserved. | Privacy Policy | Terms of Service</p>
</div>
</div>
</footer>

<!-- Include any additional JavaScript files -->
<?php if(isset($additional_js)) { 
    foreach($additional_js as $js) { 
        echo '<script src="'.$js.'"></script>'; 
    } 
} ?>

<!-- Add any inline JavaScript if needed -->
<?php if(isset($inline_js)) { echo '<script>'.$inline_js.'</script>'; } ?>

</body>
</html>