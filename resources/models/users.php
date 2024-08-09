<?php
require_once __DIR__ . '../../config/config.php';

if (isset($_POST['logout'])) {
  // Unset all session variables
  session_unset();

  // Destroy the session

  session_destroy();

  echo "<script type='text/javascript'>
            window.location.href = '" . URL . "/views/login/login.php';
          </script>";


  exit;
}

$sql_role = "SELECT * FROM roles ";
$result_roles = mysqli_query($db_conn, $sql_role);
$c_roles = mysqli_fetch_all($result_roles, MYSQLI_ASSOC);
