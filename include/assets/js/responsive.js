$(document).ready(function() {
	$('#menu-icon-bar i').click(function(){
		$('header ul').slideToggle();
		$('header ul ul').css('display', 'none');
	});

	$('header ul li').click(function(){
		$('header ul ul').slideUp();
		$(this).find('ul').slideToggle();
	});

	$(window).resize(function() {
		if($(window) > 768){
			$('header ul').removeAttr('style');
		}
	});
});