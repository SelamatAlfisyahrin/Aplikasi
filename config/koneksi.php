<?php
date_default_timezone_set('Asia/Jakarta');


$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'db_pos';

$koneksi = mysqli_connect($host,$user,$pass,$dbname);

// if (mysqli_connect_errno()){
//     echo'Gagal Koneksi DataBase';

//     exit();
// }else{
//     echo'bershasil terkoneksi';
// }

$main_url = 'http://localhost/pos_application/';

?>