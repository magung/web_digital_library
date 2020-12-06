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

        $action = '';
        if(isset($_POST['action'])) {
            $action=$_POST['action'];
        }
        $result = [];
        if($action == 'ADD') {
            if(isset($_POST['id'])){
                $id = $_POST['id'];
            }
            $buku='';
            if(isset($_POST['buku'])){
                $buku = $_POST['buku'];
            }
            $sql = 'SELECT * FROM `cart` WHERE member="'.$id.'"';
            $res = $db->get($sql);
            if(count($res) !== 0) {
                $idbuku = explode(",", $res[0]["buku"]);
                $newid='';
                $isnew = true;
                for($i=0;$i< count($idbuku);$i++){
                    if($idbuku[$i] == $buku){
                        $isnew = false;
                    }
                    if($newid == ''){
                        $newid .= $idbuku[$i];
                    }else{
                        $newid .= ',' . $idbuku[$i];
                    }
                }
                if($isnew) {
                    if($newid == ''){
                        $newid .= $buku;
                    }else{
                        $newid .= ',' . $buku;
                    }
                }
                $queryadd = "UPDATE `cart` SET `buku` = '$newid' WHERE `cart`.`member` = $id;";
    
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
    
            } else {
                $queryadd = "INSERT INTO `cart` (`id_cart`, `buku`, `member`, `update_by`) VALUES (NULL, '$buku', '$id', 'M$id');";
    
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
            }
    
            $db->close();
            print json_encode($result);

        } elseif ($action == "HAPUS") {
            if(isset($_POST['id'])){
                $id = $_POST['id'];
            }
            $buku='';
            if(isset($_POST['buku'])){
                $buku = $_POST['buku'];
            }
            $sql = 'SELECT * FROM `cart` WHERE member="'.$id.'"';
            $res = $db->get($sql);
            if(count($res) !== 0) { 
                $idbuku = explode(",", $res[0]["buku"]);
                $newid='';
                for($i=0;$i< count($idbuku);$i++){
                    if($idbuku[$i] !== $buku){
                        if($newid == ''){
                            $newid .= $idbuku[$i];
                        }else{
                            $newid .= ',' . $idbuku[$i];
                        }
                    }
                }
                $queryadd = "UPDATE `cart` SET `buku` = '$newid' WHERE `cart`.`member` = $id;";
    
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
    
            } else {
                $result['err_code'] = '01';
                $result['error']    = true;
                $result['msg']      = 'failed';
                $result['result']   = $add;
            }
    
            $db->close();
            print json_encode($result);
        } else {
            $result = [
                'err_code'  => '400',
                'error'     => false,
                'msg'       => 'Bad Request',
                'result'    => null
            ];
    
            print json_encode($result);
        }


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