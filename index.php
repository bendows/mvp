<?
if (! file_exists ('lib/boot.php')) {
	$docroot = dirname(__FILE__);
	$tmp = <<<EOT
lib directory is missing
Run: cd $docroot && git clone https://github.com/insecureben/lib 
EOT;
$tmp = htmlentities($tmp);
echo "<pre>$tmp</pre>";
} else
	require_once('lib/boot.php'); ?>
