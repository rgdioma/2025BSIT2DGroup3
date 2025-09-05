// Heat Monitoring JavaScript Functions

document.addEventListener('DOMContentLoaded', function() {
    initializeHeatMonitoring();
    setupEventListeners();
    startAutoRefresh();
});

// Global variables
let autoRefreshInterval;
let isAutoRefreshEnabled = true;
let lastUpdateTime = new Date();

// Initialize heat monitoring dashboard
function initializeHeatMonitoring() {
    console.log('Heat Monitoring System initialized');
    updateLastRefreshTime();
    setupTooltips();
    animateChartBars();
}

// Setup event listeners
function setupEventListeners() {
    // Menu toggle functionality (from main dashboard)
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    
    if (menuToggle && sidebar) {
        menuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('open');
        });
    }

    // Auto-refresh toggle
    const refreshIndicator = document.getElementById('refreshIndicator');
    if (refreshIndicator) {
        refreshIndicator.addEventListener('click', toggleAutoRefresh);
    }

    // Chart bar hover effects
    const chartBars = document.querySelectorAll('.bar');
    chartBars.forEach(bar => {
        bar.addEventListener('mouseenter', function() {
            this.style.transform = 'scaleY(1.05)';
        });
        
        bar.addEventListener('mouseleave', function() {
            this.style.transform = 'scaleY(1)';
        });
    });

    // Weather stat hover effects
    const weatherStats = document.querySelectorAll('.weather-stat');
    weatherStats.forEach(stat => {
        stat.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
        });
        
        stat.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
}

// Auto-refresh functionality
function startAutoRefresh() {
    if (isAutoRefreshEnabled) {
        autoRefreshInterval = setInterval(() => {
            refreshHeatData();
        }, 60000); // Refresh every minute
    }
}

function stopAutoRefresh() {
    if (autoRefreshInterval) {
        clearInterval(autoRefreshInterval);
        autoRefreshInterval = null;
    }
}

function toggleAutoRefresh() {
    const refreshIndicator = document.getElementById('refreshIndicator');
    const refreshIcon = refreshIndicator.querySelector('i');
    const refreshText = refreshIndicator.querySelector('span');
    
    isAutoRefreshEnabled = !isAutoRefreshEnabled;
    
    if (isAutoRefreshEnabled) {
        startAutoRefresh();
        refreshText.textContent = 'Auto-refresh: ON';
        refreshIndicator.style.background = '#dcfce7';
        refreshIndicator.style.color = '#166534';
        refreshIcon.style.animation = 'spin 2s linear infinite';
    } else {
        stopAutoRefresh();
        refreshText.textContent = 'Auto-refresh: OFF';
        refreshIndicator.style.background = '#fee2e2';
        refreshIndicator.style.color = '#991b1b';
        refreshIcon.style.animation = 'none';
    }
}

// Refresh heat data
function refreshData() {
    console.log('Refreshing heat data...');
    showLoadingState();
    
    // Simulate API call delay
    setTimeout(() => {
        // In a real application, this would fetch from the weather API
        updateHeatDisplay();
        updateWeatherStats();
        updateLocationData();
        updateAlerts();
        hideLoadingState();
        showSuccessMessage('Heat data updated successfully');
        updateLastRefreshTime();
    }, 2000);
}

function refreshHeatData() {
    // This would normally make an AJAX call to fetch new data
    console.log('Auto-refreshing heat data at', new Date().toLocaleTimeString());
    
    // Simulate random heat index changes for demo
    const currentValue = parseInt(document.querySelector('.heat-value').textContent);
    const newValue = Math.max(25, Math.min(50, currentValue + (Math.random() - 0.5) * 4));
    
    updateHeatIndex(Math.round(newValue));
    updateLastRefreshTime();
}

// Update heat index display
function updateHeatIndex(newValue) {
    const heatValue = document.querySelector('.heat-value');
    const heatLevelBadge = document.querySelector('.heat-level-badge');
    const heatIndexMain = document.querySelector('.heat-index-main');
    
    // Add pulse animation
    heatValue.classList.add('pulse');
    
    // Update value
    heatValue.textContent = newValue + '°C';
    
    // Update heat level and styling based on value
    let level, levelClass, levelIcon, mainClass;
    
    if (newValue < 32) {
        level = 'SAFE';
        levelClass = 'status-safe';
        levelIcon = 'fa-check-circle';
        mainClass = 'safe';
    } else if (newValue < 40) {
        level = 'CAUTION';
        levelClass = 'status-caution';
        levelIcon = 'fa-exclamation-triangle';
        mainClass = 'caution';
    } else {
        level = 'DANGER';
        levelClass = 'status-danger';
        levelIcon = 'fa-exclamation-circle';
        mainClass = 'danger';
    }
    
    // Update heat level badge
    heatLevelBadge.className = `heat-level-badge ${levelClass}`;
    heatLevelBadge.innerHTML = `<i class="fas ${levelIcon}"></i> ${level} LEVEL`;
    
    // Update main container class
    heatIndexMain.className = `heat-index-main ${mainClass}`;
    
    // Remove pulse animation after 2 seconds
    setTimeout(() => {
        heatValue.classList.remove('pulse');
    }, 2000);
}

