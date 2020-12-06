<?php include "header.php"; ?>
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
            <li class="sidebar-list-item"><a href="pengunjung.php" class="sidebar-link text-muted"><i class="fas fa-user-friends mr-3 text-gray"></i><span>Pengunjung</span></a></li>
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
            <li class="sidebar-list-item"><a href="#" data-toggle="collapse" data-target="#master-data" aria-expanded="false" aria-controls="master-data" class="sidebar-link text-muted active"><i class="o-database-1 mr-3 text-gray"></i><span>Master Data</span></a>
                <div id="master-data" class="collapse">
                <ul class="sidebar-menu list-unstyled border-left border-primary border-thick">
                    <li class="sidebar-list-item"><a href="buku.php" class="sidebar-link text-muted pl-lg-5">Buku</a></li>
                    <li class="sidebar-list-item"><a href="kategori.php" class="sidebar-link text-muted pl-lg-5">Kategori</a></li>
                    <li class="sidebar-list-item"><a href="kurir.php" class="sidebar-link text-muted pl-lg-5">Kurir</a></li>
                    <li class="sidebar-list-item"><a href="user.php" class="sidebar-link text-muted pl-lg-5 active">User</a></li>
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
                <?php 
                  //untuk memproses form 
                  if($_SERVER['REQUEST_METHOD']=='POST'){
                      $nama        = $_POST['nama'];
                      $username    = $_POST['username'];
                      $password    = $_POST['password'];

                      if($nama=='' || $username==''){
                          echo "<div class='alert alert-warning  show alert-dismissible mt-2'>
                                  Data Belum lengkap harus di selesaikan !
                              </div>";	
                      }else{
                        if (isset($_POST['iduser'])){
                          //simpan data
                          $id = $_POST['iduser'];
                          $simpan = mysqli_query($koneksi,
                          "UPDATE `user` SET `nama` = '$nama', `username` = '$username' WHERE `user`.`id_user` = $id;");
                          
                          if($simpan){
                            //header("Location: ".$_SERVER['PHP_SELF']);
                            echo "<meta http-equiv='refresh' content='0'>";
                          }else{
                            echo "<div class='alert alert-warning  show alert-dismissible mt-2'>
                                  Gagal menambahkan, mungkin username sudah digunakan !
                              </div>";	
                          }
                        }else{
                          //simpan data
                          $password = md5($password);
                          $simpan = mysqli_query($koneksi,
                          "INSERT INTO `user` (`id_user`, `nama`, `username`, `password`) VALUES (NULL, '$nama', '$username', '$password');");
                          
                          if($simpan){
                            //header("Location: ".$_SERVER['PHP_SELF']);
                            echo "<meta http-equiv='refresh' content='0'>";
                          }else{
                            echo "<div class='alert alert-warning  show alert-dismissible mt-2'>
                                  Gagal menambahkan, mungkin username sudah digunakan !
                              </div>";	
                          }
                        }
                      }
                  }
        
                ?>
                <div class="card">
                  <div class="card-header">
                    <h6 class="text-uppercase mb-0">Data User Admin</h6><br>
                    <a class='btn btn-success btn-sm' href='#modalTambah' data-toggle='modal'>
                    <i class='fas fa-plus'></i> Tambah</a>
                  </div>
                  <div class="card-body">                           
                    <table class="table table-striped table-hover card-text">
                      <thead>
                        <tr>
                          <th>NO</th>
                          <th>Nama</th>
                          <th>Username</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        $sql=mysqli_query($koneksi, "SELECT * FROM user");
                        $no = 1;
                        while($d=mysqli_fetch_array($sql)){
                          echo "<tr id='search'>
                                  <td>".$no++."</td>
                                  <td>$d[nama]</td>
                                  <td>$d[username]</td>
                                  <td>
                                  <a class='btn btn-success btn-sm' href='#modalEdit$d[id_user]' data-toggle='modal'>
                                  <i class='fas fa-edit'></i> Edit</a>
                                  <div class='modal small fade' id='modalEdit$d[id_user]' tabindex='-1' role='dialog' aria-labelledby='modalEditLabel' aria-hidden='true'>
                                      <div class='modal-dialog'>
                                          <div class='modal-content'>
                                              <div class='modal-header'>
                                                  <h5 id='modalEditLabel'>Edit User</h5>
                                              </div>
                                              <div class='row modal-body p-3'>
                                                <form class='col-md-12' method='post' action=''>
                                                  <div class='form-group'>
                                                    <label class='form-control-label text-uppercase'>Nama</label>
                                                    <input type='hidden' class='form-control' name='iduser' required value='$d[id_user]'>
                                                    <input type='text' placeholder='nama' class='form-control' name='nama' required value='$d[nama]'>
                                                  </div>
                                                  <div class='form-group'>
                                                    <label class='form-control-label text-uppercase'>Username</label>
                                                    <input type='text' placeholder='username' class='form-control' name='username' required value='$d[username]'>
                                                  </div>
                                                  <div class='form-group text-right'> 
                                                    <a href='' class='btn btn-secondary' data-dismiss='modal' aria-hidden='true'>Batal</a>       
                                                    <button type='submit' class='btn btn-primary'>Simpan</button>
                                                  </div>
                                                </form>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  </td>
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
                      <h5 id='modalTambahLabel'>Tambah User</h5>
                  </div>
                  <div class='row modal-body p-3'>
                    <form class='col-md-12' method="post" action="">
                      <div class="form-group">
                        <label class="form-control-label text-uppercase">Nama</label>
                        <input type="text" placeholder="nama" class="form-control" name='nama' required>
                      </div>
                      <div class="form-group">
                        <label class="form-control-label text-uppercase">Username</label>
                        <input type="text" placeholder="username" class="form-control" name='username' required>
                      </div>
                      <div class="form-group">
                        <label class="form-control-label text-uppercase">Password</label>
                        <input type="password" placeholder="password" class="form-control" name='password' required>
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
    <?php include "script-footer.php" ?>
  </body>
</html>