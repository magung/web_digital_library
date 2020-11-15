<?php 
    include "koneksi.php"; 
    session_start();
    if(isset($_SESSION['username']) && isset($_SESSION['id_user'])){
      echo '<script> window.location.replace("index.php");</script>';
    }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Digital Library</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="../distribution/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- Google fonts - Popppins for copy-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,800">
    <!-- orion icons-->
    <link rel="stylesheet" href="../distribution/css/orionicons.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="../distribution/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="../distribution/css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="./img/icon/knowledge.png">
    
    <link rel="stylesheet" type="text/css" href="../distribution/DataTables/datatables.min.css"/>

  </head>
  <body>
    <div class="page-holder d-flex align-items-center">
      <div class="container">
        <div class="row align-items-center py-5">
          <div class="col-5 col-lg-7 mx-auto mb-5 mb-lg-0">
            <div class="pr-lg-5"><img src="../distribution/img/illustration.svg" alt="" class="img-fluid"></div>
          </div>
          <div class="col-lg-5 px-lg-4">
            <h1 class="text-base text-primary text-uppercase mb-4">Digital Library</h1>
            <h2 class="mb-4">Login</h2>
            <p class="text-muted">Silakan memasukkan username dan password anda agar dapat mengakses web admin</p>
            <?php 
                //untuk memproses form 
                if($_SERVER['REQUEST_METHOD']=='POST'){
                    $username    = $_POST['username'];
                    $password    = md5($_POST['password']);
                    
                    if($username=='' || $password==''){
                        echo "<div class='alert alert-warning  show alert-dismissible mt-2'>
                                silakan masukkan email dan password dengan benar !
                            </div>";	
                    }else{
                        $getdata = mysqli_query($koneksi,
                        "SELECT * FROM `user` WHERE username='$username' AND password='$password'");
                        $d=mysqli_fetch_array($getdata);
                        // var_dump($d);die();
                        if($d){
                            $new_kunjungan = 1 + $d['jumlah_login'];
                            $_SESSION['username'] = $username;
                            $_SESSION['id_user'] = $d['id_user'];
                            $_SESSION['nama'] = $d['nama'];
                            $update = mysqli_query($koneksi, "UPDATE user SET jumlah_login='$new_kunjungan' WHERE id_user='".$d['id_user']."'");

                            // header("Location: index.php");
                            echo '<script> window.location.replace("index.php");</script>';
                        }else{
                            echo "<div class='alert alert-warning  show alert-dismissible mt-2'>
                                silakan masukkan email dan password dengan benar !
                            </div>";	
                        }
                    }
                }
    
            ?>
            <form id="loginForm" method="post"  class="mt-4">
              <div class="form-group mb-4">
                <input type="text" name="username" placeholder="Username" class="form-control border-0 shadow form-control-lg">
              </div>
              <div class="form-group mb-4">
                <input type="password" name="password" placeholder="Password" class="form-control border-0 shadow form-control-lg text-violet">
              </div>
              <div class="form-group mb-4">
              </div>
              <button type="submit" class="btn btn-primary shadow px-5">Log in</button>
            </form>
          </div>
        </div>
        <p class="mt-5 mb-0 text-gray-400 text-center">Design by <a href="https://bootstrapious.com/admin-templates" class="external text-gray-400">Bootstrapious</a> & Team 3</p>
        <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)                 -->
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="../distribution/vendor/jquery/jquery.min.js"></script>
    <script src="../distribution/vendor/popper.js/umd/popper.min.js"> </script>
    <script src="../distribution/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../distribution/vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="../distribution/vendor/chart.js/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
    <script src="../distribution/js/charts-home.js"></script>
    <script src="../distribution/js/front.js"></script>
    <script type="text/javascript" src="../distribution/DataTables/datatables.min.js"></script>
  </body>
</html>