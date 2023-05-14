<?php
include '../../conn.php';
include 'func.php';
$type_sort = $_GET['sort_type'];
?>
    <?php 
        $result_count  = laysoluongbangghi($conn);
        $row_count = mysqli_fetch_array($result_count);
        $total_records = $row_count['id'];//Tổng số bảng ghi trả về 
        $records_per_page = 2;// số lượng sản phẩm trong từng trang
        $total_pages = ceil($total_records / $records_per_page);// số trang 

        //xác định trang hiện tại 
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        //Tính vị trí bắt đầu của bảng ghi trong truy vấn 
        $offset = ($current_page - 1) * $records_per_page;
    ?>
        <table border="1px" cellspacing="0">
            <tr>
                <th style="width: 2%;">STT</th>
                <th style="width: 10%;">TÊN SẢN PHẨM</th>
                <th style="width: 15%;">GIỚI THIỆU</th>
                <th style="width: 15%;">CHI TIẾT SẢN Phẩm</th>
                <th style="width: 7%;">GIÁ SẢN PHẨM</th>
                <th style="width: 7%;">GIÁ KHUYẾN MÃI</th>
                <th>ẢNH SẢN PHẨM</th>
                <th>TÊN DANH MỤC</th>
                <th>TÊN LOẠI SẢN PHẨM</th>
                <th>TÊN LOẠI SẢN PHẨM CON</th>       
                <th style="width: 7%;">TUỲ BIẾN</th>
            </tr>
                        <tr>
                            <?php 
                            
                                $result = hienthisanpham($conn,$records_per_page,$offset,$type_sort);
                                if($result) {
                                    $i=0;
                                    while($row = mysqli_fetch_array($result)) {
                                        echo "<tr>";
                                        $i++;
                            ?>
    
                            <td><?php echo $i?></td>
                            <td><?php echo $row['ten_san_pham']?></td>
                            <td><?php echo $row['gioi_thieu']?></td>
                            <td><?php echo $row['chi_tiet_san_pham']?></td>
                            <td><?php echo number_format($row['gia'], 0, ",", ".").'đ' ?></td>
                            <td><?php echo $row['giamgia'].'%'?></td>
                            <td style="height:70px;width: 70px;"><img style="height: 100%;width: 100%;object-fit: contain;" src="<?php echo 'uploads/'.$row['link_anh']?>" alt=""></td>
                            
                            <?php 
                                $q1 = "select * from danh_muc where id = {$row['id_danh_muc']}";
                                $result1 = laydanhmucAll($conn,$q1);
                                if(isset($result1)) {
                                    while($row1 = mysqli_fetch_array($result1)) {
                                        $q2 = "select * from danh_muc where id = {$row1['danh_muc_cha']}";
                                        $result2 =laydanhmucAll($conn,$q2);
                                        if(isset($result2)) {
                                            while($row2= mysqli_fetch_array($result2)) {
                                                $q3 = "select * from danh_muc where id = {$row2['danh_muc_cha']}";
                                                $result3 =laydanhmucAll($conn,$q3);
                                                while($row3= mysqli_fetch_array($result3)) {
                                                    echo '<td>'.$row3['ten_danh_muc'].'</td>';
    
                                                    echo '<td>'.$row2['ten_danh_muc'].'</td>';
                                                    echo '<td>'.$row['ten_danh_muc'].'</td>';
                                                    echo '<td>';
                                                        echo '<a href="?url=suasanpham&id_sp='.$row['id'].'&id_danhmuc='.$row3['id'].'&id_loai_san_pham='.$row2['id'].'&id_loai_san_pham_con='.$row['id_danh_muc'].'">Sửa</a> ||';
                                                        echo '<a href="?url=xoasanpham&id_sp='.$row['id'].'&id_danhmuc='.$row3['id'].'&id_loai_san_pham='.$row2['id'].'&id_loai_san_pham_con='.$row['id_danh_muc'].'">Xoá</a>';
                                                    echo '</td>';
                                                    
                                                }
                                            }
                                        }
                                    }
                                }
    
                                
                            ?>
                            
                            <?php 
                            echo "</tr>";
                            }}?>
                            
                        </tr>
                        
        </table>