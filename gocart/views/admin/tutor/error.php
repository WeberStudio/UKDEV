<script type="text/javascript">
function showStuff() {
    document.getElementById('closee').style.display = 'none';
}
</script>
       <?php 
	if($this->session->flashdata('message'))
	{
		$message	= $this->session->flashdata('message');
	}
	
	if($this->session->flashdata('error'))
	{
		$error	= $this->session->flashdata('error');
	}
	if(validation_errors() != '')
	{
		$error	= validation_errors();
	}
	?>
    
   
   
    <?php if (!empty($error)): ?>
          <div class="alert alert-error" id="closee"> <a href="javascript:void(0)"  class="close" data-dismiss="alert" onClick="showStuff(); return false;">x</a> <?php echo"<div style='margin-left: 70px;'>". $error. "</div>"; ?> </div>
          <?php endif; ?>
          
      
          <?php if (!empty($message)): ?>
		<div class="alert alert-success">
			<a class="close" data-dismiss="alert">×</a>
			<?php echo $message; ?>
		</div>
	<?php endif; ?>