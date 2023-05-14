<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start();
 }

?>

<?php
    if(isset ($_GET['id_sanpham'])){
        $result= laychitietsanpham($conn, $_GET['id_sanpham']);
        if(isset($result)){
            $row=mysqli_fetch_array($result) ;
            $tensanpham= $row['ten_san_pham'];
            $hinhsanpham=$row['link_anh'];
            $gioithieusanpham= $row['gioi_thieu'];
            $chitietsanpham=$row['chi_tiet_san_pham'];
            $gia =$row['gia']- ($row['gia'] * $row['giamgia'] * 1/100);
            $ID_sp = $row['id'];
            $giamgia= $row['giamgia'];
            $giacu=$row['gia'];
            $chietkhau=($row['gia'] * $row['giamgia'] * 1/100);
        }
        $re= layhinhchitietsanpham($conn, $_GET['id_sanpham']);
        
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST['them_giohang'])) {          
            $size = $_POST['size'];
            if($size==''){
                $thongbao = '<p style="color: red;">Vui lòng chọn size *</p>';
            }else{
              
                $thongbao='';
                $Id= $_POST['ID_SP'];
                $tensp= $_POST['Name_SP'];
                $hinhsp= $_POST['Img_SP'];
                $gia= $_POST['Price'];
                $soluong=$_POST['quantity'];
                $size=$_POST['size'];
                $giamgia = $_POST['giamgia'];
                $giacu =$_POST['giacu'];
                $chietkhau=$_POST['chietkhau'];
                $product = array($Id, $tensp, $hinhsp, $gia, $soluong, $size, $giamgia, $giacu,$chietkhau);
                $productIndex= -1;
                foreach ($_SESSION['cart'] as $index => $item) {
                if ($item[0] == $Id && $item[1] == $tensp && $item[2] == $hinhsp && $item[5]== $size) {
                    $productIndex = $index;
                    break;
                }
            }
            if ($productIndex > -1) {
                $_SESSION['cart'][$productIndex][4] += $soluong;
            } 
                else 
                {
                    if (!isset($_SESSION['cart'])) {
                        $_SESSION['cart'] = array();
                    }
                    array_push($_SESSION['cart'], $product);
                }
                echo'<script>themthanhcong()</script>';
                header("Refresh:0.5");
            }
        }
     }
?>

