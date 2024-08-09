<?php
if (isset($_POST['delete_pending_id'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM orders WHERE id = $id;";
    $sql .= "DELETE FROM order_list_items WHERE order_id = $id;";
    $sql .= "DELETE FROM transactions WHERE order_id = $id;";

    if (mysqli_multi_query($db_conn, $sql)) {
        // Jika berhasil, set session success
        $_SESSION['alert'] = array(
            'type' => 'success',
            'message' => 'Delete successfully.'
        );
    } else {
        // Jika terjadi kesalahan saat query, set session error
        $_SESSION['alert'] = array(
            'type' => 'error',
            'message' => 'Failed to add category.'
        );
    }

    echo '<script type="text/javascript">';
    echo 'window.location.href="http://localhost/resto_unikom/resources/views/admin/index.php?q=orderhandling-food-preparation";';
    echo '</script>';
    exit();
}


?>

<div class="d-flex justify-content-between" style="height: 200px;background-color: #357CA5;">
    <h3 class="p-4 text-light">Order & Kitchen</h3>
</div>

<div class="row g-0 px-5" style="margin-top: -110px;">
    <div class="col-12 bg-white shadow-sm rounded pb-3 mb-5" style="overflow: hidden;min-height: 60vh;">
        <div class="row d-flex justify-content-center">
            <div class="col-11">
                <h4 class="text-light-emphasis fw-semibold pt-4 pb-2">Daftar Order Masuk</h4>

                <div id="cooking-pending">
                    <!-- API -->
                </div>

            </div>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-11">
                <h4 class="text-light-emphasis fw-semibold pt-4 pb-2">Order In Proses</h4>

                <div id="cooking-in-proses">
                    <!-- API -->
                </div>

            </div>
        </div>
    </div>


</div>


<!--  -->
<!-- <td class="text-center align-middle">
    <form action="./../../models/Q_update_proses.php" method="post" id="form_${order.order_id}">
        <input type="hidden" value="${order.order_id}" name="order_id">
        <button type="button" onclick="confirmOrder(${order.order_id})" class="btn btn-info text-white" style="cursor:pointer;" data-id="${order.order_id}">
            <i class="text-white bi bi-check-circle-fill"></i> Pilih
        </button>
    </form>
</td> -->
<!--  -->

<!--  -->

<!--  -->




<!-- Pending -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const url = <?= json_encode(URL . '/api/cooking.php'); ?>;
        // const url = 'http://localhost/resto_unikom/resources/api/cooking.php';

        async function fetchOrdersData() {
            try {
                const response = await fetch(url);
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                const data = await response.json();
                renderOrders(data);
            } catch (error) {
                console.error('Fetch error:', error);
            }
        }

        function renderOrders(orders) {
            const ordersTableBody = document.getElementById('cooking-pending');
            ordersTableBody.innerHTML = '';

            if (orders.length === 0) {
                // No orders found, display a message or simply return
                ordersTableBody.insertAdjacentHTML('beforeend', '<p class="text-center">No pending orders found.</p>');
                return;
            }

            let orderTable = `<table class="table-bordered table ">
                    <colgroup>
                        <col style="width: 5%">
                        <col style="width: 21%">
                        <col style="width: 10%">
                        <col style="width: 21%">
                        <col style="width: 21%">
                        <col style="width: 21%">
                    </colgroup>
                    <thead style="color:#586161;">
                        <tr>
                            <th scope="col" class="text-center fw-semibold" scope="col">No</th>
                            <th scope="col" class="text-center fw-semibold" scope="col">Nama</th>
                            <th scope="col" class="text-center fw-semibold" scope="col">No Table</th>
                            <th scope="col" class="text-center fw-semibold" scope="col">Status</th>
                            <th scope="col" class="text-center fw-semibold" scope="col">Action</th>
                            <th scope="col" class="text-center fw-semibold" scope="col">Validasi</th>
                        </tr>
                    </thead>
                    <tbody>`;

            orders.forEach((order, index) => {
                orderTable += `
                    <tr>
                        <td class="text-center align-middle">${index + 1}</td>
                        <td class="text-center align-middle">
                            ${order.customer_name}
                        </td>
                        <td class="text-center align-middle">${order.id_table}</td>

                        <td class="text-center align-middle ">
                                <div class="d-inline-flex align-items-center text-body-secondary fw-semibold badge fs-6" style="background-color: #E6E6E5; padding: 8px;">
                                    <i class="fas fa-circle text-text-body-secondary me-2" style="font-size:12px;"></i>
                                    <span class="flex-grow-1">${order.status_order}</span>
                                </div>
                            </td>

                        <td class="d-flex justify-content-center">                            
                            <button type="button" class="btn " style="background-color:#357CA5;cursor:pointer;" data-bs-toggle="collapse" data-bs-target="#flush-collapse1${order.id+order.customer_name+order.id_table}" aria-expanded="false" aria-controls="flush-collapse1${order.id+order.customer_name+order.id_table}">
                                <i class=" text-white bi bi-eye-fill"  ></i>                            
                            </button>
                            
                            <form action="" method="post" class="ms-1" id="#delete_pending">
                                <input type="hidden" value="${order.order_id}" name="id">
                                <input type="hidden" value="${order.order_id}" name="delete_pending_id">
                                <button type="button"  onclick="confirmDelete('delete_pending')" class="btn btn-danger delete-button" data-id="${order.order_id}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>



                        </td>
                        <td class="text-center align-middle">
                            <form action="./../../models/Q_update_proses.php" method="post" id="form_${order.order_id}">
                                <input type="hidden" value="${order.order_id}" name="order_id">
                                <button type="button" onclick="confirmOrder(${order.order_id})" class="btn btn-info text-white" style="cursor:pointer;" data-id="${order.order_id}">
                                    <i class="text-white bi bi-check-circle-fill"></i> Pilih
                                </button>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" id="flush-collapse1${order.id+order.customer_name+order.id_table}" class="bg-light collapse" data-bs-parent="#accordionFlushExample">
                            <div class="offset-1 col-8" style="overflow:hidden;"> 
                                <table class="table-bordered table bg-white ">
                                    <thead style="color:#586161;">
                                        <tr class="table-light">
                                            <th class="fw-semibold text-center text-body-secondary">No</th>
                                            <th class="fw-semibold text-center text-body-secondary">Image</th>
                                            <th class="fw-semibold text-center text-body-secondary">Name</th>
                                            <th class="fw-semibold text-center text-body-secondary">Price</th>
                                            <th class="fw-semibold text-center text-body-secondary">Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        ${order.items.map((item, i) => `
                                        <tr>
                                            <td class="text-center align-middle">${i + 1}</td>
                                            <td class="text-center align-middle"><img src="./../../../public/img/${item.product_image}" class="rounded" width="70" height="60" alt=""></td>
                                            <td class="text-center align-middle" style="font-size:14px;">${item.name_product}</td>
                                            <td class="text-center align-middle">Rp ${item.product_price}</td>
                                            <td class="text-center align-middle">${item.quantity}</td>
                                        </tr>
                                        `).join('')}

                                        <tr>
                                            <td class="text-bold text-center">Note</td>
                                            <td class=" text-center" colspan="4"><span class="text-bold"> ${order.order_note}</span></td>
                                        </tr>
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>`;
            });

            orderTable += `
            
            
            
            </tbody></table>`;
            ordersTableBody.insertAdjacentHTML('beforeend', orderTable);
        }

        fetchOrdersData();
    });
