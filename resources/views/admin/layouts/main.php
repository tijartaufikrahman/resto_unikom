<div class="container-fluid g-0">
    <?php include 'navbar.php'; ?>
    <div class="row d-flex container-fluid g-0">
        <?php include 'sidebar.php'; ?>
        <div class="col bg-light" style="height: auto;">

            <?php
            if (isset($_GET['q'])) {
                switch ($_GET['q']) {

                    case 'dashboard':
                        include './dashboard/dashboard.php';
                        break;

                    case 'find-table-and-seats':
                        include './findTableandSeats/findTableandSeats.php';
                        break;
                        // Tambahkan kasus lain di sini jika diperlukan

                    case 'check-order-availability':
                        include './checkOrderAvailability/checkOrderAvailability.php';
                        break;
                        // Tambahkan kasus lain di sini jika diperlukan

                    case 'order-list':
                        include './orderList/orderList.php';
                        break;
                        // Tambahkan kasus lain di sini jika diperlukan

                    case 'serve-food-and-drinks':
                        include './serveFoodAndDrinks/serveFoodAndDrinks.php';
                        break;
                        // Tambahkan kasus lain di sini jika diperlukan

                    case 'new-foods':
                        include './newFoods/newFoods.php';
                        break;
                        // Tambahkan kasus lain di sini jika diperlukan

                    case 'new-category':
                        include './newCategory/newCategory.php';
                        break;
                        // Tambahkan kasus lain di sini jika diperlukan

                    case 'food-materials':
                        include './foodMaterials/foodMaterials.php';
                        break;
                        // Tambahkan kasus lain di sini jika diperlukan

                    case 'orderhandling-food-preparation':
                        include './orderPreparation/orderPreparation.php';
                        break;
                        // Tambahkan kasus lain di sini jika diperlukan

                    case 'order-history':
                        include './orderHistory/orderHistory.php';
                        break;
                        // Tambahkan kasus lain di sini jika diperlukan

                    case 'payment':
                        include './payment/payment.php';
                        break;
                        // Tambahkan kasus lain di sini jika diperlukan

                    case 'transaction-report':
                        include './transactionReport/transactionReport.php';
                        break;
                        // Tambahkan kasus lain di sini jika diperlukan

                    case 'users':
                        include './users/users.php';
                        break;
                        // Tambahkan kasus lain di sini jika diperlukan

                    case 'profile':
                        include './profile/profile.php';
                        break;
                        // Tambahkan kasus lain di sini jika diperlukan


                    case 'product-sales-report':
                        include './product_sales_report/product_sales_report.php';
                        break;
                        // Tambahkan kasus lain di sini jika diperlukan

                    case 'analytics':
                        include './analytics/analytics.php';
                        break;
                        // Tambahkan kasus lain di sini jika diperlukan

                    default:
                        include './no_page/no_page.php';
                        break;
                }
            } else {
                include './dashboard/dashboard.php';
            }
            ?>

        </div>
    </div>
</div>