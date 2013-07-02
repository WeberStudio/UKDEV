<?php include('mainHeader.php'); ?>
<body class="home page page-template page-template-page-no_top-php theme-onetouch wpb-js-composer js-comp-ver-3.4.12 vc_responsive">

<div id="body-wrapper" >
<div id="body-wrapper-padding">
<?php include('header.php'); ?>
<? //Content Area Start ?>
<div class="page-header">
	<h2><?php echo lang('form_checkout');?></small></h2>
</div>
<div class="line"> </div>	
<?php include('order_details.php');?>
<?php include('summary.php');?>

<div class="row">
	<div class="span12">
		<a class="btn btn-primary btn-large btn-block" href="<?php echo site_url('checkout/place_order');?>"><?php echo lang('submit_order');?></a>
	</div>
</div>
</div>
</div>
<?php include_once('footer.php'); ?>
</body>
</html>