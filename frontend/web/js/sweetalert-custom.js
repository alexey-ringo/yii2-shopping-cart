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
			var id = $(this).data('id');
				
			$(this).on('click', function(){
				$.ajax({
 					url: '/cart/add',
 					data: {id: id},
 					type: 'GET',
 					success: function(res) {
 						if(!res) {
 							alert('Ошибка!');
 						}
 						else {
 							console.log(res);
 							swal(nameProduct, "is added to cart !", "success");
 						}
 					},
 					error: function() {
 						alert('Error!');
 					}
 				});
			//	swal(nameProduct, "is added to cart !", "success");
			});
		});