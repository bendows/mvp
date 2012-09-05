<?
//Access elements inside the $siteconf array anyware throughout the site
//like this: settings::get('keyname')
//ie. echo settings::get('mysqlconf') //echo's "app/conf/sitedb.php"
$siteconf=array(
    "maintenance"=>"/maintain.html", //Hash out this line to put the site in live mode
    "logfile"=>"html/messages.log",  //Hash out this line to disable logging throughout the site
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
