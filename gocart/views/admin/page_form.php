<?php define('ADMIN_FOLDER', $this->config->item('admin_folder')); 
?>

<div id="main" style="min-height:1000px">
<div class="container">
<? include_once(realpath('.').'/gocart/views/admin/includes/admin_profile.php');?>
<!--========  velidation error start    ==========-->
<?php include('error.php');?>
<!--========  velidation error end   ==========-->
<?php echo form_open_multipart($this->config->item('admin_folder').'/pages/form/'.$id); ?>
<div id="main_container">
  <div class="row-fluid">
    <div class="span12">
      <div class="box paint color_13">
        <div class="title">
          <h4> <i class=" icon-bar-chart"></i>Pages Form </h4>
        </div>
        <!-- End .title -->
		
        <div class="content">
		<ul id="tabExample1" class="nav nav-tabs">
                <li class="active"><a href="#content" data-toggle="tab">Contents</a></li>
                <li><a href="#attributes" data-toggle="tab">Attributes</a></li>
                <li><a href="#seo" data-toggle="tab">SEO</a></li>
              </ul>
		<div class="tab-content">
		<div class="tab-pane fade in active" id="content">
         

      
          <div class="form-row control-group row-fluid">
            <label class="control-label span1" for="hint-field">
              <?php echo lang('title');?><span class="help-block"></span></label>
            <div class="controls span7">
              <?php
			$data	= array('name'=>'title', 'value'=>set_value('title', $title), 'class'=>'span12');
			echo form_input($data); ?>
            </div>
          </div>
          <div class="form-row control-group row-fluid">
            <label class="control-label span1" for="hint-field"><?php echo lang('content');?> <span class="help-block"></span></label>
            <div class="controls span7">
              <?php
					$data	= array('name'=>'content', 'class'=>'redactor', 'value'=>set_value('content', $content));
				echo form_textarea($data);
				?>
            </div>
          </div>
          <div class="form-row control-group row-fluid">
                  <label class="control-label span3" for="search-input">File upload</label>
                  <div class="controls span7">
                    <div class="input-append row-fluid">
                      <input type="file" class="spa1n6 fileinput" id="search-input" name="image">
                      > </div>
                  </div>
                </div>
          </div>
		<div class="tab-pane fade" id="attributes">
			
			<div class="form-row control-group row-fluid">
				<label class="control-label span1" for="hint-field"><?php echo lang('menu_title');?><span class="help-block"></span></label>
				<div class="controls span7">
				 <?php
				 $data	= array('name'=>'manu_title','value'=>set_value('menu_title', $menu_title),'class'=>'span12');
				 echo form_input($data); ?>
				</div>
			</div>
            <div class="form-row control-group row-fluid">
				<label class="control-label span1" for="hint-field"><?php echo lang('old_slug');?><span class="help-block"></span></label>
				<div class="controls span7">
				 <?php
				 $data	= array('name'=>'old_slug', 'value'=>set_value('old_slug', $old_slug), 'class'=>'span12');
				 echo form_input($data); ?>
				</div>
			</div>
			<div class="form-row control-group row-fluid">
				<label class="control-label span1" for="hint-field"><?php echo lang('slug');?><span class="help-block"></span></label>
				<div class="controls span7">
				 <?php
				 $data	= array('name'=>'slug', 'value'=>set_value('slug', $slug), 'class'=>'span12');
				 echo form_input($data); ?>
				</div>
			</div>
			<div class="form-row control-group row-fluid">
				<label class="control-label span1" for="hint-field"> <?php echo lang('parent_id');?> <span class="help-block"></span></label>
				<div class="controls span7">
				<?php
				$options	= array();
				$options[0]	= lang('top_level');
				function page_loop($pages, $dash = '', $id=0)
				{
					$options	= array();
					foreach($pages as $page)
					{
						//this is to stop the whole tree of a particular link from showing up while editing it
						if($id != $page->id)
						{
							$options[$page->id]	= $dash.' '.$page->title;
							$options			= $options + page_loop($page->children, $dash.'-', $id);
						}
					}
					return $options;
				}
				$options	= $options + page_loop($pages, '', $id);
				echo form_dropdown('parent_id', $options, set_value('parent_id', $parent_id) ,'class="chzn-select"', 'id="default-select"');
				?>
				</div>
			</div>
			<div class="form-row control-group row-fluid">
				<label class="control-label span1" for="hint-field"><?php echo lang('sequence');?><span class="help-block"></span></label>
				<div class="controls span7">
				 <?php
				 $data	= array('name'=>'sequence', 'value'=>set_value('sequence', $sequence), 'class'=>'span12');
				 echo form_input($data); ?>
				</div>
			</div>
		 </div>
		<div class="tab-pane fade" id="seo">
			<div class="form-row control-group row-fluid">
					<label class="control-label span1" for="hint-field"><?php echo lang('seo_title');?><span class="help-block"></span></label>
					<div class="controls span8">
					 <?php
					 $data	= array('name'=>'seo_title', 'value'=>set_value('seo_title', $seo_title), 'class'=>'span12');
					 echo form_input($data); ?>
					</div>
         		</div>
			<div class="form-row control-group row-fluid">
				<label class="control-label span1" for="text"><?php echo lang('meta_des');?></label>
				<div class="controls span8">
				  <?php
				$data	= array('rows'=>'3', 'name'=>'meta', 'value'=>set_value('meta', html_entity_decode($meta)), 'class'=>'span12');
				echo form_textarea($data);
				?>
				 </div>
		   </div>
           <div class="form-row control-group row-fluid">
				<label class="control-label span1" for="text"><?php echo lang('meta_key');?></label>
				<div class="controls span8">
				  <?php
				$data	= array('rows'=>'3', 'name'=>'meta_key', 'value'=>set_value('meta_key', html_entity_decode($meta_key)), 'class'=>'span12');
				echo form_textarea($data);
				?>
                <i>ex. &lt;meta name="description" content="comma Separated Keywords" /&gt;</i>
				 </div>
		   </div>
		</div>
		
		
        </div>
        <!-- End .span4 -->
		 <button type="submit" class="btn btn-inverse btn-block btn-large"><?php echo lang('form_save');?></button> 
      </div>
	  </form>
	  <!-------end content------>
      <!-- End .row-fluid --> 
    </div>
    <!-- End #container --> 
  </div>
</div>
</div>
</div>

