        <!-- top navigation -->
        <!-- <div class="top_nav" style="position: fixed; top: 0; width: 1200px; z-index: 1000;";>
            <div class="nav_menu" style=" padding: 10px 15px;">
                <div class="nav toggle">
                  <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <nav class="nav navbar-nav">
                <ul class=" navbar-right">
                  <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                      <img src="<?=templates('production/images/img.jpg')?>" alt=""> Admin
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown"> 
                      <a class="dropdown-item"  href="<?=site_url('admin/auth/out')?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                    </div>
                  </li>
                </ul>
              </nav>
            </div>
          </div> -->
        <!-- /top navigation -->

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
                                <span class="user-name text-bold-600">User</span>
                                <span class="user-status">User</span>
                            </div>
                            <span>
                                <img class="round" src="#Gambar" alt="avatar" height="40" width="40">
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#"><i class="feather icon-user"></i> Profile</a>
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

        <!-- <li class="<?= ($this->uri->segment(2) == 'asrama') ? 'has-sub sidebar-group-active open' : ''?>">
                <a href="<?= site_url('admin/asrama') ?>"><i class="feather icon-square"></i><span class="menu-title" data-i18n="Campaign">Kamar</span></a>
                <ul class="menu-content">
                	<li class="<?= ($this->uri->segment(2) == 'asrama'&& $this->uri->segment(3) == '') ? 'active' : '' ?>">
                		<a href="<?= site_url('admin/asrama') ?>">
                			<i></i>
                			<span class="menu-item" data-i18n="Data Kamar">Data Asrama</span>
                		</a>
                	</li>
                	<li class="<?= ($this->uri->segment(2) == 'asrama' && $this->uri->segment(3) == 'form') ? 'active' : '' ?>">
                		<a href="<?= site_url('admin/asrama/form') ?>">
                			<i></i>
                			<span class="menu-item" data-i18n="Data Kamar">Tambah Data Asrama</span>
                		</a>
                	</li>
                </ul>
            </li> -->