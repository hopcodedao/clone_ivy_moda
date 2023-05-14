<?php 
if(isset($_GET['id_sp'])) {
    xoaanhchitiet($conn,$_GET['id_sp']);
    xoasanpham($conn,$_GET['id_sp']);
    header('location:?url=danhsachsanpham');
}
?>