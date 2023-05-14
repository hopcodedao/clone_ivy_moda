<?php 
    include '../conn.php';
    include 'admin_pages/func.php';
?>
<?php 
    if(session_status() == PHP_SESSION_NONE) {
        session_start(); 
    }
    if(!isset($_SESSION['quyen_admin'])) {
        header('location:admin_pages/ad_login.php');
    }else if($_SESSION['quyen_admin'] != 0) {
        header('location:../index.php'); 
    }
    ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin_pages/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script> 
    <script src="../ckeditor5/ckeditor.js"></script>
    <title>Admin_Home</title>
</head>

<body>

    <section class="admin-header">
        <div class="admin-header-left">
            <a href="index.php" class="admin-header-left-logo">
                <img src="../img/logo (1).png" alt="">
            </a>
        </div>
        <div class="admin-header-right">
            <div>
                <a href="../index.php">Đi tới trang web</a>
            </div>
            <div>
                <div class="user_image">
                    <i class="fa-solid fa-user"></i>
                </div>
                <p class="hello"> 
                <?php echo 'Xin chào: '.$_SESSION['ho_admin'] ,' ', $_SESSION['ten_admin']?> 
                    <a style="color: red; text-decoration: underline;" href="admin_pages/exit.php">Thoát</a>
                </p>
            </div>
            
        </div>
    </section>
    <div class="notification">
       Thêm thành công 
    </div>
    <section class="admin-content">
        <div class="admin-content-left">
            <ul class="admin-content-left-list">
                <li>
                    <a href="#">Danh mục <i class="las la-angle-left"></i></i></a>
                    <ul class="sub_menu">
                        <li><a class="change-url" href="?url=themdanhmuc">Thêm danh mục</a></li>
                        <li><a class="change-url" href="?url=danhsachdanhmuc">Danh sách danh mục</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Loại sản phẩm <i class="las la-angle-left"></i></i></a>
                    <ul class="sub_menu">
                        <li><a class="change-url" href="?url=themloaisanpham">Thêm loại sản phẩm</a></li>
                        <li><a class="change-url" href="?url=dsloaisanpham">Danh sách loại sản phẩm</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Loại sản phẩm con <i class="las la-angle-left"></i></i></a>
                    <ul class="sub_menu">
                        <li><a class="change-url" href="?url=themloaisanphamcon">Thêm loại sản phẩm con</a></li>
                        <li><a class="change-url" href="?url=dsloaisanphamcon">Danh sách loại sản phẩm con</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Slide <i class="las la-angle-left"></i></i></a>
                    <ul class="sub_menu">
                        <li><a class="change-url" href="?url=themanhslide">Thêm ảnh slide</a></li>
                        <li><a class="change-url" href="?url=danhsachanhslide">Danh sách ảnh slide</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Sản phẩm <i class="las la-angle-left"></i></i></a>
                    <ul class="sub_menu">
                        <li><a class="change-url" href="?url=themsanpham">Thêm sản phẩm</a></li>
                        <li><a class="change-url" href="?url=danhsachsanpham">Danh sách sản phẩm</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Đơn hàng <i class="las la-angle-left"></i></i></a>
                    <ul class="sub_menu">
                        <li><a class="change-url" href="?url=danhsachdonhang">Danh sách đơn hàng</a></li>
                    </ul>
                </li>

            </ul>
        </div>
        <div class="admin-content-right">
        <script>
            const notification = document.querySelector('.notification');
            function showNotification(text, backgroundColor, borderLeftColor) {
                notification.textContent = text;
                notification.style.backgroundColor = backgroundColor;
                notification.style.borderLeft = `6px solid ${borderLeftColor}`;
                notification.classList.add('show');
                setTimeout(() => {
                    notification.classList.remove('show');
                }, 2000);
            }
        </script>
        <?php 
            if(isset($_GET['url']) && !empty($_GET['url'])) {
                require 'admin_pages/'.$_GET['url'].'.php';
            }else {
                    require 'admin_pages/intro.php';
            }
        ?>
        
        <script>
            const itemClicks = document.querySelectorAll('.admin-content-left-list>li>a');
            itemClicks.forEach(itemClick => {
                itemClick.addEventListener('click', function () {
                    const listSubmenu = this.nextElementSibling;
                    listSubmenu.classList.toggle('active_drop_down');

                });
            });
            
        </script>
        <?php ob_end_flush(); ?>
        <!-- counting up  -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.js" integrity="sha512-ZKNVEa7gi0Dz4Rq9jXcySgcPiK+5f01CqW+ZoKLLKr9VMXuCsw3RjWiv8ZpIOa0hxO79np7Ec8DDWALM0bDOaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="../Counting/jquery.countup.js"></script>
        <script>
            $('.counter').countUp({
                "time":1000,
                'delay':10 
            });
        </script>

        <!-- ckeditor  -->
<script>
    const editors = document.querySelectorAll('.editor');
    editors.forEach(editor => {
        ClassicEditor
            .create(editor)
            .catch(error => {
                console.error(error);
            });
    });
    console.log(editors)
</script>
</body>

</html>