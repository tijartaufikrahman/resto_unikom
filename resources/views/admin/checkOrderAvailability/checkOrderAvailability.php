<?php require_once __DIR__ . "/../../../models/products.php"; ?>

<style>
    .sold-out-overlay {
        position: relative;
    }

    .sold-out-overlay::before {
        content: "Not In Stock";
        position: absolute;
        top: 50%;
        left: 32%;
        transform: translate(-50%, -50%);
        background-color: rgb(173, 87, 96);
        color: white;
        padding: 0.5em 1em;
        border-radius: 0.25em;
        text-align: center;
        z-index: 20;
        font-weight: 600;
    }

    .sold-out-overlay>.row {
        opacity: 0.40;
    }

    .accordion-button:not(.collapsed) {
        background-color: #fff;
    }
</style>
</head>


<div class="d-flex justify-content-between" style="height: 200px;background-color: #357CA5;">
    <h3 class="p-4 text-light">Check Order Availability</h3>
</div>

<div class="row g-0 px-5" style="margin-top: -110px;">
    <div class="col-12 bg-white shadow-sm rounded pb-3 mb-5" style="overflow: hidden;min-height: 60vh;">
        <div class="row">
            <div class="col-lg-5">
                <form action="" method="GET" class="input-group p-4">
                    <input type="hidden" name="q" value="check-order-availability">
                    <input type="text" class="form-control" name="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button type="submit" class="input-group-text text-white rounded-0 rounded-end px-4 fs-5" style="background-color: #357CA5; padding: 10px 0;">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="px-4">

                    <!-- Sekarang Ini -->
                    <?php if (isset($check_search)) : ?>
                        <h3 class="text-center p-2 fw-semibold">Search "<?= $check_search ?>"</h3>
                    <?php endif; ?>
                    <!-- End Sekarang Ini -->

                    <?php if (empty($groupedCategories)) : ?>
                        <div class="w-100 h-100 d-flex align-items-center justify-content-center p-5">
                            <h4 class="text-center fw-semibold text-body-secondary">No Products Available</h4>
                        </div>
                    <?php else : ?>
                        <?php foreach ($groupedCategories as $category_id => $category) : ?>
                            <?php if (!empty($category['products'])) : ?>
                                <div class="row py-3">
                                    <div class="accordion" id="accordionExample">
                                        <div class="accordion-item border-0">
                                            <div class="accordion-header" style="position: relative; margin-left:-20px;">
                                                <div class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapse<?= $category_id ?>" aria-expanded="false" aria-controls="collapse<?= $category_id ?>" style="cursor: pointer">
                                                    <h4 class="fw-semibold text-body-secondary">- <?= $category['name_category'] ?> -</h4>
                                                </div>
                                            </div>
                                            <div id="collapse<?= $category_id ?>" class="accordion-collapse collapse show" aria-labelledby="heading<?= $category_id ?>">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <?php foreach ($category['products'] as $product) : ?>
                                                            <div class="col-md-6 col-lg-4 col-xl-3 mt-3 <?= (isset($product['stok']) && $product['stok'] <= 0) ? 'sold-out-overlay' : '' ?>">
                                                                <div class="row g-0 rounded shadow" style="overflow: hidden;">
                                                                    <div class="col-7">
                                                                        <img src="./../../../public/img/<?= $product['image']; ?>" alt="" class="img-fluid">
                                                                    </div>
                                                                    <div class="col-5 d-flex align-items-center">
                                                                        <div class="ms-2 p-1">
                                                                            <h5 class="fw-semibold" style="font-size: 14px;"><?= $product['name_product'] ?></h5>
                                                                            <h5 class="fw-normal" style="font-size: 13px;">Stok: <?= $product['stok'] ?></h5>
                                                                            <h5 class="fw-semibold text-danger" style="font-size: 13px;">Price: <?= $product['price'] ?></h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>