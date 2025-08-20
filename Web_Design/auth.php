<?php
$page_title = "Login / Sign Up - HeatGuard";
$additional_css = ['assets/css/auth.css'];
$additional_js = ['assets/js/auth.js'];

include 'header.php';
?>

<div class="auth-container">

    <!-- Back to home link -->
    <a href="index.php" class="back-to-home">
        ← Back to Home
    </a>

    <div class="auth-card">
        <!-- Header -->
        <div class="auth-header">
            <div class="auth-logo">🚦</div>
            <h1 class="auth-title">Welcome to HeatGuard</h1>
            <p class="auth-subtitle">Protect yourself during traffic duty</p>
        </div>

        <!-- Tab Navigation -->
        <div class="auth-tabs">
            <button class="auth-tab active" id="loginTab">Login</button>
            <button class="auth-tab" id="signupTab">Sign Up</button>
        </div>

        <!-- Login Form -->
        <form class="auth-form" id="loginForm">
            <div class="form-group">
                <label class="form-label" for="loginEmail">Email Address</label>
                <input type="email" id="loginEmail" class="form-input" placeholder="officer@department.gov.ph" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="loginPassword">Password</label>
                <div class="password-field">
                    <input type="password" id="loginPassword" class="form-input" placeholder="Enter your password" required>
                    <button type="button" class="password-toggle" onclick="togglePassword('loginPassword')">
                        👁️
                    </button>
                </div>
            </div>

            <div class="remember-forgot">
                <div class="checkbox-group">
                    <input type="checkbox" id="rememberMe">
                    <label for="rememberMe">Remember me</label>
                </div>
                <a href="#" class="forgot-link">Forgot password?</a>
            </div>

            <button type="submit" class="auth-button">Start Your Safe Shift</button>
        </form>

        <!-- Sign Up Form (Hidden by default) -->
        <form class="auth-form" id="signupForm" style="display: none;">
            <div class="form-group">
                <label class="form-label" for="signupName">Full Name</label>
                <input type="text" id="signupName" class="form-input" placeholder="Juan Dela Cruz" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="signupBadge">Badge/ID Number</label>
                <input type="text" id="signupBadge" class="form-input" placeholder="TMU-2024-001" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="signupEmail">Email Address</label>
                <input type="email" id="signupEmail" class="form-input" placeholder="officer@department.gov.ph" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="signupDepartment">Department/Unit</label>
                <input type="text" id="signupDepartment" class="form-input" placeholder="Bacolod Traffic Management Unit" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="signupPassword">Password</label>
                <div class="password-field">
                    <input type="password" id="signupPassword" class="form-input" placeholder="Create a strong password" required>
                    <button type="button" class="password-toggle" onclick="togglePassword('signupPassword')">
                        👁️
                    </button>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="confirmPassword">Confirm Password</label>
                <div class="password-field">
                    <input type="password" id="confirmPassword" class="form-input" placeholder="Confirm your password" required>
                    <button type="button" class="password-toggle" onclick="togglePassword('confirmPassword')">
                        👁️
                    </button>
                </div>
            </div>

            <div class="remember-forgot">
                <div class="checkbox-group">
                    <input type="checkbox" id="agreeTerms" required>
                    <label for="agreeTerms">I agree to the <a href="#" class="auth-link">Terms of Service</a></label>
                </div>
            </div>

            <button type="submit" class="auth-button">Create Account & Start Protecting</button>
        </form>

        <!-- Divider -->
        <div class="divider">
            <span>Or continue with</span>
        </div>

        <!-- Social Login -->
        <div class="social-login">
            <button class="social-button">
                <img src="https://img.icons8.com/color/48/google-logo.png" alt="Google">
                Google
            </button>
            <button class="social-button">
                <img src="https://img.icons8.com/color/48/facebook-new.png" alt="Facebook">
                Facebook
            </button>
        </div>

        <!-- Footer -->
        <div class="auth-footer">
            <p>Need help? Contact <a href="mailto:support@heatguard.ph" class="auth-link">support@heatguard.ph</a></p>
            <p style="margin-top: 10px; font-size: 12px; color: #a0aec0;">
                🔒 Your safety data is encrypted and secure
            </p>
        </div>
    </div>
</div>

<script>
// Tab switching functionality
document.getElementById('loginTab').addEventListener('click', function() {
    switchTab('login');
});

document.getElementById('signupTab').addEventListener('click', function() {
    switchTab('signup');
});

function switchTab(tab) {
    const loginTab = document.getElementById('loginTab');
    const signupTab = document.getElementById('signupTab');
    const loginForm = document.getElementById('loginForm');
    const signupForm = document.getElementById('signupForm');

    if (tab === 'login') {
        loginTab.classList.add('active');
        signupTab.classList.remove('active');
        loginForm.style.display = 'block';
        signupForm.style.display = 'none';
    } else {
        signupTab.classList.add('active');
        loginTab.classList.remove('active');
        signupForm.style.display = 'block';
        loginForm.style.display = 'none';
    }
}

// Password toggle functionality
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const button = field.nextElementSibling;
    
    if (field.type === 'password') {
        field.type = 'text';
        button.textContent = '🙈';
    } else {
        field.type = 'password';
        button.textContent = '👁️';
    }
}

// Form submission handlers
document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const email = document.getElementById('loginEmail').value;
    const password = document.getElementById('loginPassword').value;
    
    window.location.href = 'dashboard.php'; 
});

document.getElementById('signupForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = {
        name: document.getElementById('signupName').value,
        badge: document.getElementById('signupBadge').value,
        email: document.getElementById('signupEmail').value,
        department: document.getElementById('signupDepartment').value,
        password: document.getElementById('signupPassword').value,
        confirmPassword: document.getElementById('confirmPassword').value
    };
    
    // Password validation
    if (formData.password !== formData.confirmPassword) {
        alert('Passwords do not match!');
        return;
    }
    
    alert('Account created successfully! Welcome to HeatGuard, ' + formData.name + '!');
    window.location.href = 'dashboard.php'; 
});
</script>

<?php include 'footer.php'; ?>
