<?php
require_once __DIR__ . '../../config/config.php';


if (empty($_GET['search_users'])) {
    $query_users_admin = "SELECT users.id, users.name, users.username, users.email,users.role_id, roles.role_name FROM users
    JOIN roles ON users.role_id = roles.id WHERE  roles.role_name = 'administrator';";
    $resultAdmin = mysqli_query($db_conn, $query_users_admin);
    $roleAdmin = mysqli_fetch_all($resultAdmin, MYSQLI_ASSOC);

    $query_users_waiter = "SELECT users.id, users.name, users.username, users.email,users.role_id, roles.role_name FROM users
    JOIN roles ON users.role_id = roles.id WHERE  roles.role_name = 'waiter';";
    $resultWaiter = mysqli_query($db_conn, $query_users_waiter);
    $roleWaiter = mysqli_fetch_all($resultWaiter, MYSQLI_ASSOC);

    $query_users_chef = "SELECT users.id, users.name, users.username, users.email,users.role_id, roles.role_name FROM users
    JOIN roles ON users.role_id = roles.id WHERE  roles.role_name = 'chef';";
    $resultChef = mysqli_query($db_conn, $query_users_chef);
    $roleChef = mysqli_fetch_all($resultChef, MYSQLI_ASSOC);

    $query_users_cashier = "SELECT users.id, users.name, users.username, users.email,users.role_id, roles.role_name FROM users
    JOIN roles ON users.role_id = roles.id WHERE  roles.role_name = 'cashier';";
    $resultCashier = mysqli_query($db_conn, $query_users_cashier);
    $roleCashier = mysqli_fetch_all($resultCashier, MYSQLI_ASSOC);
} else {

    $search = $_GET['search_users'];

    $query_users_admin = "SELECT users.id, users.name, users.username, users.email,users.role_id, roles.role_name FROM users
JOIN roles ON users.role_id = roles.id WHERE  roles.role_name = 'administrator' AND users.name LIKE '%$search%';";
    $resultAdmin = mysqli_query($db_conn, $query_users_admin);
    $roleAdmin = mysqli_fetch_all($resultAdmin, MYSQLI_ASSOC);

    $query_users_waiter = "SELECT users.id, users.name, users.username, users.email,users.role_id, roles.role_name FROM users
JOIN roles ON users.role_id = roles.id WHERE  roles.role_name = 'waiter' AND users.name LIKE '%$search%';";
    $resultWaiter = mysqli_query($db_conn, $query_users_waiter);
    $roleWaiter = mysqli_fetch_all($resultWaiter, MYSQLI_ASSOC);

    $query_users_chef = "SELECT users.id, users.name, users.username, users.email,users.role_id, roles.role_name FROM users
JOIN roles ON users.role_id = roles.id WHERE  roles.role_name = 'chef' AND users.name LIKE '%$search%';";
    $resultChef = mysqli_query($db_conn, $query_users_chef);
    $roleChef = mysqli_fetch_all($resultChef, MYSQLI_ASSOC);

    $query_users_cashier = "SELECT users.id, users.name, users.username, users.email,users.role_id, roles.role_name FROM users
JOIN roles ON users.role_id = roles.id WHERE  roles.role_name = 'cashier' AND users.name LIKE '%$search%';";
    $resultCashier = mysqli_query($db_conn, $query_users_cashier);
    $roleCashier = mysqli_fetch_all($resultCashier, MYSQLI_ASSOC);
}


// Count the number of administrators
// $totalAdmins = count($roleAdmin);
// Output the total number of administrators
// echo "Total number of administrators: " . $totalAdmins;
