<?php

class lib_view {

    var $viewfile = false;
    var $layout = false;
    var $input = array();
    var $viewvars = array();
    var $autolayout = true;
    var $hasrendered = false;
    var $output = false;
    //These variables carry over from the page into the view
    var $pagevars = array('pagename', 'httphost', 'title', 'remoteip', 'here', 'referer', 'viewvars', 'viewfile', 'layout');
    //Hold CSS and js scripts to include
    var $scripts = array();

    function __construct(&$page) {
        if (!is_object($page))
            error_log("Page[$page] is not a page object");
        $this->pagename = get_class($page);
        //Suck in some variables from the page object
        foreach ($this->pagevars as $var)
            if (isset($page->{$var}))
                $this->{$var} = $page->{$var};
        if (is_array($page->helpers))
            if (count($page->helpers))
                foreach ($page->helpers as $helper) {
                    $classname = "lib_helper_{$helper}";
                    $this->{$helper} = & new $classname($this);
                }
    }

    function addscript($a = '') {
        if (in_array($a, $this->scripts))
            return;
        $this->scripts[] = $a;
    }

    function flash($key = false) {
        if (!$key)
            return;
        if (empty($key))
            return;
        if (!is_scalar($key))
            return;
        if (!array_key_exists($key, $_SESSION))
            return;
        $msg = $_SESSION[$key];
        $_SESSION[$key] = "";
        return $msg;
    }

    function render($layout = null, $viewfile = null) {
        $out = null;
        $viewoutput = $this->_render("app/views/$viewfile", $this->viewvars);
        $pageoutput = $this->_renderlayout("app/views/layouts/$layout", $viewoutput);
        $this->hasrendered = true;
        return $pageoutput;
    }

    function _renderlayout($layoutfilename = null, $content) {
        $data = array_merge(
                $this->viewvars, array(
            'content' => $content,
            'headers' => implode("\t\r\n", $this->scripts)
                )
        );
        return $this->_render($layoutfilename, $data);
    }

    function _render($filename, $data) {
        $filename = $filename . ".php";
        extract($data, EXTR_SKIP);
        ob_start();
        if (!file_exists($filename))
            echo "filename $filename does not exist";
        else
            include ($filename);
        return ob_get_clean();
    }

    function element($elementfilename, $data = array()) {
        $element = $this->_render("app/views/elements/{$elementfilename}", array_merge($this->viewvars, $data));
        return $element;
    }

}

?>
