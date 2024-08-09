<?php require_once __DIR__ . "/../../../models/transactions_report.php"; ?>


<?php
$query = "SELECT * FROM transactions WHERE status_order = 'Payment Pending' ORDER BY created_at DESC";
$result = mysqli_query($db_conn, $query);
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
// var_dump($rows);

$id_user = $_SESSION['id'];

if ($_SESSION['role'] == 'administrator') {
    $whare = '';
} else {
    $whare = "AND id_user = '$id_user'";
}

$query2 = "SELECT * FROM transactions WHERE status_order = 'Paid' $whare  ORDER BY created_at DESC";

// echo $query2;
$result2 = mysqli_query($db_conn, $query2);
$rows2 = mysqli_fetch_all($result2, MYSQLI_ASSOC);
// var_dump($rows2);



$query3 = "SELECT * FROM transactions WHERE status_order = 'Paid' $whare  ORDER BY created_at DESC";

// echo $query2;
$result3 = mysqli_query($db_conn, $query3);
$rows3 = mysqli_fetch_all($result3, MYSQLI_ASSOC);
// var_dump($rows2);

?>



<div class="d-flex justify-content-between" style="height: 200px;background-color: #357CA5;">
    <h3 class="p-4 text-light">Transaction Report</h3>
</div>

<div class="row g-0 px-5" style="margin-top: -110px;">
    <div class="col-12 pb-3 mb-5" style="min-height: 60vh;">

        <div class="row bg-white p-4 shadow-sm rounded mb-4" style="overflow: hidden;">
            <div class="col-12">
                <h3 class="p-1 pb-4 fw-semibold text-body-secondary">Paid Transactions</h3>
                <div>
                    <table class="table table-bordered" style="width: 100%;" id="exampleTf2">
                        <thead>
                            <tr>
                                <th class="fw-semibold">#</th>
                                <th class="fw-semibold">Invoice</th>
                                <th class="fw-semibold text-start">Created_at</th>
                                <th class="fw-semibold">Customer</th>
                                <th class="fw-semibold">Total</th>
                                <th class="fw-semibold">Status</th>
                                <th class="fw-semibold">Action</th>
                            </tr>
                        </thead>
                        <tbody id="transactions_unpaid">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row bg-white p-4 shadow-sm rounded mb-4" style="overflow: hidden;">
            <div class="col-12">
                <h3 class="p-1 pb-4 fw-semibold text-body-secondary">Paid Transactions</h3>
                <div>
                    <table class="table table-bordered" style="width: 100%;" id="exampleTf3">
                        <thead>
                            <tr>
                                <th class="fw-semibold">#</th>
                                <th class="fw-semibold">Invoice</th>
                                <th class="fw-semibold">Date</th>
                                <th class="fw-semibold">Customer</th>
                                <th class="fw-semibold">Total</th>
                                <th class="fw-semibold">Status</th>
                                <th class="fw-semibold">Action</th>
                            </tr>
                        </thead>
                        <tbody id="transactions_paid">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



    </div>
</div>

<div id="modals"></div>
<div id="modals2"></div>


<script>
    function printContent(id) {
        // URL of the file to print
        const fileUrl = `transactionReport/print_content.php?id=${id}`;

        // Create a new window for printing
        const printWindow = window.open(fileUrl, '', 'height=600,width=800');
        printWindow.onload = function() {
            printWindow.print(); // Print the content
            // Optionally close the window after printing
            printWindow.onafterprint = function() {
                printWindow.close();
            };
        };
    }
</script>


