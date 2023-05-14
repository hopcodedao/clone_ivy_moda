<?php
ob_start();
require "conn.php";
require "user/func.php";
require "Session.php"
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css">
    <link rel="stylesheet" href="themify-icons/themify-icons.css">
    <link rel="stylesheet" href="./css/style.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- owlcarousel -->
    <link rel="stylesheet" href="./OwlCarousel2-2.3.4/dist/assets/owl.carousel.css">
    <title>Trang chủ</title>
    <script src="js/thongbao.js"></script>
</head>

<body>
    <div id="toast"></div>
    <div class="app">
        <div class="header">
            <div class="header-container">
                <ul class="header-header_list">
                    <?php
                    require "user/menu.php";
                    ?>

                </ul>
            </div>

        </div>
        <div class="container">
                <?php
                if(isset($_GET['url'])){
                    require 'user/'.$_GET['url'].'.php';
                }else{
                    require "user/slide_index.php";
                }
                    
                ?>
        </div>
        <div class="footer">
            <?php
          require "user/footer.php";
          
          ?>
          <?php ob_end_flush(); ?>
        </div>
    </div>
    <script src="js/main.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"
        integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    <script src="./OwlCarousel2-2.3.4/dist/owl.carousel.min.js"></script>
    <script>
    $(document).ready(function() {
        $(".owl-carousel").owlCarousel({
            loop: true,
            autoplay: true,
            autoplayTimeout: 5000,
            items: 1,
            nav: true,
            dots: true,
            navText: ["<i class='las la-arrow-left'></i>", "<i class='las la-arrow-right'></i>"],
        });
    });
    </script>
    
</body>

</html>