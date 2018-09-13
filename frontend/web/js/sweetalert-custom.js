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

		/*-----Добавление в коржину методом GET простого товара-------------------*/
		
		/* 

		$('.js-addcart-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
			
				
			$(this).on('click', function(){
				var id = $(this).data('id');
				$.ajax({
 					//url: '/cart/add',
 					url: '/shop/add-in-cart-get',
 					data: {id: id},
 					type: 'GET',
 					//type: 'POST',
 					success: function(res) {
 						if(!res) {
 							alert('Ошибка!');
 						}
 						else {
 							var prevNotifyId = $('.js-show-cart').data('notify');
 							var newNotifyId = +prevNotifyId + 1;
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
		*/
		
	/*-----Добавление в корзину методом POST простого товара-------------------*/
	
	$('.js-addcart-simple').each(function(){
		var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
			
				
		$(this).on('click', function(/*event*/){
			//event.preventDefault();
			var id = $(this).data('id');
			var count = $('#count-product').val();
			$.ajax({
 				//url: '/cart/add',
 				url: '/shop/add-in-cart-simple',
 				data: {
 					product_id: id,
 					count: count,
 				},
 				type: 'POST',
 				success: function(res) {
 					if(!res) {
 						swal(nameProduct, "Ошибка добавления в корзину!", "error");
 					}
 					
 						/*
 						var prevNotifyId = $('.js-show-cart').data('notify');
 						//'+prevNotifyId' - преобразование к int
 						var newNotifyId = +prevNotifyId + 1;
 						//console.log(newNotifyId);
 						$('.js-show-cart').data('notify', newNotifyId).attr('data-notify', newNotifyId);
 						//var setNotifyId = $('.js-show-cart').data('notify');
 						//console.log(setNotifyId);
 						*/
 					var result = $.parseJSON(res);
 					if(!result.success) {
 						swal(nameProduct, "Ошибка добавления в корзину!", "error");
 					}
 					else {
 						$('.js-show-cart').data('notify', result.productsCount).attr('data-notify', result.productsCount);
 						console.log(result.productsCount);
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
	
	/*-----Добавление в корзину методом POST вариативного товара-------------------*/
	
	$('.js-addcart-variable').each(function(){
		var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
		
				
		$(this).on('click', function(/*event*/){
			//event.preventDefault();
			var id = $(this).data('id');
			var count = $('#count-product').val();
			var arrAttrValue = Array();
			/*
			$('.attr-val-block').each(function(index, value) {
				//console.log("Содержимое "+(index+1)+"-го атрибута: " + value.innerHTML);
				var currentAttr = $(value).find(".attr-val-select").data('id');
				var currentVal = $(value).find(".attr-val-select option:selected").val();
				//attrValue.push({key : currentAttr, val : currentVal});
			    arrAttrValue.push({currentAttr, currentVal});
			    
			});
			*/
			
			$('.attr-val-select').each(function(index, value) {
				var currentAttr = $(value).data('id');
				var currentVal = $(value).attr("selected", true).val();
				if(currentVal == 0) {
					swal(nameProduct, "Выберите свойства товара", "error");
					return false;
				}
				arrAttrValue.push({currentAttr, currentVal});
			    
			});
			
			/*
			if(arrAttrValue[]) {
					swal(nameProduct, "Выберите свойства товара", "error");
					return false;
				}
			*/
			var jsonAttrValue = JSON.stringify(arrAttrValue);
		
			$.ajax({
 				url: '/shop/add-in-cart-variable',
 				data: {
 					product_id: id,
 					count: count,
 					json_attr_value: jsonAttrValue,
 				},
 				type: 'POST',
 				success: function(res) {
 					if(!res) {
 						swal(nameProduct, "Ошибка добавления в корзину!", "error");
 					}
 					var result = $.parseJSON(res);
 					if(!result.success) {
 						swal(nameProduct, "Ошибка добавления в корзину!", "error");
 					}
 					else {
 						$('.js-show-cart').data('notify', result.productsCount).attr('data-notify', result.productsCount);
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