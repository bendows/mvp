<?
class app_page_app_auth extends app_page_app_session {

	function initialize() {
	  parent::initialize();
          $this->component("auth", array('model'=>'auth'));
	}
}
?>
