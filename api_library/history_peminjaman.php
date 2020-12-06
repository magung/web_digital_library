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
        $search = '';
        if(isset($_REQUEST['search'])){
            $search = $_REQUEST['search'];
        }
        $sql = "SELECT * FROM `peminjaman` WHERE id_member='$id' ORDER BY `peminjaman`.`id_peminjaman` DESC";
        
        $res = $db->get($sql);
        $result = [];
        if($res) {
            for ($i = 0; $i < count($res); $i++) {
                $buku = [];
                if($res[$i]["id_buku"] !== ''){
                    $idbuku = explode(",", $res[$i]["id_buku"]);
                    $totalbuku = explode(",", $res[$i]["total_buku"]);
                    $id=",".$res[$i]["id_buku"];
                    for($key=0;$key< count($idbuku);$key++){
                        $getBuku=$db->get("SELECT * FROM buku WHERE id_buku =".$idbuku[$key]);
                        $getBuku[0]['qty'] = $totalbuku[$key];
                        array_push($buku, $getBuku[0]);
                    }
                }
                // var_dump($buku);
                $res[$i]['buku'] = $buku;
            }


            $result = [
                'err_code'      => '00',
                'error'         => false,
                'msg'           => 'success',
                'result'        => $res,
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