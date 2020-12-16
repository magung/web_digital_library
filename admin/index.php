<?php include "header.php"; 

$buku=mysqli_query($koneksi, "SELECT COUNT(id_buku) AS total FROM `buku`");
$buku=mysqli_fetch_array($buku);
$buku=$buku['total'];

$dipinjam=mysqli_query($koneksi, "SELECT COUNT(id_peminjaman) AS total FROM `peminjaman` WHERE status='DIPINJAM'");
$dipinjam=mysqli_fetch_array($dipinjam);
$dipinjam=$dipinjam['total'];

$dikirim=mysqli_query($koneksi, "SELECT COUNT(id_peminjaman) AS total FROM `peminjaman` WHERE status='DIKIRIM'");
$dikirim=mysqli_fetch_array($dikirim);
$dikirim=$dikirim['total'];

$terkirim=mysqli_query($koneksi, "SELECT COUNT(id_peminjaman) AS total FROM `peminjaman` WHERE status='TERKIRIM'");
$terkirim=mysqli_fetch_array($terkirim);
$terkirim=$terkirim['total'];

$batal=mysqli_query($koneksi, "SELECT COUNT(id_peminjaman) AS total FROM `peminjaman` WHERE status='BATAL'");
$batal=mysqli_fetch_array($batal);
$batal=$batal['total'];

$konfirmasi=mysqli_query($koneksi, "SELECT COUNT(id_peminjaman) AS total FROM `peminjaman` WHERE status='KONFIRMASI'");
$konfirmasi=mysqli_fetch_array($konfirmasi);
$konfirmasi=$konfirmasi['total'];

$selesai=mysqli_query($koneksi, "SELECT COUNT(id_peminjaman) AS total FROM `peminjaman` WHERE status='SELESAI'");
$selesai=mysqli_fetch_array($selesai);
$selesai=$selesai['total'];

$tahun='2020';
function getDataPerbulan($bulan, $tahun) {
  $queryData="SELECT COUNT(id_peminjaman) as data FROM peminjaman WHERE month(tanggal_pinjam)='$bulan' AND year(tanggal_pinjam)='$tahun' GROUP BY month(tanggal_pinjam)";
  $getData=mysqli_query($GLOBALS['koneksi'], $queryData);
  $data=mysqli_fetch_array($getData);
  return $data['data'];
}

$datapeminjam1=getDataPerbulan(1, $tahun);
$datapeminjam2=getDataPerbulan(2, $tahun);
$datapeminjam3=getDataPerbulan(3, $tahun);
$datapeminjam4=getDataPerbulan(4, $tahun);
$datapeminjam5=getDataPerbulan(5, $tahun);
$datapeminjam6=getDataPerbulan(6, $tahun);
$datapeminjam7=getDataPerbulan(7, $tahun);
$datapeminjam8=getDataPerbulan(8, $tahun);
$datapeminjam9=getDataPerbulan(9, $tahun);
$datapeminjam10=getDataPerbulan(10, $tahun);
$datapeminjam11=getDataPerbulan(11, $tahun);
$datapeminjam12=getDataPerbulan(12, $tahun);

// var_dump($datapeminjam11);

// $qdatapeminjam = "SELECT MONTH(tanggal_pinjam) AS bulan, COUNT(*) AS jumlah_bulanan
// FROM peminjaman GROUP BY MONTH(tanggal_pinjam)";
// $datapeminjam=mysqli_query($koneksi, $qdatapeminjam);

// // var_dump($datapeminjam);
// $bulan = [];
// $data = [];
// while($d=mysqli_fetch_array($datapeminjam)){
//   // array_push($d['bulan'], $bulan);
//   // array_push($data, $d['jumlah_bulanan']);
//   // $bulan=$datapeminjam['bulan'];
//   // $data=$datapeminjam['jumlah_bulanan'];
// }
// var_dump($bulan)

?>
<script>
  var konfirmasi = "<?php echo $konfirmasi; ?>";
  var dipinjam = "<?php echo $dipinjam; ?>";
  var terkirim = "<?php echo $terkirim; ?>";
  var dikirim = "<?php echo $dikirim; ?>";
  var batal = "<?php echo $batal; ?>";
  var selesai = "<?php echo $selesai; ?>";

  var bulan1 = $datapeminjam1;
  var bulan2 = $datapeminjam2;
  var bulan3 = $datapeminjam3;
  var bulan4 = $datapeminjam4;
  var bulan5 = $datapeminjam5;
  var bulan6 = $datapeminjam6;
  var bulan7 = $datapeminjam7;
  var bulan8 = $datapeminjam8;
  var bulan9 = $datapeminjam9;
  var bulan10 = $datapeminjam10;
  var bulan11 = $datapeminjam11;
  var bulan12 = $datapeminjam12;

