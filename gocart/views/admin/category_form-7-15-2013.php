<div id="main" style="min-height:1000px">
  <div class="container">
    <? include_once('includes/admin_profile.php');?>
<!--========  velidation error start    ==========-->
<?php include('error.php');?>
            
<!--========  velidation error end   ==========-->
    <div id="main_container">
        <div class="row-fluid">
            <div class="span12">
              <div class="box paint color_5">
            
                <div class="title">
                  <div class="row-fluid">
                    <h4> Category Form</h4>
                  </div>
                </div>
				                
                <div class="content">
				
				<?php echo form_open_multipart($this->config->item('admin_folder').'/categories/form/'.$id); ?>
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#description_tab" data-toggle="tab"><?php echo lang('description');?></a></li>
                        <li><a href="#attributes_tab" data-toggle="tab"><?php echo lang('attributes');?></a></li>
                        <li><a href="#seo_tab" data-toggle="tab"><?php echo lang('seo');?></a></li>
                    </ul>
                
                    <div class="tab-content">
                        <div class="tab-pane active" id="description_tab">
                            
                            <fieldset>
                                <label for="name"><?php echo lang('name');?></label>
                                <?php
                                $data	= array('name'=>'name', 'value'=>set_value('name', $name), 'class'=>'span8');
                                echo form_input($data);
                                ?>
                                
                                <label for="description"><?php echo lang('description');?></label>
                                <?php
                                $data	= array('name'=>'description', 'class'=>'redactor', 'value'=>set_value('description', $description));
                                echo form_textarea($data);
                                ?>
                            </fieldset>
                            <div class="form-row control-group row-fluid ">
                              <h3>Category Status (Publish/ Unpublish)</h3>
                              <div class="controls span3">
                                <div class="row-fluid">
                                  <div class="pull-left">
                                  
                                    <label class="radio off">
                                      <input type="radio" name="enabled" id="toggle1-off" value="off" <?php if($publish_by_super== 0){echo 'checked="true"';}?> >
                                    </label>
                                    <label class="radio on">
                                      <input type="radio" name="enabled" id="toggle1-on" value="on" <?php if($publish_by_super== 1){echo 'checked="true"';}?>  >
                                    </label>
                                    <div class="toggle off">
                                      <div class="yes"> Yes </div>
                                      <div class="switch"> </div>
                                      <div class="no"> No </div>
                                    </div>
                                  </div>                      
                                </div>
                              </div>
                            </div>
                        </div>
                
                        <div class="tab-pane fade"id="attributes_tab">
                            
                            <fieldset>
                            	<label for="slug"><?php echo lang('old_slug');?> </label>
                                <?php
                                $data	= array('name'=>'old_slug', 'value'=>set_value('old_slug', $old_slug), 'class'=>'span8');
                                echo form_input($data);
                                ?>
                                <label for="slug"><?php echo lang('slug');?> </label>
                                <?php
                                $data	= array('name'=>'slug', 'value'=>set_value('slug', $slug), 'class'=>'span8');
                                echo form_input($data);
                                ?>
                                
                                <label for="sequence"><?php echo lang('sequence');?> </label>
                                <?php
                                $data	= array('name'=>'sequence', 'value'=>set_value('sequence', $sequence), 'class'=>'span8');
                                echo form_input($data);
                                ?>
                                <div class="form-row control-group row-fluid">
                       			<div class="controls span8">
                                <label for="slug"><?php echo lang('parent');?> </label>
                                <?php
                                $data	= array(0 => 'Top Level Category');
                                foreach($categories as $parent)
                                {
                                    if($parent->id != $id)
                                    {
                                        $data[$parent->id] = $parent->name;
                                    }
                                }
                                echo form_dropdown('parent_id', $data, $parent_id,  "class='chzn-select'");
                                ?>
                                </div></div>
                                <label for="excerpt"><?php echo lang('excerpt');?> </label>
                                <?php
                                $data	= array('name'=>'excerpt', 'value'=>set_value('excerpt', $excerpt), 'class'=>'span12', 'rows'=>3);
                                echo form_textarea($data);
                                ?>
                				
                                <label for="image">Upload <?php echo lang('image');?> </label>
                                <div class="form-row control-group row-fluid">
                                  <div class="controls span7">
                                       <div class="input-append row-fluid">
                                      <div class="uploader" id="uniform-search-input">
                                        <div class="customfile">
                                              <a class="various" class="spa1n6 fileinput customfile-input" data-fancybox-type="iframe" href="<?=base_url()?>admin/media/">
                                              <div class="uneditable-input spa1n6 fileinput" aria-hidden="true"><span>choose a file...</span></div>
                                              </a>  
                                        </div>
                                        <input type="hidden" name="media_image" id="media_image">
                                        <input type="hidden" name="image_path" id="image_path">
                                        <input type="file" class="spa1n6 fileinput customfile-input" disabled="disabled" value="" id="unique_image_id" />
                                      </div>
                                   </div>
                                      
                                   
                                 </div>
                               </div>
                                <?php if($id && $image != ''):?>
                                
                                <div style="text-align:center; padding:5px; border:1px solid #ddd;"><img src="<?php echo base_url('uploads/images/small/'.$image);?>" alt="current"/><br/><?php echo lang('current_file');?></div>
                                
                                <?php endif;?>
                                
                            </fieldset>
                            
                        </div>
                        
                        <div class="tab-pane" id="seo_tab">
                            <fieldset>
                                <label for="seo_title"><?php echo lang('seo_title');?> </label>
                                <?php
                                $data	= array('name'=>'seo_title', 'value'=>set_value('seo_title', $seo_title), 'class'=>'span12');
                                echo form_input($data);
                                ?>
                                
                                <label><?php echo lang('meta_des');?></label> 
                                <?php
                                $data	= array('rows'=>3, 'name'=>'meta', 'value'=>set_value('meta', html_entity_decode($meta)), 'class'=>'span12');
                                echo form_textarea($data);
                                ?>
                                  <label><?php echo lang('meta_key');?></label> 
                                <?php
                                $data	= array('rows'=>3, 'name'=>'meta_key', 'value'=>set_value('meta_key', html_entity_decode($meta_key)), 'class'=>'span12');
                                echo form_textarea($data);
                                ?>
                               <i>ex. &lt;meta name="description" content="comma Separated Keywords" /&gt;</i>
                            </fieldset>
                        </div>
                    </div>
                     
                    <button type="submit" class="btn btn-inverse btn-block btn-large"><?php echo lang('form_save');?></button>
                  
                  </form>
                </div>
                
              </div>
            </div>    
        </div>
	</div>
</div>


<script type="text/javascript">

j = jQuery.noConflict() ;
j('form').submit(function() {
	j('.btn').attr('disabled', true).addClass('disabled');
});
 var funcNode = ''
 var foldername = ''
j(document).ready(function() {
    j (".various").fancybox({
        maxWidth    : 800,
        maxHeight    : 600,
        fitToView    : false,
        width        : '70%',
        height        : '70%',
        autoSize    : false,
        openEffect    : 'none',
        closeEffect    : 'none',
        beforeClose:function(){
           
         funcNode    = $(".fancybox-iframe").contents().find("#insert-filename").val();
         foldername  = $(".fancybox-iframe").contents().find("#folder-name").val();
          //console.log(funcNode)
          $(".uneditable-input").html("<span>"+foldername+"</span>")
           document.getElementById('media_image').value = funcNode;
           document.getElementById('image_path').value  = foldername;
        },
        afterClose:function(){
           // alert("shahid")
            //document.getElementById('unique_image_id').disabled = false;
           
        }
                       
       
    });
    
    
    
   // window.setInterval(function(){alert(greeting);},6000)
});
</script>