<h2>View not found</h2>
<p>Displaying app/views/no_view_found.php in stead of <span style='color:red;'><?=$this->viewfile;?>.</span></p>
<p>View <span style='color:red;'><?=$this->viewfile;?></span> not found or is not a file.</p>
<p>Create the view <span style='color:red;'><?=$this->viewfile;?></span> as follows:</p>
<p>Copy the file app/views/index.php as <span style='color:red;'>app/views/<?=$this->viewfile;?>.php</span></p>
<?=$this->element('debug');?>
