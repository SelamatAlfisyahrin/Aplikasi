<?php

session_start();
if(!isset($_SESSION["ssLoginPOS"])){
  header("location: ../auth/login.php");
  exit();
}

require"../config/koneksi.php";
require"../config/functions.php";
require"../module/mode-barang.php";


$title = "Update-Supplier POS";
require"../temp/header.php";
require"../temp/navbar.php";
require"../temp/sidebar.php";

$id = $_GET['id_brg'];
$sqlEdit = "SELECT * FROM tbl_barang WHERE id_brg = $id";
$supplier = getData($sqlEdit)[0];
$satuan = $supplier['satuan'];


if(isset($_POST['koreksi'])){
    if(update($_POST)){
        echo'<script>
        alert("data barang berhasil diupdate");

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
        <form action="" method="POST" enctype="multipart/form-data">  
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
                    <input type="hidden" value="<?= $supplier['id_brg']?>" name="id_brg">
                    <div class="col-lg-8 mb-3">
                    <div class="form-group">
                            <label for="kode_barang">Kode Barang</label>
                            <input type="text" name="kode_barang" class="form-control" id="kode_barang" placeholder="MASUKAN SUPPLIER" autofocus autocomplete="off" value="<?= $supplier['kode_barang']?>" require readonly>
                        </div>
                        <div class="form-group">
                            <label for="barcode">Barcode</label>
                            <input type="text" name="barcode" class="form-control" id="barcode" placeholder="MASUKAN SUPPLIER" autofocus autocomplete="off" value="<?= $supplier['barcode']?>" require readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama_barang">Nama barang</label>
                            <input type="text" name="nama_barang" class="form-control" id="nama_barang" placeholder="MASUKAN SUPPLIER" autofocus autocomplete="off" value="<?= $supplier['nama_barang']?>" require>
                        </div>
                        
                        <div class="form-group">
                            <label for="harga_beli">Harga Modal /barang</label>
                            <input type="number" name="harga_beli" class="form-control" id="harga_beli" placeholder="MASUKAN SUPPLIER" autofocus autocomplete="off" value="<?= $supplier['harga_beli']?>" require>
                        </div>
                        <div class="form-group">
                            <label for="harga_jual">Harga Jual /barang</label>
                            <input type="number" name="harga_jual" class="form-control" id="harga_jual" placeholder="MASUKAN SUPPLIER" autofocus autocomplete="off" value="<?= $supplier['harga_jual']?>" require>
                        </div>
                        <div class="form-group">
                            <label for="stock_minimal">Stock Minimal</label>
                            <input type="number" name="stock_minimal" class="form-control" id="stock_minimal"  value="<?= $supplier['stock_minimal']?>" require>
                        </div>
                        <div class="form-group">
                            <label for="satuan">satuan</label>
                           <select name="satuan" id="satuan" class="form-control" require>
                            <option value="">-- satuan --</option>
                            <option value="pouch"<?= selectUser1($satuan)?>>pouch</option>
                            <option value="pack"<?= selectUser2($satuan)?>>pack</option>
                            <option value="kaleng"<?= selectUser3($satuan)?>>kaleng</option>
                           </select>
                        </div>
                        <div class="form-group">
                            <label for="tgl_produksi">Tanggal Produksi</label>
                            <input type="date" name="tgl_produksi" class="form-control" id="tgl_produksi"  value="<?= $supplier['tgl_produksi']?>" require>
                        </div>
                        <div class="form-group">
                            <label for="tgl_exp">Tanggal Expired</label>
                            <input type="date" name="tgl_exp" class="form-control" id="tgl_exp"  value="<?= $supplier['tgl_exp']?>" require>
                        </div>
                    </div>
                  
                    <div class="col-lg-4 text-center">
                        <input type="hidden" name="oldImg" value="<?= $supplier['foto']?>">
                        <img src="<?= $main_url?>assets/AdminLTE-3.2.0/img/<?= $supplier['foto']?>" class="profile-user-img img-circle mb-3" alt="">
                        <input type="file" class="form-control" name="foto">
                        <span class="text-sm">Type file gambar JPG | PNG </span><br>
                        <span class="text-sm">Width == Height</span>
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