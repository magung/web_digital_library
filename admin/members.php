<?php include "header.php";include "functions.php"; ?>
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
            <li class="sidebar-list-item"><a href="members.php" class="sidebar-link text-muted active"><i class="fas fa-user-friends mr-3 text-gray"></i><span>Anggota</span></a></li>
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
                <?php 
                  //untuk memproses form 
                  if($_SERVER['REQUEST_METHOD']=='POST'){
                      // var_dump($_FILES['gambar']);die();
                      $nama         = $_POST['nama'];
                      $email        = $_POST['email'];
                      $nowa         = $_POST['nowa'];
                      $alamat       = $_POST['alamat'];
                      $status       = $_POST['status'];
                      $jeniskelamin = $_POST['jeniskelamin'];
                      $password     = $_POST['password'];
                      
                      if($nama=='' || $email=='' || $alamat == '' || $nowa == '' || $status == '' || $jeniskelamin == '' || $password == ''){
                          echo "<div class='alert alert-warning  show alert-dismissible mt-2'>
                                  Data Belum lengkap harus di selesaikan !
                              </div>";	
                      }else{
                        $password = md5($password);
                        if (isset($_POST['idmember'])){
                          //simpan data
                          $id = $_POST['idmember'];
                          if($_FILES['gambar']['error'] === 4){
                            $gambar = $_POST['gambarlama'];
                          }else {
                            $gambar = upload();
                            hapus_gambar($_POST['gambarlama']);
                          }

                          $simpan = mysqli_query($koneksi,
                          "UPDATE `buku` SET `judul` = '$judul', `penulis` = '$penulis', `penerbit` = '$penerbit', `isbn` = '$isbn', `eisbn` = '$eisbn', `tahun_terbit` = '$tahun', `stok` = '$stok', `deskripsi` = '$deskripsi', `image` = '$gambar', `update_by` = '$id_user', `id_kategori` = '$kategori' WHERE `buku`.`id_buku` = $id;");
                          
                          if($simpan){
                            //header("Location: ".$_SERVER['PHP_SELF']);
                            echo "<div class='alert alert-success  show alert-dismissible mt-2'>
                              Data Berhasil diedit
                          </div>";
                            echo "<meta http-equiv='refresh' content='0'>";
                          }
                        }else{
                          //simpan data
                          $gambar = upload();
                          $simpan = false;
                          if($gambar !== false){
                            $simpan = mysqli_query($koneksi,
                            "INSERT INTO `members` (`id_member`, `nama`, `email`, `no_wa`, `image`, `alamat`, `password`, `status_pekerjaan`, `jenis_kelamin`, `token`) VALUES (NULL, '$nama', '$email', '$nowa', '$gambar', '$alamat', '$password', '$status', '$jeniskelamin', NULL);");
                          }
                          // var_dump($gambar);
                          // var_dump($simpan);die();
                          if($simpan){
                            echo "<div class='alert alert-success  show alert-dismissible mt-2'>
                              Data Berhasil disimpan
                          </div>";
                            //header("Location: ".$_SERVER['PHP_SELF']);
                            echo "<meta http-equiv='refresh' content='0'>";
                          }
                        }
                        
                      }
                  }
        
                ?>
                <div class="card">
                  <div class="card-header">
                    <h6 class="text-uppercase mb-0">Anggota</h6><br>
                    <a class='btn btn-success btn-sm' href='#modalTambah' data-toggle='modal'>
                    <i class='fas fa-plus'></i> Tambah</a>
                  </div>
                  <div class="card-body table-responsive">                           
                    <table class="table table-striped table-hover card-text" id='dataTables-search'>
                      <thead>
                        <tr>
                          <th>NO</th>
                          <th>Nama</th>
                          <th>Email</th>
                          <th>No WA</th>
                          <th>Alamat</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        $sql=mysqli_query($koneksi, "SELECT * FROM members");
                        $no = 1;
                        while($d=mysqli_fetch_array($sql)){
                          echo "<tr id='search'>
                                  <td>".$no++."</td>
                                  <td>$d[nama]</td>
                                  <td>$d[email]</td>
                                  <td>$d[no_wa]</td>
                                  <td>$d[alamat]</td>
                                  <td>
                                  <a class='btn btn-success btn-sm' href='members_detail.php?id=$d[id_member]'>
                                  <i class='fas fa-eye'></i> View</a>
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
        <div class='modal modal-xl fade' id='modalTambah' role='dialog' aria-labelledby='modalTambahLabel' aria-hidden='true'>
          <div class='modal-dialog modal-xl' role="document">
              <div class='modal-content'>
                  <div class='modal-header'>
                      <h5 id='modalTambahLabel'>Tambah Anggota Baru</h5>
                  </div>
                  <div class='row modal-body '>
                    <form class='col-md-12' method='post' action='' enctype='multipart/form-data'>
                      <div class='row'>
                        <div class='col-md-12'>
                          <div class='form-group'>
                            <label class='form-control-label text-uppercase'>Nama</label>
                            <input type='text' placeholder='nama' class='form-control' name='nama' required>
                          </div>
                          <div class='form-group'>
                            <label class='form-control-label text-uppercase'>Email</label>
                            <input type='email' placeholder='email' class='form-control' name='email' required>
                          </div>
                        </div>
                        <div class='col-md-12'>
                          <div class='form-group'>
                            <label class='form-control-label text-uppercase'>No WA</label>
                            <input type='text' placeholder='No WA' class='form-control' name='nowa' required>
                          </div>
                          <div class='form-group'>
                            <label class='form-control-label text-uppercase'>Alamat</label>
                            <input type='text' placeholder='alamat' class='form-control' name='alamat' required>
                          </div>
                          <div class='form-group'>
                            <label class='form-control-label text-uppercase'>Status Pekerjaan</label>
                            <input type='text' placeholder='status pekerjaan' class='form-control' name='status' required>
                          </div>
                          <div class='form-group'>
                            <label class='form-control-label text-uppercase'>Jenis Kelamin</label>
                            <select name='jeniskelamin' class='form-control' required>
                              <option value=''>-- pilih --</option>
                              <option value='Laki-Laki'>Laki - Laki</option>
                              <option value='Perempuan'>Perempuan</option>
                            </select>
                          </div>
                          <div class='form-group'>
                            <label class='form-control-label text-uppercase'>Password</label>
                            <input type='text' placeholder='password' class='form-control' name='password' required>
                          </div>
                          <div class='form-group'>
                            <label class='form-control-label text-uppercase'>gambar</label>
                            <div class='custom-file'>
                              <input type='file' class='custom-file-input' id='gambar' name='gambar'>
                              <label class='custom-file-label' for='gambar' aria-describedby='inputGroupFileAddon02' >Pilih gambar</label>
                            </div>
                            <br><br><img id='gambarbuku' src='https://www.tibs.org.tw/images/default.jpg' class='img-thumbnail' width='100' height='100'>
                          </div>
                        </div>
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
        <?php include "footer.php" ?>
      </div>
    </div>
    <!-- JavaScript files-->
    <?php include "script-footer.php" ?>
  </body>
</html>
<script>
$(document).ready(function() {
  // Peringatan hapus dat
  

  function bacaGambar(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('#gambarbuku').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#gambar").change(function() {
    bacaGambar(this);
  });

  function bacaGambar1(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('.gambarbukuedit').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  $(".gambaredit").change(function() {
    bacaGambar1(this);
  });
})
</script>