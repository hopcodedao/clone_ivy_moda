<?php 
if(isset($_GET['ma_don_hang'])) {
    HuyDon($conn,$_GET['ma_don_hang']);
    if (isset($_SERVER['HTTP_REFERER'])) {
        $previousPage = $_SERVER['HTTP_REFERER'];
        header('Location: ' . $previousPage);
        exit;
    }
}
?>