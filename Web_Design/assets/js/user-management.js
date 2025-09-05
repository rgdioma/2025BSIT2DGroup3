// User Management JavaScript
document.addEventListener('DOMContentLoaded', function() {
    initializeUserManagement();
});

// Global variables
let currentUsers = window.userData || [];
let editingUserId = null;

function initializeUserManagement() {
    // Initialize search functionality
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', handleSearch);
    }

    // Initialize role description updates
    const roleSelect = document.getElementById('userRole');
    if (roleSelect) {
        roleSelect.addEventListener('change', updateRoleDescription);
    }

    // Initialize form submission
    const userForm = document.getElementById('userForm');
    if (userForm) {
        userForm.addEventListener('submit', handleFormSubmit);
    }

    // Initialize modal close on outside click
    window.addEventListener('click', function(event) {
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
    });
}

// Search functionality
function handleSearch(event) {
    const searchTerm = event.target.value.toLowerCase();
    const tableRows = document.querySelectorAll('#usersTableBody tr');
    
    tableRows.forEach(row => {
        const userName = row.querySelector('.user-details h4').textContent.toLowerCase();
        const userEmail = row.querySelector('.user-details p').textContent.toLowerCase();
        const userRole = row.querySelector('.role-badge').textContent.toLowerCase();
        const userDepartment = row.cells[2].textContent.toLowerCase();
        
        const matches = userName.includes(searchTerm) || 
                       userEmail.includes(searchTerm) || 
                       userRole.includes(searchTerm) || 
                       userDepartment.includes(searchTerm);
        
        row.style.display = matches ? '' : 'none';
    });
}

// Modal functions
function openAddUserModal() {
    editingUserId = null;
    document.getElementById('modalTitle').textContent = 'Add New User';
    document.getElementById('submitBtn').textContent = 'Add User';
    document.getElementById('userForm').reset();
    document.getElementById('userId').value = '';
    document.getElementById('userModal').style.display = 'block';
    updateRoleDescription();
}

function editUser(userId) {
    const user = currentUsers.find(u => u.id == userId);
    if (!user) return;

    editingUserId = userId;
    document.getElementById('modalTitle').textContent = 'Edit User';
    document.getElementById('submitBtn').textContent = 'Update User';
    
    // Populate form fields
    document.getElementById('userId').value = user.id;
    document.getElementById('fullName').value = user.name;
    document.getElementById('email').value = user.email;
    document.getElementById('phone').value = user.phone || '';
    document.getElementById('badgeNumber').value = user.badge;
    document.getElementById('userRole').value = user.role;
    document.getElementById('department').value = user.department;
    document.getElementById('userStatus').value = user.status;
    document.getElementById('password').value = '';
    
    updateRoleDescription();
    document.getElementById('userModal').style.display = 'block';
}

function viewUser(userId) {
    const user = currentUsers.find(u => u.id == userId);
    if (!user) return;

    const userDetailsContent = document.getElementById('userDetailsContent');
    userDetailsContent.innerHTML = `
        <div class="user-profile-header">
            <div class="user-profile-avatar">
                ${user.name.charAt(0).toUpperCase()}
            </div>
            <h3 class="user-profile-name">${user.name}</h3>
            <p class="user-profile-role">${user.role}</p>
        </div>
        <div class="user-detail-grid">
            <div class="user-detail-item">
                <h4>Email Address</h4>
                <p>${user.email}</p>
            </div>
            <div class="user-detail-item">
                <h4>Phone Number</h4>
                <p>${user.phone || 'Not provided'}</p>
            </div>
            <div class="user-detail-item">
                <h4>Badge Number</h4>
                <p>${user.badge}</p>
            </div>
            <div class="user-detail-item">
                <h4>Department</h4>
                <p>${user.department}</p>
            </div>
            <div class="user-detail-item">
                <h4>Status</h4>
                <p><span class="status-badge status-${user.status}">
                    <i class="fas fa-circle"></i>
                    ${user.status.charAt(0).toUpperCase() + user.status.slice(1)}
                </span></p>
            </div>
            <div class="user-detail-item">
                <h4>Member Since</h4>
                <p>${formatDate(user.created_at)}</p>
            </div>
            <div class="user-detail-item">
                <h4>Last Login</h4>
                <p>${formatDateTime(user.last_login)}</p>
            </div>
            <div class="user-detail-item">
                <h4>Role Description</h4>
                <p>${window.userRoles[user.role] || 'No description available'}</p>
            </div>
        </div>
    `;
    
    document.getElementById('viewUserModal').style.display = 'block';
}

