<?php
session_start();
require_once "db.php";

if (!isset($_SESSION['email']))
     { header("Location: index.php");
         exit();
         }

$uploadDir = "uploads/";
$message = '';

/* التأكد من وجود مجلد uploads */
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

/* ==== معالجة النماذج ==== */

/* ADD USER */
if(isset($_POST['action']) && $_POST['action'] === 'addUser') {
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $pw    = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role  = $_POST['role'];

    $photo = '';
    if(isset($_FILES['photo']) && $_FILES['photo']['name'] != '') {
        $photo = time() . '_' . $_FILES['photo']['name'];
        move_uploaded_file($_FILES['photo']['tmp_name'], $uploadDir . $photo);
    }

    $conn->query("INSERT INTO users (name,email,password,role,photo)
                  VALUES ('$name','$email','$pw','$role','$photo')");
    $message = "User added successfully";
     header("Location: admin.php");
    exit();
}

/* EDIT USER */
if(isset($_POST['action']) && $_POST['action'] === 'editUser') {
    $id    = $_POST['id'];
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $role  = $_POST['role'];

    $sql = "UPDATE users SET name='$name', email='$email', role='$role'";

    if(isset($_FILES['photo']) && $_FILES['photo']['name'] != '') {
        $photo = time() . '_' . $_FILES['photo']['name'];
        move_uploaded_file($_FILES['photo']['tmp_name'], $uploadDir . $photo);
        $sql .= ", photo='$photo'";
    }

    $sql .= " WHERE id=$id";
    $conn->query($sql);
    $message = "User updated successfully";
     header("Location: admin.php");
    exit();
}

/* DELETE USER */
if(isset($_POST['action']) && $_POST['action'] === 'deleteUser') {
    $id = $_POST['id'];
    $conn->query("DELETE FROM users WHERE id=$id");
    $message = "User deleted successfully";
     header("Location: admin.php");
    exit();
}

/* CHANGE PASSWORD */
if(isset($_POST['action']) && $_POST['action'] === 'changePassword') {
    $id = $_POST['id'];
    $pw = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $conn->query("UPDATE users SET password='$pw' WHERE id=$id");
    $message = "Password changed successfully";
     header("Location: admin.php");
    exit();
}

/* ==== جلب المستخدمين ==== */
$users = $conn->query("SELECT * FROM users");

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Panel</title>
<link rel="stylesheet" href="css/style.css">
<style>

html, body { height: auto; overflow-x: hidden; } 
body { background: #f7f7f7;
     padding: 2rem 0;
      min-height: 100vh;
       margin: 0; }
.edit-box {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #fff;
    padding: 2rem;
    border-radius: 1rem;
    box-shadow: 0 0 15px rgba(0,0,0,.3);
    display: none;
    z-index: 999;
    width: 400px;
}
.edit-box input, .edit-box select {
    width: 100%;
    margin-bottom: 1rem;
    padding: 1rem;
    font-size: 1.6rem;
}
</style>
</head>
<body>

<div class="admin-container">

    <h2>Admin Dashboard</h2>

    <?php if($message) echo "<div class='msg'>$message</div>"; ?>

    <!-- USERS TABLE -->
    <h3 style="font-size:2rem;margin-bottom:1rem;">Users List</h3>
    <table>
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
        <tbody>
        <?php while ($u = $users->fetch_assoc()) { ?>
            <tr>
                <td><?= $u['id'] ?></td>
                <td><img src="uploads/<?= $u['photo'] ?: 'default.png' ?>" alt="User Photo"></td>
                <td><?= $u['name'] ?></td>
                <td><?= $u['email'] ?></td>
                <td><?= $u['role'] ?></td>
                <td>
                    <button class="btn-admin" onclick="openEditModal(<?= $u['id'] ?>,'<?= htmlspecialchars($u['name'],ENT_QUOTES) ?>','<?= htmlspecialchars($u['email'],ENT_QUOTES) ?>','<?= $u['role'] ?>')">Edit</button>

                    <form action="" method="post" style="display:inline;" onsubmit="return confirm('Delete this user?');">
                        <input type="hidden" name="action" value="deleteUser">
                        <input type="hidden" name="id" value="<?= $u['id'] ?>">
                        <button type="submit" class="btn-admin">Delete</button>
                    </form>

                    <form action="" method="post" style="display:inline;">
                        <input type="hidden" name="action" value="changePassword">
                        <input type="hidden" name="id" value="<?= $u['id'] ?>">
                        <input type="password" name="password" placeholder="New Password" class="box" required>
                        <button type="submit" class="btn-admin">Change</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <!-- ADD USER -->
    <h3 style="font-size:2rem;margin:2rem 0 1rem;">Add New User</h3>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="action" value="addUser">

        <div class="input-row">
            <input type="text" name="name" placeholder="Full Name" class="box" required>
            <input type="email" name="email" placeholder="Email" class="box" required>
        </div>

        <div class="input-row">
            <input type="password" name="password" placeholder="Password" class="box" required>
            <select name="role" class="box">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
       

        <label>Profile Photo</label>
        <input type="file" name="photo" class="box" required>
         </div>

        <button type="submit" class="btn-admin">Add User</button>
    </form>

</div>

<!-- EDIT MODAL -->
<div id="editBox" class="edit-box">
    <h3>Edit User</h3>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="action" value="editUser">
        <input type="hidden" id="editId" name="id">

        <input type="text" id="editName" name="name" placeholder="Name" required>
        <input type="email" id="editEmail" name="email" placeholder="Email" required>
        <select id="editRole" name="role">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
        <label>Profile Photo</label>
        <input type="file" id="editPhoto" name="photo" accept="image/*">

        <button type="submit" class="btn-admin">Save</button>
        <button type="button" class="btn-admin" onclick="closeEditModal()">Cancel</button>
    </form>
</div>

<script>
function openEditModal(id, name, email, role) {
    document.getElementById('editId').value = id;
    document.getElementById('editName').value = name;
    document.getElementById('editEmail').value = email;
    document.getElementById('editRole').value = role;
    document.getElementById('editPhoto').value = '';
    document.getElementById('editBox').style.display = 'block';
}

function closeEditModal() {
    document.getElementById('editBox').style.display = 'none';
}
</script>

</body>
</html>
