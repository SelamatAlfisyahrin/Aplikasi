<?php

if(userLogin()['level'] ==3){
    header("location:".$main_url."error-page.php");
    exit();
}

function insert($data){
    global $koneksi;

    $nama = mysqli_real_escape_string($koneksi,$data['nama']);
    $telpon = mysqli_real_escape_string($koneksi,$data['telpon']);
    $deskripsi = strtolower(mysqli_real_escape_string($koneksi,$data['deskripsi']));
    $alamat = mysqli_real_escape_string($koneksi,$data['alamat']);
  
    $sqlSupplier = "INSERT INTO tbl_supplier VALUES (null, '$nama','$telpon','$deskripsi','$alamat')";

    mysqli_query($koneksi,$sqlSupplier);

    return mysqli_affected_rows($koneksi);
}

function delete($id){
    global $koneksi;


    $sqlDel = "DELETE FROM tbl_supplier WHERE id_supplier = $id";

    mysqli_query($koneksi,$sqlDel);

    return mysqli_affected_rows($koneksi);
}



function update($data){
    global $koneksi;

    $idsupplier = mysqli_real_escape_string($koneksi,$data['id_supplier']);

    $nama = mysqli_real_escape_string($koneksi,$data['nama']);
    $telpon = mysqli_real_escape_string($koneksi,$data['telpon']);
    $deskripsi = strtolower(mysqli_real_escape_string($koneksi,$data['deskripsi']));
    $alamat = mysqli_real_escape_string($koneksi,$data['alamat']);

 //cek usernmae

 $queryNama = mysqli_query($koneksi,"SELECT * FROM tbl_supplier WHERE id_supplier = $idsupplier");

 $dataNama = mysqli_fetch_assoc($queryNama);

 $curNama = $dataNama['nama'];

 //cek username baru
 $newNama   = mysqli_query($koneksi,"SELECT nama FROM tbl_supplier WHERE nama = '$nama'");

 if($nama !== $curNama){
    
    if(mysqli_num_rows($newNama)){
        echo'<script>
        alert("Supplier telah ada, gagal update data");
        
        document.location.href = "data-supplier.php";
        </script>';
        return false;
    }

 }

 mysqli_query($koneksi,"UPDATE tbl_supplier SET nama = '$nama',telpon = '$telpon',deskripsi = '$deskripsi',alamat = '$alamat'
 WHERE id_supplier = $idsupplier");


    return mysqli_affected_rows($koneksi);
}

?>