<?php
include "header.php";
$sqlEdit=mysqli_query($koneksi, "SELECT * FROM tb_anggota WHERE id_anggota='$_GET[id]'");
$e=mysqli_fetch_array($sqlEdit);

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
            <h5 class="text-gray-900 mb-4">Edit Data Anggota</h5>
            <?php
            
                //untuk memproses form 
                if($_SERVER['REQUEST_METHOD']=='POST'){
                    $id      = $_POST['id'];
                    $nama    = $_POST['nama'];
                    $kelas   = $_POST['kelas'];
                    $alamat  = $_POST['alamat'];
                                                    
                    if($nama=='' | $kelas=='' | $alamat==''){
                        echo "<div class='alert alert-warning show alert-dismissible mt-2'>
                                Data Belum lengkap harus di selesaikan !
                            </div>";	
                    }else{
                        //simpan data
                        $update = mysqli_query($koneksi, "UPDATE tb_anggota SET
                                                            nama_anggota='$nama',
                                                            kelas='$kelas',
                                                            alamat='$alamat'
                                                            WHERE id_anggota='$id'");
                                                                    
                        if($update){
                            header('location:anggota.php');
                        }
                    }
                    

                }
            
            ?>
            <input type="hidden" class="form-control" name="id" value="<?= $e['id_anggota'] ?>">
            <div class="form-group row" >
                <label class="col-md-2 col-form-label">Nama</label>
                <div class="input-group col-md-6">
                    <input type="text"  class="form-control" name="nama" placeholder="Masukan" value="<?= $e['nama_anggota'] ?>">
                </div>
            </div>

            
            <div class="form-group row" >
                <label class="col-md-2 col-form-label">Kelas</label>
                <div class="input-group col-md-6">
                    <input type="text" class="form-control" name="kelas" placeholder="Masukan" value="<?= $e['kelas'] ?>">
                </div>
            </div>

            
            <div class="form-group row" >
                <label class="col-md-2 col-form-label">Alamat</label>
                <div class="input-group col-md-6">
                    <textarea  class="form-control" name="alamat" placeholder="Masukan" ><?= $e['alamat'] ?></textarea>
                </div>
            </div>

            <div class="mb-2">
                <a href="anggota.php" class="btn btn-danger btn-sm">
                    Cancel
                </a>
                <input type="submit" class="btn btn-primary btn-sm" value="Save" />
            </div>
        </form>
    </div>
</body>
</html>