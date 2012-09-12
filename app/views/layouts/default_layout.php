<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-GB">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title><?=$this->title;?></title>
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
    <div class="colmid">
        <div class="colleft">
            <div class="col1wrap">
                <div class="col1">
							<!-- Column 1 start -->
							<?=$content;?>
    					<!-- Column 1 end -->
                </div>
            </div>
            <div class="col2">
				<!-- Column 2 start -->
				<?=$this->element('left');?>
        <!-- Column 2 end -->
            </div>
            <div class="col3">
				<!-- Column 3 start -->
				<?=$this->element('right');?>
				<!-- Column 3 end -->
            </div>
        </div>
    </div>
</div>
<div id="footer">
    <p>This page uses the <a href="http://matthewjamestaylor.com/blog/ultimate-3-column-holy-grail-ems.htm">Ultimate 'Holy Grail' 3 column Liquid Layout</a> by <a href="http://matthewjamestaylor.com">Matthew James Taylor</a>. View more <a href="http://matthewjamestaylor.com/blog/-website-layouts">website layouts</a> and <a href="http://matthewjamestaylor.com/blog/-web-design">web design articles</a>.</p>
</div>
</body>
</html>
