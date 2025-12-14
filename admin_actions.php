<?php
session_start();
require_once"db.php";

$action = $_POST['action'] ?? null;

// ------------------------
// 1) Get all users
// ------------------------
if ($action === "getUsers") {

    $query = mysqli_query($conn, "SELECT * FROM users");
    $users = [];

    while ($row = mysqli_fetch_assoc($query)) {
        $users[] = $row;
    }

    echo json_encode($users);
    exit;
}


// ------------------------
// 2) Delete User
// ------------------------
if ($action === "deleteUser") {

    $id = $_POST['id'];

    mysqli_query($conn, "DELETE FROM users WHERE id='$id'");
    echo "deleted";
    exit;
}


// ------------------------
// 3) Add User
// ------------------------
// 3) Add User - مع التحقق من SQL Injection
if ($action === "addUser") {
    $name     = mysqli_real_escape_string($conn, $_POST['name']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $role     = mysqli_real_escape_string($conn, $_POST['role']);

    // التحقق من صحة الإيميل
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "invalid_email";
        exit;
    }

    $hashed = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users(name, email, password, role) 
            VALUES ('$name', '$email', '$hashed', '$role')";
    
    if (mysqli_query($conn, $sql)) {
        echo "added";
    } else {
        echo "error";
    }
    exit;
}


// ------------------------
// 4) Update User
// ------------------------
if ($action === "updateUser") {

    $id    = $_POST['id'];
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $role  = $_POST['role'];

    mysqli_query($conn, "UPDATE users SET name='$name', email='$email', role='$role' WHERE id='$id'");

    echo "updated";
    exit;
}


// ------------------------
// 5) Change Password
// ------------------------
if ($action === "changePassword") {

    $id       = $_POST['id'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    mysqli_query($conn, "UPDATE users SET password='$password' WHERE id='$id'");

    echo "pw_changed";
    exit;
}

?>
