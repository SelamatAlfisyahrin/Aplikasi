<?php

session_start();
if(!isset($_SESSION["ssLoginPOS"])){
  header("location: ../auth/login.php");
  exit();
}

require"../config/koneksi.php";
require"../config/functions.php";
require"../module/mode-jual.php";


$title = "Transaksi Pembelian";
require"../temp/header.php";
require"../temp/navbar.php";
require"../temp/sidebar.php";

$kode = @$_GET['barcode'] ?  @$_GET['barcode'] : '';

if($kode){
    $selectBrg = getData("SELECT * FROM tbl_barang WHERE id_brg = '$kode'");
}
if($kode){
    $tgl = $_GET['tgl'];
    $dataBrg = mysqli_query($koneksi,"SELECT * FROM tbl_barang WHERE barcode = '$kode'");

    $selectBrg = mysqli_fetch_assoc($dataBrg);

    if(!mysqli_num_rows($dataBrg)){

        echo'<script>
        alert("Barcode Tidak Terdekteksi | Data Barang Belum Ada | Barang Tidak Ada");
        document.location = "?tgl=$tgl";
        </script>';

    }
}



if(isset($_POST['simpan'])){
    $nota = $_POST['nojual'];
    if(simpan($_POST)){
       
        echo"<script>
        alert('Berhasil Melakukan Transaksi Pembelian..');
        window.open('../report/r-struk.php?nojual=$nota','_blank');
        </script>";
    }
}

$nojual = genereteNo();
if(isset($_GET['msg'])){
    $msg = $_GET['msg'];
}else{
    $msg='';
}

if($msg=='deleted'){
    $barcode = $_GET['barcode'];
    $idjual = $_GET['idjual'];
    $qty = $_GET['qty'];
    $tgl = $_GET['tgl'];
    delete($barcode,$idjual,$qty,$tgl);

    echo"<script>
    document.location = 'index.php';
    
</script>";
}

if(isset($_POST['addbrg'])){
    $tgl = $_POST['tglNota'];
    if(insert($_POST)){
        echo"<script>
            document.location = 'index.php'?tgl=$tgl;
            header.location = 'index.php';
        </script>";
    }
    
    
   
}


