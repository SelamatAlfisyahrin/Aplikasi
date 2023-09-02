<?php

session_start();
if(!isset($_SESSION["ssLoginPOS"])){
  header("location: ../auth/login.php");
  exit();
}

require"../config/koneksi.php";
require"../config/functions.php";
require"../module/mode-user.php";

$title = "User-POS";
require"../temp/header.php";



require"../temp/navbar.php";
require"../temp/sidebar.php";
?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Users Data</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= $main_url?>dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">User</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

<section class="content">

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fas fa-list fa-sm"></i>
            Users Data</h3>
            <div class="card-tools">
                <a href="<?= $main_url?>user/add-user.php" class="btn btn-sm btn-primary"><i class="fas fa-plus-circle fa-sm"></i>
                USER</a>
            </div>
        </div>
        <div class="card-body table-responsive p-3">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Username</th>
                        <th>Fullname</th>
                        <th>Address</th>
                        <th>Level</th>
                        <th style="width: 10%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $users = getData("SELECT * FROM tbl_user");

                    foreach($users as $user): ?>

                    <tr>
                        <td><?= $no++?></td>
                        <td><img src="../assets/AdminLTE-3.2.0/img/<?= $user['foto']?>" class="rounded-circle" alt="" width="60px"></td>
                        <td><?= $user['username']?></td>
                        <td><?= $user['fullname']?></td>
                        <td><?= $user['address']?></td>
                        <td>
                            <?php
                            if($user['level']==1){
                                echo "Administrator";
                            }elseif($user['level']==2){
                                echo"Supervisor";
                            }else{

                                echo"Oprator";
                            }
                            
                            ?>
                        </td>
                        <td>
                            <a href="edit-user.php?id=<?= $user['userid']?>" class="btn btn-sm btn-warning" title="edit user"><i class="fas fa-user-edit"></i></a>
                            <a href="del-user.php?id=<?= $user['userid']?> & foto=<?= $user['foto']?>" class="btn btn-sm btn-danger" title="hapus user" onclick="return confirm('Anda Yakin akan menghapus user ini ?')"><i class="fas fa-user-times"></i></a>
                        </td>
                    </tr>

                    <?php endforeach;?>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

</section>

<?php

require"../temp/footer.php";
?>