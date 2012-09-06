<?$this->addscript("<script type='text/javascript' src='/js/plugins.js'></script>");
  $this->addscript("<link rel='stylesheet' type='text/css' href='/css/screen.css' media='screen'/>\n");?>
recyclebin.co.za - a place to save text for later reference
<br><br>
<?
if (! empty($stats))
	foreach ($stats as $d=>$stat)
		if ($stat['f'] == 'u')
			$users = $stat['v'];
		else
			$data = $stat['v'];
		echo "U[{$users}]&nbsp;[$data]";
		echo "<br>";
?>
