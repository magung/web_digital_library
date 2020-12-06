<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, DELETE, PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include "database.php";
$db = new Database();
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $db->open();
        $id = '';
        if(isset($_REQUEST['id'])){
            $id = $_REQUEST['id'];
        }
        $sql = 'SELECT * FROM `cart` WHERE member="'.$id.'"';
        $res = $db->get($sql);
        $result = [];
        if($res) {
            $buku = [];
            if($res[0]["buku"] !== ''){
                $idbuku = explode(",", $res[0]["buku"]);
                $id=",".$res[0]["buku"];
                for($i=0;$i< count($idbuku);$i++){
                    $getBuku=$db->get("SELECT * FROM buku WHERE id_buku =".$idbuku[$i]);
                    array_push($buku, $getBuku[0]);
                }
            }
            
            $result = [
                'err_code'      => '00',
                'error'         => false,
                'msg'           => 'success',
                'result'        => $buku,
                'total_data'    => $db->mysqli->affected_rows
            ];

        } else {
            $result['err_code'] = '01';
            $result['error']    = true;
            $result['msg']      = 'failed get data';
            $result['result']        = $res;
            $result['total_data']    = $db->mysqli->affected_rows;
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