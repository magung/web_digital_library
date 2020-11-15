<?php 
  include "header.php"; 
  include "functions.php";
?>
<style>
div.polaroid {
  width: 250px;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  text-align: center;
  margin: 5px;
  padding: 5px;
}
</style>
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
            <li class="sidebar-list-item"><a href="#" data-toggle="collapse" data-target="#peminjaman" aria-expanded="true" aria-controls="peminjaman" class="sidebar-link text-muted active"><i class="o-table-content-1 mr-3 text-gray"></i><span>Peminjaman</span></a>
                <div id="peminjaman" class="collapse">
                <ul class="sidebar-menu list-unstyled border-left border-primary border-thick">
                    <li class="sidebar-list-item"><a href="peminjaman-menunggu-konfirmasi.php" class="sidebar-link text-muted pl-lg-5">Menunggu Konfirmasi</a></li>
                    <li class="sidebar-list-item"><a href="peminjaman-dikirim.php" class="sidebar-link text-muted pl-lg-5">Dikirim</a></li>
                    <li class="sidebar-list-item"><a href="peminjaman-dipinjam.php" class="sidebar-link text-muted pl-lg-5 active">Dipinjam</a></li>
                    <li class="sidebar-list-item"><a href="peminjaman-selesai.php" class="sidebar-link text-muted pl-lg-5">Selesai</a></li>
                    <li class="sidebar-list-item"><a href="peminjaman-batal.php" class="sidebar-link text-muted pl-lg-5">Batal</a></li>
                </ul>
                </div>
            </li>
            <li class="sidebar-list-item"><a href="#" data-toggle="collapse" data-target="#master-data" aria-expanded="false" aria-controls="master-data" class="sidebar-link text-muted"><i class="o-database-1 mr-3 text-gray"></i><span>Master Data</span></a>
                <div id="master-data" class="collapse">
                <ul class="sidebar-menu list-unstyled border-left border-primary border-thick">
                    <li class="sidebar-list-item"><a href="buku.php" class="sidebar-link text-muted pl-lg-5">Buku</a></li>
                    <li class="sidebar-list-item"><a href="kategori.php" class="sidebar-link text-muted pl-lg-5">Category</a></li>
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
                      $member  = $_POST['member'];
                      $buku    = $_POST['buku'];
                      $tanggal = $_POST['tanggal'];
                      $total   = "";
                      if($member=='' || $buku=='' ){
                          echo "<div class='alert alert-warning  show alert-dismissible mt-2'>
                                  Data Belum lengkap harus di selesaikan !
                              </div>";	
                      }else{
                              
                          $idtotalbuku = explode(",", $buku);
                          for($i=0;$i< count($idtotalbuku);$i++){
                            if($i==0){
                              $total.=$_POST['qty'.$idtotalbuku[$i]];
                            }else{
                              $total.=','.$_POST['qty'.$idtotalbuku[$i]];
                            }
                            $qty = intval($_POST["qty".$idtotalbuku[$i]]);
                            $kurangbuku = mysqli_query($koneksi, "UPDATE `buku` SET `stok` = (buku.stok - $qty) WHERE `buku`.`id_buku` = $idtotalbuku[$i]");
                          }
                          $today = date("Y-m-d");
                          $simpan = mysqli_query($koneksi,
                            "INSERT INTO `peminjaman` (`id_peminjaman`, `id_buku`, `id_member`, `id_kurir`, `kirim`, `total_buku`, `status`, `gambar_bukti`, `tanggal_pinjam`, `tanggal_harus_kembali`, `tanggal_kembali`, `tanggal_update`, `update_by`) VALUES (NULL, '$buku', '$member', NULL, '0', '$total', 'DIPINJAM', NULL, '$today', '$tanggal', NULL, NULL, '$id_user');");
                          $delete = mysqli_query($koneksi, "DELETE FROM `cart` WHERE `cart`.`update_by` = $id_user");

                          if($simpan){
                            echo "<div class='alert alert-success  show alert-dismissible mt-2'>
                              Data Berhasil disimpan
                          </div>";
                            //header("Location: ".$_SERVER['PHP_SELF']);
                            // echo "<meta http-equiv='refresh' content='0'>";
                            echo '<script> window.location.replace("peminjaman-dipinjam.php");</script>';
                          }
                        
                      }
                  }
        
                ?>
                <div class="card">
                  <div class="card-header">
                    <h6 class="text-uppercase mb-0">TAMBAH PEMINJAMAN</h6>
                  </div>
                  <div class="card-body">  
                    <form action="" method="post">
                      
                      <h6 class="text-uppercase mb-0">BUKU</h6>
                      <br>
                      <a class='btn btn-success btn-sm' href='#modalTambah' data-toggle='modal'>
                      <i class='fas fa-plus'></i> Tambah</a>
                      <br>
                      <br>
                      <div class="row">
                          <?php 
                            $sqlcart=mysqli_query($koneksi, 'SELECT * FROM cart WHERE update_by='.$id_user);  
                            // var_dump($datacart=mysqli_fetch_array($sqlcart));
                            $ada="";
                            $id="";
                            $idbukucart = "";
                            while($datacart=mysqli_fetch_array($sqlcart)) {
                              $ada="ada";
                              // var_dump(explode(",", $datacart["buku"]));
                              echo "<input type='hidden' name='buku' value='$datacart[buku]'>";
                              if($datacart["buku"] != ""){
                                $idbuku = explode(",", $datacart["buku"]);
                                $id=",".$datacart["buku"];
                                for($i=0;$i< count($idbuku);$i++){
                                  $getBuku=mysqli_query($koneksi, "SELECT * FROM buku WHERE id_buku =".$idbuku[$i]);
                                  $idbukucart .= " AND id_buku!=".$idbuku[$i];
                                  $dataBuku=mysqli_fetch_array($getBuku);
                                  $idhapus="";
                                  for($j=0;$j<count($idbuku);$j++){
                                    if($j!=$i){
                                      if($idhapus==""){
                                        $idhapus.=$idbuku[$j];
                                      }else{
                                        $idhapus.=",".$idbuku[$j];
                                      }
                                    }
                                  }
                                  echo "<div class='polaroid' style='padding: 5px'>
                                          <div><img src='img/$dataBuku[image]' width='100'/></div>
                                          <div>$dataBuku[judul]</div><br>
                                          <div>Stok : $dataBuku[stok]</div><br>
                                          
                                          <div><input type='number' name='qty".$idbuku[$i]."' value='1'><br><br>
                                          <a href='tambah_cart.php?ada=$ada&id=$idhapus' class='hapus-data btn btn-danger btn-sm'
                                          role='button'>
                                          <i class='fas fa-times'></i> Hapus</a>
                                          </div>
                                        </div>";
                                }
                                
                              }
                            }
                          ?>
                      </div>
                          <br>
                        <div class='form-group col-md-4'>
                        <h6 class="text-uppercase mb-0">MEMBER</h6><br>
                          <select name='member' class='form-control' required>
                            <option value=''>-- pilih member --</option>
                            <?php 
                              $sqlmem=mysqli_query($koneksi, 'SELECT * FROM members');  
                              while($datamem=mysqli_fetch_array($sqlmem)){
                                echo "<option value='$datamem[id_member]'>$datamem[nama]</option>";
                              }
                            ?>
                          </select>
                        </div><br>
                        <div class='form-group col-md-4'>
                        <h6 class="text-uppercase mb-0">Tanggal Harus Dikembalikan</h6><br>
                          <input type="text"  name="tanggal"  class="form-control datepicker"  required/>
                        </div>
                      
                      <button type="submit" class='btn btn-primary'>SIMPAN</button>
                    </form>                         
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
                  <div class='col-md-12 modal-body'>
                  <table id='dataTables-search' class="table table-striped table-hover card-text">
                      <thead>
                        <tr>
                          <th>Image</th>
                          <th>Judul</th>
                          <th>Stok</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        $sql=mysqli_query($koneksi, "SELECT * FROM buku WHERE 1=1".$idbukucart);
                        while($d=mysqli_fetch_array($sql)){
                          echo "<tr id='search'>
                                  <td><img src='img/$d[image]' width='100'/></td>
                                  <td>$d[judul]</td>
                                  <td>$d[stok]</td>
                                  <td>
                                  <a class='btn btn-success btn-sm' href='tambah_cart.php?ada=$ada&id=$d[id_buku]$id'>
                                  <i class='fas fa-plus'></i> Tambah</a>
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
        <?php include "footer.php" ?>
      </div>
    </div>
    <?php include "script-footer.php" ?>
  </body>
</html>
<script type="text/javascript">
        $(function(){
            $(".datepicker").datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
            });
        });
    </script>