$(document).ready(function(){
	$('.nav>.nav_con>.nav_ul>li').hover(function() {
		$(this).find('.chil_ul').slideToggle('fast');
	}, function() {
		$(this).find('.chil_ul').slideToggle('fast');
	});
});