<?php
$page_title = "Heat Index Monitoring - HeatGuard";
$additional_css = ['assets/css/heat-monitoring.css'];
$additional_js = ['assets/js/heat-monitoring.js'];

$user = [
    'name' => 'Officer Jerome Buntalidad',
    'role' => 'Traffic Enforcer',
    'department' => 'Bacolod TMU',
    'badge' => 'TMU-2024-001',
    'status' => 'on_duty'
];

// Sample heat index data - in real implementation, this would come from weather API
$current_heat_data = [
    'temperature' => 38,
    'humidity' => 78,
    'heat_index' => 42,
    'heat_level' => 'DANGER',
    'uv_index' => 11,
    'wind_speed' => 12,
    'feels_like' => 45,
    'last_updated' => date('Y-m-d H:i:s')
];

// Sample historical data for the past 24 hours
$historical_data = [
    ['time' => '06:00', 'heat_index' => 28, 'level' => 'SAFE'],
    ['time' => '09:00', 'heat_index' => 32, 'level' => 'CAUTION'],
    ['time' => '12:00', 'heat_index' => 38, 'level' => 'DANGER'],
    ['time' => '15:00', 'heat_index' => 42, 'level' => 'DANGER'],
    ['time' => '18:00', 'heat_index' => 35, 'level' => 'CAUTION'],
    ['time' => '21:00', 'heat_index' => 30, 'level' => 'SAFE']
];

// Weather locations for monitoring
$monitoring_locations = [
    ['name' => 'City Hall', 'temp' => 38, 'heat_index' => 42, 'status' => 'danger'],
    ['name' => 'Public Plaza', 'temp' => 37, 'heat_index' => 40, 'status' => 'danger'],
    ['name' => 'Main Street', 'temp' => 36, 'heat_index' => 39, 'status' => 'caution'],
    ['name' => 'School Zone', 'temp' => 35, 'heat_index' => 37, 'status' => 'caution']
];

function getHeatLevelClass($level) {
    switch(strtoupper($level)) {
        case 'SAFE': return 'status-safe';
        case 'CAUTION': return 'status-caution';
        case 'DANGER': return 'status-danger';
        default: return 'status-safe';
    }
}

