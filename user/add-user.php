<?php

session_start();
if(!isset($_SESSION["ssLoginPOS"])){
  header("location: ../auth/login.php");
  exit();
}

require"../config/koneksi.php";
require"../config/functions.php";
require"../module/mode-user.php";


$title = "Add-Users POS";
require"../temp/header.php";
require"../temp/navbar.php";
require"../temp/sidebar.php";

if(isset($_POST['simpan'])){
    if(insert($_POST)>0){
        echo'<script>
        alert("Berhasil Menambah User");
        document.location.href = "data-user.php";
        </script>';


    }
}

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= $main_url?>dashboard.php">Home</a></li>
              <li class="breadcrumb-item"><a href="<?= $main_url?>user/data-user.php">Users</a></li>
              <li class="breadcrumb-item active">add user</li>
              
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">

    <div class="conteiner-fluid">
        <div class="card">
        <form action="" method="POST" enctype="multipart/form-data">
            
          
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user-plus fa-sm"></i>
                Add User</h3>
                <button type="submit" name="simpan" class="btn btn-primary btn-sm float-right"><i class="fas fa-save fa-sm"></i>
                SIMPAN</button>
                <button type="reset" class="btn btn-warning btn-sm float-right mr-1"><i class="fas fa-times fa-sm"></i>
                RESET</button>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8 mb-3">
                        <div class="form-group">
                            <label for="username">USERNAME</label>
                            <input type="text" name="username" class="form-control" id="username" placeholder="MASUKAN USERNAME" autofocus autocomplete="off" require>

                        </div>
                        <div class="form-group">
                            <label for="fullname">FULLNAME</label>
                            <input type="text" name="fullname" class="form-control" id="fullname" placeholder="MASUKAN FULLNAME"require>
                            
                        </div>
                        <div class="form-group">
                            <label for="password">PASSWORD</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="MASUKAN PASSWORD"require>
                        </div>
                        <div class="form-group">
                            <label for="password2">KONFIRMASI PASSWORD</label>
                            <input type="password" name="password2" class="form-control" id="password2" placeholder="MASUKAN KONFIRMASI PASSWORD"require> 
                        </div>
                        <div class="form-group">
                            <label for="level">LEVEL</label>
                           <select name="level" id="level" class="form-control" require>
                            <option value="">-- level user --</option>
                            <option value="1">Administrator</option>
                            <option value="2">Supervisor</option>
                            <option value="3">Operator</option>
                           </select>
                        </div>
                        <div class="form-group">
                            <label for="address">ADDRESS</label>
                            <textarea name="address" id="address" cols="" rows="3" placeholder="MASUKAN ALAMAT" class="form-control" require></textarea>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center">
                        <img src="<?= $main_url?>assets/AdminLTE-3.2.0/img/baruu.png" class="profile-user-img img-circle mb-3" alt="">
                        <input type="file" class="form-control" name="foto">
                        <span class="text-sm">Type file gambar JPG | PNG </span><br>
                        <span class="text-sm">Width == Height</span>
                    </div>
                 
                </div>
            </div>
            </form>
        </div>
    </div>

    </section>

<?php

require"../temp/footer.php";

?>