<?php 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST['themloaisanpham'])) {
            themloaisanphamcon($conn,$_POST['tenloaisanphamcon'],$_POST['parent_id1']);
            if(mysqli_affected_rows($conn)>0) {
                echo "<script>showNotification('Thêm thành công', '#A8F1C6', '#188344');</script>";
            }
        }
     }
?>

<div class="admin-content-right-cartegory_add">
    <h1>Thêm loại sản phẩm con</h1>
    <form action="" method="POST">
        <label for="">Chọn danh mục</label>
        <select name="parent_id" id="category_id">
            <option value="">--Chọn--</option>
            <?php 
            $result = hienthidanhmuc($conn);
            if(isset($result)) {
                while($row = mysqli_fetch_array($result)) {
                    if($row['danh_muc_cha']==0) {   
            ?>
            <option value="<?php echo $row['id']?>"><?php echo $row['ten_danh_muc']?></option>
            <?php }}
            }?>
        </select>
        <label for="">Chọn loại sản phẩm</label> 
        <select name="parent_id1" id="brand_id">
        </select>
        
        <br>
        <input required name="tenloaisanphamcon" type="text" placeholder="Nhập tên loại sản phẩm con">
        <button name="themloaisanpham" type="submit">Thêm</button>
    </form>
</div>
<script>
         $(document).ready(function() {
            $("#category_id").change(function() {
                var x = $(this).val()
                $.get("admin_pages/hienthiloaisanpham_ajax.php",{cartegory_id:x},function(data){
                    $("#brand_id").html(data);
                })
            })
        })
    </script>