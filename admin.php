<?php
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="css/style.css">

    <style>
        body {
            background: #f7f7f7;
            padding-top: 10rem;
        }
    </style>
</head>

<body>

    <div class="admin-container">

        <h2>Admin Dashboard</h2>

        <h3 style="font-size:2rem; margin-bottom:1rem;">Users List</h3>

        <table id="usersTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

        <div class="add-title">Add New User</div>

        <form id="addUserForm" enctype="multipart/form-data">
            <div class="input-row">
                <input type="text" name="name" class="box" placeholder="Full Name" required>
                <input type="email" name="email" class="box" placeholder="Email" required>
            </div>

            <div class="input-row">
                <input type="password" name="password" class="box" placeholder="Password" required>

                <select name="role" class="box">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <button class="btn-admin" style="margin-top:1rem;">Add User</button>
        </form>

    </div>

    <script>
        function loadUsers() {
            fetch("admin_actions.php", {
                method: "POST",
                body: new URLSearchParams({ action: "getUsers" })
            })
                .then(res => res.json())
                .then(data => {
                    let tbody = document.querySelector("#usersTable tbody");
                    tbody.innerHTML = "";

                    data.forEach(u => {
                        tbody.innerHTML += `
                        <tr>
                            <td>${u.id}</td>
                            <td><img src="${u.photo ? u.photo : 'images/default.png'}"></td>
                            <td>${u.name}</td>
                            <td>${u.email}</td>
                            <td>${u.role}</td>

                            <td>
                                <button class="btn-admin" onclick="editUser(${u.id}, '${u.name}', '${u.email}', '${u.role}')">Edit</button>
                                <button class="btn-admin" onclick="deleteUser(${u.id})">Delete</button>
                                <button class="btn-admin" onclick="changePw(${u.id})">Password</button>
                            </td>
                        </tr>`;
                    });
                });
        }
        loadUsers();
    </script>

</body>
</html>