?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pembelian Barang</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= $main_url?>dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Pembelian Barang</li>
              
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">

    <section>
        <div class="container-fluid">
            <form action="" method="POST">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card card-outline card-warning p-3">
                            <div class="form-group row mb-2">
                                <label for="nojual" class="col-sm-2 col-form-label">No Nota</label>
                                <div class="col-sm-4">
                                    <input type="text" name="nojual" class="form-control" id="nojual" value="<?= $nojual?>" readonly>
                                </div>
                                <label for="tglNota" class="col-sm-2 col-form-label">Tanggal Nota</label>
                                <div class="col-sm-4">
                                    <input type="date" name="tglNota" class="form-control" id="tglNota" value="<?= @$_GET['tgl'] ? $_GET['tgl'] :  date('Y-m-d')?>" required>
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="barcode" class="col-sm-2 col-form-label">
                                    BARCODE
                                </label>
                               <div class="col-sm-10 input-group">
                                <input type="text" name="barcode" id="barcode"  value="<?= @$_GET['barcode'] ? $_GET['barcode'] :  ''?>" class="form-control" placeholder="scan barcode barang">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="icon-barcode"><i class="fas fa-barcode"></i></span>
                                    
                                </div>
                               </div>
                              
                               
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                    <div class="card card-outline card-danger pt-3 px-3 pb-2">
                            <h6 class="font-weight-bold text-right">Total Pembelian</h6>
                            <h1 class="font-weight-bold text-right" style="font-size: 40pt;">
                            <input type="hidden" name="total" id="total" value="<?= totaljual($nojual)?>">
                            <?= number_format(totaljual($nojual),0,',','.')?></h1>
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="card pt-1 pb-2 px-3">
                    <div class="row">
                        <div class="col-lg-4">
                        <div class="form-group">
                                <input type="hidden" value="<?= @$_GET['barcode'] ? $selectBrg['barcode'] : ''?>" name="barcode">
                                <input type="hidden" value="<?= @$_GET['barcode'] ? $selectBrg['tgl_exp'] : ''?>" name="tgl_exp">
                                <label for="namaBrg">Nama Barang</label>
                                <input type="text" name="namaBrg" class="form-control form-control-sm" id="namaBrg"
                                 value="<?= @$_GET['barcode'] ? $selectBrg['nama_barang'] : ''?>" readonly required>
                            </div>
                        </div>
                        <div class="col-lg-1">
                            <div class="form-group">
                                <label for="stok">Stock</label>
                                <input type="number" name="stok" class="form-control form-control-sm" id="stok"
                                value="<?= @$_GET['barcode'] ? $selectBrg['stock'] : ''?>" readonly required>
                            </div>
                        </div>
                        <div class="col-lg-1">
                            <div class="form-group">
                                <label for="satuan">Satuan</label>
                                <input type="text" name="satuan" class="form-control form-control-sm" id="satuan"
                                value="<?= @$_GET['barcode'] ? $selectBrg['satuan'] : ''?>" readonly required>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input type="number" name="harga" class="form-control form-control-sm" id="harga"
                                value="<?= @$_GET['barcode'] ? $selectBrg['harga_jual'] : ''?>" readonly required>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="qty">Qty</label>
                                <input type="number" name="qty" class="form-control form-control-sm" id="qty"
                                value="<?= @$_GET['barcode'] ? 1 : ''?>" required>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="jmlHarga">Total</label>
                                <input type="number" name="jmlHarga" class="form-control form-control-sm" id="jmlHarga"
                                value="<?= @$_GET['barcode'] ? $selectBrg['harga_jual'] : ''?>" readonly required>
                            </div>
                        </div>
                    </div>
                    <button type="submit"   class="btn btn-sm btn-info btn-block" id="refresh" name="addbrg"><i class="fas fa-cart-plus fa-sm" onclick='window.location.reload();'></i>
                        Tambah Barang</button>
                </div>
                <div class="card card-outline card-success table-responsive px-2">
                    <table class="table table-sm table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th class="text-right">Harga</th>
                                <th class="text-right">Qty</th>
                                <th class="text-right">Jumlah Harga</th>
                                <th class="text-center" width="10%">Operasi</th>
                            </tr>
                        </thead>
                        <tbody>
                                    <?php
                                    $no = 1;
                                    $brgDetail = getData("SELECT * FROM tbl_jual_detail WHERE no_jual = '$nojual'");

                                    foreach($brgDetail as $detail){
                                        ?>
                                        <tr>
                                            <td><?= $no++?></td>
                                            <td><?= $detail['barcode']?></td>
                                            <td><?= $detail['nama_barang']?></td>
                                            <td class="text-right"><?= number_format($detail['harga_jual'],0,',','.') ?></td>
                                            <td class="text-right"><?= $detail['qty']?></td>
                                            <td class="text-right"><?= number_format($detail['jml_harga'],0,',','.') ?></td>
                                            <td class="text-center">
                                            <a href="?barcode=<?= $detail['barcode']?> & idjual=<?= $detail['no_jual']?>&qty=<?= $detail['qty']?>&tgl=<?= $detail['tgl_jual']?>&msg=deleted" class="btn btn-sm btn-danger" title="hapus barang" onclick="return confirm('Anda Yakin akan Menghapus barang Ini ?')"><i class="fas fa-trash"></i></a>
                                            </td>

                                        </tr>



                                        <?php
                                    }
                                    
                                    ?>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4 p-2">
                        <div class="form-group row mb-2">
                        <label for="customer" class="col-sm-3 col-form-label col-form-label-sm">Customer</label>
                        <div class="col-sm-9">
                            <select name="customer" id="customer" class="form-control form-control-sm">
                                <option value="">-- pilih Customer --</option>
                                <?php
                                        $customer = getData("SELECT * FROM tbl_customer");

                                        foreach($customers as $customer){
                                            ?>

                                            <option value="<?= $customer['nama']?>"><?= $spl['nama']?></option>

                                            <?php
                                        }
                                        
                                        ?>
                            </select>
                        </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="ketr" class="col-sm-3 col-form-label">Catatan</label>
                            <div class="col-sm-9">
                                <textarea name="ketr" id="ketr" class="form-control form-control-sm"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 py-2 px-3">
                        <div class="form-group row mb-2">
                            <label for="bayar" class="col-sm-3 col-form-label">Bayar</label>
                            <div class="col-sm-9">
                                <input type="number" name="bayar" class="form-control-sm text-right" id="bayar">
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="kembalian" class="col-sm-3 col-form-label">Kembalian</label>
                            <div class="col-sm-9">
                                <input type="number" name="kembalian" class="form-control-sm text-right" id="kembalian" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 p-2">
                        <button type="submit" name="simpan" id="simpan" class="btn btn-primary btn-sm btn-block"><i class="fa fas-save"></i>
                        Simpan</button>
                    </div>
                    </div>
                </div>
               
            </form>
        </div>
    </section>

    </section>
    <script type="text/javascript" src="../jquery.js"></script>

    <script  type="text/javascript">
  let barcode = document.getElementById('barcode');
  let tgl = document.getElementById('tglNota');
  let qty = document.getElementById('qty');
  let harga = document.getElementById('harga');
  let jmlHarga = document.getElementById('jmlHarga');
  let bayar = document.getElementById('bayar');
  let kembalian = document.getElementById('kembalian');
  let total = document.getElementById('total');
  barcode.addEventListener('change',function(){
    document.location.href = '?barcode=' + barcode.value + '&tgl=' + tgl.value;
  })


  qty.addEventListener('input',function(){
    jmlHarga.value = qty.value * harga.value;
   
  })
  bayar.addEventListener('input',function(){
    kembalian.value = bayar.value - total.value;
   
  })
</script>



   
<?php

require"../temp/footer.php";

?>