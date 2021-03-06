<?

class lib_component_auth extends lib_component_component {

    var $salt = "asdfastgef g__sZfgI345643tr ..";

    function initialize() {
        l::ll(__METHOD__);
        parent::initialize(func_get_args());
        $apage = $this->page;
        $args = $this->args;
        $this->db = $apage->model($args['model']);
    }

    function user_by_token($email, $token) {
        l::ll(__METHOD__);
        if (empty($token))
            return false;

        if (!isemailmx($email))
            return false;

        $rs = $this->db->row("select uid from user where status = 1 and token = '%s'", array('token'=>$token), array("token"=>"md5"));
	if (is_array($rs) && ! empty($rs))
        return ((string) $rs['uid'] === (string) $email);
	return false;
    }

    function send_forgot_email($email, $randomid) {
        l::ll(__METHOD__);
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
        l::ll(__METHOD__);
        if (!isemailmx($email))
            return false;

        $apwd = rstring('sasdf'.time());

        $inputvalues = array('status'=>1, 'token'=>$apwd);
        $types = array('status'=>'int', 'token'=>'md5');
        $rs = $this->db->update("user", "uid = '$email'", $inputvalues, $types);
	if ($rs != 1)
		return false;
        if ($this->send_forgot_email($email, $apwd))
            return true;
        return false;
    }

    function register_user($email) {
        l::ll(__METHOD__);
        if (!isemailmx($email))
            return false;

        //$fields = array('registered'=>'int', 'uid'=>'str','status'=>'int', 'euid'=>'str', 'ipaddr'=>'str');
        $fields = array('registered'=>'str', 'uid'=>'emailmx', 'status'=>'zint', 'euid'=>'emailmx', 'ipaddr'=>'ipaddr');
        $values = array('registered'=>'NULL', 'uid'=>$email, 'status'=>0, 'euid'=>$email, 'ipaddr'=>$this->page->component('request')->remoteip());

        if (0 >= ($rs = $this->db->insert("user", $fields, $values)))
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
        l::ll(__METHOD__);
        if (!isemailmx($email))
            return false;

        if (!ismd5($code))
            return false;

        if (empty($pwd))
            return false;

        if ($pwd != $pwd2)
            return false;

        $pwd = md5($this->salt . "$pwd");

        $values = array('pwd'=>$pwd, 'status'=>3);
        $types = array('pwd'=>str, 'status'=>int);

        if (1 != ($rs = $this->db->update("user", "uid = '$email' and token = '$code' and status = 1", $values, $types)))
            return false;

        return true;
    }

    function isloggedin() {
        l::ll(__METHOD__);
        if (!ismd5($_SESSION['euid']))
            return (boolean) false;
        $er = $this->db->row("select 1 from user where (euid = '%s')", array('iid'=>$_SESSION['euid']), array('iid'=>'md5'));
	if (! (is_array($er) && ! empty($er))) {
            $this->logout();
            return (bool) false;
        }
        return (bool) true;
    }

    function logout() {
        l::ll(__METHOD__);
        session_destroy();
    }

    function authenticate($email, $apwd) {
        l::ll(__METHOD__);
        $apwd = md5($this->salt . "$apwd");

        if (!isemailmx($email)) {
            return (boolean) false;
        }
        if (!ismd5($apwd)) {
            return (boolean) false;
        }

        $er = $this->db->row("select id, uid, updated, typeid, handle, euid, id, pwd from user where (uid = '%s') and (pwd = '%s')", 
array('email'=>$email, 'pwd'=>$apwd), array('email'=>'email', 'pwd'=>'md5'));
	if (! (is_array($er) && ! empty($er)))
            return false;

        if ((string) $er['pwd'] === (string) $apwd) {
            $this->db->update("user", "uid = '$email'", array('loggedin'=>'NULL'), array('loggedin'=>'str'));
            $_SESSION['euid'] = $er['euid'];
            $_SESSION['tid'] = $er['typeid'];
            $_SESSION['datec'] = $er['datetimef'];
            $_SESSION['handle'] = $er['handle'];
		l::ll(__METHOD__." ".$er['uid']." logged in");
            return (boolean) true;
        }
        return (boolean) false;
    }

}

?>
