<div class="d-flex justify-content-between" style="height: 200px;background-color: #357CA5;">
    <h3 class="p-4 text-light">Orders History</h3>
</div>

<div class="row g-0 d-flex justify-content-evenly" style="margin-top: -110px;">
    <div class=" col-sm-12 col-md-11 bg-white shadow-sm rounded pb-3 mb-5 " style="overflow: hidden;min-height: 60vh;">
        <div class="row d-flex justify-content-center">
            <div class="col-11">
                <h4 class="text-light-emphasis fw-semibold pt-4 pb-2">Orders History</h4>
                <table class="table table-bordered" id="exampleOrderlist" style="width:100%;">
                    <thead>
                        <tr>
                            <th class="fw-semibold text-center align-middle">No</th>
                            <th class="fw-semibold text-center align-middle">create at</th>
                            <th class="fw-semibold text-center align-middle">Nama</th>
                            <th class="fw-semibold text-center align-middle">No Table</th>
                            <th class="fw-semibold text-center align-middle">Status</th>
                            <th class="fw-semibold text-center align-middle">Action</th>
                        </tr>
                    </thead>
                    <tbody id="orders-tbody">
                        <!--  -->

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered  modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Order History</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body mb-3">
                <table class="table table-bordered">
                    <tr>
                        <th>Customer</th>
                        <td id="modal-customer"></td>
                        <th>No Table</th>
                        <td id="modal-table"></td>
                    </tr>
                    <tr>
                        <th>Create_at</th>
                        <td id="modal-created-at"></td>
                        <th>Status</th>
                        <td id="modal-status"></td>
                    </tr>
                    <tr>
                        <th>Chef</th>
                        <td id="modal-chef"></td>
                        <th>Waiter</th>
                        <td id="modal-waiter"></td>

                    </tr>
                    <tr>
                        <th>Note</th>
                        <td colspan="4" id="modal-note"></td>
                    </tr>
                    <tr>
                        <th>Products</th>
                        <td colspan="4">
                            <table class="table m-0 p-0" id="modal-products">
                                <tr>
                                    <th>Item</th>
                                    <th>Qty</th>
                                </tr>
                                <!-- Products will be inserted here -->
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Open first modal</button> -->






<script>
    // URL dari API PHP Anda
    const url = <?= json_encode(URL . '/api/order_history.php'); ?>;

    // Fungsi untuk mengambil data dari API menggunakan fetch(url)
    function fetchOrders(url) {
        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                console.log(data);
                displayOrders(data);
                new DataTable('#exampleOrderlist', {
                    paging: true,
                    pageLength: 5,
                    lengthMenu: [5, 10, 25, 50, 100]
                });
            })
            .catch(error => {
                console.error('There has been a problem with your fetch operation:', error);
            });
    }

    // Fungsi untuk menampilkan data orders di dalam tbody#orders-tbody
    function displayOrders(orders) {
        const ordersTbody = document.getElementById('orders-tbody');
        ordersTbody.innerHTML = '';
        let i = 1;

        orders.forEach(order => {
            ordersTbody.innerHTML += `
            <tr>
                <td class="text-center align-middle">${i}</td>
                <td class="text-center align-middle">${order.created_at}</td>
                <td class="text-center align-middle">${order.customer_name}</td>
                <td class="text-center align-middle">${order.id_table}</td>
                <td class="text-center align-middle">
                    <div class="d-inline-flex align-items-center text-success fw-semibold badge fs-6" style="background-color: #D7F4DE; padding: 8px;">
                        <i class="bi bi-circle-fill text-success me-2" style="font-size:12px;"></i>
                        <span class="flex-grow-1">${order.status_order}</span>
                    </div>
                </td>
                <td class="text-center align-middle">
                    <button type="button" class="btn" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" style="background-color:#357CA5;cursor:pointer;" onclick='showOrderDetails(${JSON.stringify(order)})'>
                        <i class="text-white bi bi-eye-fill"></i>
                    </button>
                </td>
            </tr>
        `;
            i++;
        });
    }
    // Fungsi untuk menampilkan detail order di dalam modal
    function showOrderDetails(order) {
        document.getElementById('modal-customer').innerText = order.customer_name;
        document.getElementById('modal-table').innerText = order.id_table;
        document.getElementById('modal-created-at').innerText = order.created_at;
        document.getElementById('modal-status').innerText = order.status_order;
        document.getElementById('modal-note').innerText = order.note;
        document.getElementById('modal-chef').innerText = order.chef_name;
        document.getElementById('modal-waiter').innerText = order.waiter_name;

        const productsTable = document.getElementById('modal-products');
        productsTable.innerHTML = `
        <tr>
            <th>Item</th>
            <th>Qty</th>
        </tr>
    `;

        order.order_list_items.forEach(item => {
            productsTable.innerHTML += `
            <tr>
                <td>${item.name_product}</td>
                <td>${item.quantity}</td>
            </tr>
        `;
        });
    }

    // Panggil fungsi fetchOrders saat halaman dimuat
    document.addEventListener('DOMContentLoaded', () => fetchOrders(url));
    new DataTable('#example4', {
        paging: true, // Aktifkan paging (default: true)
        pageLength: 5, // Jumlah entri per halaman (default: 10)
        lengthMenu: [5, 10, 25, 50, 100] // Pilihan jumlah entri per halaman
    });
</script>