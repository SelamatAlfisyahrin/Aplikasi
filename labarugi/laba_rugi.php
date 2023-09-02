<?php
error_reporting(0);
session_start();
if(!isset($_SESSION["ssLoginPOS"])){
  header("location: ../auth/login.php");
  exit();
}
include"../config/koneksi.php";

require"../config/koneksi.php";



$tgl1 = $_POST['tgl1'];
$tgl2 = $_POST['tgl2'];

?>
<table style="width:800px;border:none;" align="center">
<tr>
    <th colspan="5" align="center" scope="col">Ida Weeding</th>
  </tr>
  <tr>
    <th><p>Jl. Lkr. Istana, Demang Lebar Daun, Kec Ilir Barat I, Kota Palembang</p></th>
  </tr>
  <tr>
    <th colspan="5" align="center" scope="col"><font color="#000000" face="Tahoma, Geneva, sans-serif" size="2"><b>Laporan Laba Rugi Periode <?php echo $tgl1 ?>-<?php echo $tgl2?></b></th>
  </tr>  
  <tr>
    <th colspan="5" align="center" scope="col"><hr /></th>
  </tr>
</table>
<table style="width:800px;border: 2;;" align="center">
<tr>
    <td style="width:10px;">&nbsp; </td>
    <td>&nbsp; </td>
    <td style="text-align:right;width:150px;padding-right:20px;">&nbsp; </td>
    <td style="text-align:right;width:150px;padding-right:20px;">&nbsp; </td>
  </tr>
  <?php
  
  
  $data_penjualan=mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(total) AS pendapatan_kotor FROM tbl_jual_head  WHERE tgl_jual BETWEEN '$tgl1' AND '$tgl2' "));
  $jual=$data_penjualan['pendapatan_kotor'];
   
  
  $today = date('Y-m-d');
  $data_kerugian=mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(harga_beli * stock) AS kerugian_barang FROM tbl_barang WHERE tgl_exp <= '$today' "));
  $kerugian=$data_kerugian['kerugian_barang'];

  $data_pembelian=mysqli_fetch_array(mysqli_query($koneksi,"SELECT SUM(total) AS modal_usaha FROM tbl_beli_head WHERE tgl_beli BETWEEN '$tgl1' AND '$tgl2'"));
  $pembelian=$data_pembelian['modal_usaha'];
  
  
  $laba_kotor=$jual;
  $rugi=$kerugian;
  $pembelianbarang = $pembelian;

  $x=$rugi + $pembelianbarang;

  $laba_bersih=$laba_kotor - ($rugi + $pembelianbarang) ;
  
  if($laba_bersih>=0){$keterangan="Laba";}else{$keterangan="Rugi";}
  
  $total=$laba_bersih;
  
  
  ?>
  
  <tr>
  	<td style="text-align:left;" colspan="2"><b>Laba Kotor</b></td>
    <td></td>
    <td style="text-align:right;padding-right:20px;"></td>    
  </tr>
  <tr>
  	<td style="text-align:left;"></td>
    <td style="text-align:left;">Penerimaan Pendapatan Penjualan Barang</td>
    <td></td>
    <td style="text-align:right;padding-right:20px;"><b style="color:#09C;"><?= $laba_kotor?></b></td>    
  </tr>
  <tr>
  	<td style="text-align:left;" colspan="2"><b>Kerugian Akibat Barang Kadaluarsa</b></td>
    <td></td>
    <td style="text-align:right;padding-right:20px;"></td>    
  </tr>
  <tr>
  	<td style="text-align:left;"></td>
    <td style="text-align:left;">Total Kerugian</td>
    <td></td>
    <td style="text-align:right;padding-right:100px;border-top:1px solid #DDD;"><b style="color:#C00;"><?=$rugi?></b></td>    
  </tr>
  <tr>
  	<td style="text-align:left;" colspan="2"><b>Pembelian Stock Barang</b></td>
    <td></td>
    <td style="text-align:right;padding-right:20px;"></td>    
  </tr>
  <tr>
  	<td style="text-align:left;"></td>
    <td style="text-align:left;">Total Pembelian</td>
    <td></td>
    <td style="text-align:right;padding-right:100px;border-top:1px solid #DDD;"><b style="color:#C00;"><?=$pembelianbarang?></b></td>    
  </tr>
  <tr><td>&nbsp; </td></tr>

<tr>
  <td style="text-align:left;"></td>
  <td style="text-align:left;"><b><?=$keterangan?></b><br />
    
  </td>
  <td></td>
  <td style="text-align:right;padding-right:20px;color:#009;font-weight:bold;vertical-align:top;"><?php if($total>=0){echo $total;}else{echo"<span style='color:red'>".$total."</span>";}?></td>
</tr>
</table>
  

 
  
   


 
