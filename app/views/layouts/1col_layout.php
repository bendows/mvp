<?="<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" >
<head>
  <title><?=$this->title;?></title>
	<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
	<meta name="description" content="The Full Page 1 column Liquid Layout. Em padding widths. Cross-Browser. Equal Height Columns." />
	<meta name="keywords" content="The Full Page 1 column Liquid Layout. Em padding widths. Cross-Browser. Equal Height Columns." />
	<meta name="robots" content="index, follow" />
  <link rel='stylesheet' type='text/css' href='/css/1col.css' media='screen'/>
  <?=$headers;?>
</head>
<body>
<div id="header">
<a href="http://<?=$this->httphost;?>"><img src="/img/mvplogo.png" style='border:1px solid silver;'></a>
</div>
<div class="colmask fullpage">
    <div class="col1">
     <!-- Column 1 start -->
			<?=$this->element('debug');?>
     <h2>Em dimensions of the full page layout</h2>
		<p>JavaScript is not required. Some website layouts rely on JavaScript hacks to resize divs and force elements into place but you won't see any of that nonsense here.</p>
     <!-- Column 1 end -->
    </div>
</div>
<div id="footer"><?=$this->element('footer');?></div>
</body>
</html>
