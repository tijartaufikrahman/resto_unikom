<?php require_once __DIR__ . '../../../../config/config.php'; ?>

<!-- Per Day -->
<?php
$query_income_day = "SELECT 
    DATE(date) AS date,
    SUM(total) AS total
    FROM 
    transactions
    WHERE 
    date IS NOT NULL
    AND YEAR(date) = YEAR(CURDATE())
    AND MONTH(date) = MONTH(CURDATE())
    GROUP BY 
    DATE(date)
    ORDER BY 
    DATE(date) ASC;
";
$result3 = mysqli_query($db_conn, $query_income_day);
$rows_visual = mysqli_fetch_all($result3, MYSQLI_ASSOC);

$date_days = [];
$total_days = [];

foreach ($rows_visual as $v) {
    $date_days[] = $v['date'];
    $total_days[] = $v['total'];
}
?>
<!-- END Per Day -->


<!-- Per Mount -->
<?php
$query_income_month = "SELECT 
DATE_FORMAT(date, '%Y-%m') AS date,
SUM(total) AS total
FROM 
transactions
WHERE 
date IS NOT NULL
AND YEAR(date) = YEAR(CURDATE())
GROUP BY 
DATE_FORMAT(date, '%Y-%m')
ORDER BY 
DATE_FORMAT(date, '%Y-%m') ASC;
";

$result_mount = mysqli_query($db_conn, $query_income_month);
$rows_mount = mysqli_fetch_all($result_mount, MYSQLI_ASSOC);

$date_mounts = [];
$total_mounts = [];

foreach ($rows_mount as $m) {
    $date_mounts[] = $m['date'];
    $total_mounts[] = $m['total'];
}
?>
<!-- END Per Mount -->


<!-- Per Year -->
<?php
$query_income_years = "SELECT 
YEAR(date) AS date,
SUM(total) AS total
FROM 
transactions
WHERE 
date IS NOT NULL
GROUP BY 
YEAR(date)
ORDER BY 
YEAR(date) ASC;
";


$result_years = mysqli_query($db_conn, $query_income_years);
$rows_years = mysqli_fetch_all($result_years, MYSQLI_ASSOC);

$date_years = [];
$total_years = [];

foreach ($rows_years as $y) {
    $date_years[] = $y['date'];
    $total_years[] = $y['total'];
}
?>
<!-- End Per Year -->

<div class="d-flex justify-content-between" style="height: 200px;background-color: #357CA5;">
    <h3 class="p-4 text-light">Analitycs</h3>
</div>

