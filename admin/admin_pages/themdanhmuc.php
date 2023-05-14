<?php 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST['themdanhmuc'])) {
          $result = themdanhmuc($conn,$_POST['ten_danhmuc'],$_POST['thutu']);
          if(mysqli_affected_rows($conn)>0) {
            echo "<script>showNotification('Thêm thành công', '#A8F1C6', '#188344');</script>";
          }
        }
     }
?>

<div class="admin-content-right">
            <div class="admin-content-right-cartegory_add">
                <h1>Thêm danh mục</h1>
                <form action="" method="POST">
                    <input required name="ten_danhmuc" type="text" placeholder="Nhập tên danh mục">
                    <input style="display: block;" required name="thutu" type="text" placeholder="Nhập thứ tự danh mục">
                    <button name="themdanhmuc"  type="submit">Thêm</button>
                </form>
            </div>
        </div>
