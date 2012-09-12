<?
class app_page_index extends lib_page_render {
	var $viewfile = "index";
	var $title = "mvp successfully installed";
  var $components = array("request");
  function initialize() {
  	if ($this->iscomponent('request'))
    	$this->component("request", settings::get("requestcomponent"));
		parent::initialize();
    }

}
?>
