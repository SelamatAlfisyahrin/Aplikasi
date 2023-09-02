<?php

session_start();
if(!isset($_SESSION["ssLoginPOS"])){
  header("location: ../auth/login.php");
  exit();
}

require"../config/koneksi.php";
require"../config/functions.php";
require"../module/mode-jual.php";


$title = "Laporan Penjualan";
require"../temp/header.php";
require"../temp/navbar.php";
require"../temp/sidebar.php";


$pembelian = getData("SELECT * FROM tbl_jual_head");

?>
<!-- content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Laporan Penjualan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= $main_url?>dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Laporan Penjualan</li>
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
            Laporan Penjualan</h3>
           <button type="button" class="btn btn-sm btn-outline-primary float-right" data-toggle="modal" data-target="#mdlPeriodeBeli"><i class="fas fa-print"> CETAK</i></button>
        </div>
        <div class="card-body table-responsive p-3">
            <table class="table table-hover text-nowrap" id="example">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">No Penjualan</th>
                        <th class="text-center">Total Belanja</th>
                        <th style="width: 10%;">Action</th>
                    </tr>
                </thead>
              
                <tbody>

                <?php
                
                $no = 1;

                foreach($pembelian as $beli){
                    ?>

                    <tr>
                        <td><?= $no++?></td>
                        <td><?= $beli['no_jual']?></td>
                        <td class="text-center">Rp. <?= number_format($beli['total'],0,",",".") ?></td>
                        <td class="text-center"><a href="detail-penjualan.php?id=<?= $beli['no_jual']?>&tgl=<?= in_date($beli['tgl_jual'])?>" class="btn btn-sm btn-info" title="detail penjualan"> Detail</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                    
                    
                </tbody>
              
            </table>
        </div>
            </div>
       
        </div>
    </section>
    <div class="modal fade" id="mdlPeriodeBeli">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Cetak Periode Penjualan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                <label for="nmBrg" class="col-sm-3 col-form-label">Tanggal Awal</label>
                <div class="col-sm-9">
                  <input type="date" class="form-control" id="tgl1">
                </div>
              </div>
              <div class="form-group row">
                <label for="nmBrg" class="col-sm-3 col-form-label">Tanggal Akhir</label>
                <div class="col-sm-9">
                  <input type="date" class="form-control" id="tgl2">
                </div>
              </div>
              
             
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" onclick="printDoc()"><i class="fas fa-print"> Cetak</i></button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      <script src="../jquery.js"></script>

      <script type="text/javascript">
        let tgl1 = document.getElementById('tgl1');
        let tgl2 = document.getElementById('tgl2');

        function printDoc(){
            if(tgl1.value != "" && tgl2.value !=""){

                window.open("../report/r-jual.php?tgl1="+ tgl1.value + "&tgl2=" + tgl2.value,"","width=900,height=600,left=100");

            }
        }
      </script>

<?php
require"../temp/footer.php";

?>