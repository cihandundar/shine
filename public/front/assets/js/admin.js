document.addEventListener("DOMContentLoaded", () => {
    console.log("Admin.js loaded successfully!");
    
    const btn = document.getElementById("logoDropdownBtn");
    const menu = document.getElementById("logoDropdownMenu");
    
    console.log("Dropdown button:", btn);
    console.log("Dropdown menu:", menu);
    console.log("Button element found:", !!btn);
    console.log("Menu element found:", !!menu);

    if (btn && menu) {
        console.log("Both elements found, adding event listeners...");
        
        // Logo tıklayınca aç/kapat
        btn.addEventListener("click", (e) => {
            e.stopPropagation();
            console.log("Dropdown button clicked!");
            console.log("Current menu classes:", menu.className);
            console.log("Contains scale-0:", menu.classList.contains("scale-0"));
            
            if (menu.classList.contains("scale-0")) {
                console.log("Opening dropdown...");
                menu.classList.remove("scale-0");
                menu.classList.add("scale-100");
                console.log("Menu classes after opening:", menu.className);
            } else {
                console.log("Closing dropdown...");
                menu.classList.remove("scale-100");
                menu.classList.add("scale-0");
                console.log("Menu classes after closing:", menu.className);
            }
        });

        // Menü dışında tıklanınca kapan
        document.addEventListener("click", (e) => {
            if (!menu.contains(e.target) && !btn.contains(e.target)) {
                console.log("Closing dropdown (outside click)");
                menu.classList.remove("scale-100");
                menu.classList.add("scale-0");
            }
        });
        
        console.log("Event listeners added successfully!");
    } else {
        console.error("Dropdown elements not found!");
        console.error("Button:", btn);
        console.error("Menu:", menu);
    }

    // User Management Functions
    initializeUserManagement();
});

// User Management Functions
function initializeUserManagement() {
    // Close modals when clicking outside
    document.addEventListener('click', function(event) {
        const userModal = document.getElementById('userModal');
        const roleModal = document.getElementById('roleModal');
        
        if (event.target === userModal) {
            closeUserModal();
        }
        
        if (event.target === roleModal) {
            closeRoleModal();
        }
    });

    // Auto-hide success/error messages after 5 seconds
    setTimeout(function() {
        const messages = document.querySelectorAll('.bg-green-100, .bg-red-100');
        messages.forEach(function(message) {
            message.style.display = 'none';
        });
    }, 5000);
}

// User Modal Functions
function openUserModal() {
    const modal = document.getElementById('userModal');
    const modalTitle = document.getElementById('modalTitle');
    const form = document.getElementById('userForm');
    const isEditInput = document.getElementById('isEdit');
    const userIdInput = document.getElementById('userId');
    
    if (modal && modalTitle && form && isEditInput && userIdInput) {
        modal.classList.remove('hidden');
        modalTitle.textContent = 'Add New User';
        form.action = '/admin/adminList';
        form.method = 'POST';
        isEditInput.value = 'false';
        userIdInput.value = '';
        form.reset();
    }
}

function closeUserModal() {
    const modal = document.getElementById('userModal');
    if (modal) {
        modal.classList.add('hidden');
    }
}

function editUser(id, name, email, roleId) {
    const modal = document.getElementById('userModal');
    const modalTitle = document.getElementById('modalTitle');
    const form = document.getElementById('userForm');
    const isEditInput = document.getElementById('isEdit');
    const userIdInput = document.getElementById('userId');
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const roleSelect = document.getElementById('role_id');
    const passwordInput = document.getElementById('password');
    
    if (modal && modalTitle && form && isEditInput && userIdInput && nameInput && emailInput && roleSelect && passwordInput) {
        modal.classList.remove('hidden');
        modalTitle.textContent = 'Edit User';
        form.action = `/admin/adminList/${id}`;
        form.method = 'POST';
        
        // Add method override for PUT request
        let methodInput = form.querySelector('input[name="_method"]');
        if (!methodInput) {
            methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            form.appendChild(methodInput);
        }
        methodInput.value = 'PUT';
        
        isEditInput.value = 'true';
        userIdInput.value = id;
        nameInput.value = name;
        emailInput.value = email;
        roleSelect.value = roleId || '';
        passwordInput.value = '';
    }
}

// Role Modal Functions
function openRoleModal(userId) {
    const modal = document.getElementById('roleModal');
    const form = document.getElementById('roleForm');
    
    if (modal && form) {
        modal.classList.remove('hidden');
        form.action = `/admin/adminList/${userId}/assign-role`;
    }
}

function closeRoleModal() {
    const modal = document.getElementById('roleModal');
    if (modal) {
        modal.classList.add('hidden');
    }
}

// Delete User Function
function deleteUser(userId) {
    if (confirm('Are you sure you want to delete this user? This action cannot be undone.')) {
        const form = document.createElement('input');
        form.method = 'POST';
        form.action = `/admin/adminList/${userId}`;
        
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
        
        form.appendChild(methodInput);
        form.appendChild(csrfInput);
        document.body.appendChild(form);
        form.submit();
    }
}
