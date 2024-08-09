<div class="col-12 alert alert-success  alert-dismissible fade show" role="alert" style="border: none">
    <h1 class="p-5"><?= isset($_SESSION['name']) ? $_SESSION['name'] : '' ?></h1>


    <!-- <h1 class="p-5"><?= isset($_SESSION['id']) ? $_SESSION['id'] : '' ?></h1> -->
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>