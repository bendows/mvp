jQuery(document).ready(function($) {
$.ajax({
  url: '/captcha.php',
	cache: false,
  success: function(data) {
		var src = data;
    $('#captchaimg').attr('src', src);
	alert ('hello');
  }
});
});
