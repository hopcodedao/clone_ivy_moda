<?php 

//ĐĂNG NHẬP ADMIN
function logIn($conn,$user,$pass) {
    $sql = "SELECT  * FROM `nguoi_dung` WHERE email ='$user' and mat_khau ='$pass'";
    $result =  mysqli_query($conn,$sql);
    if (!$result) {
       return die("Lỗi truy vấn: " . mysqli_error($conn));
    }else {
        return $result;
    }
}






//DANH MỤC
function themdanhmuc($ketnoi,$tendanhmuc,$thutu) {
    $sql = "INSERT INTO danh_muc (ten_danh_muc,thu_tu) VALUES ('$tendanhmuc','$thutu')";
    $result = mysqli_query($ketnoi, $sql);
    if(isset($result)) {
        return $result;
    }
}

function hienthidanhmuc($ketnoi) {
    $sql = "SELECT * FROM danh_muc WHERE danh_muc_cha IS NULL ORDER BY id DESC";
    $result = mysqli_query($ketnoi, $sql);
    return $result;
}

function laydanhmuc($ketnoi,$id){
    $sql = "SELECT * FROM danh_muc WHERE id ='$id'";
    $result = mysqli_query($ketnoi, $sql);
    return $result;
}
function laydanhmucAll($ketnoi,$sql){
    $result = mysqli_query($ketnoi, $sql);
    return $result;
}
function suadanhmuc($ketnoi,$tendanhmuc,$thutu,$id) {
    $sql = "UPDATE danh_muc SET ten_danh_muc = '$tendanhmuc',thu_tu='$thutu' WHERE id ='$id'";
    $result = mysqli_query($ketnoi, $sql);
    header('location:?url=danhsachdanhmuc');
    return $result;
}






//LOẠI SẢN PHẨM
function themloaisanpham($ketnoi,$tenloaisanpham,$danhmuccha) {
    $sql = "INSERT INTO danh_muc (ten_danh_muc,danh_muc_cha ) VALUES ('$tenloaisanpham','$danhmuccha')";
    $result = mysqli_query($ketnoi, $sql);
    if(isset($result)) {
        return $result;
    }
}

function hienthiloaisanpham($ketnoi,$sql) {
    $result = mysqli_query($ketnoi, $sql);
    return $result;
}

function layloaisanpham($ketnoi,$id){
    $sql = "SELECT * FROM danh_muc WHERE id ='$id'";
    $result = mysqli_query($ketnoi, $sql);
    return $result;
}

function sualoaisanpham($ketnoi,$tenloaisanpham,$id) {
    $sql = "UPDATE danh_muc SET ten_danh_muc = '$tenloaisanpham' WHERE id ='$id'";
    $result = mysqli_query($ketnoi, $sql);
    header('location:?url=dsloaisanpham');
    return $result;
}






//LOẠI SẢN PHẨM CON 
function themloaisanphamcon($ketnoi,$tenloaisanpham,$danhmuccha) {
    $sql = "INSERT INTO danh_muc (ten_danh_muc,danh_muc_cha ) VALUES ('$tenloaisanpham','$danhmuccha')";
    $result = mysqli_query($ketnoi, $sql);
    if(isset($result)) {
        return $result;
    }
}
function hienthiloaisanphamcon($ketnoi,$sql) {
    $result = mysqli_query($ketnoi, $sql);
    return $result;
}

function sualoaisanphamcon($ketnoi,$tenloaisanpham,$id) {
    $sql = "UPDATE danh_muc SET ten_danh_muc = '$tenloaisanpham' WHERE id ='$id'";
    $result = mysqli_query($ketnoi, $sql);
    header('location:?url=dsloaisanphamcon');
    return $result;
}

function layloaisanphamcon($ketnoi,$id){
    $sql = "SELECT * FROM danh_muc WHERE id ='$id'";
    $result = mysqli_query($ketnoi, $sql);
    return $result;
}

function layloaisanphamcha($ketnoi,$danhmuccha){
    $sql = "SELECT * FROM danh_muc WHERE id ='$danhmuccha'";
    $result = mysqli_query($ketnoi, $sql);
    return $result;
}
function xoaloaisanphamcon($ketnoi,$id) {
    $sql = "DELETE FROM danh_muc WHERE id ='$id'";
    $result = mysqli_query($ketnoi,$sql);
    header('Location:?url=dsloaisanphamcon');
    return $result;
}




