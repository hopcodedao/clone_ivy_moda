// Notification 

function toast ({title = '', message = '',type = 'info',duration = 3000}){
    const main =document.getElementById('toast')

    if(main){
        const toast = document.createElement('div');
        //auto xoá toast
       autoRemoveId = setTimeout(function(){
            main.removeChild(toast);
        },duration + 1000);

        toast.onclick = function(e){
            if(e.target.closest('.toast__close')){
                main.removeChild(toast);
               clearTimeout(autoRemoveId)
            }

        }
        const icons = {
            success:'fa-solid fa-circle-check',
            info:'fa-solid fa-circle-info></i>',
            warning:'fa-solid fa-circle-exclamation',
            error:'fa-solid fa-circle-exclamation',      
        }
        const icon = icons[type];
        const delay = (duration/1000)
        toast.classList.add('toast',`toast--${type}`)
        toast.style.animation = `slideInLeft 0.5s ease ,fadeOut 1s ${delay}s linear forwards`;
        toast.innerHTML = `
        <div class="toast__icon">
            <i class="${icon}"></i>
        </div>
        <div class="toast__body">
            <h3 class="toast__title">${title}</h3>
            <p class="toast__msg">${message}</p>
        </div>
        <div class="toast__close">
            <i class="fa-solid fa-xmark"></i>
        </div> `;
        main.appendChild(toast)
        
    }
}

//Đăng kí thành công
 function ShowSuccessToast(){
    toast({
            message:'Đăng kí tài khoản thành công !',
            type:'success',
            duration:2000
        })
 }
//Mật khẩu không khớp
 function ShowErrorToast(){
    toast({
            message:'Mật khẩu đã nhập không khớp. Hãy thử lại.',
            type:'error',
            duration:3000
        })
 }
//  Email đã tồn tại 
 function ShowErrorToast_Email(){
    toast({
            message:'Email đã tồn tại trong hệ thống',
            type:'error',
            duration:3000
        })
 }
//Email hoặc mật khẩu không được để trống
function ShowErrorToast_empty_email(){
    toast({
            message:'Email hoặc mật khẩu không được để trống',
            type:'error',
            duration:3000
        })
 }

 //Đăng nhập không thành công
 function Login_failed(){
    toast({
            message:'Đăng nhập không thành công',
            type:'error',
            duration:3000
        })
 }
//  vui lòng nhập từ khoá tìm kiếm 
 function emptySearch(){
    toast({
            message:'Vui lòng nhập từ khoá tìm kiếm',
            type:'error',
            duration:3000
        })
 }
 //Thêm thành công 
 function themthanhcong(){
    toast({
            message:'Thêm thành công !',
            type:'success',
            duration:2000
        })
 }

 //Đặt hàng thành coogn 
 function dathangthanhcong(){
    toast({
            message:'Đặt hàng thành công có thể xem chi tiết tại phần thông tin  !',
            type:'success',
            duration:2000
        })
 }
