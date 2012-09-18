<?
class app_page_app_page extends lib_page_render {
  function initialize() {
  	if ($this->iscomponent('request'))
    	$this->component("request", settings::get("requestcomponent"));
   }

}
?>
