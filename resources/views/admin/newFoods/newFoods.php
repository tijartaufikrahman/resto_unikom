<?php require_once __DIR__ . "/../../../models/foods.php"; ?>
<?php require_once __DIR__ . '../../../../config/config.php'; ?>
<style>
    .sold-out-overlay {
        position: relative;
    }

    .sold-out-overlay::before {
        content: "Out of Stock";
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: rgb(173, 87, 96);
        color: white;
        /* padding: .6em .4em; */
        border-radius: 0.25em;
        text-align: center;
        z-index: 20;
        font-weight: 500;
        opacity: 0.70;
    }
</style>

<div class="d-flex justify-content-between" style="height: 200px;background-color: #357CA5;">
    <h3 class="p-4 text-light">Foods</h3>
</div>

<div class="row g-0 d-flex justify-content-evenly" style="margin-top: -110px;">
    <div class="col-sm-12 col-md-11 bg-white shadow-sm rounded pb-3 mb-5" style="overflow: hidden;min-height: 60vh;">
        <div class="row px-4 border-bottom border-2 d-flex justify-content-between">
            <div class="col-1">
                <h4 class="py-4 fs-6 m-0 fw-semibold">Data</h4>
            </div>
            <div class="col-2 d-flex justify-content-end align-items-center">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modaldemo8">Create New Food</a>
            </div>
        </div>

        <div class="row px-4">
            <div class="col-12">
                <table class="table table-bordered w-100" id="example">
                    <thead>
                        <th class="fw-semibold text-center align-middle">No</th>
                        <th class="fw-semibold text-center align-middle">Image</th>
                        <th class="fw-semibold text-center align-middle">Name Food</th>
                        <th class="fw-semibold text-center align-middle">Price</th>
                        <th class="fw-semibold text-center align-middle">Category</th>
                        <th class="fw-semibold text-center align-middle">Action</th>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($foods as $food) : ?>
                            <tr>
                                <td class="text-center align-middle"><?= $i; ?></td>
                                <td class="text-center align-middle">
                                    <button type="button" class="btn btn-white" data-bs-toggle="modal" data-bs-target="#<?= $food['id'] . 'mkunik' ?>">
                                        <img src="./../../../public/img/<?= $food['image']; ?>" width="60px" height="50px" alt="profile-user" id="outputImg" class="rounded">
                                    </button>
                                </td>
                                <td class=""><?= $food['name_product']; ?></td>
                                <td class="">Rp <?= $food['price']; ?></td>
                                <td class=""><?= $food['name_category']; ?></td>
                                <td class="align-middle">
                                    <div class="d-flex justify-content-center">
                                        <form action="" class="me-1">
                                            <input type="hidden" name="edit_id" value="<?= $food['id'] ?>">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#<?= $food['id'] ?>">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                        </form>

                                        <form action="./../../models/delete_food.php" method="post" id="delete_form_<?= $food['id'] ?>" class="me-1">
                                            <input type="hidden" name="delete_id" value="<?= $food['id'] ?>">
                                            <button type="button" class="btn btn-danger" onclick="confirmDelete(<?= $food['id'] ?>)">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>

                                        <script>
                                            function confirmDelete(foodId) {
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
                                                        document.querySelector(`#delete_form_${foodId}`).submit();
                                                    }
                                                });
                                            }
                                        </script>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal Update -->
                            <div class="modal fade" data-bs-backdrop="static" id="<?= $food['id']; ?>">
                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                    <div class="modal-content modal-content-demo p-3">
                                        <div class="modal-header">
                                            <h6 class="modal-title">Update Food</h6>
                                            <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">

                                            <form id="updateForm<?= $food['id']; ?>" action="./../../models/update_food.php" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="edit_id" value="<?= $food['id'] ?>">
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <label for="name_product" class="form-label" style="font-size: 14px;">Name Product <span class="text-danger">*</span></label>
                                                            <input type="text" name="name_product" class="form-control mb-2" value="<?= isset($food['name_product']) ? $food['name_product'] : '' ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="category" class="form-label" style="font-size: 14px;">Category</label>
                                                            <select name="category" class="form-control" required>
                                                                <option value="">-- Choose --</option>
                                                                <?php foreach ($categories as $row) : ?>
                                                                    <option value="<?= $row['id'] ?>" <?= ($row['id'] == $food['category_id']) ? 'selected' : '' ?>>
                                                                        <?= $row['name_category']; ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="harga" class="form-label" style="font-size: 14px;">Price <span class="text-danger">*</span></label>
                                                            <input type="text" name="harga" class="form-control mb-2" value="<?= isset($food['price']) ? $food['price'] : '' ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="status" class="form-label" style="font-size: 14px;">Status <span class="text-danger">*</span></label>
                                                            <select name="status" class="form-control mb-2" required>
                                                                <option value="99" <?= ($food['stok'] > 0) ? 'selected' : '' ?>>Ready</option>
                                                                <option value="0" <?= ($food['stok'] <= 0) ? 'selected' : '' ?>>Out Of Stock</option>
                                                            </select>
                                                        </div>

                                                        <?php
                                                        $id_p = $food['id'];
                                                        $query_bahan_product = "SELECT pm.id_product, pm.id_material, pm.qty, p.name_product, fm.id, fm.name_material 
                                                    FROM product_materials pm 
                                                    JOIN products p ON pm.id_product = p.id 
                                                    JOIN food__materials fm ON pm.id_material = fm.id 
                                                    WHERE pm.id_product = '$id_p'";
                                                        $result_bhq = mysqli_query($db_conn, $query_bahan_product);
                                                        $data = mysqli_fetch_all($result_bhq, MYSQLI_ASSOC);
                                                        ?>

                                                        <div id="ingredientsContainer<?= $food['id']; ?>" class="form-group">
                                                            <?php foreach ($data as $index => $ingredient) : ?>
                                                                <div class="ingredient-group" id="ingredient-<?= $index; ?>">
                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <label for="" class="form-label">Bahan Baku:</label>
                                                                            <select name="ingredients2[]" class="form-control" required>
                                                                                <option value="">-- Choose --</option>
                                                                                <?php foreach ($bahan_baku as $bb) : ?>
                                                                                    <option value="<?= $bb['id'] ?>" <?= ($bb['id'] == $ingredient['id_material']) ? 'selected' : '' ?>>
                                                                                        <?= $bb['name_material']; ?>
                                                                                    </option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-4">
                                                                            <label for="" class="form-label">Qty:</label>
                                                                            <input type="text" name="qty2[]" class="form-control mb-2" value="<?= $ingredient['qty'] ?>" required>
                                                                        </div>
                                                                        <div class="col-2">
                                                                            <label for="" class="form-label">`</label>
                                                                            <button type="button" class="btn btn-danger btn-remove" data-index="<?= $index; ?>" onclick="removeIngredient(this)"><i class="bi bi-trash"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        </div>

                                                        <button type="button" class="mt-2 btn btn-primary" onclick="addIngredient_update(<?= $food['id']; ?>)"><i class="fas fa-plus"></i> Tambah Bahan Baku</button>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <label for="title" class="form-label" style="font-size: 14px;">Image <span class="text-danger"> * </span></label>
                                                        <div class="form-group">
                                                            <center>
                                                                <?php if (isset($food['image'])) : ?>
                                                                    <img src="./../../../public/img/<?= $food['image']; ?>" width="200px" height="200px" alt="profile-user" class="img-previewxxxxxxx  img-fluid rounded">
                                                                <?php endif; ?>
                                                                <input type="hidden" name="image" value="<?= isset($food['image']) ? $food['image'] : '' ?>">
                                                                <input class="form-control mt-3" id="image" name="image_baru" type="file" onchange="previewImage()">

                                                            </center>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" name="update" class="btn btn-primary">Update</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal Update -->

                            <!-- Modal -->
                            <div class="modal fade" id="<?= $food['id'] . 'mkunik' ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Image Product</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="./../../../public/img/<?= $food['image']; ?>" alt="profile-user" id="outputImg" class="rounded img-fluid">
                                        </div>
                                        <div class="modal-footer d-flex justify-content-center">
                                            <div class="text-start">
                                                <h5><?= $food['name_product']; ?></h5>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>


    <div class="col-sm-12 col-md-11 bg-white shadow-sm rounded pb-3 mb-5" style="overflow: hidden;min-height: 60vh;">
        <div class="row px-4 border-bottom border-2 d-flex justify-content-between">
            <div class="col-3">
                <h4 class="py-4 fs-6 m-0 fw-semibold">Data Food Available</h4>
            </div>
            <!-- <div class="col-2 d-flex justify-content-end align-items-center">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modaldemo8">Create New Food</a>
            </div> -->
        </div>

        <div class="row px-4">
            <div class="col-12">
                <table class="table table-bordered w-100" id="example_out">
                    <thead>
                        <th class="fw-semibold text-center align-middle">No</th>
                        <th class="fw-semibold text-center align-middle">Image</th>
                        <th class="fw-semibold text-center align-middle">Name Food</th>
                        <th class="fw-semibold text-center align-middle">Price</th>
                        <th class="fw-semibold text-center align-middle">Category</th>
                        <th class="fw-semibold text-center align-middle">Action</th>
                    </thead>
                    <tbody>
                        <!-- <?php var_dump($foods_out); ?> -->
                        <?php $i = 1; ?>
                        <?php foreach ($foods_out as $food) : ?>
                            <tr>
                                <td class="text-center align-middle"><?= $i; ?></td>
                                <td class="text-center align-middle sold-out-overlay">
                                    <button type="button" class="btn btn-white" data-bs-toggle="modal" data-bs-target="#<?= $food['id']; ?>">
                                        <img src="./../../../public/img/<?= $food['image']; ?>" width="60px" height="50px" alt="profile-user" id="outputImg" class="rounded">
                                    </button>
                                </td>
                                <td class=""><?= $food['name_product']; ?></td>
                                <td class="">Rp <?= $food['price']; ?></td>
                                <td class=""><?= $food['name_category']; ?></td>
                                <td class="align-middle">
                                    <div class="d-flex justify-content-center">
                                        <form action="" class="me-1">
                                            <input type="hidden" name="edit_id" value="<?= $food['id'] ?>">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#<?= $food['id'] ?>">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                        </form>

                                        <form action="./../../models/delete_food.php" method="post" id="delete_form_<?= $food['id'] ?>" class="me-1">
                                            <input type="hidden" name="delete_id" value="<?= $food['id'] ?>">
                                            <button type="button" class="btn btn-danger" onclick="confirmDelete(<?= $food['id'] ?>)">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>

                                        <script>
                                            function confirmDelete(foodId) {
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
                                                        document.querySelector(`#delete_form_${foodId}`).submit();
                                                    }
                                                });
                                            }
                                        </script>
                                    </div>
                                </td>
                            </tr>


                            <!-- Modal Update available-->
                            <div class="modal fade" data-bs-backdrop="static" id="<?= $food['id']; ?>">
                                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                    <div class="modal-content modal-content-demo p-3">
                                        <div class="modal-header">
                                            <h6 class="modal-title">Update Food</h6>
                                            <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">

                                            <form id="updateForm<?= $food['id']; ?>" action="./../../models/update_food.php" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="edit_id" value="<?= $food['id'] ?>">
                                                <div class="row">
                                                    <div class="col-md-7">
                                                        <div class="form-group">
                                                            <label for="name_product" class="form-label" style="font-size: 14px;">Name Product <span class="text-danger">*</span></label>
                                                            <input type="text" name="name_product" class="form-control mb-2" value="<?= isset($food['name_product']) ? $food['name_product'] : '' ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="category" class="form-label" style="font-size: 14px;">Category</label>
                                                            <select name="category" class="form-control" required>
                                                                <option value="">-- Choose --</option>
                                                                <?php foreach ($categories as $row) : ?>
                                                                    <option value="<?= $row['id'] ?>" <?= ($row['id'] == $food['category_id']) ? 'selected' : '' ?>>
                                                                        <?= $row['name_category']; ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="harga" class="form-label" style="font-size: 14px;">Price <span class="text-danger">*</span></label>
                                                            <input type="text" name="harga" class="form-control mb-2" value="<?= isset($food['price']) ? $food['price'] : '' ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="status" class="form-label" style="font-size: 14px;">Status <span class="text-danger">*</span></label>
                                                            <select name="status" class="form-control mb-2" required>
                                                                <option value="99" <?= ($food['stok'] > 0) ? 'selected' : '' ?>>Ready</option>
                                                                <option value="0" <?= ($food['stok'] <= 0) ? 'selected' : '' ?>>Out Of Stock</option>
                                                            </select>
                                                        </div>

                                                        <?php
                                                        $id_p2 = $food['id'];
                                                        $query_bahan_product2 = "SELECT pm.id_product, pm.id_material, pm.qty, p.name_product, fm.id, fm.name_material 
                                                    FROM product_materials pm 
                                                    JOIN products p ON pm.id_product = p.id 
                                                    JOIN food__materials fm ON pm.id_material = fm.id 
                                                    WHERE pm.id_product = '$id_p2'";
                                                        $result_bhq2 = mysqli_query($db_conn, $query_bahan_product2);
                                                        $data2 = mysqli_fetch_all($result_bhq2, MYSQLI_ASSOC);
                                                        ?>

                                                        <div id="ingredientsContainer<?= $food['id']; ?>" class="form-group">
                                                            <?php foreach ($data2 as $ingredient) : ?>
                                                                <div class="ingredient-group">
                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <label for="" class="form-label">Bahan Baku:</label>
                                                                            <select name="ingredients2[]" class="form-control" required>
                                                                                <option value="">-- Choose --</option>
                                                                                <?php foreach ($bahan_baku as $bb) : ?>
                                                                                    <option value="<?= $bb['id'] ?>" <?= ($bb['id'] == $ingredient['id_material']) ? 'selected' : '' ?>>
                                                                                        <?= $bb['name_material']; ?>
                                                                                    </option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-4">
                                                                            <label for="" class="form-label">Qty:</label>
                                                                            <input type="text" name="qty2[]" class="form-control mb-2" value="<?= $ingredient['qty'] ?>" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        </div>
                                                        <button type="button" class="mt-2 btn btn-primary" onclick="addIngredient_update(<?= $food['id']; ?>)"><i class="fas fa-plus"></i> Tambah Bahan Baku</button>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <label for="title" class="form-label" style="font-size: 14px;">Image <span class="text-danger"> * </span></label>
                                                        <div class="form-group">
                                                            <center>
                                                                <?php if (isset($food['image'])) : ?>
                                                                    <img src="./../../../public/img/<?= $food['image']; ?>" width="200px" height="200px" alt="profile-user" class="img-previewxxxxxxxz  img-fluid rounded">
                                                                <?php endif; ?>
                                                                <input type="hidden" name="image" value="<?= isset($food['image']) ? $food['image'] : '' ?>">
                                                                <input class="form-control mt-3" id="imagez" name="image_baru" type="file" onchange="previewImage2()">

                                                            </center>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" name="update" class="btn btn-primary">Update</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal Update -->


                            <!-- Modal -->
                            <div class="modal fade" id="<?= $food['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Image Product</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="./../../../public/img/<?= $food['image']; ?>" alt="profile-user" id="outputImg" class="rounded img-fluid">
                                        </div>
                                        <div class="modal-footer d-flex justify-content-center">
                                            <div class="text-start">
                                                <h5><?= $food['name_product']; ?></h5>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<!-- Create -->
