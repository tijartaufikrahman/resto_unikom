<?php

define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'resto_unikom');

$conn = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = '';
}

$sql = "SELECT t.id,t.customer_name,o.id_table,p.name_product,oli.quantity,p.price,
t.total,t.pay_money,t.refund_money,t.date,t.created_at
FROM 
    transactions t
JOIN 
    orders o ON t.order_id = o.id
JOIN 
    order_list_items oli ON o.id = oli.order_id
JOIN 
    products p ON oli.food_id = p.id WHERE t.id = '$id'
";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_all($result, MYSQLI_ASSOC);


// var_dump($row);
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Content</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <div class="col-3 bg-white struk-custom">
        <h5 class="text-center pt-2">MARTABAKKU</h5>
        <h5 class="text-center fw-normal" style="font-size: 14px;"><?= $row[0]['date']; ?></h5>
        <table style="width: 100%;">
            <tr>
                <td>INVOICE</td>
                <td><?= $row[0]['id']; ?></td>
            </tr>
            <tr>
                <td>TABLE</td>
                <td>1</td>
            </tr>
        </table>
        <!-- <span>-------------------------------------------</span> -->
        <table class="mx-5 ">
            <!-- <tr>
                    <td>Name Product</td>
                    <td>Price</td>
                    <td>Qunatiry</td>
                </tr> -->
            <?php foreach ($row as $d) : ?>
                <tr>
                    <td><?= $d['name_product']; ?></td>
                    <td>Rp <?= $d['price']; ?></td>
                    <td class="text-center"><?= $d['quantity']; ?></td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3">-------------------------------------------</td>
            </tr>
            <tr>
                <td>
                    <h5>Total </h5>
                </td>
                <td>
                    <h5>Rp <?= $d['total']; ?></h5>
                </td>
            <tr>
                <td>Cash</td>
                <td>Rp <?= $d['pay_money']; ?></td>
            </tr>
            <tr>
                <td>Change</td>
                <td>Rp <?= $d['refund_money']; ?></td>
            </tr>
            <tr>
                <td colspan="3">==========================</td>
            </tr>
        </table>
        <!-- <span>----------------------------------------------------------------</span> -->
    </div>
</body>

</html>