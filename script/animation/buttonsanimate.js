let search = document.querySelector('.search-button__search');
let search_button = document.querySelector('.Search');
search_button.addEventListener('click', ()=>{
    switch (search.classList.contains('hidden')) {
        case true:
            search.classList.remove('hidden');
            search_list.classList.remove('hidden');
            break;
        case false:
            search.classList.add('hidden');
            search_list.classList.add('hidden');
            break;
    }
});

if (document.querySelector('.User')) {
    document.querySelector('.User').addEventListener('click',()=>{
        window.location.href = '/pages/menus/auth.php';
    });
}
else{
    document.querySelector('.user_link').addEventListener('click',()=>{
        window.location.href = '/pages/menus/auth.php';
    });
}

document.querySelector('.ShoppingCart').addEventListener('click',()=>{
    window.location.href = '/pages/menus/cart.php';
});

if(document.URL.indexOf("/pages/menus/registration.php") >= 0){ 
    $(".reg__phone").mask("+7 (999) 999-99-99");

    let email = document.querySelector('.reg__email');
    let result = document.querySelector("#reg2"); 
    let url = '/assets/email_qual.php';
    let formData = new FormData();
    var flag = 0;

    email.addEventListener("change", () => {
        if (email.value !="") {
            formData.append('email', email.value);
            fetch(url, { method: 'POST', body: formData })
            .then(function (response) {
                return response.text();
            })
            .then(function (body) {

                    if (body.includes('@')) {
                        $('#reg2').removeClass('red-height');
                        $('#reg2').removeClass('hidden');
                        $('#reg2').addClass('green');
                        result.innerHTML = body;
                        result.innerHTML = '';
                        flag = 0;
                    }
                    else{
                        if (body == 'E-mail занят') {
                            $('#reg2').removeClass('green');
                            $('#reg2').removeClass('hidden');
                            $('#reg2').addClass('red-height');
                            result.innerHTML = body; 
                            flag =1;
                        }
                        else{
                            $('#reg2').removeClass('green');
                            $('#reg2').removeClass('hidden');
                            $('#reg2').addClass('red-height');
                            result.innerHTML = body;
                            result.innerHTML = '';
                            flag = 0;
                        } 
                    }       
            });
        }
        else{
            result.innerHTML = "";
        }
    });  
}
if(document.URL.indexOf("/pages/menus/cart.php") >= 0){
    let url_cart = '/assets/delete_cart.php';
    let delet = document.querySelectorAll('.cart__delete-back');
    delet.forEach(element => {
        element.addEventListener('click',()=>{
            formData.append('array', element.attributes.name.value);
            fetch(url_cart, { method: 'POST', body: formData })
            .then(function (response) {
                return response.text();
            })
            .then(function (body) {
                window.location.href = '/pages/menus/cart.php';
            }); 
        });    
    });
}


function checkPhone(){
    if ( !($('.reg__phone').val().indexOf("_") != -1) || $('.reg__phone').val() == '' ) {
		$('#reg3').addClass('hidden');
	} else {
		$('#reg3').removeClass('hidden');
	}
}
function checkPass(){
    let pass = 0;
    if ($('.reg__pass').val().length >= 8 && $('.reg__pass').val().length <= 16) {
        $('#reg4').addClass('hidden');
        pass = $('.reg__pass').val();
	} else if (!$('.reg__pass').val().length <= 8 || $('.reg__pass').val().length >= 16){
        $('#reg4').removeClass('hidden');
	}
    if ($('.reg__repass').val() == pass) {
        $('#reg5').addClass('hidden');
    } else{
        $('#reg5').removeClass('hidden');
    }
    if ($('.reg__pass').val().length >= 8 && 
        $('.reg__pass').val().length <= 16 && 
        $('.reg__repass').val() == pass
    ) {
        return 1;
    }
    else{
        return 0;
    }
}
function checkReg(){
    if ($('.reg__email').val().includes('@')) {
		$('#reg2').addClass('hidden');
        $('#reg2').addClass('green');
	} else {
		$('#reg2').removeClass('hidden');
        $('#reg2').removeClass('green');
	}
	if (!$('.reg__fio').val() == '') {
		$('#reg1').addClass('hidden');
	} else {
		$('#reg1').removeClass('hidden');
	}
    if( $('.reg__fio') != '' && 
        flag == 0 && 
        $('.reg__phone').val().length == 18 
        ) 
    {
        return 1;
    } 
    else {
        return 0;
    }
}
function checkAll(){
let a = checkReg() + checkPass();
if(a == 2)
    {
        $('.reg__button').removeAttr('disabled');
        $('.reg__button').removeClass('disable');
    } 
    else {
        $('.reg__button').attr('disabled', 'disabled');
        $('.reg__button').addClass('disable');
    } 
}
