<?
    $siteconf=array(
    "maintenance"=>"/maintain.html",
    "logfile"=>"html/messages.log",
    "mysqlconf"=>"app/conf/sitedb.php",
    "requestcomponent"=>array('request'=> array('POST', 'GET', 'COOKIE', 'FILES', 'SERVER')),
    "sessioninfo"=>array(
    'session_name'=>'your_session_name',
    //max lifetime of a session between page clicks
    'cookie_lifetime'=>86400,
    'model'=>'mysql',
    'table_name'=>'php_session',
    'mysqlfile'=>'app/conf/sessiondb.php'
    )
 );
?>
