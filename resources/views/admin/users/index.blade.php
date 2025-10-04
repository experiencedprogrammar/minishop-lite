{{-- Users Management Styles --}}
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    :root {
        --primary: #0088fe;
        --secondary: #3498db;
        --accent: #e74c3c;
        --light: #f5f7fa;
        --dark: #2c3e50;
        --success: #2ecc71;
        --warning: #f39c12;
        --info: #17a2b8;
    }

    body {
        background-color: #f0f4f8;
        color: #333;
        padding: 20px;
    }

    .users-management {
        background: white;
        border-radius: 5px;
        padding: 16px;
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.05);
        margin-bottom: 16px;
    }

    .users-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
        padding-bottom: 8px;
        border-bottom: 1px solid #eee;
    }

    .users-title {
        font-size: 1.4rem;
        color: var(--dark);
        font-weight: 600;
    }

    .action-buttons {
        display: flex;
        gap: 10px;
    }

    .btn {
        padding: 6px 12px;
        border-radius: 4px;
        border: none;
        cursor: pointer;
        font-weight: 500;
        font-size: 0.85rem;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .btn-primary {
        background-color: var(--primary);
        color: white;
    }

    .btn-primary:hover {
        background-color: #0066cc;
    }

    .btn-success {
        background-color: var(--success);
        color: white;
    }

    .btn-success:hover {
        background-color: #27ae60;
    }

    .btn-danger {
        background-color: var(--accent);
        color: white;
    }

    .btn-danger:hover {
        background-color: #c0392b;
    }

    .btn-warning {
        background-color: var(--warning);
        color: white;
    }

    .btn-warning:hover {
        background-color: #e67e22;
    }

    /* Table */
    .table-responsive {
        overflow-x: auto;
        margin-top: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.85rem;
    }

    th, td {
        padding: 8px 12px; /* Reduced from 12px 15px */
        text-align: left;
        border-bottom: 1px solid #eee;
    }

    th {
        background-color: #f8f9fa;
        font-weight: 600;
        color: #495057;
        position: sticky;
        top: 0;
        padding: 10px 12px; /* Slightly more than td for hierarchy */
    }

    tr:hover {
        background-color: #f8f9fa;
    }

    .action-cell {
        display: flex;
        gap: 6px; /* Reduced from 8px */
    }

    /* Search and filter */
    .users-tools {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
        align-items: center;
    }

    .search-box {
        display: flex;
        align-items: center;
        background: white;
        border-radius: 4px;
        padding: 6px 10px; /* Reduced padding */
        border: 1px solid #ddd;
        width: 300px;
    }

    .search-box input {
        border: none;
        outline: none;
        padding: 4px; /* Reduced padding */
        width: 100%;
        font-size: 0.85rem; /* Smaller font */
    }

    .filter-select {
        padding: 6px 10px; /* Reduced padding */
        border-radius: 4px;
        border: 1px solid #ddd;
        background: white;
        font-size: 0.85rem; /* Smaller font */
    }

    @media (max-width: 768px) {
        .users-tools {
            flex-direction: column;
            align-items: stretch;
            gap: 10px;
        }
        
        .search-box {
            width: 100%;
        }
        
        .action-cell {
            flex-direction: column;
        }
    }
</style>


<!-- Users Management Section -->
<div class="users-management">
    <div class="users-header">
        <h2 class="users-title">Users Management</h2>
        <div class="action-buttons">
            <button class="btn btn-primary" onclick="openAddUserModal()">
                <i class="fas fa-plus"></i> Create User
            </button>
        </div>
    </div>

    

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Registered</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>USR-{{ str_pad($user->id, 3, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>User</td>
                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                    <td class="action-cell">
                        <button class="btn btn-warning" onclick="openEditUserModal({{ $user->id }})">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button class="btn btn-danger" onclick="confirmDeleteUser({{ $user->id }})">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </td>
                </tr>
                @endforeach
                
                @if($users->count() == 0)
                <tr>
                    <td colspan="7" style="text-align: center;">No users found</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

{{-- Scripts --}}
<script>
    function openAddUserModal() {
        document.getElementById('addUserModal').style.display = 'block';
    }

    function closeAddUserModal() {
        document.getElementById('addUserModal').style.display = 'none';
    }

    function openEditUserModal() {
        document.getElementById('editUserModal').style.display = 'block';
    }

    function closeEditUserModal() {
        document.getElementById('editUserModal').style.display = 'none';
    }

    function confirmDeleteUser() {
        if (confirm('Are you sure you want to delete this user?')) {
            alert('User deleted successfully!');
        }
    }

    </script>
