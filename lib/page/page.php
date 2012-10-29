<?

class lib_page_page extends object {

    var $pagename = false;
    var $models = array();
    var $components = array();
    var $helpers = array();

    private $objects = array(
        'models' => array(),
        'components' => array(),
        'helpers' => array()
    );

    function __construct() {
        parent::__construct(array_keys($this->objects));
        $this->pagename = get_class($this);
        l::ll("lib_page_page::Construct |".$this->pagename."|");
    }

    function ismodel($amodelname) {
        return in_array($amodelname, $this->models);
    }

    function iscomponent($acomponentname) {
        return array_key_exists($acomponentname, $this->components);
    }

    function model($amodelname = '') {
        if (empty($amodelname))
            return;
        if (!in_array($amodelname, $this->models))
            return;
        $classname = "app_model_{$amodelname}";
        if ($this->objects['models'][$amodelname] instanceof $classname)
            return $this->objects['models'][$amodelname];
        $this->objects['models'][$amodelname] = & new $classname();
        return $this->objects['models'][$amodelname];
    }

    function component() {
        $component_name = func_get_arg(0);
        $classname = "lib_component_{$component_name}";
        if (func_num_args()==1)
            if ($this->objects['components'][$component_name] instanceof $classname)
                return $this->objects['components'][$component_name];

        $component_args = func_get_args(); 
        array_shift($component_args);
        $temp = $this->objects['components'][$component_name] = & new $classname($this, $component_args);
        return $temp;
    }

    function shutdown() {
        
    }

}
?>
