

document.querySelector('#logo').addEventListener('click', ()=>{
    window.location.href = '/index.php';
});

$('body').on('input', '.filter-price__input', function(){

	var value = this.value.replace(/[^0-9]/g, '');

	if (value < $(this).data('min')) {

		this.value = $(this).data('min');

	} else if (value > $(this).data('max')) {

		this.value = $(this).data('max');

	} else {

		this.value = value;

	}

});

