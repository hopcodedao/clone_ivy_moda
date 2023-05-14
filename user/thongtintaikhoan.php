<?php 
if(session_status() == PHP_SESSION_NONE) {
    session_start(); 
}
    if(!isset($_SESSION['id_nguoi_dung'])) {
        header('location:?url=dangnhap');
        
    }
    echo$_SESSION['id_nguoi_dung'];
?>

<?php 
$tamtinh=0;
$tongtien =0;
$a=layDonHangMDH($conn,$_GET['ma_don_hang']);$b=mysqli_fetch_array($a);
    $result =laythongtinUser($conn,$_SESSION['id_nguoi_dung']);
        if(isset($result)){
            $row = mysqli_fetch_array($result); 
            $ho =$row['ho'];
            $ten =$row['ten'];
            $sdt = $row['so_dien_thoai'];
            $email = $row['email'];
            $gioitinh =$row['gioi_tinh'];
            $ngaysinh =$row['ngay_sinh'];
            
       
        }
?>
<div class="info-content">
    <div class="info-content-left">
        <div class="order-sidemenu__user">
            <div class="order-sidemenu__user-avatar">
                <img src="https://pubcdn.ivymoda.com/ivy2//images/v2/assets/user-avatar-placeholder.png" alt="">
            </div>
            <div class="order-sidemenu__user-name">
                <p><?php echo $ho.' '.$ten?></p>
            </div>
        </div>
        <div class="order-sidemenu__info">
            <a href="?url=thongtintaikhoan" id="id1" class="order-sidemenu__user_info">
                <i class="ti-user"></i>
                <span>Thông tin tài khoản</span>
            </a>
            <a href="?url=thongtintaikhoan&option=quanlydonhang" id="id2" class="order-sidemenu__user_info">
                <i class="ti-reload"></i>
                <span>Quản lý đơn hàng</span>
            </a>
            <a href="?url=thongtintaikhoan&option=diachi" id="id3" class="order-sidemenu__user_info">
                <i class="ti-location-pin"></i>
                <span>Sổ địa chỉ</span>
            </a>
            <a href="?url=out" class="order-sidemenu__user_info">
                <i class="ti-share-alt"></i>
                <span>Đăng xuất</span>
            </a>

        </div>
    </div>
    <div class="info-content-right">
        <?php 
            if(!isset($_GET['option'])) {

        ?>
        <!-- thông tin tài khoản -->
        <div id="info-user">
            <h3>TÀI KHOẢN CỦA TÔI</h3>
            <div class="info-content-right-item">
                <label for="">Họ</label>
                <div class="info-content-right-item-content"><?php echo $ho?></div>
            </div>
            <div class="info-content-right-item">
                <label for="">Tên</label>
                <div class="info-content-right-item-content"><?php echo $ten?></div>
            </div>
            <div class="info-content-right-item">
                <label for="">Số điện thoại</label>
                <div class="info-content-right-item-content"><?php echo $sdt?></div>
            </div>
            <div class="info-content-right-item">
                <label for="">Email</label>
                <div class="info-content-right-item-content"><?php echo $email?></div>
            </div>
            <div class="info-content-right-item">
                <label for="">Giới tính</label>
                <div class="info-content-right-item-gioitinh" >
                    <input <?php echo $gioitinh==0 ? ' checked ': 'disabled'?> name="gioitinh" type="radio">
                    Nam
                </div>
                <div class="info-content-right-item-gioitinh">
                    <input <?php echo $gioitinh==1 ? ' checked ': 'disabled'?> name="gioitinh" type="radio">
                    Nữ
                </div >
            </div>
            <div class="info-content-right-item">
                <label for="">Ngày sinh</label>
                <div class="info-content-right-item-content"><?php echo date('d/m/Y', strtotime($ngaysinh)); ?></div>
            </div>
        </div>
        <?php }elseif($_GET['option']=='quanlydonhang'){?>
        <!-- quản lý đơn hàng  -->
            <?php 
                if(isset($_GET['ma_don_hang'])) {
                    

            ?>
                    <div class="info-content-right">
            <div class="info-content-right-top">
                <h3>CHI TIẾT ĐƠN HÀNG</h3>
                <p>
                    <?php 
                       if($b['trang_thai']==0){
                        echo '<b>Chờ xác nhận </b>';
                        }elseif($b['trang_thai']==1) {
                            echo '<b>Đã duyệt</b>'; 
                        }else  {
                            echo '<b  style="color: red;">Đã hủy đơn hàng</b>'; 
                        }
                    ?>

                </p>
            </div>
            <div class="info-content-right-content">
                <div class="scrollable-container"  style="flex: 1; height: 600px;overflow-y: scroll;">
                <?php 
                    $kq_chitiet = chitietdonhang($conn,$_GET['ma_don_hang']);
                    if(isset($kq_chitiet)) {
                        while ($bangghi = mysqli_fetch_array($kq_chitiet)){
                            $tamtinh += ($bangghi['gia']-($bangghi['gia'] * $bangghi['giamgia']/100))*$bangghi['so_luong'];
                            
                ?>
                    <div class="info-content-right-content-left">
                        <div class="info-content-right-content-left-img">
                            <img  src="admin/uploads/<?php echo $bangghi['link_anh']?>" alt="">
                        </div>
                        <div class="info-content-right-content-left-content">
                            <div style="font-weight: 500;"><?php echo $bangghi['ten_san_pham']?></div>
                            <div>Size: <?php echo $bangghi['size']?></div>
                            <div>Số lượng: <?php echo $bangghi['so_luong']?></div>
                        </div>
                        <div class="info-content-right-content-left-gia">
                            <?php echo number_format(($bangghi['gia']-($bangghi['gia'] * $bangghi['giamgia']/100))*$bangghi['so_luong'], 0, ",", ".").'đ'  ?>
                        </div>
                    </div>
                    <?php     }}?>
                </div>
                
                
                <div class="info-content-right-content-right">
                    <h3 style="margin-bottom: 10px;color: #221f20;font-size: 20px;">Tóm tắt đơn hàng</h3>
                    <div class="info-content-right-content-right-content"> 
                        <div>
                            <span>Ngày tạo đơn</span>
                            <span><?php echo $date = date('d/m/Y H:i:s', strtotime($b['ngay_tao_don_hang']));?></span>
                        </div>
                        <div>
                            <span>Tạm tính</span>
                            <span> <?php echo number_format($tamtinh, 0, ",", ".").'đ'  ?></span>
                        </div>
                        <div>
                            <span>Phí vận chuyển</span>
                            <span>38.000 đ</span>
                        </div>
                        <div>
                            <span>Tổng tiền</span>
                            <span><b> <?php echo number_format($tamtinh + 38000, 0, ",", ".").'đ'  ?></b></span>
                        </div>
                    </div>
                    <div class="phuongthucthanhtoan">
                    <h3 style="margin-bottom: 10px;color: #221f20;font-size: 20px;">Hình thức thanh toán</h3>
                        <p><?php echo $b['phuong_thuc_thanh_toan']?></p>
                    </div>
                    <div class="diachigiaohang">
                        <h3 style="margin-bottom: 10px;color: #221f20;font-size: 20px;">Địa chỉ</h3>
                        <p><?php echo $ho.' '.$ten?></p>
                        <p><?php echo $row['dia_chi']?></p>
                        <p>Điện thoại: <?php echo $sdt  ?></p>
                    </div>
                </div>
            </div>

        </div>
                    <?php }else{?>

            <div id="donhang-user">
                <h3>QUẢN LÝ ĐƠN HÀNG</h3>
                <table class="table-info">
                    <thead>
                        <tr>
                            <th>MÃ ĐƠN HÀNG</th>
                            <th>NGÀY</th>
                            <th>TRẠNG THÁI</th>
                            <th>SẢN PHẨM</th>
                            <th>TỔNG TIỀN</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        
                        $result1 = layDonHang($conn,$_SESSION['id_nguoi_dung']);
                        if(isset($result1)) {
                            while($row1= mysqli_fetch_array($result1)){

                        
            
                    ?>
                        <tr>
                            <td>
                                <a  href="?url=thongtintaikhoan&option=quanlydonhang&ma_don_hang=<?php echo $row1['ma_don_hang']?>" style ="text-decoration:underline ;">
                                    <?php echo $row1['ma_don_hang']?>
                                </a>
                            </td>
                            <td><?php echo  $date = date('d/m/Y H:i:s', strtotime($row1['ngay_dat_hang'])) ?></td>
                            <td>
                            <?php 
                                if($row1['trang_thai']==0){
                                    echo '<b>Chờ xác nhận </b>';
                                    echo '<a style ="text-decoration:underline ;" href="?url=huydon&ma_don_hang='.$row1['ma_don_hang'].'">Huỷ đơn</a>';
                                }elseif($row1['trang_thai']==1) {
                                    echo '<b>Đã duyệt</b>'; 
                                }else  {
                                    echo '<b  style="color: red;">Đã hủy đơn hàng</b>'; 
                                }
                            ?>
                            </td>
                            <td>
                                <?php 
                                    $result2 = laychitietdonhang($conn,$row1['ma_don_hang']);
                                    if(isset($result2)) {
                                        $str ='';
                                        while($row2 =mysqli_fetch_array($result2)) {
                                            $str .= (string)$row2['so_luong'] . 'x ' . $row2['ten_san_pham'] . ', ';       
                                        }
                                        $str = substr_replace($str, '.', -2);
                                        echo $str;
                                    }
                                    

                                ?>

                            </td>
                            <td style="color:#000;font-weight: 600;"><?php echo number_format($row1['tong_tien'], 0, ",", ".").'đ'?></td>
                        </tr>
                    <?php 
                        }
                        }
                    ?>
                    </tbody>
                </table>
            </div>
            <?php }?>
        <?php 
        }elseif($_GET['option']=='diachi'){
        ?>
        <!-- Sổ địa chỉ  -->
        <div id="diachi-user">
            <h3>SỔ ĐỊA CHỈ</h3>
                        <div class="block-border" style="padding: 32px 32px;display: flex;flex-direction: column;justify-content: center;">
                            <h4 class="text-elipsis-2" style=" display: -webkit-box; max-width: 250px;min-height:auto; font-size: 14px;">
                                <?php echo $row['ho'].' '.$row['ten']?>
                            </h4>
                            <p class="phone-checkout">
                                    <span>Điện thoại:</span>
                                    <span><?php echo $row['so_dien_thoai']?></span>
                            </p>
                            <p class="address-checkout text-elipsis-2"
                            style="display: -webkit-box;margin-bottom: 0;">
                                    <span>Địa chỉ:</span>
                                    <span><?php echo $row['dia_chi']?></span>
                            </p>
                        </div>
        </div>
        <?php }?>
        
    </div>


</div>
</div>

        
        