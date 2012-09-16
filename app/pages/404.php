<?
class app_page_404 extends lib_page_render {
	var $title = "404 - Page not found";
  var $components = array("request");
  function initialize() {
    if ($this->iscomponent('request'))
      $this->component("request", settings::get("requestcomponent"));
    parent::initialize();
    }
}
?>
