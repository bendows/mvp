<?
  class app_router_default extends lib_router_default {
		public function getpagename () {
			switch (true) {
				/*
				case preg_match ("%^contact_us(\.php)?$%", $this->url):
					$apage = "app_page_contact_us_page";
					break;
				*/
				default:
				  $apage = parent::getpagename();
					break;
			}
			return $apage;
		}
	}
?>
