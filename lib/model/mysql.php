<?

class lib_model_mysql {

    private $fmsg = "[empty]";
    private $fmmsg = '[empty]';
    public $fno = '';
    private $fields = array();
    private $fsql = '';
    private $cols = array();
    private $vals = array();
    private $con = false;

    final private function quotevalues(&$ar) {
        foreach ($ar as $i => &$value) {
            if ($value == "NULL")
                $value = "$value";
            else
                $value = "'$value'";
        }
    }

    final private function setcolsvals($cols = array(), $vals = array()) {

        if (!(is_array($cols) && !empty($cols))) {
            l::ll("lib_model_mysql::setcolsvals() cols array empty or not an array");
            return -4;
        }
        if (!(is_array($vals) && !empty($vals))) {
            l::ll("lib_model_mysql::setcolsvals() vals array empty or not an array");
            return -5;
        }

        $ret = parseinput($cols, $vals);

        if (!is_array($ret)) {
            l::ll("lib_model_mysql::setcolsvals() >> parseinput $ret");
            return -6;
        }

        foreach ($ret as $key => &$value) {
            if (!array_key_exists($key, $cols)) {
                l::ll("lib_model_mysql::setcolsvals() $key is not a key in cols");
                return -7;
            }
            if (true != ($value = mysql_real_escape_string($value))) {
                l::ll("lib_model_mysql::setcolsvals() $value could not be real_escaped for mysql");
                return -8;
            }
        }
        return $ret;
    }

    public function connect($mysqlconf = false) {
        $this->msg = "";
        $this->emsg = "nothing done to mysql";
        if (!$mysqlconf)
            return false;
        if (is_scalar($mysqlconf)) {
            if (file_exists("$mysqlconf")) {
                l::ll("lib_model_mysql::connect including file $mysqlconf");
                require("$mysqlconf");
            } else {
                l::ll("lib_model_mysql::connect $mysqlconf did not exist as a file and was not included");
                return false;
            }
        } else {
            if (!is_array($mysqlconf)) {
                l::ll("$mysqlconf is not an arry");
                return false;
            }
            if (empty($mysqlconf)) {
                l::ll("$mysqlconf is an array, but empty");
                return false;
            }

            $lar = $mysqlconf;
        }
        $this->con = mysql_connect($lar['dbhost'], $lar['dbuser'], $lar['dbpwd'], TRUE);
        if (!$this->con) {
            l::ll("lib_model_mysql::connect " . mysql_errno() . " " . mysql_error());
            return false;
        }
        if (!mysql_select_db($lar['dbname'], $this->con)) {
            l::ll("lib_model_mysql::connect " . mysql_errno($this->con) . " " . mysql_error($this->con));
            return false;
        }
        return (boolean) true;
    }

    final private function executesql($sql, $last_inserted_id = false) {
        if (!mysql_query($sql, $this->con)) {
            l::ll("lib_model_mysql::executesql [{$sql}] " . mysql_errno($this->con) . "]" . mysql_error($this->con));
            return false;
        }
        if (!$last_inserted_id)
            return mysql_affected_rows($this->con);
        return (mysql_insert_id($this->con));
    }

    public function update($atablename = '', $where = '', $cols = array(), $vals = array()) {
        $where = trim($where);
        if (empty($where))
            return -2;
        $atablename = trim($atablename);
        if (empty($atablename))
            return -3;
        $ret = $this->setcolsvals($cols, $vals);
        if (!(is_array($ret) && !empty($ret)))
            return -3;

        $this->quotevalues($ret);
        $tmp = array();
        foreach ($ret as $col => &$val)
            $tmp[] = "$col=" . $val;
        $s = "update " . $atablename . " set " . implode(',', $tmp) . " where ($where)";
        return $this->executesql($s);
    }

    public function insert($atablename = '', $cols = array(), $vals = array()) {
        $atablename = trim($atablename);
        if (empty($atablename))
            return -3;
        $ret = $this->setcolsvals($cols, $vals);
        if (!(is_array($ret) && !empty($ret)))
            return false;

        $this->quotevalues($ret);
        $s = "insert into $atablename (" . implode(",", array_keys($ret)) . ") values (" . implode(",", array_values($ret)) . ")";
        return $this->executesql($s);
    }

    public function delete($atablename = '', $where = '', $cols = array(), $vals = array()) {
        $where = trim($where);
        if (empty($where))
            return -2;
        $atablename = trim($atablename);
        if (empty($atablename))
            return -3;

        $ret = $this->setcolsvals($cols, $vals);

        if (!(is_array($ret) && !empty($ret)))
            return false;

        $s = "delete from $atablename where " . vsprintf($where, array_values($ret));

        return $this->executesql($s);
    }

    public function row($s = '', $cols = array(), $vals = array()) {
        $s = trim($s);
        if (empty($s))
            return array();
        $ret = $this->setcolsvals($cols, $vals);
        if (!(is_array($ret) && !empty($ret)))
            return array();

        $s = vsprintf($s, array_values($ret));

        if (!$arow = mysql_query($s, $this->con)) {
            l::ll("lib_model_mysql::row() [" . @mysql_errno($this->con) . "]" . mysql_error($this->con));
            return array();
        }

        if ((int) mysql_num_rows($arow) === 1) {
            $er = (array) mysql_fetch_assoc($arow);
            return (array) $er;
        }
        if ((int) mysql_num_rows($arow) > 1)
            l::ll("to many rows returned");
        return array();
    }

    public function rows($s = '', $values = array(), $key = 'id') {
        if (empty($values))
            $this->fsql = $s;
        else {
            if (!is_array($values)) {
                return false;
            }
            foreach ($values as &$value) {
                if (!isuid($value))
                    continue;
                return false;
            }
            $this->fsql = vsprintf($s, $values);
        }
        if (!$this->selectdb()) {
            return false;
        }
        if (!$myresult = mysql_query($this->fsql, $this->con)) {
            $this->fmsg = "Could not execute qry";
            $this->fmmsg = mysql_error($this->con);
            $this->fno = mysql_errno();
            return false;
        }
        $link = array();
        $this->fmsg = "[" . (string) mysql_num_rows($myresult) . "] rows found";
        $this->fmmsg = "[" . (string) mysql_num_rows($myresult) . "] rows found";
        if (!empty($key)) {
            while ($row = mysql_fetch_assoc($myresult)) {
                $link[$row[$key]] = $row;
            }
            return (array) $link;
        }
        $i = 0;
        while ($row = mysql_fetch_assoc($myresult)) {
            $link[] = $row;
        }
        return (array) $link;
    }

    public function rowsa($s = '', $values = array(), $key = 'id') {
        if (empty($values)) {
            $this->fsql = $s;
        } else {
            if (!is_array($values)) {
                return false;
            }
            foreach ($values as &$value) {
                if (isuid($value))
                    continue;
                return false;
            }
            $this->fsql = vsprintf($s, $values);
        }
        if (!$this->selectdb()) {
            return false;
        }
        if (!$myresult = mysql_query($this->fsql, $this->con)) {
            $this->fmsg = "Could not execute qry";
            $this->fmmsg = mysql_error($this->con);
            $this->fno = mysql_errno();
            return false;
        }
        $link = array();
        $this->fmsg = "[" . (string) mysql_num_rows($myresult) . "] rows found";
        $this->fmmsg = "[" . (string) mysql_num_rows($myresult) . "] rows found";
        if (!empty($key)) {
            while ($row = mysql_fetch_assoc($myresult)) {
                $link[$row[$key]][$row['id']] = $row;
            }
            return (array) $link;
        }
    }

}

?>
