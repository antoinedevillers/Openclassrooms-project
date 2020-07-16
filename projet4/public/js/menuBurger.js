$(document).ready(function(){
	$('.btn_navigation').click(function(){
		$('nav').toggleClass('isOpen');
		$('.btn_navigation').toggleClass('isOpen');
		$('h1').toggleClass('isOpen');
	});
	
});