// SLIDE
//Hàm thêm ảnh slide
function themanhslide($ketnoi,$hinh,$id_danh_muc) {
    $sql = "INSERT INTO `slide`(`hinh`, `id_danhmuc`) VALUES ('$hinh','$id_danh_muc')";
    $result = mysqli_query($ketnoi, $sql);
    if(isset($result)) {
        move_uploaded_file($_FILES['name']['tmp_name'],"uploads/".$hinh);
        return $result;
    }
}
// Hàm lấy ảnh slide 
function hienthianhslide($ketnoi){
    $sql = "SELECT slide.id as id_slide,slide.hinh,slide.id_danhmuc,danh_muc.* FROM slide,danh_muc WHERE slide.id_danhmuc= danh_muc.id";
    $result = mysqli_query($ketnoi, $sql);
    return $result;
}
// Hàm sửa ảnh slide 
function suaanhslide($ketnoi,$hinh,$id_slide,$id_danhmuc) {
    $sql = "UPDATE slide SET hinh = '$hinh',`id_danhmuc`='$id_danhmuc' WHERE id ='$id_slide'";
    $result = mysqli_query($ketnoi, $sql);
    if(isset($result)) {
        header('location:?url=danhsachanhslide');
        move_uploaded_file($_FILES['name']['tmp_name'],"uploads/".$hinh);
        return $result;
    }
}
//Hàm xoá ảnh slide 
function xoaanhslide($ketnoi,$id) {
    $sql = "DELETE FROM slide WHERE id ='$id'";
    $result = mysqli_query($ketnoi,$sql);
    header('location:?url=danhsachanhslide');
    return $result;
}
//Hàm lấy ảnh slide theo id 
function layanhslide_ID($ketnoi,$id_slide) {
    $sql = "SELECT * FROM slide WHERE id = $id_slide";
    $result = mysqli_query($ketnoi,$sql);
    return $result;
}




// SẢN PHẨM 
//Hàm thêm sản phẩm 
function themsanpham($ketnoi,$ten_san_pham,$gioi_thieu,$chi_tiet_san_pham,$id_danh_muc,$gia,$giamgia,$linkanh) {
    $sql = "INSERT INTO `san_pham`(
        `ten_san_pham`, 
        `gioi_thieu`, 
        `chi_tiet_san_pham`, 
        `id_danh_muc`, 
        `gia`, 
        `giamgia`, 
        `link_anh`) 
    VALUES (
        '$ten_san_pham',
        '$gioi_thieu',
        '$chi_tiet_san_pham',
        '$id_danh_muc',
        '$gia',
        '$giamgia',
        '$linkanh')";
    $result = mysqli_query($ketnoi, $sql);
    if(isset($result)) {
        move_uploaded_file($_FILES['anh_san_pham']['tmp_name'],"uploads/".$linkanh);
        return $result;
    }
}
//Hàm lấy id sản phẩm vừa thêm 
function layidsanpham($ketnoi){
    $sql = "SELECT * FROM san_pham ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($ketnoi, $sql);
    return $result;
}
//Hàm thêm ảnh chi tiết sản phẩm 
function themanhchitiet($ketnoi,$id_san_pham,$url_anh,$urltmp) {
    $sql = "INSERT INTO `anh_san_pham`( `id_san_pham`, `url_anh`) VALUES ('$id_san_pham','$url_anh')";
    $result = mysqli_query($ketnoi, $sql);
    if(isset($result)) {
        move_uploaded_file($urltmp,"uploads/".$url_anh);
        return $result;
    }
}
//Hàm hiển thị sản phẩm 
function hienthisanpham($ketnoi,$records_per_page,$offset,$sort_type='',$keyword=''){

    $sql = "SELECT san_pham.*, danh_muc.id AS id_danhmuc, danh_muc.ten_danh_muc, danh_muc.danh_muc_cha  
        FROM san_pham
        INNER JOIN danh_muc ON san_pham.id_danh_muc = danh_muc.id
        WHERE san_pham.ten_san_pham LIKE '%$keyword%'
        ORDER BY gia $sort_type
        LIMIT $records_per_page OFFSET $offset";
    $result = mysqli_query($ketnoi, $sql);
    return $result;
}


//Hàm lấy sản phẩm theo id  
function laysanpham($ketnoi,$id_San_pham) {
    $sql = "SELECT * FROM san_pham WHERE id='$id_San_pham'";
    $result = mysqli_query($ketnoi,$sql);
    return $result;
}
//Hàm sửa sản phẩm 
function suasanpham($ketnoi,$ten_san_pham,$gioi_thieu,$chi_tiet_san_pham,$id_danh_muc,$gia,$giamgia,$linkanh,$id_san_pham) {
    $sql = "UPDATE `san_pham` SET
     `ten_san_pham`='$ten_san_pham',
     `gioi_thieu`='$gioi_thieu',
     `chi_tiet_san_pham`='$chi_tiet_san_pham',
     `id_danh_muc`='$id_danh_muc',
     `gia`='$gia',
     `giamgia`='$giamgia',
     `link_anh`='$linkanh' WHERE `id`='$id_san_pham'";
    $result = mysqli_query($ketnoi, $sql);
    if(isset($result)) {
        move_uploaded_file($_FILES['anh_san_pham']['tmp_name'],"uploads/".$linkanh);
        return $result;
    }
}
//Hàm xoá sản phẩm
function xoasanpham($ketnoi,$id_sanpham) {
    $sql = "DELETE FROM `san_pham` WHERE id ='$id_sanpham'";
    $result = mysqli_query($ketnoi,$sql);
    return $result;
}

