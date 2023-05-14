<header class="header">
            <div class="header-container">
                <ul class="header_list">
                <?php
                    $result= hienthiloaisanphamCha($conn);
                    if(mysqli_num_rows($result)>0){
                        while ($row =mysqli_fetch_array($result)){
                            echo '<li>';
                                echo '<p class="abc">'.$row['ten_danh_muc'].'</p>';
                                echo '<ul class="sub_menu">';
                                    echo '<div class="list_submenu">';
                                       
                                    //sản phẩm con
                                    $q1 = "SELECT * FROM danh_muc WHERE danh_muc_cha = {$row['id']}";
                                        $result1= hienthiloaisanphamCon($conn,$q1);
                                        if(mysqli_num_rows($result1)>0) {
                                            //in danh mục con
                                            while($row1 = mysqli_fetch_array($result1)) {
                                                echo '<div class="item_list_submenu">';
                                                    
                                                echo 
                                                '<p href="">
                                               
                                                <h3>'.$row1['ten_danh_muc'].'</h3>

                                                </p>';
                                                   
                                                echo '<ul>';
                                                       
                                                    //sản phẩm cháu
                                                    $q2 = "SELECT * FROM danh_muc WHERE danh_muc_cha = {$row1['id']}";
                                                        $result2 = hienthiloaisanphamCon($conn,$q2);
                                                        if(mysqli_num_rows($result1)>0) {
                                                            //in danh mục cháu
                                                            while($row2 = mysqli_fetch_array($result2)) {
                                                                echo 
                                                                '<li>
                                                                
                                                                <a href="?url=danhsachsanpham&id_lv2='.$row1['id'].'&id_lv3='.$row2['id'].'">'.$row2['ten_danh_muc'].'
                                                                
                                                                </a></li>';
                                                            }
                                                        }
                                                    echo '</ul>';
                                                echo '</div>';
                                            }
                                        }
                                    echo '</div>';
                                echo '</ul>';
                            echo '<li>';
                        }
                    }
                    
                ?>        
                </ul>


                <ul class="header_logo">
                    <a href="index.php"><img src="img/logo (1).png" alt=""></a>
                </ul>
                <ul class="header_right">
                    <form method="GET" onsubmit="return validateForm()" class="header_search">
                        <button style="cursor: pointer;" type="submit">
                            <i class="ti-search"></i>
                        </button>
                        <input type="hidden" name="url" value="danhsachsanpham">
                        <input id="search" name="keyword" type="text" placeholder="Tìm kiếm sản phẩm" autocomplete="off">
                    </form>
                    <div class="header_order">
                        <div class="item-headphone">
                            <a href="#">
                                <i class="icon-color ti-headphone"></i>
                            </a>
                            <div class="sub-action ">
                                <div class="top-action-item">
                                    <h3>Trợ giúp</h3>
                                </div>
                                <ul>
                                    <li><a href="tel:0382187103"><i class="ti-mobile"></i> Hotline</a></li>
                                    <li><a href=""><i class="ti-comment-alt"></i></i>Live Chat</a></li>
                                    <li><a href=""><i class="ti-reload"></i></i>Messenger</a></li>
                                    <li><a href="mailto:thienbao1212003@gmail.com"><i class="ti-email"></i> Email</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div> <a href="<?php echo isset($_SESSION['id_nguoi_dung'] )? '?url=thongtintaikhoan': '?url=dangnhap'?>"><i class="icon-color ti-user"></i></a></div>
                        <?php
                            if (isset($_SESSION['cart']) && count($_SESSION['cart']) >= 0) {
                                
                        ?>
                        <div class="item-cart">
                            <a class="icon icon-color" href="#">
                                <i class="ti-bag"></i>
                                <!-- số sản phẩm có trong giỏ hàng -->
                                <span><?php
                                        $totalquantity = 0;
                                        foreach ($_SESSION['cart'] as $product) {
                                        $totalquantity = $totalquantity + $product[4];
                                        }
                                        echo  $totalquantity;
                                    ?></span>
                            </a>
                            
                            <div class="cart-action">
                                <div class="top-action">
                                    <!-- số sản phẩm có trong giỏ hàng -->
                                    <h3>Giỏ hàng <span class="number-cart">
                                    <?php
                                        $totalquantity = 0;
                                        foreach ($_SESSION['cart'] as $product) {
                                        $totalquantity = $totalquantity + $product[4];
                                        }
                                        echo  $totalquantity;
                                    ?></span></h3>

                                    <div class="action-close"><i class="fa-solid fa-xmark"></i></div>
                                </div>
                                <div style =" overflow-y: scroll; height:350px;">
                                <?php
                                
                                foreach ($_SESSION['cart'] as $product) {
                                    echo '
                                   
                                <div class="main-action">
                                    <div class="item-product-cart">
                                        <div class="thumb-product-cart">
                                            <img src="admin/uploads/'.$product[2].'" alt="">
                                        </div>
                                        <div class="info-product-cart">
                                            <h3><a href="">' . $product[1] . '</a></h3>
                                            <div class="info-properties">
                                                
                                                <p>Size: <strong style="text-transform: uppercase">' . $product[5] . '</strong></p>
                                            </div>
                                            <div class="info-price-mini">
                                                <div class="info-price-quantity">
                                                    <p> Số lượng: ' . $product[4] . '</p>
                                                   
                                                </div>
                                                <div class="price-cart-mini"><ins><span>' . number_format($product[3]) . ' </span></ins></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>';
                            }
                                ?>
                                </div>

                                <div class="bottom-action">
                                    <input type="hidden" name="total_price_not_format" value="">

                                    <!-- đơn giá trong giỏ hàng -->
                                    <div class="total-price">Tổng cộng: <strong><?php
                                  
                                    $totalprice = 0;
                                    foreach ($_SESSION['cart'] as $product) {
                                        $subtotal = $product[3] * $product[4];
                                        $totalprice += $subtotal;
                                     }
                                     echo number_format($totalprice) ;
                          
                           ?>đ</strong></div>
                                    
                                    <div class="box-action">
                                        <!-- khi có sản phẩm trong giỏ thì mới hiển thị nút xem giỏ hàng  -->
                                        <a href="?url=giohang" class="action-view-cart" >Xem giỏ hàng</a>
                                        <a style="<?php echo isset($_SESSION['id_nguoi_dung']) ? 'display: none;' : ''; ?>" href="?url=dangnhap" class="action-login">Đăng nhập</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }else {
                            ?>
                               <div class="item-cart">
                            <a class="icon icon-color" href="#">
                                <i class="ti-bag"></i>

                                <!-- số sản phẩm có trong giỏ hàng -->
                                <span>0</span>
                            </a>
                            
                            <div class="cart-action">
                                <div class="top-action">
                                    <!-- số sản phẩm có trong giỏ hàng -->
                                    <h3>Giỏ hàng <span class="number-cart">0</span></h3>

                                    <div class="action-close"><i class="fa-solid fa-xmark"></i></div>
                                </div>
                                
                                <div class="bottom-action">
                                    <input type="hidden" name="total_price_not_format" value="">

                                    <!-- đơn giá trong giỏ hàng -->
                                  
                                    
                                    <div class="box-action">
                                        <!-- khi có sản phẩm trong giỏ thì mới hiển thị nút xem giỏ hàng  -->
                                        <a href="?url=giohang" class="action-view-cart">Xem giỏ hàng</a>
                                        <a style="<?php echo isset($_SESSION['id_nguoi_dung']) ? 'display: none;' : ''; ?>" href="?url=dangnhap" class="action-login">Đăng nhập</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <?php
                            }
                            ?>
                    </div>
                </ul>
            </div>

        </header>