<?php include "header.php"; ?>
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
                    <li class="sidebar-list-item"><a href="buku.php" class="sidebar-link text-muted pl-lg-5">Buku</a></li>
                    <li class="sidebar-list-item"><a href="kategori.php" class="sidebar-link text-muted pl-lg-5">Kategori</a></li>
                    <li class="sidebar-list-item"><a href="kurir.php" class="sidebar-link text-muted pl-lg-5 active">Kurir</a></li>
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
                      $kurir    = $_POST['kurir'];
                      $biaya    = $_POST['biaya'];
                      
                      if($kurir=='' || $biaya==''){
                          echo "<div class='alert alert-warning  show alert-dismissible mt-2'>
                                  Data Belum lengkap harus di selesaikan !
                              </div>";	
                      }else{
                        if (isset($_POST['idkurir'])){
                          //simpan data
                          $id = $_POST['idkurir'];
                          $simpan = mysqli_query($koneksi,
                          "UPDATE `kurir` SET `kurir` = '$kurir', `biaya` = '$biaya' WHERE `kurir`.`id_kurir` = $id;");
                          
                          if($simpan){
                            //header("Location: ".$_SERVER['PHP_SELF']);
                            echo "<meta http-equiv='refresh' content='0'>";
                          }
                        }else{
                          //simpan data
                          $simpan = mysqli_query($koneksi,
                          "INSERT INTO `kurir` (`id_kurir`, `kurir`, `biaya`) VALUES (NULL, '$kurir', '$biaya');");
                          
                          if($simpan){
                            //header("Location: ".$_SERVER['PHP_SELF']);
                            echo "<meta http-equiv='refresh' content='0'>";
                          }
                        }
                      }
                  }
        
                ?>
                <div class="card">
                  <div class="card-header">
                    <h6 class="text-uppercase mb-0">Data Kurir</h6><br>
                    <a class='btn btn-success btn-sm' href='#modalTambah' data-toggle='modal'>
                    <i class='fas fa-plus'></i> Tambah</a>
                  </div>
                  <div class="card-body table-responsive">                           
                    <table class="table table-striped table-hover card-text" id='dataTables-search'>
                      <thead>
                        <tr>
                          <th>NO</th>
                          <th>Kurir</th>
                          <th>Biaya</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        $sql=mysqli_query($koneksi, "SELECT * FROM kurir");
                        $no = 1;
                        while($d=mysqli_fetch_array($sql)){
                          echo "<tr id='search'>
                                  <td>".$no++."</td>
                                  <td>$d[kurir]</td>
                                  <td>$d[biaya]</td>
                                  <td>
                                  <a class='btn btn-success btn-sm' href='#modalEdit$d[id_kurir]' data-toggle='modal'>
                                  <i class='fas fa-edit'></i> Edit</a>
                                  <div class='modal small fade' id='modalEdit$d[id_kurir]' tabindex='-1' role='dialog' aria-labelledby='modalEditLabel' aria-hidden='true'>
                                      <div class='modal-dialog'>
                                          <div class='modal-content'>
                                              <div class='modal-header'>
                                                  <h5 id='modalEditLabel'>Edit Kurir</h5>
                                              </div>
                                              <div class='row modal-body p-3'>
                                                <form class='col-md-12' method='post' action=''>
                                                  <div class='form-group'>
                                                    <label class='form-control-label text-uppercase'>Kurir</label>
                                                    <input type='hidden' placeholder='kurir' class='form-control' name='idkurir' required value='$d[id_kurir]'>
                                                    <input type='text' placeholder='kurir' class='form-control' name='kurir' required value='$d[kurir]'>
                                                  </div>
                                                  <div class='form-group'>
                                                    <label class='form-control-label text-uppercase'>Biaya</label>
                                                    <input type='number' placeholder='biaya' class='form-control' name='biaya' required value='$d[biaya]'>
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
                                  <a href='#modalHapus' class='hapus-data btn btn-danger btn-sm' data-id='$d[id_kurir]' 
                                  role='button' data-toggle='modal' data-nama='$d[kurir]'>
                                  <i class='fas fa-times'></i> Hapus</a>
                                  <div class='modal small fade' id='modalHapus' tabindex='-1' role='dialog' aria-labelledby='modalHapusLabel' aria-hidden='true'>
                                      <div class='modal-dialog'>
                                          <div class='modal-content'>
                                              <div class='modal-header'>
                                                  <h5 id='modalHapusLabel'>Informasi penghapusan</h5>
                                              </div>
                                              <div class='row modal-body p-3'>
                                                  <div class='col-md-12 text-center'>
                                                      <span class='h6'>Kurir</span>
                                                      <p id='nama_kurir' class='h5 text-info mb-3'></p>
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
                      <h5 id='modalTambahLabel'>Tambah Kurir</h5>
                  </div>
                  <div class='row modal-body p-3'>
                    <form class='col-md-12' method="post" action="">
                      <div class="form-group">
                        <label class="form-control-label text-uppercase">Kurir</label>
                        <input type="text" placeholder="kurir" class="form-control" name='kurir' required>
                      </div>
                      <div class="form-group">
                        <label class="form-control-label text-uppercase">Biaya</label>
                        <input type="number" placeholder="biaya" class="form-control" name='biaya' required>
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
<script>
// Peringatan hapus dat
$('.hapus-data').click(function(){

    var nama = $(this).attr('data-nama');
    $('#nama_kurir').text(nama);

    var id=$(this).data('id');
    $('#modalDelete').attr('href','hapus_kurir.php?id='+id);
});
</script>