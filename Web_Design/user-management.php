<?php
$page_title = "User Management - HeatGuard";
$additional_css = ['assets/css/dashboard.css', 'assets/css/user-management.css'];
$additional_js = ['assets/js/dashboard.js', 'assets/js/user-management.js'];

// Sample user data - In a real application, this would come from a database
$users = [
    [
        'id' => 1,
        'name' => 'Officer Jerome Buntalidad',
        'email' => 'j.buntalidad@bacolod.gov.ph',
        'role' => 'Traffic Officer',
        'department' => 'Bacolod TMU',
        'badge' => 'TMU-2024-001',
        'status' => 'active',
        'last_login' => '2024-08-27 08:30:00',
        'created_at' => '2024-01-15',
        'phone' => '+63 917 123 4567'
    ],
    [
        'id' => 2,
        'name' => 'Dr. Maria Santos',
        'email' => 'm.santos@bacolod.gov.ph',
        'role' => 'Health Officer',
        'department' => 'City Health Office',
        'badge' => 'CHO-2024-002',
        'status' => 'active',
        'last_login' => '2024-08-26 16:45:00',
        'created_at' => '2024-01-20',
        'phone' => '+63 917 234 5678'
    ],
    [
        'id' => 3,
        'name' => 'Admin Carlos Rodriguez',
        'email' => 'c.rodriguez@bacolod.gov.ph',
        'role' => 'System Admin',
        'department' => 'IT Department',
        'badge' => 'ADM-2024-001',
        'status' => 'active',
        'last_login' => '2024-08-27 07:15:00',
        'created_at' => '2024-01-10',
        'phone' => '+63 917 345 6789'
    ],
    [
        'id' => 4,
        'name' => 'Officer Lisa Reyes',
        'email' => 'l.reyes@bacolod.gov.ph',
        'role' => 'Traffic Officer',
        'department' => 'Bacolod TMU',
        'badge' => 'TMU-2024-003',
        'status' => 'inactive',
        'last_login' => '2024-08-20 12:30:00',
        'created_at' => '2024-02-01',
        'phone' => '+63 917 456 7890'
    ]
];

$user_roles = [
    'System Admin' => 'Full system access and configuration',
    'Traffic Officer' => 'Field operations and reporting',
    'Health Officer' => 'Medical oversight and emergency response',
    'Supervisor' => 'Team management and scheduling'
];

