<?php 
    if(session_status() == PHP_SESSION_NONE) {
        session_start(); 
    }
    unset($_SESSION['user']);
    unset($_SESSION['ho']);
    unset($_SESSION['ten']);
    unset($_SESSION['id_nguoi_dung']);
    unset($_SESSION['quyen']);
    unset($_SESSION['pass'] );
    header('location:index.php');
?>