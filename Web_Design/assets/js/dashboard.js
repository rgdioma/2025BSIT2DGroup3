// Dashboard JavaScript functionality

document.addEventListener('DOMContentLoaded', function() {
    initializeDashboard();
});

// Initialize Dashboard
function initializeDashboard() {
    // Set current time
    updateCurrentTime();
    
    // Load user preferences
    loadUserPreferences();
    
    // Initialize tooltips and interactive elements
    initializeInteractiveElements();
    
    // Load initial data
    refreshDashboardData();
}
// Simple Dashboard JavaScript - Just for hamburger menu

// Wait for the page to load
document.addEventListener('DOMContentLoaded', function() {
    
    // Get the hamburger button and sidebar
    const menuButton = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    
    // When hamburger button is clicked, show/hide sidebar
    menuButton.addEventListener('click', function() {
        sidebar.classList.toggle('open');
    });
    
    // Close sidebar when clicking outside of it (only on mobile)
    document.addEventListener('click', function(event) {
        // Check if click is outside sidebar and not on menu button
        const clickedInsideSidebar = sidebar.contains(event.target);
        const clickedMenuButton = menuButton.contains(event.target);
        
        if (!clickedInsideSidebar && !clickedMenuButton && sidebar.classList.contains('open')) {
            sidebar.classList.remove('open');
        }
    });
    
    // Emergency alert function (for the emergency button in your HTML)
    function triggerEmergency() {
        alert('Emergency Alert Triggered!');
    }
    
    // Make the function available globally so HTML can use it
    window.triggerEmergency = triggerEmergency;
    
});