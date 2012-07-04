<?
  class app_router_default extends lib_router_default {
		public function getpagename () {
			switch (true) {
				case preg_match ("%^maintain.html$%", $this->url):
					$apage = "lib_page_maintain";
					break;
				case preg_match ("%^category.php$%", $this->url):
				case preg_match ("%^category.php.+$%", $this->url):
					$apage = "app_page_category";
					break;
				case preg_match ("%^captcha.php$%", $this->url):
					$apage = "app_page_captcha";
					break;
				case preg_match ("%^register.php$%", $this->url):
					$apage = "app_page_register";
					break;
				case preg_match ("%^add.php$%", $this->url):
					$apage = "app_page_add";
					break;
				case preg_match ("%^category_link.php$%", $this->url):
					$apage = "app_page_category_link";
					break;
				case preg_match ("%^category_delete.php$%", $this->url):
					$apage = "app_page_category_delete";
					break;
				case preg_match ("%^deletesnip.php$%", $this->url):
					$apage = "app_page_deletesnip";
					break;
				case preg_match ("%^deletesnips.php$%", $this->url):
					$apage = "app_page_deletesnips";
					break;
				case preg_match ("%^reset_password.php$%", $this->url):
					$apage = "app_page_reset_password";
					break;
				case preg_match ("%^request_password_reset.php$%", $this->url):
					$apage = "app_page_request_password_reset";
					break;
				case preg_match ("%^logout.php$%", $this->url):
					$apage = "app_page_logout";
					break;
				case preg_match ("%^login.php$%", $this->url):
					$apage = "app_page_login";
					break;
				case preg_match ("%^shift3$%", $this->url):
					$apage = "app_page_shift3";
					break;
				case preg_match ("%^contact_us(\.php)?$%", $this->url):
					$apage = "app_page_contact_us_page";
					break;
				default:
					$apage = "app_page_home_page";
					break;
			}
			return $apage;
		}
	}
?>
