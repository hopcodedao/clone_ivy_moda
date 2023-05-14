<?php 
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
            $anhsanpham = rename_image($_FILES['anh_san_pham']['name'],'image');
            themsanpham($conn,$ten_san_pham,$gioi_thieu,$chi_tiet_san_pham,$loai_san_pham_con,$gia_san_pham,$khuyen_mai,$anhsanpham);
            if(mysqli_affected_rows($conn)>0) {
                echo "<script>showNotification('Thêm thành công', '#A8F1C6', '#188344');</script>";
            }
            $result1 =mysqli_fetch_array(layidsanpham($conn)) ;
            $id_san_pham = $result1['id'];

            $filename =$_FILES['anh_chi_tiet']['name'];
            $filetmp = $_FILES['anh_chi_tiet']['tmp_name'];
            $i =0;
            foreach($filename as $key => $value) {
                $i++;
                themanhchitiet($conn,$id_san_pham,rename_image($value,'chi-tiet',$i) ,$filetmp[$key]);
                
            }
        }
     }
?>

<div class="admin-content-right">
            <div class="admin-content-right-product_add">
                <h1>Thêm sản phẩm</h1> 
                <form action="" method="POST" enctype="multipart/form-data">
                        <label for="">Nhập tên sản phẩm <span style="color:red">*</span></label>
                        <input name="ten_san_pham" required type="text">
                        
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
                            <option value="">--Chọn--</option>
                        </select>

                        <label for="">Giá sản phẩm <span style="color:red">*</span></label>
                        <input name="gia_san_pham" required type="text">

                        <label for="">Giá khuyến mãi<span style="color:red">*</span></label>
                        <input name="khuyen_mai" required type="text">

                        <label style="display: block;" for="">Giới thiệu<span style="color:red">*</span></label>
                        <textarea class="editor" name="gioi_thieu" cols="10" rows="10"></textarea>

                        <label style="display: block;" for="">Chi tiết sản phẩm<span style="color:red">*</span></label>
                        <textarea style="height: 200px;" name="chi_tiet_san_pham" class="editor" cols="100" rows="10"></textarea>

                        <label for="">Ảnh sản phẩm<span style="color:red">*</span></label>
                        <input name="anh_san_pham" required type="file">

                        <label for="">Ảnh mô tả<span style="color:red">*</span></label>
                        <input name="anh_chi_tiet[]" required multiple type="file">

                        <button name="them_san_pham" type="submit">Thêm</button>
                </form>
            </div>
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
        
    </script>
    