function getHeatLevelIcon($level) {
    switch(strtoupper($level)) {
        case 'SAFE': return 'fa-check-circle';
        case 'CAUTION': return 'fa-exclamation-triangle';
        case 'DANGER': return 'fa-exclamation-circle';
        default: return 'fa-thermometer-half';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <link rel="stylesheet" href="assets/css/heat-monitoring.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-logo">
                    <span class="logo-icon">🚦</span>
                    <span>HeatGuard</span>
                </div>
            </div>
            
            <nav class="sidebar-nav">
                <div class="nav-section">
                    <div class="nav-section-title">Main Dashboard</div>
                    <div class="nav-item">
                        <a href="dashboard.php" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <span>Overview</span>
                        </a>
                    </div>
                </div>

                <div class="nav-section">
                    <div class="nav-section-title">Core Modules</div>
                    <div class="nav-item">
                        <a href="user-management.php" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <span>User Management</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="heat-monitoring.php" class="nav-link active">
                            <i class="nav-icon fas fa-thermometer-half"></i>
                            <span>Heat Index Monitoring</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="schedule-management.php" class="nav-link">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <span>Schedule Management</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="safety-guidelines.php" class="nav-link">
                            <i class="nav-icon fas fa-shield-alt"></i>
                            <span>Safety Guidelines</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="emergency-response.php" class="nav-link">
                            <i class="nav-icon fas fa-exclamation-triangle"></i>
                            <span>Emergency Response</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="reporting-system.php" class="nav-link">
                            <i class="nav-icon fas fa-chart-bar"></i>
                            <span>Automated Reports</span>
                        </a>
                    </div>
                </div>

                <div class="nav-section">
                    <div class="nav-section-title">Quick Actions</div>
                    <div class="nav-item">
                        <a href="#" class="nav-link" onclick="triggerEmergency()">
                            <i class="nav-icon fas fa-ambulance"></i>
                            <span>Emergency Alert</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-file-download"></i>
                            <span>Export Reports</span>
                        </a>
                    </div>
                </div>

                <div class="nav-section">
                    <div class="nav-section-title">Account</div>
                    <div class="nav-item">
                        <a href="profile.php" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <span>Profile Settings</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="index.php" class="nav-link">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </a>
                    </div>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Top Bar -->
            <header class="top-bar">
                <div class="top-bar-left">
                    <button class="menu-toggle" id="menuToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="page-title">Heat Index Monitoring</h1>
                </div>
                
                <div class="top-bar-right">
                    <div class="refresh-indicator" id="refreshIndicator">
                        <i class="fas fa-sync-alt"></i>
                        <span>Auto-refresh: ON</span>
                    </div>
                    
                    <div class="status-indicator <?php echo $user['status'] === 'on_duty' ? 'status-online' : 'status-offline'; ?>">
                        <i class="fas fa-circle"></i>
                        <?php echo $user['status'] === 'on_duty' ? 'On Duty' : 'Off Duty'; ?>
                    </div>
                    
                    <div class="user-menu">
                        <div class="user-avatar">
                            <?php echo strtoupper(substr($user['name'], 8, 1)) . strtoupper(substr($user['name'], 13, 1)); ?>
                        </div>
                        <div class="user-info">
                            <h4><?php echo explode(' ', $user['name'])[1] . ' ' . explode(' ', $user['name'])[2]; ?></h4>
                            <p><?php echo $user['role']; ?></p>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Heat Monitoring Content -->
            <div class="heat-monitoring-content">
                <!-- Current Heat Index Display -->
                <div class="current-heat-section">
                    <div class="heat-index-main">
                        <div class="heat-display-large">
                            <div class="heat-icon">
                                <i class="fas fa-thermometer-half"></i>
                            </div>
                            <div class="heat-value-container">
                                <div class="heat-value"><?php echo $current_heat_data['heat_index']; ?>°C</div>
                                <div class="heat-label">Heat Index</div>
                            </div>
                            <div class="heat-level-badge <?php echo getHeatLevelClass($current_heat_data['heat_level']); ?>">
                                <i class="fas <?php echo getHeatLevelIcon($current_heat_data['heat_level']); ?>"></i>
                                <?php echo $current_heat_data['heat_level']; ?> LEVEL
                            </div>
                        </div>
                        
                        <div class="weather-details-grid">
                            <div class="weather-stat">
                                <div class="stat-icon temp-icon">
                                    <i class="fas fa-temperature-high"></i>
                                </div>
                                <div class="stat-info">
                                    <div class="stat-value"><?php echo $current_heat_data['temperature']; ?>°C</div>
                                    <div class="stat-label">Temperature</div>
                                </div>
                            </div>
                            
                            <div class="weather-stat">
                                <div class="stat-icon humidity-icon">
                                    <i class="fas fa-tint"></i>
                                </div>
                                <div class="stat-info">
                                    <div class="stat-value"><?php echo $current_heat_data['humidity']; ?>%</div>
                                    <div class="stat-label">Humidity</div>
                                </div>
                            </div>
                            
                            <div class="weather-stat">
                                <div class="stat-icon wind-icon">
                                    <i class="fas fa-wind"></i>
                                </div>
                                <div class="stat-info">
                                    <div class="stat-value"><?php echo $current_heat_data['wind_speed']; ?> km/h</div>
                                    <div class="stat-label">Wind Speed</div>
                                </div>
                            </div>
                            
                            <div class="weather-stat">
                                <div class="stat-icon uv-icon">
                                    <i class="fas fa-sun"></i>
                                </div>
                                <div class="stat-info">
                                    <div class="stat-value"><?php echo $current_heat_data['uv_index']; ?></div>
                                    <div class="stat-label">UV Index</div>
                                </div>
                            </div>
                            
                            <div class="weather-stat">
                                <div class="stat-icon feels-icon">
                                    <i class="fas fa-thermometer-three-quarters"></i>
                                </div>
                                <div class="stat-info">
                                    <div class="stat-value"><?php echo $current_heat_data['feels_like']; ?>°C</div>
                                    <div class="stat-label">Feels Like</div>
                                </div>
                            </div>
                            
                            <div class="weather-stat">
                                <div class="stat-icon update-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="stat-info">
                                    <div class="stat-value"><?php echo date('H:i', strtotime($current_heat_data['last_updated'])); ?></div>
                                    <div class="stat-label">Last Update</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dashboard Grid -->
                <div class="dashboard-grid">
                    <!-- Heat Level Guidelines -->
                    <div class="dashboard-card guidelines-card">
                        <div class="card-header">
                            <h3>
                                <i class="fas fa-info-circle"></i>
                                Heat Index Guidelines
                            </h3>
                        </div>
                        <div class="guidelines-list">
                            <div class="guideline-item safe">
                                <div class="guideline-indicator"></div>
                                <div class="guideline-info">
                                    <h4>Safe (Below 32°C)</h4>
                                    <p>Normal outdoor activity possible</p>
                                </div>
                            </div>
                            <div class="guideline-item caution">
                                <div class="guideline-indicator"></div>
                                <div class="guideline-info">
                                    <h4>Caution (32-39°C)</h4>
                                    <p>Increased water breaks required</p>
                                </div>
                            </div>
                            <div class="guideline-item danger">
                                <div class="guideline-indicator"></div>
                                <div class="guideline-info">
                                    <h4>Danger (40°C+)</h4>
                                    <p>Frequent breaks and rotation needed</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Location Monitoring -->
                    <div class="dashboard-card locations-card">
                        <div class="card-header">
                            <h3>
                                <i class="fas fa-map-marker-alt"></i>
                                Monitoring Locations
                            </h3>
                        </div>
                        <div class="locations-list">
                            <?php foreach($monitoring_locations as $location): ?>
                            <div class="location-item">
                                <div class="location-info">
                                    <h4><?php echo $location['name']; ?></h4>
                                    <p>Heat Index: <?php echo $location['heat_index']; ?>°C</p>
                                </div>
                                <div class="location-status <?php echo getHeatLevelClass($location['status']); ?>">
                                    <i class="fas <?php echo getHeatLevelIcon($location['status']); ?>"></i>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- 24-Hour Trend -->
                    <div class="dashboard-card trend-card">
                        <div class="card-header">
                            <h3>
                                <i class="fas fa-chart-line"></i>
                                24-Hour Heat Index Trend
                            </h3>
                        </div>
                        <div class="trend-chart">
                            <div class="chart-container">
                                <?php foreach($historical_data as $index => $data): ?>
                                <div class="chart-bar">
                                    <div class="bar <?php echo getHeatLevelClass($data['level']); ?>" 
                                         style="height: <?php echo ($data['heat_index'] / 50) * 100; ?>%"
                                         data-value="<?php echo $data['heat_index']; ?>°C">
                                    </div>
                                    <div class="bar-label"><?php echo $data['time']; ?></div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Real-time Updates -->
                    <div class="dashboard-card updates-card">
                        <div class="card-header">
                            <h3>
                                <i class="fas fa-bell"></i>
                                Recent Heat Alerts
                            </h3>
                        </div>
                        <div class="alerts-list">
                            <div class="alert-item danger">
                                <div class="alert-icon">
                                    <i class="fas fa-exclamation-circle"></i>
                                </div>
                                <div class="alert-info">
                                    <h5>Danger Level Reached</h5>
                                    <p>Heat index exceeded 40°C at City Hall</p>
                                    <span class="alert-time">2 minutes ago</span>
                                </div>
                            </div>
                            <div class="alert-item caution">
                                <div class="alert-icon">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                <div class="alert-info">
                                    <h5>Caution Level Alert</h5>
                                    <p>Schedule rotation recommended for Main Street</p>
                                    <span class="alert-time">15 minutes ago</span>
                                </div>
                            </div>
                            <div class="alert-item safe">
                                <div class="alert-icon">
                                    <i class="fas fa-info-circle"></i>
                                </div>
                                <div class="alert-info">
                                    <h5>Weather Update</h5>
                                    <p>Wind speed increased, slight cooling expected</p>
                                    <span class="alert-time">1 hour ago</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="monitoring-actions">
                    <button class="action-button action-primary" onclick="refreshData()">
                        <i class="fas fa-sync-alt"></i>
                        Refresh Data
                    </button>
                    <button class="action-button action-secondary" onclick="exportData()">
                        <i class="fas fa-download"></i>
                        Export Report
                    </button>
                    <button class="action-button action-primary" onclick="viewHistory()">
                        <i class="fas fa-history"></i>
                        View History
                    </button>
                    <button class="action-button action-danger" onclick="triggerAlert()">
                        <i class="fas fa-exclamation-triangle"></i>
                        Manual Alert
                    </button>
                </div>
            </div>
        </main>
    </div>

    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/heat-monitoring.js"></script>
</body>
</html>