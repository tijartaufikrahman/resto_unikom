<?php
require_once __DIR__ . '../../../../config/config.php';
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
    echo 'window.location.href="' . URL . '/views/admin/index.php?q=serve-food-and-drinks";';
    echo '</script>';
    exit();
}



?>

<style>
    .accordion-button:not(.collapsed) {
        background-color: #fff;
    }
</style>


<div class="d-flex justify-content-between" style="height: 200px;background-color: #357CA5;">
    <h3 class="p-4 text-light">Serve Food And Drinks</h3>
</div>

<div class="row g-0 px-5 " style="margin-top: -110px;">
    <div class=" offset-1 col-10 bg-white shadow-sm rounded pb-3  " style="overflow: hidden;min-height: 60vh;">
        <div class="row">
            <div class="col-lg-5">
                <form action="" method="GET" class="input-group p-4">
                    <input type="hidden" name="q" value="serve-food-and-drinks">
                    <input type="text" class="form-control" name="searchOrder" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button type="submit" class="input-group-text text-white rounded-0 rounded-end px-4 fs-5" style="background-color: #357CA5; padding: 10px 0;">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>




        <!-- PEsanan SIap ANtar -->
        <div class="row mb-5">
            <div class="offset-1 col-10 shadow-sm  rounded" style="overflow: hidden;">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item border-0">
                        <div class="accordion-header" style="position: relative; margin-left:-20px;">
                            <div class="accordion-button collapsed " data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1" style="cursor: pointer">
                                <h4 class="fw-semibold text-body-secondary">- Pesanan Siap Diantarkan -</h4>
                            </div>
                        </div>

                        <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="heading1">
                            <div id="orders-done" class="col-md-12">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End PEsanan SIap ANtar -->




        <!-- PEsanan Disiapkan -->
        <div class="row mb-5">
            <div class="offset-1 col-10 shadow-sm  rounded" style="overflow: hidden;">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item border-0">
                        <div class="accordion-header" style="position: relative; margin-left:-20px;">
                            <div class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2" style="cursor: pointer">
                                <h4 class="fw-semibold text-body-secondary">- Pesanan Sedang Di Siapkan -</h4>
                            </div>
                        </div>
                        <div id="collapse2" class="accordion-collapse collapse show" aria-labelledby="heading1">
                            <div id="in-proses" class="col-md-12">






                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Of Disipkan -->



        <!-- PEsanan ANtrian -->
        <div class="row mb-5">
            <div class="offset-1 col-10 shadow-sm  rounded" style="overflow: hidden;">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item border-0">
                        <div class="accordion-header" style="position: relative; margin-left:-20px;">
                            <div class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3" style="cursor: pointer">
                                <h4 class="fw-semibold text-body-secondary">- Pesanan Sedang Dalam Antrian -</h4>
                            </div>
                        </div>
                        <div id="collapse3" class="accordion-collapse collapse show" aria-labelledby="heading1">
                            <div id="orders-pending" class="col-md-12">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Of PEsanan ANtrian -->

        <!-- Pesanan kosong -->
        <!-- <div class="row mb-5">
            <div class="offset-1 col-10 shadow-sm  rounded" style="overflow: hidden;">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item border-0">
                        <div class="accordion-header" style="position: relative; margin-left:-20px;">
                            <div class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapse_available" aria-expanded="false" aria-controls="collapse_available" style="cursor: pointer">
                                <h4 class="fw-semibold text-body-secondary">- Pesanan Available -</h4>
                            </div>
                        </div>
                        <div id="collapse_available" class="accordion-collapse collapse show" aria-labelledby="heading1">
                            <div id="product-available" class="col-md-12">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- End Of Pesanan kosong -->











        <!-- PEsanan Selesai -->
        <div class="row mb-5">
            <div class="offset-1 col-10 shadow-sm  rounded" style="overflow: hidden;">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item border-0">
                        <div class="accordion-header" style="position: relative; margin-left:-20px;">
                            <div class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4" style="cursor: pointer">
                                <h4 class="fw-semibold text-body-secondary">- Histori Pesanan -</h4>
                            </div>
                        </div>
                        <div id="collapse4" class="accordion-collapse collapse show" aria-labelledby="heading1">
                            <div id="orders-selesai" class="col-md-12">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Of PEsanan Selesai -->
    </div>
