<?php require_once __DIR__ . "/../../../models/users.php"; ?>

<div class="header shadow-sm bg-white sticky-top d-flex align-items-center fixed-top" style="height:10vh;">
    <div class="d-flex align-items-center">
        <h2 class="h2 mx-5"><a href="/dashboard" class="text-decoration-none text-body-secondary fw-semibold"><span style="color: #357CA5;">Resto</span> <span class="text-warning">Unikom</span></a></h2>
        <!-- AdMinCodE -->
        <button class="toggle-btn border-0 d-flex align-items-center" type="button" style="background-color: transparent;">
            <i class="lni lni-menu" style="font-size: 1.4rem;"></i>
        </button>

        <button id="fullscreen-button" class="ms-5 px-2 fs-5 border-0 py-1 rounded bg-white text-body-secondary" onclick="toggleFullscreen()" style="cursor: pointer;">
            <i class="bi bi-arrows-fullscreen"></i>
        </button>

        <ul class="navbar-nav position-absolute " style="right: 30px;"> <!-- Perubahan pada bagian ini -->
            <li class="nav-item dropdown top-0 end-0">
                <button class="nav-link " href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="h6 fw-normal text-mixed  m-0 p-0 ">
                        <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>
                        <img src="././../../../public/img/user.png" width="37" alt="Random Image" class=" mx-1 rounded-circle">

                    </div>

                    <?php
                    if (isset($_SESSION['role'])) {
                        $role = $_SESSION['role'];
                        $bgClass = '';
                        switch ($role) {
                            case 'administrator':
                                $bgClass = 'bg-warning';
                                break;
                            case 'waiter':
                                $bgClass = 'bg-info';
                                break;
                            case 'chef':
                                $bgClass = 'bg-danger';
                                break;
                            case 'cashier':
                                $bgClass = 'bg-primary';
                                break;
                            default:
                                $bgClass = 'bg-dark';
                                break;
                        }
                    }
                    ?>


                    <?php
                    // echo $_SESSION['id'];
                    // echo $_SESSION['name'];
                    // echo $_SESSION['username'];
                    // echo $_SESSION['email'];
                    // echo $_SESSION['role'];
                    ?>

                    <div class="d-flex align-items-center " style="margin-top:-10px;">
                        <h6 class=" p-1 text-light  m-0 rounded <?php echo isset($bgClass) ? $bgClass : ''; ?>"><?php echo isset($_SESSION['role']) ? $_SESSION['role'] : ''; ?></h6>
                    </div>

                </button>
                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">`</a></li>
                    <li><a class="dropdown-item" href="#">`</a></li>
                    <li><a class="dropdown-item" href="#">`</a></li>
                    <div class="dropdown-divider"></div>
                    <li>
                        <form action="" method="POST">
                            <!-- @csrf -->
                            <input type="hidden" name="logout" value='true'>
                            <Button type="submit" class="nav-link px-4 border-0">Logout <i data-feather='log-out'></i></Button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>

</div>