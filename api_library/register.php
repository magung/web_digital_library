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
        $nama   = $_POST['nama'];
        $email  = $_POST['email'];
        $wa     = $_POST['wa'];
        $alamat = $_POST['alamat'];
        $status = $_POST['status'];
        $jenis_kelamin  = $_POST['jenis_kelamin'];
        $password       = md5($_POST['password']);
        $sql = "INSERT INTO `members` 
                (`id_member`, `nama`, `email`, `no_wa`, `image`, `alamat`, `password`, `status_pekerjaan`, `jenis_kelamin`, `token`) 
                VALUES 
                (NULL, '$nama', '$email', '$wa', NULL, '$alamat', '$password', '$status', '$jenis_kelamin', NULL);";

        if($res = $db->execute($sql)){
            $result = [
                'err_code'  => '00',
                'error'     => false,
                'msg'       => 'success register',
                'result'    => $res
            ];
        }

        if($db->mysqli->affected_rows !== 1) {
            $result['err_code'] = '01';
            $result['error']    = true;
            $result['msg']      = 'failed register';
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