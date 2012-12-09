    <div class="colmid">
        <div class="colleft">
            <div class="col1wrap">
                <div class="col1">
              <!-- Column 1 start -->
		<h2> mvp successfully installed on <?=$this->httphost;?></h2>
<?=$this->element('debug');?>
<p>
	The left column and the right column are included inside the layout [<?=$this->layout;?>] as elements.
	Here the same elements are included again, but inside the view[<?=$filename;?>]
</p>
<?=$this->element('left');?>
<?=$this->element('right');?>
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
