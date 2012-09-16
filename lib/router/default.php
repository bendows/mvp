<?

class lib_router_default {

    public function seturl($aurl = '') {
        $this->url = substr(preg_replace("/\?.*$/", "", $aurl), 1);
        $this->url = preg_replace("/\/+/", "/", $this->url);
				if (empty($this->url))
					$this->url = "index.hml";
				if (preg_match("/^\/$/",$this->url))
					$this->url = "index.hml";
    }

    public function getpagename () {
			$apage = false;
      switch (true) {
        case preg_match ("%^index.php$%", $this->url):
        case preg_match ("%^index.html$%", $this->url):
        case preg_match ("%^index$%", $this->url):
          $apage = "app_page_index";
          break;
        case preg_match ("%^maintain.html$%", $this->url):
          $apage = "app_page_maintain";
          break;
        case preg_match ("%^contact_us(\.php)?$%", $this->url):
          $apage = "app_page_contact_us_page";
          break;
        default:
					//No page found
          $apage = "app_page_404";
          break;
      }
      return $apage;
    }

}

?>
