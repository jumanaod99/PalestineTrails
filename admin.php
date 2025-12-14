<?php
session_start();

if (!isset($_SESSION['email'])) {
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
        html, body { height: auto; overflow-x: hidden; }
        body {
            background: #f7f7f7;
            padding: 2rem 0;
            min-height: 100vh;
            margin: 0;
        }

        .edit-box {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #fff;
            padding: 3rem;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,.3);
            display: none;
            z-index: 999;
            width: 400px;
        }

        .edit-box input,
        .edit-box select {
            width: 100%;
            margin-bottom: 1rem;
            padding: 1rem;
             font-size: 2rem;   
        }
    </style>
</head>

<body>

<div class="admin-container">

    <h2>Admin Dashboard</h2>

    <h3 style="font-size:2rem;margin-bottom:1rem;">Users List</h3>

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

    <h3 style="font-size:2rem;margin:2rem 0 1rem;">Add New User</h3>

    <form id="addUserForm">
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

        <button class="btn-admin">Add User</button>
    </form>
</div>

<!-- EDIT MODAL -->
<div id="editBox" class="edit-box">
    <h3>Edit User</h3>

    <input type="hidden" id="editId">

    <input type="text" id="editName" placeholder="Name">
    <input type="email" id="editEmail" placeholder="Email">

    <select id="editRole">
        <option value="user">User</option>
        <option value="admin">Admin</option>
    </select>

    <button class="btn-admin" onclick="saveEdit()">Save</button>
    <button class="btn-admin" onclick="closeEdit()">Cancel</button>
</div>

<script>
/* LOAD USERS */
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
                <td><img src="${u.photo ? u.photo : 'images/default.png'}" width="40"></td>
                <td>${u.name}</td>
                <td>${u.email}</td>
                <td>${u.role}</td>
                <td>
                    <button class="btn-admin" onclick="openEdit(${u.id}, '${u.name}', '${u.email}', '${u.role}')">Edit</button>
                    <button class="btn-admin" onclick="deleteUser(${u.id})">Delete</button>
                    <button class="btn-admin" onclick="changePw(${u.id})">Password</button>
                </td>
            </tr>`;
        });
    });
}
loadUsers();

/* DELETE */
function deleteUser(id) {
    if (!confirm("Delete this user?")) return;

    fetch("admin_actions.php", {
        method: "POST",
        body: new URLSearchParams({ action: "deleteUser", id })
    }).then(() => loadUsers());
}

/* OPEN EDIT */
function openEdit(id, name, email, role) {
    document.getElementById("editId").value = id;
    document.getElementById("editName").value = name;
    document.getElementById("editEmail").value = email;
    document.getElementById("editRole").value = role;
    document.getElementById("editBox").style.display = "block";
}

/* CLOSE EDIT */
function closeEdit() {
    document.getElementById("editBox").style.display = "none";
}

/* SAVE EDIT */
function saveEdit() {
    let id = editId.value;
    let name = editName.value;
    let email = editEmail.value;
    let role = editRole.value;

    fetch("admin_actions.php", {
        method: "POST",
        body: new URLSearchParams({
            action: "updateUser",
            id, name, email, role
        })
    })
    .then(() => {
        closeEdit();
        loadUsers();
    });
}

/* CHANGE PASSWORD */
function changePw(id) {
    let pw = prompt("New password:");
    if (!pw) return;

    fetch("admin_actions.php", {
        method: "POST",
        body: new URLSearchParams({
            action: "changePassword",
            id,
            password: pw
        })
    }).then(() => alert("Password updated"));
}

/* ADD USER */
document.getElementById("addUserForm").addEventListener("submit", function(e) {
    e.preventDefault();

    let formData = new FormData(this);
    formData.append("action", "addUser");

    fetch("admin_actions.php", {
        method: "POST",
        body: formData
    })
    .then(() => {
        this.reset();
        loadUsers();
    });
});
</script>

</body>
</html>
