<?php

session_start();
if(!isset($_SESSION["ssLoginPOS"])){
  header("location: ../auth/login.php");
  exit();
}

require"../config/koneksi.php";
require"../config/functions.php";


$tgl1 = $_GET['tgl1'];
$tgl2 = $_GET['tgl2'];

$no=1;
$dataBeli = getData("SELECT * FROM tbl_jual_detail WHERE tgl_jual BETWEEN '$tgl1' AND '$tgl2'");
$dataBeli2 = getData("SELECT SUM(total) AS jualan FROM tbl_jual_head  WHERE tgl_jual BETWEEN '$tgl1' AND '$tgl2' ");
$barang = getData("SELECT nama_barang,SUM(qty) AS totalbarang FROM tbl_jual_detail  WHERE tgl_jual BETWEEN '$tgl1' AND '$tgl2' GROUP BY nama_barang ORDER BY totalbarang DESC LIMIT 5");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<table width="700" border="0" align="center" cellpadding="4" cellspacing="0">
<tr>
    <!-- <td align="left" width="8%"><img src="template/mamimol.png" width="90px" height="90px" /></td> -->
    <td align="left">
  <b><font color="#000000"><font size="6">LAPORAN PENJUALAN</b></font>
	<br />
	<b><font size="4" >Alamat</b></font><br />
	<b><font size="4">TELP</b></font><br />
  <b><font size="4">Periode: <?= in_date($tgl1)?> <?= "sampai"?> <?= in_date($tgl2)?></b></font><br />
	<br />
  </tr>
</table>
<table width="700" border="2" align="center" >
  <tr>
    <th  align="center" scope="col" bgcolor="#CCCCCC">No Nota</th>
    <th  align="center" scope="col" bgcolor="#CCCCCC">Tanggal</th>
    <th  align="cener" scope="col" bgcolor="#CCCCCC">Barang</th>   
    <th  align="cener" scope="col" bgcolor="#CCCCCC">Qty</th>   
    <th  align="center" scope="col" bgcolor="#CCCCCC">Total Belanja</th>         
  </tr>
<?php

foreach($dataBeli as $beli){
    ?>

<tr>
  
  <td align="left"><?php echo $beli['no_jual']?></td>
  <td align="center"><?php echo $beli['tgl_jual'] ?></td>
  <td align="left"><?php echo $beli['nama_barang'] ?></td>
  <td align="center"><?php echo $beli['qty'] ?></td>
  <td align="left">Rp. <?php echo  number_format($beli['jml_harga'], 0, ',','.') ?></td>
</tr>

    <?php
}
foreach($dataBeli2 as $totalbeli2){
?>
<tr>
			<td colspan="4" align="center"><b>TOTAL</b></td>
			<td align="center"><b> Rp. <?php echo number_format($totalbeli2['jualan'],0,".","."); ?></b></td>
						
</tr>
<?php
}

?>
	

</table>
<br>
<br>
<table width="700" border="0" align="center" cellpadding="4" cellspacing="0">
<tr>
    <!-- <td align="left" width="8%"><img src="template/mamimol.png" width="90px" height="90px" /></td> -->
    <td align="left">
	<b><font color="#000000"><font size="6">LAPORAN PENJUALAN BARANG TERBANYAK BERDASARKAN QTY TERJUAL</b></font>
	<br />
	<b><font size="4" >Alamat</b></font><br />
	<b><font size="4">TELP</b></font><br />
  <b><font size="4">Periode: <?= in_date($tgl1)?> <?= "sampai"?> <?= in_date($tgl2)?></b></font><br />
  </tr>
</table>
<table width="700" border="2" align="center" >
  <tr>
    <th  align="center" scope="col" bgcolor="#CCCCCC">No</th>    
    <th  align="center" scope="col" bgcolor="#CCCCCC">Nama Barang</th>    
    <th  align="center" scope="col" bgcolor="#CCCCCC">Qty</th>    
  </tr>
<?php

foreach($barang as $bar){

    ?>

<tr>
  <td align="left"><?php echo $no++ ?></td>
  <td align="left"><?php echo $bar['nama_barang']?></td>
  <td align="left"><?php echo $bar['totalbarang']?></td>
</tr>

    <?php
}

?>
	

</table>

</body>
</html>