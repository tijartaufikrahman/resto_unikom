<?php
// Load configuration
require_once __DIR__ . '/resources/config/config.php';

// Start session
session_start();

// Check session login status
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // Jika sudah login, redirect ke dashboard.php
    header('Location: resources/views/dashboard/index.php');
    exit;
} else {
    // Jika belum login, redirect ke login.php
    header('Location: resources/views/login/login.php');
    exit;
}
