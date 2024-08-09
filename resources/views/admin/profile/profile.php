<div class="d-flex justify-content-between" style="height: 200px;background-color: #357CA5;">
    <h3 class="p-4 text-light">Profile</h3>
</div>

<?php


require_once __DIR__ . '../../../../config/config.php';
$id_user = $_SESSION['id'];
// $query_profile = "SELECT * FROM users WHERE id = '$id_user'";
$query_profile = "SELECT users.id,users.name,users.email,users.username,users.password,roles.id,roles.role_name
FROM 
users
JOIN 
roles
ON 
users.role_id = roles.id WHERE users.id = '$id_user'";
$row = mysqli_query($db_conn, $query_profile);
$result = mysqli_fetch_assoc($row);

// var_dump($result);


?>


<div class="row g-0 px-5" style="margin-top: -110px;">
    <div class="col-12 pb-3 mb-5">
        <div class="row bg-white p-4 shadow-sm rounded mb-5" style="overflow: hidden;min-height: 10vh;">
            <div class="col-5 mb-5">
                <form action="./../../models/update_profile.php" method="post">
                    <input type="hidden" class="form-control" id="id_users" name="id_users" aria-describedby="emailHelp" value="<?= $_SESSION['id']; ?>">
                    <div class="mb-3">
                        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" aria-describedby="emailHelp" value="<?= $result['name']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Divisi</label>
                        <input type="text" class="form-control " disabled id="roles" value="<?= $result['role_name']; ?>">
                        <input type="hidden" class="form-control " id="roles" name="divisi" value="<?= $result['id']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?= $result['username']; ?>">
                    </div>
                    <!-- <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div> -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="<?= $result['email']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="text" class="form-control" id="password" name="password" value="<?= $result['password']; ?>">
                    </div>

                    <button type="submit" name="update_profile" class="btn btn-info text-white">Simpan</button>
                </form>
            </div>

            <div class="offset-1 col-3 mt-4">
                <!-- <img src="https://picsum.photos/200/200" width="200" alt="" class="img-fluid rounded"> -->
                <img src="./../../../public/img/user.png" width="200" alt="" class="img-fluid rounded">
            </div>
        </div>
    </div>
</div>



<?php
// Check if alert is set in session
if (isset($_SESSION['alert'])) {
?>
    <script>
        Swal.fire({
            icon: '<?php echo $_SESSION['alert']['type']; ?>',
            title: 'Alert!',
            text: '<?php echo $_SESSION['alert']['message']; ?>',
            showConfirmButton: false,
            timer: 1500
        });
    </script>
<?php
    // Unset the session alert after displaying it
    unset($_SESSION['alert']);
}
?>