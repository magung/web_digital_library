<?php include "../admin/koneksi.php";  

  
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
    <link rel="stylesheet" href="../distribution/css/datepicker.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="../admin/img/icon/knowledge.png">
    
    <link rel="stylesheet" type="text/css" href="../distribution/DataTables/datatables.min.css"/>
    
    

  </head>



  <body>
    <!-- navbar-->
    <header class="header">
      <nav style="height:50px" class="navbar navbar-expand-lg px-4 py-2 bg-white shadow"><a href="#" class="sidebar-toggler text-gray-500 mr-4 mr-lg-5 lead"></a><a href="" class="navbar-brand font-weight-bold text-uppercase text-base" >Digital Library</a>

      </nav>
    </header>

    
      <div class="page-holder w-100 flex-wrap  d-flex justify-content-center">
        <div class="container-fluid px-xl-5 ">
            <section class="py-5 ">
                <div class="row d-flex justify-content-center"> 
                <div class="col-lg-6 mb-12">
                <?php 
                    //untuk memproses form 
                    if($_SERVER['REQUEST_METHOD']=='POST'){
                        $nama           = $_POST['nama'];
                        $alamat         = $_POST['alamat'];
                        $status         = $_POST['status'];
                        $jenis_kelamin  = $_POST['jenis_kelamin'];
                        $keperluan      = $_POST['keperluan'];
                        
                        if($nama=='' || $alamat=='' || $status=='' || $jenis_kelamin=='' || $keperluan==''){
                            echo "<div class='alert alert-warning  show alert-dismissible mt-2'>
                                    Data Belum lengkap harus di selesaikan !
                                </div>";	
                        }else{
                            //simpan data
                            $simpan = mysqli_query($koneksi,
                            "INSERT INTO `pengunjung` (`id_pengunjung`, `nama`, `alamat`, `status`, `jenis_kelamin`, `keperluan`, `tanggal_kunjungan`) VALUES (NULL, '$nama', '$alamat', '$status', '$jenis_kelamin', '$keperluan', NOW());");
                            
                            if($simpan){
                                
                                echo "<div class='alert alert-warning  show alert-dismissible mt-2'>
                                    Berhasil
                                </div>";

                                // echo "<meta http-equiv='refresh' content='0'>";
                            }
                        }
                    }

                ?>
                <div class="card">
                  <div class="card-header">
                    <h6 class="text-uppercase mb-0">Presensi Pengunjung</h6>
                  </div>
                  <div class="card-body table-responsive">                           
                    <form class='col-md-12' method="post" action="">
                      <div class="form-group">
                        <label class="form-control-label text-uppercase">Nama</label>
                        <input type="text" placeholder="nama" class="form-control" name='nama' required>
                      </div>
                      <div class="form-group">
                        <label class="form-control-label text-uppercase">Alamat</label>
                        <input type="text" placeholder="alamat" class="form-control" name='alamat' required>
                      </div>
                      <div class="form-group">
                        <label class="form-control-label text-uppercase">Status Pekerjaan</label>
                        <input type="text" placeholder="status" class="form-control" name='status' required>
                      </div>
                      <div class="form-group">
                        <label class="form-control-label text-uppercase">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class='form-control'>
                            <option value="Laki-Laki">Laki - Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label class="form-control-label text-uppercase">Keperluan</label>
                        <input type="text" placeholder="keperluan" class="form-control" name='keperluan' required>
                      </div>
                      <div class="form-group text-right"> 
                        <a href='' class='btn btn-secondary' data-dismiss='modal' aria-hidden='true'>Batal</a>       
                        <button type="submit" class="btn btn-primary">Kirim</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
                </div>
            </section>
        </div>
        <?php include "../admin/footer.php" ?>
      </div>
    </div>
    <!-- JavaScript files-->
    <?php include "../admin/script-footer.php" ?>
  </body>
</html>