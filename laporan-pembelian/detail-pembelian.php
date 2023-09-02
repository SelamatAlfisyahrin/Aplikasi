<?php

session_start();
if(!isset($_SESSION["ssLoginPOS"])){
  header("location: ../auth/login.php");
  exit();
}

require"../config/koneksi.php";
require"../config/functions.php";
require"../module/mode-beli.php";


$title = "Laporan Pembelian";
require"../temp/header.php";
require"../temp/navbar.php";
require"../temp/sidebar.php";

$id = $_GET['id'];
$tgl = $_GET['tgl'];
$pembelian = getData("SELECT * FROM tbl_beli_detail WHERE no_beli = '$id'");

?>

<!-- content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Laporan Pembelian</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= $main_url?>dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Detail Pembelian</li>
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
            Rincian Barang</h3>
           <button type="button" class="btn btn-sm btn-primary float-right"><?= $id?></button>
           <button type="button" class="btn btn-sm btn-success float-right mr-1"><?= $tgl?></button>
        </div>
        <div class="card-body table-responsive p-3">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th class="text-center">Harga</th>
                        <th class="text-center">Qty</th>
                        <th class="text-center">Jumlah Harga</th>
                    </tr>
                </thead>
                <tbody>

                <?php
                
                $no = 1;

                foreach($pembelian as $beli){
                    ?>

                    <tr>
                        <td><?= $no++?></td>
                        <td><?= $beli['nama_barang']?></td>
                        <td class="text-center"><?= number_format($beli['harga_beli'],0,",",".") ?></td>
                        <td class="text-center"><?= $beli['qty']?></td>
                        <td class="text-center"><?= number_format($beli['jml_harga'],0,",",".") ?></td>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                    
                    
                </tbody>
            </table>
        </div>
        </div>
    </section>
<?php
require"../temp/footer.php";
?>