<style>
    th,td {
        padding: 4px;
    }
</style>

<h1>Chi tiết đơn hàng</h1>
<br>
<table border="1px" cellspacing="0">
            <tr>
                <th style="width: 2%;">STT</th>
                <th style="width: 20%;">TÊN SẢN PHẨM</th>
                <th style="width: 20%;">HÌNH ẢNH</th>
                <th style="width: 20%;">GIÁ TIỀN</th>
                <th style="width: 20%;">GIẢM GIÁ</th>
                <th style="width: 15%;">SỐ LƯỢNG</th>
                <th style="width: 10%;">SIZE</th>
                <th style="width: 20%;">TỔNG TIỀN</th>
            </tr>
                <?php 
                if(isset($_GET['id_don_hang'])) {
                    $id_don_hang =  $_GET['id_don_hang'];
                    $result = chitietdonhang($conn,$id_don_hang);
                    if(isset($result)){
                        $i =0;
                        $tong_tien_hang=0;
                        while($row = mysqli_fetch_array($result)){
                            $i++;
                            $tong_tien_hang += ($row['gia'] - ($row['gia'] * $row['giamgia'] / 100)) * $row['so_luong'];

                ?>
            <tr>
                <td><?php echo $i?></td>
                <td><?php echo $row['ten_san_pham']?></td>
                <td style="height:70px;width: 70px;"><img style="height: 100%;width: 100%;object-fit: contain;" src="<?php echo 'uploads/'.$row['link_anh']?>" alt=""></td>
                <td><?php echo number_format($row['gia'], 0, ",", ".").'đ'?></td>
                <td><?php echo $row['giamgia'].'%'?></td>
                <td><?php echo $row['so_luong']?></td>
                <td><?php echo $row['size']?></td>
                <td><?php echo number_format(ceil(($row['gia'] - ($row['gia'] * $row['giamgia'] / 100)) * $row['so_luong']/1000)*1000, 0, ",", ".").'đ' ?></td>
                
            </tr>
            <?php }}}?>
            <tr>
                <td colspan="7" style="font-weight: bold;">Phí vận chuyển</td>
                <td colspan="4">38.000đ</td>
            </tr>
            <tr>
                <td colspan="7" style="font-weight: bold;">Tổng tiền hàng</td>
                <td colspan="4"><?php echo  number_format(ceil(($tong_tien_hang/1000)*1000)+38000 , 0, ",", ".").'đ' ?></td>
            </tr>
</table>

