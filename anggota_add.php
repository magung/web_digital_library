<?php
include "header.php";

?>

<body>
    <div class='container'>
        <h1 class='text-center'>Anggota Team 3</h1>
        <div class='dropdown'>
            <button class='btn btn-primary dropdown-toggle' type='button' data-toggle='dropdown'>
                Anggota
            </button>
            <ul class='dropdown-menu'>
                <li><a href='index.php'>Home</a></li>
                <li><a href="anggota.php">Anggota</a></li>
            </ul>
        </div>
        
        <form method="post" action="" class="ml-2 card p-5 mt-5">
            <h5 class="text-gray-900 mb-4">Tambah Data Anggota</h5>
            <?php 
            
                //untuk memproses form 
                if($_SERVER['REQUEST_METHOD']=='POST'){
                    $nama    = $_POST['nama'];
                    $kelas   = $_POST['kelas'];
                    $alamat  = $_POST['alamat'];
                                                    
                    if($nama=='' | $kelas=='' | $alamat==''){
                        echo "<div class='alert alert-warning  show alert-dismissible mt-2'>
                                Data Belum lengkap harus di selesaikan !
                            </div>";	
                    }else{
                        //simpan data
                        $simpan = mysqli_query($koneksi,
                        "INSERT INTO `tb_anggota` (`nama_anggota`, `alamat`, `kelas`) VALUES ('$nama', '$alamat', '$kelas');");
                        
                        if($simpan){
                            header('location:anggota.php');
                        }
                    }
                }
            
            ?>
            <div class="form-group row" >
                <label class="col-md-2 col-form-label">Nama</label>
                <div class="input-group col-md-6">
                    <input type="text"  class="form-control" name="nama" placeholder="Masukan">
                </div>
            </div>

            
            <div class="form-group row" >
                <label class="col-md-2 col-form-label">Kelas</label>
                <div class="input-group col-md-6">
                    <input type="text" class="form-control" name="kelas" placeholder="Masukan">
                </div>
            </div>

            
            <div class="form-group row" >
                <label class="col-md-2 col-form-label">Alamat</label>
                <div class="input-group col-md-6">
                    <textarea  class="form-control" name="alamat" placeholder="Masukan"></textarea>
                </div>
            </div>

            <div class="mb-2">
                <a href="anggota.php" class="btn btn-danger btn-sm">
                    Cancel
                </a>
                <input type="submit" class="btn btn-primary btn-sm" value="Save" />
                <a href='anggota_add.php'  class='btn btn-warning btn-sm'>Clear</a>
            </div>
        </form>
    </div>
</body>
</html>