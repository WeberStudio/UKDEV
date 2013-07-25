<?php 
$GLOBALS['option_value_count']        = 0;
?>
<script type="text/javascript">
//<![CDATA[
function remove_option(id)
{
	if(confirm('<?php echo lang('confirm_remove_option');?>'))
	{
		$('#option-'+id).remove();
	}
}

//]]>
</script>
<div id="main">
  <div class="container">
    <? include_once('includes/admin_profile.php');?>
 <!--========  velidation error start    ==========-->
<?php include('error.php');?>
            
 <!--========  velidation error end   ==========-->
    <div id="main_container">
    <?php /*?><?php echo form_open_multipart($this->config->item('admin_folder').'/products/form/'.$id); ?><?php */?>
    <form class="form-horizontal" action="<?=base_url().$this->config->item('admin_folder').'/products/form/'.$id?>" method="post" enctype="multipart/form-data">
      <div class="row-fluid">
        <div class="span12">
          <div class="box paint color_3">
            <div class="title">
              <div class="row-fluid">
                <h4>Course Information </h4>
              </div>
            </div>
            <!-- End .title -->
            <div class="content">
              <ul id="tabExample1" class="nav nav-tabs">
                <li <?php if($active_tabid == ""){echo 'class="active"';}?>><a href="#details" data-toggle="tab"><?php echo lang('details');?></a></li>
                <li><a href="#categories" data-toggle="tab"><?php echo lang('categories');?></a></li>
                <li><a href="#options" data-toggle="tab"><?php echo lang('course_registration_form');?></a></li>
                <li><a href="#related-products" data-toggle="tab"><?php echo lang('related_courses');?></a></li>
                <li><a href="#images" data-toggle="tab"><?php echo lang('images');?></a></li>
                <li <?php if($active_tabid != ""){echo 'class="active"';}?>><a href="#tabs" data-toggle="tab"><?php echo lang('tabs');?></a></li>
              </ul>
              <div class="tab-content">
                <!--TAB ONE START-->
                <div <?php if($active_tabid == ""){echo'class="tab-pane fade in active"';}else{echo 'class="tab-pane fade"';}?>   id="details">
                  <div class="content">
                    <div class="form-row control-group row-fluid">
                      <div class="controls span8">
                           <label for="slug">Course Name </label>
                        <input type="text" id="normal-field" value="<?=set_value('name', $name)?>" name="name" class="row-fluid" placeholder="Course Name">
                      </div>                      
                    </div>
                    <div class="form-row control-group row-fluid">                      
                     <div class="controls span8">
                        <label for="slug">Course Price </label>
                        <?php /*?><input type="text" id="normal-field" value="<?=set_value('name', $price)?>" name="price" class="row-fluid" placeholder="Course Price"><?php */?>
						 <?php
						//echo '<pre>'; print_r($price_options);  
						 $price_op = str_replace(array("[", "]",  '"'),'',$price_options);
                     	 $price_op = explode(',',$price_op);
						?>
						<select data-placeholder="Choose Multiple Price Options" class="chzn-select" name="price_options[]"  id="normal-field" multiple="true" tabindex="5">
                        <? if(isset($all_price_options)){  ?>
                        <?php  
						
						
							foreach ($all_price_options as $price_options)
							{                                   
								if(in_array($price_options['p_option_id'], $price_op))
								{ 				
						
                        ?>
                       <option  selected="selected" value="<?=$price_options['p_option_id']?>"><?=$price_options['p_option_title'].' : '.$price_options['p_option_price']?></option>
                            <? }
							   else                               
								{?>
                       <option  value="<?=$price_options['p_option_id']?>"><?=$price_options['p_option_title'].' : '.$price_options['p_option_price']?></option>
                            <?    }
                             }
                        } 
                         ?>
                        </select>
                     </div>                      
                    </div>
                    
                    <div class="form-row control-group row-fluid">
                       <div class="controls span8">
                       <label for="slug">Select Delivery Charges </label>
                       <?php foreach($all_delivery_option as $delivery_price){
                      	/*print_r($delivery_price);
					    echo $delivery_price['d_option_price'].'=='.$delivery_price;*/
                       }
					   
					   ?>
                      
                       <select data-placeholder="" class="chzn-select" id="" name="delivery_price" >
                       <option value="">Select Delivery Charges</option>

                       <?php if($all_delivery_option!="" && !empty($all_delivery_option)){?>
                       <?php foreach($all_delivery_option as $delivery_price){?>
                                <option <?php if($delivery_price['d_option_price'] == $delivery_p ){ echo 'selected';}?> value="<?php echo $delivery_price['d_option_price'];?>"><?php echo format_currency($delivery_price['d_option_price']);?></option>
                       <?php }}?>                              
                        </select>
                        </div>
                    </div>
                    
                    <div class="form-row control-group row-fluid">
                      <div class="controls span14">
                          <label for="slug">Description </label>
                        <textarea name="description" cols="40" rows="15"  class="redactor" id="elastic-textarea"><?=set_value('description', $description)?></textarea>
                      </div>
                    </div>
                    <div class="form-row control-group row-fluid">
                      <div class="controls span14">
                          <label for="slug">Excerpt </label>
                        <textarea name="excerpt" cols="40" rows="5" class="row-fluid autogrow" id="elastic-textarea" placeholder="Add Excerpt Here...."><?=set_value('excerpt', $excerpt)?></textarea>
                      </div>
                    </div>
                    <h1>SEO Information</h1>
                    <div class="form-row control-group row-fluid">
                      <div class="controls span14">
                      <label for="slug">Old Slug </label>
                        <input type="text" name="old_slug" value="<?=set_value('old_slug', $old_slug)?>" class="span8">
                        <label for="slug">Slug </label>
                        <input type="text" name="slug" value="<?=set_value('slug', $slug)?>" class="span8">
                        <label for="seo_title">Title Tag </label>
                        <input type="text" name="seo_title" value="<?=set_value('seo_title', $seo_title)?>" class="span8">
                        <label for="meta">Meta Description <!--<i>ex. &lt;meta name="description" content="We sell products that help you" /&gt;</i>--></label>
                        <textarea name="meta"  cols="40" rows="7" class="row-fluid autogrow" id="elastic-textarea"><?=set_value('meta', html_entity_decode($meta))?></textarea>
                        <label for="meta">Meta Keywords </label>
                        <textarea name="meta_key"  cols="10" rows="3" class="row-fluid autogrow" id="elastic-textarea"><?=set_value('meta_key', html_entity_decode($meta_key))?></textarea>
                        <i>ex. &lt;meta name="description" content="comma Separated Keywords" /&gt;</i>
                        
                      </div>
                    </div>
                    
                  </div>
                  <div class="form-row control-group row-fluid ">
                  <h1>Course Status</h1>
                  <div class="controls span3">
                    <div class="row-fluid">
                      <div class="pull-left">
                        <label class="radio off">
                          <input type="radio" name="enabled" id="toggle1-off" value="off" <?php if($publish_by_super== 0){echo 'checked="true"';}?> >
                        </label>
                        <label class="radio on">
                          <input type="radio" name="enabled" id="toggle1-on" value="on" <?php if($publish_by_super== 1){echo 'checked="true"';}?>  >
                        </label>
                        <div class="toggle">
                          <div class="yes"> ON </div>
                          <div class="switch"> </div>
                          <div class="no"> OFF </div>
                        </div>
                      </div>                      
                    </div>
                  </div>
                </div>
                </div>
                
                <!-- TAB ONE END-->
                <!-- TAB TWO START-->
                <div class="tab-pane fade" id="categories">
                  <div class="content">
                    <div class="form-row control-group row-fluid">
                      <label class="control-label span3" for="inputEmail"><span class="help-block"></span></label>
                      <div class="controls span14">
                      <label for="slug">Choose Multiple Categories For Course </label>
                      <? 
                          //$this->show->pe($product_categories);
                        //echo $product_categories[0]->category_id.'----------'.$product_categories[1]->category_id;
                      ?>
                        <select data-placeholder="Choose Multiple Categories For Course" class="chzn-select" name="categories[]" multiple="true" tabindex="5">
                        <? if(isset($all_categories)){  ?>
                        <?php  foreach ($all_categories as $file){
                                $flag = 0;
                                //$this->show->pe($file);
                                for($i = 0; $i<count($all_categories); $i++){
                                    if(isset($product_categories[$i]->category_id) && $product_categories[$i]->category_id==$file['id']){ 
                                    $flag = 1;
                        ?>
                                      <option selected="selected" value="<?=$file['id']?>"><?=$file['name']?></option>
                            
                         <?php //$i++;
                                     break;
                                    }
                                    
                                  }
                                if($flag==0)
                                {?>
                                    <option  value="<?=$file['id']?>"><?=$file['name']?></option>
                            <?    }
                             }
                        } 
                         ?>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- TAB TWO END-->
                <!-- TAB THREE START-->
                <div class="tab-pane fade" id="options">
                  <div class="content">
                    <div class="form-row control-group row-fluid">
                       <div class="controls span10">
                       <label for="slug">Select Options For Courses</label>
                       <select data-placeholder="Choose Multiple Categories For Course" class="chzn-select" id="option_options" >
                                <option value=""><?php echo lang('select_option_type');?></option>
                                <option value="checklist"><?php echo lang('checklist');?></option>
                                <option value="radiolist"><?php echo lang('radiolist');?></option>
                                <option value="droplist"><?php  echo lang('droplist');?></option>
                                <option value="textfield"><?php echo lang('textfield');?></option>
                                <option value="textarea"><?php  echo lang('textarea');?></option>                                
                        </select>
                        </div>
                        <div class="controls span2">
                        <input id="add_option" class="btn" type="button" value="<?php echo lang('add_option');?>" style="margin:0px;"/>
                        </div>
                      </div>
                      <div class="row">
                            <div class="span8">
                                <table class="table table-striped"  id="options_container">
                                    <?php
                                    $counter    = 0;
                                    if(!empty($product_options))
                                    
                                    {
                                        foreach($product_options as $po)
                                        {
                                            $po    = (object)$po;
                                            if(empty($po->required)){$po->required = false;}
        
                                            add_option($po, $counter);
                                            $counter++;
                                        }
                                    }?>
                                        
                                </table>
                            </div>
                        </div>                    
                    </div>
                  </div>
                <!-- TAB THREE END-->
                <!-- TAB FOUR START-->
                <div class="tab-pane fade" id="related-products">
                  <div class="content">
                    <div class="form-row control-group row-fluid">
                      <div class="controls span14">
                      <label for="slug">Choose Multiple Related Courses</label>
                      <? 
                      $new_item = str_replace(array("[", "]",  '"'),'',$prelated);
                      $new_item = explode(',',$new_item);
                      //echo"<pre>";print_r($new_item);
                      //exit; ?>
                        <select data-placeholder="Choose Multiple Related Courses" class="chzn-select" name="related_products[]" multiple="" tabindex="5">
                            <? if(isset($all_products)){ 
                                foreach ($all_products as $file):                                    
                                    if(in_array($file['id'], $new_item)){                                     
                                    ?>
                                            <option selected="selected" value="<?=$file['id']?>"><?=$file['name']?></option>
                                    <? } 
                                    else
                                    { ?>    
                                            
                                            <option value="<?=$file['id']?>"><?=$file['name']?></option>
                                    <? } ?>
                             <?php endforeach; ?>
                            <? } ?>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- TAB FOUR END-->
                
                <!-- TAB FIVE START-->
                                
                <div class="tab-pane fade" id="images">
                <div class="content">
                  <div class="form-row control-group row-fluid">
                      <label for="slug">Upload Image For Course</label>
                      <label class="control-label span2" for="search-input">File upload</label>
                      <div class="controls span7">
                        <div class="input-append row-fluid">
                          <!--<input type="file" class="spa1n6 fileinput" name="image" id="search-input">     -->
                          <a class="various" data-fancybox-type="iframe" href="<?=base_url()?>admin/media/">
                            <div class="uneditable-input spa1n6 fileinput" aria-hidden="true"><span>choose a file...</span></div>
                          </a>
                         </div>
                        <input type="hidden" name="media_image" id="media_image">
                        <input type="hidden" name="image_path" id="image_path">
                        <input type="file" class="spa1n6 fileinput customfile-input" disabled="disabled" value="" id="unique_image_id" />
                      </div>
                  </div>
                    <?php if(!empty($images) && $images != ''):?>

                    <div style="text-align:center; padding:5px; border:1px solid #ddd;"><img src="<?php echo base_url('uploads/images/small/'.$images);?>" alt="current"/><br/><?php echo lang('current_file');?></div>

                    <?php endif;?>
                    
                    <label for="image title"> Image Title </label>
                    <?php
                    $data	= array('name'=>'img_title','value'=>set_value('img_title', $img_title), 'class'=>'span8');
                    echo form_input($data);?>
                    
                    <label for="image title"> Image Alt </label>
                    <?php
                    $data	= array('name'=>'img_alt','value'=>set_value('img_alt', $img_alt), 'class'=>'span8');
                    echo form_input($data);?>
                    
                     <label for="image title"> Image URL </label>
                    <?php
                    $data	= array('name'=>'img_url', 'value'=>set_value('img_url', $img_url), 'class'=>'span8');
                    echo form_input($data);?>
                    
                     <label for="image title"> Image Description </label>
                    <?php
                    $data	= array('name'=>'img_des', 'value'=>set_value('img_des', $img_des), 'class'=>'span8');
                    echo form_textarea($data);?> 
                 </div> 
     			</div>
                <!-- TAB FIVE END-->
                
                <!-- TAB SIX START-->
                <div  <?php if($active_tabid != ""){echo'class="tab-pane fade in active"';}else{echo 'class="tab-pane fade"';}?>  id="tabs">
                  <div class="content">
                    <div class="form-row control-group row-fluid">                      
                     <div class="controls span8">
                          <label for="slug">Ebter Tabs For Course Details</label>
                          <label for="slug"><?php echo lang('tab_title');?></label>
                        <input type="text" id="tab_title" value="<?=set_value('tab_title', $tab_title)?>" name="tab_title" class="row-fluid" >
                     </div>                      
                    </div>
                    <div class="form-row control-group row-fluid">
                      <div class="controls span14">
                      <label for="slug">Tab Description</label>
                        <textarea name="tab_content" cols="40" rows="15"  class="redactor" id="tab_content"><?=set_value('tab_content', $tab_content)?></textarea>
                      </div>
                    </div> 
                      <?php
                    //$this->show->pe($all_tabs);exit;
                    if(!empty($all_tabs))                    
                    {
                    ?>
                    <input type="hidden" name="tab_id" value="<?=set_value('tab_id', $tab_id)?>" />
                    <table id="datatable_example" class="responsive table table-striped table-bordered" style="width:100%;margin-bottom:0; ">
                    <thead>
                      <tr>                        
                        <th >Tab Title</th>                
                        <th class="ms no_sort ">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?    
                        foreach($all_tabs as $tab)
                        {
                    ?>    
                             <tr>
                                <td>
                                    <label class="title "><?=$tab['tab_title']?></label>
                                </td>
                                 <td class="ms">
                                 <div class="btn-group1">
                                     <a class="btn btn-small"  rel="tooltip" data-placement="left" data-original-title="<?php echo lang('edit');?>" href="<?php echo  site_url($this->config->item('admin_folder').'/products/form/'.$id.'/0/'.$tab['tab_id']);?>"> <i class="gicon-edit"></i> </a>
                                    <a class="btn  btn-small" rel="tooltip" data-placement="bottom" data-original-title="<?php echo lang('delete');?>" href="<?php echo  site_url($this->config->item('admin_folder').'/products/delete_tab/'.$id.'/'.$tab['tab_id']);?>" onclick="return areyousure();"> <i class="gicon-remove "></i> </a> 
                                 </div>
                                 </td>
                            </tr>
                    <?    }
                    }?>
                      </tbody>
                      </table>                                    
                  </div>              
                </div>
                <!-- TAB SIX END-->                
              </div>
              
              <button class="btn btn-inverse btn-block btn-large" rel="tooltip" data-placement="top" data-original-title="Save Course Info"><b><?php echo lang('form_save');?></b></button>
              
            </div>
            <!-- End .content -->
          </div>
          <!-- End  .box -->
        </div>
        
      </div>
      
    </form>
   </div>
    <!-- End #container --> 
  </div>
  <script type="text/javascript">
    
    $( "#add_option" ).click(function(){
        if($('#option_options').val() != '')
        {
            add_option($('#option_options').val());
            $('#option_options').val('');
        }
    });
    
    function add_option(type)
    {
        //increase option_count by 1
        option_count++;
        
        <?php
        $value            = array(array('name'=>'', 'value'=>'', 'weight'=>'', 'price'=>'', 'limit'=>''));
        $js_textfield    = (object)array('name'=>'', 'type'=>'textfield', 'required'=>false, 'values'=>$value);
        $js_textarea    = (object)array('name'=>'', 'type'=>'textarea', 'required'=>false, 'values'=>$value);
        $js_radiolist    = (object)array('name'=>'', 'type'=>'radiolist', 'required'=>false, 'values'=>$value);
        $js_checklist    = (object)array('name'=>'', 'type'=>'checklist', 'required'=>false, 'values'=>$value);
        $js_droplist    = (object)array('name'=>'', 'type'=>'droplist', 'required'=>false, 'values'=>$value);
        
        if (function_exists('add_option')) {
        ?>
        
        if(type == 'textfield')
        {
            $('#options_container').append('<?php add_option($js_textfield, "'+option_count+'");?>');
        }
        else if(type == 'textarea')
        {
            $('#options_container').append('<?php add_option($js_textarea, "'+option_count+'");?>');
        }
        else if(type == 'radiolist')
        {
            $('#options_container').append('<?php add_option($js_radiolist, "'+option_count+'");?>');
        }
        else if(type == 'checklist')
        {
            $('#options_container').append('<?php add_option($js_checklist, "'+option_count+'");?>');
        }
        else if(type == 'droplist')
        {
            $('#options_container').append('<?php add_option($js_droplist, "'+option_count+'");?>');
        }
        <? } ?>
    }
    
    function add_option_value(option)
    {
        
        option_value_count++;
        <?php
        $js_po    = (object)array('type'=>'radiolist');
        $value    = (object)array('name'=>'', 'value'=>'', 'weight'=>'', 'price'=>'');
        
        if (function_exists('add_option')) {
        ?>
        $('#option-items-'+option).append('<?php add_option_value($js_po, "'+option+'", "'+option_value_count+'", $value);?>');
        
        <? } ?>
    }
        j = jQuery.noConflict() ; 
    j(document).ready(function(){
        j('body').on('click', '.option_title', function(){
            j(j(this).attr('href')).slideToggle();
            return false;
        });
        
        j('body').on('click', '.delete-option-value', function(){
            if(confirm('<?php echo lang('confirm_remove_value');?>'))
            {
                j(this).closest('.option-values-form').remove();
            }
        });
        
        
        
        $('#options_container').sortable({
            axis: "y",
            items:'tr',
            handle:'.handle',
            forceHelperSize: true,
            forcePlaceholderSize: true
        });
        
        $('.option-items').sortable({
            axis: "y",
            handle:'.handle',
            forceHelperSize: true,
            forcePlaceholderSize: true
        });
        
        
         var funcNode = ''  ;
         var foldername = '';
        j(".various").fancybox({
            maxWidth    : 800,
            maxHeight    : 600,
            fitToView    : false,
            width        : '70%',
            height        : '70%',
            autoSize    : false,
            openEffect    : 'none',
            closeEffect    : 'none',
            beforeClose:function(){
               
             funcNode    = j(".fancybox-iframe").contents().find("#insert-filename").val();
             foldername  = j(".fancybox-iframe").contents().find("#folder-name").val();
              //console.log(funcNode)
              j(".uneditable-input").html("<span>"+foldername+"</span>");
               document.getElementById('media_image').value = funcNode;
               document.getElementById('image_path').value  = foldername;
            },
            afterClose:function(){
               // alert("shahid")
                //document.getElementById('unique_image_id').disabled = false;
               
            }
        });
    });
    </script>
    <style type="text/css">
        .option-form {
            display:none;
            margin-top:10px;
        }
        .option-values-form
        {
            background-color:#fff;
            padding:6px 3px 6px 6px;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            margin-bottom:5px;
            border:1px solid #ddd;
        }
        
        .option-values-form input {
            margin:0px;
        }
        .option-values-form a {
            margin-top:3px;
        }
    </style>

