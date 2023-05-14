<?php
        function logIn($conn,$user,$pass) {
            $sql = "SELECT  * FROM `nguoi_dung` WHERE email ='$user' and mat_khau ='$pass'";
            $result =  mysqli_query($conn,$sql);
            if (!$result) {
            return die("Lỗi truy vấn: " . mysqli_error($conn));
            }else {
                return $result;
            }
        }

        function hienthiloaisanphamCha($kn ){
        $sql= "SELECT * FROM danh_muc Where danh_muc_cha is NULL and trang_thai = '1' Order by thu_tu ";
        $result=mysqli_query($kn, $sql);
        return $result;
        }
        
        function hienthiloaisanphamCon($ketnoi,$sql) {
            $result = mysqli_query($ketnoi, $sql);
            return $result;
        }

        function hienthihinhSlide($kn){
            $sql = "Select * From slide ";
            $result = mysqli_query($kn,$sql);
            return $result;
        }

        function laysoluongbangghi($kn,$id_danh_muc ) {
            $sql = "SELECT COUNT(*) AS id FROM san_pham Where id_danh_muc  ='$id_danh_muc'";
            $result = mysqli_query($kn, $sql);
            return $result;
        }
        function laySanphamSearch($kn,$keyword){
            $sql= "SELECT * FROM `san_pham` WHERE  san_pham.ten_san_pham LIKE '%$keyword%'";
            $result = mysqli_query($kn,$sql);
            return $result;
        }

        function hienthisanphamsearch($kn,$keyword,$records_per_page,$offset){
            $sql= "SELECT * FROM `san_pham` WHERE  san_pham.ten_san_pham LIKE '%$keyword%'  LIMIT $records_per_page OFFSET $offset";
            $result = mysqli_query($kn,$sql);
            return $result;
        }

        function laySanpham($kn, $id,$records_per_page,$offset){
            $sql= "SELECT * FROM `san_pham` WHERE `id_danh_muc` = '$id'LIMIT $records_per_page OFFSET $offset";
            $result = mysqli_query($kn,$sql);
            return $result;
        }
        function laySanphamlienquan($kn, $id){
            $sql= "SELECT * FROM `san_pham` WHERE `id_danh_muc` = '$id'";
            $result = mysqli_query($kn,$sql);
            return $result;
        }
        

        function laychitietsanpham($kn,$id_sp){
            $sql= "SELECT * FROM `san_pham` WHERE id = '$id_sp'";
            $result = mysqli_query($kn,$sql);
            return $result;
        }

        function laytendanhmuc($kn,$id){
            $sql= "select * from danh_muc where id='$id'";
            $result = mysqli_query($kn,$sql);
            return $result;
        }

        function layhinhchitietsanpham($kn,$id){
            $sql="SELECT * FROM `anh_san_pham`, san_pham WHERE anh_san_pham.id_san_pham= san_pham.id and anh_san_pham.id_san_pham='$id'";
            $result = mysqli_query($kn,$sql);
            return $result;
        }

        // function add_User($kn,$ho, $ten,$email,$phone, $ngaysinh, $gioitinh, $diachi,$user_name,$pass ){
        //     $sql = "INSERT INTO `nguoi_dung` (`ho`, `ten`, `email`, `so_dien_thoai`, `ngay_sinh`, `gioi_tinh`, `dia_chi`, `ten_dang_nhap`, `mat_khau`) 
        //             VALUES ($ho, $ten,$email,$phone, $ngaysinh, $gioitinh, $diachi,$user_name,$pass)";
        //             $result = mysqli_query($kn,$sql);
        //             return $result;
        // }

        function checkTaikhoan($kn,$email){
            $sql = "SELECT * FROM nguoi_dung WHERE email='$email'";
            $result = mysqli_query($kn,$sql);
            return $result;
        }
        function themdulieuUser($kn,$ho,$ten,$email,$sodienthoai,$ngaysinh,$gioitinh,$diachi,$matkhau){
            $sql = "INSERT INTO nguoi_dung (ho, ten, email, so_dien_thoai, ngay_sinh, gioi_tinh, dia_chi, mat_khau) VALUES ('$ho', '$ten', '$email', '$sodienthoai', '$ngaysinh', '$gioitinh', '$diachi', '$matkhau')";
            $result = mysqli_query($kn,$sql);
            return $result;
        }

        // Hàm lấy thông tin người dùng 
        function laythongtinUser($kn,$id_nguoi_dung) {
            $sql ="SELECT * FROM `nguoi_dung` WHERE id_nguoi_dung ='$id_nguoi_dung'";
            $result = mysqli_query($kn,$sql);
            return $result;
        }

        //Hàm tạo đơn hàng 
        function TaoMaDonHang($id_nguoi_dung) {
            $prefix = "DH";
            $suffix = substr(md5(mt_rand()), 0, 6);
            return $prefix . $suffix.$id_nguoi_dung;
        }
        function TaoDonHang($kn,$id_nguoi_dung,$ma_don_hang,$tong_tien,$phuong_thuc_thanh_toan) {
            $sql = "INSERT INTO `don_hang`(`id_nguoi_dung`, `ma_don_hang`, `tong_tien`, `phuong_thuc_thanh_toan`) VALUES ('$id_nguoi_dung','$ma_don_hang','$tong_tien','$phuong_thuc_thanh_toan')";
            $result = mysqli_query($kn,$sql);
            return $result;
        }
        function ThemChiTietDonHang($kn,$id_don_hang,$id_san_pham,$size,$so_luong) {
            $sql ="INSERT INTO `chi_tiet_don_hang`(`id_donhang`, `id_san_pham`, `size`, `so_luong`) VALUES ('$id_don_hang','$id_san_pham','$size','$so_luong')";
            $result = mysqli_query($kn,$sql);
            return $result;
        }

        //Hàm lấy dữ liệu đơn hàng
        function laychitietdonhang($kn,$ma_don_hang) {
            $sql ="SELECT don_hang.*,chi_tiet_don_hang.*,san_pham.* 
            FROM don_hang,chi_tiet_don_hang,san_pham 
            WHERE 
            don_hang.id_don_hang=chi_tiet_don_hang.id_donhang AND 
            
            san_pham.id = chi_tiet_don_hang.id_san_pham AND 
            don_hang.ma_don_hang ='$ma_don_hang'";
            $result = mysqli_query($kn,$sql);
            return $result;
        }

        //Lấy đơn hàng theo id người đùng 
        function layDonHang($kn,$id_nguoi_dung) {
            $sql ="SELECT * FROM `don_hang` WHERE id_nguoi_dung ='$id_nguoi_dung'";
            $result = mysqli_query($kn,$sql);
            return $result;
        }
        //Lấy đơn hàng theo mã đơn hàng
        function layDonHangMDH($kn,$ma_don_hang) {
            $sql ="SELECT * FROM `don_hang` WHERE ma_don_hang ='$ma_don_hang'";
            $result = mysqli_query($kn,$sql);
            return $result;
        }

        // huỷ đơn
        function HuyDon($ketnoi,$ma_don_hang) {
            $sql = "UPDATE `don_hang` SET `trang_thai`='2' WHERE ma_don_hang ='$ma_don_hang'";
            $result = mysqli_query($ketnoi, $sql);
            return $result;
        }
        //lấy đơn hàng mới nhất
        function Laydonhangmoinhat($kn){
            $sql="SELECT * FROM don_hang ORDER BY id_don_hang DESC LIMIT 1";
            $result = mysqli_query($kn,$sql);
            return $result;
        }


        // lấy chi tiết đơn hàng
        function chitietdonhang($ketnoi,$ma_don_hang){
            $sql ="SELECT  chi_tiet_don_hang.*,san_pham.*,don_hang.*
            FROM chi_tiet_don_hang,san_pham,don_hang
            WHERE san_pham.id = chi_tiet_don_hang.id_san_pham AND chi_tiet_don_hang.id_donhang = don_hang.id_don_hang AND don_hang.ma_don_hang ='$ma_don_hang'";
            $result = mysqli_query($ketnoi, $sql);
            return $result;
        }



?> 

