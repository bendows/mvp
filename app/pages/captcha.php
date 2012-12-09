<?
class app_page_captcha extends lib_page_captcha {
    var $components=array('sessiondb');
    function initialize() {
    if ($this->iscomponent('sessiondb'))
        $this->component("sessiondb", settings::get('sessioninfo'));
        parent::initialize();
    }
}
?>
