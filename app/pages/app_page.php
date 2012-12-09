<?

class app_page_app_page extends lib_page_render {

   var $models = array('mysql');
    function initialize() {
      $this->component("request", array('POST', 'GET', 'COOKIE', 'FILES', 'SERVER'));
      $this->component("sessiondb", 
	array(
      		'session_name'=>'panel_theitnetwork_co_za',
      		'cookie_lifetime'=>86400,
      		'model'=>'mysql',
        	'table_name'=>'php_session',
        	'mysqlfile'=>'app/conf/sessiondb.php'
        )
);
    }

}
?>
