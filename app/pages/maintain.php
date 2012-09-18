<?
class app_page_maintain extends app_page_app_page {
	var $autorender = true;
	var $viewfile = "maintain";
  var $layout = "1col_layout";
  var $title = "This site is currently in maintenance mode";

	function beforerender() {
		$this->viewvars['onlinetime'] = settings::get('onlinetime');
	}
}
?>
