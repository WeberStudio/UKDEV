<div id="main" style="min-height:1000px">
  <div class="container">
    <? include_once(realpath('.').'/gocart/views/admin/includes/admin_profile.php');?>
     <div id="main_container">
      <div class="row-fluid ">
        <div class="span12">
          <div class="box paint color_24 ">
            <div class="title row-fluid">
              <h4 class="pull-left"><span>Messages
			  <a class="btn" href="<?php echo site_url($this->config->item('admin_folder').'/forums/message_form/'.$topic_id); ?>"><i class="icon-plus-sign"></i>Add New Message </a>
			  </span></h4>
              <!--<div class="btn-toolbar pull-right ">
                <div class="btn-group"> <a class="btn">View All</a> <a class="btn change_color_outside"><i class="paint_bucket"></i></a> </div>
              </div>-->
            </div>
            <!-- End .title -->
			
			
            <div class="content row-fluid">
              <ul class="messages_layout">
			  <!--class="by_myself right"-->
			  <?php 
			  	$count = 0;
			  	echo (count($messages) < 1)?'<div  style="text-align:center;" colspan="8">'.lang('no_forums') .'</div>':''?>
				<?php  foreach($messages as $message){?>
				 <?  
					  	if($count%2==0)
						{
							$class = 'from_user left';
						}
						else
						{
							$class = 'by_myself right';
						}
				?>			  
                <li class="<?=$class?>"> <a href="javascript:void(0)" class="avatar"><img src="<?=base_url().'uploads/images/thumbnails/'.$this->image?>"/></a>
                  <div class="message_wrap"> <span class="arrow"></span>
                    <div class="info"> <a class="name"><?=$this->first_name?></a><br /><span class="time">( posted by <?=$message->message_user_role?> ) <?=$message->message_time?> ago</span>  
					  <div class="options_arrow">
                        <div class="dropdown pull-right"> 
						<a class="dropdown-toggle " id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="../../page.html"> <i class=" icon-caret-down"></i> </a>
                          <ul class="dropdown-menu " role="menu" aria-labelledby="dLabel">
                            <li><a href="<?php echo site_url($this->config->item('admin_folder').'/forums/message_form/'.$message->topic_id.'/'.$message->message_id.'/reply'); ?>"><i class=" icon-share-alt icon-large"></i>Reply</a></li>
                            <li><a href="<?php echo site_url($this->config->item('admin_folder').'/forums/message_form/'.$message->topic_id.'/'.$message->message_id); ?>"><i class=" icon-edit icon-large"></i>Edit</a></li>
                            <li><a href="<?php echo site_url($this->config->item('admin_folder').'/forums/message_delete/'.$message->topic_id.'/'.$message->message_id); ?>"><i class=" icon-trash icon-large" ></i>Delete</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
					 <div class="info"><h1><?=$message->message_title?></h1></div>
                    <div class="text"><?=$message->message_message?></div>
                  </div>
                </li>  
				
				<? 
				$count = $count + 1;
				} 
				?>
				            
              </ul>
            </div>
			<div class="row-fluid control-group">
                <div class="pull-left span6 " action="#"> </div>
                <div class="span6">
                  <div class="pagination pull-right ">
                    <ul>
                      <li><a href="#">Prev</a></li>
                      <li><a href="#">1</a></li>
                      <li><a href="#">2</a></li>
                      <li><a href="#">3</a></li>
                      <li><a href="#">4</a></li>
                      <li><a href="#">Next</a></li>
                    </ul>
                  </div >
                </div>
              </div>
            <!-- End .content --> 
          </div>
		  
          <!-- End .box --> 
        </div>
        <!-- End box -->
		
      </div>
	  
      <!-- End .span12 -->
    </div>
    <!-- End .row-fluid -->
 </div>
