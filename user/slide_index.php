<div class="container">
    <div class="nav_info">
      
    </div>
    <div class="slider-container">
        <div class="slider">
            <div class="owl-carousel owl-theme">
                <?php 
                    $result = hienthihinhSlide($conn); 
                    if($result) { 
                        while ($row=mysqli_fetch_array($result)){ 
                ?>
                <div class="slider-item item">
                            <a href="?url=danhsachsanpham&id_lv3=<?php echo $row['id_danhmuc']?>">
                                <img src="admin/uploads/<?php echo $row['hinh']?>" alt="">
                            </a>
                </div>
                <?php 
                     }
                    }
                ?>

            </div>
        </div>
    </div>

</div>