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
        
        <div class="table-responsive p-5">
            
            <table id='dataTables-example' class="text-gray-900 table">
                <thead>
                <tr> 
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Alamat</th>
                    <th>
                        <a href="anggota_add.php" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i>
                        </a>
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php
                $sql=mysqli_query($koneksi, "SELECT * FROM tb_anggota");
                $no = 1;
                while($d=mysqli_fetch_array($sql)){
                    echo "<tr id='search'>
                            <td>".$no++."</td>
                            <td>$d[nama_anggota]</td>
                            <td>$d[kelas]</td>
                            <td>$d[alamat]</td>
                            <td>
                            <a class='btn btn-success btn-sm' href='anggota_edit.php?id=$d[id_anggota]'>
                            <i class='fas fa-edit'></i></a>
                            <a href='#myModal' class='hapus-pejabat btn btn-danger btn-sm' data-id='$d[id_anggota]' 
                            role='button' data-toggle='modal' data-nama='$d[nama_anggota]'>
                            <i class='fas fa-times'></i></a>
                            <div class='modal small fade' id='myModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                                <div class='modal-dialog'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h5 id='myModalLabel'>Informasi penghapusan</h5>
                                        </div>
                                        <div class='row modal-body p-3'>
                                            <div class='col-md-12'>
                                                <span class='h6'>Nama Anggota</span>
                                                <p id='nama_pejabat' class='h5 text-info mb-3'></p>
                                            </div>
                                            <div class='col-md-12 mb-3'>
                                                <h5> Apakah Anda yakin ingin menghapus data ini ?</h5>
                                            </div>
                                            <div class='col-md-12 float-center'>
                                                <a href='' class='btn btn-primary btn-sm' data-dismiss='modal' aria-hidden='true'>Cancel</a> 
                                                <a href='#' class='btn btn-danger btn-sm'  id='modalDelete' >Delete</a>
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
</body>
<script>
// Peringatan hapus buku
$('.hapus-pejabat').click(function(){

    var nama = $(this).attr('data-nama');
    $('#nama_pejabat').text(nama);

    var id=$(this).data('id');
    $('#modalDelete').attr('href','anggota_delete.php?id='+id);
});
</script>
</html>