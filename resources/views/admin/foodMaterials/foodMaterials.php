<?php require_once __DIR__ . "/../../../models/food_materials.php"; ?>


<?php
if (isset($_GET['edit_id'])) {
    $id = $_GET['edit_id'];
    $query = "SELECT * FROM food__materials WHERE id = '$id'";
    $result = mysqli_query($db_conn, $query);
    $row = mysqli_fetch_assoc($result); // Fetch a single row
    // echo $row['id'];
}

?>




<div class="d-flex justify-content-between" style="height: 200px;background-color: #357CA5;">
    <h3 class="p-4 text-light">New Foods</h3>
</div>

<div class="row g-0 d-flex justify-content-evenly" style="margin-top: -110px;">
    <div class=" col-sm-12 col-md-11 bg-white shadow-sm rounded pb-3  " style="overflow: hidden;min-height: 60vh;">


        <div class="row px-4  border-bottom border-2 d-flex justify-content-between">
            <div class="col-1">
                <h4 class="py-4 fs-6 m-0 fw-semibold">Data</h4>
            </div>
            <div class=" col-2 d-flex justify-content-end align-items-center">
                <a href="#" onclick="refreshPage()" class=" btn  btn-primary" data-bs-toggle="modal" data-bs-target="#modaldemo9">Create New </a>
            </div>


        </div>

        <div class="row px-4">
            <div class="col-12">
                <table class="table table-bordered mb-2 w-100" id="example3">
                    <thead>
                        <th class="fw-semibold text-center align-middle">No</th>
                        <th class="fw-semibold text-center align-middle">Name Material</th>
                        <th class="fw-semibold text-center align-middle">Stok</th>

                        <th class="fw-semibold text-center align-middle">Note</th>
                        <th class="fw-semibold text-center align-middle">Action</th>

                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($food_materials as $food_material) : ?>
                            <tr>
                                <td class="text-center align-middle"><?= $i; ?></td>
                                <td class="text-center align-middle"><?= $food_material['name_material']; ?></td>
                                <td class="text-center align-middle"><?= $food_material['stock']; ?></td>



                                <td class="text-center align-middle">
                                    <?php echo $food_material['note_material'] && $food_material['note_material'] != '' ? $food_material['note_material'] : '-'; ?>
                                </td>

                                <td class="align-middle">
                                    <div class="d-flex justify-content-center">
                                        <form action="" method="get" class="me-1">
                                            <input type="hidden" name="q" value="food-materials">
                                            <input type="hidden" name="edit_id" value="<?= $food_material['id']; ?>">
                                            <button type="submit" class="btn btn-success">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                        </form>

                                        <form action="./../../models/delete_food_material.php" method="post" id="delete_form_<?= $food_material['id'] ?>" class="me-1">
                                            <input type="hidden" name="delete_id" value="<?= $food_material['id'] ?>">
                                            <button type="button" class="btn btn-danger" onclick="confirmDelete(<?= $food_material['id'] ?>)">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>


                                        <!-- Sweetalert Confirm -->
                                        <script>
                                            // Function to show SweetAlert confirmation
                                            function confirmDelete(food_material) {
                                                Swal.fire({
                                                    title: 'Apakah Anda yakin?',
                                                    text: "Anda tidak akan dapat mengembalikan ini!",
                                                    icon: 'warning',
                                                    showCancelButton: true,
                                                    confirmButtonColor: '#d33',
                                                    cancelButtonColor: '#3085d6',
                                                    confirmButtonText: 'Ya, hapus!',
                                                    cancelButtonText: 'Batal'
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        // Jika dikonfirmasi, submit form untuk menghapus kategori
                                                        document.querySelector(`#delete_form_${food_material}`).submit();
                                                    }
                                                });
                                            }
                                        </script>

                                        <!-- End Sweetalert -->
                                    </div>




                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- <div class="row px-4">
            <div class="offset-10 col-2">
                <div class="" id="table-1_paginate">
                    <ul class="pagination">
                        <li class="paginate_button page-item previous " id="table-1_previous"><a href="#" aria-controls="table-1" data-dt-idx="0" tabindex="0" class="page-link bg-white text-dark">Previous</a></li>
                        <li class="paginate_button page-item active"><a href="#" aria-controls="table-1" data-dt-idx="1" tabindex="0" class="page-link ">1</a></li>
                        <li class="paginate_button page-item next " id="table-1_next"><a href="#" aria-controls="table-1" data-dt-idx="2" tabindex="0" class="page-link bg-white text-dark">Next</a></li>
                    </ul>
                </div>
            </div>
        </div> -->
    </div>
