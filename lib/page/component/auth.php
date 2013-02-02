<?

class lib_component_auth extends lib_component_component {

    var $salt = "asdfastgef g__sZfgI345643tr ..";

    function initialize() {
        parent::initialize(func_get_args());
        $apage = $this->page;
        $args = $this->args;
        $this->db = $apage->model($args['model']);
    }

    function user_by_token($email, $token) {

        if (empty($token))
            return false;

        if (!isemailmx($email))
            return false;

        if (false === ($rs = $this->db->row("select uid from user where status = 1 and token = '%s'", array($token))))
            return false;
        return ((string) $rs['uid'] === (string) $email);
    }

    function send_forgot_email($email, $randomid) {

        $msg = array();
        $msg[] = "<br>";
        $msg[] = "<b><font face='verdana' color=black>You have successfully generated a password reset request for your account at " .
                $_SERVER['HTTP_HOST'] . "<br>";
        $msg[] = "<br>";
        $msg[] = "Your username is: <b>$email</b><br>";
        $msg[] = "<br>";
        $msg[] = "Click on the following link to ";
        $msg[] = " <a href='http://" . $_SERVER['HTTP_HOST'] . "/reset_password.php?r=$email&e=$randomid'>Reset Your Password</a><br>";
        $msg[] = "<br>";
        $msg[] = "or visit the following URL with your faveroute web browser:<br><br>";
        $msg[] = " http://" . $_SERVER['HTTP_HOST'] . "/reset_password.php?r=$email&e=$randomid";
        $msg[] = "<br/><br/></font>";

        if (true !== ($ee = benemail($_SERVER['HTTP_HOST'], "ben@updated.co.za", $email, $email, $_SERVER['HTTP_HOST'] . " Password reset request generated", $msg))) {
            return (string) $ee;
        }

        return (boolean) true;
    }

    function request_password_reset($email) {

        if (!isemailmx($email))
            return false;

        $apwd = rstring('sasdf');

        $fields = array('status', 'token');
        $values = array(1, $apwd);

        if (false === ($rs = $this->db->update("user", $fields, $values, "uid = '$email'")))
            return false;

        if ($this->send_forgot_email($email, $apwd))
            return true;
        return false;
    }

    function register_user($email) {

        if (!isemailmx($email))
            return false;

        //$fields = array('registered'=>'int', 'uid'=>'str','status'=>'int', 'euid'=>'str', 'ipaddr'=>'str');
        $fields = array('registered', 'uid', 'status', 'euid', 'ipaddr');
        $values = array('NULL', $email, 0, $email, $this->page->component('request')->remoteip());

        if (false === ($rs = $this->db->insert("user", $fields, $values)))
            return false;

        $fields = array('euid');
        $values = array(md5($this->salt . "$rs"));

        if (false === ($rs = $this->db->update("user", $fields, $values, "id = $rs and status = 0")))
            return false;

        if ($this->request_password_reset($email))
            return true;

        return false;
    }

    function update_password($email, $code, $pwd, $pwd2) {

        if (!isemailmx($email))
            return false;

        if (!isuid($code))
            return false;

        if (empty($pwd))
            return false;

        if ($pwd != $pwd2)
            return false;

        $pwd = md5($this->salt . "$pwd");

        $fields = array('pwd', 'status');
        $values = array($pwd, 3);

        if (false === ($rs = $this->db->update("user", $fields, $values, "uid = '$email' and token = '$code' and status = 1")))
            return false;

        return true;
    }

    function isloggedin() {
        if (!ismd5($_SESSION['euid']))
            return (boolean) false;
        if (false === ($er = $this->db->row("select 1 from user where (euid = '%s')", array($_SESSION['euid'])))) {
            $this->logout();
            return (bool) false;
        }
        return (bool) true;
    }

    function logout() {
        session_destroy();
    }

    function authenticate($email, $apwd) {

        $apwd = md5($this->salt . "$apwd");

        if (!isemailmx($email)) {
            return (boolean) false;
        }
        if (!ismd5($apwd)) {
            return (boolean) false;
        }

        if (false === ($er = $this->db->row("select id, updated, typeid, handle, euid, id, pwd from user where (uid = '%s') and (pwd = '%s')", array($email, $apwd))))
            return false;

        if ((string) $er['pwd'] === (string) $apwd) {
            $this->db->update("user", array('loggedin'), array('NULL'), "uid = '$email'");
            $_SESSION['euid'] = $er['euid'];
            $_SESSION['tid'] = $er['typeid'];
            $_SESSION['datec'] = $er['datetimef'];
            $_SESSION['handle'] = $er['handle'];
            return (boolean) true;
        }
        return (boolean) false;
    }

}

?>
