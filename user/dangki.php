



        <div class="register-content">
            <div class="rigister-title">ĐĂNG KÝ</div>
            <form action="" method="POST" class="rigister-form">
                <div class="register-form-left">
                    <div class="register-form-left-title">Thông tin khách hàng</div>
                    <div class="register-form-left-content">
                        <div class="register-form-left-content-row">
                            <div class="register-form-left-content-row-item">
                                <label for="">Họ: <span style="color:red">*</span></label>
                                <input required  name="ho" placeholder="Họ..." type="text">
                            </div>
                            <div class="register-form-left-content-row-item">
                                <label for="">Tên: <span style="color:red">*</span></label>
                                <input required name="ten" placeholder="Tên..." type="text">
                            </div>
                        </div>
                        <div class="register-form-left-content-row">
                            <div class="register-form-left-content-row-item">
                                <label for="">Email: <span style="color:red">*</span></label>
                                <input required name="email" placeholder="Email..." type="email">
                            </div>
                            <div class="register-form-left-content-row-item">
                                <label for="">Điện thoại: <span style="color:red">*</span></label>
                                <input required name="sodienthoai" placeholder="Điện thoại..." type="text">
                            </div>
                        </div>
                        <div class="register-form-left-content-row">
                            <div class="register-form-left-content-row-item">
                                <label for="">Ngày sinh: <span style="color:red">*</span></label>
                                <input required name="ngaysinh" placeholder="Ngày sinh..." type="date">
                            </div>
                            <div class="register-form-left-content-row-item">
                                <label for="">Giới tính: <span style="color:red">*</span></label>
                                <select name="gioitinh" id="">
                                    <option value="0">Nam</option>
                                    <option value="1">Nữ</option>
                                </select>
                            </div>
                        </div>
                        <div class="register-form-left-content-row">
                            <div class="register-form-left-content-row-item">
                                <label for="">Tỉnh/TP: <span style="color:red">*</span></label>
                                <select name="city" id="city">
                                    <option  value="" selected>Chọn tỉnh thành</option>           
                                </select>
                            </div>
                            <div class="register-form-left-content-row-item">
                                <label for="">Quận/Huyện: <span style="color:red">*</span></label>
                                <select name="district" id="district">
                                    <option value="" selected>Chọn quận huyện</option>
                                </select>
                            </div>
                            
                        </div>
                        <div class="register-form-left-content-row">
                            <div class="register-form-left-content-row-item">
                                <label for="">Phường/Xã: <span style="color:red">*</span></label>
                                <select name="ward" id="ward">
                                    <option value="" selected>Chọn phường xã</option>
                                </select>
                            </div>
                            
                        </div>
                        <div class="register-form-left-content-row">
                            <div class="register-form-left-content-row-item">
                                <label  for="">Địa chỉ: <span style="color:red">*</span></label>
                                <textarea name="diachi"></textarea>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="register-form-right">
                    <div class="register-form-right-title">Thông tin mật khẩu</div>
                    <div class="register-form-right-content">
                        <div class="register-form-left-content-row">
                            <div class="register-form-left-content-row-item">
                                <label for="">Mật khẩu: <span style="color:red">*</span></label>
                                <input name="password" placeholder="Mật khẩu..." type="password">
                            </div>
                        </div>
                        <div class="register-form-left-content-row">
                            <div class="register-form-left-content-row-item">
                                <label for="">Nhập lại mật khẩu: <span style="color:red">*</span></label>
                                <input name="nhaplai" placeholder="Nhập lại mật khẩu..." type="password">
                            </div>
                            
                        </div>
                        <!-- <input id="result" value="" type="hidden"> -->
                        <div class="register-form-left-content-row">
                            <button name="dangki" type="submit" class="btn">Đăng kí</button>
                        </div>
                    </div>
                </div>
            </form>
            
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script>
    const host = "https://provinces.open-api.vn/api/";
    var callAPI = (api) => {
        return axios.get(api)
        .then((response) => {
            renderData(response.data, "city");
        });
    }
    callAPI('https://provinces.open-api.vn/api/?depth=1');
    var callApiDistrict = (api) => {
        return axios.get(api)
            .then((response) => {
                renderData(response.data.districts, "district");
            });
    }
    var callApiWard = (api) => {
        return axios.get(api)
            .then((response) => {
                renderData(response.data.wards, "ward");
            });
    }

    var renderData = (array, select) => {
        let row = ' <option disable value="">Chọn</option>';
        array.forEach(element => {
            row += `<option data-id="${element.code}" value="${element.name}">${element.name}</option>`
        });
        document.querySelector("#" + select).innerHTML = row
    }

    $("#city").change(() => {
        callApiDistrict(host + "p/" + $("#city").find(':selected').data('id') + "?depth=2");
        printResult();
    });
    $("#district").change(() => {
        callApiWard(host + "d/" + $("#district").find(':selected').data('id') + "?depth=2");
        printResult();
    });
    $("#ward").change(() => {
        printResult();
    })

var printResult = () => {
    if ($("#district").find(':selected').data('id') != "" && $("#city").find(':selected').data('id') != "" &&
        $("#ward").find(':selected').data('id') != "") {
        let result = $("#city option:selected").text() +
            " | " + $("#district option:selected").text() + " | " +
            $("#ward option:selected").text();
    }

}
	</script>
<?php 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST['dangki'])) {
                $result = checkTaikhoan($conn,$_POST['email']);
                if(mysqli_num_rows($result) > 0) {
                    echo "<script>ShowErrorToast_Email()</script>";
                }else {
                    if($_POST['password'] != $_POST['nhaplai']){
                        echo "<script>ShowErrorToast()</script>";
                    }else {
                        $diachi = $_POST['city'].', '.$_POST['district'].', '.$_POST['ward'].', '.$_POST['diachi'];
                        
                        themdulieuUser($conn,$_POST['ho'],$_POST['ten'],$_POST['email'],$_POST['sodienthoai'],$_POST['ngaysinh'],$_POST['gioitinh'],$diachi,md5($_POST['password']));
                        if(mysqli_affected_rows($conn)>0) {
                            echo "<script>ShowSuccessToast()</script>";
                        }
                    }   
                }
            }
         }
    ?>


