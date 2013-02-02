<?$this->addscript("<script type='text/javascript' src='/js/jquery/jquery.min.js'></script>");?>
<?$this->addscript("<script type='text/javascript' src='/js/captcha.js'></script>");?>

<h2> mvp successfully installed on <?=$this->httphost;?></h2>
<h2><?=$started;?></h2>
<h2><?=$elapsed;?></h2>
<?=$this->element('debug');?>
<p>
The left column and the right column are included inside the layout [<?=$this->layout;?>] as elements.<br>
Here the same elements are included again, but inside the view[<?=$filename;?>]
<?=$this->element('left');?>
<?=$this->element('right');?>
