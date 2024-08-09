<?php
// Konfigurasi Database
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'resto_unikom');

// Konfigurasi URL
define('BASE_URL', 'http://localhost/resto_unikom'); // Jangan gunakan double slash setelah localhost


// Konfigurasi lainnya
define('SITE_NAME', 'RESTO UNIKOM');
// define('SESSION_TIMEOUT', 3600); // Timeout session dalam detik (misalnya 3600 detik = 1 jam)

// Fungsi untuk koneksi ke database
// function url_api()
// {
//     return 'http://localhost/resto_unikom/resources';
//     // return 'http://192.168.2.132/resto_unikom/resources';
// }

define('URL', 'http://localhost/resto_unikom/resources');
// define('URL', 'http://192.168.43.40/resto_unikom/resources');
function connectDatabase()
{
    $conn = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if (!$conn) {
        die("Koneksi ke database gagal: " . mysqli_connect_error());
    }
    return $conn;
}

// Mulai koneksi database
$db_conn = connectDatabase();



function formatRupiah($angka)
{
    // Pastikan input adalah angka
    if (!is_numeric($angka)) {
        return "Rp 0";
    }
    $formatted = number_format($angka, 0, ',', '.');
    return 'Rp ' . $formatted;
}

// Contoh penggunaan
// echo formatRupiah(1000000);  // Output: Rp 1.000.000
