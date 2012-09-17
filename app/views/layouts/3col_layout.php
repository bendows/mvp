<?="<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" >
<head>
  	<title><?=$this->title;?></title>
	<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
	<meta name="description" content="The Model View Page Framework" />
	<meta name="keywords" content="Model View Page Framework MVC" />
	<meta name="robots" content="index, follow" />
  <link rel='stylesheet' type='text/css' href='/css/3col.css' media='screen'/>
	<?=$headers;?>
    <!--[if lt IE 7]>
    <style media="screen" type="text/css">
    .col1 {
	    width:100%;
		}
    </style>
    <![endif]-->
</head>
<body>

<div id="header">
<a href="http://<?=$this->httphost;?>"><img src="/img/mvplogo.png" style='border:1px solid silver;'></a>
</div>
<div class="colmask holygrail">
<?=$content;?>
</div>
<div id="footer"><?=$this->element('footer');?></div>
</body>
</html>
