<?php
require_once __DIR__ . '../../../../config/config.php';
$query = "SELECT SUM(total) AS total_sum
    FROM transactions
    WHERE date IS NOT NULL;
";

$result = mysqli_query($db_conn, $query);
$row = mysqli_fetch_assoc($result);

// echo $row['total_sum'];

$query_ = "SELECT 
p.*,
COALESCE(SUM(oli.quantity), 0) AS terjual
FROM 
    products p
LEFT JOIN 
    order_list_items oli ON oli.food_id = p.id
GROUP BY 
    p.id, p.name_product, p.price
ORDER BY 
    terjual DESC
   LIMIT 7";

$result2 = mysqli_query($db_conn, $query_);
$rows = mysqli_fetch_all($result2, MYSQLI_ASSOC);
// var_dump($rows);




$query_visual = "SELECT 
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


$result3 = mysqli_query($db_conn, $query_visual);
$rows_visual = mysqli_fetch_all($result3, MYSQLI_ASSOC);
// var_dump($rows_visual);

$dates = [];
$totals = [];

foreach ($rows_visual as $v) {
    $dates[] = $v['date'];
    $totals[] = $v['total'];
}





// Tahun
$query_total_year = "
SELECT SUM(total) AS total_sum
FROM transactions
WHERE date IS NOT NULL
AND YEAR(date) = YEAR(CURDATE());
";

$result_year = mysqli_query($db_conn, $query_total_year);
$row_year = mysqli_fetch_assoc($result_year);
// ENDTahun

// Mount
$query_mount = "
SELECT SUM(total) AS total_sum
FROM transactions
WHERE date IS NOT NULL
AND MONTH(date) = MONTH(CURDATE())
AND YEAR(date) = YEAR(CURDATE());
";


$result_mount = mysqli_query($db_conn, $query_mount);
$row_mount = mysqli_fetch_assoc($result_mount);
// ENDMount

// Hari Ini
$query_day = "
SELECT SUM(total) AS total_sum
FROM transactions
WHERE date IS NOT NULL
AND DATE(date) = CURDATE();
";



$result_day = mysqli_query($db_conn, $query_day);
$row_day = mysqli_fetch_assoc($result_day);
// Hari Ini
?>

<div class="d-flex justify-content-between" style="height: 190px;background-color: #357CA5;">
    <h3 class="p-4 text-light">Dashboard</h3>
</div>

<div class="row g-0 px-5" style="margin-top: -100px;">
    <div class="col-12">
        <div class="row g-5">
            <div class="col-3 mb-2">
                <div class="row bg-white p-3 shadow-sm rounded-4 " style="overflow: hidden;">
                    <div class="col-12 d-flex">
                        <i class="bi bi-currency-exchange fs-1 py-3 px-4 rounded-4" style="color:#357CA5;background-color:#E1EBF1;"></i>
                        <div class="ms-3 mt-2">
                            <div>
                                <h5 class="text-body-secondary fw-semibold" style="font-size: 17px;">Today's Income</h5>
                            </div>
                            <div>
                                <h4 class="text-body-secondary"><?= formatRupiah($row_day['total_sum']); ?></h4>
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
                                <h5 class="text-body-secondary fw-semibold" style="font-size: 17px;">This Month's Income</h5>
                            </div>
                            <div>
                                <h4 class="text-body-secondary"><?= formatRupiah($row_mount['total_sum']); ?></h4>
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
                                <h5 class="text-body-secondary fw-semibold" style="font-size: 17px;">This Year's Income</h5>
                            </div>
                            <div>
                                <h4 class="text-body-secondary"><?= formatRupiah($row_year['total_sum']); ?></h4>
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
                                <h5 class="text-body-secondary fw-semibold" style="font-size: 17px;">All income</h5>
                            </div>
                            <div>
                                <h4 class="text-body-secondary"><?= formatRupiah($row['total_sum']); ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-12  ">
                <div class="row mb-5">
                    <div class="col-8 mb-2 ">
                        <div class="row  bg-white p-4 shadow-sm rounded-4 " style="overflow: hidden;margin-right:1px;">
                            <div class=" col-12 " style="min-height:310px;">
                                <!-- <h5 class="text-body-secondary fw-semibold">Grafik </h5> -->
                                <div class="d-flex justify-content-center" style="width: 100%; height: 100%;">
                                    <canvas id="pendapatanChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 mb-2">
                        <div class="row bg-white p-4 shadow-sm rounded-4 " style="overflow: hidden;">
                            <div class="col-12">
                                <div>
                                    <h5 class="py-2 text-body-secondary fw-semibold">Top <?= count($rows); ?> Product</h5>
                                </div>
                                <div>
                                    <table class="table ">
                                        <thead class="table-light">
                                            <td>No</td>
                                            <td>Name</td>
                                            <td>Sold</td>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach ($rows as $r) : ?>
                                                <tr>
                                                    <td><?= $i; ?></td>
                                                    <td><?= $r['name_product']; ?></td>
                                                    <td><?= $r['terjual']; ?></td>
                                                </tr>

                                                <?php $i++ ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    var dates = <?php echo json_encode($dates); ?>;
    var totals = <?php echo json_encode($totals); ?>;

    // Menampilkan data di konsol untuk verifikasi
    // console.log(dates);
    // console.log(totals);
    const ctx = document.getElementById('pendapatanChart').getContext('2d');
    const pendapatanChart = new Chart(ctx, {
        type: 'line',
        data: {

            // labels: ['01-07-2023', '08-07-2023', '15-07-2023', '22-07-2023'], // Tanggal bulan tahun
            labels: dates,
            datasets: [{
                label: 'Pendapatan',
                data: totals,
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