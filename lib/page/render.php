<?

class lib_page_render extends lib_page_page {

    var $layout = "1col_layout";
    var $viewfile = false;
    var $viewclass = false;
    var $viewvars = array();
    var $output = null;
		var $autorender = true;

    function __construct() {
			parent::__construct();
			l::ll("lib_page_render::Construct |".$this->pagename."|");
    }

    function beforerender() {
			if (! $this->viewfile)
				$this->viewfile = "404";
    }

    function render($layout = null, $file = null) {
        $this->beforerender();
        if ($layout == null)
            $layout = $this->layout;
        if ($file == null)
            $file = $this->viewfile;
        $viewclass = "lib_view";
        if ($this->viewclass)
            $viewclass = "app_view_{$this->viewclass}";
        $view = & new $viewclass($this);
				//Display page in browser
        echo $view->render($layout, $file);
    }

		function initialize() {
			if ($this->autorender)
    		$this->render();
		}

}
?>