<div class="modal fade" data-bs-backdrop="static" id="modaldemo8">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo p-3">
            <div class="modal-header">
                <h6 class="modal-title">Create Food</h6>
                <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-7">
                        <form action="./../../models/create_food.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name_product" class="form-label" style="font-size: 14px;">Name Product <span class="text-danger">*</span></label>
                                <input type="text" name="name_product" class="form-control mb-2" required>
                            </div>
                            <div class="form-group">
                                <label for="category" class="form-label" style="font-size: 14px;" required>Category</label>

                                <select name="category" class="form-control" required>
                                    <option value="">-- Choose --</option>
                                    <?php foreach ($categories as $row) : ?>
                                        <option value="<?= $row['id'] ?>">
                                            <?= $row['name_category']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="harga" class="form-label" style="font-size: 14px;">Price <span class="text-danger">*</span></label>
                                <input type="text" name="harga" class="form-control mb-2" required>
                            </div>
                            <div class="form-group">
                                <label for="status" class="form-label" style="font-size: 14px;">Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-control mb-2" required>

                                    <option value="99">Ready</option>
                                    <option value="0">Out Of Stok</option>

                                </select>
                            </div>

                            <div id="ingredientsContainer" class="form-group">
                                <div class="ingredient-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="ingredient1" class="form-label">Bahan Baku 1:</label>
                                            <select name=" ingredients[]" class="form-control" required>
                                                <option value="">-- Choose --</option>
                                                <?php foreach ($bahan_baku as $bb) : ?>
                                                    <option value="<?= $bb['id'] ?>">
                                                        <?= $bb['name_material']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <label for="qty1" class="form-label">Qty:</label>
                                            <input type="text" id="qty1" name="qty[]" class="form-control mb-2" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="mt-2 btn btn-primary" onclick="addIngredient()"><i class="fas fa-plus"></i> Tambah Bahan Baku</button>
                    </div>
                    <div class="col-md-5">
                        <label for="title" class="form-label" style="font-size: 14px;">Image <span class="text-danger"> * </span></label>
                        <div class="form-group">
                            <center>
                                <img width="200px" height="200px" alt="profile-user" id="outputImg" class="img-qwerty img-fluid rounded" style="display: none;">
                            </center>
                            <input class="form-control mt-3" id="image-qwerty" name="image" type="file" onchange="previewImage3()">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="submit" class="btn btn-primary">Save</button>
                <button type="reset" class="btn btn-danger">Reset</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ENd Cretate -->

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

