<?php 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST['themanhslide'])) {
            $rename = rename_image($_FILES['name']['name']);
            $loai_san_pham_con = $_POST['loai_san_pham_con'];
            themanhslide($conn,$rename,$loai_san_pham_con);
            if(mysqli_affected_rows($conn)>0) {
                echo "<script>showNotification('Thêm thành công', '#A8F1C6', '#188344');</script>";
            }
        }
     }
?>
<style>
    label {
        margin-bottom: 5px;
        margin-top: 10px;
        display: block;
    }
</style>
<div class="admin-content-right">
    <h1>Thêm ảnh slide</h1>
    <form action="" method="POST" enctype="multipart/form-data">
    <label for="">Chọn danh mục <span style="color:red">*</span></label>
        <select name="danh_muc" id="category_id">
            <option value="#">--Chọn--</option>
            <?php 
                $result = hienthidanhmuc($conn);
                if(isset($result)) {
                    while($row = mysqli_fetch_array($result)) {
                       echo '<option value="'.$row['id'].'">'.$row['ten_danh_muc'].'</option>';
                    }
                }
            ?>
        </select>
        <label for="">Chọn loại sản phẩm <span style="color:red">*</span></label>
        <select name="loai_san_pham" id="brand_id">
        <option>--Chọn--</option>
        </select>

        <label for="">Chọn loại sản phẩm con <span style="color:red">*</span></label>
        <select name="loai_san_pham_con" id="submenu_id">
            <option>--Chọn--</option>
        </select>
        <b style="display: block;margin-top: 10px;" for="">Chon ảnh slide<span style="color:red">*</span></b>
        <input style="width: 400px;" name="name" type="file" >
        <button name="themanhslide" style="display: block;" type="submit">Thêm</button>
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

            $("#brand_id").change(function() {
                var x = $(this).val()
                $.get("admin_pages/hienthiloaisanphamcon_ajax.php",{cartegory_id:x},function(data){
                    $("#submenu_id").html(data);
                })
            })
        })
        $("#category_id").trigger("change");
        $("#brand_id").trigger("change");
    </script>