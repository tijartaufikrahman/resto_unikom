<?php require_once __DIR__ . "/../../../models/product_sales_report.php"; ?>

<div class="d-flex justify-content-between" style="height: 200px;background-color: #357CA5;">
    <h3 class="p-4 text-light">Foods</h3>
</div>

<div class="row g-0 d-flex justify-content-evenly" style="margin-top: -110px;">
    <div class="col-sm-12 col-md-11 bg-white shadow-sm rounded pb-3 mb-5" style="overflow: hidden;min-height: 60vh;">
        <div class="row px-4 border-bottom border-2 d-flex justify-content-between">
            <div class="col-1">
                <h4 class="py-4 fs-6 m-0 fw-semibold">Data</h4>
            </div>
            <!-- <div class="col-2 d-flex justify-content-end align-items-center">
                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modaldemo8">Create New Food</a>
            </div> -->
        </div>

        <div class="row px-4">
            <div class="col-12">
                <table class="table table-bordered w-100" id="example">
                    <thead>
                        <th class="fw-semibold text-center align-middle">No</th>
                        <th class="fw-semibold text-center align-middle">Image</th>
                        <th class="fw-semibold text-center align-middle">Name Food</th>
                        <th class="fw-semibold text-center align-middle">Price</th>
                        <th class="fw-semibold text-center align-middle">Terjual</th>
                        <!-- <th class="fw-semibold text-center align-middle">Category</th> -->
                        <!-- <th class="fw-semibold text-center align-middle">Action</th> -->
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($reports as $r) : ?>
                            <tr>
                                <td class="text-center align-middle"><?= $i; ?></td>
                                <td class="text-center align-middle">
                                    <img src="./../../../public/img/<?= $r['image']; ?>" width="60px" height="50px" alt="profile-user" id="outputImg" class="rounded">
                                </td>
                                <td class=""><?= $r['name_product']; ?></td>
                                <td class="">Rp <?= $r['price']; ?></td>
                                <td class="text-start"><?= $r['terjual']; ?></td>

                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

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

                                <!-- <select name="category" class="form-control mb-2">
                                    <option value="">-- Pilih --</option>
                                    <option value="1">Category 1</option>
                                    <option value="2">Category 2</option>
                                    <option value="2">Category 3</option>
                                </select> -->


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
                                <label for="stok" class="form-label" style="font-size: 14px;">Stok <span class="text-danger">*</span></label>
                                <input type="text" name="stok" class="form-control mb-2" required>
                            </div>
                    </div>
                    <div class="col-md-5">
                        <label for="title" class="form-label" style="font-size: 14px;">Image <span class="text-danger"> * </span></label>
                        <div class="form-group">
                            <center>
                                <img width="200px" height="200px" alt="profile-user" id="outputImg" class="img-preview img-fluid rounded" style="display: none;">
                            </center>
                            <input class="form-control mt-3" id="image" name="image" type="file" onchange="previewImage()">
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
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }

    document.getElementById('modaldemo8').addEventListener('hidden.bs.modal', function() {
        const imageInput = document.getElementById('image');
        const imgPreview = document.querySelector('.img-preview');

        imageInput.value = ''; // Clear the file input
        imgPreview.style.display = 'none'; // Hide the image preview
        imgPreview.src = ''; // Clear the image source
    });
</script>