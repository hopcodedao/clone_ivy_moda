<?php 
    if(isset($_POST["dangnhap"])) {
        $username = $_POST['email'];
        $password = $_POST['password'];

        $username = strip_tags($username);
        $username = addslashes($username);
        $password = strip_tags($password);
        $password = addslashes($password);
        $pass = md5($password);
        if($username =='' || $password =='') {
            echo "<script>ShowErrorToast_empty_email()</script>";
        }else {
            $result =  logIn($conn,$username,$pass);
            if(mysqli_num_rows($result) > 0) {
                $r = mysqli_fetch_array($result);
                $_SESSION['user'] = $r['email'];
                $_SESSION['ho'] = $r['ho'];
                $_SESSION['ten'] = $r['ten'];
                $_SESSION['id_nguoi_dung'] = $r['id_nguoi_dung'];
                $_SESSION['quyen'] = $r['quyen'];
                $_SESSION['pass']  =$r['mat_khau'];
                header('location:?url=thongtintaikhoan');
                
            }else {
                echo "<script>Login_failed()</script>";
            }
        }
        
    }

?>

        <div class="login-content">
            <form action="" method="POST" class="login-content-login">
                <h3 class="login-title">Bạn đã có tài khoản IVY</h3>
                <p class="login-desc">Nếu bạn đã có tài khoản, hãy đăng nhập để tích lũy điểm thành viên và nhận được những ưu đãi tốt hơn!</p>
                <div class="login-container">
                    <div class="login-input">
                        <input name="email" type="text" placeholder="Email">
                        <input name="password" type="password" placeholder="Mật khẩu">
                    </div>
                    <div class="login-button">
                        <button name="dangnhap" class="btn" type="submit">ĐĂNG NHẬP</button>
                    </div>
                </div>
                
            </form>
            <div class="login-content-register">
                <h3 class="login-title">Khách hàng mới của IVY moda</h3>
                <div class="register-content">
                    <p class="register-desc">
                        Nếu bạn chưa có tài khoản trên ivymoda.com, hãy sử dụng tùy chọn này để truy cập biểu mẫu đăng ký.
                    </p>
                    <p class="register-desc">
                        Bằng cách cung cấp cho IVY moda thông tin chi tiết của bạn, quá trình mua hàng trên ivymoda.com sẽ là một trải nghiệm thú vị và nhanh chóng hơn!
                    </p>
                    
                </div>
                <div class="register-buttons">
                    <a href="?url=dangki"><button class="btn">Đăng ký</button></a>
                </div>
            </div>
        </div>
        