<script>
    function previewImage() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-previewxxxxxxx');

        imgPreview.style.display = 'block';
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }

    function previewImage2() {
        const image = document.querySelector('#imagez');
        const imgPreview = document.querySelector('.img-previewxxxxxxxz');

        imgPreview.style.display = 'block';
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }

    function previewImage3() {
        const image = document.querySelector('#image-qwerty');
        const imgPreview = document.querySelector('.img-qwerty');

        imgPreview.style.display = 'block';
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }

    document.getElementById('modaldemo8').addEventListener('hidden.bs.modal', function() {
        const imageInput = document.getElementById('image');
        const imgPreview = document.querySelector('.img-previewxxxxxxx');

        imageInput.value = ''; // Clear the file input
        imgPreview.style.display = 'none'; // Hide the image preview
        imgPreview.src = ''; // Clear the image source
    });
</script>


<script>
    let ingredientCount = 1;

    function addIngredient() {
        // Membuat ID unik untuk elemen baru
        const uniqueId = 'ingredient-' + Date.now();

        // Templating string untuk elemen yang akan ditambahkan
        const newIngredientGroupHTML = `
        <div class="ingredient-group" id="${uniqueId}">
            <div class="row">
                <div class="col-6">
                    <label for="" class="form-label">Bahan :</label>
                    <select name="ingredients[]" class="form-control" required>
                        <option value="">-- Choose --</option>
                        <?php foreach ($bahan_baku as $bb) : ?>
                            <option value="<?= $bb['id'] ?>">
                                <?= $bb['name_material']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-4">
                    <label for="" class="form-label">Qty:</label>
                    <input type="text" name="qty[]" class="form-control mb-2" required>
                </div>
                <div class="col-2">
                <label for="" class="form-label">_</label>
                    <button type="button" class="btn btn-danger btn-remove" onclick="removeIngredientById('${uniqueId}')"><i class="bi bi-trash"></i></button>
                </div>
            </div>
        </div>
    `;

        // Menambahkan HTML ke dalam container
        const container = document.getElementById('ingredientsContainer');
        container.insertAdjacentHTML('beforeend', newIngredientGroupHTML);
    }

    function removeIngredientById(id) {
        // Mencari elemen dengan ID yang sesuai dan menghapusnya
        const ingredientGroup = document.getElementById(id);

        if (ingredientGroup) {
            ingredientGroup.remove();
        }
    }
