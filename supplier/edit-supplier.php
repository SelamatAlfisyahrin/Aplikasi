<?php

session_start();
if(!isset($_SESSION["ssLoginPOS"])){
  header("location: ../auth/login.php");
  exit();
}

require"../config/koneksi.php";
require"../config/functions.php";
require"../module/mode-supplier.php";


$title = "Update-Supplier POS";
require"../temp/header.php";
require"../temp/navbar.php";
require"../temp/sidebar.php";

$id = $_GET['id_supplier'];
$sqlEdit = "SELECT * FROM tbl_supplier WHERE id_supplier = $id";
$supplier = getData($sqlEdit)[0];


if(isset($_POST['koreksi'])){
    if(update($_POST)){
        echo'<script>
        alert("data supplier berhasil diupdate");

        document.location.href = "data-supplier.php";
        </script>';

      
    }
}

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Supplier</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= $main_url?>dashboard.php">Home</a></li>
              <li class="breadcrumb-item"><a href="<?= $main_url?>user/data-supplier.php">supplier</a></li>
              <li class="breadcrumb-item active">Edit Supplier</li>
              
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">

    <div class="conteiner-fluid">
        <div class="card">
        <form action="" method="POST">
            
          
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user-plus fa-sm"></i>
                Update Supplier</h3>
                <button type="submit" name="koreksi" class="btn btn-primary btn-sm float-right"><i class="fas fa-save fa-sm"></i>
                UPDATE</button>
                <button type="reset" class="btn btn-warning btn-sm float-right mr-1"><i class="fas fa-times fa-sm"></i>
                RESET</button>
            </div>
            <div class="card-body">
                <div class="row">
                    <input type="hidden" value="<?= $supplier['id_supplier']?>" name="id_supplier">
                    <div class="col-lg-8 mb-3">
                        <div class="form-group">
                            <label for="nama">SUPPLIER</label>
                            <input type="text" name="nama" class="form-control" id="nama" placeholder="MASUKAN SUPPLIER" autofocus autocomplete="off" value="<?= $supplier['nama']?>" require>

                        </div>
                        <div class="form-group">
                            <label for="telpon">FULLNAME</label>
                            <input type="text" name="telpon" class="form-control" id="telpon" placeholder="MASUKAN TELPON" value="<?= $supplier['telpon']?>" require>
                            
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">DESKRIPSI</label>
                            <input type="text" name="deskripsi" class="form-control" id="deskripsi" placeholder="MASUKAN DESKRIPSI" value="<?= $supplier['deskripsi']?>" require>
                        </div>
                       
                     
                        <div class="form-group">
                            <label for="alamat">ALAMAT</label>
                            <input type="text" name="alamat" class="form-control" id="alamat"  value="<?= $supplier['alamat']?>" require>
                            
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>

    </section>

<?php

require"../temp/footer.php";

?>