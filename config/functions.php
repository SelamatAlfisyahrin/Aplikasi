<?php


function uploadimg($url = null){
    $namafile = $_FILES['foto']['name'];
    $ukuran = $_FILES['foto']['size'];
    $tmp = $_FILES['foto']['tmp_name'];
    //validasi tipe gambar

    $ekstensiGambarValid = ['jpg','jpeg','png'];

    $ekstensiGambar = explode('.',$namafile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if(!in_array($ekstensiGambar,$ekstensiGambarValid)){

        if($url != null){

            echo'<script>
            alert("file yang anda upload bukan gambar, data gagal diupdate");

            document.location.href = "'.$url.'";
            </script>';
    
            die();

        }else{
            echo'<script>
            alert("file yang anda upload bukan gambar, data gagal ditambahkan");
            </script>';
    
            return false;
        }

      
    }

    //validasi ukuran gamabr max 1 mb

    if($ukuran > 1000000){

        if($url != null){

            echo'<script>
            alert("ukuran gambar melebihi 1 mb, gagal diupdate");

            document.location.href = "'.$url.'";
            </script>';
    
            die();

        }else{
            echo'<script>
            alert("Ukuran Gambar tidak boleh melebihi 1 mb");
            </script>';
    
            return false;
        }

    }

    $namafileBaru = rand(10,1000).'-'. $namafile;

    move_uploaded_file($tmp,'../assets/AdminLTE-3.2.0/img/'.$namafileBaru);
    return $namafileBaru;

}

function getData($sql){
    global $koneksi;
    $result = mysqli_query($koneksi,$sql);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function userLogin(){
    $userActive = $_SESSION["ssUserPos"];
    $dataUser = getData("SELECT * FROM tbl_user WHERE username = '$userActive'")[0];
    return $dataUser;
}

function userMenu(){
    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri_segments = explode('/',$uri_path);

    $menu = $uri_segments[2];
    return $menu;
}

function menuHome(){
    if(userMenu()=='dashboard.php'){
        $result = 'active';
    }else{
        $result = null;
    }

    return $result;
}

function menuSetting(){
    if(userMenu()=='user'){
        $result = 'menu-is-opening menu-open';
    }else{
        $result = null;
    }

    return $result;
}

function menuUser(){
    if(userMenu()=='user'){
        $result = 'active';
    }else{
        $result = null;
    }

    return $result;
}

function in_date($tgl){
    $tg = substr($tgl,8,2);
    $bln = substr($tgl,5,2);
    $thn = substr($tgl,0,4);

    return $tg . "-" . $bln . "-" . $thn;
}







?>