<?php

session_start();
if(!isset($_SESSION["ssLoginPOS"])){
  header("location: ../auth/login.php");
  exit();
}

require"../config/koneksi.php";
require"../config/functions.php";
require"../module/mode-barang.php";


$title = "Add POS";
require"../temp/header.php";
require"../temp/navbar.php";
require"../temp/sidebar.php";

if(isset($_POST['simpan'])){
    if(insert($_POST)>0){
        echo'<script>
        alert("Berhasil Menambah barang");
        document.location.href = "data-barang.php";
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
              <li class="breadcrumb-item"><a href="<?= $main_url?>user/data-user.php">Users</a></li>
              <li class="breadcrumb-item active">add user</li>
              
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">

    <div class="conteiner-fluid">
        <div class="card">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user-plus fa-sm"></i>
                Add User</h3>
                <button type="submit" name="simpan" class="btn btn-primary btn-sm float-right"><i class="fas fa-save fa-sm"></i>
                SIMPAN</button>
                <button type="reset" class="btn btn-warning btn-sm float-right mr-1"><i class="fas fa-times fa-sm"></i>
                RESET</button>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8 mb-3">
                        <div class="form-group">
                            <label for="kode_barang">Kode Barang</label>
                            <input type="text" name="kode_barang" class="form-control" id="kode_barang" value="<?= genereteId()?>" required>

                        </div>
                        <div class="form-group">
                            <label for="barcode">Barcode</label>
                            <input type="text" name="barcode" class="form-control" id="barcode" value="<?= barcodeAuto()?>" require>
                            
                        </div>
                        <div class="form-group">
                            <label for="nama_barang">Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control" id="nama_barang"require>
                        </div>
                        <div class="form-group">
                            <label for="harga_beli">Harga Modal /Barang</label>
                            <input type="number" name="harga_beli" class="form-control" id="harga_beli" require>
                        </div>
                        <div class="form-group">
                            <label for="harga_jual">Harga Jual /Barang</label>
                            <input type="number" name="harga_jual" class="form-control" id="harga_jual" require>
                        </div>
                
                        <div class="form-group">
                            <label for="satuan">Satuan</label>
                           <select name="satuan" id="satuan" class="form-control" require>
                            <option value="">-- satuan --</option>
                            <option value="pouch">pouch</option>
                            <option value="pack">pack</option>
                            <option value="kaleng">kaleng</option>
                           </select>
                        </div>

                        <div class="form-group">
                            <label for="stock_minimal">Stock Minimal</label>
                            <input type="number" name="stock_minimal" class="form-control" id="stock_minimal" require>
                        </div>
                        <div class="form-group">
                            <label for="tgl_produksi">Tanggal Produksi Barang</label>
                            <input type="date" name="tgl_produksi" class="form-control" id="tgl_produksi" require>
                        </div>
                        <div class="form-group">
                            <label for="tgl_exp">Tanggal expired</label>
                            <input type="date" name="tgl_exp" class="form-control" id="tgl_exp" require>
                        </div>
                        
                    </div>
                    <div class="col-lg-4 text-center">
                        <img src="<?= $main_url?>assets/AdminLTE-3.2.0/img/baruu.png" class="profile-user-img img-circle mb-3" alt="">
                        <input type="file" class="form-control" name="foto">
                        <span class="text-sm">Type file gambar JPG | PNG </span><br>
                        <span class="text-sm">Width == Height</span>
                    </div>
                    <input type="hidden" name="tgl_input" class="form-control" id="tgl_input" value="<?=  date('Y-m-d')?>" require readonly>
                 
                </div>
            </div>
            </form>
        </div>
    </div>

    </section>

<?php

require"../temp/footer.php";

?>