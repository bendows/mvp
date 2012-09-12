<?$this->addscript("<link rel='stylesheet' type='text/css' href='/css/screen.css' media='screen'/>\n");?>
<h2>404 - page not found</h2>
<p>No page associated with the url[<?=$this->here;?>] could be found for <?=$this->httphost;?></p>
<p>
<?
pr(get_defined_vars());
pr($this);
?>
</p>
