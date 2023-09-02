<?php

session_start();
if(!isset($_SESSION["ssLoginPOS"])){
  header("location: ../auth/login.php");
  exit();
}

require"../config/koneksi.php";
require"../config/functions.php";
require"../module/mode-supplier.php";


$title = "Add-Supplier POS";
require"../temp/header.php";
require"../temp/navbar.php";
require"../temp/sidebar.php";

if(isset($_POST['simpan'])){
    if(insert($_POST)>0){
        echo'<script>
        alert("Berhasil Menambah Supplier");
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
            <h1 class="m-0">Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= $main_url?>dashboard.php">Home</a></li>
              <li class="breadcrumb-item"><a href="<?= $main_url?>supplier/data-supplier.php">Supplier</a></li>
              <li class="breadcrumb-item active">add supplier</li>
              
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
                Add Supplier</h3>
                <button type="submit" name="simpan" class="btn btn-primary btn-sm float-right"><i class="fas fa-save fa-sm"></i>
                SIMPAN</button>
                <button type="reset" class="btn btn-warning btn-sm float-right mr-1"><i class="fas fa-times fa-sm"></i>
                RESET</button>
            </div>
         
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8 mb-3">
                        <div class="form-group">
                            <label for="nama">SUPPLIER</label>
                            <input type="text" name="nama" class="form-control" id="nama" placeholder="MASUKAN SUPPLIER" autofocus autocomplete="off" require>

                        </div>
                        <div class="form-group">
                            <label for="telpon">TELPON</label>
                            <input type="text" pattern="[0-9]{5,}" name="telpon" class="form-control" id="telpon" placeholder="MASUKAN TELPON"require>
                            
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">DESKRIPSI</label>
                            <input type="text" name="deskripsi" class="form-control" id="deskripsi" placeholder="MASUKAN DESKRIPSI"require>
                        </div>
                        
                        <div class="form-group">
                            <label for="alamat">ADDRESS</label>
                            <textarea name="alamat" id="alamat" cols="" rows="3" placeholder="MASUKAN ALAMAT" class="form-control" require></textarea>
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