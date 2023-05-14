<?php 
    require 'func.php'; // connect  
    require '../../conn.php';//func
    if(session_status() == PHP_SESSION_NONE) {
       session_start(); 
    }

    
?>
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
                    echo "<script>alert('Email, mật khẩu bạn không được để trống!')</script>";
                }else {
                    $result =  logIn($conn,$username,$pass);
                    if(mysqli_num_rows($result) > 0) {
                        $r = mysqli_fetch_array($result);
                        $_SESSION['user_admin'] = $r['email'];
                        $_SESSION['ho_admin'] = $r['ho'];
                        $_SESSION['ten_admin'] = $r['ten'];
                        $_SESSION['quyen_admin'] = $r['quyen'];
                        $_SESSION['pass_admin']  =$r['pass'];
                        header('location:../index.php');
                    }else {
                        echo "<script>alert('Đăng nhập không thành công')</script>";
                    }
                }
                
            }

           
        ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login_Admin</title>
</head>
<style>
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-size: 16px;

    }
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-image: linear-gradient(-45deg,#7d53b5,#4489d3);
    }
    .admin_login {
        width: 350px;
        background-color: #fff;
        min-height: 400px;
        padding: 30px;
        border-radius: 2px;
    }
    .admin_login p {
        font-size: 30px;
        font-weight: bold;
        text-align: center;
        padding: 40px 0;
    }
    .admin_login input {
        display: block;
        height: 40px;
        padding-left: 6px;
        width: 100%;
        margin-bottom: 20px;
        border: none;
        border-bottom: 2px solid #ccc;
        outline: none;
        line-height: 40px;
    }
    .admin_login div button {
        width: 100%;
        padding: 10px 0;
        outline: none;
        border: none;
        cursor: pointer;
        background-image: linear-gradient(
            to right,
            #7d53b5 0%,
            #4489d3 51%,
            #7d53b5 100%);
        background-size: 200%;
        transition: all 0.3s;
        color: #fff;
        text-transform: uppercase;
        font-weight: bold;
        border-radius: 4px;
        box-shadow: rgba(0, 0, 0, 0.3) 4px 19px 38px;
    }
    .admin_login div button:hover {
        background-position: right center;
    }
    .test {
  background-color: #c3e6cb;
  border-color: #b1dfbb;
  color: #155724;
  padding: 0.75rem 1.25rem;
  margin-bottom: 1rem;
}

    
</style>
<body>
    <form method="POST" class="admin_login">
        <p>Login</p>
        <input name="email" type="email" placeholder="Email...">
        <input name="password" type="password" placeholder="Mật khẩu....">
        <div>
            <button name="dangnhap" type="submit">Đăng nhập</button>
        </div>
    </form>
</body>
</html>