<?

class l {

    private $logfile = null;
    private $fp = NULL;

    function &getinstance() {
        static $instance = array();
        if (!$instance) {
            $instance[0] = & new l();
            $instance[0]->logfile = settings::get('logfile');
        }
        return $instance[0];
    }

    function ll($key = false) {
        $a = settings::get('logfile');
        if ($a === false)
            return;
        if (empty($a))
            return;
        if (!$key)
            return;
        $self = &l::getinstance();
        $self->fp = fopen("{$_SERVER['DOCUMENT_ROOT']}/{$self->logfile}", 'a');
        //$out = print_r($ar, true);
        if (is_array($key))
            fwrite($self->fp, "\n" . date("Y m d H:i s") . "\n".print_r($key, true)."\n");
        else    
            fwrite($self->fp, "\n" . date("Y m d H:i s") . " [$key]");
        fclose($self->fp);
    }
}
?>
