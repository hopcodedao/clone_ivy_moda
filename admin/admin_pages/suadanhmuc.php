<?php 
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $result=laydanhmuc($conn,$id);
        if(isset($result)){
            $row = mysqli_fetch_array($result);
            $tendanhmuc = $row['ten_danh_muc'];
            $thutu =$row['thu_tu'];
        }
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST['themdanhmuc'])) {
          suadanhmuc($conn,$_POST['ten_danhmuc'],$_POST['thutu'],$id);

        }
    }
    
?>

<div class="admin-content-right">
            <div class="admin-content-right-cartegory_add">
                <h1>Sửa danh mục</h1>
                <form action="" method="POST">
                    <input value="<?php echo $tendanhmuc?>" required name="ten_danhmuc" type="text" placeholder="Nhập tên danh mục">
                    <input value="<?php echo $thutu ?>" style="display: block;" required name="thutu" type="text" placeholder="Nhập thứ tự danh mục">
                    <button name="themdanhmuc"  type="submit">Cập nhật</button>
                </form>
            </div>
        </div>
