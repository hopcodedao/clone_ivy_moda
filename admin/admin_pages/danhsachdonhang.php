<style>
    th,td {
        padding: 4px;
    }
</style>
<?php 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST['duyet'])) {
          $result = DuyetDon($conn,$_POST['id_don_hang']);
        }
     }
?>
<h1>Danh sách đơn hàng </h1>
<br>
<table border="1px" cellspacing="0">
            <tr>
                <th style="width: 2%;">STT</th>
                <th style="width: 20%;">TÊN KHÁCH HÀNG</th>
                <th style="width: 20%;">EMAIL</th>
                <th style="width: 15%;">SỐ ĐIỆN THOẠI</th>
                <th style="width: 20%;">ĐỊA CHỈ GIAO HÀNG</th>
                <th style="width: 20%;">PHƯƠNG THỨC THANH TOÁN</th>
                <th>TRẠNG THÁI</th>
                <th>TỔNG TIỀN ĐƠN HÀNG</th>
                <th style="width: 10%;">THỜI GIAN ĐẶT HÀNG</th>
                <th style="width: 4%;">DUYỆT ĐƠN</th>
                <th>CHI TIẾT</th>
            </tr>
            <?php 
                $result = hienthidonhang($conn);
                if($result) {
                    $i=0;
                    while($row = mysqli_fetch_array($result)) {
                        $i++;
                
                
            ?>
            
            <tr>
                <td><?php echo $i?></td>
                <td><?php echo $row['ho'].$row['ten']?></td>
                <td><?php echo $row['email']?></td>
                <td><?php echo $row['so_dien_thoai']?></td>
                <td style="text-align: left;"><?php echo $row['dia_chi']?></td>
                <td><?php echo $row['phuong_thuc_thanh_toan']?></td>
                <td>
                    <?php 
                        if($row['trang_thai']==0){
                            echo '<b>Chờ xác nhận</b>';
                        }elseif($row['trang_thai']==1) {
                            echo '<b>Đã duyệt</b>'; 
                        }else  {
                            echo '<b  style="color: red;">Đã hủy đơn hàng</b>'; 
                        }
                    ?>
                </td>
                <td><?php echo number_format($row['tong_tien'], 0, ",", ".").'đ' ?></td>
                <td><?php echo date('d/m/Y H:i:s', strtotime($row['ngay_tao_don_hang'])) ?></td>
                <td>
                    <form method="POST" action="">
                        <?php 
                            if($row['trang_thai']==0) {
                                echo '<button name="duyet" type="submit" class="duyet" style="padding: 4px;width: initial;height: initial;">Duyệt</button>';
                            }elseif($row['trang_thai']==1) {
                                echo'<img class="hinh-anh" style="width: 30px; height: 30px;" src="../img/check.png" alt="">';
                            }else {
                                echo '<button name="duyet" type="submit" class="duyet" style="padding: 4px;width: initial;height: initial;" disabled >Duyệt</button>';
                            }
                        ?>
                        <input name="id_don_hang" type="hidden" value="<?php echo $row['id_don_hang']?>">
                        
                        
                    </form>
                </td>
                <td><a href="?url=chitietdonhang&id_don_hang=<?php echo $row['id_don_hang']?>">Xem</></td>
            </tr>
            <?php }}?>
            
</table>