<section class="product">
            <div class="container">
                
                <div class="product-content row">
                    <div class="product-content-left row">
                            <?php
                                if(isset( $re)){
                               
                            ?>                   
                        <div class="product-content-left-big-img">
                      
                            <img src="admin/uploads/<?php echo $hinhsanpham?>" alt=""> 
                            
                            
                        </div>
                        <div class="product-content-left-small-img"> 
                          <?php  
                                 while($row1=mysqli_fetch_array($re)){
                            ?>
                            <img src="admin/uploads/<?php echo $row1['url_anh'];?>" alt="">
                            <?php
                                }
                             ?>                           
                        </div>
                            <?php                                               
                                }
                            ?>
                    </div>
                    
                    <div class="product-content-right"> 
                    <form action="" method="Post">                           
                        <div class="product-content-right-product-name">
                            <?php
                            echo '<h1>'.$tensanpham.'</h1>';
                            ?>
                        </div>
                        <div class="product-content-right-product-price">                           
                        <b><?php echo number_format($gia, 0, ",", ".").'đ' ?></b> <span class= "giachitiet">đ</span>
                        <?php 
                            if($giamgia!=0) {
                                echo '<del>'.$row['gia'].'đ </del>';
                            }
                        ?>
                        </div>
                        <div class="product-content-right-product-size">
                            <div class="size">
                                <label class="size_radio" for="size_S">S</label>
                                <input value="S" name="size" id="size_S" type="radio">  <!-- post Size -->

                                <label class="size_radio" for="size_M">M</label>
                                <input value="M" name="size" id="size_M" type="radio">

                                <label class="size_radio" for="size_L">L</label>
                                <input value="L" name="size" id="size_L" type="radio">

                                <label class="size_radio" for="size_XL">XL</label>
                                <input value="XL" name="size" id="size_XL" type="radio">

                                <label class="size_radio" for="size_XXL">XXL</label>
                                <input value="XXL" name="size" id="size_XXL" type="radio">
                            </div>
                            
                        </div>
                        <div class="quantity">
                            <span>Số lượng</span>
                            <div class="cart-number">
                                <input type="number" value="1" name="quantity"> <!-- post số lượng--->
                                <div class="cart-number-plus cart-number-quantity">
                                    <i class="fa-sharp fa-regular fa-plus"></i>
                                </div>
                                <div class="cart-number-minus cart-number-quantity">
                                    <i class="fa-sharp fa-solid fa-minus"></i>
                                </div>
                            </div>
                        </div>
                        <?php
                             if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                if(isset($_POST['them_giohang'])) {
                                    echo $thongbao;
                                }}
                             ?> 
                
                        <div class="product-content-right-product-btn">
                            <button type="submit" name="them_giohang" id="myButton" class="btn btn--large cart-detail add-to-cart-detail">
                                Thêm vào giỏ    
                            </button>
                          
                            <button type="submit" name="them_giohang"  class="btn btn--large cart-detail btn--outline"   >
                              <a href="?url=giohang&id_danhmuc=<?php echo $_GET['id_danhmuc']?>&id_sanpham=<?php echo $_GET['id_sanpham']?>">Mua hàng</a>    
                            </button>
                                    <input type="hidden"   name="Price"      value="<?php echo  $gia ?>">
                                    <input type="hidden"   name="Name_SP"    value="<?php echo  $tensanpham ?>">
                                    <input type="hidden"   name="Img_SP"     value="<?php echo  $hinhsanpham ?>">
                                    <input type="hidden"   name="ID_SP"      value="<?php echo  $ID_sp ?>">
                                    <input type="hidden"   name="giamgia"    value="<?php echo  $giamgia ?>">
                                    <input type="hidden"   name="giacu"      value="<?php echo  $giacu?>">
                                    <input type="hidden"   name="chietkhau"  value="<?php echo  $chietkhau?>">
                                 
                                    
                         
                        </div>
                        <div class="product-content-right-product-icon">
                            <a href="tel:0382187103" class="product-content-right-product-icon-item">
                                <i class="fa-solid fa-phone"></i>
                                <p>Hotline</p>
                            </a>

                            <a href="mailto: nhtbao2100768@student.edu.vn" class="product-content-right-product-icon-item">
                                <i class="fa-solid fa-envelope"></i>
                                <p>Mail</p>
                            </a>
                            <a href="https://www.facebook.com/messages/t/100075375020233" class="product-content-right-product-icon-item">
                                <i class="fa-solid fa-comment"></i>
                                <p>Chat</p>
                            </a>
                        </div>

                        <div class="product-content-right-btn-content-big">
                            <div class="product-content-right-btn-content-title">
                                <div class="product-content-right-btn-content-title-item gioithieu">
                                    <p>GIỚI THIỆU</p>
                                </div>
                                <div class="product-content-right-btn-content-title-item chitiet">
                                    <p>CHI TIẾT SẢN PHẨM</p>
                                </div>
                                <div class="product-content-right-btn-content-title-item baoquan">
                                    <p>BẢO QUẢN</p>
                                </div>
                            </div>
                            <div class="product-content-right-btn-content">
                                <div class="product-content-right-btn-content-gioithieu product-content-right-click">
                                    <?php echo $gioithieusanpham?>
                                </div>
                                <div class="product-content-right-btn-content-chitiet product-content-right-click ">
                                    <?php echo $chitietsanpham?>
                                </div>
                                <div class="product-content-right-btn-content-baoquan product-content-right-click">
                                    * Đồ Jeans nên hạn chế giặt bằng máy giặt vì sẽ làm phai màu jeans. Nếu giặt thì nên lộn trái sản phẩm khi giặt , đóng khuy , kéo khóa, không nên giặt chung cùng đồ sáng màu , tránh dính màu vào các sản phẩm khác. <br><br>                                    * Các sản phẩm cần được giặt ngay không ngâm tránh bị loang màu , phân biệt màu và loại vải để tránh trường hợp vải phai. Không nên giặt sản phẩm với xà phòng có chất tẩy mạnh , nên giặt cùng xà phòng pha loãng. <br><br>                                    * Các sản phẩm có thể giặt bằng máy thì chỉ nên để chế độ giặt nhẹ, vắt mức trung bình và nên phân các loại sản phẩm cùng màu và cùng loại vải khi giặt.
                                </div>

                            </div>
                        </div>
                                   


                    </form> 
                </div> 
                                    
            </div>
        </div>
    </section>


        <!-- sản phẩm liên quan -->
        <section class="product-related">
            <div class="container">
                <div class="product-related-title">
                    <p>Sản phẩm tương tự</p>
                </div>
                <div class="product-content-related row">
                <?php 
                    if(isset($_GET['id_danhmuc'])) {
                        $sanphamlienquan = laySanphamlienquan($conn,$_GET['id_danhmuc']);
                        if(isset($sanphamlienquan)) {
                            while($row_sanphamlienquan=mysqli_fetch_array($sanphamlienquan)){
                        
                    
                 ?> 
                    <div class="cartegory-item product-content-related-item">
                        
                                    
                        <a href="?url=chitiet&id_danhmuc=<?php echo $row_sanphamlienquan['id_danh_muc']?>&id_sanpham=<?php echo $row_sanphamlienquan['id']?>" class="img_product">
                            <img class="hover_sp" src="admin/uploads/<?php echo $row_sanphamlienquan['link_anh']?>" alt="">
                            <?php if($row_sanphamlienquan['giamgia'] != 0){
                                        echo '<div class="info-ticket seller">Best Seller</div>';
                            } ?>
                            
                            <?php if($row_sanphamlienquan['giamgia'] != 0){
                                echo '<span class="badget badget_02">-'.$row_sanphamlienquan['giamgia'].'<span>%</span></span>';
                            } ?> 
                        </a>
                        <a href="">
                            <h1><?php echo $row_sanphamlienquan['ten_san_pham']?></h1>
                        </a>

                        <div class="category_item_bottom">
                            <div class="category_item_price">
                                <span class="new_price"><?php echo  number_format($row_sanphamlienquan['gia']- ($row_sanphamlienquan['gia'] * $row_sanphamlienquan['giamgia'] * 1/100), 0, ",", ".").'đ' ?></span>
                                <?php if($row_sanphamlienquan['giamgia'] != 0){
                                    echo '<span class="old_price">'. number_format($row_sanphamlienquan['gia'], 0, ",", ".").'đ'.'</span>';
                                } ?>
                            </div>
                            <div class="category_item_cart">
                                <i class="ti-bag"></i>
                            </div>
                        </div>
                        
                    </div>
                    <?php
                            }}}
                        ?>
                   
                </div>
            </div>

        </section>
       