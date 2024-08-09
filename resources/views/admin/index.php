<?php
// Mulai session
session_start();
require_once __DIR__ . '/../../config/config.php';

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../login/login.php');
    exit;
}

?>

<?php include 'layouts/header.php'; ?>
<?php include 'layouts/main.php'; ?>
<?php include 'layouts/footer.php'; ?>