//hàm xoá ảnh chi tiết theo id_sản phẩm 
function xoaanhchitiet($ketnoi,$id_san_pham) {
    $sql ="DELETE FROM `anh_san_pham` WHERE id_san_pham ='$id_san_pham'";
    $result = mysqli_query($ketnoi,$sql);
    return $result;
}

//Hàm lấy số lượng bản ghi trong bảng sản phẩm 
function laysoluongbangghi($ketnoi) {
    $sql = "SELECT COUNT(*) AS id FROM san_pham";
    $result = mysqli_query($ketnoi, $sql);
    return $result;
}
// Hàm rename ảnh 
function rename_image($image_path, $prefix = 'slide',$index=0) {
  $time_stamp = time(); // Lấy thời gian hiện tại
  $file_extension = pathinfo($image_path, PATHINFO_EXTENSION); // Lấy phần mở rộng của file

  $new_file_name = $prefix . '_' . $time_stamp .$index. '.' . $file_extension; // Tạo tên file mới

  return $new_file_name; // Trả về tên file mới
}

// Đơn hàng 
function hienthidonhang($ketnoi) {
    $sql = "SELECT nguoi_dung.*,don_hang.* FROM nguoi_dung,don_hang WHERE nguoi_dung.id_nguoi_dung=don_hang.id_nguoi_dung";
    $result = mysqli_query($ketnoi, $sql);
    return $result;
}
// lấy chi tiết đơn hàng
function chitietdonhang($ketnoi,$id_don_hang){
    $sql ="SELECT  chi_tiet_don_hang.*,san_pham.* FROM chi_tiet_don_hang,san_pham WHERE san_pham.id = chi_tiet_don_hang.id_san_pham AND chi_tiet_don_hang.id_donhang=$id_don_hang";
    $result = mysqli_query($ketnoi, $sql);
    return $result;
}

//intro
function doanhso($ketnoi){
    $sql ="SELECT SUM(tong_tien) AS tongtien
    FROM don_hang 
    WHERE trang_thai = 1 AND ngay_tao_don_hang BETWEEN DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW()";
    $result = mysqli_query($ketnoi, $sql);
    return $result;
}
function sodonhang($ketnoi) {
    $sql ="SELECT COUNT(*) AS total_orders FROM don_hang WHERE trang_thai=1";
    $result = mysqli_query($ketnoi, $sql);
    return $result;
}
function soluongban($ketnoi) {
    $sql ="SELECT SUM(so_luong) AS tong_so_san_pham
    FROM chi_tiet_don_hang
    INNER JOIN don_hang ON chi_tiet_don_hang.id_donhang = don_hang.id_don_hang
    WHERE trang_thai = 1 AND don_hang.ngay_tao_don_hang BETWEEN DATE_FORMAT(NOW() ,'%Y-%m-01') AND NOW();
    ";
    $result = mysqli_query($ketnoi, $sql);
    return $result;
}

function datadoanhso($ketnoi) {
    $sql = "SELECT DATE_FORMAT(ngay_tao_don_hang, '%d.%m') AS ngay, SUM(tong_tien) AS tong_tien 
        FROM don_hang 
        WHERE trang_thai = 1 AND ngay_tao_don_hang BETWEEN DATE_FORMAT(NOW(), '%Y-%m-01') AND NOW() 
        GROUP BY ngay";
    $result = mysqli_query($ketnoi, $sql);
    return $result;
}
function datasoluongban($ketnoi) {
    $sql = "SELECT DATE_FORMAT(ngay_tao_don_hang, '%d.%m') AS ngay, SUM(so_luong) AS tong_so_luong
    FROM chi_tiet_don_hang JOIN don_hang ON chi_tiet_don_hang.id_donhang = don_hang.id_don_hang
    WHERE trang_thai = 1 AND ngay_tao_don_hang BETWEEN DATE_FORMAT(NOW(), '%Y-%m-01') AND NOW()
    GROUP BY ngay";
    $result = mysqli_query($ketnoi, $sql);
    return $result;
}
//Hàm duyệt đơn hàng 
function DuyetDon($ketnoi,$id_don_hang) {
    $sql = "UPDATE `don_hang` SET `trang_thai`='1' WHERE id_don_hang ='$id_don_hang'";
    $result = mysqli_query($ketnoi, $sql);
    return $result;
}


?>