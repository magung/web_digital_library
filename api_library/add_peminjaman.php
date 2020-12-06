<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, DELETE, PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include "database.php";
$db = new Database();
switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $db->open();
        $id = '';

        $result = [];
        if(isset($_POST['id'])){
            $id = $_POST['id'];
        }
        $buku='';
        if(isset($_POST['buku'])){
            $buku = $_POST['buku'];
        }
        $total='';
        if(isset($_POST['total'])){
            $total = $_POST['total'];
        }
        $kirim=0;
        if(isset($_POST['type'])){
            $type = $_POST['type'];
            if($type == 'langsung') {
                $kirim = 0;
            }else{
                $kirim = 1;
            }
        }
        $kurir=0;
        if(isset($_POST['kurir'])){
            $kurir = $_POST['kurir'];
        }
            
        $idbuku = explode(",", $buku);
        $totalbuku = explode(",", $total);
        for($i=0;$i< count($idbuku);$i++){
            $qty = intval($totalbuku[$i]);
            $querykurangbuku = "UPDATE `buku` SET `stok` = (buku.stok - $qty) WHERE `buku`.`id_buku` = $idbuku[$i]";
            $kurangbuku = $db->execute($querykurangbuku);
        }
        
        $today = date("Y-m-d");
        $querydelete = "DELETE FROM `cart` WHERE `cart`.`update_by` = 'M$id'";
        $delete = $db->execute($querydelete);

        $queryadd = "INSERT INTO `peminjaman` 
                    (`id_peminjaman`, `id_buku`, `id_member`, `id_kurir`, `kirim`, `total_buku`, `status`, `gambar_bukti`, `tanggal_pinjam`, `tanggal_harus_kembali`, `tanggal_kembali`, `tanggal_update`, `update_by`) 
                    VALUES 
                    (NULL, '$buku', '$id', '$kurir', '$kirim', '$total', 'KONFIRMASI', NULL, '$today', NULL, NULL, NULL, 'M$id');";
        $add = $db->execute($queryadd);
        if($add){
            $result = [
                'err_code'      => '00',
                'error'         => false,
                'msg'           => 'success',
                'result'        => $add,
            ];
        }else{
            $result['err_code'] = '01';
            $result['error']    = true;
            $result['msg']      = 'failed';
            $result['result']   = $add;
        }

        

        $db->close();
        print json_encode($result);


        break;
    default:
        http_response_code(400); // kode bad request
        
        $result = [
            'err_code'  => '400',
            'error'     => false,
            'msg'       => 'Bad Request',
            'result'    => null
        ];

        print json_encode($result);

        break; 
}

?>