function deleteUser(userId) {
    const user = currentUsers.find(u => u.id == userId);
    if (!user) return;

    const deleteUserInfo = document.getElementById('deleteUserInfo');
    deleteUserInfo.innerHTML = `
        <h4>${user.name}</h4>
        <p>Role: ${user.role}</p>
        <p>Department: ${user.department}</p>
    `;

    // Set up delete confirmation
    const confirmBtn = document.getElementById('confirmDeleteBtn');
    confirmBtn.onclick = () => confirmDelete(userId);
    
    document.getElementById('deleteModal').style.display = 'block';
}

function confirmDelete(userId) {
    // In a real application, this would make an API call to delete the user
    currentUsers = currentUsers.filter(u => u.id != userId);
    refreshUsersTable();
    closeDeleteModal();
    showAlert('User deleted successfully!', 'success');
}

// Modal close functions
function closeModal() {
    document.getElementById('userModal').style.display = 'none';
}

function closeViewModal() {
    document.getElementById('viewUserModal').style.display = 'none';
}

function closeDeleteModal() {
    document.getElementById('deleteModal').style.display = 'none';
}

// Form handling
function handleFormSubmit(event) {
    event.preventDefault();
    
    const formData = new FormData(event.target);
    const userData = {
        name: formData.get('fullName'),
        email: formData.get('email'),
        phone: formData.get('phone'),
        badge: formData.get('badgeNumber'),
        role: formData.get('userRole'),
        department: formData.get('department'),
        status: formData.get('userStatus'),
        password: formData.get('password')
    };

    // Validation
    if (!userData.name || !userData.email || !userData.badge || !userData.role || !userData.department) {
        showAlert('Please fill in all required fields.', 'error');
        return;
    }

    if (!isValidEmail(userData.email)) {
        showAlert('Please enter a valid email address.', 'error');
        return;
    }

    if (editingUserId) {
        updateUser(editingUserId, userData);
    } else {
        addUser(userData);
    }
}

function addUser(userData) {
    // Check if email or badge already exists
    const emailExists = currentUsers.some(u => u.email === userData.email);
    const badgeExists = currentUsers.some(u => u.badge === userData.badge);
    
    if (emailExists) {
        showAlert('Email address already exists.', 'error');
        return;
    }
    
    if (badgeExists) {
        showAlert('Badge number already exists.', 'error');
        return;
    }

    if (!userData.password) {
        showAlert('Password is required for new users.', 'error');
        return;
    }

    // Generate new user ID
    const newId = Math.max(...currentUsers.map(u => u.id)) + 1;
    
    const newUser = {
        id: newId,
        ...userData,
        last_login: null,
        created_at: new Date().toISOString().split('T')[0]
    };
    
    currentUsers.push(newUser);
    refreshUsersTable();
    closeModal();
    showAlert('User added successfully!', 'success');
}

function updateUser(userId, userData) {
    const userIndex = currentUsers.findIndex(u => u.id == userId);
    if (userIndex === -1) return;

    // Check if email or badge already exists (excluding current user)
    const emailExists = currentUsers.some(u => u.email === userData.email && u.id != userId);
    const badgeExists = currentUsers.some(u => u.badge === userData.badge && u.id != userId);
    
    if (emailExists) {
        showAlert('Email address already exists.', 'error');
        return;
    }
    
    if (badgeExists) {
        showAlert('Badge number already exists.', 'error');
        return;
    }

    // Update user data (keep existing data for fields not being updated)
    const updatedUser = {
        ...currentUsers[userIndex],
        ...userData
    };
    
    // Don't update password if it's empty (keep existing)
    if (!userData.password) {
        delete updatedUser.password;
    }
    
    currentUsers[userIndex] = updatedUser;
    refreshUsersTable();
    closeModal();
    showAlert('User updated successfully!', 'success');
}

function refreshUsersTable() {
    const tbody = document.getElementById('usersTableBody');
    tbody.innerHTML = '';
    
    currentUsers.forEach(user => {
        const row = createUserRow(user);
        tbody.appendChild(row);
    });
    
    updateStats();
}

function createUserRow(user) {
    const row = document.createElement('tr');
    row.setAttribute('data-user-id', user.id);
    
    const userInitials = user.name.charAt(0).toUpperCase();
    const roleClass = user.role.toLowerCase().replace(' ', '-');
    const lastLogin = user.last_login ? formatDateTime(user.last_login) : 'Never';
    
    row.innerHTML = `
        <td>
            <div class="user-cell">
                <div class="user-avatar-small">${userInitials}</div>
                <div class="user-details">
                    <h4>${user.name}</h4>
                    <p>${user.email}</p>
                    <span class="badge-number">${user.badge}</span>
                </div>
            </div>
        </td>
        <td>
            <span class="role-badge role-${roleClass}">
                ${user.role}
            </span>
        </td>
        <td>${user.department}</td>
        <td>
            <span class="status-badge status-${user.status}">
                <i class="fas fa-circle"></i>
                ${user.status.charAt(0).toUpperCase() + user.status.slice(1)}
            </span>
        </td>
        <td>${lastLogin}</td>
        <td>
            <div class="action-buttons-cell">
                <button class="btn-icon btn-edit" onclick="editUser(${user.id})" title="Edit User">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="btn-icon btn-view" onclick="viewUser(${user.id})" title="View Details">
                    <i class="fas fa-eye"></i>
                </button>
                <button class="btn-icon btn-delete" onclick="deleteUser(${user.id})" title="Delete User">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </td>
    `;
    
    return row;
}

