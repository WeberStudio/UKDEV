<?php define('ADMIN_FOLDER', $this->config->item('admin_folder')); 
?>
<div id="main" style="min-height:1000px">
<div class="container">
<? include_once(realpath('.').'/gocart/views/admin/includes/admin_profile.php');?>
<!--========  velidation error start    ==========-->
<?php include('error.php');?>
<!--========  velidation error end   ==========-->
  
  
<div id="main_container">
  <div class="row-fluid">
    <div class="span12">
      <div class="box paint color_18">
        <div class="title">
          <h4> <i class=" icon-bar-chart"></i>Add Forums </h4>
        
        <!-- End .title -->
        <div class="content">	
          <?php echo form_open($this->config->item('admin_folder').'/forums/form/'.$id, array('class' => '', 'id' => 'validateForm')); ?>
 			<div class="form-row control-group row-fluid">
            <label class="control-label span1" for="hint-field">
              Title
              <span class="help-block"></span></label>
            <div class="controls span7">
			<input type="text" class="span12" name="forum_title" value="<?=set_value('forum_title', $forum_title)?>">
            </div>
          </div>
          <div class="control-group row-fluid">
            <label class="control-label span1">Courses<span class="help-block"></span></label>
            <div class="controls span7">
              <select data-placeholder="Select Course For Forum" class="chzn-select"  name="product_id" >
                <option value=""></option>
				<? foreach($products as $product){?>
			    <option value="<?=$product['id']?>" <? if($product['id']==$product_id){ echo "selected";} ?>><?=$product['name']?></option>				
              <? } ?>
			  </select>
            </div>
          </div>
          <div class="control-group row-fluid">
            <label class="control-label span1">For Student<span class="help-block"></span></label>
            <div class="controls span7">
              <select data-placeholder="Select Student For Forum" class="chzn-select"  name="customer_id" >
			   <option value=""></option>
			  	<? foreach($customers as $customer){?>
			    <option value="<?=$customer->id?>" <? if($customer->id==$customer_id){ echo "selected";} ?> ><?=$customer->firstname?></option>				
              <? } ?>
              </select>
			  
            </div>
		 </div>
		  <div class="control-group row-fluid">
            <label class="control-label span1">For Tutor<span class="help-block"></span></label>
            <div class="controls span7">
              <select data-placeholder="Select Tutor For Forum" class="chzn-select" name="tutor_id">
			   <option value=""></option>
                <? foreach($tutors as $tutor){?>
			    <option value="<?=$tutor->tutor_id?>" <? if($tutor->tutor_id==$tutor_id){ echo "selected";} ?>><?=$tutor->firstname?></option>				
              <? } ?>
              </select>
            </div>
          </div>
		  <div class="form-row control-group row-fluid">
			  <label class="control-label span1" for="hint-field">Description <span class="help-block"></span></label>
			  <div class="controls span7">
			  <textarea name="forum_comments" class="redactor"><?=set_value('forum_comments', $forum_comments)?></textarea>
			  </div>
		  </div>		
		  <button type="submit" class="btn btn-inverse btn-block btn-large"><?php echo lang('form_save');?></button>
        </div>
        <!-- End .span4 -->
		  
      </div>
	  <!-------end content------>
      <!-- End .row-fluid --> 
    </div>
    <!-- End #container --> 
  </div>
</div>
</div>
</div>