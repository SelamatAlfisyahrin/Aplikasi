<?php

session_start();
if(!isset($_SESSION["ssLoginPOS"])){
  header("location: ../auth/login.php");
  exit();
}

require"../config/koneksi.php";
require"../config/functions.php";
require"../module/mode-supplier.php";

$id = $_GET['id_supplier'];



if(delete($id)){
    echo'<script>
        alert("supplier berhasil dihapus..");
        document.location.href = "data-supplier.php";
        </script>';
}else{
    echo'<script>
    alert("supplier gagal dihapus..");
    document.location.href = "data-supplier.php";
    </script>';
}

?>