</div>




<!-- Done -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // const url = 'http://localhost/resto_unikom/resources/api/waiter_done.php';
        const url = <?= json_encode(URL . '/api/waiter_done.php'); ?>;
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
            const ordersTableBody = document.getElementById('orders-done');
            ordersTableBody.innerHTML = '';

            if (orders.length === 0) {
                // No orders found, display a message or simply return
                ordersTableBody.insertAdjacentHTML('beforeend', '<p class="text-center">No completed orders found.</p>');
                return;
            }

            let orderTable = `<table class="  table-bordered table ">
            <colgroup>
                        <col style="width: 10%">                        
                        <col style="width: 40%">                        
                        <col style="width: 10%">                        
                        <col style="width: 20%">                        
                        <col style="width: 20%">                        
                    </colgroup>
                    <thead style="color:#586161;">
                        <tr>
                            <th scope="col" class="text-center" scope="col">No</th>
                            <th scope="col" class="text-center" scope="col">Nama</th>
                            <th scope="col" class="text-center" scope="col">No Table</th>
                            <th scope="col" class="text-center" scope="col">Status</th>
                            <th scope="col" class="text-center" scope="col">Action</th>
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
                            <div class="d-inline-flex align-items-center text-info fw-semibold badge fs-6" style="background-color: #ECFAFD; padding: 8px;">
                                <i class="fas fa-circle text-info me-2" style="font-size:10px;"></i>
                                <span class=" flex-grow-1">${order.status_order}</span>
                            </div>
                        </td>




                        <td class="text-center align-middle d-flex justify-content-center">                            
                            <button type="button" class="btn me-1 " style="background-color:#357CA5;cursor:pointer;" data-bs-toggle="collapse" data-bs-target="#flush-collapse1${order.id+order.customer_name+order.id_table}" aria-expanded="false" aria-controls="flush-collapse1${order.id+order.customer_name+order.id_table}">
                                <i class=" text-white bi bi-eye-fill"  ></i>                            
                            </button>                            
                            <form action="./../../models/P_order_completed.php" method="post" id="form_${order.order_id}">
                                <input type="hidden" value="${order.order_id}" name="order_id">
                                <button type="button" onclick="confirmOrder(${order.order_id})" class="btn btn-success" style="cursor:pointer;" data-id="${order.order_id}">
                                    <i class=" text-white bi bi-check-circle-fill"></i> ${order.order_id}
                                </button>
                            </form>                           
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" id="flush-collapse1${order.id+order.customer_name+order.id_table}" class="bg-light collapse" data-bs-parent="#accordionFlushExample">
                            <div class="offset-1 col-8">
                                <table class="table-bordered table bg-white">
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

<!-- End Of Done -->





<!-- In Proses -->
<script>
    document.addEventListener("DOMContentLoaded", function() {

        // const url = 'http://localhost/resto_unikom/resources/api/waiter_in_proses.php';
        const url = <?= json_encode(URL . '/api/waiter_in_proses.php'); ?>;

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
            const ordersTableBody = document.getElementById('in-proses');
            ordersTableBody.innerHTML = '';

            if (orders.length === 0) {
                // No orders found, display a message or simply return
                ordersTableBody.insertAdjacentHTML('beforeend', '<p class="text-center">No orders in process found.</p>');
                return;
            }

            let orderTable = `<table class="table-bordered table ">
                    <colgroup>
                        <col style="width: 10%">                        
                        <col style="width: 40%">                        
                        <col style="width: 10%">                        
                        <col style="width: 20%">                        
                        <col style="width: 20%">                        
                    </colgroup>
                    <thead style="color:#586161;">
                        <tr>
                            <th scope="col" class="text-center" scope="col">No</th>
                            <th scope="col" class="text-center" scope="col">Nama</th>
                            <th scope="col" class="text-center" scope="col">No Table</th>
                            <th scope="col" class="text-center" scope="col">Status</th>
                            <th scope="col" class="text-center" scope="col">Action</th>
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
                                <i class="fas fa-circle text-warning me-2"style="font-size:10px;"></i>
                                <span class="flex-grow-1">${order.status_order}</span>
                            </div>
                        </td>
                        <td class="text-center align-middle">                            
                            <button type="button" class="btn " style="background-color:#357CA5;cursor:pointer;" data-bs-toggle="collapse" data-bs-target="#flush-collapse1${order.id+order.customer_name+order.id_table}" aria-expanded="false" aria-controls="flush-collapse1${order.id+order.customer_name+order.id_table}">
                                <i class=" text-white bi bi-eye-fill"  ></i>                            
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" id="flush-collapse1${order.id+order.customer_name+order.id_table}" class="bg-light collapse" data-bs-parent="#accordionFlushExample">
                            <div class="offset-1 col-8">
                                <table class="table-bordered table bg-white">
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









