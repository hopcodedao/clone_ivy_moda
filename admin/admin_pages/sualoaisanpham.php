<?php 
    if(isset($_GET['id_loaisp'])) {
        $id_loaisp = $_GET['id_loaisp'];
        $result=layloaisanpham($conn,$id_loaisp);
        if(isset($result)){
            $row1 = mysqli_fetch_array($result);
            $tenloaisanpham = $row1['ten_danh_muc'];
        }
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST['themloaisanpham'])) {
          sualoaisanpham($conn,$_POST['tenloaisanpham'],$id_loaisp);
        }
    }
    
?>

<div class="admin-content-right-cartegory_add">
    <h1>Sửa loại sản phẩm</h1>
    <form action="" method="POST">
        <select name="danhmuccha" id="">
            <option value="">--Chọn danh mục</option>
            <?php 
               $result = hienthidanhmuc($conn);
               if(isset($result)) {
                    while($row = mysqli_fetch_array($result)){
            ?>
                <option <?php if($_GET['id_danhmuc'] == $row['id']) {echo ' selected';} else {echo '';} ?> value="<?php echo $row['id']?>"><?php echo $row['ten_danh_muc']?></option>
                
            <?php }}?>
        </select>
        <br>
        <input value="<?php echo $tenloaisanpham?>" required name="tenloaisanpham" type="text" placeholder="Nhập tên loại sản phẩm">
        <button name="themloaisanpham" type="submit">Cập nhật</button>
    </form>
</div>