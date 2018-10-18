(function ($) {
    "use strict";



    /*-----Добавление в корзину методом POST простого товара-------------------*/
	
	$('.js-addcart-simple').each(function(){
		var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
			
				
		$(this).on('click', function(/*event*/){
			//event.preventDefault();
			var id = $(this).data('id');
			var count = $('#count-product').val();
			$.ajax({
 				url: '/cart/add-in-cart-simple',
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
 				url: '/cart/add-in-cart-variable',
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
	
	
	
	/*==================================================================
    [ Execute method Show modal Cart - receive html-data from CartController@actionShowModalCart.php] */
    
     //Rendering html-data content of modal Cart, received from ShopController.php
    function showCart(cart) {
        //console.log(cart);
	    $('.js-panel-cart .header-cart-content').html(cart);
	    $('.js-panel-cart').addClass('show-header-cart');
    }
    
    $('.js-show-cart').on('click',function(){
        $.ajax({
 			url: '/cart/show-modal-cart',
 				type: 'POST',
 				success: function(res) {
 			        if(!res) {
 				        alert('Ошибка!');
 			        }
 			        showCart(res);
 		        },
 				error: function() {
 					alert('Error!');
 					}
 		});
        
    });
    
    
    
    //Изменение кол-ва едениц товара при редактировании корзины методом AJAX
    $('.btn-num-product-down-incart').on('click', function(){
        var numProduct = Number($(this).next().val());
        var boxId = $(this);
        if(numProduct > 1) {
            
            numProduct--;
        }
        
        var id = $('#product_id').val();
        var varId = $('#product_variable_id').val();
        console.log(numProduct);
        $.ajax({
 		    url: '/cart/cart',
 			data: {
 			    productId: id,
 			    count: numProduct,
 			    productVarId: varId,
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
 				    $(boxId).next().val(result.productCount);
 					console.log(result.productCount);
 					
 				}
 						
 					
 			},
 			error: function() {
 				alert('Error!');
 			}
 		});
        
    });

    $('.btn-num-product-up-incart').on('click', function(){
        var boxId = $(this);
        var numProduct = Number($(boxId).prev().val());
        //$(boxId).prev().val(numProduct + 1);
        //var numProduct = Number($(boxId).prev().val());
        
        numProduct++;
        var id = $(this).parent().parent().parent().find('#product_id').val();
        var varId = $(this).parent().parent().parent().find('#product_variable_id').val();
        
        console.log(numProduct);
        $.ajax({
 		    url: '/cart/cart',
 			data: {
 			    productId: id,
 			    count: numProduct,
 			    productVarId: varId,
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
 				    $(boxId).prev().val(result.productCount);
 					console.log(result.productCount);
 					
 				}
 						
 					
 			},
 			error: function() {
 				alert('Error!');
 			}
 		});
        
    });
	
	
	
	
	//AJAX отображение модального окна продукта layouts/main.php from ProductController@actionModal
    $('.js-show-modal1').on('click',function(e){
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
 		    url: '/product/modal',
 		    data: {id: id},
 		    type: 'POST',
 		    success: function(res) {
 			    if(!res) {
 				    alert('Ошибка!');
 			    }
     			showModalProduct(res);
 		    },
 		    error: function() {
 			    alert('Error!');
 		    }
 	    });
     });
    
    
    $('.js-show-modal1').on('click',function(e){
        e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
 		    url: '/cart/cart',
 		    data: {id: id},
 		    type: 'POST',
 		    success: function(res) {
 			    if(!res) {
 				    alert('Ошибка!');
 			    }
     			showModalProduct(res);
 		    },
 		    error: function() {
 			    alert('Error!');
 		    }
 	    });
     });
	


})(jQuery);