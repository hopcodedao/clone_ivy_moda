

<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start(); 
 }
 if (isset($_GET['Remove_id']) && isset($_GET['Remove_size'])) {
    foreach ($_SESSION['cart'] as $index => $product) {
       if ($product[0] == $_GET['Remove_id'] && $product[5]==$_GET['Remove_size']) {
        $_SESSION['soluongsanpham'] -= $product[4];
          unset($_SESSION['cart'][$index]);
       }
    }
if (count($_SESSION['cart']) > 0) {
       header('Location:index.php?url=giohang');
       
    } else {
       header('location:index.php?url=giohang');
       
    }
 }

 ?>

