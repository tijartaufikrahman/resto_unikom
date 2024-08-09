<style>
    .table-box {
        margin: 5px;
        margin-bottom: 50px;
    }

    .wider-table-10 {
        width: 150px;
        height: 60px;
    }

    .wider-table-8 {
        width: 60px;
        height: 100px;
    }

    .wider-table-6 {
        width: 80px;
        height: 50px;
    }

    .wider-table-2 {
        width: 30px;
        height: 60px;
    }

    .custom-pointer {
        cursor: pointer;
    }
</style>


<div class="d-flex justify-content-between" style="height: 200px;background-color: #357CA5;">
    <h3 class="p-4 text-light">Find Table and Seats</h3>
</div>

<div class="row g-0 px-5" style="margin-top: -110px;">
    <div class="col-12 bg-white shadow-sm rounded mb-5" style="overflow: hidden;min-height: 60vh;">
        <div class="row">
            <div class="col">
                <?php if (isset($_SESSION['success'])) : ?>
                    <div class="col-12 alert alert-info alert-dismissible rounded-0 fade show" role="alert" style="border: none">
                        <h3 class="text-center fw-normal text-center p-3"><?= $_SESSION['success'] ?></h3>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php unset($_SESSION['success']);
                endif; ?>
            </div>
        </div>

        <div class="row">
            <div class="accordion accordion-flush border-bottom border-4 border-light" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            <h3 class="btn btn-info p-3 text-light fw-semibold"><i class="bi bi-search fw-bold"></i> Find Table and Seats</h3>
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse <?= isset($tables_empty) ? 'show' : '' ?> collapse rounded-0" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">


                            <form action="" method="POST">
                                <div class="mb-3">
                                    <label for="number_of_customers" class="form-label">Number of Customers</label>
                                    <input type="text" class="form-control <?= isset($errors['number_of_customers']) ? 'is-invalid' : '' ?>" id="number_of_customers" name="number_of_customers" value="<?= isset($number_of_customers) ? $number_of_customers : '' ?>">
                                    <?php if (isset($errors['number_of_customers'])) : ?>
                                        <div class="invalid-feedback">
                                            <?= $errors['number_of_customers'] ?>
                                        </div>
                                    <?php endif; ?>
                                    <div id="emailHelp" class="form-text">We'll never share your number with anyone else.</div>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <a href="" type="reset" class="btn btn-warning text-white">Refresh</a>
                                    </div>
                            </form>
                            <form action="" method="post">
                                <input type="hidden" value=1 name="reset">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to clear the status of all tables?')">
                                    <span class="bi bi-trash"></span> Reset
                                </button>
                            </form>

                        </div>




                        <?php if (isset($tables_empty)) : ?>
                            <div class="row">
                                <div class="offset-1 col-10">
                                    <div class="mt-5 mb-5">
                                        <?php if (empty($tables_empty)) : ?>
                                            <h3 class="text-center p-4">There Are No Empty Tables</h3>
                                        <?php else : ?>
                                            <h3>List of Empty Tables</h3>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Name_Tables</th>
                                                        <th scope="col">Maximal_Seats</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($tables_empty as $index => $table) : ?>
                                                        <tr>
                                                            <td><?= $index + 1 ?></td>
                                                            <td>Table <?= $table['table_number'] ?></td>
                                                            <td><?= $table['maximum_seats'] ?></td>
                                                            <td>
                                                                <form action="" method="POST">
                                                                    <input type="hidden" name="table_id" value="<?= $table['id'] ?>">
                                                                    <button type="submit" onclick="return confirm('Are you sure you want to use this table?')" class="btn btn-info text-white fw-semibold">Use a Table</button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid g-0 d-flex justify-content-center align-items-center">
        <center>
            <div class="row mt-5 mb-4">
                <?php $j = 1;;
                $count = count($tables); ?>

                <?php for ($i = 0; $i < $count; $i++) : ?>
                    <?php

                    $occupied = isset($tables[$i]) ? $tables[$i]['occupied'] : false;
                    $tableClass = $occupied ? 'bg-info text-light' : 'bg-body-secondary';
                    if ($i <= 3) {
                        $tableClass .= ' wider-table-10';
                    } elseif ($i >= 3 && $i <= 7) {
                        $tableClass .= ' wider-table-8';
                    } elseif ($i >= 8 && $i <= 15) {
                        $tableClass .= ' wider-table-6';
                    } elseif ($i >= 16 && $i <= 19) {
                        $tableClass .= ' wider-table-2';
                    }
                    ?>
                    <div class="col-3 custom-pointer" data-bs-target="#modal<?= $i ?>" data-bs-toggle="modal">
                        <div class="d-flex align-items-center justify-content-center table-box shadow-sm <?= $tableClass ?>">
                            <span>Table <?= $j ?></span>
                        </div>
                    </div>

                    <div class="modal fade" id="modal<?= $i ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Table <?= $tables[$i]['table_number'] ?></h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <table class="fw-semibold">
                                        <tr>
                                            <td>Status Table</td>
                                            <td>:</td>
                                            <td>
                                                <?php if ($tables[$i]['occupied']) : ?>
                                                    <span class="mx-3 bg-info px-1 text-white rounded"> <i class="fas fa-times-circle"></i> Occupied</span>
                                                <?php else : ?>
                                                    <span class="mx-3 bg-body-secondary px-1 text-white rounded"> <i class="fas fa-check-circle"></i> Available</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Chairs Amount</td>
                                            <td>:</td>
                                            <td><span class="mx-3 px-1 rounded"><?= $tables[$i]['maximum_seats'] ?></span></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="modal-footer d-flex justify-content-between">
                                    <form action="" method="POST">
                                        <input type="hidden" name="table_id" value="<?= $tables[$i]['id']; ?>">
                                        <button type="submit" onclick="return confirm('Are you sure you want to use this table?')" class="btn btn-info text-white fw-semibold" <?= $tables[$i]['occupied'] ? 'disabled' : '' ?>>Use a Table</button>
                                    </form>
                                    <form action="" method="POST">
                                        <input type="hidden" name="clear_the_table" value="<?= $tables[$i]['id']; ?>">
                                        <button type="submit" class="btn btn-danger fw-semibold text-white <?= !$tables[$i]['occupied'] ? 'disabled' : '' ?>" onclick="return confirm('Are you sure you want to clear the status of this table?')">Clear the Table</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php $j++; ?>
                <?php endfor; ?>
            </div>
        </center>

    </div>
</div>
</div>