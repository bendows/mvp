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

    final private function setcolsvals($inputvalues = array(), $types = array()) {
        if (!(is_array($inputvalues) && !empty($inputvalues))) {
            l::ll(__METHOD__. " inputvalues not an array or empty");
            return false;
        }
        if (!(is_array($types) && !empty($types))) {
            l::ll(__METHOD__. " types not an array or empty");
            return false;
        }

        $ret = parseinput($inputvalues, $types);

        if (!is_array($ret))
            return false;

        foreach ($ret as $key => &$value) {
            if (!array_key_exists($key, $types)) {
                l::ll(__METHOD__. " key not a key in types array");
                return false;
            }
            if (true != ($value = mysql_real_escape_string($value))) {
                l::ll(__METHOD__. " value could not be mysql_real_escaped");
                return false;
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
            l::ll(__METHOD__. " [{$sql}] " . mysql_errno($this->con) . "]" . mysql_error($this->con));
            return -1;
        }
        if (!$last_inserted_id) {
            $a = mysql_affected_rows($this->con);
            l::ll(__METHOD__. " [{$sql}][$a] ");
            return $a;
        }
        $a = mysql_insert_id($this->con);
        if (!$a) {
            l::ll(__METHOD__. " insert but nothing? [$sql] [$a] returning -1");
            return -1;
        }
        l::ll(__METHOD__. " [{$sql}][$a] ");
        return $a;
    }

    public function insert($atablename = '', $inputvalues = array(), $types = array()) {
        l::ll(__METHOD__);
        $atablename = trim($atablename);
        if (empty($atablename)) {
            l::ll(__METHOD__. " empty tablename");
            return -1;
	}
        $ret = $this->setcolsvals($inputvalues, $types);
        if (!(is_array($ret) && !empty($ret)))
            return -1;

        $this->quotevalues($ret);
        $s = "insert into $atablename (" . implode(",", array_keys($ret)) . ") values (" . implode(",", array_values($ret)) . ")";
        $kk = $this->executesql($s, true);
        return ($kk);
    }

    public function update($atablename = '', $where = '', $inputvalues = array(), $types = array()) {
        l::ll(__METHOD__);
        $where = trim($where);
        if (empty($where)) {
            l::ll(__METHOD__. " empty empty where clause");
            return -1;
	}
        $atablename = trim($atablename);
        if (empty($atablename)) {
            l::ll(__METHOD__. " empty empty tablename");
            return -1;
	}
        $ret = $this->setcolsvals($inputvalues, $types);
        if (!(is_array($ret) && !empty($ret)))
            return -1;
        $this->quotevalues($ret);
        $tmp = array();
        foreach ($ret as $col => &$val)
            $tmp[] = "$col=" . $val;
        $s = "update " . $atablename . " set " . implode(',', $tmp) . " where ($where)";
        $kk = $this->executesql($s);
        return ($kk);
    }

    public function delete($atablename = '', $where = '', $inputvalues = array(), $types = array()) {
        l::ll(__METHOD__);
        $where = trim($where);
        if (empty($where)) {
            l::ll(__METHOD__." empty where clause");
            return -1;
        }
        $atablename = trim($atablename);
        if (empty($atablename)) {
            l::ll(__METHOD__." empty tablename");
            return -1;
         }
        $ret = $this->setcolsvals($inputvalues, $types);
        if (!(is_array($ret) && !empty($ret)))
            return -1;
        $s = "delete from $atablename where " . vsprintf($where, array_values($ret));
        $kk = $this->executesql($s);
        return $kk;
    }

    public function row($s = '', $inputvalues = array(), $types = array()) {
        l::ll(__METHOD__);
        $s = trim($s);
        if (empty($s)) {
            l::ll(__METHOD__." empty qry");
            return false;
        }
        $ret = $this->setcolsvals($inputvalues, $types);
        if (!(is_array($ret) && !empty($ret)))
            return -1;

        $s = vsprintf($s, array_values($ret));

        if (!$result = mysql_query($s, $this->con)) {
            l::ll(__METHOD__." [$s] [" . mysql_errno($this->con) . "]" . mysql_error($this->con));
            return false;
        }
        
        l::ll(__METHOD__." [$s]");

        if (! $row = mysql_fetch_assoc($result)) {
            return array();
        }
        
        if (count(array($row)) >1) {
            l::ll(__METHOD__." [$s} too many rows found");
            l::ll($row);
            return false;
        }
         return (array) $row;

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
