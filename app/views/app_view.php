<?php
class app_view_app_view extends lib_view {
  function __construct(&$page) {
        parent::__construct($page);
        $this->addscript("<link rel='stylesheet' type='text/css' href='/css/screen.css' media='screen'/>");
        $this->addscript("<script type='text/javascript' src='/js/jquery/jquery.min.js'></script>");
        $this->addscript("<script type='text/javascript' src='/js/ajax_search.js'></script>");
        $this->addscript("<script type='text/javascript' src='/js/captcha.js'></script>");
        $this->addscript("<script type='text/javascript' src='/js/msg.js'></script>");
    }
}
