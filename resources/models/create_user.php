<?php

session_start();
require_once __DIR__ . '../../config/config.php';

if (isset($_POST['create_user'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = $_POST['password'];


    // echo $name;
    // echo $username;
    // echo $role;
    // echo $password;

    $sql = "INSERT INTO `users` (`id`, `name`, `username`, `email`,  `password`, `role_id`) 
    VALUES (NULL, '$name', '$username', '$email', $password, '$role');";


    // Lakukan query
    if (mysqli_query($db_conn, $sql)) {
        // Jika berhasil, set session success
        $_SESSION['alert'] = array(
            'type' => 'success',
            'message' => 'User added successfully.'
        );
    } else {
        // Jika terjadi kesalahan saat query, set session error
        $_SESSION['alert'] = array(
            'type' => 'error',
            'message' => 'User to add failed.'
        );
    }
    header("Location: " . URL . "/views/admin/index.php?q=users");
    exit;
}
