<?php
require_once __DIR__ . '../../config/config.php';


if (isset($_GET['id_delete'])) {
    $id = $_GET['id_delete'];

    $sql = "DELETE FROM `users` WHERE `id` = '$id'";

    // Lakukan query
    if (mysqli_query($db_conn, $sql)) {
        // Jika berhasil, set session success
        $_SESSION['alert'] = array(
            'type' => 'success',
            'message' => 'User delete successfully.'
        );
    } else {
        // Jika terjadi kesalahan saat query, set session error
        $_SESSION['alert'] = array(
            'type' => 'error',
            'message' => 'Failed to User delete.'
        );
    }
    echo '<script type="text/javascript">
        window.location.href = "' . URL . '/views/admin/index.php?q=users";
      </script>';

    exit;
}
