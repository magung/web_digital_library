<?php include "header.php"; ?>
<?php 
    //untuk memproses form 
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $member         = $_POST['member'];
        $keperluan      = $_POST['keperluan'];
        // var_dump($member);
        // var_dump($keperluan);
        // die();
        $datamember = explode("@|@", $member);
        var_dump($member);
        if($member=='' || $keperluan==''){
            echo "<div class='alert alert-warning  show alert-dismissible mt-2'>
                    Data Belum lengkap harus di selesaikan !
                </div>";	
        }else{
            //simpan data
            $simpan = mysqli_query($koneksi,
            "INSERT INTO `pengunjung` (`id_pengunjung`, `nama`, `alamat`, `status`, `jenis_kelamin`, `keperluan`, `tanggal_kunjungan`) VALUES (NULL, '$datamember[0]', '$datamember[1]', '$datamember[2]', '$datamember[3]', '$keperluan', NOW());");
            // var_dump($simpan);die();
            if($simpan){
              echo "<meta http-equiv='refresh' content='0'>";
            }
        }
    }

?>
  <body>
    <!-- navbar-->
    <header class="header">
      <nav class="navbar navbar-expand-lg px-4 py-2 bg-white shadow"><a href="#" class="sidebar-toggler text-gray-500 mr-4 mr-lg-5 lead"><i class="fas fa-align-left"></i></a><a href="index.html" class="navbar-brand font-weight-bold text-uppercase text-base">Digital Library</a>
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
                    <h6 class="text-uppercase mb-0">Pengunjung</h6><br>
                    <a class='btn btn-success btn-sm' href='pengunjung-tambah.php' >
                    <i class='fas fa-plus'></i> Tambah</a>
                    <a class='btn btn-primary btn-sm' href='#modalTambah' data-toggle='modal'>
                    <i class='fas fa-plus'></i> Tambah dari data Anggota</a>
                  </div>
                  <div class="card-body table-responsive">                           
                    <table class="table table-striped table-hover card-text" id='dataTables-search'>
                      <thead>
                        <tr>
                          <th>NO</th>
                          <th>Nama</th>
                          <th>Alamat</th>
                          <th>Status Pekerjaan</th>
                          <th>Jenis Kelamin</th>
                          <th>Keperluan</th>
                          <th>Tanggal</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        $sql=mysqli_query($koneksi, "SELECT * FROM `pengunjung` ORDER BY `pengunjung`.`tanggal_kunjungan` DESC");
                        $no = 1;
                        while($d=mysqli_fetch_array($sql)){
                          echo "<tr id='search'>
                                  <td>".$no++."</td>
                                  <td>$d[nama]</td>
                                  <td>$d[alamat]</td>
                                  <td>$d[status]</td>
                                  <td>$d[jenis_kelamin]</td>
                                  <td>$d[keperluan]</td>
                                  <td>$d[tanggal_kunjungan]</td>
                                </tr>
                              ";
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
                </div>
            </section>
        </div>
        <div class='modal small fade' id='modalTambah' tabindex='-1' role='dialog' aria-labelledby='modalTambahLabel' aria-hidden='true'>
          <div class='modal-dialog'>
              <div class='modal-content'>
                  <div class='modal-header'>
                      <h5 id='modalTambahLabel'>Tambah Pengunjung</h5>
                  </div>
                  <div class='row modal-body p-3'>
                    <form class='col-md-12' method="post" action="">
                      <div class="form-group">
                        <label class="form-control-label text-uppercase">Anggota</label>
                        <select name='member' class='form-control' required>
                          <option value=''>-- pilih anggota --</option>
                          <?php 
                            $sqlmem=mysqli_query($koneksi, 'SELECT * FROM members');  
                            while($datamem=mysqli_fetch_array($sqlmem)){
                              echo "<option value='$datamem[nama]@|@$datamem[alamat]@|@$datamem[status_pekerjaan]@|@$datamem[jenis_kelamin]'>$datamem[nama]</option>";
                            }
                          ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label class="form-control-label text-uppercase">Keperluan</label>
                        <input type="text" placeholder="keperluan" class="form-control" name='keperluan' required>
                      </div>
                      <div class="form-group text-right"> 
                        <a href='' class='btn btn-secondary' data-dismiss='modal' aria-hidden='true'>Batal</a>       
                        <button type="submit" class="btn btn-primary">Simpan</button>
                      </div>
                    </form>
                  </div>
              </div>
          </div>
        </div>
        <?php include "footer.php" ?>
      </div>
    </div>
    <!-- JavaScript files-->
    <?php include "script-footer.php" ?>
  </body>
</html>