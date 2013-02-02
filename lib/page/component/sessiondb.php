<?

class lib_component_sessiondb extends lib_component_component {

    private $gc_maxlifetime = 0;

    function initialize() {
        l::ll('lib_component_sessiondb::initialize()');
        parent::initialize(func_get_args());
        $apage = $this->page;
        $args = $this->args;
        $this->model = $apage->model($args['model']);
        ini_set('allow_url_fopen', 0);
        ini_set('allow_url_include', 0);
        ini_set('session.auto_start', '0');
        # 75% default garbage collection (expires sessions)
        ini_set("session.gc_probability", 1);
        ini_set("session.gc_divisor", 100);
        ini_set('session.gc_maxlifetime', $args['cookie_lifetime']);
        ini_set('session.referer_check', '');
        ini_set('session.entropy_length', 16);
        ini_set('session.cookie_lifetime', 0);
        ini_set('session.use_cookies', '1');
        ini_set('session.use_only_cookies', '1');
        ini_set('session.use_trans_sid', 0);
        ini_set('session.hash_function', 1);
        ini_set('session.hash_bits_per_character', 5);
        ini_set('session.name', $args['session_name']);
        session_name($args['session_name']);
        //$this->cookie_lifetime=900 //15 minutes
        $this->gc_maxlifetime = ini_get('session.gc_maxlifetime');
        // Sessions last for a day unless otherwise specified.
        if (!$this->gc_maxlifetime) {
            die('this is neverland, the impossible');
            $this->gc_maxlifetime = 60;
        }
        if (!session_set_save_handler(
                        array(&$this, 'open'), array(&$this, 'close'), array(&$this, 'read'), array(&$this, 'write'), array(&$this, 'destroy'), array(&$this, 'gc'))) {
            die("Error session_set_save_handler");
        }
        $tt = $_SERVER['HTTP_USER_AGENT'];
        $tt.= ' ASSrtASdfGtewr53 ';
        $tt = preg_replace("/\ /", "Y", $tt);
        $tt = md5($tt);
        session_start();
        if (!isset($_SESSION['initiated'])) {
            session_regenerate_id();
            $_SESSION['userag'] = $tt;
            $_SESSION['initiated'] = true;
        }
    }

    function open($save_path, $session_name) {
        l::ll('lib_component_sessiondb::open()');
        return true;
    }

    function close() {
        l::ll('lib_component_sessiondb::close()');
        return true;
    }

    function read($id) {
        l::ll('lib_component_sessiondb::read()');
        $k = $this->model->delete(
                $this->args['table_name'], "(http_host = '%s') and (unix_timestamp(now())-updated > %s)", array(
            'http_host' => $_SERVER['HTTP_HOST'],
            'delta' => $this->gc_maxlifetime), array('http_host' => 'str', 'delta' => 'int'));
        if ($k < 0)
            return '';
        if ($k == 0)
            l::ll('lib_component_sessiondb::read delete returned zero :)');
        
        $row = $this->model->row("select data from {$this->args['table_name']} where (sessid = '%s')", array('sessid' => $id), array('sessid' => 'str'));
        
        if (! $row)
            return '';
        
        if (empty($row))
            return '';

        l::ll('lib_component_sessiondb::read foundie :)');
        return $row['data'];
    }

    function write($id, $data) {
        l::ll('lib_component_sessiondb::write()');
        $rca = $this->page->component('request')->server;
        $ar = $this->model->row("select data from {$this->args['table_name']} where (sessid = '%s')", 
                array('sessid' => $id), 
                array('sessid' => 'str')
        );
        
        if (! is_array($ar))
            return false;
        
        if (empty($ar)) {
            $r = $this->model->insert($this->args['table_name'], array('sessid' => $id,
                'sessname' => ini_get('session.name'),
                'http_host' => $rca['HTTP_HOST'],
                'ipaddr' => $rca['REMOTE_ADDR'],
                'cipaddr' => $rca['REMOTE_ADDR'],
                'data' => $data,
                'created' => time(),
                'updated' => time()), array('sessid' => 'str',
                'sessname' => 'str',
                'http_host' => 'str',
                'ipaddr' => 'str',
                'cipaddr' => 'ipaddr',
                'data' => 'str',
                'created' => 'int',
                'updated' => 'int'
                    ));
            /*
              array('sessid', 'sessname', 'http_host', 'ipaddr', 'cipaddr', 'data', 'created', 'updated'),
              array($id, ini_get('session.name'), $rca['HTTP_HOST'],
              $rca['REMOTE_ADDR'], $rca['REMOTE_ADDR'], $data, time(), time())
             */
            if ($r < 1) {
                l::ll("session write error");
                return false;
            }
            return true;
        }
        //Session already exists in db, just update some fields
        $r = $this->model->update($this->args['table_name'], "sessid = '$id'",
//array('cipaddr', 'data', 'updated'), array($_SERVER['REMOTE_ADDR'], $data, time()), "sessid = '$id'");
                array(
            'cipaddr' => $rca['REMOTE_ADDR'],
            'data' => $data,
            'updated' => time()), array(
            'cipaddr' => 'ipaddr',
            'data' => 'str',
            'updated' => 'int'
                ));
        if ((int) $r < 0) {
            l::ll("session write error");
            return false;
        }
        return true;
    }

    public function destroy($id) {
        $k = $this->model->delete($this->args['table_name'], "sessid = '%s'", array($id));
        if ((int) $k > 0)
            return true;
        return false;
    }

    function gc($maxlifetime) {
        return true;
    }

}

?>
