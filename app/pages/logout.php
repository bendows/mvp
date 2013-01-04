<?
class app_page_logout extends app_page_app_page {

  var $autorender = true;
  var $viewfile = "reset_password_result";
  var $layout = "1col_layout";
  var $title = "Login to theitnetwork.co.za";

    function get() {
    	if ($this->component('auth')->isloggedin())
            $this->viewvars['msg'] = 'You have been logged out';
        else
            $this->viewvars['msg'] = 'You are already logged out';
        $this->component('auth')->logout();
        $this->viewvars['login']="login";
    }
}
?>
