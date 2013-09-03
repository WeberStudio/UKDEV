 <?php include('main_header.php'); ?>
  <?php echo theme_css('basee.css', true); ?> 
<body class="home page page-template page-template-page-no_top-php theme-onetouch wpb-js-composer js-comp-ver-3.4.12 vc_responsive">
        <script> var customStyleImgUrl = "images/custom-slider-img";</script>
          <?php //include('leftPanel.php'); ?>
<!--        
-->		
        <div id="body-wrapper" >		
            <div id="body-wrapper-padding">			
                <!--[if lt IE 7]>
                <div class="alert">Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different
                browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to
                experience this site.
                </div><![endif]-->
                 <?php include('header.php'); ?> 
                  <div class="row">
					<div class="line"></div>
				</div>
               
<div id="main">
  <div class="container">
        
    <div id="main_container">
      <div class="row-fluid">
        <?php include('dashboard_leftpanal.php');?>
        <!-- End .span3 -->
        
        <div class="span9" style="width: 960px;">
          
                  
         
	<!--<div class="span12" style="border-bottom:1px solid #f5f5f5;">
		<div class="row">
			
				<?php ////echo $this->pagination->create_links();?>	
			
			<div class="span11">
				<?php //echo form_open($this->config->item('admin_folder').'/orders/index', 'class="form-inline" style="float:right"');?>
					<fieldset>
						<input id="start_top"  value="" class="span3" type="text" placeholder="Start Date"/>
						<input id="start_top_alt" type="hidden" name="start_date" />
						<input id="end_top" value="" class="span3" type="text"  placeholder="End Date"/>
						<input id="end_top_alt" type="hidden" name="end_date" />
				
						<input id="top" type="text" class="span3" name="term" placeholder=" term<?php //echo lang('term')?>" /> 
						
						<input type="button" class="button" name="" value="search"/><?php ////echo lang('search')?>
						<input type="button" class="button" name="" value="export"/><?php ////echo lang('xml_export')?>
					</fieldset>
				</form>
			</div>
		</div>
	</div>-->

<div class="row">
<div id="content" class="fifteen columns">
<div class="col-1">
 	<h3>My Fourms</h3>

<table width="100%">
    <thead>
		<tr>
			<!--<th><input type="checkbox" id="gc_check_all" /> <button type="submit" class="btn btn-small btn-danger"><i class="icon-trash icon-white"></i></button></th>-->
			<th>Title</th>
			<th><?php //echo lang('name');?> Course</th>
			
			<th>Tutor</th>
			<th>Status</th>
			
	    </tr>
	</thead>

    <tbody>
	<?php //echo (count($orders) < 1)?'<tr><td style="text-align:center;" colspan="8">'.lang('no_orders') .'</td></tr>':''?>
    <?php 
	
	
	
	foreach($forums as $forum): 
	
	
	?>
	<tr>
		<!--<td><input type="checkbox" id="gc_check_all" /></td>-->
		<td><a class="button"  href="<?=base_url().'dashboard/topic_view/'.$forum->forum_id?>" ><?php echo $forum->forum_title;?></a></td>
		<td style="white-space:nowrap"><?php echo $forum->name;?> </td>
		
      
		<td style="white-space:nowrap"> <?php echo $forum->firstname." ".$forum->lastname;?></td>
       
		<td><?php if($forum->forum_status == '1'){echo "Active";};?></td>
	</tr>
	
    <?php endforeach; ?>
    </tbody>
</table>
</div>
</div>
</div>

        </div>
        <!-- End .span9 --> 
      </div>
      <!-- End .row-fluid --> 
      
    </div>
    <!-- End #container --> 
  </div>
 
</div>
            </div>
        </div>
        <?php include_once('footer.php'); ?> 
        
       
    </body>
</html>
