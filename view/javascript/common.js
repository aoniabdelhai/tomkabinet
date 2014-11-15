$(document).ready(function() {
	
	/* Search */
	/*
        $('.button-search').bind('click', function() {
            $('form#myform').submit();
        });
	
	$('#header input[name=\'search\']').bind('keydown', function(e) {
		if (e.keyCode == 13) {
                     $('form#myform').submit();
		}
	});
	*/
	
	/* Ajax Cart */
	/*
	$('#cart > .heading a').live('click', function() {
		$('#cart').addClass('active');
		
		$('#cart').load('index.php?route=module/cart #cart > *');
		
		$('#cart').live('mouseleave', function() {
			$(this).removeClass('active');
		});
	});
	*/
	
	$('#closecart').live('click', function(e) {
		$("#cart .content").animate({opacity: 0}, 800, function() {$( "#cart .content" ).hide()});
		e.preventDefault();
	});
	
	$('#cart .content').live('mouseleave', function(e) {
		$("#cart .content").animate({opacity: 0}, 800, function() {$( "#cart .content" ).hide()});
	});
	
	
	$('#cart .removeproduct').live('click',function(e){
		
		var $this  = $(this);
		var remove = $this.attr('rel');
		
		$.ajax({
			url: 'index.php?route=module/cart/remove',
			type: 'get',
			data: 'remove=' + remove,
			dataType: 'json',
			success: function(json) {
				
				if (json['success']) {
					
					$('#cart-total').html(json['count']);
					
					$this.closest('tr').fadeOut(400,function(){
						$(this).remove();
					})
					
					$('#mini-cart-total').load('index.php?route=module/cart #mini-cart-total');
					
				}	
				
			}
			
		});
		
		e.preventDefault();
	});
	
	
	$('#form').live('mouseleave', function(e) {
		$("#form").animate({opacity: 0}, 800, function() {$( "#form" ).hide()});
	});
	
	
	/* JBO ADDONS - 21-05-2014 */
	$('.inotify .de_closenote').live('click',function(e){
		$(this).closest('.inotify').fadeOut(600);
		e.preventDefault();
	});
	
	
	/* END JBO ADDONS */
	
	
	
	/* Mega Menu */
	$('#menu ul > li > a + div').each(function(index, element) {
		// IE6 & IE7 Fixes
		if ($.browser.msie && ($.browser.version == 7 || $.browser.version == 6)) {
			var category = $(element).find('a');
			var columns = $(element).find('ul').length;
			
			$(element).css('width', (columns * 143) + 'px');
			$(element).find('ul').css('float', 'left');
		}		
		
		var menu = $('#menu').offset();
		var dropdown = $(this).parent().offset();
		
		i = (dropdown.left + $(this).outerWidth()) - (menu.left + $('#menu').outerWidth());
		
		if (i > 0) {
			$(this).css('margin-left', '-' + (i + 5) + 'px');
		}
	});

	// IE6 & IE7 Fixes
	if ($.browser.msie) {
		if ($.browser.version <= 6) {
			$('#column-left + #column-right + #content, #column-left + #content').css('margin-left', '195px');
			
			$('#column-right + #content').css('margin-right', '195px');
		
			$('.box-category ul li a.active + ul').css('display', 'block');	
		}
		
		if ($.browser.version <= 7) {
			$('#menu > ul > li').bind('mouseover', function() {
				$(this).addClass('active');
			});
				
			$('#menu > ul > li').bind('mouseout', function() {
				$(this).removeClass('active');
			});	
		}
	}
	
	$('.success img, .warning img, .attention img, .information img').live('click', function() {
		$(this).parent().fadeOut('slow', function() {
			$(this).remove();
		});
	});	

	if($('#contentcategory_wrapper').length>0){
		$( window ).resize(stretchContentwrapper);
		stretchContentwrapper();
	}
});

function getURLVar(key) {
	var value = [];
	
	var query = String(document.location).split('?');
	
	if (query[1]) {
		var part = query[1].split('&');

		for (i = 0; i < part.length; i++) {
			var data = part[i].split('=');
			
			if (data[0] && data[1]) {
				value[data[0]] = data[1];
			}
		}
		
		if (value[key]) {
			return value[key];
		} else {
			return '';
		}
	}
} 

function addToCart(product_id, quantity) {
	quantity = typeof(quantity) != 'undefined' ? quantity : 1;

	$.ajax({
		url: 'index.php?route=checkout/cart/add',
		type: 'post',
		data: 'product_id=' + product_id + '&quantity=' + quantity,
		dataType: 'json',
		success: function(json) {
			$('.success, .warning, .attention, .information, .error').remove();
			
			if (json['redirect']) {
				location = json['redirect'];
			}
			
			if (json['success']) {
				
				//$('#notification').html('<div class="success" style="display: none;">' + json['success'] + '<img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>');
				//$('.success').fadeIn('slow');
				$('#cart-total').html(json['total']);
				//$('html, body').animate({ scrollTop: 0 }, 'slow'); 
				
				
			}	
		}
	});
}

function addToWishList(product_id) {
	$.ajax({
		url: 'index.php?route=account/wishlist/add',
		type: 'post',
		data: 'product_id=' + product_id,
		dataType: 'json',
		success: function(json) {
			$('.success, .warning, .attention, .information').remove();
						
			if (json['success']) {
				$('#notification').html('<div class="success" style="display: none;">' + json['success'] + '<img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>');
				
				$('.success').fadeIn('slow');
				
				$('#wishlist-total').html(json['total']);
				
				$('html, body').animate({ scrollTop: 0 }, 'slow');
			}	
		}
	});
}

function addToCompare(product_id) { 
	$.ajax({
		url: 'index.php?route=product/compare/add',
		type: 'post',
		data: 'product_id=' + product_id,
		dataType: 'json',
		success: function(json) {
			$('.success, .warning, .attention, .information').remove();
						
			if (json['success']) {
				$('#notification').html('<div class="success" style="display: none;">' + json['success'] + '<img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>');
				
				$('.success').fadeIn('slow');
				
				$('#compare-total').html(json['total']);
				
				$('html, body').animate({ scrollTop: 0 }, 'slow'); 
			}	
		}
	});
}

//Change sponiza
function displayButton(butid, imgid) {
   obj = document.getElementById(butid);
   obj.style.display = 'block';
   obji = document.getElementById(imgid);
   obji.style.border = '0px solid #00FF00';
}

function hideButton(butid, imgid) {
   obj = document.getElementById(butid);
   obj.style.display = 'none';
   obji = document.getElementById(imgid);
   obji.style.border = '0px';
}

function stretchContentwrapper(){
  var diff = $(window).height() - ($('#contentcategory_wrapper').height() + $('#contentcategory_wrapper').offset().top + 67);
  if(diff > 0)
    $('#contentcategory_wrapper').css('min-height',$('#contentcategory_wrapper').height() + diff);
  return diff;
}
