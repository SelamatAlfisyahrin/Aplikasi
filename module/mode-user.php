<?php

if(userLogin()['level'] !=1){
    header("location:".$main_url."error-page.php");
    exit();
}

function insert($data){
    global $koneksi;

    $username = strtolower(mysqli_real_escape_string($koneksi,$data['username']));
    $fullname = mysqli_real_escape_string($koneksi,$data['fullname']);
    $password = mysqli_real_escape_string($koneksi,$data['password']);
    $password2 = mysqli_real_escape_string($koneksi,$data['password2']);
    $level = mysqli_real_escape_string($koneksi,$data['level']);
    $address = mysqli_real_escape_string($koneksi,$data['address']);
    $foto = mysqli_real_escape_string($koneksi,$_FILES['foto']['name']);


    if($password !== $password2){
        echo'<script>
        alert("Password Tidak Sama");
        </script>';
        return false;
    }

    $pass = password_hash($password, PASSWORD_DEFAULT);

    $cekUsername = mysqli_query($koneksi,"SELECT username FROM tbl_user WHERE username = '$username'");

    if(mysqli_num_rows($cekUsername)>0){
        echo'<script>
        alert("Username telah ada");
        </script>';
        return false;
    }

    if($foto != null){

        $foto = uploadimg();

    }else{
        $foto = 'baruu.png';
    }

    if($foto ==''){
        return false;
    }

    $sqlUser = "INSERT INTO tbl_user VALUES (null, '$username','$fullname','$pass','$address','$level','$foto')";

    mysqli_query($koneksi,$sqlUser);

    return mysqli_affected_rows($koneksi);
}

function delete($id, $foto){
    global $koneksi;


    $sqlDel = "DELETE FROM tbl_user WHERE userid = $id";

    mysqli_query($koneksi,$sqlDel);

    if($foto != 'baruu.png'){
        unlink('../assets/AdminLTE-3.2.0/img/'.$foto);
    }


    return mysqli_affected_rows($koneksi);
}
function selectUser1($level){
    $result = null;
    if ($level == 1){
        $result = "selected";
    }

    return $result;
}

function selectUser2($level){
    $result = null;
    if ($level == 2){
        $result = "selected";
    }

    return $result;
}

function selectUser3($level){
    $result = null;
    if ($level == 3){
        $result = "selected";
    }

    return $result;
}

function update($data){
    global $koneksi;

    $iduser = mysqli_real_escape_string($koneksi,$data['id']);

    $username = strtolower(mysqli_real_escape_string($koneksi,$data['username']));
    $fullname = mysqli_real_escape_string($koneksi,$data['fullname']);
    $level = mysqli_real_escape_string($koneksi,$data['level']);
    $address = mysqli_real_escape_string($koneksi,$data['address']);
    $foto = mysqli_real_escape_string($koneksi,$_FILES['foto']['name']);

    $fotoLama = mysqli_real_escape_string($koneksi,$data['oldImg']);


 //cek usernmae

 $queryUsername = mysqli_query($koneksi,"SELECT * FROM tbl_user WHERE userid = $iduser");

 $dataUsername = mysqli_fetch_assoc($queryUsername);

 $curUsername = $dataUsername['username'];

 //cek username baru
 $newUsername   = mysqli_query($koneksi,"SELECT username FROM tbl_user WHERE username = '$username'");

 if($username !== $curUsername){
    
    if(mysqli_num_rows($newUsername)){
        echo'<script>
        alert("Username telah ada, gagal update data");
        
        document.location.href = "data-user.php";
        </script>';
        return false;
    }

 }

 //cek gambar

 if($foto != null){
    $url = "data-user.php";
    $imgUser = uploadimg($url);
    
    if($fotoLama !='baruu.png'){
    @unlink('../assets/AdminLTE-3.2.0/img/'.$fotoLama);
    
    }
 }else{
    $imgUser = $fotoLama;
 }


 mysqli_query($koneksi,"UPDATE tbl_user SET username = '$username',fullname = '$fullname',address = '$address',level = '$level',foto='$imgUser'
 WHERE userid = $iduser");


    return mysqli_affected_rows($koneksi);
}

?>