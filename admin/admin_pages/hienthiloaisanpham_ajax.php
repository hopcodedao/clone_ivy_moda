<?php
include '../../conn.php';
$cartegory_id = $_GET['cartegory_id'];
$id_loaisanpham = $_GET['id_loaisanpham'];

?>
 <?php 

  $q ="SELECT * FROM danh_muc WHERE danh_muc_cha = '$cartegory_id'";
  $r = mysqli_query($conn,$q);
 ?>
<?php
if (mysqli_num_rows($r) > 0) {
    echo '<option>--Chọn--</option>';
    while ($rows = mysqli_fetch_array($r)) {
        echo '<option '. ($rows['id'] == $id_loaisanpham ? ' selected ' : '') . ' value="' . $rows['id'] . '">' . $rows['ten_danh_muc'] . '</option>';
    }
}else {
    echo 'lỗi';
}
?>