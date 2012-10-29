<?

class lib_component_component {

    function __construct() {
        $this->page = func_get_arg(0);
        $component_args = func_get_args();
        array_shift($component_args);
        $component_args=$component_args[0];
        $this->initialize($component_args);
    }
}
?>
