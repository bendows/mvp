<?

	class app_router_default extends lib_router_default {

		public function getpagename () {
			switch (true) {
				case preg_match ("%^logout.php$%", $this->url):
					$apage = "app_page_logout";
					break;
				case preg_match ("%^request_password_reset.php$%", $this->url):
					$apage = "app_page_request_password_reset";
					break;
				case preg_match ("%^reset_password.php$%", $this->url):
					$apage = "app_page_reset_password";
					break;
				case preg_match ("%^register.php$%", $this->url):
					$apage = "app_page_register";
					break;
				case preg_match ("%^login.php$%", $this->url):
					$apage = "app_page_login";
					break;
				case preg_match ("%^captcha.php$%", $this->url):
					$apage = "app_page_captcha";
					break;
				case preg_match ("%^index.php$%", $this->url):
				case preg_match ("%^index.html$%", $this->url):
				case preg_match ("%^index$%", $this->url):
					$apage = "app_page_index";
					break;
				default:
					$apage = parent::getpagename();
					break;
			}
			return $apage;
		}

	}
?>