// Update weather statistics
function updateWeatherStats() {
    const stats = document.querySelectorAll('.stat-value');
    
    stats.forEach(stat => {
        const parent = stat.closest('.weather-stat');
        const label = parent.querySelector('.stat-label').textContent.toLowerCase();
        
        // Simulate data updates
        if (label.includes('temperature')) {
            const newTemp = Math.round(Math.random() * 10 + 30);
            stat.textContent = newTemp + '°C';
        } else if (label.includes('humidity')) {
            const newHumidity = Math.round(Math.random() * 20 + 60);
            stat.textContent = newHumidity + '%';
        } else if (label.includes('wind')) {
            const newWind = Math.round(Math.random() * 15 + 5);
            stat.textContent = newWind + ' km/h';
        } else if (label.includes('uv')) {
            const newUV = Math.round(Math.random() * 5 + 8);
            stat.textContent = newUV;
        } else if (label.includes('feels')) {
            const newFeels = Math.round(Math.random() * 8 + 38);
            stat.textContent = newFeels + '°C';
        } else if (label.includes('update')) {
            stat.textContent = new Date().toLocaleTimeString('en-US', {
                hour: '2-digit',
                minute: '2-digit'
            });
        }
    });
}

// Update location monitoring data
function updateLocationData() {
    const locationItems = document.querySelectorAll('.location-item');
    
    locationItems.forEach(item => {
        const heatIndexText = item.querySelector('p');
        const statusIcon = item.querySelector('.location-status');
        
        // Generate random heat index
        const newHeatIndex = Math.round(Math.random() * 15 + 30);
        heatIndexText.textContent = `Heat Index: ${newHeatIndex}°C`;
        
        // Update status based on heat index
        let statusClass, statusIcon_class;
        if (newHeatIndex < 32) {
            statusClass = 'status-safe';
            statusIcon_class = 'fa-check-circle';
        } else if (newHeatIndex < 40) {
            statusClass = 'status-caution';
            statusIcon_class = 'fa-exclamation-triangle';
        } else {
            statusClass = 'status-danger';
            statusIcon_class = 'fa-exclamation-circle';
        }
        
        statusIcon.className = `location-status ${statusClass}`;
        statusIcon.innerHTML = `<i class="fas ${statusIcon_class}"></i>`;
    });
}

// Update alerts
function updateAlerts() {
    // This would typically fetch new alerts from the server
    console.log('Updating alerts...');
}

// Show loading state
function showLoadingState() {
    const mainContent = document.querySelector('.heat-monitoring-content');
    if (!document.querySelector('.loading-overlay')) {
        const loadingOverlay = document.createElement('div');
        loadingOverlay.className = 'loading-overlay';
        loadingOverlay.innerHTML = '<div class="loading-spinner"></div>';
        mainContent.style.position = 'relative';
        mainContent.appendChild(loadingOverlay);
    }
}

// Hide loading state
function hideLoadingState() {
    const loadingOverlay = document.querySelector('.loading-overlay');
    if (loadingOverlay) {
        loadingOverlay.remove();
    }
}

// Show success message
function showSuccessMessage(message) {
    const existingMessage = document.querySelector('.message');
    if (existingMessage) {
        existingMessage.remove();
    }
    
    const messageDiv = document.createElement('div');
    messageDiv.className = 'message success';
    messageDiv.textContent = message;
    
    const content = document.querySelector('.heat-monitoring-content');
    content.insertBefore(messageDiv, content.firstChild);
    
    setTimeout(() => {
        messageDiv.remove();
    }, 3000);
}

// Show error message
function showErrorMessage(message) {
    const existingMessage = document.querySelector('.message');
    if (existingMessage) {
        existingMessage.remove();
    }
    
    const messageDiv = document.createElement('div');
    messageDiv.className = 'message error';
    messageDiv.textContent = message;
    
    const content = document.querySelector('.heat-monitoring-content');
    content.insertBefore(messageDiv, content.firstChild);
    
    setTimeout(() => {
        messageDiv.remove();
    }, 5000);
}

// Update last refresh time
function updateLastRefreshTime() {
    lastUpdateTime = new Date();
    const timeDisplay = document.querySelector('.stat-label:contains("Last Update")');
    if (timeDisplay) {
        const timeValue = timeDisplay.previousElementSibling;
        if (timeValue) {
            timeValue.textContent = lastUpdateTime.toLocaleTimeString('en-US', {
                hour: '2-digit',
                minute: '2-digit'
            });
        }
    }
}

