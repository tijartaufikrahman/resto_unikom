<?php
if (isset($_GET['submit'])) {
    $transaction_id = $_GET['transaction'];
    $query = "SELECT 
    t.id, t.customer_name, t.total, t.created_at, t.status_order, o.id_table, oli.quantity, p.name_product, p.price, p.image
    FROM 
        transactions t
    JOIN 
        orders o ON t.order_id = o.id
    JOIN 
        order_list_items oli ON o.id = oli.order_id
    JOIN 
        products p ON oli.food_id = p.id
    WHERE t.id = '$transaction_id' 
    ORDER BY 
        t.created_at DESC;
";

    $result = mysqli_query($db_conn, $query);
    $rows_transactions = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>
<?php
$tr = "SELECT * FROM transactions WHERE status_order = 'Payment Pending' ";
$result = mysqli_query($db_conn, $tr);
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<div class="d-flex justify-content-between" style="height: 200px;background-color: #357CA5;">
    <h3 class="p-4 text-light">Payment</h3>
</div>

<div class="row g-0 rounded d-flex justify-content-evenly" style="margin-top: -110px;overflow: hidden;">
    <div class="col-12 px-5 rounded shadow-sm" style="height: 700px;">
        <div class="row mb-3">
            <div class="col-8">
                <div class="row mb-3">
                    <div class="border-0">
                        <div class="p-4 pb-2 card rounded-1 shadow-sm border-0">
                            <?php
                            $currentDate = date('d/m/Y');
                            ?>
                            <table>
                                <tr>
                                    <td><label for="date" class="form-label px-3 fw-semibold" style="font-size: 17px;">Date</label></td>
                                    <td class="p-1 w-75"><input type="text" class="form-control" disabled value="<?= $currentDate; ?>" id="date"></td>
                                </tr>
                                <tr>
                                    <td><label for="cashier" class="form-label px-3 fw-semibold" style="font-size: 17px;">Cashier</label></td>
                                    <td class="p-1"><input type="text" class="form-control" disabled value="<?= $_SESSION['name']; ?>" id="cashier"></td>
                                </tr>
                                <tr>
                                    <td><label for="transaction" class="form-label px-3 fw-semibold" style="font-size: 17px;">Transaction</label></td>
                                    <td class="p-1">
                                        <form action="" method="get" class="d-flex">
                                            <input type="hidden" name="q" value="payment">
                                            <select name="transaction" class="form-control" required>
                                                <option value="">-- Choose --</option>
                                                <?php foreach ($rows as $row) : ?>
                                                    <option value="<?= $row['id'] ?>" <?= isset($rows_transactions) && $rows_transactions[0]['id'] == $row['id'] ? 'selected' : '' ?>>
                                                        <?= $row['id']; ?> - <?= $row['customer_name']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <button type="submit" name="submit" class="btn text-white" style="background-color: #357CA5;">
                                                Submit
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="">

                            <form action="./../../models/payment.php" method="post" class="p-4 card rounded-1 shadow-sm border-0 bg-white" id="payment">
                                <input type="hidden" name="id_transaction" value="<?= isset($rows_transactions) ? $rows_transactions[0]['id'] : '' ?>">
                                <table>
                                    <tr>
                                        <td><label for="subtotal" class="form-label px-3 fw-semibold" style="font-size: 17px;">Total</label></td>
                                        <td class="p-1 w-75"><input type="text" class="form-control" disabled value="<?= isset($rows_transactions) ? $rows_transactions[0]['total'] : '0' ?>" id="subtotal"></td>
                                    </tr>
                                    <tr>
                                        <td><label for="cash" class="form-label px-3 fw-semibold" style="font-size: 17px;">Cash</label></td>
                                        <td class="p-1"><input type="number" name="cash" class="form-control" id="cash" required></td>
                                    </tr>
                                    <tr>
                                        <td><label for="change" class="form-label px-3 fw-semibold" style="font-size: 17px;">Change</label></td>
                                        <td class="p-1"><input type="text" class="form-control" name="change" readonly value="" id="change"></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td class="text-end">
                                            <button type="reset" class="btn btn-danger my-4">
                                                <i class="bi bi-cart"></i>
                                                <a href="?q=payment" class="text-decoration-none text-white">Reset</a>
                                            </button>
                                            <button type="button" <?= empty($rows_transactions) ? 'disabled' : '' ?> onclick="confirmPayment('payment')" class="btn text-white my-4" style="background-color: #357CA5;">
                                                <i class="bi bi-cart"></i> Process Payment
                                            </button>
                                        </td>
                                    </tr>
                                </table>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4 bg-white rounded-1 border-0 shadow-sm">
                <div class="row">
                    <div class="col-12">
                        <h3 class="p-3 pb-0 text-dark fw-semibold">List Items</h3>
                        <div class="p-3">
                            <div class="mb-3">
                                <label for="exampleInputText" class="form-label fw-semibold text-body-secondary">Customer Name</label>
                                <input type="text" class="form-control" disabled value="<?= isset($rows_transactions) ? $rows_transactions[0]['customer_name'] : '' ?>" id="exampleInputText" name="name_customer" required placeholder="customer name">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputText2" class="form-label fw-semibold text-body-secondary">No. Table</label>
                                <input type="text" class="form-control" disabled value="<?= isset($rows_transactions) ? $rows_transactions[0]['id_table'] : '' ?>" id="exampleInputText2" name="no_table" required placeholder="no table">
                            </div>
                            <table class="table table-striped mb-4" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <td class="fw-semibold">#</td>
                                        <td class="fw-semibold">Product Item</td>
                                        <td class="fw-semibold">Price</td>
                                        <td class="fw-semibold">Qty</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($rows_transactions)) : ?>
                                        <?php $i = 1; ?>
                                        <?php foreach ($rows_transactions as $row) : ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $row['name_product']; ?></td>
                                                <td><?= $row['price']; ?></td>
                                                <td><?= $row['quantity']; ?></td>
                                            </tr>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="4" class="text-center">
                                                No order list found in transaction
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <table class="mb-5">
                                <colgroup>
                                    <col style="width:1%;">
                                    <col style="width:5%;">
                                    <col style="width:80%;">
                                </colgroup>
                                <tbody>
                                    <tr>
                                        <td class="d-flex justify-content-center align-items-center">
                                            <label for="exampleInputText" class="form-label fw-semibold text-body-secondary">Total</label>
                                        </td>
                                        <td></td>
                                        <td class="d-flex justify-content-center align-items-center">
                                            <input type="text" class="form-control" disabled value="<?= isset($rows_transactions) ? $rows_transactions[0]['total'] : '0' ?>">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('cash').addEventListener('input', function() {
        const subtotalString = document.getElementById('subtotal').value;
        const subtotal = parseFloat(subtotalString);
        const cash = parseFloat(this.value);
        const change = cash - subtotal;
        const changeElement = document.getElementById('change');
        if (isNaN(change)) {
            changeElement.value = '';
        } else if (change < 0) {
            changeElement.value = ' (Insufficient cash)';
        } else {
            changeElement.value = change.toFixed(2);
        }
    });
</script>

<!-- Sweetalert Confirm -->
<script>
    // Function to show SweetAlert confirmation
    function confirmPayment(param) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda tidak akan dapat mengembalikan ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Proses!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika dikonfirmasi, submit form untuk menghapus kategori
                document.querySelector(`#${param}`).submit();
            }
        });
    }
</script>

<?php
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