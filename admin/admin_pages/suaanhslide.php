<?php
    if(isset($_GET['id_slide'])) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST['themanhslide'])) {
                $loai_san_pham_con = $_POST['loai_san_pham_con'];
                if (!($_FILES['name']['tmp_name']== '')) {
                    $rename = rename_image($_FILES['name']['name']);
                    suaanhslide($conn,$rename,$_GET['id_slide'],$loai_san_pham_con);
                }else {
                    suaanhslide($conn,$_POST['anh_old'],$_GET['id_slide'],$loai_san_pham_con);
                }
                
            }
         }
    }
    if(isset($_GET['id_slide'])) {
        $getSlide = layanhslide_ID($conn,$_GET['id_slide']); 
        $getSlide_result = mysqli_fetch_array($getSlide);
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
                                       echo '<option'.($row['id'] == $_GET['id_danhmuc']? ' selected ' : '').' value="'.$row['id'].'">'.$row['ten_danh_muc'].'</option>';
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
                            <option value="">--Chọn--</option>
                        </select>
        <input style="width: 400px;" name="name" type="file" >
        <input type="hidden" name="anh_old" value="<?php echo $getSlide_result ['hinh']?>">
        <button name="themanhslide" style="display: block;" type="submit">Cập nhật</button>
    </form>
    
</div>
<?php 
             $idloaisanpham = $_GET['id_loai_san_pham'];
             $idloaisanphamcon =$_GET['id_loai_san_pham_con'];
        ?>
        <script>
         var idsanpham = parseInt("<?php echo $idloaisanpham; ?>");
         var idsanphamcon = parseInt("<?php echo $idloaisanphamcon; ?>");
         console.log(idsanpham)
         console.log(idsanphamcon)
         $(document).ready(function() {

            $("#category_id").change(function() {
                var id_danhmuc = $(this).val()
                // alert(id_danhmuc)
                $.get("admin_pages/hienthiloaisanpham_ajax.php",{cartegory_id:id_danhmuc,id_loaisanpham:idsanpham},function(data){
                    $("#brand_id").html(data);
                    var x1 = $("#brand_id option:selected").val();
                        $.get("admin_pages/hienthiloaisanphamcon_ajax.php",{cartegory_id:x1,id_loaisanphamcon:idsanphamcon},function(data){
                        $("#submenu_id").html(data);
                    })
                    $("#brand_id").change(function() {
                        var x1 = $("#brand_id option:selected").val();
                        $.get("admin_pages/hienthiloaisanphamcon_ajax.php",{cartegory_id:x1,id_loaisanphamcon:idsanphamcon},function(data){
                        $("#submenu_id").html(data);
                    })
                    })
                    
                })
            })
            $("#category_id").trigger("change");
            
        })
    </script>