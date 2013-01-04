<?
class app_page_login extends app_page_app_page {

  var $autorender = true;
  var $viewfile = "login";
  var $layout = "1col_layout";
  var $title = "Login to theitnetwork.co.za";

    function get() {
        if ($this->component('auth')->isloggedin())
            header ('Location: index.php');
    }

    function post() {

        if ($this->component('auth')->isloggedin())
            header ('Location: index.php');

        $p = $this->component('request')->post;
        $rs = parseinput ($p, array('uid'=>'email', 'apwd'=>'str'));
        if (! is_array($rs)) {
            $this->viewvars['ermsg'] = 'Could not log you in';
            return;
        }

        $uid = $p['uid'];
        $pwd = $p['apwd'];

        if ($this->component('auth')->authenticate($uid, $pwd))
            header ('Location: index.php');
        else
            $this->viewvars['ermsg'] = 'Could not log you in';
    }
}
?>
