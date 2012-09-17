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
</head>
<body>
<div id="header">
<a href="http://<?=$this->httphost;?>"><img src="/img/mvplogo.png" style='border:1px solid silver;'></a>
</div>
<div class="colmask fullpage">
    <div class="col1">
     <!-- Column 1 start -->
     <h2>Layout not found</h2>
		 <p>Displaying app/views/layouts/no_layout_found.php in stead of <span style='color:red;'><?=$this->layout;?></span>.</p>
		<p>Layout <span style='color:red;'><?=$this->layout;?></span> not be found or is not a file.</p>
		<p>Create the layout <span style='color:red;'><?=$this->layout;?></span> as follows:</p>
		<p>To start with a 1 column layout, copy the file app/views/layouts/1col_layout.php as <span style='color:red;'>app/views/layouts/<?=$this->layout;?>.php</span></p>
<p>Or</p>
		<p>To start with a 3 column layout, copy the file app/views/layouts/3col_layout.php as <span style='color:red;'>app/views/layouts/<?=$this->layout;?>.php</span></p>
		<?=$this->element('debug');?>
			<?=$content;?>
     <!-- Column 1 end -->
    </div>
</div>
<div id="footer"><?=$this->element('footer');?></div>
</body>
</html>
