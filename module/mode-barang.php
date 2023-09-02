<?php

if(userLogin()['level'] ==3){
    header("location:".$main_url."error-page.php");
    exit();
}

function genereteId(){
    global $koneksi;
   

    $auto = mysqli_query($koneksi,"SELECT MAX(kode_barang) as MAX_CODE FROM tbl_barang");
    $data = mysqli_fetch_array($auto);
    $code=$data['MAX_CODE'];
    $urutan = (int)substr($code,4,3);
    $urutan++;
    $kode_perusahaan = "BRG-";
    $nomorindukpegawai = $kode_perusahaan.sprintf("%03s",$urutan);

    return $nomorindukpegawai;



    // $queryId = mysqli_query($koneksi,"SELECT MAX(kode_barang) AS maxid FROM tbl_barang");

    // $data = mysqli_fetch_array($queryId);
    // $maxid = $data['maxid'];

    // $noUrut = (int) substr($maxid, 4, 3);
    // $noUrut++;

    // $maxid = "BRG-". sprintf("%03s", $noUrut);

    // return $maxid;
}

function barcodeAuto(){
    global $koneksi;
    $auto = mysqli_query($koneksi,"SELECT MAX(kode_barang) as MAX_CODE FROM tbl_barang");
    $data = mysqli_fetch_array($auto);
    $code=$data['MAX_CODE'];
    $urutan = (int)substr($code,4,3);
    $urutan++;
    $date = date("dmY");
    $nomorindukpegawai = $date.sprintf("%03s",$urutan);

    return $nomorindukpegawai;


}

function insert($data){
    global $koneksi;

    $kode_barang = mysqli_real_escape_string($koneksi,$data['kode_barang']);
    $barcode = mysqli_real_escape_string($koneksi,$data['barcode']);
    $nama_barang = mysqli_real_escape_string($koneksi,$data['nama_barang']);
    $harga_beli = mysqli_real_escape_string($koneksi,$data['harga_beli']);
    $harga_jual = mysqli_real_escape_string($koneksi,$data['harga_jual']);
    $satuan = mysqli_real_escape_string($koneksi,$data['satuan']);
    $stock_minimal = mysqli_real_escape_string($koneksi,$data['stock_minimal']);
    $tgl_produksi = mysqli_real_escape_string($koneksi,$data['tgl_produksi']);
    $tgl_exp = mysqli_real_escape_string($koneksi,$data['tgl_exp']);
    $foto = mysqli_real_escape_string($koneksi,$_FILES['foto']['name']);

    if($foto != null){

        $foto = uploadimg();

    }else{
        $foto = 'baruu.png';
    }

    if($foto ==''){
        return false;
    }

    $sqlUser = "INSERT INTO tbl_barang VALUES (null, '$kode_barang','$barcode','$nama_barang',$harga_beli,$harga_jual,0,'$satuan',$stock_minimal,'$foto','$tgl_produksi','$tgl_exp')";

    mysqli_query($koneksi,$sqlUser);

    return mysqli_affected_rows($koneksi);
}

function delete($id, $foto){
    global $koneksi;


    $sqlDel = "DELETE FROM tbl_barang WHERE id_brg = $id";

    mysqli_query($koneksi,$sqlDel);

    if($foto != 'baruu.png'){
        unlink('../assets/AdminLTE-3.2.0/img/'.$foto);
    }


    return mysqli_affected_rows($koneksi);
}
function selectUser1($satuan){
    $result = null;
    if ($satuan == "pouch"){
        $result = "selected";
    }

    return $result;
}

function selectUser2($satuan){
    $result = null;
    if ($satuan == "pack"){
        $result = "selected";
    }

    return $result;
}

function selectUser3($satuan){
    $result = null;
    if ($satuan == "kaleng"){
        $result = "selected";
    }

    return $result;
}

function update($data){
    global $koneksi;

    $id_brg = mysqli_real_escape_string($koneksi,$data['id_brg']);
    $kode_barang = mysqli_real_escape_string($koneksi,$data['kode_barang']);
    $barcode = mysqli_real_escape_string($koneksi,$data['barcode']);
    $nama_barang = strtolower(mysqli_real_escape_string($koneksi,$data['nama_barang']));
    $harga_beli = mysqli_real_escape_string($koneksi,$data['harga_beli']);
    $harga_jual = mysqli_real_escape_string($koneksi,$data['harga_jual']);
    $stock_minimal = mysqli_real_escape_string($koneksi,$data['stock_minimal']);
    $tgl_produksi = mysqli_real_escape_string($koneksi,$data['tgl_produksi']);
    $tgl_exp = mysqli_real_escape_string($koneksi,$data['tgl_exp']);
    $foto = mysqli_real_escape_string($koneksi,$_FILES['foto']['name']);

    $fotoLama = mysqli_real_escape_string($koneksi,$data['oldImg']);

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


 mysqli_query($koneksi,"UPDATE tbl_barang SET nama_barang = '$nama_barang',harga_beli = '$harga_beli',harga_jual = '$harga_jual',stock_minimal = '$stock_minimal', tgl_produksi='$tgl_produksi',tgl_exp='$tgl_exp',foto='$imgUser'
 WHERE id_brg = $id_brg");

    return mysqli_affected_rows($koneksi);
}

?>