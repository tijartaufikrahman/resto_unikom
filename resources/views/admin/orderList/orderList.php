<?php
// Tampilkan pesan sukses jika ada
if (isset($_SESSION['success_message'])) {
    echo '<script>';
    echo 'Swal.fire({';
    echo '  icon: "success",';
    echo '  title: "Success",';
    echo '  text: "' . $_SESSION['success_message'] . '"';
    echo '});';
    echo '</script>';

    // Hapus session setelah pesan ditampilkan agar tidak tampil lagi setelah refresh
    unset($_SESSION['success_message']);
} ?>

<style>
    .sold-out-overlay {
        position: relative;
    }

    .sold-out-overlay::before {
        content: "Out of Stock";
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: rgb(173, 87, 96);
        color: white;
        padding: .6em .4em;
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

    .custom-order.expanded {
        min-height: 70vh;
        position: absolute;
        right: 50px;
        /* Atur posisi elemen dari kanan */
        width: 63%;
        /* Lebar div saat diexpanded */
        z-index: 3;
    }

    .custom-scroll::-webkit-scrollbar {
        width: 3px;
        /* Lebar scrollbar */
        height: 8px;
        /* Tinggi scrollbar horizontal */
    }

    .custom-scroll::-webkit-scrollbar-thumb {
        background-color: rgba(168, 168, 168, 0.3);
        /* Warna thumb scrollbar */
        border-radius: 4px;
        /* Sudut bulat pada thumb scrollbar */
    }
</style>

<div class="d-flex justify-content-between" style="height: 200px;background-color: #357CA5;">
    <h3 class="p-4 text-light">Check Order Availability</h3>
</div>

<div class="row g-0 d-flex justify-content-evenly" style="margin-top: -110px;">
    <div class=" col-sm-12 col-md-7 bg-white shadow-sm rounded pb-3  " style="overflow: hidden;min-height: 60vh;">
        <div class="row ">
            <div class="col-lg-5">
                <form action="" method="GET" class="input-group p-4">
                    <input type="hidden" name="q" value="order-list">
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

                    <?php if (isset($check_search)) : ?>
                        <h3 class="text-center p-2 fw-semibold">Search "<?= $check_search ?>"</h3>
                    <?php endif; ?>

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
                                                                    <div class="card border-0">
                                                                        <img src="./../../../public/img/<?= $product['image']; ?>" alt="" class="img-fluid">
                                                                        <div class="card-body">
                                                                            <div>
                                                                                <input id="id_product_<?= $product['product_id']; ?>" type="hidden" value="<?= $product['product_id']; ?>">
                                                                                <h5 class="fw-semibold text-dark" style="font-size: 16px; opacity: 0.85;"><?= $product['name_product'] ?></h5>
                                                                                <h5 class="fw-semibold text-danger" style="font-size: 16px;">Price: Rp <?= $product['price'] ?></h5>
                                                                                <div class="d-flex justify-content-start mt-3">
                                                                                    <button data-id="<?= $product['product_id']; ?>" <?= (isset($product['stok']) && $product['stok'] <= 0) ? 'disabled' : '' ?> class="btn text-center text-white fw-semibold add-to-list" style="background-color: #357CA5;">
                                                                                        Add to list
                                                                                    </button>
                                                                                </div>
                                                                            </div>
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

    <div class="col-sm-12 col-md-4 custom-order bg-white shadow-sm rounded  custom-scroll" style="overflow: auto;position:sticky;top:10vh;height:90vh;">
        <h3 class="fw-semibold text-body-secondary p-4 custom-trigger"><i class="bi bi-list"></i> Order List</h3>
        <div class="row g-0 px-4">
            <div class="col-12">











                <form action="" method="post">
                    <div class="mb-3">
                        <label for="exampleInputText" class="form-label fw-semibold text-body-secondary">Customer Name</label>
                        <input type="text" class="form-control" id="exampleInputText" name="name_customer" required placeholder="Enter the customer's name">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputText2" class="form-label fw-semibold text-body-secondary">No. Table</label>
                        <input type="number" class="form-control" id="exampleInputText2" name="no_table" required placeholder="Enter the customer's name">
                    </div>
                    <div class="row mt-4">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="fw-semibold text-body-secondary">No</th>
                                    <th class="fw-semibold text-body-secondary">Image</th>
                                    <th class="fw-semibold text-body-secondary">Name</th>
                                    <th class="fw-semibold text-body-secondary">Price</th>
                                    <th class="fw-semibold text-body-secondary">Quantity</th>
                                    <th class="fw-semibold text-body-secondary">Action</th>
                                </tr>
                            </thead>
                            <tbody id="order-list-table">
                                <!-- Data akan dimuat di sini secara dinamis -->
                            </tbody>
                        </table>




                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label for="note" class="form-label  fw-semibold text-body-secondary">Note**</label>
                            <textarea id="note" class="note-input form-control rounded" name="note"></textarea>
                        </div>
                    </div>
                    <div id="total" class="row my-3">

                    </div>

                    <div class="row">
                        <div class="col-12 mb-5">
                            <button type="submit" class="btn btn-lg btn-primary">Order Now</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Your existing HTML structure -->

<!-- Your existing HTML structure -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        function fetchData() {
            const url = <?= json_encode(URL . '/api/order_list_items.php'); ?>;
            fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    let tbody = document.getElementById('order-list-table');
                    let totalElement = document.getElementById('total');
                    tbody.innerHTML = ''; // Clear table body before adding new rows

                    let total = 0; // Variable to store total price

                    data.forEach((item, index) => {
                        let subtotal = parseFloat(item.price) * parseInt(item.quantity);
                        total += subtotal; // Add subtotal to total

                        let row = `
                    <input type="hidden" value="${item.id}">
                    <tr>
                        <td class="text-center align-middle">${index + 1}</td>
                        <td class="align-middle"><img src="./../../../public/img/${item.image}" width="70" height="60" alt=""></td>
                        <td class="align-middle" style="font-size:14px;">${item.name_product}</td>
                        <td class="align-middle">Rp ${item.price}</td>
                        <td class="align-middle">
                            <input type="number" class="form-control form-control-sm text-center align-middle quantity-input" data-id="${item.id}" data-price="${item.price}" value="${item.quantity}">
                        </td>
                        <input type="hidden" class="text-center align-middle subtotal-cell" value="Rp ${subtotal.toLocaleString('id-ID')}">
                        <td class="text-center align-middle">
                            <button type="button" class="btn btn-danger delete-button" data-id="${item.id}">
                                <i class="bi bi-trash"></i> 
                            </button>
                        </td>                            
                    </tr>
                `;
                        tbody.insertAdjacentHTML('beforeend', row); // Append row to tbody
                    });

                    // Update total element in HTML
                    totalElement.innerHTML = `
                <div class="col-12 ">
                    <label for="total" class="form-label fw-semibold text-body-secondary">Total</label>
                    <input type="text" id="total" readonly class="form-control" name="total" value="Rp ${total.toLocaleString('id-ID')}">
                </div>
                `;

                    // Add event listeners for quantity inputs
                    document.querySelectorAll('.quantity-input').forEach(input => {
                        input.addEventListener('input', function() {
                            updateQuantityAndTotal(this);
                        });
                    });

                    // Add event listeners for delete buttons
                    document.querySelectorAll('.delete-button').forEach(button => {
                        button.addEventListener('click', function() {
                            let productId = this.getAttribute('data-id');
                            deleteItem(productId);
                        });
                    });
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        }

        function updateQuantityAndTotal(inputElement) {
            let productId = inputElement.dataset.id;
            let newQuantity = parseInt(inputElement.value);
            let price = parseFloat(inputElement.dataset.price);
            let subtotalCell = inputElement.closest('tr').querySelector('.subtotal-cell');

            if (subtotalCell) {
                // Calculate new subtotal
                let newSubtotal = newQuantity * price;
                subtotalCell.textContent = `Rp ${newSubtotal.toLocaleString('id-ID')}`;

                // Update total
                updateTotal();

                // Send updated quantity to server
                updateQuantity(productId, newQuantity);
            } else {
                console.error('Subtotal cell not found');
            }
        }

        function updateTotal() {
            let total = 0;
            document.querySelectorAll('.quantity-input').forEach(input => {
                let price = parseFloat(input.dataset.price);
                let quantity = parseInt(input.value);
                total += price * quantity;
            });

            let totalElement = document.getElementById('total');
            if (totalElement) {
                totalElement.innerHTML = `
            <div class="col-12 ">
                <label for="total" class="form-label fw-semibold text-body-secondary">Total</label>
                <input type="text" id="total" readonly class="form-control" value="Rp ${total.toLocaleString('id-ID')}">
            </div>
            `;
            } else {
                console.error('Total element not found');
            }
        }

        function updateQuantity(productId, newQuantity) {
            const url = <?= json_encode(URL . '/api/update_quantity.php'); ?>;
            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        productId: productId,
                        newQuantity: newQuantity,
                    }),
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    console.log('Quantity updated successfully');
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        function addToOrderList(productId) {
            const url = <?= json_encode(URL . '/api/add_to_list.php'); ?>;
            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        productId: productId,
                    }),
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text();
                })
                .then(data => {
                    console.log('Response from server:', data); // Log server response to console
                    fetchData(); // Refresh the order list data

                    // Display SweetAlert notification
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Item successfully added to the list!',
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }


        function deleteItem(productId) {
            const url = <?= json_encode(URL . '/api/delete_item.php'); ?>;
            if (confirm('Are you sure you want to delete this item?')) {
                fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            productId: productId
                        }),
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.text();
                    })
                    .then(data => {
                        console.log('Item deleted:', data); // Log server response to console
                        fetchData(); // Refresh the order list data
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            } else {
                console.log('Deletion cancelled.'); // Log cancellation
            }
        }

        document.querySelectorAll('.add-to-list').forEach(button => {
            button.addEventListener('click', function() {
                let productId = this.getAttribute('data-id');
                addToOrderList(productId);
            });
        });

        fetchData(); // Fetch initial data when the page loads
    });
</script>