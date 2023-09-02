<?php

session_start();
if(!isset($_SESSION["ssLoginPOS"])){
  header("location: ../auth/login.php");
  exit();
}

require"../config/koneksi.php";
require"../config/functions.php";
require"../module/mode-barang.php";

$id = $_GET['id_brg'];
$foto = $_GET['foto'];


if(delete($id,$foto)){
    echo'<script>
        alert("user berhasil dihapus..");
        document.location.href = "data-barang.php";
        </script>';
}else{
    echo'<script>
    alert("user gagal dihapus..");
    document.location.href = "data-barang.php";
    </script>';
}

?>