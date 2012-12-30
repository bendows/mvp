<?
class app_page_captcha extends lib_page_captcha {
   var $models = array('sessiondb');
    function initialize() {
      $this->component("request", array('POST', 'GET', 'COOKIE', 'FILES', 'SERVER'));
      if ($this->ismodel('sessiondb'))
        $this->model('sessiondb')->connect(settings::get('sessiondbconf'));
      $this->component("sessiondb",
        array(
        'session_name'=>'panel_theitnetwork_co_za',
        'cookie_lifetime'=>3600,
        'model'=>'sessiondb',
        'table_name'=>'ASdfgASe3a',
      ));
      parent::initialize();
    }
}
?>
