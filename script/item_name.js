let minus = document.querySelector('.amount-block__change-minus');
let plus = document.querySelector('.amount-block__change-plus');
let amount = document.querySelector('.amount-block__typing');

$("#phone").mask("+7 (999) 999-99-99");


function checkParams() {
    let fio = $('.fio-not-null').val();
    let email = $('.email-not-null').val();
    let phone = $('.phone-not-null').val();
	let pmc = $('#phone');

	if ( (pmc.val().indexOf("_") != -1) || pmc.val() == '' ) {
		pmc.addClass('empty_field');
	} else {
		pmc.removeClass('empty_field');
	}
	if (fio.length == 0) {
		$('.fio-not-null').addClass('empty_field');
	} else {
		$('.fio-not-null').removeClass('empty_field');
	}
	if (!email.includes('@')) {
		$('.email-not-null').addClass('empty_field');
	} else {
		$('.email-not-null').removeClass('empty_field');
	}
	if ($('.address-not-null').val().length == 0) {
		$('.address-not-null').addClass('empty_field');
	} else {
		$('.address-not-null').removeClass('empty_field');
	}

    if(fio.length != 0 && email.includes('@') && phone.length == 18 && $('.address-not-null').val().length != 0) {
        $('.submit-order').removeAttr('disabled');
		$('.submit-order').removeClass('disable');
    } else {
        $('.submit-order').attr('disabled', 'disabled');
		$('.submit-order').addClass('disable');
    }
}
if (amount.value!='') {
	minus.addEventListener('click', ()=>{
		if (amount.value<2) {
			amount.value=1;
		}
		else{
			amount.value--;
		}
	}); 
	plus.addEventListener('click', ()=>{
		
		if (amount.value!=amount.name) {
			amount.value++;
		}
	});
}
$(document).ready(function($) {
	$('.amount-block__buy').click(function() {
		$('.popup-fade').fadeIn();
		return false;
	});	
	
	$('.popup-close').click(function() {
		$(this).parents('.popup-fade').fadeOut();
		return false;
	});		
 
	$(document).keydown(function(e) {
		if (e.keyCode === 27) {
			e.stopPropagation();
			$('.popup-fade').fadeOut();
		}
	});
	
	$('.popup-fade').click(function(e) {
		if ($(e.target).closest('.popup').length == 0) {
			$(this).fadeOut();					
		}
	});
});


document.querySelector('.amount-block__add-cart').addEventListener('click',()=>{
	let url = '/assets/add_cart.php';
	let count = document.querySelector('.amount-block__typing').value;	
	let id = document.querySelector('.amount-block__add-cart').name;
	formData.set('good_id', id);
	fetch(url, { method: 'POST', body: formData })
	.then(function (response) {
		return response.text();
	})
	.then(function (body) {
		document.querySelector('.amount-block__add-cart').value = 'В корзине'; 
		document.querySelector('.amount-block__add-cart').classList.add('cart__green');  
	});

	formData.set('count', count);
	fetch(url, { method: 'POST', body: formData })
	.then(function (response) {
		return response.text();
	})
	.then(function (body) {
		document.querySelector('.amount-block__typing').classList.add('hide');
		document.querySelector('.amount-block__change-plus').classList.add('hide');      
		document.querySelector('.amount-block__change-minus').classList.add('hide');   
	});	

},{once : true});



