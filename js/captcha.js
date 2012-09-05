$(document).ready(function(){
	$('img#captchaimage').click(function(){
		$("img#captchaimage").attr("src", "/captcha.php?"+Math.random());
	});
});
