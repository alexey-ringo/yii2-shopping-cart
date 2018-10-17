
(function ($) {
    "use strict";

    /*[ Load page ]
    ===========================================================*/
    $(".animsition").animsition({
        inClass: 'fade-in',
        outClass: 'fade-out',
        inDuration: 1500,
        outDuration: 800,
        linkElement: '.animsition-link',
        loading: true,
        loadingParentElement: 'html',
        loadingClass: 'animsition-loading-1',
        loadingInner: '<div class="loader05"></div>',
        timeout: false,
        timeoutCountdown: 5000,
        onLoadEvent: true,
        browser: [ 'animation-duration', '-webkit-animation-duration'],
        overlay : false,
        overlayClass : 'animsition-overlay-slide',
        overlayParentElement : 'html',
        transition: function(url){ window.location.href = url; }
    });
    
    /*[ Back to top ]
    ===========================================================*/
    var windowH = $(window).height()/2;

    $(window).on('scroll',function(){
        if ($(this).scrollTop() > windowH) {
            $("#myBtn").css('display','flex');
        } else {
            $("#myBtn").css('display','none');
        }
    });

    $('#myBtn').on("click", function(){
        $('html, body').animate({scrollTop: 0}, 300);
    });


    /*==================================================================
    [ Fixed Header ]*/
    var headerDesktop = $('.container-menu-desktop');
    var wrapMenu = $('.wrap-menu-desktop');

    if($('.top-bar').length > 0) {
        var posWrapHeader = $('.top-bar').height();
    }
    else {
        var posWrapHeader = 0;
    }
    

    if($(window).scrollTop() > posWrapHeader) {
        $(headerDesktop).addClass('fix-menu-desktop');
        $(wrapMenu).css('top',0); 
    }  
    else {
        $(headerDesktop).removeClass('fix-menu-desktop');
        $(wrapMenu).css('top',posWrapHeader - $(this).scrollTop()); 
    }

    $(window).on('scroll',function(){
        if($(this).scrollTop() > posWrapHeader) {
            $(headerDesktop).addClass('fix-menu-desktop');
            $(wrapMenu).css('top',0); 
        }  
        else {
            $(headerDesktop).removeClass('fix-menu-desktop');
            $(wrapMenu).css('top',posWrapHeader - $(this).scrollTop()); 
        } 
    });


    /*==================================================================
    [ Menu mobile ]*/
    $('.btn-show-menu-mobile').on('click', function(){
        $(this).toggleClass('is-active');
        $('.menu-mobile').slideToggle();
    });

    var arrowMainMenu = $('.arrow-main-menu-m');

    for(var i=0; i<arrowMainMenu.length; i++){
        $(arrowMainMenu[i]).on('click', function(){
            $(this).parent().find('.sub-menu-m').slideToggle();
            $(this).toggleClass('turn-arrow-main-menu-m');
        })
    }

    $(window).resize(function(){
        if($(window).width() >= 992){
            if($('.menu-mobile').css('display') == 'block') {
                $('.menu-mobile').css('display','none');
                $('.btn-show-menu-mobile').toggleClass('is-active');
            }

            $('.sub-menu-m').each(function(){
                if($(this).css('display') == 'block') { console.log('hello');
                    $(this).css('display','none');
                    $(arrowMainMenu).removeClass('turn-arrow-main-menu-m');
                }
            });
                
        }
    });


    /*==================================================================
    [ Show / hide modal search ]*/
    $('.js-show-modal-search').on('click', function(){
        $('.modal-search-header').addClass('show-modal-search');
        $(this).css('opacity','0');
    });

    $('.js-hide-modal-search').on('click', function(){
        $('.modal-search-header').removeClass('show-modal-search');
        $('.js-show-modal-search').css('opacity','1');
    });

    $('.container-search-header').on('click', function(e){
        e.stopPropagation();
    });


    /*==================================================================
    [ Isotope ]*/
    var $topeContainer = $('.isotope-grid');
    var $filter = $('.filter-tope-group');

    // filter items on button click
    $filter.each(function () {
        $filter.on('click', 'button', function () {
            var filterValue = $(this).attr('data-filter');
            $topeContainer.isotope({filter: filterValue});
        });
        
    });

    // init Isotope
    $(window).on('load', function () {
        var $grid = $topeContainer.each(function () {
            $(this).isotope({
                itemSelector: '.isotope-item',
                layoutMode: 'fitRows',
                percentPosition: true,
                animationEngine : 'best-available',
                masonry: {
                    columnWidth: '.isotope-item'
                }
            });
        });
    });

    var isotopeButton = $('.filter-tope-group button');

    $(isotopeButton).each(function(){
        $(this).on('click', function(){
            for(var i=0; i<isotopeButton.length; i++) {
                $(isotopeButton[i]).removeClass('how-active1');
            }

            $(this).addClass('how-active1');
        });
    });

    /*==================================================================
    [ Filter / Search product ]*/
    $('.js-show-filter').on('click',function(){
        $(this).toggleClass('show-filter');
        $('.panel-filter').slideToggle(400);

        if($('.js-show-search').hasClass('show-search')) {
            $('.js-show-search').removeClass('show-search');
            $('.panel-search').slideUp(400);
        }    
    });

    $('.js-show-search').on('click',function(){
        $(this).toggleClass('show-search');
        $('.panel-search').slideToggle(400);

        if($('.js-show-filter').hasClass('show-filter')) {
            $('.js-show-filter').removeClass('show-filter');
            $('.panel-filter').slideUp(400);
        }    
    });




    /*==================================================================
    [ Execute method Show modal Cart - Old version ]
    $('.js-show-cart').on('click',function(){
        $.ajax({
 			url: '/cart/show',
 				type: 'GET',
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
    */
    
    /*==================================================================
    [ Execute method Show modal Cart - receive html-data from ShopController@actionShowModalCart.php] */
    $('.js-show-cart').on('click',function(){
        $.ajax({
 			url: '/shop/show-modal-cart',
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
    

    //Rendering html-data content of modal Cart, received from ShopController.php
    function showCart(cart) {
        //console.log(cart);
	    $('.js-panel-cart .header-cart-content').html(cart);
	    $('.js-panel-cart').addClass('show-header-cart');
    }

    $('.js-hide-cart').on('click',function(){
        $('.js-panel-cart').removeClass('show-header-cart');
    });

    /*==================================================================
    [ Cart ]*/
    $('.js-show-sidebar').on('click',function(){
        $('.js-sidebar').addClass('show-sidebar');
    });

    $('.js-hide-sidebar').on('click',function(){
        $('.js-sidebar').removeClass('show-sidebar');
    });

    /*==================================================================
    [ +/- num product ]*/
    $('.btn-num-product-down').on('click', function(){
        var numProduct = Number($(this).next().val());
        if(numProduct > 0) $(this).next().val(numProduct - 1);
    });
    
    
    $('.btn-num-product-up').on('click', function(){
        var numProduct = Number($(this).prev().val());
        $(this).prev().val(numProduct + 1);
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
 		    url: '/shop/cart',
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
 		    url: '/shop/cart',
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

    /*==================================================================
    [ Rating ]*/
    $('.wrap-rating').each(function(){
        var item = $(this).find('.item-rating');
        var rated = -1;
        var input = $(this).find('input');
        $(input).val(0);

        $(item).on('mouseenter', function(){
            var index = item.index(this);
            var i = 0;
            for(i=0; i<=index; i++) {
                $(item[i]).removeClass('zmdi-star-outline');
                $(item[i]).addClass('zmdi-star');
            }

            for(var j=i; j<item.length; j++) {
                $(item[j]).addClass('zmdi-star-outline');
                $(item[j]).removeClass('zmdi-star');
            }
        });

        $(item).on('click', function(){
            var index = item.index(this);
            rated = index;
            $(input).val(index+1);
        });

        $(this).on('mouseleave', function(){
            var i = 0;
            for(i=0; i<=rated; i++) {
                $(item[i]).removeClass('zmdi-star-outline');
                $(item[i]).addClass('zmdi-star');
            }

            for(var j=i; j<item.length; j++) {
                $(item[j]).addClass('zmdi-star-outline');
                $(item[j]).removeClass('zmdi-star');
            }
        });
    });
    
    /*==================================================================
    [ default Show modal1 ]*/
    //$('.js-show-modal1').on('click',function(e){
    //    e.preventDefault();
    //    $('.js-modal1').addClass('show-modal1');
    //});

    $('.js-hide-modal1').on('click',function(){
        $('.js-modal1').removeClass('show-modal1');
    });
    
    /*==================================================================
    [ Show native modal product-view - layouts/main.php from ProductController@actionModal ]*/
    function showModalProduct(product) {
        //console.log(product);
        $('.mtext-105').text(product['product']['name']);
        $('.mtext-106').text(product['product']['price']);
        $('.stext-102').text(product['product']['content']);
        $("#modal-product-img1").attr("src", "/custom_img/default/" + product['images']['img1']);
        $("#modal-product-img2").attr("src", "/custom_img/default/" + product['images']['img2']);
        $("#modal-product-img3").attr("src", "/custom_img/default/" + product['images']['img3']);
        $('.js-modal1').addClass('show-modal1');
    }
    
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
 		    url: '/shop/cart',
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
    
    
    /*==================================================================
    [ Show yii2-widget modal product-view  ]*/
    
    //Show modal Product
    /*
    function showProduct(product) {
	    $('#modal-product-view .modal-body').html(product);
	    $('#modal-product-view').modal();
	    
    }
    */
    
    //AJAX show modal product-view
    /*
    $('.js-show-product-modal').on('click', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
 	    $.ajax({
 		    url: '/product/view-modal',
 		    data: {id: id},
 		    type: 'GET',
 		    success: function(res) {
 			    if(!res) {
 				    alert('Ошибка!');
 			    }
     			
 			    showProduct(res);
 		    },
 		    error: function() {
 			    alert('Error!');
 		    }
 	    });
 	
    });
    */


})(jQuery);