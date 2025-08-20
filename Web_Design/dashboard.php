<?php
$page_title = "Dashboard - HeatGuard";
$additional_css = ['assets/css/dashboard.css'];
$additional_js = ['assets/js/dashboard.js'];


// Mock user data 
$user = [
    'name' => 'Officer Jerome Buntalidad',
    'role' => 'Traffic Enforcer',
    'department' => 'Bacolod TMU',
    'badge' => 'TMU-2024-001',
    'status' => 'on_duty'
];

// Mock dashboard data
$dashboard_data = [
    'heat_index' => 42,
    'heat_level' => 'DANGER',
    'active_officers' => 15,
    'total_officers' => 20,
    'incidents_today' => 2,
    'schedule_alerts' => 5
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="assets/css/dashboard.css">
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
                        <a href="dashboard.php" class="nav-link active">
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
                        <a href="heat-monitoring.php" class="nav-link">
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
                    <h1 class="page-title">Dashboard Overview</h1>
                </div>
                
                <div class="top-bar-right">
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

            <!-- Dashboard Content -->
            <div class="dashboard-content">
                <!-- Main Dashboard Cards -->
                <div class="dashboard-grid">
                    <!-- Heat Index Card -->
                    <div class="dashboard-card">
                        <div class="card-header">
                            <div class="card-title">
                                <div class="card-icon icon-heat">
                                    <i class="fas fa-thermometer-half"></i>
                                </div>
                                Current Heat Index
                            </div>
                        </div>
                        <div class="heat-display">
                            <div class="card-value heat-value"><?php echo $dashboard_data['heat_index']; ?>°C</div>
                            <div class="card-status <?php echo strtolower(str_replace(' ', '-', $dashboard_data['heat_level'])); ?> heat-level">
                                <?php echo $dashboard_data['heat_level']; ?> LEVEL
                            </div>
                        </div>
                        <div class="card-description">
                            Last updated: <?php echo date('h:i A'); ?>
                        </div>
                    </div>

                    <!-- Active Officers Card -->
                    <div class="dashboard-card">
                        <div class="card-header">
                            <div class="card-title">
                                <div class="card-icon icon-users">
                                    <i class="fas fa-users"></i>
                                </div>
                                Active Officers
                            </div>
                        </div>
                        <div class="card-value"><?php echo $dashboard_data['active_officers']; ?>/<?php echo $dashboard_data['total_officers']; ?></div>
                        <div class="card-description">Officers currently on duty</div>
                        <div class="card-status status-safe">
                            <i class="fas fa-check-circle"></i>
                            All stations covered
                        </div>
                    </div>

                    <!-- Schedule Alerts Card -->
                    <div class="dashboard-card">
                        <div class="card-header">
                            <div class="card-title">
                                <div class="card-icon icon-schedule">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                Schedule Alerts
                            </div>
                        </div>
                        <div class="card-value"><?php echo $dashboard_data['schedule_alerts']; ?></div>
                        <div class="card-description">Break reminders and rotations</div>
                        <div class="card-status status-caution">
                            <i class="fas fa-clock"></i>
                            2 officers due for break
                        </div>
                    </div>

                    <!-- Emergency Incidents Card -->
                    <div class="dashboard-card">
                        <div class="card-header">
                            <div class="card-title">
                                <div class="card-icon icon-emergency">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                                Today's Incidents
                            </div>
                        </div>
                        <div class="card-value"><?php echo $dashboard_data['incidents_today']; ?></div>
                        <div class="card-description">Heat-related incidents reported</div>
                        <div class="card-status <?php echo $dashboard_data['incidents_today'] > 0 ? 'status-caution' : 'status-safe'; ?>">
                            <i class="fas <?php echo $dashboard_data['incidents_today'] > 0 ? 'fa-exclamation-circle' : 'fa-check-circle'; ?>"></i>
                            <?php echo $dashboard_data['incidents_today'] > 0 ? 'Requires attention' : 'All clear'; ?>
                        </div>
                    </div>
                </div>

                <!-- Weather Widget and Recent Activity -->
                <div class="dashboard-grid">
                    <div class="dashboard-card weather-widget">
                        <h3 style="margin-bottom: 20px;">
                            <i class="fas fa-cloud-sun"></i>
                            Weather Conditions
                        </h3>
                        <div class="current-weather">
                            <div class="weather-temp"><?php echo $dashboard_data['heat_index']; ?>°C</div>
                            <div class="weather-condition">Extreme Heat Warning</div>
                        </div>
                        <div class="weather-details">
                            <div class="weather-item">
                                <h4>Humidity</h4>
                                <span>78%</span>
                            </div>
                            <div class="weather-item">
                                <h4>Wind Speed</h4>
                                <span>12 km/h</span>
                            </div>
                            <div class="weather-item">
                                <h4>UV Index</h4>
                                <span>11 (Extreme)</span>
                            </div>
                        </div>
                    </div>

                    <div class="dashboard-card">
                        <div class="card-header">
                            <div class="card-title">
                                <div class="card-icon icon-reports">
                                    <i class="fas fa-clock"></i>
                                </div>
                                Recent Activity
                            </div>
                        </div>
                        <div class="activity-list">
                            <div class="activity-item">
                                <div class="activity-icon" style="background: #ef4444;">
                                    <i class="fas fa-thermometer-half"></i>
                                </div>
                                <div class="activity-info">
                                    <h5>Heat alert triggered</h5>
                                    <p>Temperature reached danger level</p>
                                </div>
                                <span class="activity-time">2 min ago</span>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon" style="background: #10b981;">
                                    <i class="fas fa-user-check"></i>
                                </div>
                                <div class="activity-info">
                                    <h5>Officer break completed</h5>
                                    <p>Officer Santos returned to duty</p>
                                </div>
                                <span class="activity-time">15 min ago</span>
                            </div>
                            <div class="activity-item">
                                <div class="activity-icon" style="background: #f59e0b;">
                                    <i class="fas fa-calendar"></i>
                                </div>
                                <div class="activity-info">
                                    <h5>Schedule updated</h5>
                                    <p>Afternoon shift rotation adjusted</p>
                                </div>
                                <span class="activity-time">1 hr ago</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="quick-actions">
                    <a href="emergency-response.php" class="action-button action-danger">
                        <i class="fas fa-ambulance"></i>
                        Emergency Alert
                    </a>
                    <a href="heat-monitoring.php" class="action-button action-primary">
                        <i class="fas fa-thermometer-half"></i>
                        View Heat Data
                    </a>
                    <a href="schedule-management.php" class="action-button action-primary">
                        <i class="fas fa-calendar-alt"></i>
                        Manage Schedules
                    </a>
                    <a href="safety-guidelines.php" class="action-button action-secondary">
                        <i class="fas fa-download"></i>
                        Safety Guidelines
                    </a>
                </div>
            </div>
        </main>
    </div>
    <script src="assets/js/dashboard.js"></script>
</body>
</html>