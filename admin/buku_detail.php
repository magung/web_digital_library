<?php 
  include "header.php"; 
  include "functions.php";
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
                    <li class="sidebar-list-item"><a href="buku.php" class="sidebar-link text-muted pl-lg-5 active">Buku</a></li>
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
                      $judul        = $_POST['judul'];
                      $deskripsi    = $_POST['deskripsi'];
                      $penulis      = $_POST['penulis'];
                      $penerbit     = $_POST['penerbit'];
                      $isbn         = $_POST['isbn'];
                      $eisbn        = $_POST['eisbn'];
                      $tahun        = $_POST['tahun'];
                      $stok         = $_POST['stok'];
                      $kategori     = $_POST['kategori'];
                      
                      if($judul=='' || $deskripsi=='' || $penerbit == '' || $penulis == '' || $isbn == '' || $eisbn == '' || $tahun == '' || $stok == '' || $kategori == ''){
                          echo "<div class='alert alert-warning  show alert-dismissible mt-2'>
                                  Data Belum lengkap harus di selesaikan !
                              </div>";	
                      }else{
                        
                        if (isset($_POST['idbuku'])){
                          //simpan data
                          $id = $_POST['idbuku'];
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
                            "INSERT INTO `buku` (`id_buku`, `judul`, `penulis`, `penerbit`, `isbn`, `eisbn`, `tahun_terbit`, `stok`, `deskripsi`, `image`, `id_kategori`, `update_by`) VALUES (NULL, '$judul', '$penulis', '$penerbit', '$isbn', '$eisbn', '$tahun', '$stok', '$deskripsi', '$gambar', '$kategori', '$id_user');");
                          }

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
                  $sql=mysqli_query($koneksi, "SELECT * FROM buku WHERE id_buku =$_GET[id]");
                  while($d=mysqli_fetch_array($sql)){
                ?>
                
                <div class="card">
                  <div class="card-header">
                    <h6 class="text-uppercase mb-0"><?php echo "$d[judul]"; ?></h6><br>
                  </div>
                  <div class="card-body">                
                      <?php
                          echo "
                            <div class='row'>
                                <div class='col-md-4'>
                                    <img src='img/$d[image]' width='100%'>
                                </div>
                                <div class='col-md-8'>
                                <h5>Judul Buku</h5>
                                <p>$d[judul]</p>
                                <h5>Penulis</h5>
                                <p>$d[penulis]</p>
                                <h5>Penerbit</h5>
                                <p>$d[penerbit]</p>
                                <h5>Tahun Terbit</h5>
                                <p>$d[tahun_terbit]</p>
                                <h5>ISBN</h5>
                                <p>$d[isbn]</p>
                                <h5>EISBN</h5>
                                <p>$d[eisbn]</p>
                                <h5>Stok</h5>
                                <p>$d[stok]</p>
                                <h5>Deskripsi</h5>
                                <p>$d[deskripsi]</p>
                                <td>
                                  <a class='btn btn-success btn-sm' href='#modalEdit$d[id_buku]' data-toggle='modal'>
                                  <i class='fas fa-edit'></i> Edit</a>
                                  <div class='modal small fade' id='modalEdit$d[id_buku]' tabindex='-1' role='dialog' aria-labelledby='modalEditLabel' aria-hidden='true'>
                                      <div class='modal-dialog'>
                                          <div class='modal-content'>
                                              <div class='modal-header'>
                                                  <h5 id='modalEditLabel'>Edit buku</h5>
                                              </div>
                                              <div class='row modal-body p-3'>
                                                <form class='col-md-12' method='post' action='' enctype='multipart/form-data'>
                                                  <div class='row'>
                                                    <div class='col-md-12'>
                                                      <div class='form-group'>
                                                        <label class='form-control-label text-uppercase'>Judul</label>
                                                        <input type='hidden' class='form-control' name='idbuku' required value='$d[id_buku]'>
                                                        <input type='hidden' class='form-control' name='gambarlama' required value='$d[image]'>
                                                        <input type='text' placeholder='judul buku' class='form-control' name='judul' value='$d[judul]' required>
                                                      </div>
                                                      <div class='form-group'>
                                                        <label class='form-control-label text-uppercase'>deskripsi</label>
                                                        <input type='textarea' placeholder='deskripsi buku' class='form-control' value='$d[deskripsi]' name='deskripsi' required>
                                                      </div>
                                                    </div>
                                                    <div class='col-md-6'>
                                                      <div class='form-group'>
                                                        <label class='form-control-label text-uppercase'>penulis</label>
                                                        <input type='text' placeholder='penulis buku' class='form-control' value='$d[penulis]' name='penulis' required>
                                                      </div>
                                                      <div class='form-group'>
                                                        <label class='form-control-label text-uppercase'>penerbit</label>
                                                        <input type='text' placeholder='penerbit buku' class='form-control' value='$d[penerbit]' name='penerbit' required>
                                                      </div>
                                                      <div class='form-group'>
                                                        <label class='form-control-label text-uppercase'>isbn</label>
                                                        <input type='text' placeholder='isbn' class='form-control' name='isbn' value='$d[isbn]' >
                                                      </div>
                                                      <div class='form-group'>
                                                        <label class='form-control-label text-uppercase'>eisbn</label>
                                                        <input type='text' placeholder='eisbn' class='form-control' name='eisbn' value='$d[eisbn]' >
                                                      </div>
                                                    </div>
                                                    <div class='col-md-6'>
                                                      <div class='form-group'>
                                                        <label class='form-control-label text-uppercase'>tahun</label>
                                                        <input type='text' placeholder='tahun terbit' class='form-control' name='tahun' value='$d[tahun_terbit]' required>
                                                      </div>
                                                      <div class='form-group'>
                                                        <label class='form-control-label text-uppercase'>stok</label>
                                                        <input type='number' placeholder='stok buku' class='form-control' name='stok' value='$d[stok]' required>
                                                      </div>
                                                      <div class='form-group'>
                                                        <label class='form-control-label text-uppercase'>kategori</label>
                                                        <!-- <input type='text' placeholder='kategori buku' class='form-control' name='kategori' required> -->
                                                        <select name='kategori' class='form-control' required>
                                                          <option value=''>-- pilih kategori --</option>";
                                                            $sqlkategori=mysqli_query($koneksi, 'SELECT * FROM kategori'); 
                                                            while($datakategori=mysqli_fetch_array($sqlkategori)){
                                                              echo "<option value='$datakategori[id_kategori]' ". ($d['id_kategori'] == $datakategori['id_kategori'] ? 'selected' : '') ." >$datakategori[kategori]</option>";
                                                            }
                                                          
                                                        echo "</select>
                                                      </div>
                                                      <div class='form-group'>
                                                        <label class='form-control-label text-uppercase'>gambar</label>
                                                        <div class='custom-file'>
                                                          <input type='file' class='custom-file-input gambaredit' id='gambaredit' name='gambar'>
                                                          <label class='custom-file-label' for='gambaredit' aria-describedby='inputGroupFileAddon02' >Pilih gambar</label>
                                                        </div>
                                                        <br><br><img id='gambarbukuedit' src='img/$d[image]' class='img-thumbnail gambarbukuedit' width='100' height='100'>
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
                                  <a href='#modalHapus' class='hapus-data btn btn-danger btn-sm' data-id='$d[id_buku]' data-gambar='$d[image]' 
                                  role='button' data-toggle='modal' data-nama='$d[judul]'>
                                  <i class='fas fa-times'></i> Hapus</a>
                                  <div class='modal small fade' id='modalHapus' tabindex='-1' role='dialog' aria-labelledby='modalHapusLabel' aria-hidden='true'>
                                      <div class='modal-dialog'>
                                          <div class='modal-content'>
                                              <div class='modal-header'>
                                                  <h5 id='modalHapusLabel'>Informasi penghapusan</h5>
                                              </div>
                                              <div class='row modal-body p-3'>
                                                  <div class='col-md-12 text-center'>
                                                      <span class='h6'>buku</span>
                                                      <p id='nama_buku' class='h5 text-info mb-3'></p>
                                                  </div>
                                                  <div class='col-md-12 mb-3'>
                                                      <h5> Apakah Anda yakin ingin menghapus data ini ?</h5>
                                                  </div>
                                                  <div class='col-md-12 float-center text-center'>
                                                      <a href='' class='btn btn-primary btn-sm' data-dismiss='modal' aria-hidden='true'>Batal</a> 
                                                      <a href='#' class='btn btn-danger btn-sm'  id='modalDelete' >Hapus</a>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  </td>
                                  </div>
                            </div>
                              ";
                        }
                        ?>
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
                      <h5 id='modalTambahLabel'>Tambah Buku</h5>
                  </div>
                  <div class='row modal-body '>
                    <form class='col-md-12' method='post' action='' enctype='multipart/form-data'>
                      <div class='row'>
                        <div class='col-md-12'>
                          <div class='form-group'>
                            <label class='form-control-label text-uppercase'>Judul</label>
                            <input type='text' placeholder='judul buku' class='form-control' name='judul' required>
                          </div>
                          <div class='form-group'>
                            <label class='form-control-label text-uppercase'>deskripsi</label>
                            <input type='textarea' placeholder='deskripsi buku' class='form-control' name='deskripsi' required>
                          </div>
                        </div>
                        <div class='col-md-6'>
                          <div class='form-group'>
                            <label class='form-control-label text-uppercase'>penulis</label>
                            <input type='text' placeholder='penulis buku' class='form-control' name='penulis' required>
                          </div>
                          <div class='form-group'>
                            <label class='form-control-label text-uppercase'>penerbit</label>
                            <input type='text' placeholder='penerbit buku' class='form-control' name='penerbit' required>
                          </div>
                          <div class='form-group'>
                            <label class='form-control-label text-uppercase'>isbn</label>
                            <input type='text' placeholder='isbn' class='form-control' name='isbn' >
                          </div>
                          <div class='form-group'>
                            <label class='form-control-label text-uppercase'>eisbn</label>
                            <input type='text' placeholder='eisbn' class='form-control' name='eisbn' >
                          </div>
                        </div>
                        <div class='col-md-6'>
                          <div class='form-group'>
                            <label class='form-control-label text-uppercase'>tahun</label>
                            <input type='text' placeholder='tahun terbit' class='form-control' name='tahun' required>
                          </div>
                          <div class='form-group'>
                            <label class='form-control-label text-uppercase'>stok</label>
                            <input type='number' placeholder='stok buku' class='form-control' name='stok' required>
                          </div>
                          <div class='form-group'>
                            <label class='form-control-label text-uppercase'>kategori</label>
                            <!-- <input type='text' placeholder='kategori buku' class='form-control' name='kategori' required> -->
                            <select name='kategori' class='form-control' required>
                              <option value=''>-- pilih kategori --</option>
                              <?php 
                                $sqlkategori=mysqli_query($koneksi, 'SELECT * FROM kategori');  
                                while($datakat=mysqli_fetch_array($sqlkategori)){
                                  echo "<option value='$datakat[id_kategori]'>$datakat[kategori]</option>";
                                }
                              ?>
                            </select>
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
  $('.hapus-data').click(function(){
  
      var nama = $(this).attr('data-nama');
      $('#nama_buku').text(nama);
  
      var id=$(this).data('id');
      var gambar=$(this).data('gambar');
      $('#modalDelete').attr('href','hapus_buku.php?id='+id+'&gambar='+gambar);
  });

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