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
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $sql = "SELECT * FROM `members` WHERE email='$email' AND password='$password'";

        if($res = $db->get($sql)){
            $newtoken = md5(date("Y-m-d H:i:s")) . md5($password) . md5($email);
            $updatetoken = "UPDATE `members` SET `token` = '$newtoken' WHERE `members`.`id_member` = ".$res[0]['id_member'].";";
            if($db->execute($updatetoken)) {
                $result = [
                    'err_code'  => '00',
                    'error'     => false,
                    'msg'       => 'success login',
                    'result'    => [
                        'id_member' => $res[0]['id_member'],
                        'email'     => $res[0]['email'],
                        'nama'      => $res[0]['nama'],
                        'alamat'    => $res[0]['alamat'],
                        'status_pekerjaan'   => $res[0]['status_pekerjaan'],
                        'jenis_kelamin'      => $res[0]['jenis_kelamin'],
                    ],
                    'token'     => $newtoken,
                ];
            } else {
                $result['err_code'] = '01';
                $result['error']    = true;
                $result['msg']      = 'failed';
            }

        }else{
            $result['err_code'] = '01';
            $result['error']    = true;
            $result['msg']      = 'failed';
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