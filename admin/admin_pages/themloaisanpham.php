<?php 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST['themloaisanpham'])) {
            themloaisanpham($conn,$_POST['tenloaisanpham'],$_POST['danhmuccha']);
            if(mysqli_affected_rows($conn)>0) {
                echo "<script>showNotification('Thêm thành công', '#A8F1C6', '#188344');</script>";
            }
        }
     }
?>
<div class="admin-content-right-cartegory_add">
    <h1>Thêm loại sản phẩm</h1>
    <form action="" method="POST">
        <select name="danhmuccha" id="">
            <option value="">--Chọn danh mục</option>
            <?php 
               $result = hienthidanhmuc($conn);
               if(isset($result)) {
                    while($row = mysqli_fetch_array($result)){
            ?>
            <option value="<?php echo $row['id']?>"><?php echo $row['ten_danh_muc']?></option>
            <?php }}?>
        </select>
        <br>
        <input required name="tenloaisanpham" type="text" placeholder="Nhập tên loại sản phẩm">
        <button name="themloaisanpham" type="submit">Thêm</button>
    </form>
</div>