</script>
<!-- End Of Pending -->

<!-- Product Available -->
<!-- ENDProduct Available -->




<!-- In Proses -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const url = <?= json_encode(URL . '/api/cooking_proses.php'); ?>;
        // const url = 'http://localhost/resto_unikom/resources/api/cooking_proses.php';

        async function fetchOrdersData() {
            try {
                const response = await fetch(url);
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                const data = await response.json();
                renderOrders(data);
            } catch (error) {
                console.error('Fetch error:', error);
            }
        }

        function renderOrders(orders) {
            const ordersTableBody = document.getElementById('cooking-in-proses');
            ordersTableBody.innerHTML = '';

            if (orders.length === 0) {
                // No orders found, display a message or simply return
                ordersTableBody.insertAdjacentHTML('beforeend', '<p class="text-center">No orders in proses found.</p>');
                return;
            }

            let orderTable = `<table class="table-bordered table ">
                    <colgroup>
                        <col style="width: 5%">
                        <col style="width: 21%">
                        <col style="width: 10%">
                        <col style="width: 21%">
                        <col style="width: 21%">
                        <col style="width: 21%">
                    </colgroup>
                    <thead style="color:#586161;">
                        <tr>
                            <th scope="col" class="text-center fw-semibold" scope="col">No</th>
                            <th scope="col" class="text-center fw-semibold" scope="col">Nama</th>
                            <th scope="col" class="text-center fw-semibold" scope="col">No Table</th>
                            <th scope="col" class="text-center fw-semibold" scope="col">Status</th>
                            <th scope="col" class="text-center fw-semibold" scope="col">Action</th>
                            <th scope="col" class="text-center fw-semibold" scope="col">Validasi</th>
                        </tr>
                    </thead>
                    <tbody>`;

            orders.forEach((order, index) => {
                orderTable += `
                    <tr>
                        <td class="text-center align-middle">${index + 1}</td>
                        <td class="text-center align-middle">
                            ${order.customer_name}
                        </td>
                        <td class="text-center align-middle">${order.id_table}</td>                        
                        <td class="text-center align-middle ">
                            <div class="d-inline-flex align-items-center text-warning fw-semibold badge fs-6" style="background-color: #FDF6E4; padding: 8px;">
                                <i class="fas fa-circle text-warning me-2" style="font-size:12px;"></i>
                                <span class="flex-grow-1">${order.status_order}</span>
                            </div>
                        </td>

                        <td class="d-flex justify-content-center">                            
                            <button type="button" class="btn " style="background-color:#357CA5;cursor:pointer;" data-bs-toggle="collapse" data-bs-target="#flush-collapse1${order.id+order.customer_name+order.id_table}" aria-expanded="false" aria-controls="flush-collapse1${order.id+order.customer_name+order.id_table}">
                                <i class=" text-white bi bi-eye-fill"  ></i>                            
                            </button>
                            <form action="" method="post" class="ms-1" id="#delete_pending">
                                <input type="hidden" value="${order.order_id}" name="id">
                                <input type="hidden" value="${order.order_id}" name="delete_pending_id">
                                <button type="button"  onclick="confirmDelete('delete_pending')" class="btn btn-danger delete-button" data-id="${order.order_id}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                        <td class="text-center align-middle">
                            <form action="./../../models/Q_update_done.php" method="post" id="form_${order.order_id}">
                                <input type="hidden" value="${order.order_id}" name="order_id">
                                <button type="button" onclick="confirmOrder(${order.order_id})" class="btn btn-success " style="cursor:pointer;" data-id="${order.order_id}">
                                    <i class=" text-white bi bi-check-circle-fill"></i> Done
                                </button>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" id="flush-collapse1${order.id+order.customer_name+order.id_table}" class="bg-light collapse" data-bs-parent="#accordionFlushExample">
                            <div class="offset-1 col-8" style="overflow:hidden;"> 
                                <table class="table-bordered table bg-white ">
                                    <thead style="color:#586161;">
                                        <tr class="table-light">
                                            <th class="fw-semibold text-center text-body-secondary">No</th>
                                            <th class="fw-semibold text-center text-body-secondary">Image</th>
                                            <th class="fw-semibold text-center text-body-secondary">Name</th>
                                            <th class="fw-semibold text-center text-body-secondary">Price</th>
                                            <th class="fw-semibold text-center text-body-secondary">Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        ${order.items.map((item, i) => `
                                        <tr>
                                            <td class="text-center align-middle">${i + 1}</td>
                                            <td class="text-center align-middle"><img src="./../../../public/img/${item.product_image}" class="rounded" width="70" height="60" alt=""></td>
                                            <td class="text-center align-middle" style="font-size:14px;">${item.name_product}</td>
                                            <td class="text-center align-middle">Rp ${item.product_price}</td>
                                            <td class="text-center align-middle">${item.quantity}</td>
                                        </tr>
                                        `).join('')}
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>`;
            });

            orderTable += `</tbody></table>`;
            ordersTableBody.insertAdjacentHTML('beforeend', orderTable);
        }

        fetchOrdersData();
    });
</script>
<!-- End Of In Proses -->







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


<script>
    // Function to show SweetAlert confirmation
    function confirmOrder(order) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda tidak akan dapat mengembalikan ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28a745', // Warna hijau
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit form untuk order_id yang sesuai
                document.querySelector(`#form_${order}`).submit();
            }
        });
    }
</script>

<!-- Sweetalert Confirm -->
<script>
    // Function to show SweetAlert confirmation
    function confirmDelete(param) {
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
                // Submit the form with the specific param
                document.getElementById(`#${param}`).submit();
            }
        });
    }
</script>