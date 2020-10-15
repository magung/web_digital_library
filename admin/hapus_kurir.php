<?php
	include "koneksi.php";
	$hapus = mysqli_query($koneksi, "DELETE FROM kurir WHERE id_kurir='$_GET[id]'");
	
	if($hapus){
		header('location:kurir.php');
	}
?>