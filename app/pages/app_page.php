<?

class app_page_app_page extends lib_page_render {
   var $models = array('sitedb', 'sessiondb');
   var $autorender = true;
   var $layout = "3col_layout";
    var $viewclass = "app_view";

    function initialize() {
      $this->component("request", array('POST', 'GET', 'COOKIE', 'FILES', 'SERVER'));
      if ($this->ismodel('sessiondb'))
      	$this->model('sessiondb')->connect(settings::get('sessiondbconf'));
      if ($this->ismodel('sitedb'))
	$this->model('sitedb')->connect(settings::get('sitedbconf'));
      $this->component("sessiondb", 
	array(
     	'session_name'=>'panel_theitnetwork_co_za',
    	'cookie_lifetime'=>3600,
     	'model'=>'sessiondb',
       	'table_name'=>'ASdfgASe3a',
      ));
      $this->component("auth", array(
            'model'=>'sitedb',
      ));
    if ($this->component('request')->ispost())
      if (method_exists($this, "post"))
        $this->post();

    if ($this->component('request')->isget())
      if (method_exists($this, "get"))
        $this->get();

    }

}
?>
