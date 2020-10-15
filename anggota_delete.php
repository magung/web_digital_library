<?php
	include "koneksi.php";
	$hapus = mysqli_query($koneksi, "DELETE FROM tb_anggota WHERE id_anggota='$_GET[id]'");
	
	if($hapus){
		header('location:anggota.php');
	}
?>