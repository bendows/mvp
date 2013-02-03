<?

class lib_component_request extends lib_component_component {

    function initialize() {
	parent::initialize(func_get_args());
        $apage = $this->page;
        foreach ($this->args as $i=>$val) {
            switch ($val) {
                case "COOKIE":
                    $this->cookie = $_COOKIE;
                    break;
                case "SERVER":
                    $this->server = $_SERVER;
                    $apage->here = preg_replace ("/\?.*$/", "", $this->server['REQUEST_URI']);
                    $apage->remoteip = $this->remoteip();
                    $apage->referer = $this->referer();
                    $apage->httphost = $this->server['HTTP_HOST'];
                    break;
                case "GET":
                    $this->get = $_GET;
                    break;
                case "POST":
                    $this->post = $_POST;
                    break;
                case "FILES":
                    $this->files = $_FILES;
                    break;
            }
        }
    }

    function referer() {
        if ($this->server['HTTP_HOST'] != null) {
            $sessHost = $this->server['HTTP_HOST'];
        }
        if (in_array('HTTP_X_FORWARDED_HOST', $_SERVER) && $_SERVER['HTTP_X_FORWARDED_HOST'] != null) {
            $sessHost = $_SERVER['HTTP_X_FORWARDED_HOST'];
        }
        return trim(preg_replace('/(?:\:.*)/', '', $sessHost));
    }

    function remoteip($safe = true) {
        if (!$safe && $_SERVER['HTTP_X_FORWARDED_FOR'] != null) {
            $ipaddr = preg_replace('/(?:,.*)/', '', $_SERVER['HTTP_X_FORWARDED_FOR']);
        } else {
            if (in_array('HTTP_CLIENT_IP',$_SERVER) && $_SERVER['HTTP_CLIENT_IP']!= null) {
                $ipaddr = $_SERVER['HTTP_CLIENT_IP'];
            } else {
                $ipaddr = $_SERVER['REMOTE_ADDR'];
            }
        }
        if (in_array('HTTP_CLIENTADDRESS', $_SERVER) && $_SERVER['HTTP_CLIENTADDRESS'] != null) {
            $tmpipaddr = $_SERVER['HTTP_CLIENTADDRESS'];
            if (!empty($tmpipaddr)) {
                $ipaddr = preg_replace('/(?:,.*)/', '', $tmpipaddr);
            }
        }
        return trim($ipaddr);
    }

    function isget() {
        return ($this->server['REQUEST_METHOD'] === 'GET');
    }

    function ispost() {
        return ($this->server['REQUEST_METHOD'] === 'POST');
    }

}
?>
