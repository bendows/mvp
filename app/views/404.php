<?
$url = preg_replace("/^./","", $this->here);
?>
<h2>404 Page not found</h2>
<p>To redefine this default error page edit app/pages/404.php</p>
<p>To redefine this default error view edit app/views/404.php</p>

<p>No route found for the URL[<?=$this->here;?>]</p>
<p>To add a route for the URL[<?=$this->here;?>] add the folloing case statement inside the switch statement in the file app/routers/default.php</p>
<pre>
	case preg_match ("%^<?=$url;?>$%", $this->url):
		$apage = "app_page_<?=$url;?>";
		break;
</pre>

<p> Then create app/pages/<?="$url.php";?> as follows:</p>
<?
$pagecontent = <<< EOF
<?

	class app_page_$url extends app_page_app_page {
		var \$autorender = true;
		var \$layout = "3col_layout";
		var \$viewfile = "$url";
	}

?>
EOF;
$pagecontent=htmlentities($pagecontent);
?>
<pre><?=$pagecontent;?></pre>
  <?=$this->element('debug');?>
