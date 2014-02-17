$(document).ready(function() {
	updateCart();
	miniShop2.Callbacks.Cart.add.response.success = function(response) {
		updateCart();
	}
	miniShop2.Callbacks.Cart.remove.response.success = function(response) {
		updateCart();
	}
});

function updateCart(){
	var $container = $('.js-goods');
	
	$.ajax({
		type: 'POST',
		cache: false,
		dataType: 'json',
		url: document.location.href,
		data: {'actionAjax':'updateCart'},
		success: function(data){                 
			console.log(data);
			if(data.data != ''){
				$container.html(data.data);
			}			
		},
		error: function(jqXHR, textStatus, errorThrown){
			if(typeof(console)!='undefined') console.log(textStatus+' '+errorThrown);
		}
	});
}