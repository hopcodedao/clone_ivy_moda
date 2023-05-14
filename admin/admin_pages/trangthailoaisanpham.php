<!-- ajax sử lí trạng thái của danh mục -->
<?php 
include '../../conn.php';
    $id = $_POST["id"];
    $status = $_POST["status"];
    echo $id + $status ;
    // Thực hiện thay đổi trạng thái trong CSDL
    $sql = "UPDATE danh_muc SET trang_thai = '$status' WHERE id = '$id'";
    if (mysqli_query($conn, $sql)) {
      echo "Thay đổi trạng thái thành công";
    } else {
      echo "Lỗi: " . mysqli_error($conn);
    }
?>