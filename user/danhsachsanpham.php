

<?php
    if(isset($_GET['keyword'])) {
        $tendanhmuc =$_GET['keyword'];
        $laySanphamSearch =laySanphamSearch($conn,$_GET['keyword']);
        $total_records = mysqli_num_rows($laySanphamSearch); //Số lượng bảng ghi
        $records_per_page = 5 ;// số lượng sản phẩm trong từng trang
        $total_pages = ceil($total_records / $records_per_page);// số trang 

        //xác định trang hiện tại 
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        //Tính vị trí bắt đầu của bảng ghi trong truy vấn 
        $offset = ($current_page - 1) * $records_per_page;
        $re= hienthisanphamsearch($conn,$_GET['keyword'],$records_per_page,$offset);
        
    }else if(isset($_GET['id_lv3'])){
        // Phân trang 
        $result_count  = laysoluongbangghi($conn,$_GET['id_lv3']);
        
        $row_count = mysqli_fetch_array($result_count);
        $total_records = $row_count['id'];//Tổng số bảng ghi trả về 
        $records_per_page = 5 ;// số lượng sản phẩm trong từng trang
        $total_pages = ceil($total_records / $records_per_page);// số trang 

        //xác định trang hiện tại 
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        //Tính vị trí bắt đầu của bảng ghi trong truy vấn 
        $offset = ($current_page - 1) * $records_per_page;

        $result=laytendanhmuc($conn, $_GET['id_lv3']);
        if(isset($result)){
            $row=mysqli_fetch_array($result) ;
            $tendanhmuc= $row['ten_danh_muc'];
        }
        // $re= laySanpham($conn,$_GET['id_lv3']);
        $re= laySanpham($conn,$_GET['id_lv3'],$records_per_page,$offset );
    
    } 
?>

<section class="cartegory">
            <div class="container">

            </div>
            <div class="container">
                <div>
                    <div class="cartegory-right ">
                        <div class="cartegory-fillter row">
                            <div class="cartegory-right-top-item">
                                <!-- danh mục sản phẩm -->
                                
                                <?php
                                    if(isset($_GET['keyword'])) {
                                        echo '<p>Kết quả tìm kiếm theo "'.$tendanhmuc.'"</p>';
                                    }else{
                                        echo "<p>".$tendanhmuc."</p>";
                                    }
                                    
                                    
                                ?>
                                <!-- <p>HÀNG NỮ MỚI VỀ</p> -->
                            
                            </div>
                        </div>
                        <div class="cartegory-content">
                            <?php
                                    if(isset($re)){
                                        while($row1=mysqli_fetch_array($re)){
                                            $id_sp= $row1['id_danh_muc'];

                                       
                            ?>
                            <div class="cartegory-item">
                                <a href="?url=chitiet&id_danhmuc=<?php echo $row1['id_danh_muc']?>&id_sanpham=<?php echo $row1['id']?>" class="img_product">
                                   
                                    <img class="img_san_pham" class="" src="admin/uploads/<?php echo $row1['link_anh']?>" alt="">
                                    <?php if($row1['giamgia'] != 0){
                                        echo '<div class="info-ticket seller">Best Seller</div>';
                                    } ?>
                                    
                                    <?php if($row1['giamgia'] != 0){
                                        echo '<span class="badget badget_02">-'.$row1['giamgia'].'<span>%</span></span>';
                                    } ?> 
                                    
                                    
                                </a>
                                <a href="?url=chitiet&id_danhmuc=<?php echo $row1['id_danh_muc']?>&id_sanpham=<?php echo $row1['id']?>">
                                    <?php
                                    echo '<h1 class="tensanpham">'.$row1['ten_san_pham'].'</h1>';
                                    ?>
                                    
                                </a>

                                <div class="category_item_bottom">
                                    <div class="category_item_price">
                                        <span class="new_price"><?php echo  number_format($row1['gia']- ($row1['gia'] * $row1['giamgia'] * 1/100), 0, ",", ".").'đ' ?></span>
                                        <?php if($row1['giamgia'] != 0){
                                            echo '<span class="old_price">'. number_format($row1['gia'], 0, ",", ".").'đ'.'</span>';
                                        } ?>
                                        
                                    </div>
                                    <div class="category_item_cart">
                                        <i class="ti-bag"></i>
                                    </div>
                                </div>
                            </div>
                            <?php
                                }} 
                            ?>

                        </div>
                        <div>
                            <div class="cartegory-right-botton">
                                <ul class="cartegory-right-botton-items">
                                <?php 
                                    if ($current_page > 1) {
                                        if(isset($_GET['keyword'])) {
                                            echo "<li><a class='pagination' href='?url=danhsachsanpham&keyword=".$_GET['keyword']."&page=" . ($current_page - 1) . "'>«</a></li>";
                                        }else{
                                            echo "<li><a class='pagination' href='?url=danhsachsanpham&id_lv3=".$id_sp."&page=" . ($current_page - 1) . "'>«</a></li>";
                                        }
                                       
                                    } else {
                                        echo "<li><span class='disabled'>«</span></li>";
                                    } 
                                    for ($i = 1; $i <= $total_pages; $i++) {
                                        $active = ($i == $current_page) ? "active" : "";
                                        if (isset($_GET['keyword'])) {
                                            echo "<li><a class='pagination $active' href='?url=danhsachsanpham&keyword=".$_GET['keyword']."&page=$i'>$i</a></li>";
                                        }else {
                                            echo "<li><a class='pagination $active' href='?url=danhsachsanpham&id_lv3=".$id_sp."&page=$i'>$i</a></li>";
                                        }
                                        
                                    }
                                    if ($current_page < $total_pages) {
                                        if(isset($_GET['keyword'])) {
                                            echo "<li><a class='pagination' href='?url=danhsachsanpham&keyword=".$_GET['keyword']."&page=" . ($current_page + 1) . "'>»</a></li>";
                                        }else{
                                            echo "<li><a class='pagination' href='?url=danhsachsanpham&id_lv3=".$id_sp."&page=" . ($current_page + 1) . "'>»</a></li>";
                                        }
                                        
                                    } else {
                                        echo "<li><span class='disabled'>»</span></li>";
                                    }
                                ?>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>

        </section>