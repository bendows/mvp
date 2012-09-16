<?

function __autoload($classname) {

				$c = $classname;
    switch (true) {
        case preg_match("%^l$%", $classname):
            $classname = "lib/l";
            break;
        case preg_match("%^app_view_%", $classname):
            $fn = preg_replace("%^app_view_%", "", $classname);
            $classname = "app/views/$fn";
            break;
        case preg_match("%^settings$%", $classname):
            $classname = "lib/settings";
            break;
        case preg_match("%^lib_helper_%", $classname):
            $fn = preg_replace("%^lib_helper_%", "", $classname);
            $classname = "lib/view/helper/{$fn}";
            break;
        case preg_match("%^app_helper_%", $classname):
            $fn = preg_replace("%^app_helper_%", "", $classname);
            $classname = "app/views/helpers/{$fn}";
            break;
        case preg_match("%^object$%", $classname):
            $classname = "lib/object";
            break;
        case preg_match("%^lib_model_%", $classname):
            $fn = preg_replace("%^lib_model_%", "", $classname);
            $classname = "lib/model/{$fn}";
            break;
        case preg_match("%^lib_page_%", $classname):
            $fn = preg_replace("%^lib_page_%", "", $classname);
            $classname = "lib/page/{$fn}";
            break;
        case preg_match("%^lib_view$%", $classname):
            $classname = "lib/view/view";
            break;
        case preg_match("%^lib_component_%", $classname):
            $fn = preg_replace("%^lib_component_%", "", $classname);
            $classname = "lib/page/component/{$fn}";
            break;
        case preg_match("%^lib_router_%", $classname):
            $fn = preg_replace("%^lib_router_%", "", $classname);
            $classname = "lib/router/{$fn}";
            break;
        case preg_match("%^app_model_%", $classname):
            $fn = preg_replace("%^app_model_%", "", $classname);
            $classname = "app/models/{$fn}";
            break;
        case preg_match("%^app_router_%", $classname):
            $fn = preg_replace("%^app_router_%", "", $classname);
            $classname = "app/routers/{$fn}";
            break;
        case preg_match("%^app_page_%", $classname):
            $fn = preg_replace("%^app_page_%", "", $classname);
            $classname = "app/pages/{$fn}";
            break;
        case preg_match("%^app_component_%", $classname):
            $fn = preg_replace("%^app_component_%", "", $classname);
            $classname = "app/pages/components/{$fn}";
            break;
        default:
            break;
    }

    $filename = "{$classname}.php";

    if (!file_exists("$filename"))
			error_log(__FILE__."::".__FUNCTION__." file[$filename] not a file class[$c]");
		else
    	require_once($filename);
}

?>
