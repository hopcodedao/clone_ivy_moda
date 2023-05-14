<div class="admin-content-right-cartegory_list">
                <h1>Danh sách loại sản phẩm con</h1>
                <table border="1px" cellspacing="0">
                    <tr>
                        <th>STT</th>
                        <th>LOẠI SẢN PHẨM CON</th>
                        <th>LOẠI SẢN PHẨM</th>
                        <th>DANH MỤC</th>
                        <th>TUỲ BIẾN</th>
                    </tr>
                    
                    <?php 
                $result = hienthidanhmuc($conn); //is null 
                if(mysqli_num_rows($result)>0) {
                    $i=0;
                 while($row = mysqli_fetch_array($result)){
                    $q1 = "SELECT * FROM danh_muc WHERE danh_muc_cha = {$row['id']}";
                    $result1= hienthiloaisanphamcon($conn,$q1);

                    if(mysqli_num_rows($result1)>0) {
                        while($row1 = mysqli_fetch_array($result1)) {
                            $q2 = "SELECT * FROM danh_muc WHERE danh_muc_cha = {$row1['id']}";
                            $result2 = hienthiloaisanphamcon($conn,$q2);
                            if(mysqli_num_rows($result1)>0) {
                                while($row2 = mysqli_fetch_array($result2)) {
                                    $i++;
                                    echo '<tr>';
                                    echo '<td>'.$i.'</td>';
                                    echo '<td>'.$row2['ten_danh_muc'].'</td>';
                                    echo '<td>'.$row1['ten_danh_muc'].'</td>';
                                    echo '<td>'.$row['ten_danh_muc'].'</td>';
                                    echo '<td>';
                                    echo    '<a href="?url=sualoaisanphamcon&idloaispcon='.$row2['id'].'&idloaisanpham='.$row1['id'].'&iddanhmuc='.$row['id'].'">Sửa || </a>';
                                    echo    '<a href="?url=xoaloaisanphamcon&id='.$row2['id'].'">Xoá</a>';
                                    echo '</td>';
                                    echo '</tr>';
                                }}
                            
                        }
                    }
                }}
            ?>
                </table>
            </div>