<h2> mvp successfully installed on <?=$this->httphost;?></h2>
<?=$this->element('debug');?>
<p>
The left column and the right column are included inside the layout [<?=$this->layout;?>] as elements.<br>
Here the same elements are included again, but inside the view[<?=$filename;?>]
<?=$this->element('left');?>
<?=$this->element('right');?>