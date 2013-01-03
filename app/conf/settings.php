<?

//Access elements inside the $siteconf array anywhere throughout the site
//like this: settings::get('keyname')
//ie. echo settings::get('mysqlconf') //echo's "app/conf/sitedb.php"
$siteconf=array(
    "onlinetime"=>"10 January 2013", //Time that the site will be online again, after maintenance
    //"maintenance"=>"/maintain.html", //If this line is NOT hashed out, the site will be operating in maintenance mode
    "logfile"=>"messages.log",  //Hash out this line to disable logging throughout the site
    "sitedbconf"=>"app/conf/sitedb.php",
    "sessiondbconf"=>"app/conf/sessiondb.php",
 );
?>
