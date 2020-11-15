<?php
session_start();
unset($_SESSION['username']);
unset($_SESSION['id_user']);
session_unset();
session_destroy();
header('location:login.php');
?>