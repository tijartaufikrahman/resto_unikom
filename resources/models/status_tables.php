<?php
require_once __DIR__ . '../../config/config.php';

// Query tables_empty
if (isset($_POST['number_of_customers'])) {
    $number_of_customers = $_POST['number_of_customers'];
    // var_dump($number_of_customers);
    $query_tables_empty = "SELECT * FROM status_tables WHERE maximum_seats >= $number_of_customers AND occupied = 'false' ORDER BY table_number ASC;";
    $result2 = mysqli_query($db_conn, $query_tables_empty);
    $tables_empty = mysqli_fetch_all($result2, MYSQLI_ASSOC);

    // var_dump($tables_empty);
}
// End Query tables_empty

// Reset
if (isset($_POST['reset'])) {
    $query_reset = "UPDATE status_tables SET occupied = 0;";
    mysqli_query($db_conn, $query_reset);
    unset($_POST['reset']);
    header('Location: ' . URL . '/views/admin/index.php?q=find-table-and-seats');
    exit;
}
// End Reset

// Add Table 
if (isset($_POST['table_id'])) {
    $id = $_POST['table_id'];

    $query_add_table = "UPDATE status_tables SET occupied = 1 WHERE id = $id;";
    mysqli_query($db_conn, $query_add_table);
    header('Location: ' . URL . '/views/admin/index.php?q=find-table-and-seats');
    exit;
}
// End Add Table

// Clear_the_table 
if (isset($_POST['clear_the_table'])) {
    $id = $_POST['clear_the_table'];
    $query_clear_the_table = "UPDATE status_tables SET occupied = 0 WHERE id = $id;";
    mysqli_query($db_conn, $query_clear_the_table);
    header('Location: ' . URL . '/views/admin/index.php?q=find-table-and-seats');
    exit;
}
// End Clear_the_table

// Get all tables
$query = "SELECT * FROM status_tables ORDER BY table_number;";
$result = mysqli_query($db_conn, $query);
$tables = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // var_dump($tables);
// EndGet all tables
