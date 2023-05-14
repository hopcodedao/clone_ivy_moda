// Show cart action 

const iconCart = document.querySelector('.item-cart .icon');
const cartClose = document.querySelector('.action-close');
const cartContainer = document.querySelector('.cart-action');
iconCart.addEventListener('click', function() {
    cartContainer.classList.add('active');
});
cartClose.addEventListener('click', function() {
    cartContainer.classList.remove('active');

});


//thay đổi ảnh khi click 
const bigImg = document.querySelector(".product-content-left-big-img img")
const smallImg = document.querySelectorAll(".product-content-left-small-img img")
smallImg.forEach(function(imgItem, X) {
    imgItem.addEventListener("click", function() {
        bigImg.src = imgItem.src
    })
})

//size chi tiết sản phẩm 

var size_radios = document.querySelectorAll('.size_radio');
var selected = null;
size_radios.forEach(function(item) {
    item.addEventListener('click', function() {
        if (selected) {
            selected.classList.remove('active_border');
        }
        this.classList.add('active_border')
        selected = this;
    });
    item.addEventListener("dblclick", function() {
        this.style.border = "none";
    });
});

const plusButtons = document.querySelectorAll('.cart-number-plus');
const minusButtons = document.querySelectorAll('.cart-number-minus');
const valueNumbers = document.querySelectorAll('.cart-number input');

for (let i = 0; i < plusButtons.length; i++) {
    minusButtons[i].onclick = function() {
        const a = new Number(valueNumbers[i].value)
        if (a > 1) {
            valueNumbers[i].value = a - 1;
        }
    }

    plusButtons[i].onclick = function() {
        const b = new Number(valueNumbers[i].value)
        valueNumbers[i].value = b + 1;
    }
}

const cartPlus = document.querySelectorAll('.price-quantity-plus');
const cartMinus = document.querySelectorAll('.price-quantity-minus');
const valueNumbercart = document.querySelectorAll('.info-price-quantity input');
for (let i = 0; i < cartPlus.length; i++) {
    cartMinus[i].onclick = function() {
        const a = new Number(valueNumbercart[i].value)
        if (a > 1) {
            valueNumbercart[i].value = a - 1;
        }
    }

    cartPlus[i].onclick = function() {
        const b = new Number(valueNumbercart[i].value)
        valueNumbercart[i].value = b + 1;
    }
}


//Show Help 
const headphones = document.querySelector('.item-headphone');
const subHelp = document.querySelector('.sub-action');
headphones.addEventListener('click', function() {
    subHelp.classList.toggle('activeSubhelp')
})

//border-bottom

const baoquan = document.querySelector(".baoquan")
const chitiet = document.querySelector(".chitiet")
const gioithieu = document.querySelector(".gioithieu")
if (gioithieu) {
    gioithieu.addEventListener("click", function() {
        document.querySelector(".product-content-right-btn-content-chitiet").style.display = "none"
        document.querySelector(".product-content-right-btn-content-baoquan").style.display = "none"
        document.querySelector(".product-content-right-btn-content-gioithieu").style.display = "block"
    })
}
if (baoquan) {
    baoquan.addEventListener("click", function() {
        document.querySelector(".product-content-right-btn-content-chitiet").style.display = "none"
        document.querySelector(".product-content-right-btn-content-baoquan").style.display = "block"
        document.querySelector(".product-content-right-btn-content-gioithieu").style.display = "none"

    })
}
if (chitiet) {
    chitiet.addEventListener("click", function() {
        document.querySelector(".product-content-right-btn-content-chitiet").style.display = "block"
        document.querySelector(".product-content-right-btn-content-baoquan").style.display = "none"
        document.querySelector(".product-content-right-btn-content-gioithieu").style.display = "none"
    })
}






const butTon = document.querySelector(".product-content-right-btn-top")
if (butTon) {
    butTon.addEventListener("click", function() {
        document.querySelector(".product-content-right-btn-content-big").classList.toggle("activeB")
    })
}


//bắt sự kiện ô input search 
function validateForm() {
    var input = document.getElementById("search").value;
    if (input == "") {
        emptySearch();
      return false;
    }
    return true;
  }