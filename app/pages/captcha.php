<?
class app_page_captcha extends lib_page_captcha {
   var $models = array('mysql');
    function initialize() {
      $this->component("request", array('POST', 'GET', 'COOKIE', 'FILES', 'SERVER'));
      $this->component("sessiondb",
        array(
                'session_name'=>'panel_theitnetwork_co_za',
                'cookie_lifetime'=>20,
                'model'=>'mysql',
                'table_name'=>'ASdfgASe3a',
                'mysqlfile'=>'app/conf/sessiondb.php'
        ));
        parent::initialize();
    }
}
?>