function updateStats() {
    const totalUsers = currentUsers.length;
    const activeUsers = currentUsers.filter(u => u.status === 'active').length;
    
    // Update stat cards
    const statCards = document.querySelectorAll('.stat-card');
    if (statCards.length >= 2) {
        statCards[0].querySelector('h3').textContent = totalUsers;
        statCards[1].querySelector('h3').textContent = activeUsers;
    }
}

function updateRoleDescription() {
    const roleSelect = document.getElementById('userRole');
    const roleDescriptionText = document.getElementById('roleDescriptionText');
    
    if (roleSelect && roleDescriptionText) {
        const selectedRole = roleSelect.value;
        const description = window.userRoles[selectedRole] || 'Select a role to view permissions';
        roleDescriptionText.textContent = description;
    }
}

// Export functionality
function exportUsers() {
    const csvContent = "data:text/csv;charset=utf-8," 
        + "Name,Email,Role,Department,Badge,Status,Created Date\n"
        + currentUsers.map(user => 
            `"${user.name}","${user.email}","${user.role}","${user.department}","${user.badge}","${user.status}","${user.created_at}"`
        ).join("\n");
    
    const encodedUri = encodeURI(csvContent);
    const link = document.createElement("a");
    link.setAttribute("href", encodedUri);
    link.setAttribute("download", "users_export.csv");
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    
    showAlert('User data exported successfully!', 'success');
}

// Utility functions
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', { 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric' 
    });
}

function formatDateTime(dateTimeString) {
    const date = new Date(dateTimeString);
    return date.toLocaleDateString('en-US', { 
        year: 'numeric', 
        month: 'short', 
        day: 'numeric',
        hour: 'numeric',
        minute: '2-digit',
        hour12: true
    });
}

function showAlert(message, type) {
    // Remove any existing alerts
    const existingAlert = document.querySelector('.alert');
    if (existingAlert) {
        existingAlert.remove();
    }
    
    const alert = document.createElement('div');
    alert.className = `alert alert-${type}`;
    alert.innerHTML = `
        <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'exclamation-triangle'}"></i>
        ${message}
    `;
    
    const content = document.querySelector('.user-management-content');
    content.insertBefore(alert, content.firstChild);
    
    // Auto-remove after 5 seconds
    setTimeout(() => {
        if (alert.parentNode) {
            alert.remove();
        }
    }, 5000);
}

// Keyboard shortcuts
document.addEventListener('keydown', function(event) {
    // Ctrl+N or Cmd+N to add new user
    if ((event.ctrlKey || event.metaKey) && event.key === 'n') {
        event.preventDefault();
        openAddUserModal();
    }
    
    // Escape key to close modals
    if (event.key === 'Escape') {
        const openModals = document.querySelectorAll('.modal[style*="block"]');
        openModals.forEach(modal => {
            modal.style.display = 'none';
        });
    }
});

// Initialize tooltips
function initializeTooltips() {
    const tooltipElements = document.querySelectorAll('[title]');
    tooltipElements.forEach(element => {
        element.addEventListener('mouseenter', showTooltip);
        element.addEventListener('mouseleave', hideTooltip);
    });
}

function showTooltip(event) {
    const tooltip = document.createElement('div');
    tooltip.className = 'tooltip-popup';
    tooltip.textContent = event.target.getAttribute('title');
    tooltip.style.position = 'absolute';
    tooltip.style.background = '#1f2937';
    tooltip.style.color = 'white';
    tooltip.style.padding = '8px 12px';
    tooltip.style.borderRadius = '6px';
    tooltip.style.fontSize = '12px';
    tooltip.style.zIndex = '9999';
    tooltip.style.pointerEvents = 'none';
    
    document.body.appendChild(tooltip);
    
    const rect = event.target.getBoundingClientRect();
    tooltip.style.left = rect.left + (rect.width / 2) - (tooltip.offsetWidth / 2) + 'px';
    tooltip.style.top = rect.top - tooltip.offsetHeight - 8 + 'px';
    
    event.target.tooltipElement = tooltip;
}

function hideTooltip(event) {
    if (event.target.tooltipElement) {
        event.target.tooltipElement.remove();
        event.target.tooltipElement = null;
    }
}