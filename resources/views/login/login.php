<?php
// Mulai session
session_start();

// Include file konfigurasi
require_once __DIR__ . '/../../config/config.php';

// Menguji koneksi database
if (!$db_conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Inisialisasi variabel pesan error
$error = '';

// Proses form login ketika ada pengiriman data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil nilai dari form login
    $email = $_POST['email']; // Menggunakan email sebagai username
    $password = $_POST['password'];

    // Query untuk mencari user berdasarkan email (username) dan join dengan tabel roles
    $query = "SELECT u.*, r.role_name 
              FROM users u 
              LEFT JOIN roles r ON u.role_id = r.id 
              WHERE u.email = ?";
    $stmt = mysqli_prepare($db_conn, $query);

    // Bind parameter email ke query
    mysqli_stmt_bind_param($stmt, 's', $email);

    // Eksekusi query
    if (!mysqli_stmt_execute($stmt)) {
        die("Query error: " . mysqli_error($db_conn));
    }

    // Ambil hasil query
    $result = mysqli_stmt_get_result($stmt);

    // Pastikan query mengembalikan baris data
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Verifikasi password
        if ($password === $row['password']) { // Membandingkan plain text password
            // Password benar, set session berdasarkan role
            $_SESSION['logged_in'] = true;
            $_SESSION['id'] = $row['id']; // Simpan email ke session
            $_SESSION['username'] = $row['username']; // Simpan email ke session
            $_SESSION['name'] = $row['name']; // Simpan email ke session
            $_SESSION['email'] = $row['email']; // Simpan email ke session
            $_SESSION['role'] = $row['role_name']; // Simpan role_name ke session
            $_SESSION['role_id'] = $row['role_id']; // Simpan role_name ke session

            $key = '';

            if ($row['role_id'] == 1) {
                $key = '';
            } else if ($row['role_id'] == 2) {
                $key = '?q=find-table-and-seats';
            } else if ($row['role_id'] == 3) {
                $key = '?q=orderhandling-food-preparation';
            } else if ($row['role_id'] == 4) {
                $key = '?q=payment';
            }

            // Redirect ke halaman admin
            header('Location: ../admin/index.php' . $key);
            exit;
        } else {
            // Password salah
            $error = 'Password salah. Silakan coba lagi.';
            $_SESSION['loginError'] = 'Login failed';
        }
    } else {
        // Email tidak ditemukan
        $error = 'Email tidak ditemukan.';
        $_SESSION['loginError'] = 'Login failed';
    }
}

// Jika sudah logged in, redirect langsung ke admin
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // Redirect ke halaman admin
    header('Location: ../admin/index.php');
    exit;
}
?>




<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - <?php echo SITE_NAME; ?></title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Bootstrap Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- My Bootstrap-->
    <link rel="stylesheet" href="../public/css/styles.css">
</head>

<body class="bg-light">




    <div class="container mt-4">

        <?php include 'main.php' ?>

    </div>

    <!-- End Of Konten -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>