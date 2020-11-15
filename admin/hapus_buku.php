<?php
    include "koneksi.php";
    include "functions.php";
    $hapus = mysqli_query($koneksi, "DELETE FROM buku WHERE id_buku='$_GET[id]'");
	
	if($hapus){
        hapus_gambar($_GET['gambar']);
		header('location:buku.php');
	}
?>