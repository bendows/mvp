<?
class app_page_register extends app_page_app_page {

  var $viewfile = "register_form";

  function get() {

    if ($this->component('auth')->isloggedin()) {
      $this->viewvars['msg'] = "signup";
      $this->viewfile = "logout_first";
    }
    }

    function post() {

    if ($this->component('auth')->isloggedin()) {
            $this->viewvars['msg'] = "signup";
            $this->viewfile = "logout_first";
            return;
        }

        $p = $this->component('request')->post;
	$p['captchac']=$_SESSION['captchac'];
	$_SESSION['captchac']='';

	$rs = parseinput($p, array('captchacode'=>'str', 'captchac'=>'str', 'uid'=>'emailmx'));

	if (! is_array($rs)) {
            $this->viewvars['ermsg'] = "Your request could not be completed<br>";
	else {

        if ($p['captchacode'] != $p['captchac'])
            return;

        if ($this->component("auth")->register_user($p['uid'])) {
            $this->viewvars['msg'] = "An Email has been sent to you.<br>Click on the link in the email to reset your password";
            $this->viewfile = "registered_successfully";
        } else
            $this->viewvars['ermsg'] = "Your request could not be completed<br>Try another E-mail address";
    	}
	}
}?>
