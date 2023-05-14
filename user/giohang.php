<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start(); 
 }
if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
?> 
<div class="cart-container">
 
            <div class="cart-content-left">
                <div class="checkout-process-bar">
                    <ul>
                        <!-- thêm class active để thanh checkout-process-bar chuyển động -->
                        <li class="active"><span>Giỏ hàng </span></li>
                        <li class=""><span>Đặt hàng</span></li>
                        <li class=""><span>Thanh toán</span></li>
                        <li class=""><span>Hoàn thành đơn</span></li>
                    </ul>
                </div>

                <div class="checkout-bottom-left">
                    <h2 class="cart-title">Giỏ hàng của bạn <b><span>
                        <?php 
                     $totalquantity = 0;
                     foreach ($_SESSION['cart'] as $product) {
                     $totalquantity = $totalquantity + $product[4];
                     }
                     echo  number_format($totalquantity);
                 
                    ?></span> Sản phẩm</b></h2>
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th>TÊN SẢN PHẨM</th>
                                <th>CHIẾT KHẤU</th>
                                <th>SỐ LƯỢNG</th>
                                <th>TỔNG TIỀN</th>
                            </tr>
                        </thead>
                        <tbody> 
                            <?php
                                foreach ($_SESSION['cart'] as $product) {
                                    echo '
                            <tr>
                                <td>
                                    <div class="cart__product-item">
                                        <div class="cart__product-item__img">
                                            <a href=""><img src="admin/uploads/' . $product[2] . '" alt=""></a>
                                        </div>
                                        <div class="cart__product-item__content">
                                            <a href="">
                                                <h3 class="cart__product-item__title">
                                                ' . $product[1] . '
                                                </h3>
                                            </a>
                                            <div class="cart__product-item__properties">
                                                
                                                <p>Size: <span style="text-transform: uppercase">' . $product[5] . '</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="cart-sale-price">
                                    <p> - '.number_format($product[8]*$product[4], 0, ",", ".").'đ'.'  </p>
                                    <p class="cart-sale_item">
                                    ' . $product[6] . ' %   
                                    </p>
                                </td>
                                <td>
                                    <div class="cart-number">
                                       <p>' . $product[4] . '</p> 
                                        
                                    </div>
                                </td>
                                <td>
                                    <div class="cart__product-item__price">' .number_format($product[3]*$product[4], 0, ",", ".").'đ'. '</div>
                                </td>
                                <td>
                                    <a href="?url=delete_giohang&Remove_id=' . $product[0] . '&Remove_size='.$product[5].'">
                                    <i  class="ti-trash cart-list-delete">
                                    </i></a>                                   
                                </td>
                            </tr>
                           '
                               ; }
                                ?>
                              

                        </tbody>
                    </table>
                    

                    
                    <button onclick="goBack()" class="btn cart-btn-back btn--large btn--outline btn-cart-continue">
                        <i class="las la-long-arrow-alt-left"></i>
                        Tiếp tục mua hàng
                    </button>
                    <script>
                    function goBack() {
                    window.history.back();
                    }
                    </script>
                </div>
            </div>
            <div class="cart-content-right">
                <div class="cart-content-right-container">
                    <div class="box_product_total">
                        <h3>Tổng tiền giỏ hàng</h3>
                        <div class="box-product-table">
                            <div class="cart-summary__overview__item">
                                <p>Tổng sản phẩm</p>
                                <p>
                                    <?php
                                        $totalquantity = 0;
                                        foreach ($_SESSION['cart'] as $product) {
                                        $totalquantity = $totalquantity + $product[4];
                                        }
                                        echo number_format( $totalquantity);
                                    ?>
                                </p>
                            </div>
                            <div class="cart-summary__overview__item">
                                <p>Tổng tiền hàng</p>
                                <p> <?php
                                    $totalprice = 0;
                                    foreach ($_SESSION['cart'] as $product) {
                                        $subtotal = $product[4] * $product[7];
                                        $totalprice += $subtotal;
                           }
                           echo  number_format($totalprice, 0, ",", ".").'đ';
                           ?></p>
                            </div>
                            <div class="cart-summary__overview__item">
                                <p>Thành tiền</p>
                                <p> <?php
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
                                <p> <?php
                                    $totalprice = 0;
                                    foreach ($_SESSION['cart'] as $product) {
                                        $subtotal = $product[3] * $product[4];
                                        $totalprice += $subtotal;
                                        
                                     }
                                     echo number_format($totalprice, 0, ",", ".").'đ'  ;
                           ?></p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="cart-summary__button">
                    <a href="?url=dathang" type="submit" name="" class="btn " value="Thanh toán và giao hàng">
                        Đặt hàng
                    </a>
                </div>
            </div>
        
        </div>
        <?php
} else {
?>
   <section class="cartempty padding-section">
      <div class="container">
         <div class="cartempty-main">
            <h1 class="cartempty-title">Giỏ hàng của bạn<span> đang trống!</span></h1>
            <p class="cartempty-desc">Bạn phải mua ít nhất một món hàng!</p>
            <a class="btn-primary btn" href="index.php">Quay lại trang chủ</a>
           
         </div>
      </div>
   </section>
<?php
}
?>