// Setup tooltips
function setupTooltips() {
    const tooltipElements = document.querySelectorAll('[data-tooltip]');
    
    tooltipElements.forEach(element => {
        element.classList.add('tooltip');
    });
}

// Animate chart bars on load
function animateChartBars() {
    const bars = document.querySelectorAll('.bar');
    
    bars.forEach((bar, index) => {
        setTimeout(() => {
            bar.style.animation = 'fadeInUp 0.5s ease forwards';
        }, index * 100);
    });
}

// Export data functionality
function exportData() {
    console.log('Exporting heat monitoring data...');
    showSuccessMessage('Generating heat monitoring report...');
    
    // In a real application, this would generate and download a report
    setTimeout(() => {
        // Simulate file download
        const link = document.createElement('a');
        link.href = '#';
        link.download = `heat-monitoring-report-${new Date().toISOString().split('T')[0]}.pdf`;
        link.click();
        
        showSuccessMessage('Report exported successfully');
    }, 2000);
}

// View history functionality
function viewHistory() {
    console.log('Opening heat index history...');
    // This would typically open a modal or navigate to a history page
    alert('Heat Index History\n\nThis would open a detailed view of historical heat index data, including:\n• Daily/weekly/monthly trends\n• Peak heat periods\n• Location comparisons\n• Incident correlations');
}

// Trigger manual alert
function triggerAlert() {
    const confirmation = confirm('Are you sure you want to trigger a manual heat alert?\n\nThis will notify all supervisors and emergency teams.');
    
    if (confirmation) {
        console.log('Manual heat alert triggered');
        showSuccessMessage('Emergency heat alert has been sent to all supervisors');
        
        // Add new alert to the alerts list
        addNewAlert('Manual Alert Triggered', 'Emergency heat alert sent to all supervisors', 'danger', 'just now');
    }
}

// Add new alert to the alerts list
function addNewAlert(title, description, type, time) {
    const alertsList = document.querySelector('.alerts-list');
    const newAlert = document.createElement('div');
    newAlert.className = `alert-item ${type}`;
    
    let iconClass;
    switch(type) {
        case 'danger': iconClass = 'fa-exclamation-circle'; break;
        case 'caution': iconClass = 'fa-exclamation-triangle'; break;
        case 'safe': iconClass = 'fa-info-circle'; break;
        default: iconClass = 'fa-info-circle';
    }
    
    newAlert.innerHTML = `
        <div class="alert-icon">
            <i class="fas ${iconClass}"></i>
        </div>
        <div class="alert-info">
            <h5>${title}</h5>
            <p>${description}</p>
            <span class="alert-time">${time}</span>
        </div>
    `;
    
    alertsList.insertBefore(newAlert, alertsList.firstChild);
    
    // Remove last alert if more than 5
    const alerts = alertsList.querySelectorAll('.alert-item');
    if (alerts.length > 5) {
        alertsList.removeChild(alerts[alerts.length - 1]);
    }
}

// Emergency trigger function (for sidebar link)
function triggerEmergency() {
    const confirmation = confirm('EMERGENCY ALERT\n\nAre you sure you want to trigger an emergency alert?\n\nThis will immediately notify emergency services and all supervisors.');
    
    if (confirmation) {
        console.log('Emergency alert triggered');
        showErrorMessage('EMERGENCY ALERT ACTIVATED - Emergency services have been notified');
        
        // Add emergency alert
        addNewAlert('EMERGENCY ALERT', 'Emergency services and supervisors notified', 'danger', 'just now');
        
        // Flash the screen red briefly
        document.body.style.backgroundColor = '#fee2e2';
        setTimeout(() => {
            document.body.style.backgroundColor = '';
        }, 500);
    }
}

// Utility function to format time
function formatTime(date) {
    return date.toLocaleTimeString('en-US', {
        hour: '2-digit',
        minute: '2-digit'
    });
}

// Utility function to get heat level info
function getHeatLevelInfo(temperature) {
    if (temperature < 32) {
        return {
            level: 'SAFE',
            class: 'status-safe',
            icon: 'fa-check-circle',
            description: 'Normal outdoor activity possible'
        };
    } else if (temperature < 40) {
        return {
            level: 'CAUTION',
            class: 'status-caution',
            icon: 'fa-exclamation-triangle',
            description: 'Increased water breaks required'
        };
    } else {
        return {
            level: 'DANGER',
            class: 'status-danger',
            icon: 'fa-exclamation-circle',
            description: 'Frequent breaks and rotation needed'
        };
    }
}

// CSS animations for fade in up effect
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
`;
document.head.appendChild(style);