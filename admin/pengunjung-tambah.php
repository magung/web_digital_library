<?php include "header.php"; ?>
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
                echo '<script> window.location.replace("pengunjung.php");</script>';
            }
        }
    }

?>
  <body>
    <!-- navbar-->
    <header class="header">
      <nav class="navbar navbar-expand-lg px-4 py-2 bg-white shadow"><a href="#" class="sidebar-toggler text-gray-500 mr-4 mr-lg-5 lead"><i class="fas fa-align-left"></i></a><a href="index.php" class="navbar-brand font-weight-bold text-uppercase text-base">Digital Library</a>
        <ul class="ml-auto d-flex align-items-center list-unstyled mb-0">
          
        </ul>
      </nav>
    </header>

    <div class="d-flex align-items-stretch">
      <div id="sidebar" class="sidebar py-3">
        <div class="text-gray-400 text-uppercase px-3 px-lg-4 py-4 font-weight-bold small headings-font-family">MAIN</div>
        <ul class="sidebar-menu list-unstyled">
            <li class="sidebar-list-item"><a href="index.php" class="sidebar-link text-muted"><i class="o-home-1 mr-3 text-gray"></i><span>Home</span></a></li>
            <li class="sidebar-list-item"><a href="members.php" class="sidebar-link text-muted"><i class="fas fa-user-friends mr-3 text-gray"></i><span>Anggota</span></a></li>
            <li class="sidebar-list-item"><a href="pengunjung.php" class="sidebar-link text-muted active"><i class="fas fa-user-friends mr-3 text-gray"></i><span>Pengunjung</span></a></li>
            <li class="sidebar-list-item"><a href="#" data-toggle="collapse" data-target="#peminjaman" aria-expanded="false" aria-controls="peminjaman" class="sidebar-link text-muted"><i class="o-table-content-1 mr-3 text-gray"></i><span>Peminjaman</span></a>
                <div id="peminjaman" class="collapse">
                <ul class="sidebar-menu list-unstyled border-left border-primary border-thick">
                    <li class="sidebar-list-item"><a href="peminjaman-menunggu-konfirmasi.php" class="sidebar-link text-muted pl-lg-5">Menunggu Konfirmasi</a></li>
                    <li class="sidebar-list-item"><a href="peminjaman-dikirim.php" class="sidebar-link text-muted pl-lg-5">Dikirim</a></li>
                    <li class="sidebar-list-item"><a href="peminjaman-dipinjam.php" class="sidebar-link text-muted pl-lg-5">Dipinjam</a></li>
                    <li class="sidebar-list-item"><a href="peminjaman-selesai.php" class="sidebar-link text-muted pl-lg-5">Selesai</a></li>
                    <li class="sidebar-list-item"><a href="peminjaman-batal.php" class="sidebar-link text-muted pl-lg-5">Batal</a></li>
                </ul>
                </div>
            </li>
            <li class="sidebar-list-item"><a href="#" data-toggle="collapse" data-target="#master-data" aria-expanded="false" aria-controls="master-data" class="sidebar-link text-muted"><i class="o-database-1 mr-3 text-gray"></i><span>Master Data</span></a>
                <div id="master-data" class="collapse">
                <ul class="sidebar-menu list-unstyled border-left border-primary border-thick">
                    <li class="sidebar-list-item"><a href="buku.php" class="sidebar-link text-muted pl-lg-5">Buku</a></li>
                    <li class="sidebar-list-item"><a href="kategori.php" class="sidebar-link text-muted pl-lg-5">Kategori</a></li>
                    <li class="sidebar-list-item"><a href="kurir.php" class="sidebar-link text-muted pl-lg-5">Kurir</a></li>
                    <li class="sidebar-list-item"><a href="user.php" class="sidebar-link text-muted pl-lg-5">User</a></li>
                </ul>
                </div>
            </li>
              <li class="sidebar-list-item"><a href="logout.php" class="sidebar-link text-muted"><i class="o-exit-1 mr-3 text-gray"></i><span>Logout</span></a></li>
        </ul>
      </div>
      <div class="page-holder w-100 d-flex flex-wrap">
        <div class="container-fluid px-xl-5">
            <section class="py-5">
                <div class="row">
                <div class="col-lg-12 mb-12">
                <div class="card">
                  <div class="card-header">
                    <h6 class="text-uppercase mb-0">Daftar Pengunjung</h6>
                  </div>
                  <div class="card-body table-responsive">                           
                    <form class='col-md-6' method="post" action="">
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
                        <a href='pengunjung.php' class='btn btn-secondary' data-dismiss='modal' aria-hidden='true'>Batal</a>       
                        <button type="submit" class="btn btn-primary">Simpan</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
                </div>
            </section>
        </div>
        <?php include "footer.php" ?>
      </div>
    </div>
    <!-- JavaScript files-->
    <?php include "script-footer.php" ?>
  </body>
</html>