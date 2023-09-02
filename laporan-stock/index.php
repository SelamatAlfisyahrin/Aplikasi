<?php

session_start();
if(!isset($_SESSION["ssLoginPOS"])){
  header("location: ../auth/login.php");
  exit();
}

require"../config/koneksi.php";
require"../config/functions.php";
// require"../module/mode-beli.php";


$title = "Laporan Stock Barang";
require"../temp/header.php";
require"../temp/navbar.php";
require"../temp/sidebar.php";


$pembelian = getData("SELECT * FROM tbl_barang");

?>
<!-- content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Laporan Stock Barang</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= $main_url?>dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Stock Barang</li>
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
            Laporan Stock Barang</h3>
            <a href="<?= $main_url?>report/r-stock.php" class="btn btn-sm btn-outline-primary float-right" target="_blank"><i class="fas fa-print"></i>CETAK</a>
           <!-- <button type="button" class="btn btn-sm btn-outline-primary float-right" data-toggle="modal" data-target="#mdlPeriodeBeli"><i class="fas fa-print"> CETAK</i></button> -->
        </div>
        <div class="card-body table-responsive p-3">
            <table class="table table-hover text-nowrap" id="example">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Satuan</th>
                        <th>Stock</th>
                        <th>Stock Minimal</th>
                        <th>Status Stock</th>
                        <th>Status Expired</th>
                    </tr>
                </thead>
                <tbody>

                <?php
                
                $no = 1;

                foreach($pembelian as $beli){
                    ?>

                    <tr>
                        <td><?= $no++?></td>
                        <td><?= $beli['kode_barang']?></td>
                        <td><?= $beli['nama_barang']?></td>
                        <td><?= $beli['satuan']?></td>
                        <td class="text-center"><?= $beli['stock']?></td>
                        <td  class="text-center"><?= $beli['stock_minimal']?></td>
                        <td>
                        <?php
                        if($beli['stock'] < $beli['stock_minimal']){
                            echo"<span class='text-danger'>Stock Kurang</span>";
                        }else if($beli['stock'] == $beli['stock_minimal']){
                          echo"<span class='text-warning'>Stock Hampir Habis</span>";
                        }
                        else{
                            echo"<span class='text-success'>Stock Tersedia</span>";
                        }
                        
                        ?>
                        </td>
                        <td>
                        <?php
                        if(date('Y-m-d') > $beli['tgl_exp']){
                            echo"<span class='text-danger'>Expired</span>";
                        }else if(date('Y-m-d',strtotime('+ 3 day'))>=$beli['tgl_exp']){
                          echo"<span class='text-warning'>Almost Expired</span>";
                        }
                        else{
                            echo"<span class='text-success'>Unexpired</span>";
                        }
                        
                        ?>
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
              <h4 class="modal-title">Cetak Periode Pembelian</h4>
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

                window.open("../report/r-beli.php?tgl1="+ tgl1.value + "&tgl2=" + tgl2.value,"","width=900,height=600,left=100");

            }
        }
      </script>

<?php
require"../temp/footer.php";

?>