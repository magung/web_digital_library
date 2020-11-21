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
        $search = '';
        if(isset($_REQUEST['search'])){
            $search = $_REQUEST['search'];
        }
        $sql = 'SELECT * FROM `buku` WHERE (judul LIKE "%'.$search.'%" OR penulis like "%'.$search.'%" OR isbn like "%'.$search.'%" OR tahun_terbit like "%'.$search.'%")';
        if(isset($_REQUEST['kategori'])){
            $sql .= ' AND id_kategori = ' . $_REQUEST['kategori']; 
        }
        $res = $db->get($sql);
        $result = [];
        if($res) {
            $result = [
                'err_code'      => '00',
                'error'         => false,
                'msg'           => $db->mysqli->affected_rows == 0 ? 'data empty' : 'success',
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