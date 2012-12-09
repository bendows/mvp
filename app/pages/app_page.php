<?

class app_page_app_page extends lib_page_render {

   var $models = array('mysql');
    function initialize() {
        $this->component("request", array('POST', 'GET', 'COOKIE', 'FILES', 'SERVER'));
    }

}
?>
