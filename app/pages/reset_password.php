<?
class app_page_reset_password extends app_page_app_page {

    var $viewfile = "reset_password_result";

    function get() {
       $g = $this->component('request')->get;

        $rs = parseinput ($g, array('r'=>'emailmx', 'e'=>'md5'));
       if (! is_array($rs)) {
            $this->viewvars['ermsg'] = "Your request could not be completed<br>";
            return;
        }
        if (! $this->component("auth")->user_by_token($g['r'],$g['e'])) {
            $this->viewvars['ermsg']="This link does not work<br><a href='/request_password_reset.php'>Get a new password reset request</a>";
            return;
        }
        $this->viewfile = "reset_password";
        $this->viewvars['email'] = $g['r'];
        $this->viewvars['er'] = $g['e'];
    }

    function post() {

       $p = $this->component('request')->post;

       $p['captchac']=$_SESSION['captchac'];
       $_SESSION['captchac']='';
	$rs = parseinput ($p, array('apwd'=>'emptystr', 'apwd2'=>'emptystr', 'email'=>'emailmx', 'er'=>'md5'));
        if (! is_array($rs)) {
            $this->viewvars['ermsg'] = "Your request could not be completed<br>";
	    return;
	}
	
    if (! $this->component("auth")->user_by_token($p['email'],$p['er'])) {
           $this->viewvars['ermsg'] = "Your request could not be completed.";
      	   return;
        }

       $g = $this->component('request')->get;

        $this->viewfile = "reset_password";

        if (($p['captchacode'] != $p['captchac']) || ($p['apwd'] != $p['apwd2'])) {
          	$this->viewvars['email'] = $g['r'];
        	$this->viewvars['er'] = $g['e'];
            $this->viewvars['ermsg'] = "Maybe the passwords are not the same.<br> You can also click on the blue image<br>";
	    return;
	}

    if ($this->component("auth")->update_password($p['email'], $p['er'], $p['apwd'], $p['apwd2'])) {
    	$this->viewfile = "login";
	$this->here = "/login.php";
        $this->viewvars['msg'] = "Your password has been reset.<br>
        You can now log in with your new password.";
	return;
	}
        $this->viewvars['email'] = $g['r'];
        $this->viewvars['er'] = $g['e'];
        $this->viewvars['ermsg'] = "Maybe the passwords are not the same.<br> You can also click on the blue image<br>";
    }
}?>