<div class="row g-0 px-5" style="margin-top: -110px;">
    <div class="col-12">
        <!-- <div class="row g-5">
            <div class="col-3 mb-2">
                <div class="row bg-white p-3 shadow-sm rounded-4 " style="overflow: hidden;">
                    <div class="col-12 d-flex">
                        <i class="bi bi-currency-exchange fs-1 py-3 px-4 rounded-4" style="color:#357CA5;background-color:#E1EBF1;"></i>
                        <div class="ms-3 mt-2">
                            <div>
                                <h5 class="text-body-secondary fw-semibold" style="font-size: 18px;">Today's Income</h5>
                            </div>
                            <div>
                                <h4 class="text-body-secondary">Rp 100.000.000</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3 mb-2">
                <div class="row bg-white p-3 shadow-sm rounded-4 " style="overflow: hidden;">
                    <div class="col-12 d-flex">
                        <i class="bi bi-currency-exchange fs-1 py-3 px-4 rounded-4 text-success" style="background-color:#E1EBF1;"></i>
                        <div class="ms-3 mt-2">
                            <div>
                                <h5 class="text-body-secondary fw-semibold" style="font-size: 18px;">This Month's Income</h5>
                            </div>
                            <div>
                                <h4 class="text-body-secondary">Rp 100.000.000</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3 mb-2">
                <div class="row bg-white p-3 shadow-sm rounded-4 " style="overflow: hidden;">
                    <div class="col-12 d-flex">
                        <i class="bi bi-currency-exchange fs-1 py-3 px-4 rounded-4 text-warning" style="background-color:#E1EBF1;"></i>
                        <div class="ms-3 mt-2">
                            <div>
                                <h5 class="text-body-secondary fw-semibold" style="font-size: 18px;">This Year's Income</h5>
                            </div>
                            <div>
                                <h4 class="text-body-secondary">Rp 100.000.000</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3 mb-2">
                <div class="row bg-white p-3 shadow-sm rounded-4 " style="overflow: hidden;">
                    <div class="col-12 d-flex">
                        <i class="bi bi-currency-exchange fs-1 py-3 px-4 rounded-4 text-danger" style="background-color:#E1EBF1;"></i>
                        <div class="ms-3 mt-2">
                            <div>
                                <h5 class="text-body-secondary fw-semibold" style="font-size: 18px;">All income</h5>
                            </div>
                            <div>
                                <h4 class="text-body-secondary">Rp 100.000.000</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->


        <!-- Income Per Day -->
        <div class="row mt-3 ">
            <div class="col-8 mb-2 rounded-3 shadow-sm bg-white ">
                <h4 class=" p-3">Grafik Income Per day </h4>
                <div class="mt-4 d-flex justify-content-center px-5" style="width: 100%">
                    <canvas id="pendapatanChart"></canvas>
                </div>
            </div>
            <div class="col-4" style="max-height: 29.7rem;overflow:auto;">
                <div class="bg-white rounded-3">
                    <h4 class=" p-3">Total Income Per day</h4>
                    <div class=" px-5 pb-4">
                        <table class="table table-bordered ">
                            <tr class="">
                                <!-- <th class="fw-normal">No</th> -->
                                <th class="fw-normal">Date</th>
                                <th class="fw-normal">Total</th>
                            </tr>
                            <?php $i = 1; ?>
                            <?php foreach ($rows_visual as $d) : ?>
                                <tr>

                                    <td><?= $d['date']; ?></td>
                                    <td><?= formatRupiah($d['total']); ?></td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                            <!--  -->

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- ENd Income Per Day -->


        <!-- Income Per Mount -->
        <div class="row mt-3 ">
            <div class="col-8 mb-2 rounded-3 shadow-sm bg-white ">
                <h4 class=" p-3">Grafik Income Per Mount </h4>
                <div class="mt-4 d-flex justify-content-center px-5" style="width: 100%">
                    <canvas id="pendapatanChartMount"></canvas>
                </div>
            </div>
            <div class="col-4" style="max-height: 29.7rem;overflow:auto;">
                <div class="bg-white rounded-3">
                    <h4 class=" p-3">Total Income Per Mount</h4>
                    <div class=" px-5 pb-4">
                        <table class="table table-bordered ">
                            <tr class="">
                                <!-- <th class="fw-normal">No</th> -->
                                <th class="fw-normal">Date</th>
                                <th class="fw-normal">Total</th>
                            </tr>
                            <?php $i = 1; ?>
                            <?php foreach ($rows_mount as $m) : ?>
                                <tr>

                                    <td><?= $m['date']; ?></td>
                                    <td><?= formatRupiah($m['total']); ?></td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                            <!--  -->

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Income Per Mount -->


        <!-- Income Per Year -->
        <div class="row mt-3 mb-5 ">
            <div class="col-8 mb-2 rounded-3 shadow-sm bg-white ">
                <h4 class=" p-3">Grafik Income Per Year </h4>
                <div class="mt-4 d-flex justify-content-center px-5" style="width: 100%">
                    <canvas id="pendapatanChartYear"></canvas>
                </div>
            </div>
            <div class="col-4" style="max-height: 29.7rem;overflow:auto;">
                <div class="bg-white rounded-3">
                    <h4 class=" p-3">Total Income Per Year</h4>
                    <div class=" px-5 pb-4">
                        <table class="table table-bordered ">
                            <tr class="">
                                <!-- <th class="fw-normal">No</th> -->
                                <th class="fw-normal">Date</th>
                                <th class="fw-normal">Total</th>
                            </tr>
                            <?php $i = 1; ?>
                            <?php foreach ($rows_years as $y) : ?>
                                <tr>

                                    <td><?= $y['date']; ?></td>
                                    <td><?= formatRupiah($y['total']); ?></td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                            <!--  -->

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Income Per Year -->
    </div>
</div>



<!-- Income Per day -->
<script>
    var date_days = <?php echo json_encode($date_days); ?>;
    var total_days = <?php echo json_encode($total_days); ?>;
    // Menampilkan data di konsol untuk verifikasi
    // console.log(date_days);
    // console.log(total_days);
    const ctx = document.getElementById('pendapatanChart').getContext('2d');
    const pendapatanChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: date_days,
            datasets: [{
                label: 'Pendapatan',
                data: total_days,
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderWidth: 1,
                fill: true,
                tension: 0.4 // Menambahkan smooth line
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Pendapatan (IDR)'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Tanggal'
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            }
        }
    });
</script>
<!-- ENd Income Per day -->

<!-- Income Per mount -->
<script>
    var date_mounts = <?php echo json_encode($date_mounts); ?>;
    var total_mounts = <?php echo json_encode($total_mounts); ?>;
    // Menampilkan data di konsol untuk verifikasi
    // console.log(date_days);
    // console.log(total_days);
    const ctx_m = document.getElementById('pendapatanChartMount').getContext('2d');
    const pendapatanChart_m = new Chart(ctx_m, {
        type: 'line',
        data: {
            labels: date_mounts,
            datasets: [{
                label: 'Pendapatan',
                data: total_mounts,
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderWidth: 1,
                fill: true,
                tension: 0.4 // Menambahkan smooth line
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Pendapatan (IDR)'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Tanggal'
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            }
        }
    });
</script>
<!-- ENd Income Per mount -->

<!-- Income Per year -->
<script>
    var date_years = <?php echo json_encode($date_years); ?>;
    var total_years = <?php echo json_encode($total_years); ?>;
    // Menampilkan data di konsol untuk verifikasi
    // console.log(date_days);
    // console.log(total_days);
    const ctx_y = document.getElementById('pendapatanChartYear').getContext('2d');
    const pendapatanChart_y = new Chart(ctx_y, {
        type: 'line',
        data: {
            labels: date_years,
            datasets: [{
                label: 'Pendapatan',
                data: total_years,
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderWidth: 1,
                fill: true,
                tension: 0.4 // Menambahkan smooth line
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Pendapatan (IDR)'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Tanggal'
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            }
        }
    });
</script>
<!-- EndIncome Per year -->