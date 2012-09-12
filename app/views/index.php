<?$this->addscript("<script type='text/javascript' src='/js/plugins.js'></script>");
  $this->addscript("<link rel='stylesheet' type='text/css' href='/css/screen.css' media='screen'/>\n");?>
<h2> mvp successfully installed on <?=$this->httphost;?></h2>
</p>The layoutfile used to display this page is app/views/layouts/default_layout.php</p>
	<p> The viewfile used to display this text and the rest of the contents of the middle column of this page is app/views/index.php</p>
<p>
<?
pr(get_defined_vars());
pr($this);
?>
</p>
<?=$this->element('left');?>
<?=$this->element('right');?>
