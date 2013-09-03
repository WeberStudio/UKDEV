<?php class Load_Assets{

    public function get_assets()
    {	
    	?>
        	<link href="<?=base_url()?>assets/opencollege/admin/js/plugins/chosen/chosen/chosen.css" rel="stylesheet">
            <link href="<?=base_url()?>assets/opencollege/admin/css/twitter/bootstrap.css" rel="stylesheet">
            <link href="<?=base_url()?>assets/opencollege/admin/css/base.css" rel="stylesheet">
            <link href="<?=base_url()?>assets/opencollege/admin/css/twitter/responsive.css" rel="stylesheet">
            <link href="<?=base_url()?>assets/opencollege/admin/css/jquery-ui-1.8.23.custom.css" rel="stylesheet">
            <script src="<?=base_url()?>assets/opencollege/admin/js/plugins/modernizr.custom.32549.js"></script>            
        <?
	
	}
	
	
	public function get_assets_for_editor()
    {	
    	?>
        	            
            <link href="<?php echo base_url('assets/css/bootstrap-responsive.min.css');?>" rel="stylesheet" type="text/css" />
            <link type="text/css" href="<?php echo base_url('assets/css/jquery-ui.css');?>" rel="stylesheet" />
            <link type="text/css" href="<?php echo base_url('assets/css/redactor.css');?>" rel="stylesheet" />
            <link type="text/css" href="<?php echo base_url('assets/css/file-browser.css');?>" rel="stylesheet" />
            
            <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.js');?>"></script>
            <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js');?>"></script>
            <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
            <script type="text/javascript" src="<?php echo base_url('assets/js/redactor.min.js');?>"></script>
            <script type="text/javascript" src="<?php echo base_url('assets/js/file-browser.js');?>"></script>         
        <?
	
	}
	
}
?>