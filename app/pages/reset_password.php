<?
class app_page_reset_password extends app_page_app_page {

    var $viewfile = "reset_password";

    function get() {

        if (! $this->component("auth")->user_by_token($this->component('request')->get['r'],$this->component('request')->get['e'])) {
            $this->viewvars['ermsg']="Invalid code or E-mail address<br>
            Click on the link in your E-mail again,
            <br> or <a href='/request_password_reset.php'>Generate another password reset request</a>";
            $this->viewfile = "reset_password_result";
            return;
        }
        $this->viewvars['email'] = $this->component('request')->get['r'];
        $this->viewvars['er'] = $this->component('request')->get['e'];
    }

    function post() {

       $p = $this->component('request')->post;

    if (! $this->component("auth")->user_by_token($p['email'],$p['er'])) {
            $this->viewvars['ermsg'] = "Your request could not be completed.";
            $this->viewfile = "reset_password_result";
      return;
        }

    $captchacode = trim($_SESSION['captchac']);
    $captchacodetest = trim($p['captchacode']);

        $_SESSION['captchac'] = '';

    $this->viewvars['email'] = $p['email'];
    $this->viewvars['er'] = $p['er'];

        if ($captchacode != $captchacodetest)
            return;

        if (empty($p['apwd']))
            return;

        if ($p['apwd'] != $p['apwd2'])
            return;

    if (! $this->component("auth")->update_password($p['email'], $p['er'], $p['apwd'], $p['apwd2']))
      return;

    $this->viewfile = "reset_password_result";
        $this->viewvars['msg'] = "Your password has been reset.<br>
        You can now <a href='/login.php'>log in</a>&nbsp;using your new password.";
    }
}?>
