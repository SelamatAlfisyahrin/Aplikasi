<?php

session_start();
if(!isset($_SESSION["ssLoginPOS"])){
  header("location: ../auth/login.php");
  exit();
}

require"../config/koneksi.php";
require"../config/functions.php";
require"../module/mode-barang.php";

$title = "User-POS";
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
            <h1 class="m-0">Users Data</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= $main_url?>dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">User</li>
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
                <a href="<?= $main_url?>barang/add-barang.php" class="btn btn-sm btn-primary"><i class="fas fa-plus-circle fa-sm"></i>
                Barang</a>
            </div>
        </div>
        <div class="card-body table-responsive p-3">
            <table class="table table-hover text-nowrap" id="example">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Harga Modal /barang</th>
                        <th>Harga Jual /barang</th>
                        <th>Stock</th>
                        <th>Expired</th>
                        <th>barcode</th>
                        <th style="width: 10%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $users = getData("SELECT * FROM tbl_barang");

                    foreach($users as $user): ?>

                    <tr>
                        <td><?= $no++?></td>
                        <td><img src="../assets/AdminLTE-3.2.0/img/<?= $user['foto']?>" class="rounded-circle" alt="" width="60px"></td>
                        <td><?= $user['kode_barang']?></td>
                        <td><?= $user['nama_barang']?></td>
                        <td><?= $user['harga_beli']?></td>
                        <td><?= $user['harga_jual']?></td>
                        <td><?= $user['stock']?></td>
                        <td><?= in_date( $user['tgl_exp'])?></td>
                        <td><?= $user['barcode']?></td>
                      
                        <td>
                            <button type="button" class="btn btn-sm btn-secondary" id="btnCetakBarcode" data-barcode="<?= $user['barcode']?>" data-nama="<?= $user['nama_barang']?>" title="cetak barcode"><i class="fas fa-barcode"></i></button>
                            <a href="edit-barang.php?id_brg=<?= $user['id_brg']?>" class="btn btn-sm btn-warning" title="edit user"><i class="fas fa-user-edit"></i></a>
                            <a href="del-barang.php?id_brg=<?= $user['id_brg']?> & foto=<?= $user['foto']?>" class="btn btn-sm btn-danger" title="hapus user" onclick="return confirm('Anda Yakin akan menghapus barang ini ?')"><i class="fas fa-user-times"></i></a>
                        </td>
                    </tr>

                    <?php endforeach;?>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

</section>

<div class="modal fade" id="mdlCetakBarcode">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Cetak Barcode</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                <label for="nmBrg" class="col-sm-3 col-form-label">Nama Barang</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="nmBrg" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="barcode" class="col-sm-3 col-form-label">Barcode</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="barcode" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="jmlCetak" class="col-sm-3 col-form-label">Jumlah Cetak</label>
                <div class="col-sm-9">
                  <input type="number" min="1" max="10" value="1" title="maximal 10" id="jmlCetak" class="form-control" id="jmlCetak">
                </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="preview"><i class="fas fa-print"></i>
                Cetak</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      <script type="text/javascript" src="../jquery.js"></script>

      <script  type="text/javascript">
        $(document).ready(function(){
          $(document).on("click", "#btnCetakBarcode", function(){
            $('#mdlCetakBarcode').modal('show');
            let barcode = $(this).data('barcode');
            let nama = $(this).data('nama');
            $('#nmBrg').val(nama);
            $('#barcode').val(barcode);
          })

          $(document).on("click", "#preview", function(){
            
            let barcode = $('#barcode').val();
            let jmlCetak = $('#jmlCetak').val();
          if(jmlCetak > 0 && jmlCetak <=10){
              window.open("../report/r-barcode.php?barcode=" + barcode + "& jmlCetak="+ jmlCetak)
          }
          })

          
        })
      </script>

<?php

require"../temp/footer.php";
?>