<div class="admin-content-right-cartegory_list">
                <h1>Danh sách loại sản phẩm</h1>
                <table border="1px" cellspacing="0">
                    <tr>
                        <th>STT</th>
                        <th>LOẠI SẢN PHẨM</th>
                        <th>DANH MỤC CHA</th>
                        <th>ẨN</th>
                        <th>TUỲ BIẾN</th>
                    </tr>
                    
                    <?php 
                $result = hienthidanhmuc($conn);
                if(mysqli_num_rows($result)>0) {
                    $i=0;
                    
                 while($rows = mysqli_fetch_array($result)){
                    $q1 = "SELECT * FROM danh_muc WHERE danh_muc_cha = {$rows['id']}";
                    $result1 = hienthiloaisanpham($conn,$q1);
                    if(mysqli_num_rows($result1)>0) {
                        while($row1 = mysqli_fetch_array($result1)) {
                            $i++;
                            echo '<tr>';
                            echo '<td>'.$i.'</td>';
                            echo '<td>'.$row1['ten_danh_muc'].'</td>';
                            echo '<td>'.$rows['ten_danh_muc'].'</td>';
                            echo '<td><input ' . ($row1['trang_thai']==0 ? 'checked' : '') . ' type="checkbox" name="my-checkbox" data-id="' . $row1['id'] . '" onchange="handleChange(this)">';
                            echo '<td>';
                            echo    '<a href="?url=sualoaisanpham&id_loaisp='.$row1['id'].'&id_danhmuc='.$rows['id'].'">Sửa</a>';
                            echo '</td>';
                            echo '</tr>';
                            
                        }
                    }
                }}
            ?>
                </table>
            </div>
            <script>
function handleChange(checkbox) {
  var value = checkbox.checked ? 0 : 1;

  console.log(value);
  var id = checkbox.dataset.id;
  console.log(id);
  

  // Gửi yêu cầu đến trang PHP sử dụng AJAX để thay đổi trạng thái sản phẩm
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    }
  };
  xmlhttp.open("POST", "admin_pages/trangthailoaisanpham.php", true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send("id=" + id + "&status=" + value);
}
</script>