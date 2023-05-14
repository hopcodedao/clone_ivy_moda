<div class="admin-content-right-cartegory_list">
                <h1>Danh sách hình ảnh slide</h1>
                <table border="1px" cellspacing="0">
                    <tr>
                        <th style="width: 10%;">STT</th>
                        <th style="width: 20%;">TÊN ẢNH</th>
                        <th>HÌNH ẢNH</th>
                        <th>DANH MỤC</th>
                        <th style="width: 20%;">TUỲ BIẾN</th>
                    </tr>
                    <?php 
                        $result = hienthianhslide($conn);
                        if(isset($result)){
                            $i=0;
                            while($row = mysqli_fetch_array($result)){
                                $i++;
                          
                    ?>
                    
                        <tr>
                            <td><?php echo $i?></td>
                            <td><?php echo $row['hinh'] ?></td>
                            <td  style="display:flex;justify-content: center;align-items: center;">
                                <div style="width: 300px; height: 150px;"><img style="width: 100%;height: 100%;object-fit: cover;" src="<?php echo 'uploads/'.$row['hinh']?>" alt="">
                                </div>
                            </td>
                            <?php 
                                $q1 = "select * from danh_muc where id = {$row['id_danhmuc']}";
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
                                                    echo '<td>'.$row3['ten_danh_muc'].' &#8594; '.$row2['ten_danh_muc'].' &#8594; '.$row['ten_danh_muc'].'</td>';
                                                    echo '<td>';
                                                        echo '<a href="?url=suaanhslide&id_slide='.$row['id_slide'].'&id_danhmuc='.$row3['id'].'&id_loai_san_pham='.$row2['id'].'&id_loai_san_pham_con='.$row['id_danhmuc'].'">Sửa</a> ||';
                                                        echo '<a href="?url=xoaanhslide&id_slide='.$row['id_slide'].'&id_danhmuc='.$row3['id'].'&id_loai_san_pham='.$row2['id'].'&id_loai_san_pham_con='.$row['id_danhmuc'].'">Xoá</a>';
                                                    echo '</td>';
                                                }
                                            }
                                        }
                                    }
                                }
    
                                
                            ?>
                            
                        </tr>
                        <?php 
                            }}
                        ?>
                </table>
            </div>