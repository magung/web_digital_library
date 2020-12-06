<?php
    include "koneksi.php";
    include "functions.php";
    if(isset($_GET['action'])){
        if($_GET['action'] == 'approve') {
            $kembali = "";
            if($_GET['status'] === 'SELESAI') {
                $kembali = ", tanggal_kembali = NOW()";
            }
            if(isset($_GET['buku'])){
                $buku = $_GET['buku'];
                $total = $_GET['total'];
                $idtotalbuku = explode(",", $buku);
                $totalbuku = explode(",", $total);
                for($i=0;$i< count($idtotalbuku);$i++){
                    $qty = intval($totalbuku[$i]);
                    $tambahbuku = mysqli_query($koneksi, "UPDATE `buku` SET `stok` = (buku.stok + $qty) WHERE `buku`.`id_buku` = $idtotalbuku[$i]");
                }
            }
            $query = "UPDATE `peminjaman` SET `status` = '$_GET[status]'".$kembali;
            if(isset($_GET['tanggal'])){
                $query .= ", `tanggal_harus_kembali` = '$_GET[tanggal]'";
            }
            $query .= " WHERE `peminjaman`.`id_peminjaman`='$_GET[id]'";
            $approve = mysqli_query($koneksi, $query);
            if($approve) {
                // header('location:'.$_GET['redirect'].'.php');
                echo '<script> window.location.replace("'.$_GET['redirect'].'.php");</script>';
            }
        }
    }
?>