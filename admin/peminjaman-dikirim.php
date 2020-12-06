<?php 
  include "header.php"; 
  include "functions.php";
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
            <li class="sidebar-list-item"><a href="pengunjung.php" class="sidebar-link text-muted"><i class="fas fa-user-friends mr-3 text-gray"></i><span>Pengunjung</span></a></li>
            <li class="sidebar-list-item"><a href="#" data-toggle="collapse" data-target="#peminjaman" aria-expanded="true" aria-controls="peminjaman" class="sidebar-link text-muted active"><i class="o-table-content-1 mr-3 text-gray"></i><span>Peminjaman</span></a>
                <div id="peminjaman" class="collapse">
                <ul class="sidebar-menu list-unstyled border-left border-primary border-thick">
                    <li class="sidebar-list-item"><a href="peminjaman-menunggu-konfirmasi.php" class="sidebar-link text-muted pl-lg-5">Menunggu Konfirmasi</a></li>
                    <li class="sidebar-list-item"><a href="peminjaman-dikirim.php" class="sidebar-link text-muted pl-lg-5 active">Dikirim</a></li>
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
                <div class="card">
                  <div class="card-header">
                    <h6 class="text-uppercase mb-0">pengiriman</h6>
                  </div>
                  <div class="card-body table-responsive">                           
                    <table id='dataTables-search' class="table table-striped table-hover card-text">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama Peminjam</th>
                          <th>Kontak</th>
                          <th>Buku</th>
                          <th>Total Buku</th>
                          <th>Alamat</th>
                          <th>Type</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        $sql=mysqli_query($koneksi, "SELECT * FROM `peminjaman` INNER JOIN members ON members.id_member = peminjaman.id_member WHERE status='DIKIRIM' OR status='TERKIRIM' AND kirim =1");
                        $no = 1;
                        while($d=mysqli_fetch_array($sql)){
                          echo "<tr id='search'>
                                  <td>".$no++."</td>
                                  <td><a href='members_detail.php?id=$d[id_member]'>$d[nama]</a></td>
                                  <td>Email : <a href='mailto:email@example.com'>$d[email]</a><br>WA : <a href='https://api.whatsapp.com/send?phone=$d[no_wa]' >$d[no_wa]</a></td>";
                          $idbuku = explode(",", $d["id_buku"]);
                          $qtyBuku = explode(",", $d["total_buku"]);
                          echo "<td>";
                          for($i=0;$i< count($idbuku);$i++){
                            $getBuku=mysqli_query($koneksi, "SELECT * FROM buku WHERE id_buku =".$idbuku[$i]);
                            $dataBuku=mysqli_fetch_array($getBuku);
                            echo "<a href='buku_detail.php?id=$dataBuku[id_buku]'>$dataBuku[judul] </a> - $qtyBuku[$i] buku<br>";
                          }
                          echo "</td>";
                          
                          echo "<td>";
                                  $total = 0;
                                  for($t=0;$t<count($qtyBuku);$t++){
                                    $total += intval($qtyBuku[$t]);
                                  }
                                  echo $total;
                          echo "</td>
                                <td>$d[alamat]</td>
                                <td>";
                          echo  $d['kirim'] == 0 ? 'LANGSUNG' : 'DELIVERY';
                           
                          if($d['status'] == 'DIKIRIM') {
                              echo"</td>
                                    <td>
                                      <a href='#modalApprove' class='approve-data btn btn-success btn-sm' data-id='$d[id_peminjaman]' 
                                      role='button' data-toggle='modal' >Kirim</a>";
                                echo  "<a href='#modalReject' class='reject-data btn btn-danger btn-sm' data-id='$d[id_peminjaman]' data-buku='$d[id_buku]' data-total='$d[total_buku]'
                                role='button' data-toggle='modal' >Batal</a>
                                </td>";
                          } else {
                              echo"</td>
                                    <td>
                                      <a href='#modalSampai' class='sampai-data btn btn-primary btn-sm' data-id='$d[id_peminjaman]' 
                                      role='button' data-toggle='modal' >Terkirim</a>";
                          }


                          echo "</tr>";
                          ?>
                          <div class='modal small fade' id='modalReject' tabindex='-1' role='dialog' aria-labelledby='modalRejectLabel' aria-hidden='true'>
                              <div class='modal-dialog'>
                                  <div class='modal-content'>
                                      <div class='modal-header'>
                                          <h5 id='modalRejectLabel'>Konfirmasi</h5>
                                      </div>
                                      <div class='row modal-body p-3'>
                                          <div class='col-md-12 mb-3'>
                                              <h5> Apakah Anda yakin ?</h5>
                                          </div>
                                          <div class='col-md-12 float-center text-center'>
                                              <a href='' class='btn btn-primary btn-sm' data-dismiss='modal' aria-hidden='true'>Tutup</a> 
                                              <a href='#' class='btn btn-danger btn-sm'  id='modalRejectbtn' >Batal</a>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class='modal small fade' id='modalApprove' tabindex='-1' role='dialog' aria-labelledby='modalApproveLabel' aria-hidden='true'>
                              <div class='modal-dialog'>
                                  <div class='modal-content'>
                                      <div class='modal-header'>
                                          <h5 id='modalApproveLabel'>Konfirmasi</h5>
                                      </div>
                                      <div class='row modal-body p-3'>
                                          <div class='col-md-12 mb-3'>
                                              <h5> Apakah Anda yakin ?</h5>
                                          </div>
                                          <div class='col-md-12 float-center text-center'>
                                              <a href='' class='btn btn-primary btn-sm' data-dismiss='modal' aria-hidden='true'>Tutup</a> 
                                              <a href='#' class='btn btn-success btn-sm'  id='modalApprovebtn' >Kirim</a>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class='modal small fade' id='modalSampai' tabindex='-1' role='dialog' aria-labelledby='modalSampaiLabel' aria-hidden='true'>
                              <div class='modal-dialog'>
                                  <div class='modal-content'>
                                      <div class='modal-header'>
                                          <h5 id='modalSampaiLabel'>Konfirmasi</h5>
                                      </div>
                                      <div class='row modal-body p-3'>
                                          <div class='col-md-12 mb-3'>
                                              <h5> Apakah Anda yakin buku telah sampai tujuan ?</h5>
                                          </div>
                                          <div class='col-md-12 float-center text-center'>
                                              <a href='' class='btn btn-primary btn-sm' data-dismiss='modal' aria-hidden='true'>Tutup</a> 
                                              <a href='#' class='btn btn-success btn-sm'  id='modalSampaibtn' >Sampai</a>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                        <?php
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
        <?php include "footer.php" ?>
      </div>
    </div>
    <?php include "script-footer.php" ?>
  </body>
</html>
<script>
$('.approve-data').click(function(){
    var id=$(this).data('id');
    var status = 'TERKIRIM'
    $('#modalApprovebtn').attr('href','peminjaman_action.php?action=approve&id='+id+'&status='+status+'&redirect=peminjaman-dikirim');
});
$('.sampai-data').click(function(){
    var id=$(this).data('id');
    var status = 'DIPINJAM'
    $('#modalSampaibtn').attr('href','peminjaman_action.php?action=approve&id='+id+'&status='+status+'&redirect=peminjaman-dikirim');
});
$('.reject-data').click(function(){
    var id=$(this).data('id');
    var buku=$(this).data('buku');
    var total=$(this).data('total');
    $('#modalRejectbtn').attr('href','peminjaman_action.php?action=approve&id='+id+'&status=BATAL&redirect=peminjaman-dikirim&buku='+buku+'&total='+total);
});
</script>