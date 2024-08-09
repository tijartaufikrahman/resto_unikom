<?php
require_once __DIR__ . '../../config/config.php';

// Menerima data POST dari JavaScript
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['productId']) && isset($data['newQuantity'])) {
    $productId = $data['productId'];
    $newQuantity = $data['newQuantity'];

    // Debug output
    echo "Product ID: " . $productId . "\n";
    echo "New Quantity: " . $newQuantity . "\n";

    // Panggil fungsi updateProductQuantity untuk memperbarui jumlah produk
    updateProductQuantity($productId, $newQuantity);
} else {
    http_response_code(400); // Bad request
    die("Missing productId or newQuantity");
}

function updateProductQuantity($productId, $newQuantity)
{
    // Koneksi ke database menggunakan MySQLi
    $host = 'localhost';
    $dbname = 'resto_unikom';
    $username = 'root';
    $password = '';

    // Buat koneksi
    $conn = new mysqli($host, $username, $password, $dbname);

    // Check koneksi
    if ($conn->connect_error) {
        die("Connection failed: " . mysqli_connect_error());
    }
    echo "Database connection established.\n";

    // Escape input to prevent SQL injection (optional for integer input)
    $productId = mysqli_real_escape_string($conn, $productId);
    $newQuantity = mysqli_real_escape_string($conn, $newQuantity);

    // Prepare SQL statement untuk update quantity
    $sql = "UPDATE order_list_items SET quantity = $newQuantity WHERE id = $productId";
    echo "SQL Query: " . $sql . "\n";

    // Eksekusi statement
    if (mysqli_query($conn, $sql)) {
        echo "Quantity updated successfully";
    } else {
        echo "Error updating quantity: " . mysqli_error($conn);
    }

    // Tutup koneksi
    mysqli_close($conn);
    echo "Database connection closed.\n";
}
