<?

class lib_page_render extends lib_page_page {

    var $viewfile = false;
    var $viewclass = false;
    var $viewvars = array();
    var $output = null;

    function __construct() {
	parent::__construct();
	l::ll("lib_page_render::Construct |".$this->pagename."|");
    }

    function beforerender() {
    }

    function render($layout = null, $viewfile = null) {
        $this->beforerender();
        if (! file_exists ("app/views/layouts/$layout.php"))
            $layout = "no_layout_found";
        if (! file_exists ("app/views/$viewfile.php"))
            $viewfile = "no_view_found";
        $viewclass = "lib_view";
        if ($this->viewclass)
            $viewclass = "app_view_{$this->viewclass}";
        $view = & new $viewclass($this);
		//Render the full HTML page to the browser
        echo $view->render($layout, $viewfile);
    }

}
?>