<!-- Pending -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // const url = 'http://localhost/resto_unikom/resources/api/waiter_pending.php';
        const url = <?= json_encode(URL . '/api/waiter_pending.php'); ?>;
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
            const ordersTableBody = document.getElementById('orders-pending');
            ordersTableBody.innerHTML = '';

            if (orders.length === 0) {
                // No orders found, display a message or simply return
                ordersTableBody.insertAdjacentHTML('beforeend', '<p class="text-center">No pending orders found.</p>');
                return;
            }

            let orderTable = `<table class="table-bordered table ">
            <colgroup>
                        <col style="width: 10%">                        
                        <col style="width: 40%">                        
                        <col style="width: 10%">                        
                        <col style="width: 20%">                        
                        <col style="width: 20%">                        
                    </colgroup>
                    <thead style="color:#586161;">
                        <tr>
                            <th scope="col" class="text-center" scope="col">No</th>
                            <th scope="col" class="text-center" scope="col">Nama</th>
                            <th scope="col" class="text-center" scope="col">No Table</th>
                            <th scope="col" class="text-center" scope="col">Status</th>
                            <th scope="col" class="text-center" scope="col">Action</th>
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
                        <td class="text-center align-middle">
                            <div class="d-inline-flex align-items-center text-body-secondary fw-semibold badge fs-6" style="background-color: #E6E6E5; padding: 8px;">
                                    <i class="fas fa-circle text-text-body-secondary me-2"style="font-size:10px;"></i>
                                    <span class="flex-grow-1">${order.status_order}</span>
                                </div>
                        </td>  
                        <td class=" d-flex align-middle justify-content-center">                            
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
                    </tr>
                    <tr>
                        <td colspan="5" id="flush-collapse1${order.id+order.customer_name+order.id_table}" class="bg-light collapse" data-bs-parent="#accordionFlushExample">
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
<!-- End Of Pending -->

<!-- Product Available -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // const url = 'http://localhost/resto_unikom/resources/api/waiter_pending.php';
        const url = <?= json_encode(URL . '/api/waiter_available.php'); ?>;
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
            const ordersTableBody = document.getElementById('product-available');
            ordersTableBody.innerHTML = '';

            if (orders.length === 0) {
                // No orders found, display a message or simply return
                ordersTableBody.insertAdjacentHTML('beforeend', '<p class="text-center">No pending orders found.</p>');
                return;
            }

            let orderTable = `<table class="table-bordered table table-warning ">
            <colgroup>
                        <col style="width: 10%">                        
                        <col style="width: 35%">                        
                        <col style="width: 10%">                        
                        <col style="width: 20%">                        
                        <col style="width: 25%">                        
                    </colgroup>
                    <thead>
                        <tr class="">
                            <th scope="col" class="text-center" scope="col">No</th>
                            <th scope="col" class="text-center" scope="col">Nama</th>
                            <th scope="col" class="text-center" scope="col">No Table</th>
                            <th scope="col" class="text-center" scope="col">Status</th>
                            <th scope="col" class="text-center" scope="col">Action</th>
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
                        <td class="text-center align-middle">
                            <div class="d-inline-flex align-items-center text-body-secondary fw-semibold badge fs-6" style="background-color: #FFFBEE; padding: 8px;">
                                    <i class="fas fa-circle text-warning me-2"style="font-size:10px;"></i>
                                    <span class="flex-grow-1">${order.status_order}</span>
                                </div>
                        </td>  
                        <td class=" d-flex align-middle justify-content-center">                            
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

                            <form action="" method="post" class="ms-1" id="#delete_pending">
                                <button type="button" class="btn bg-success" style="cursor:pointer;" data-bs-toggle="collapse" data-bs-target="#flush-collapse1${order.id+order.customer_name+order.id_table}" aria-expanded="false" aria-controls="flush-collapse1${order.id+order.customer_name+order.id_table}">                                
                                    <i class=" text-white bi bi-pencil"></i>
                                </button>
                            <form>
                            <button type="button" class="btn bg-warning" style="cursor:pointer;" data-bs-toggle="collapse" data-bs-target="#flush-collapse1${order.id+order.customer_name+order.id_table}" aria-expanded="false" aria-controls="flush-collapse1${order.id+order.customer_name+order.id_table}">                                
                                <i class=" text-white bi bi-exclamation-square-fill"></i>
                            </button>
                            
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" id="flush-collapse1${order.id+order.customer_name+order.id_table}" class="bg-light collapse" data-bs-parent="#accordionFlushExample">
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
<!-- ENDProduct Available -->


