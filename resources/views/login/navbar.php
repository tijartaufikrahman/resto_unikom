<nav class="navbar navbar-expand-lg navbar-dark bg-primary ">
    <div class="container">
        <a class="navbar-brand" href="/">RESTO UNIKOM</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- <ul class="navbar-nav">
                <li class="nav-item">
                    <a  href="/" class="nav-link {{ ($active === 'home') ? 'active' : '' }}">Home</a> 
                </li>
                <li class="nav-item">
                    <a  href=" /about" class="nav-link {{ ($active === 'about') ? 'active' : '' }}">About</a>
                </li>
                {{-- <li class="nav-item">
                    <a href=" /posts" class="nav-link {{ ($active === 'posts') ? 'active' : '' }}">Blog</a>
                </li>
                <li class="nav-item">
                    <a href=" /categories" class="nav-link {{ ($active === 'categories') ? 'active' : '' }}">Categories</a>
                </li> --}}
            </ul> -->

            <ul class="navbar-nav ms-auto">
                <!-- @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Welcome back, {{ auth()->user()->name }}
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/dashboard"><i class="bi bi-layout-text-sidebar-reverse"></i> My Dashboard</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="/logout" method="POST">
                                @csrf
                                <Button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Logout</Button>
                            </form>


                            {{-- <a class="dropdown-item" href="#"><i class="bi bi-box-arrow-right"></i> Logout</a> --}}
                        </li>
                    </ul>
                </li>
                @else -->

                <!-- <li class="nav-item">
                        <a href="/login" class="nav-link {{ ($active === 'login') ? 'active' : '' }}"><i class="bi bi-box-arrow-in-right"></i>
                            Login</a>
                    </li> -->
                <!-- @endauth -->
            </ul>
        </div>
    </div>
</nav>