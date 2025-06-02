<?php
session_start();
require_once 'db.php';
?>
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="index.php">JKinformatica</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <div>
        <!-- Add your search bar or other elements here if needed -->
    </div>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto"> <!-- Added ms-auto to push the login icon to the right -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user fa-fw" style="font-size: 1.5rem;"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="login.php">Login</a></li>

                <li><hr class="dropdown-divider" /></li>
                <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'Admin'): ?>
                    <li><a class="dropdown-item" href="users.php">Manage Users</a></li>
                <?php endif; ?>
                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>