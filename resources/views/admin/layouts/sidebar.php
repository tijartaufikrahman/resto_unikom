<?php
$id = $_SESSION['role_id'];
$query_menu  = "SELECT m.id, m.name_menu, m.link, m.icon,m.parent_id,r.role_name
FROM Menu m
JOIN menu_role mr ON m.id = mr.menu_id
JOIN roles r ON r.id =  mr.role_id
WHERE mr.role_id = '$id';";

$result = mysqli_query($db_conn, $query_menu);

// INI MENU DINAMIS
$menus = mysqli_fetch_all($result, MYSQLI_ASSOC);
// END INI MENU DINAMIS


// $sql2 = "INSERT INTO `menu_role` (`id`, `menu_id`, `role_id`) VALUES 


// (NULL, '1', '1'),
// (NULL, '2', '1'),
// (NULL, '3', '1'),
// (NULL, '4', '1'),
// (NULL, '5', '1'),
// (NULL, '6', '1'),
// (NULL, '7', '1'),
// (NULL, '8', '1'),
// (NULL, '9', '1'),
// (NULL, '10', '1'),
// (NULL, '11', '1'),
// (NULL, '12', '1'),
// (NULL, '13', '1'),
// (NULL, '14', '1'),
// (NULL, '15', '1'),

// (NULL, '2', '2'),
// (NULL, '3', '2'),
// (NULL, '4', '2'),
// (NULL, '5', '2'),

// (NULL, '6', '3'),
// (NULL, '7', '3'),
// (NULL, '8', '3'),
// (NULL, '9', '3'),
// (NULL, '10', '3'),
// (NULL, '11', '3'),

// (NULL, '12', '4'),
// (NULL, '13', '4')

// ;";

// $sql = "INSERT INTO `menu` (`id`, `name_menu`, `link`, `icon`) VALUES 
//     (NULL, 'Dashboard', 'dashboard', 'fas fa-dashboard'),
//     (NULL, 'Find Table and Seats', 'find-table-and-seats', 'bi-table'),
//     (NULL, 'Check Order Availability', 'check-order-availability', 'bi bi-cart-check-fill'),
//     (NULL, 'Order List', 'order-list', 'bi-receipt'),
//     (NULL, 'Serve Food and Drinks', 'serve-food-and-drinks', 'bi-cup-straw'),

//     (NULL, 'Manage Items', '#', 'bi bi-book'),
//     (NULL, 'Foods', 'new-foods', 'bi-box-seam'),
//     (NULL, 'Categories', 'new-category', 'bi-tags'),
//     (NULL, 'Food Materials', 'food-materials', 'fas fa-leaf'),
//     (NULL, 'Order & Kitchen', 'orderhandling-food-preparation', 'bi-egg-fried'),
//     (NULL, 'Order History', 'order-history', 'bi bi-file-earmark-text'),

//     (NULL, 'Payment', 'payment', 'bi-credit-card'),
//     (NULL, 'Transaction Report', 'transaction-report', 'bi-file-text'),

//     (NULL, 'Users', 'users', 'fa solid fa-user'),
//     (NULL, 'Analytics', 'analytics', 'fa-solid fa-chart-line')
// ;"







// $sql = "INSERT INTO `menu` (`id`, `name_menu`, `link`, `icon`,`parent_id`) VALUES 
// (1, 'Dashboard', 'dashboard', 'fas fa-dashboard',NULL),
// (2, 'Find Table and Seats', 'find-table-and-seats', 'bi-table',NULL),
// (3, 'Check Order Availability', 'check-order-availability', 'bi bi-cart-check-fill',NULL),
// (4, 'Order List', 'order-list', 'bi-receipt',NULL),
// (5, 'Serve Food and Drinks', 'serve-food-and-drinks', 'bi-cup-straw',NULL),

// (6, 'Manage Items', '#', 'bi bi-book',NULL),
// (7, 'Foods', 'new-foods', 'bi-box-seam',6),
// (8, 'Categories', 'new-category', 'bi-tags',6),
// (9, 'Food Materials', 'food-materials', 'fas fa-leaf',6),
// (10, 'Order & Kitchen', 'orderhandling-food-preparation', 'bi-egg-fried',NULL),
// (11, 'Order History', 'order-history', 'bi bi-file-earmark-text',NULL),

