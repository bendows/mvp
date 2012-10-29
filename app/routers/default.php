<?

	class app_router_default extends lib_router_default {

		public function getpagename () {
			switch (true) {
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
