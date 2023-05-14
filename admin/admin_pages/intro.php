<h1>Tổng quan</h1>
            <div class="icon-counting">
                <div class="number_item">
                    <div  class="number-item-img"><img src="../img/1.png" alt=""></div>
                    <div class="number-item-counter">
                        <p>DOANH SỐ</p>
                        <div style="display: inline;" class="counter"><?php
                            $result = doanhso($conn);
                            $row = mysqli_fetch_array($result);
                            $tongtien = $row['tongtien'];

                            if (is_numeric($tongtien)) {
                                $tongtien = intval($tongtien);
                            } else {
                                $tongtien = 0;
                            }

                            echo number_format($tongtien, 0);
                        ?></div><b> đ</b>

                    </div>
                </div>
                <div class="number_item">
                    <div  class="number-item-img"><img src="../img/2.png" alt=""></div>
                    <div class="number-item-counter">
                        <p>ĐƠN HÀNG</p>
                        <div class="counter"><?php $result1 = sodonhang($conn);$row1 = mysqli_fetch_array($result1);echo $row1['total_orders']==''? 0 : $row1['total_orders']; ?></div>
                    </div>
                </div>
                <div class="number_item">
                    <div  class="number-item-img"><img src="../img/3.png" alt=""></div>
                    <div class="number-item-counter">
                        <p>SỐ LƯỢNG BÁN</p>
                        <div class="counter"><?php $result2 = soluongban($conn);$row2 = mysqli_fetch_array($result2);echo $row2['tong_so_san_pham']==''? 0 : $row2['tong_so_san_pham']; ?></div>
                    </div>
                </div>
            </div>
            <?php require 'chart.php'?>
        </div>