<?php 
    if(isset($_GET['id_sp'])) {
        $r = laysanpham($conn,$_GET['id_sp']);
        if(isset($r)) {
            $r1 = mysqli_fetch_array($r);
        }
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST['them_san_pham'])) {
            $ten_san_pham =$_POST['ten_san_pham'];
            $danh_muc = $_POST['danh_muc'];
            $loai_san_pham = $_POST['loai_san_pham'];
            $loai_san_pham_con = $_POST['loai_san_pham_con'];
            $gia_san_pham = $_POST['gia_san_pham'];
            $khuyen_mai = $_POST['khuyen_mai'];
            $gioi_thieu = $_POST['gioi_thieu'];
            $chi_tiet_san_pham = $_POST['chi_tiet_san_pham'];
            if (!empty($_FILES['anh_san_pham']['tmp_name'])) {
                $anhsanpham = rename_image($_FILES['anh_san_pham']['name'],'image');
            }else {
                $anhsanpham = $_POST['anh_san_pham_cu'];
            }
            suasanpham($conn,$ten_san_pham,$gioi_thieu,$chi_tiet_san_pham,$loai_san_pham_con,$gia_san_pham,$khuyen_mai,$anhsanpham,$_GET['id_sp']);

            $result1 =mysqli_fetch_array(layidsanpham($conn)) ;
            $id_san_pham = $result1['id'];

            if (!($_FILES['anh_chi_tiet']['tmp_name'][0] == '')) {
                xoaanhchitiet($conn, $id_san_pham);
                $filename = $_FILES['anh_chi_tiet']['name'];
                $filetmp = $_FILES['anh_chi_tiet']['tmp_name'];
                $i = 0;
                foreach ($filename as $key => $value) {
                    $i++;
                    themanhchitiet($conn, $id_san_pham, rename_image($value, 'chi-tiet', $i), $filetmp[$key]);
                }
            }
             header('Location:?url=danhsachsanpham');
            
        }

     }
    
?>

<div class="admin-content-right">
            <div class="admin-content-right-product_add">
                <h1>Sửa sản phẩm</h1> 
                <form action="" method="POST" enctype="multipart/form-data">
                        <label for="">Nhập tên sản phẩm <span style="color:red">*</span></label>
                        <input value="<?php echo $r1['ten_san_pham']?>" name="ten_san_pham" required type="text">
                        
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
                        </select>

                        <label for="">Chọn loại sản phẩm con <span style="color:red">*</span></label>
                        <select name="loai_san_pham_con" id="submenu_id">
                            <option value="">--Chọn--</option>
                        </select>

                        <label for="">Giá sản phẩm <span style="color:red">*</span></label>
                        <input value="<?php echo $r1['gia']?>" name="gia_san_pham" required type="text">

                        <label for="">Giá khuyến mãi<span style="color:red">*</span></label>
                        <input value="<?php echo $r1['giamgia']?>" name="khuyen_mai" required type="text">

                        <label style="display: block;" for="">Giới thiệu<span style="color:red">*</span></label>
                        <textarea  name="gioi_thieu" class="editor" cols="10" rows="10"><?php echo $r1['gioi_thieu']?></textarea>

                        <label style="display: block;" for="">Chi tiết sản phẩm<span style="color:red">*</span></label>
                        <textarea name="chi_tiet_san_pham" class="editor myTextarea" cols="10" rows="10"><?php echo $r1['chi_tiet_san_pham']?></textarea>

                        <label for="">Ảnh sản phẩm<span style="color:red">*</span></label>

                        <input name="anh_san_pham_cu" value="<?php echo $r1['link_anh']?>" type="hidden">

                        <input name="anh_san_pham"  type="file">
                        <label for="">Ảnh mô tả<span style="color:red">*</span></label>
                        <input name="anh_chi_tiet[]"  multiple type="file">
                        <button name="them_san_pham" type="submit">Cập nhật</button>
                </form>
            </div>
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
    