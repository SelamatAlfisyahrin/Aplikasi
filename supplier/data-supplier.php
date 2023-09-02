<?php

session_start();
if(!isset($_SESSION["ssLoginPOS"])){
  header("location: ../auth/login.php");
  exit();
}

require"../config/koneksi.php";
require"../config/functions.php";
require"../module/mode-supplier.php";

$title = "Suppliers-POS";
require"../temp/header.php";



require"../temp/navbar.php";
require"../temp/sidebar.php";
?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Suppliers Data</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= $main_url?>dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Supplier</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

<section class="content">

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-list fa-sm"></i>
            Users Data</h3>
            <div class="card-tools">
                <a href="<?= $main_url?>supplier/add-supplier.php" class="btn btn-sm btn-primary"><i class="fas fa-plus-circle fa-sm"></i>
                SUPPLIER</a>
            </div>
        </div>
        <div class="card-body table-responsive p-3">
            <table class="table table-hover text-nowrap" id="example">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Supplier</th>
                        <th>Telpon</th>
                        <th>Deskripsi</th>
                        <th>alamat</th>
                        <th style="width: 10%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $suppliers = getData("SELECT * FROM tbl_supplier");

                    foreach($suppliers as $supplier): ?>

                    <tr>
                        <td><?= $no++?></td>
                        <td><?= $supplier['nama']?></td>
                        <td><?= $supplier['telpon']?></td>
                        <td><?= $supplier['deskripsi']?></td>
                        <td><?= $supplier['alamat']?></td>
                        
                        <td>
                            <a href="edit-supplier.php?id_supplier=<?= $supplier['id_supplier']?>" class="btn btn-sm btn-warning" title="edit supplier"><i class="fas fa-user-edit"></i></a>
                            <a href="del-supplier.php?id_supplier=<?= $supplier['id_supplier']?>" class="btn btn-sm btn-danger" title="hapus user" onclick="return confirm('Anda Yakin akan menghapus supplier ini ?')"><i class="fas fa-user-times"></i></a>
                        </td>
                    </tr>

                    <?php endforeach;?>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

</section>

<?php

require"../temp/footer.php";
?>