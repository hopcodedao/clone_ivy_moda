<?php 

    if(isset($_GET['idloaispcon'])) {
        $id = $_GET['idloaispcon'];
        $result=layloaisanphamcon($conn,$id);
        if(isset($result)){
            $row = mysqli_fetch_array($result);
            $tenloaisanpham = $row['ten_danh_muc'];
        }
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST['themloaisanpham'])) {
            sualoaisanphamcon($conn,$_POST['tenloaisanphamcon'],$_GET['idloaispcon']);
        }
     }
?>

<div class="admin-content-right-cartegory_add">
    <h1>Sửa loại sản phẩm con</h1>
    <form action="" method="POST">
        <label for="">Chọn danh mục</label>
        <select name="parent_id" id="category_id">
            <option value="">--Chọn--</option>
            <?php 
            $result = hienthidanhmuc($conn);
            if(isset($result)) {
                while($row = mysqli_fetch_array($result)) {
                
            ?>
            <option <?php if($_GET['iddanhmuc'] == $row['id']) {echo ' selected';} else {echo '';} ?> value="<?php echo $row['id']?>"><?php echo $row['ten_danh_muc']?></option>
            <?php }
            }?>
        </select>
        <label for="">Chọn loại sản phẩm</label>
        <select name="parent_id1" id="brand_id">

        </select>
        <br>
        <input value="<?php echo $tenloaisanpham?>" required name="tenloaisanphamcon" type="text" placeholder="Nhập tên loại sản phẩm con">
        <button name="themloaisanpham" type="submit">Cập nhật</button>
    </form>
</div>
<?php 
    $idloaisanpham = $_GET['idloaisanpham'];
?>
<script>
        var idsanpham = parseInt("<?php echo $idloaisanpham; ?>");
        $("#category_id").change(function() {
        var x = $(this).val();
        $.get("admin_pages/hienthiloaisanpham_ajax.php",{cartegory_id:x,id_loaisanpham:idsanpham},function(data){
            $("#brand_id").html(data);
        });
    });

    // Trigger the "change" event after the page loads
    $("#category_id").trigger("change");
</script>