<script>
    document.addEventListener("DOMContentLoaded", function() {

        const url = <?= json_encode(URL . '/api/transaction_resport_unpaid.php'); ?>;
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
            const transactionsContainer = document.getElementById('transactions_unpaid');
            transactionsContainer.innerHTML = orders.map((order, index) => `
        <tr>
            <td>${index + 1}</td>
            <td>${order.id}</td>
            <td class='text-start'>${order.created_at}</td>
            <td>${order.customer_name}</td>
            <td>${order.total}</td>
            <td>${order.status_order}</td>
            <td class="align-middle">
                <div class="d-flex justify-content-center">
                    <button type="button" class="btn me-1" style="background-color:#357CA5; cursor:pointer;" data-bs-toggle="modal" data-bs-target="#modal${order.id}">
                        <i class="text-white bi bi-eye-fill"></i>
                    </button>
                    <button type="button" class="btn bg-success me-1" onclick="printContent('${order.id}')">
                        <i class="text-white bi bi-printer"></i>
                    </button>
                </div>   
            </td>                                 
        </tr>
    `).join('');

            // Render modals
            const modalsContainer = document.getElementById('modals');
            modalsContainer.innerHTML = orders.map(order => `
        <!-- Modal -->
        <div class="modal fade" id="modal${order.id}" tabindex="-1" aria-labelledby="modalLabel${order.id}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalLabel${order.id}">Transaction Detail ${order.id}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Content here -->                        
                        <table class="table table-bordered" style="width: 100%;">
                            <tr>
                                <td>INVOICE</td>
                                <td>${order.id}</td>
                            </tr>
                            <tr>
                                <td>CUSTOMER</td>
                                <td>${order.customer_name}</td>
                            </tr>
                            <tr>
                                <td>TABLE</td>
                                <td>1</td>
                            </tr>
                        </table>
                        <table class=" table-bordered table ">
                        <tr>
                            <td>Name Product</td>
                            <td>Quantity</td>
                            <td>Price</td>
                            <td>Subtotal</td>
                        </tr>
                            ${order.products.map(product => `
                                <tr>                                    
                                    <td> ${product.name_product}</td>
                                    <td> ${product.quantity}</td>
                                    <td> ${product.price}</td>                                    
                                    <td> ${product.price * product.quantity}</td>                                    

                                </tr>
                            `).join('')}

                        <tr>
                            <td><strong>Total</strong></td>
                            <td colspan="2" class="text-center">Rp ${order.total}</td>
                        </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                        
                    </div>
                </div>
            </div>
        </div>
    `).join('');

            // Initialize DataTable
            new DataTable('#exampleTf2', {
                paging: true,
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50, 100]
            });
        }


        fetchOrdersData();
    });
</script>



<script>
    document.addEventListener("DOMContentLoaded", function() {

        const url = <?= json_encode(URL . '/api/transaction_resport_paid.php'); ?>;
        // const url = 'http://localhost/resto_unikom/resources/api/cooking_proses.php';

        async function fetchOrdersData2() {
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
            const transactionsContainer = document.getElementById('transactions_paid');
            transactionsContainer.innerHTML = orders.map((order, index) => `
        <tr>
            <td>${index + 1}</td>
            <td>${order.id}</td>
            <td>${order.date}</td>
            <td>${order.customer_name}</td>
            <td>${order.total}</td>
            <td>${order.status_order}</td>
            <td class="align-middle">
                <div class="d-flex justify-content-center">
                    <button type="button" class="btn me-1" style="background-color:#357CA5; cursor:pointer;" data-bs-toggle="modal" data-bs-target="#modal${order.id}">
                        <i class="text-white bi bi-eye-fill"></i>
                    </button>
                    <button type="button" class="btn bg-success me-1" onclick="printContent('${order.id}')">
                        <i class="text-white bi bi-printer"></i>
                    </button>
                </div>   
            </td>                                 
        </tr>
    `).join('');

            // Render modals
            const modalsContainer = document.getElementById('modals2');
            modalsContainer.innerHTML = orders.map(order => `
        <!-- Modal -->
        <div class="modal fade" id="modal${order.id}" tabindex="-1" aria-labelledby="modalLabel${order.id}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalLabel${order.id}">Transaction Detail ${order.id}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Content here -->                        
                        <table class="table table-bordered" style="width: 100%;">
                            <tr>
                                <td>INVOICE</td>
                                <td>${order.id}</td>
                            </tr>
                            <tr>
                                <td>CUSTOMER</td>
                                <td>${order.customer_name}</td>
                            </tr>
                            <tr>
                                <td>TABLE</td>
                                <td>1</td>
                            </tr>
                        </table>
                        <table class=" table-bordered table ">
                        <tr>
                            <td>Name Product</td>
                            <td>Quantity</td>
                            <td>Price</td>
                            <td>Subtotal</td>
                        </tr>
                            ${order.products.map(product => `
                                <tr>                                    
                                    <td> ${product.name_product}</td>
                                    <td> ${product.quantity}</td>
                                    <td> ${product.price}</td>                                    
                                    <td> ${product.price * product.quantity}</td>                                    

                                </tr>
                            `).join('')}

                        <tr>
                            <td><strong>Total</strong></td>
                            <td colspan="2" class="text-center">Rp ${order.total}</td>
                        </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                        
                    </div>
                </div>
            </div>
        </div>
    `).join('');

            // Initialize DataTable
            new DataTable('#exampleTf3', {
                paging: true,
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50, 100]
            });
        }


        fetchOrdersData2();
    });
</script>