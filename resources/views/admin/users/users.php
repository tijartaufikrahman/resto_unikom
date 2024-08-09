<?php require_once __DIR__ . "/../../../models/users_admin.php"; ?>
<?php require_once __DIR__ . "/../../../models/delete_users.php"; ?>
<style>
    .accordion-button:not(.collapsed) {
        background-color: #fff;
    }
</style>





<div class="" style="height: 200px;background-color: #357CA5;">
    <h3 class="p-4 text-light">User Data</h3>
</div>

<div class="row g-0 px-5">

    <div class=" col-12 bg-white shadow-sm rounded mb-4" style="overflow: hidden;margin-top: -15vh;">
        <div class=" bg-light">
            <h5 class="p-3 text-dark-emphasis fw-normal">User Data</h5>
            <div class="row bg-white ">

                <div class="col-3 mt-3  text-white d-flex" style="min-height: 200px">
                    <div class="div">
                        <div class="bg-info mb-3  ms-3 text-center rounded d-flex justify-content-center align-items-center" style="width: 6rem;height:6rem;">
                            <div>
                                <i class="fa solid fa-user mt-3" style="font-size: 25px;"></i>
                                <h5><?php echo isset($roleAdmin) ? count($roleAdmin) : ''; ?></h5>
                                <h6 class="  fw-normal">Administrator</h6>
                            </div>
                        </div>
                        <div class="bg-warning mb-3 ms-3 text-center rounded d-flex justify-content-center align-items-center" style="width: 6rem;height:6rem;">
                            <div>
                                <i class="fa solid fa-user mt-3" style="font-size: 25px;"></i>
                                <h5><?php echo isset($roleWaiter) ? count($roleWaiter) : ''; ?></h5>
                                <h6 class="  fw-normal">Waiters</h6>
                            </div>
                        </div>
                        <div class="bg-dark mb-3 ms-3 text-center rounded d-flex justify-content-center align-items-center" style="width: 6rem;height:6rem;">
                            <div>
                                <i class="fa solid fa-user mt-3" style="font-size: 25px;"></i>
                                <h5>Empty</h5>
                                <h6 class="  fw-normal">Empty</h6>
                            </div>
                        </div>
                    </div>

                    <div class="">
                        <div class="bg-success mb-3 ms-3  text-center rounded d-flex justify-content-center align-items-center" style="width: 6rem;height:6rem;">
                            <div>
                                <i class="fa solid fa-user mt-3" style="font-size: 25px;"></i>
                                <h5><?php echo isset($roleCashier) ? count($roleCashier) : ''; ?></h5>
                                <h6 class="  fw-normal">Kasir</h6>
                            </div>
                        </div>
                        <div class="bg-danger mb-3 ms-3 text-center rounded d-flex justify-content-center align-items-center" style="width: 6rem;height:6rem;">
                            <div>
                                <i class="fa solid fa-user mt-3" style="font-size: 25px;"></i>
                                <h5><?php echo isset($roleChef) ? count($roleChef) : ''; ?></h5>
                                <h6 class="  fw-normal">Chef</h6>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col mt-3 ">
                    <div class="row">
                        <div class="col-10 d-flex justify-content-between">
                            <div class="">
                                <a href="#" class="btn  text-white" data-bs-toggle="modal" data-bs-target="#modaldemo8" style="background-color:#357CA5;">Create New User</a>
                            </div>
                            <!-- <div class="">
                                <form action="" method="GET" class="input-group  pt-0 pb-0">
                                    <input type="hidden" name="q" value="users">
                                    <input type="text" class="form-control" name="search_users" placeholder="Search" aria-label="Search">
                                    <div class="input-group-append">
                                        <button type="submit" class="input-group-text text-white rounded-0 rounded-end px-4 fs-5" style="background-color: #357CA5; padding: 10px 0;">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div> -->
                        </div>
                        <div class="col-10">
                            <?php if (isset($_GET['search_users']) && $_GET['search_users'] != '') : ?>
                                <div class="w-100 h-100 d-flex align-items-center justify-content-center p-5">
                                    <h4 class="text-center fw-semibold text-body-secondary">Search "<?= $_GET['search_users']; ?>"</h4>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="col-10 mb-5 border-0 shadow-none p-0">
                            <div class="accordion " id="accordionExample">
                                <div class="accordion-item border-0 border-0 border-0 border-0">
                                    <h1 class=" fs-4 accordion-button m-0  fw-semibold text-body-secondary" data-bs-toggle="collapse" data-bs-target="#collapseOneAdministrator" aria-expanded="true" aria-controls="collapseOneAdministrator" style="cursor: pointer;">- Administrator -</h1>
                                    <div id="collapseOneAdministrator" class=" show" data-bs-parent="#accordionExample">
                                        <div class="">
                                            <?php if (isset($roleAdmin) && count($roleAdmin) > 0) : ?>
                                                <table class="  table m-0  table-bordered " id="users1">
                                                    <!-- <colgroup>
                                                        <col style="width: 5%">
                                                        <col style="width: 35%">
                                                        <col style="width: 35%">
                                                        <col style="width: 12.5%">
                                                        <col style="width: 12.5%">
                                                    </colgroup> -->
                                                    <thead>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Name</th>
                                                            <th>Username</th>
                                                            <th>Email</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if (isset($roleAdmin)) : ?>
                                                            <?php $i = 1; ?>
                                                            <?php foreach ($roleAdmin as $admin) : ?>
                                                                <tr>
                                                                    <td><?= $i; ?></td>
                                                                    <td><?= $admin['name']; ?></td>
                                                                    <td><?= $admin['username']; ?></td>
                                                                    <td><?= $admin['email']; ?></td>
                                                                    <td>
                                                                        <div class="d-flex justify-content-center">
                                                                            <form action="" method="get" class="me-1 ">
                                                                                <input type="hidden" name="q" value="users">
                                                                                <input type="hidden" name="id_delete" value="<?= $admin['id'] ?>">
                                                                                <button type="submit" class="btn btn-danger delete-button" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">
                                                                                    <i class="bi bi-trash"></i>
                                                                                </button>
                                                                            </form>
                                                                            <!-- <form action="" method="get"> -->
                                                                            <!-- <input type="hidden" name="id_users" value="<?= $admin['id'] ?>"> -->
                                                                            <!-- <button type="button" class="btn btn-success delete-button"> -->
                                                                            <!-- <i class="bi bi-pencil"></i> -->
                                                                            <!-- </button> -->
                                                                            <!-- </form> -->
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <?php $i++; ?>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </tbody>
                                                </table>
                                            <?php else : ?>
                                                <p class="text-center">No cashier orders found.</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-10 mb-5 border-0 shadow-none p-0">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item border-0 border-0 border-0">
                                    <h1 class=" fs-4 accordion-button m-0  fw-semibold text-body-secondary" data-bs-toggle="collapse" data-bs-target="#collapseOneWaiter" aria-expanded="true" aria-controls="collapseOneWaiter" style="cursor: pointer;">- Waiter -</h1>
                                    <div id="collapseOneWaiter" class=" show" data-bs-parent="#accordionExample">
                                        <div class="">
                                            <?php if (isset($roleWaiter) && count($roleWaiter) > 0) : ?>
                                                <table class="  table m-0  table-bordered " id="users2">
                                                    <!-- <colgroup>
                                                        <col style="width: 5%">
                                                        <col style="width: 35%">
                                                        <col style="width: 35%">
                                                        <col style="width: 12.5%">
                                                        <col style="width: 12.5%">
                                                    </colgroup> -->
                                                    <thead>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Name</th>
                                                            <th>Username</th>
                                                            <th>Email</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if (isset($roleWaiter)) : ?>
                                                            <?php $i = 1; ?>
                                                            <?php foreach ($roleWaiter as $waiter) : ?>
                                                                <tr>
                                                                    <td><?= $i; ?></td>
                                                                    <td><?= $waiter['name']; ?></td>
                                                                    <td><?= $waiter['username']; ?></td>
                                                                    <td><?= $waiter['email']; ?></td>

                                                                    <td>
                                                                        <div class="d-flex justify-content-center">
                                                                            <form action="" method="get" class="me-1 ">
                                                                                <input type="hidden" name="q" value="users">
                                                                                <input type="hidden" name="id_delete" value="<?= $waiter['id'] ?>">
                                                                                <button type="submit" class="btn btn-danger delete-button" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">
                                                                                    <i class="bi bi-trash"></i>
                                                                                </button>
                                                                            </form>
                                                                            <!-- <form action="" method="get"> -->
                                                                            <!-- <input type="hidden" name="id_users" value="<?= $waiter['id'] ?>"> -->
                                                                            <!-- <button type="button" class="btn btn-success delete-button"> -->
                                                                            <!-- <i class="bi bi-pencil"></i> -->
                                                                            <!-- </button> -->
                                                                            <!-- </form> -->
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <?php $i++; ?>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </tbody>
                                                </table>
                                            <?php else : ?>
                                                <p class="text-center">No cashier orders found.</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-10 mb-5 border-0 shadow-none p-0 shadow-sm">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item border-0 border-0">
                                    <h1 class=" fs-4 accordion-button m-0  fw-semibold text-body-secondary" data-bs-toggle="collapse" data-bs-target="#collapseOneCashier" aria-expanded="true" aria-controls="collapseOneCashier" style="cursor: pointer;">- Cashier -</h1>
                                    <div id="collapseOneCashier" class=" show" data-bs-parent="#accordionExample">
                                        <div class="">

                                            <?php if (isset($roleCashier) && count($roleCashier) > 0) : ?>
                                                <table class="  table m-0  table-bordered " id="users3">
                                                    <!-- <colgroup>
                                                        <col style="width: 5%">
                                                        <col style="width: 35%">
                                                        <col style="width: 35%">
                                                        <col style="width: 12.5%">
                                                        <col style="width: 12.5%">
                                                    </colgroup> -->
                                                    <thead>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Name</th>
                                                            <th>Username</th>
                                                            <th>Email</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if (isset($roleCashier)) : ?>
                                                            <?php $i = 1; ?>
                                                            <?php foreach ($roleCashier as $cashier) : ?>
                                                                <tr>
                                                                    <td><?= $i; ?></td>
                                                                    <td><?= $cashier['name']; ?></td>
                                                                    <td><?= $cashier['username']; ?></td>
                                                                    <td><?= $cashier['email']; ?></td>

                                                                    <td>
                                                                        <div class="d-flex justify-content-center">
                                                                            <form action="" method="get" class="me-1 ">
                                                                                <input type="hidden" name="q" value="users">
                                                                                <input type="hidden" name="id_delete" value="<?= $cashier['id'] ?>">
                                                                                <button type="submit" class="btn btn-danger delete-button" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">
                                                                                    <i class="bi bi-trash"></i>
                                                                                </button>
                                                                            </form>
                                                                            <!-- <form action="" method="get"> -->
                                                                            <!-- <input type="hidden" name="id_users" value="<?= $cashier['id'] ?>"> -->
                                                                            <!-- <button type="button" class="btn btn-success delete-button"> -->
                                                                            <!-- <i class="bi bi-pencil"></i> -->
                                                                            <!-- </button> -->
                                                                            <!-- </form> -->
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <?php $i++; ?>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </tbody>
                                                </table>
                                            <?php else : ?>
                                                <p class="text-center">No cashier orders found.</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-10 mb-5 border-0 shadow-none p-0">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item border-0">
                                    <h1 class=" fs-4 accordion-button m-0  fw-semibold text-body-secondary" data-bs-toggle="collapse" data-bs-target="#collapseOneChef" aria-expanded="true" aria-controls="collapseOneChef" style="cursor: pointer;">- Chef -</h1>
                                    <div id="collapseOneChef" class=" show" data-bs-parent="#accordionExample">
                                        <div class="">
                                            <?php if (isset($roleChef) && count($roleChef) > 0) : ?>
                                                <table class="  table m-0  table-bordered" id="users4">
                                                    <!-- <colgroup>
                                                        <col style="width: 5%">
                                                        <col style="width: 35%">
                                                        <col style="width: 35%">
                                                        <col style="width: 12.5%">
                                                        <col style="width: 12.5%">
                                                    </colgroup> -->
                                                    <thead>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Name</th>
                                                            <th>Username</th>
                                                            <th>Email</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if (isset($roleChef)) : ?>
                                                            <?php $i = 1; ?>
                                                            <?php foreach ($roleChef as $chef) : ?>
                                                                <tr>
                                                                    <td><?= $i; ?></td>
                                                                    <td><?= $chef['name']; ?></td>
                                                                    <td><?= $chef['username']; ?></td>
                                                                    <td><?= $chef['email']; ?></td>

                                                                    <td>
                                                                        <div class="d-flex justify-content-center">
                                                                            <form action="" method="get" class="me-1 ">
                                                                                <input type="hidden" name="q" value="users">
                                                                                <input type="hidden" name="id_delete" value="<?= $chef['id'] ?>">
                                                                                <button type="submit" class="btn btn-danger delete-button" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">
                                                                                    <i class="bi bi-trash"></i>
                                                                                </button>
                                                                            </form>
                                                                            <!-- <form action="" method="get"> -->
                                                                            <!-- <input type="hidden" name="id_users" value="<?= $chef['id'] ?>"> -->
                                                                            <!-- <button type="button" class="btn btn-success delete-button"> -->
                                                                            <!-- <i class="bi bi-pencil"></i> -->
                                                                            <!-- </button> -->
                                                                            <!-- </form> -->
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <?php $i++; ?>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </tbody>
                                                </table>
                                            <?php else : ?>
                                                <p class="text-center">No users chef found.</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>




            </div>
        </div>

    </div>




    <!-- Modal  -->
    <div class="modal fade" data-bs-backdrop="static" id="modaldemo8">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo p-3">
                <div class="modal-header">
                    <h6 class="modal-title">Create New User</h6>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="./../../models/create_user.php" method="post">
                                <div class="form-group">
                                    <label for="name" class="form-label" style="font-size: 14px;">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control mb-2" required>
                                </div>
                                <div class="form-group">
                                    <label for="username" class="form-label" style="font-size: 14px;">Username <span class="text-danger">*</span></label>
                                    <input type="text" name="username" class="form-control mb-2" required>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="form-label" style="font-size: 14px;">Email <span class="text-danger">*</span></label>
                                    <input type="text" name="email" class="form-control mb-2" required>
                                </div>
                                <div class="form-group">
                                    <label for="category" class="form-label" style="font-size: 14px;" required>Role</label>
                                    <select name="role" class="form-control" required>
                                        <option value="">-- Choose --</option>
                                        <?php foreach ($c_roles as $r) : ?>
                                            <option value="<?= $r['id'] ?>">
                                                <?= $r['role_name']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>

                                </div>
                                <div class="form-group mt-2">
                                    <label for="password" class="form-label" style="font-size: 14px;">Password <span class="text-danger">*</span></label>
                                    <input type="text" name="password" class="form-control mb-2" required>
                                </div>
                        </div>
                        <!-- <div class="col-md-5">
                            <label for="title" class="form-label" style="font-size: 14px;">Image <span class="text-danger"> * </span></label>
                            <div class="form-group">
                                <center>
                                    <img width="200px" height="200px" alt="profile-user" id="outputImg" class="img-preview img-fluid rounded" style="display: none;">
                                </center>
                                <input class="form-control mt-3" id="image" name="image" type="file" onchange="previewImage()">
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="create_user" class="btn btn-primary">Save</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ENd Modal  -->




    <?php if (isset($_SESSION['alert'])) { ?>
        <script>
            Swal.fire({
                icon: '<?php echo $_SESSION['alert']['type']; ?>',
                title: 'Alert!',
                text: '<?php echo $_SESSION['alert']['message']; ?>',
                showConfirmButton: false,
                timer: 3000
            });
        </script>
    <?php unset($_SESSION['alert']);
    } ?>