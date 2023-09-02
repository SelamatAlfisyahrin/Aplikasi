<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= $main_url?>dashboard.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">POS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= $main_url ?>assets/AdminLTE-3.2.0/img/<?= userLogin()['foto']?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= userLogin()['fullname']?></a>
        </div>
      </div>

   

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         <li class="nav-item <?= menuSetting()?>">
            <a href="<?= $main_url?>dashboard.php" class="nav-link <?= menuHome()?>"><i class="nav-icon fas fa-home text-sm"></i><p>Dashboard</p></a>
         </li>
         <?php
         if (userLogin()['level']!= 3){

    
         
         ?>
         <li class="nav-item">
            <a href="#" class="nav-link"><i class="nav-icon fas fa-folder text-sm"></i><p>Master</p><i class="fas fa-angle-down right"></i></a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?= $main_url?>supplier/data-supplier.php" class="nav-link">
                        <i class="far fa-circle nav-icon text-sm"> <p>Supplier</p></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon text-sm"> <p>Customer</p></i>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= $main_url?>barang/data-barang.php" class="nav-link">
                        <i class="far fa-circle nav-icon text-sm"> <p>Barang</p></i>
                    </a>
                </li>
            </ul> 
        </li>
        <?php      } ?>
        <li class="nav-header">Transaksi</li>
        <li class="nav-item">
            <a href="<?= $main_url?>pembelian/index.php" class="nav-link">
            <i class="nav-icon fas fa-shopping-cart text-sm"></i>
            <p>Pembelian</p>
            </a>
        </li>
        <li class="nav-item">
        <a href="<?= $main_url?>penjualan/index.php" class="nav-link">
            <i class="nav-icon fas fa-file-invoice text-sm"></i>
            <p>Penjualan</p>
            </a>
        </li>
        <li class="nav-header">Report</li>
        <li class="nav-item">
            <a href="<?= $main_url?>laporan-pembelian/index.php" class="nav-link">
            <i class="nav-icon fas fa-chart-pie text-sm"></i>
            <p>Laporan Pembelian</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= $main_url?>laporan-penjualan/index.php" class="nav-link">
            <i class="nav-icon fas fa-chart-line text-sm"></i>
            <p>Laporan Penjualan</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= $main_url?>labarugi/index.php" class="nav-link">
            <i class="nav-icon far fa-money-bill-alt text-sm"></i>
            <p>Laba Rugi</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= $main_url?>laporan-stock/index.php" class="nav-link">
            <i class="nav-icon fas fa-warehouse text-sm"></i>
            <p>Laporan Stock</p>
            </a>
        </li>
        <?php
        if(userLogin()['level']==1){

      
        ?>
        <li class="nav-item">
            <a href="#" class="nav-link"><i class="nav-icon fas fa-cog text-sm"></i><p>Pengaturan</p><i class="fas fa-angle-down right"></i></a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?= $main_url?>user/data-user.php" class="nav-link <?= menuUser()?>">
                        <i class="far fa-circle nav-icon text-sm"> <p>Users</p></i>
                    </a>
                </li>
                
            </ul> 
        </li>
        <?php    } ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>