<?php
/***********  Some Important Function Area*********************/

function add_option($po, $count)
{
    ob_start();
    ?>
    <tr id="option-<?php echo $count;?>">
        <td>
            <a class="handle btn btn-mini"><i class="icon-align-justify"></i></a>
            <strong><a class="option_title" href="#option-form-<?php echo $count;?>"><?php echo $po->type;?> <?php echo (!empty($po->name))?' : '.$po->name:'';?></a></strong>
            <button type="button" class="btn btn-mini btn-danger pull-right" onClick="remove_option(<?php echo $count ?>);"><i class="gicon-trash"></i></button>
            <input type="hidden" name="option[<?php echo $count;?>][type]" value="<?php echo $po->type;?>" />
            <div class="option-form" id="option-form-<?php echo $count;?>">
                <div class="row-fluid">
                
                    <div class="span5">
                        <input type="text" class="span10" placeholder="<?php echo lang('option_name');?>" name="option[<?php echo $count;?>][name]" value="<?php echo $po->name;?>"/>
                    </div>
                    
                    <div class="span3" style="text-align:right;">
                        <input class="checkbox" type="checkbox" name="option[<?php echo $count;?>][required]" value="1" <?php echo ($po->required)?'checked="checked"':'';?>/> <?php echo lang('required');?>
                    </div>
                </div>
                <?php if($po->type!='textarea' && $po->type!='textfield'):?>
                <div class="row-fluid">
                    <div class="span12">
                        <a class="btn" onClick="add_option_value(<?php echo $count;?>);"><?php echo lang('add_item');?></a>
                    </div>
                </div>
                <?php endif;?>
                <div style="margin-top:10px;">

                    <div class="row-fluid">
                        <?php if($po->type!='textarea' && $po->type!='textfield'):?>
                        <div class="span1">&nbsp;</div>
                        <?php endif;?>
                        <div class="span5"><strong>&nbsp;&nbsp;<?php echo lang('name');?></strong></div>
                        <div class="span4"><strong>&nbsp;<?php echo lang('value');?></strong></div>
                        <div class="span2"><strong>&nbsp;<?php echo ($po->type=='textfield')?lang('limit'):'';?></strong></div>
                    </div>
                    <div class="option-items" id="option-items-<?php echo $count;?>">
                    <?php if($po->values):?>
                        <?php
                        foreach($po->values as $value)
                        {
                            $value = (object)$value;
                            add_option_value($po, $count, $GLOBALS['option_value_count'], $value);
                            $GLOBALS['option_value_count']++;
                        }?>
                    <?php endif;?>
                    </div>
                </div>
            </div>
        </td>
    </tr>
    
    <?php
    $stuff = ob_get_contents();

    ob_end_clean();
    
    echo replace_newline($stuff);
}

