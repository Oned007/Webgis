<div class="content-overlay"></div>
<div class="header-navbar-shadow"></div>
<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top navbar-light navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="navbar-collapse" id="navbar-mobile">
                <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                    <ul class="nav navbar-nav">
                        <li class="nav-item mobile-menu d-xl-none mr-auto">
                            <a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#">
                                <i class="ficon feather icon-menu"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <ul class="nav navbar-nav float-right">
                    <li class="nav-item d-none d-lg-block">
                        <a class="nav-link nav-link-expand">
                            <i class="ficon feather icon-maximize"></i>
                        </a>
                    </li>
                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" data-toggle="dropdown" aria-expanded="false">
                            <div class="user-nav d-sm-flex d-none">
                                <span class="user-name text-bold-600">Admin</span>
                                <span class="user-status">Admin</span>
                            </div>
                            <span>
                                <!-- Pastikan path gambar avatar benar -->
                                <?php
                                $avatar_path = 'assets/img/avatar.png'; // Path default avatar
                                if (isset($user_avatar) && !empty($user_avatar)) {
                                    $avatar_path = $user_avatar; // Gunakan avatar pengguna jika ada
                                }
                                ?>
                                <img class="round" src="<?= base_url($avatar_path) ?>" alt="avatar" height="50" width="50">
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= site_url('admin/auth/out') ?>">
                                <i class="feather icon-power"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>