// (12, 'Payment', 'payment', 'bi-credit-card',NULL),
// (13, 'Transaction Report', 'transaction-report', 'bi-file-text',NULL),

// (14, 'Users', 'users', 'fa solid fa-user',NULL),
// (15, 'Analytics', 'analytics', 'fa-solid fa-chart-line',NULL)


//  ;";






// $menus = [
//   ['id' => 1, 'name_menu' => 'Dashboard', 'link' => 'dashboard', 'icon' => 'fas fa-dashboard', 'parent_id' => NULL],
//   ['id' => 2, 'name_menu' => 'Find Table and Seats', 'link' => 'find-table-and-seats', 'icon' => 'bi-table', 'parent_id' => NULL],
//   ['id' => 3, 'name_menu' => 'Check Order Availability', 'link' => 'check-order-availability', 'icon' => 'bi bi-cart-check-fill', 'parent_id' => NULL],
//   ['id' => 4, 'name_menu' => 'Order List', 'link' => 'order-list', 'icon' => 'bi-receipt', 'parent_id' => NULL],
//   ['id' => 5, 'name_menu' => 'Serve Food and Drinks', 'link' => 'serve-food-and-drinks', 'icon' => 'bi-cup-straw', 'parent_id' => NULL],
//   ['id' => 6, 'name_menu' => 'Manage Items', 'link' => '#', 'icon' => 'bi bi-book', 'parent_id' => NULL],
//   ['id' => 7, 'name_menu' => 'Foods', 'link' => 'new-foods', 'icon' => 'bi-box-seam', 'parent_id' => 6],
//   ['id' => 8, 'name_menu' => 'Categories', 'link' => 'new-category', 'icon' => 'bi-tags', 'parent_id' => 6],
//   ['id' => 9, 'name_menu' => 'Food Materials', 'link' => 'food-materials', 'icon' => 'fas fa-leaf', 'parent_id' => 6],
//   ['id' => 10, 'name_menu' => 'Order & Kitchen', 'link' => 'orderhandling-food-preparation', 'icon' => 'bi-egg-fried', 'parent_id' => NULL],
//   ['id' => 11, 'name_menu' => 'Order History', 'link' => 'order-history', 'icon' => 'bi bi-file-earmark-text', 'parent_id' => NULL],
//   ['id' => 12, 'name_menu' => 'Payment', 'link' => 'payment', 'icon' => 'bi-credit-card', 'parent_id' => NULL],
//   ['id' => 13, 'name_menu' => 'Transaction Report', 'link' => 'transaction-report', 'icon' => 'bi-file-text', 'parent_id' => NULL],
//   ['id' => 14, 'name_menu' => 'Users', 'link' => 'users', 'icon' => 'fa solid fa-user', 'parent_id' => NULL],
//   ['id' => 15, 'name_menu' => 'Analytics', 'link' => 'analytics', 'icon' => 'fa-solid fa-chart-line', 'parent_id' => NULL],
// ];


?>



<?php
// Fungsi untuk menentukan kelas CSS aktif berdasarkan nilai q
function getActiveClass($page)
{
  $q = isset($_GET['q']) ? $_GET['q'] : '';

  // Jika nilai q kosong dan $page adalah 'dashboard', kembalikan kelas 'bg-info text-white'
  if ($page == 'dashboard' && empty($q)) {
    return 'bg-info text-white';
  }

  // Jika nilai q cocok dengan halaman yang sedang dilihat, kembalikan kelas aktif
  if ($q == $page) {
    return 'bg-info text-white';
  } else {
    return '';
  }
}
?>

<style>
  .sub-menu {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease-out;
    display: none;
    /* Tambahkan display: none; untuk menyembunyikan submenu secara default */
  }

  .sub-menu.activeD {
    max-height: 500px;
    /* Sesuaikan dengan nilai yang cukup besar */
    display: block;
    /* Aktifkan display: block; saat submenu aktif */
  }

  /* Animasi untuk span pada link */
  .nav-custom {
    transition: transform 0.3s ease-in-out;
  }

  .nav-custom.active {
    transform: translateX(10px);
    /* Sesuaikan perpindahan horizontal sesuai kebutuhan */
  }
