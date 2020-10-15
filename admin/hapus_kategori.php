<?php
	include "koneksi.php";
	$hapus = mysqli_query($koneksi, "DELETE FROM kategori WHERE id_kategori='$_GET[id]'");
	
	if($hapus){
		header('location:kategori.php');
	}
?>