function add_option_value($po, $count, $valcount, $value)
{
    ob_start();
    ?>
    <div class="option-values-form">
        <div class="row-fluid">
            <?php if($po->type!='textarea' && $po->type!='textfield'):?><div class="span1"><a class="handle btn btn-mini" style="float:left;"><i class="icon-align-justify"></i></a></div><?php endif;?>
            <div class="span5"><input type="text" class="span12" name="option[<?php echo $count;?>][values][<?php echo $valcount ?>][name]" value="<?php echo $value->name ?>" /></div>
            <div class="span3"><input type="text" class="span12" name="option[<?php echo $count;?>][values][<?php echo $valcount ?>][value]" value="<?php echo $value->value ?>" /></div>
            <div class="span2">
            <?php if($po->type=='textfield'):?><input class="span12" type="text" name="option[<?php echo $count;?>][values][<?php echo $valcount ?>][limit]" value="<?php echo $value->limit ?>" />
            <?php elseif($po->type!='textarea' && $po->type!='textfield'):?>
                <a class="delete-option-value btn btn-danger btn-mini pull-right"><i class="gicon-trash"></i></a>
            <?php endif;?>
            </div>
        </div>
    </div>
    <?php
    $stuff = ob_get_contents();

    ob_end_clean();

    echo replace_newline($stuff);
}
//this makes it easy to use the same code for initial generation of the form as well as javascript additions
function replace_newline($string) {
  return trim((string)str_replace(array("\r", "\r\n", "\n", "\t"), ' ', $string));
}
?>

<script type="text/javascript">
//<![CDATA[
var option_count        = <?=$counter?> ;
var option_value_count    = <?=$GLOBALS['option_value_count']?> ;
     
//]]>
</script>