</style>



<!-- HTML dengan PHP untuk menetapkan kelas aktif -->
<style>
  #sidebar::-webkit-scrollbar {
    width: 5px;
    /* Lebar scrollbar */
  }
</style>

<aside id="sidebar" class="shadow bg-white" style="height: 90vh; position: sticky; top: 10vh; overflow: auto; font-family: 'Source Sans Pro', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';">
  <nav class="flex-column py-4 ">

    <h6 class="sidebar-heading adm-custom d-flex justify-content-between align-items-center px-3 mt-2 mb-3" style="font-size: 15px;">
      <span class="text-body-secondary">MAIN MENU</span>
    </h6>

    <?php if (isset($menus1)) : ?>
      <h6 class="sidebar-heading adm-custom d-flex justify-content-between align-items-center px-3 mt-2 mb-3" style="font-size: 15px;">
        <span class="text-body-secondary"><?= $menus['role_name']; ?></span>
      </h6>
    <?php endif; ?>

    <ul class="nav nav-pills flex-column " style="font-weight: 500;">


      <?php if (isset($menus) && !empty($menus)) : ?>
        <?php foreach ($menus as $menu) : ?>
          <?php if ($menu['link'] != '#' && $menu['parent_id'] === NULL) : ?>

            <li class="mb-1">
              <a href="?q=<?= $menu['link'] ?>" class="nav-link customHover mx-2 <?= getActiveClass($menu['link']) ?>" style="padding-left: 18px; padding-right: 14px;">
                <i class="<?= $menu['icon'] ?>" style="font-size: 20px;"></i>
                <span class="nav-custom mx-3" style="position: absolute; white-space: nowrap;"><?= $menu['name_menu'] ?></span>
              </a>
            </li>
          <?php elseif ($menu['link'] == '#' && $menu['parent_id'] === NULL) : ?>

            <li class="mb-1">
              <a href="#" id="manage-items" class="nav-link customHover mx-2 <?= (getActiveClass('new-foods') || getActiveClass('new-category') || getActiveClass('food-materials')) ? ' bg-info text-white ' : '' ?>" style="padding-left: 18px; padding-right: 14px;">
                <i class="bi bi-book" style="font-size: 20px;"></i>
                <span class="nav-custom mx-3" style="position: absolute; white-space: nowrap;">Manage Items</span>
              </a>
              <ul class="sub-menu p-1 ms-1 ps-5 <?= (getActiveClass('new-foods') || getActiveClass('new-category') || getActiveClass('food-materials')) ? ' activeD ' : '' ?>" style="max-height: 200px; overflow-y: auto; overflow-x: hidden;">

                <?php foreach ($menus as $submenu) : ?>
                  <?php if ($submenu['parent_id'] == $menu['id']) : ?>
                    <li class="mb-1">
                      <a href="?q=<?= $submenu['link'] ?>" class="nav-link customHover mx-2 <?= (getActiveClass($submenu['link'])) ? 'bg-white text-info fw-semibold' : '' ?>" style="padding-left: 18px; padding-right: 14px;">
                        <i class="<?= $submenu['icon'] ?>" style="font-size: 20px;"></i>
                        <span class="nav-custom mx-3" style="position: absolute; white-space: nowrap;"><?= $submenu['name_menu'] ?></span>
                      </a>
                    </li>
                  <?php endif; ?>
                <?php endforeach; ?>
              </ul>
            </li>
          <?php endif; ?>
        <?php endforeach; ?>
      <?php endif; ?>






      <!-- <h3>------------------------------</h3> -->
      <!-- <span>
        <h6 class="sidebar-heading adm-custom d-flex justify-content-between align-items-center px-3 my-3 ">
          <span class="text-body-secondary ">ADMINISTRATOR</span>
        </h6>

        <li class="mb-1">
          <a href="?q=dashboard" class="nav-link customHover  mx-2 <?= getActiveClass('dashboard') ?>" style="padding-left: 18px;padding-right:14px;">
            <i class="fas fa-dashboard" style="font-size: 20px;"></i>
            <span class="nav-custom mx-3" style="position: absolute;white-space: nowrap;">Dashboard</span>
          </a>
        </li>
        <li class="mb-1">
          <a href="?q=profile" class="nav-link customHover  mx-2 <?= getActiveClass('profile') ?>" style="padding-left: 18px;padding-right:14px;">
            <i class="fas fa-user" style="font-size: 20px;"></i>
            <span class="nav-custom mx-3" style="position: absolute;white-space: nowrap;">Profile</span>
          </a>
        </li>

        <ul class="nav nav-pills flex-column " style="font-weight: 500;">
          <li class="">
            <a href="?q=users" class="nav-link customHover mx-2 <?= getActiveClass('users') ?>" style="padding-left: 18px;padding-right:14px;">
              <i class="fa solid fa-user-friends" style="font-size: 20px;"></i>
              <span class="nav-custom mx-3" style="position: absolute;white-space: nowrap;">Users</span>
            </a>
          </li>
          <li class="mb-1">
            <a href="?q=analytics" class="nav-link customHover mx-2 <?= getActiveClass('analytics') ?>" style="padding-left: 18px;padding-right:14px;">
              <i class="fa-solid fa-chart-line" style="font-size: 20px;"></i>
              <span class="nav-custom mx-3" style="position: absolute;white-space: nowrap;">Analytics</span>
            </a>
          </li>

          <h6 class="sidebar-heading adm-custom d-flex justify-content-between align-items-center px-3 mt-2 mb-3" style="font-size: 15px;">
            <span class="text-body-secondary">WAITER</span>
          </h6>

          <li class="mb-1">
            <a href="?q=find-table-and-seats" class="nav-link customHover mx-2 <?= getActiveClass('find-table-and-seats') ?>" style="padding-left: 18px;padding-right:14px;">
              <i class="bi-table" style="font-size: 20px;"></i>
              <span class="nav-custom mx-3" style="position: absolute;white-space: nowrap;">Find Table and Seats</span>
            </a>
          </li>
          <li class="mb-1">
            <a href="?q=check-order-availability" class="nav-link customHover mx-2 <?= getActiveClass('check-order-availability') ?>" style="padding-left: 18px;padding-right:14px;">
              <i class="bi bi-cart-check-fill" style="font-size: 20px;"></i>
              <span class="nav-custom mx-3" style="position: absolute;white-space: nowrap;">Check Order Availability</span>
            </a>
          </li>
          <li class="mb-1">
            <a href="?q=order-list" class="nav-link customHover mx-2 <?= getActiveClass('order-list') ?>" style="padding-left: 18px;padding-right:14px;">
              <i class="bi-receipt" style="font-size: 20px;"></i>
              <span class="nav-custom mx-3" style="position: absolute;white-space: nowrap;">Order List</span>
            </a>
          </li>
          <li class="mb-1">
            <a href="?q=serve-food-and-drinks" class="nav-link customHover mx-2 <?= getActiveClass('serve-food-and-drinks') ?>" style="padding-left: 18px;padding-right:14px;">
              <i class="bi-cup-straw" style="font-size: 20px;"></i>
              <span class="nav-custom mx-3" style="position: absolute;white-space: nowrap;">Serve Food and Drinks</span>
            </a>
          </li>

          <h6 class="sidebar-heading adm-custom d-flex justify-content-between align-items-center px-3 mt-2 mb-3" style="font-size: 15px;">
            <span class="text-body-secondary">CHEF</span>
          </h6>



          <li class="mb-1">
            <a href="#" id="manage-items" class="nav-link customHover  mx-2 <?= (getActiveClass('new-foods') || getActiveClass('new-category')) || getActiveClass('food-materials') ? ' bg-info text-white ' : '' ?>" style="padding-left: 18px; padding-right: 14px;">
              <i class="bi bi-book" style="font-size: 20px;"></i>
              <span class="nav-custom mx-3 dropdown-toggle" style="position: absolute; white-space: nowrap;">Manage Items</span>
            </a>
            <ul class="sub-menu  p-1 ms-1 ps-5 <?= (getActiveClass('new-foods') || getActiveClass('new-category')) || getActiveClass('food-materials') ? ' activeD ' : '' ?>">

              <li class="mb-1">
                <a href="?q=new-foods" class="nav-link customHover mx-2 <?= (getActiveClass('new-foods')) ? 'bg-white text-info fw-semibold' : '' ?>" style="padding-left: 18px; padding-right: 14px;">
                  <i class="bi-box-seam" style="font-size: 20px;"></i>
                  <span class="nav-custom mx-3" style="position: absolute; white-space: nowrap;">Foods</span>
                </a>
              </li>
              <li class="mb-1">
                <a href="?q=new-category" class="nav-link customHover mx-2 <?= (getActiveClass('new-category')) ? 'bg-white text-info fw-semibold' : '' ?>" style="padding-left: 18px; padding-right: 14px;">
                  <i class="bi-tags" style="font-size: 20px;"></i>
                  <span class="nav-custom mx-3" style="position: absolute; white-space: nowrap;">Categories</span>
                </a>
              </li>
              <li class="mb-1">
                <a href="?q=food-materials" class="nav-link customHover mx-2 <?= (getActiveClass('food-materials')) ? 'bg-white text-info fw-semibold' : '' ?>" style="padding-left: 18px; padding-right: 14px;">
                  <i class="fas fa-leaf" style="font-size: 20px;"></i>
                  <span class="nav-custom mx-3" style="position: absolute; white-space: nowrap;">Food Materials</span>
                </a>
              </li>
            </ul>
          </li>





          <li class="mb-1">
            <a href="?q=orderhandling-food-preparation" class="nav-link customHover mx-2 <?= getActiveClass('orderhandling-food-preparation') ?>" style="padding-left: 18px;padding-right:14px;">
              <i class="bi-egg-fried" style="font-size: 20px;"></i>
              <span class="nav-custom mx-3" style="position: absolute;white-space: nowrap;">Order & Kitchen</span>
            </a>
          </li>




          <li class="mb-1">
            <a href="?q=order-history" class="nav-link customHover mx-2 <?= getActiveClass('order-history') ?>" style="padding-left: 18px;padding-right:14px;">
              <i class="bi bi-file-earmark-text" style="font-size: 20px;"></i>
              <span class="nav-custom mx-3" style="position: absolute;white-space: nowrap;">Order History</span>
            </a>
          </li>

          <h6 class="sidebar-heading adm-custom d-flex justify-content-between align-items-center px-3 mt-2 mb-3" style="font-size: 15px;">
            <span class="text-body-secondary">CASHIER</span>
          </h6>

          <li class="mb-1">
            <a href="?q=payment" class="nav-link customHover mx-2 <?= getActiveClass('payment') ?>" style="padding-left: 18px;padding-right:14px;">
              <i class="bi-credit-card" style="font-size: 20px;"></i>
              <span class="nav-custom mx-3" style="position: absolute;white-space: nowrap;">Payment</span>
            </a>
          </li>

          <li class="mb-1">
            <a href="?q=transaction-report" class="nav-link customHover mx-2 <?= getActiveClass('transaction-report') ?>" style="padding-left: 18px;padding-right:14px;">
              <i class="bi-file-text" style="font-size: 20px;"></i>
              <span class="nav-custom mx-3" style="position: absolute;white-space: nowrap;">Transaction Report</span>
            </a>
          </li>
        </ul>


      </span> -->




    </ul>

  </nav>
</aside>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const manageItemsLink = document.getElementById('manage-items');
    const childUl = manageItemsLink.nextElementSibling;

    manageItemsLink.addEventListener('click', function(event) {
      event.preventDefault();

      // Toggle kelas 'active' pada <ul> untuk menampilkan atau menyembunyikan dengan animasi
      childUl.classList.toggle('activeD');

      // Toggle kelas 'active' pada span untuk animasi
      const navCustomSpan = manageItemsLink.querySelector('.nav-custom');
      navCustomSpan.classList.toggle('activeD');
    });
  });
</script>