</script>


<script>
    // Encode bahan baku data to JSON and pass it to JavaScript
    const bahanBaku = <?php echo json_encode($bahan_baku); ?>;

    function addIngredient_update(id) {
        let options = '<option value="">-- Choose --</option>';
        bahanBaku.forEach(bb => {
            options += `<option value="${bb.id}">${bb.name_material}</option>`;
        });

        // Membuat ID unik untuk elemen yang akan ditambahkan
        const uniqueId = 'ingredient-' + Date.now();

        const code = `
        <div class="ingredient-group" id="${uniqueId}">
            <div class="row">
                <div class="col-6">
                    <label for="" class="form-label">Bahan Baku:</label>
                    <select name="ingredients2[]" class="form-control" required>
                        ${options}
                    </select>
                </div>
                <div class="col-4">
                    <label for="" class="form-label">Qty:</label>
                    <input type="text" name="qty2[]" class="form-control mb-2" required>
                </div>
                <div class="col-2">
                    <label for="" class="form-label">_</label>
                    <button type="button" class="btn btn-danger btn-remove" onclick="removeIngredientById('${uniqueId}')"><i class="bi bi-trash"></i></button>
                </div>
            </div>
        </div>
    `;

        document.querySelector(`#ingredientsContainer${id}`).insertAdjacentHTML('beforeend', code);
    }
</script>

<script>
    function removeIngredient(button) {
        // Mendapatkan indeks dari data-attribute pada tombol
        var index = button.getAttribute('data-index');

        // Mencari elemen dengan ID yang sesuai dan menghapusnya
        var ingredientGroup = document.getElementById('ingredient-' + index);

        if (ingredientGroup) {
            ingredientGroup.remove();
        }
    }
</script>










<!-- <script>
    function addIngredient_update(id) {
        const code = `<?php include "include.php"; ?>`;
        $(`#ingredientsContainer${id}`).append(code);
    }
</script> -->