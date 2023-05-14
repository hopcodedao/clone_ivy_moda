<?php 
if(!isset($_SESSION['id_nguoi_dung'])) {
    header('location:?url=dangnhap');
    
}
?>
<?php 
    $result =laythongtinUser($conn,$_SESSION['id_nguoi_dung']);
        if(isset($result)){
            $row = mysqli_fetch_array($result); 
       
    
?>
<div class="cart-container">
            <div class="cart-content-left">
                <div class="checkout-process-bar">
                    <ul>
                        <!-- thêm class active để thanh checkout-process-bar chuyển động -->
                        <li class="active"><span>Giỏ hàng </span></li>
                        <li class="active"><span>Đặt hàng</span></li>
                        <li class=""><span>Thanh toán</span></li>
                        <li class=""><span>Hoàn thành đơn</span></li>
                    </ul>
                </div>
                <div class="checkout-address-delivery">
                    <h3 class="checkout-title">Địa chỉ giao hàng</h3>
                    <div style="<?php echo isset($_SESSION['id_nguoi_dung'])?'display: none;' : ''?>" class="buttons">
                        <a class="btn btn--large" href="?url=dangnhap">Đăng nhập</a>
                        <a class="btn btn--large btn--outline" href="?url=dangki">Đăng ký</a>
                    </div>
                    <p style="<?php echo isset($_SESSION['id_nguoi_dung'])?'display: none;' : ''?> margin: 20px 0;">Đăng nhập/ Đăng ký tài khoản để được tích điểm và nhận thêm nhiều ưu đãi từ IVY moda.</p>
                    <div id="diachi-user">
                        <div class="block-border" style="padding: 32px 32px;display: flex;flex-direction: column;justify-content: center;">
                            <h4 class="text-elipsis-2" style="display: -webkit-box; max-width: 250px;min-height:auto; font-size: 14px;">
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
                </div>
                <div class="checkout-bottom-left">
                    <h3 class="checkout-title">Phương thức giao hàng</h3>
                    <div class="block-border">
                        <label class="ds__item">
                            <div class="radio_ds_item"><i  class="radio_item_check fa-solid fa-check"></i></div>
                            <input id="shipping_method_1" class="ds__item__input" type="radio" name="" value="1"
                                checked="">
                            <span class="ds__item__label">
                                Chuyển phát nhanh
                            </span>
                        </label>
                    </div>
                    <div class="method_pay">
                        <div class="checkout-title">Phương thức thanh toán</div>
                        <div class="block-border">
                            <p>Mọi giao dịch đều được bảo mật và mã hóa. Thông tin thẻ tín dụng sẽ không bao giờ được
                                lưu lại.</p>
                            <div class="checkout-payment__options">
                                <label for="payment_method_3" class="ds__item">
                                    <div class="radio_ds_item"><i  class="radio_item_check fa-solid fa-check"></i></div>
                                    <input class="ds__item__input" type="radio" name="" id="payment_method_3" checked value="3">
                                    <span class="ds__item__label">
                                        Thanh toán khi giao hàng
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cart-content-right">
                <div class="cart-content-right-container">
                <div class="box_product_total">
                        <h3>Tóm tắt đơn hàng</h3>
                        <div class="box-product-table">
                            <div class="cart-summary__overview__item">
                                <p>Tổng tiền hàng</p>
                                <p><?php                                 
                                  $totalprice = 0;
                                  foreach ($_SESSION['cart'] as $product) {
                                      $subtotal = $product[3] * $product[4];
                                      $totalprice += $subtotal;
                                   }
                                   echo number_format($totalprice, 0, ",", ".").'đ'  ;
                        
                                ?></p>
                            </div>
                            <div class="cart-summary__overview__item">
                                <p>Tạm tính</p>
                                <p><?php
                                    $totalprice = 0;
                                    foreach ($_SESSION['cart'] as $product) {
                                        $subtotal = $product[3] * $product[4];
                                        $totalprice += $subtotal;
                                        
                                     }
                                     echo number_format($totalprice, 0, ",", ".").'đ'  ;
                           ?></p>
                            </div>
                            <div class="cart-summary__overview__item">
                                <p>Phí vận chuyển</p>
                                <p><?php 
                                echo '38.000đ'?></p>
                            </div>
                            <div class="cart-summary__overview__item">
                                <p>Tiền thanh toán</p>
                                <p><b><?php  
                                $phi=38000;
                                 
                                    $thanhtoan = $totalprice + $phi;
                                    echo number_format($thanhtoan, 0, ",", ".").'đ'  ;
                                    
                                ?>
                                </b></p>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <?php 
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            if(isset($_POST['hoanthanh'])) {          
                                TaoDonHang($conn,$_SESSION['id_nguoi_dung'],TaoMaDonHang($_SESSION['id_nguoi_dung']),$thanhtoan,'Thanh toán khi giao hàng');
                                //print_r ($_SESSION['cart']);
                                $re=Laydonhangmoinhat($conn);
                                if(isset($re)){
                                    $row=mysqli_fetch_array($re);
                                    $id_don_hang=$row['id_don_hang'];
                                }
                                foreach ($_SESSION['cart'] as $item) {
                                    $quantity = $item[4]; // Lấy số lượng sản phẩm từ phần tử $product[4]
                                    ThemChiTietDonHang($conn,$id_don_hang,$item[0],$item[5],$item[4]);
                                }
                                    $_SESSION['cart'] = array();                                   
                                    //điều hướng về thông tin tài khoản
                                    if(mysqli_affected_rows($conn)>0) {
                                        echo "<script>dathangthanhcong()</script>";
                                    }
                                    header('Refresh: 2; URL=index.php');
                                }
                            }
                    ?>
                    <form method="POST" action="">
                        <div class="cart-summary__button">
                            <button type="submit" name="hoanthanh" class="btn " value="Thanh toán và giao hàng">
                                Hoàn thành
                            </button>
                        </div>
                    </form>
                
            </div>
        </div>
<?php  }?>



