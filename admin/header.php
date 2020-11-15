<?php include "koneksi.php";  
session_start();
  if(!isset($_SESSION['username']) && !isset($_SESSION['id_user'])){
    // header('location:login.php');
    echo '<script> window.location.replace("login.php");</script>';
  }else{
    $username = $_SESSION['username'];
    $id_user = $_SESSION['id_user'];
  }
  
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Digital Library</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="../distribution/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- Google fonts - Popppins for copy-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,800">
    <!-- orion icons-->
    <link rel="stylesheet" href="../distribution/css/orionicons.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="../distribution/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="../distribution/css/custom.css">
    <link rel="stylesheet" href="../distribution/css/datepicker.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="./img/icon/knowledge.png">
    
    <link rel="stylesheet" type="text/css" href="../distribution/DataTables/datatables.min.css"/>
    
    

  </head>