</div>






<!-- MODAL TAMBAH -->
<div class="modal fade" data-bs-backdrop="static" id="modaldemo9">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo p-3">
            <div class="modal-header">
                <h6 class="modal-title">Create Food Material</h6>
                <button onclick="reset()" aria-label="Close" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <form action="./../../models/create_food_material.php" method="post">
                            <div class="form-group">
                                <label for="name_food_material" class="form-label" style="font-size: 14px;">Name Food Material <span class="text-danger">*</span></label>
                                <input type="text" name="name_food_material" class="form-control mb-2 w-100" required>
                            </div>
                            <div class="form-group">
                                <label for="stok" class="form-label" style="font-size: 14px;">Stok <span class="text-danger">*</span></label>
                                <input type="text" name="stok" class="form-control mb-2 w-100" required>
                            </div>
                            <div class="form-group">

                                <div>
                                    <label for="note_material" class="form-label" style="font-size: 14px;">note_material <span class="text-danger">*</span></label>
                                </div>
                                <textarea class="form-control" name="note_material" placeholder="" id="note_material" style="height: 100px"></textarea>
                            </div>


                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary">Save</button>
                <button type="reset" class="btn btn-danger">Reset</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL TAMBAH -->


<!-- MODAL TAMBAH EDIT -->
<div class="modal fade" data-bs-backdrop="static" id="modaldemoedit">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo p-3">
            <div class="modal-header">
                <h6 class="modal-title">Update Food Material</h6>
                <button onclick="removeQueryParam()" aria-label="Close" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <form action="./../../models/update_food_material.php" method="post">
                            <div class="form-group">
                                <input type="hidden" name="update_id" value="<?php echo isset($row['id']) ? $row['id'] : ''; ?>">
                                <label for="name_food_material" class="form-label" style="font-size: 14px;">Name Category <span class="text-danger">*</span></label>
                                <input type="text" name="name_food_material" class="form-control mb-2 w-100" value="<?php echo isset($row['name_material']) ? $row['name_material'] : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="stok" class="form-label" style="font-size: 14px;">Stok <span class="text-danger">*</span></label>
                                <input type="text" name="stok" class="form-control mb-2 w-100" value="<?php echo isset($row['stock']) ? $row['stock'] : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <div>
                                    <label for="note_material" class="form-label" style="font-size: 14px;">Note <span class="text-danger">*</span></label>
                                </div>
                                <textarea class="form-control" name="note_material" placeholder="" id="note_material" style="height: 100px"><?php echo isset($row['note_material']) ? $row['note_material'] : ''; ?></textarea>
                            </div>


                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary">Save</button>
                <button type="reset" class="btn btn-danger">Reset</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL TAMBAH -->

<?php
// Include config.php or session start code here
// ...

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

<script>
    function removeQueryParam() {
        const url = new URL(window.location);
        url.searchParams.delete('edit_id');
        window.history.replaceState({}, document.title, url);
    }
</script>


<script>
    function checkForEditIdAndShowModal() {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('edit_id')) {
            const myModal = new bootstrap.Modal(document.getElementById('modaldemoedit'));
            myModal.show();
        }
    }
    // Run the function when the DOM is fully loaded
    document.addEventListener('DOMContentLoaded', checkForEditIdAndShowModal);
</script>