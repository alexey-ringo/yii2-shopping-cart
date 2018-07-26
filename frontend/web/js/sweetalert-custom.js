$('.js-addwish-b2, .js-addwish-detail').on('click', function(e){
			e.preventDefault();
		});

		$('.js-addwish-b2').each(function(){
			var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-b2');
				$(this).off('click');
			});
		});

		$('.js-addwish-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-detail');
				$(this).off('click');
			});
		});

		/*---------------------------------------------*/

		$('.js-addcart-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
			
				
			$(this).on('click', function(){
				var id = $(this).data('id');
				$.ajax({
 					url: '/cart/add',
 					data: {id: id},
 					type: 'GET',
 					success: function(res) {
 						if(!res) {
 							alert('Ошибка!');
 						}
 						else {
 							var prevNotifyId = $('.js-show-cart').data('notify');
 							var newNotifyId = prevNotifyId + 1;
 							//console.log(newNotifyId);
 							$('.js-show-cart').data('notify', newNotifyId).attr('data-notify', newNotifyId);
 							//var setNotifyId = $('.js-show-cart').data('notify');
 							//console.log(setNotifyId);
 							swal(nameProduct, "добавлено в корзину!", "success");
 							
 						}
 					},
 					error: function() {
 						alert('Error!');
 					}
 				});
			//	swal(nameProduct, "is added to cart !", "success");
			});
		});