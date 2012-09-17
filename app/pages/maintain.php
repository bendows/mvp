<?
class app_page_maintain extends app_page_render {
	var $viewfile = "maintain";
  var $layout = "1col_layout";
  var $title = "This site is currently in maintenance mode";
	var $components = array("request");

	function beforerender() {
		$this->viewvars['onlinetime'] = settings::get('onlinetime');
	}
}
?>
