<?php

session_start();
if(!isset($_SESSION["ssLoginPOS"])){
  header("location: ../auth/login.php");
  exit();
}

require"../config/koneksi.php";
require"../config/functions.php";

$title = "Laba Rugi";
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
            <h1 class="m-0">Laba Rugi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= $main_url?>dashboard.php">Home</a></li>
              <li class="breadcrumb-item"><a href="<?= $main_url?>user/data-user.php">Laporan Laba Rugi</a></li>          
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">

    <div class="conteiner-fluid">
        <div class="card">
        <form action="laba_rugi.php" target="_blank" method="POST" enctype="multipart/form-data">
            <div class="card-header">
                <!-- <h3 class="card-title"><i class="fas fa-user-plus fa-sm"></i>
                Add User</h3> -->
                <button type="submit" name="simpan" class="btn btn-primary btn-sm float-right"><i class="fas fa-save fa-sm"></i>
                SIMPAN</button>
                <button type="reset" class="btn btn-warning btn-sm float-right mr-1"><i class="fas fa-times fa-sm"></i>
                RESET</button>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8 mb-3">
                        <div class="form-group">
                            <!-- <label for="kode_barang">Dari</label> -->
                            <span>Dari <input type="date" name="tgl1" class="form-control" id="tgl1"require></span>
                        </div>
                        <div class="form-group">
                            <!-- <label for="kode_barang">Dari</label> -->
                            <span>Sampai <input type="date" name="tgl2" class="form-control" id="tgl2"require></span>
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