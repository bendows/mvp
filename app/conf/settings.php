<?
$siteconf=array(
    "maintenance"=>"/maintain.html",
    "logfile"=>"html/messages.log",
    "mysqlconf"=>"app/conf/sitedb.php",
    "requestcomponent"=>array('request'=> array('POST', 'GET', 'COOKIE', 'FILES', 'SERVER')),
    "sessioninfo"=>array(
    'session_name'=>'change_this_to_example_org',
    'cookie_lifetime'=>86400, //Max lifetime of a session between page clicks
    'model'=>'mysql',
    'table_name'=>'php_session',
    'mysqlfile'=>'app/conf/sessiondb.php'
    )
 );
?>
