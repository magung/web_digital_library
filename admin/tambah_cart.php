<?php
    include "header.php";
    $ada_cart=$_GET['ada'];
    // var_dump($ada_cart);die();
    if($ada_cart === '' ) {
        $simpan = mysqli_query($koneksi, "INSERT INTO `cart` (`id_cart`, `buku`, `member`, `update_by`) VALUES (NULL, '$_GET[id]', NULL, '$id_user');");
    } else {
        $simpan = mysqli_query($koneksi, "UPDATE `cart` SET `buku` = '$_GET[id]' WHERE `cart`.`update_by` = $id_user;");
    }
	
	if($simpan){
        // header('location:peminjaman-tambah.php');
        echo '<script> window.location.replace("peminjaman-tambah.php");</script>';
	}
?>