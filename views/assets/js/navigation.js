$(document).ready(function(){
	
	/****************************************************************************************
	*************************************** Navigation **************************************
	****************************************************************************************/
	
	$(document).ready(function(){
	
		$('.open-main-menu').click(function(event){
			
			$(this).toggleClass('active');
			
			if($('.nav__links').is(':hidden')){
				$('.nav__links').slideToggle(200, function() { 
					$(this).css('display', 'flex');
				});
			}
		});
		
		$(document).mouseup(function (e){
			if (!$('.nav__links').is(e.target) && $('.nav__links').has(e.target).length === 0 && $(".open-main-menu").is(":visible")) {
				$('.nav__links' + ':visible').slideToggle(200, function() { 
					$(".open-main-menu").removeClass('active');
					$(this).css('display', 'none');
				});
			}
		});
		
		$(window).resize(function(){
			if(!$(".open-main-menu").is(":visible")){
				$(".nav__links").removeAttr("style");
				$(".open-main-menu").removeClass('active');
			}
		});

	});
});