<!-- <?php $url = 'http://localhost/resto_unikom/resources/api/waiter_selesai.php'; ?> -->

<!-- Selesai -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const url = <?= json_encode(URL . '/api/waiter_selesai.php'); ?>;

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
            const ordersTableBody = document.getElementById('orders-selesai');
            ordersTableBody.innerHTML = '';

            if (orders.length === 0) {
                // No orders found, display a message or simply return
                ordersTableBody.insertAdjacentHTML('beforeend', '<p class="text-center">No orders found.</p>');
                return;
            }

            let orderTable = `<table class="table-bordered table ">
            <colgroup>
                        <col style="width: 10%">                        
                        <col style="width: 19%">                        
                        <col style="width: 31%">                      
                        <col style="width: 10%">                    
                        <col style="width: 15%">                  
                        <col style="width: 15%">                        
                    </colgroup>
                    <thead style="color:#586161;">
                        <tr>
                            <th scope="col" class="text-center" scope="col">No</th>
                            <th scope="col" class="text-center" scope="col">Create_at</th>
                            <th scope="col" class="text-center" scope="col">Nama</th>
                            <th scope="col" class="text-center" scope="col">No Table</th>
                            <th scope="col" class="text-center" scope="col">Status</th>
                            <th scope="col" class="text-center" scope="col">Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>`;

            orders.forEach((order, index) => {
                orderTable += `
                    <tr>
                        <td class="text-center">${index + 1}</td>
                        <td class="text- align-middlecenter">${order.order_created_at}</td>
                        <td class="text-center align-middle">
                            ${order.customer_name}
                        </td>
                        <td class="text-center align-middle">${order.id_table}</td>
                        <td class="text-center align-middle" class="text-center align-middle ">
                                <div class="d-inline-flex align-items-center text-success fw-semibold badge fs-6" style="background-color: #D7F4DE; padding: 8px;">
                                    <i class="fas fa-circle text-success me-2" style="font-size:12px;"></i>
                                    <span class="flex-grow-1">${order.status_order}</span>
                                </div>
                        </td>
                        
                        


                        <td class="text-center align-middle">                            
                            <button type="button" class="btn " style="background-color:#357CA5;cursor:pointer;" data-bs-toggle="collapse" data-bs-target="#flush-collapse1${order.id+order.customer_name+order.id_table}" aria-expanded="false" aria-controls="flush-collapse1${order.id+order.customer_name+order.id_table}">
                                <i class=" text-white bi bi-eye-fill"  ></i>                            
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" id="flush-collapse1${order.id+order.customer_name+order.id_table}" class="bg-light collapse" data-bs-parent="#accordionFlushExample">
                            <div class="offset-1 col-8">
                                <table class="table-bordered table bg-white">
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

<!-- End Of Selesai -->



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

<!-- End Sweetalert -->

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