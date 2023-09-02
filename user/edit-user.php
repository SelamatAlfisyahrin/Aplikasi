<?php

session_start();
if(!isset($_SESSION["ssLoginPOS"])){
  header("location: ../auth/login.php");
  exit();
}

require"../config/koneksi.php";
require"../config/functions.php";
require"../module/mode-user.php";


$title = "Update-UserS POS";
require"../temp/header.php";
require"../temp/navbar.php";
require"../temp/sidebar.php";

$id = $_GET['id'];
$sqlEdit = "SELECT * FROM tbl_user WHERE userid = $id";
$user = getData($sqlEdit)[0];
$level = $user['level'];

if(isset($_POST['koreksi'])){
    if(update($_POST)){
        echo'<script>
        alert("data user berhasil diupdate");

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
              <li class="breadcrumb-item active">Edit User</li>
              
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
                <button type="submit" name="koreksi" class="btn btn-primary btn-sm float-right"><i class="fas fa-save fa-sm"></i>
                KOREKSI</button>
                <button type="reset" class="btn btn-warning btn-sm float-right mr-1"><i class="fas fa-times fa-sm"></i>
                RESET</button>
            </div>
            <div class="card-body">
                <div class="row">
                    <input type="hidden" value="<?= $user['userid']?>" name="id">
                    <div class="col-lg-8 mb-3">
                        <div class="form-group">
                            <label for="username">USERNAME</label>
                            <input type="text" name="username" class="form-control" id="username" placeholder="MASUKAN USERNAME" autofocus autocomplete="off" value="<?= $user['username']?>" require>

                        </div>
                        <div class="form-group">
                            <label for="fullname">FULLNAME</label>
                            <input type="text" name="fullname" class="form-control" id="fullname" placeholder="MASUKAN FULLNAME" value="<?= $user['fullname']?>" require>
                            
                        </div>
                       
                        <div class="form-group">
                            <label for="level">LEVEL</label>
                           <select name="level" id="level" class="form-control" require>
                            <option value="">-- level user --</option>
                            <option value="1" <?= selectUser1($level)?>>Administrator</option>
                            <option value="2"<?= selectUser2($level)?>>Supervisor</option>
                            <option value="3"<?= selectUser3($level)?>>Operator</option>
                           </select>
                        </div>
                        <div class="form-group">
                            <label for="address">ADDRESS</label>
                            <input type="text" name="address" class="form-control" id="address"  value="<?= $user['address']?>" require>
                            
                        </div>
                    </div>
                    <div class="col-lg-4 text-center">
                        <input type="hidden" name="oldImg" value="<?= $user['foto']?>">
                        <img src="<?= $main_url?>assets/AdminLTE-3.2.0/img/<?= $user['foto']?>" class="profile-user-img img-circle mb-3" alt="">
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