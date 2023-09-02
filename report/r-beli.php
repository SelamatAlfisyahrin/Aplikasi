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

$dataBeli = getData("SELECT * FROM tbl_beli_head WHERE tgl_beli BETWEEN '$tgl1' AND '$tgl2'");
$dataBeli2 = getData("SELECT SUM(total) AS belanja FROM tbl_beli_head  WHERE tgl_beli BETWEEN '$tgl1' AND '$tgl2' ");

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
	<b><font color="#000000"><font size="6">LAPORAN PEMBELIAN BARANG</b></font>
	<br />
	<b><font size="4" >Alamat</b></font><br />
	<b><font size="4">TELP</b></font><br />
  <b><font size="4">Periode: <?= in_date($tgl1)?> <?= "sampai"?> <?= in_date($tgl2)?></b></font><br />
  </tr>
</table>
<table width="700" border="2" align="center" >
  <tr>

    <th  align="center" scope="col" bgcolor="#CCCCCC">Tanggal Pembelian</th>
    <th  align="cener" scope="col" bgcolor="#CCCCCC">ID Pembelian</th>   
    <th  align="cener" scope="col" bgcolor="#CCCCCC">Supplier</th>   
    <th  align="center" scope="col" bgcolor="#CCCCCC">Total Pembelian</th>         
  </tr>
<?php

foreach($dataBeli as $beli){
    ?>

<tr>
  
  <td align="left"><?php echo $beli['tgl_beli']?></td>
  <td align="center"><?php echo $beli['no_beli'] ?></td>
  <td align="left"><?php echo $beli['suplier'] ?></td>
  <td align="right"><?php echo  number_format($beli['total'], 0, ',','.') ?></td>
</tr>

    <?php
}
foreach($dataBeli2 as $totalbeli2){
?>
<tr>
			<td colspan="3" align="center"><b>TOTAL</b></td>
			<td align="center"><b> Rp. <?php echo number_format($totalbeli2['belanja'],0,".","."); ?></b></td>
						
</tr>
<?php
}

?>
	

</table>

</body>
</html>