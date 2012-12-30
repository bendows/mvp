<?
class app_page_request_password_reset extends app_page_app_page {

  var $viewfile = "request_password_reset_form";

    function post() {

        $p = $this->component('request')->post;
        $captchacode = trim($_SESSION['captchac']);
        $captchacodetest = trim($p['captchacode']);
        $uid = trim($p['uid']);

        if ($captchacode != $captchacodetest)
            return;

        $_SESSION['captchac'] = '';

        $this->viewfile = "request_password_reset_result";

        $this->viewvars['msg'] = "Your request could not be completed";

        if ($this->component("auth")->request_password_reset($uid))
            $this->viewvars['msg'] = "An email with a password reset link was sent to $uid<br>".
          "When the message arrives, click the link in it to continue.";
        else
            $this->viewvars['ermsg'] = "No action taken";
    }

}?>
