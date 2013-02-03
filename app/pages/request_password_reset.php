<?
class app_page_request_password_reset extends app_page_app_page {

  var $viewfile = "request_password_reset_form";

    function post() {
        $p = $this->component('request')->post;
        $p['captchac']=$_SESSION['captchac'];
        $_SESSION['captchac']='';

        $rs = parseinput($p, array('captchacode'=>'str', 'captchac'=>'str', 'uid'=>'emailmx'));

        if (! is_array($rs))
            $this->viewvars['ermsg'] = "Your requesti could not be completed<br>";
        else {
        if ($p['captchacode'] != $p['captchac'])
            return;

        if ($this->component("auth")->request_password_reset($p['uid'])) {
            $this->viewfile = "request_password_reset_result";
            $this->viewvars['msg'] = "An email with a password reset link was sent to {$p['uid']}<br>".
          "When the message arrives, click the link in it to continue.";
        }
	}
    }

}?>
