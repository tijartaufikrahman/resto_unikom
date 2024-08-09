<?php
require_once __DIR__ . '../../config/config.php';
session_start();
if (isset($_POST['update_profile'])) {
    $id_users = $_POST['id_users'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    // $role = $_POST['divisi'];

    // echo $id_users;
    // echo $nama_lengkap;
    // echo $username;
    // echo $email;
    // echo $password;
    // echo $role;

    $query_update_profile = "UPDATE users
            SET name = '$nama_lengkap',
                username = '$username',
                email = '$email',
                password = '$password'           
            WHERE id = '$id_users'
            ";


    if (mysqli_query($db_conn, $query_update_profile)) {
        // Jika berhasil, set session success
        $_SESSION['alert'] = array(
            'type' => 'success',
            'message' => 'Profile  updated successfully.'
        );
    } else {
        // Jika terjadi kesalahan saat query, set session error
        $_SESSION['alert'] = array(
            'type' => 'error',
            'message' => 'Failed to Profile  updated.'
        );
    }
    header("Location: " . URL . "/views/admin/index.php?q=profile");

    exit;
}
