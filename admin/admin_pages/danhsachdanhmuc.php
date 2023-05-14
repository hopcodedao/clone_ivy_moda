
<div class="admin-content-right-cartegory_list">
    <h1>Danh sách danh mục</h1>
    <table border="1px" cellspacing="0">
    
        <tr>
            <th>STT</th>
            <th>DANH MỤC</th>
            <th>THỨ TỰ</th>
            <th>ẨN</th>
            <th>TUỲ BIẾN</th>
        </tr>
        <?php 
        $result = hienthidanhmuc($conn);
        if($result) {
            $i = 0;
            while($row = mysqli_fetch_array($result)) {
                $i++;
    ?>
        <tr>
            <td>
               <?php  echo $i ;?>
            </td>
            <td>
                <?php echo $row['ten_danh_muc']?>
            </td>
            <td>
            <?php echo $row['thu_tu']?>
            </td>
            <td>
            <input <?php  echo ($row['trang_thai']==0) ?'checked' : ''?> type="checkbox" name="my-checkbox" data-id="<?php echo $row['id']?>" onchange="handleChange(this)">
            </td>
            <td>
                <a href="?url=suadanhmuc&id=<?php echo $row['id']?>">Sửa</a>
            </td>
        </tr>
        <?php 
            }}else {
                echo 'ádfasdf';
            }
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
  xmlhttp.open("POST", "admin_pages/trangthaidanhmuc.php", true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send("id=" + id + "&status=" + value);
}
</script>


<!-- var xmlhttp = new XMLHttpRequest();: Khai báo đối tượng XMLHttpRequest.
xmlhttp.onreadystatechange = function() { ... }: Thiết lập hàm xử lý khi trạng thái của đối tượng XMLHttpRequest thay đổi. Trong ví dụ này, khi trạng thái là 4 (hoàn thành), ta có thể xử lý kết quả trả về từ server.
xmlhttp.open("POST", "thaydoitrangthai.php", true);: Thiết lập yêu cầu kết nối đến server. Trong ví dụ này, yêu cầu sẽ được gửi đến file thaydoitrangthai.php bằng phương thức POST.
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");: Thiết lập tiêu đề yêu cầu HTTP để chỉ định loại dữ liệu được gửi đến server. Trong ví dụ này, loại dữ liệu được gửi là application/x-www-form-urlencoded, là dữ liệu được mã hóa theo chuẩn URL-encoded.
xmlhttp.send("id=" + id + "&status=" + value);: Gửi dữ liệu đến server. Dữ liệu được gửi trong đoạn chuỗi "id=" + id + "&status=" + value, trong đó id và value là giá trị của các biến được truyền vào. -->
