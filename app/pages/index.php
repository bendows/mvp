<?
class app_page_index extends app_page_app_page {
	var $viewfile = "index";
	var $title = "mvp successfully installed";

	function initialize() {
		parent::initialize();
		if (! isset($_SESSION['started'])) {
			$this->viewvars['setted']="Set";
			$_SESSION['started'] = time();
		}	else {
			$this->viewvars['setted']="no";
		}
		$this->viewvars['started'] = $_SESSION['started'];
		$this->viewvars['elapsed'] = time()-$_SESSION['started'];
	}
}
?>