$current_user = [
    'name' => 'Officer Jerome Buntalidad',
    'role' => 'Traffic Officer',
    'department' => 'Bacolod TMU',
    'badge' => 'TMU-2024-001',
    'status' => 'on_duty'
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <link rel="stylesheet" href="assets/css/user-management.css">
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
                        <a href="user-management.php" class="nav-link active">
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
                    <h1 class="page-title">User Management</h1>
                </div>
                
                <div class="top-bar-right">
                    <div class="status-indicator <?php echo $current_user['status'] === 'on_duty' ? 'status-online' : 'status-offline'; ?>">
                        <i class="fas fa-circle"></i>
                        <?php echo $current_user['status'] === 'on_duty' ? 'On Duty' : 'Off Duty'; ?>
                    </div>
                    
                    <div class="user-menu">
                        <div class="user-avatar">
                            <?php echo strtoupper(substr($current_user['name'], 8, 1)) . strtoupper(substr($current_user['name'], 13, 1)); ?>
                        </div>
                        <div class="user-info">
                            <h4><?php echo explode(' ', $current_user['name'])[1] . ' ' . explode(' ', $current_user['name'])[2]; ?></h4>
                            <p><?php echo $current_user['role']; ?></p>
                        </div>
                    </div>
                </div>
            </header>

            <!-- User Management Content -->
            <div class="user-management-content">
                <!-- Stats Cards -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-info">
                            <h3><?php echo count($users); ?></h3>
                            <p>Total Users</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon active">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <div class="stat-info">
                            <h3><?php echo count(array_filter($users, function($u) { return $u['status'] === 'active'; })); ?></h3>
                            <p>Active Users</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon roles">
                            <i class="fas fa-user-cog"></i>
                        </div>
                        <div class="stat-info">
                            <h3><?php echo count($user_roles); ?></h3>
                            <p>User Roles</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon departments">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="stat-info">
                            <h3><?php echo count(array_unique(array_column($users, 'department'))); ?></h3>
                            <p>Departments</p>
                        </div>
                    </div>
                </div>

                <!-- Action Bar -->
                <div class="action-bar">
                    <div class="search-container">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search users..." id="searchInput">
                    </div>
                    <div class="action-buttons">
                        <button class="btn btn-secondary" onclick="exportUsers()">
                            <i class="fas fa-download"></i>
                            Export
                        </button>
                        <button class="btn btn-primary" onclick="openAddUserModal()">
                            <i class="fas fa-plus"></i>
                            Add User
                        </button>
                    </div>
                </div>

                <!-- Users Table -->
                <div class="table-container">
                    <table class="users-table">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Role</th>
                                <th>Department</th>
                                <th>Status</th>
                                <th>Last Login</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="usersTableBody">
                            <?php foreach ($users as $user): ?>
                            <tr data-user-id="<?php echo $user['id']; ?>">
                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar-small">
                                            <?php echo strtoupper(substr($user['name'], 0, 1)); ?>
                                        </div>
                                        <div class="user-details">
                                            <h4><?php echo $user['name']; ?></h4>
                                            <p><?php echo $user['email']; ?></p>
                                            <span class="badge-number"><?php echo $user['badge']; ?></span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="role-badge role-<?php echo strtolower(str_replace(' ', '-', $user['role'])); ?>">
                                        <?php echo $user['role']; ?>
                                    </span>
                                </td>
                                <td><?php echo $user['department']; ?></td>
                                <td>
                                    <span class="status-badge status-<?php echo $user['status']; ?>">
                                        <i class="fas fa-circle"></i>
                                        <?php echo ucfirst($user['status']); ?>
                                    </span>
                                </td>
                                <td><?php echo date('M j, Y g:i A', strtotime($user['last_login'])); ?></td>
                                <td>
                                    <div class="action-buttons-cell">
                                        <button class="btn-icon btn-edit" onclick="editUser(<?php echo $user['id']; ?>)" title="Edit User">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn-icon btn-view" onclick="viewUser(<?php echo $user['id']; ?>)" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn-icon btn-delete" onclick="deleteUser(<?php echo $user['id']; ?>)" title="Delete User">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- Add/Edit User Modal -->
    <div id="userModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalTitle">Add New User</h2>
                <span class="close" onclick="closeModal()">&times;</span>
            </div>
            <div class="modal-body">
                <form id="userForm">
                    <input type="hidden" id="userId" name="userId">
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="fullName">Full Name *</label>
                            <input type="text" id="fullName" name="fullName" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address *</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone">
                        </div>
                        <div class="form-group">
                            <label for="badgeNumber">Badge Number *</label>
                            <input type="text" id="badgeNumber" name="badgeNumber" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="userRole">Role *</label>
                            <select id="userRole" name="userRole" required>
                                <option value="">Select Role</option>
                                <?php foreach ($user_roles as $role => $description): ?>
                                <option value="<?php echo $role; ?>"><?php echo $role; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="department">Department *</label>
                            <select id="department" name="department" required>
                                <option value="">Select Department</option>
                                <option value="Bacolod TMU">Bacolod TMU</option>
                                <option value="City Health Office">City Health Office</option>
                                <option value="IT Department">IT Department</option>
                                <option value="Emergency Services">Emergency Services</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="userStatus">Status</label>
                            <select id="userStatus" name="userStatus">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password">Password *</label>
                            <input type="password" id="password" name="password">
                            <small class="form-hint">Leave blank to keep current password (for edit)</small>
                        </div>
                    </div>

                    <div class="role-description" id="roleDescription">
                        <h4>Role Permissions:</h4>
                        <p id="roleDescriptionText">Select a role to view permissions</p>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal()">Cancel</button>
                <button type="submit" class="btn btn-primary" form="userForm" id="submitBtn">Add User</button>
            </div>
        </div>
    </div>

    <!-- View User Modal -->
    <div id="viewUserModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>User Details</h2>
                <span class="close" onclick="closeViewModal()">&times;</span>
            </div>
            <div class="modal-body">
                <div id="userDetailsContent">
                    <!-- User details will be populated here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeViewModal()">Close</button>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content modal-small">
            <div class="modal-header">
                <h2>Confirm Delete</h2>
                <span class="close" onclick="closeDeleteModal()">&times;</span>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this user? This action cannot be undone.</p>
                <div class="user-delete-info" id="deleteUserInfo">
                    <!-- User info will be populated here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeDeleteModal()">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete User</button>
            </div>
        </div>
    </div>

    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/user-management.js"></script>
    <script>
        // Pass PHP data to JavaScript
        window.userData = <?php echo json_encode($users); ?>;
        window.userRoles = <?php echo json_encode($user_roles); ?>;
    </script>
</body>
</html>