</script>
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
            <li class="sidebar-list-item"><a href="index.php" class="sidebar-link text-muted active"><i class="o-home-1 mr-3 text-gray"></i><span>Home</span></a></li>
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
              <a href="buku.php" class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
                <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
                  <div class="flex-grow-1 d-flex align-items-center">
                    <div class="dot mr-3 bg-violet"></div>
                    <div class="text">
                      <h6 class="mb-0">Total Buku</h6><span class="text-gray"><?php echo $buku; ?> buku</span>
                    </div>
                  </div>
                  <div class="icon text-white bg-violet"><i class="fas fa-server"></i></div>
                </div>
              </a>
              <a href="peminjaman-dipinjam.php" class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
                <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
                  
                  <div class="flex-grow-1 d-flex align-items-center">
                    <div class="dot mr-3 bg-green"></div>
                    <div class="text">
                      <h6 class="mb-0">Buku Dipinjam</h6><span class="text-gray"><?php echo $dipinjam; ?> buku</span>
                    </div>
                  </div>
                  
                  <div class="icon text-white bg-green"><i class="far fa-clipboard"></i></div>
                </div>
              </a>
              <a href="peminjaman-dikirim.php" class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
                <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
                  <div class="flex-grow-1 d-flex align-items-center">
                    <div class="dot mr-3 bg-blue"></div>
                    <div class="text">
                      <h6 class="mb-0">Buku Dalam Pengiriman</h6><span class="text-gray"><?php echo $terkirim; ?> buku</span>
                    </div>
                  </div>
                  <div class="icon text-white bg-blue"><i class="fa fa-dolly-flatbed"></i></div>
                </div>
              </a>
              <a href="peminjaman-menunggu-konfirmasi.php" class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
                <div class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
                  <div class="flex-grow-1 d-flex align-items-center">
                    <div class="dot mr-3 bg-red"></div>
                    <div class="text">
                      <h6 class="mb-0">Peminjaman Belum Dikonfirmasi</h6><span class="text-gray"><?php echo $konfirmasi; ?></span>
                    </div>
                  </div>
                  <div class="icon text-white bg-red"><i class="fas fa-receipt"></i></div>
                </div>
              </a>
            </div>
          </section>
          <section >
            <div class="row">
              <div class="col-lg-12">
                <div class="card mb-4">
                  <div class="card-header">
                    <h2 class="h6 text-uppercase mb-0">Peminjaman</h2>
                  </div>
                  <div class="card-body">
                    <div class="chart-holder">
                      <canvas id="pieChartPeminjaman"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mb-4">
              <div class="col-lg-12 mb-4 mb-lg-0">
                <div class="card">
                  <div class="card-header">
                    <h2 class="h6 text-uppercase mb-0">PEMINJAM PERBULANNYA</h2>
                  </div>
                  <div class="card-body">
                    <div class="chart-holder mt-5 mb-5">
                      <canvas id="lineChartExample"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- <div class="row mb-4">
              <div class="col-lg-8 mb-4 mb-lg-0">
                <div class="card">
                  <div class="card-header">
                    <h2 class="h6 text-uppercase mb-0">Line chart Example</h2>
                  </div>
                  <div class="card-body">
                    <p class="mb-5 text-gray">Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                    <div class="chart-holder mt-5 mb-5">
                      <canvas id="lineChartExample"></canvas>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="card mb-4">
                  <div class="card-header">
                    <h2 class="h6 text-uppercase mb-0">Line chart Example</h2>
                  </div>
                  <div class="card-body">
                    <div class="chart-holder">
                      <canvas id="lineCahrtsm1"></canvas>
                    </div>
                  </div>
                </div>
                <div class="card mb-3">
                  <div class="card-header">
                    <h2 class="h6 text-uppercase mb-0">Bar chart Example</h2>
                  </div>
                  <div class="card-body">
                    <div class="chart-holder">
                      <canvas id="barChartExample"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mb-4">
              <div class="col-lg-4">
                <div class="card mb-4">
                  <div class="card-header">
                    <h2 class="h6 text-uppercase mb-0">Pie chart Example</h2>
                  </div>
                  <div class="card-body">
                    <div class="chart-holder">
                      <canvas id="pieChart1"></canvas>
                    </div>
                  </div>
                </div>
                <div class="card mb-4">
                  <div class="card-header">
                    <h2 class="h6 text-uppercase mb-0">Pie chart Example</h2>
                  </div>
                  <div class="card-body">
                    <div class="chart-holder">
                      <canvas id="pieChart2"></canvas>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-8">
                <div class="card">
                  <div class="card-header">
                    <h2 class="h6 mb-0 text-uppercase">Bar chart Example</h2>
                  </div>
                  <div class="card-body">
                    <p class="mb-5 text-gray">Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                    <div class="chart-holder mt-5 mb-5">
                      <canvas id="barChartExample1"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="card mb-4">
                  <div class="card-header">
                    <h2 class="h6 text-uppercase mb-0">Doughnut chart Example</h2>
                  </div>
                  <div class="card-body">
                    <p class="mb-3 text-gray">Lorem ipsum dolor sit amet.</p>
                    <div class="chart-holder">
                      <canvas id="doughnutChartExample"></canvas>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="card mb-4">
                  <div class="card-header">
                    <h2 class="h6 text-uppercase mb-0">Pie chart Example</h2>
                  </div>
                  <div class="card-body">
                    <p class="mb-3 text-gray">Lorem ipsum dolor sit amet.</p>
                    <div class="chart-holder">
                      <canvas id="pieChartExample"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="card mb-4">
                  <div class="card-header">
                    <h2 class="h6 text-uppercase mb-0">Polar chart Example</h2>
                  </div>
                  <div class="card-body">
                    <p class="mb-3 text-gray">Lorem ipsum dolor sit amet.</p>
                    <div class="chart-holder">
                      <canvas id="polarChartExample"></canvas>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="card mb-4">
                  <div class="card-header">
                    <h2 class="h6 text-uppercase mb-0">Radar chart Example</h2>
                  </div>
                  <div class="card-body">
                    <p class="mb-3 text-gray">Lorem ipsum dolor sit amet.</p>
                    <div class="chart-holder">
                      <canvas id="radarChartExample"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->
          </section>
        </div>
        <?php include "footer.php" ?>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="../distribution/vendor/jquery/jquery.min.js"></script>
    <script src="../distribution/vendor/popper.js/umd/popper.min.js"> </script>
    <script src="../distribution/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../distribution/vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="../distribution/vendor/chart.js/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
    <script src="charts-custom.js"></script>
    <script src="../distribution/js/front.js"></script>
  </body>
</html>

