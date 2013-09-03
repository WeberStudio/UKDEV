<div class="header row-fluid">
      <div class="logo"> <a href="<? echo site_url($this->config->item('admin_folder')); ?>"><span>Start</span><span class="icon"></span></a> </div>
      <?    $imageurl = realpath('.')."\uploads\images\small\\".$this->image;  ?>
      <div class="top_right">
        <ul class="nav nav_menu">
          <li class="dropdown"> <a class="dropdown-toggle administrator" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="#">
            <div class="title"><span class="name"><?=$this->first_name.' '.$this->last_name?></span><span class="subtitle">System Admin</span></div>
            <?php 
			if(file_exists($imageurl) && $this->image!=''){ ?>            
            <span class="icon"><img src="<?=base_url()?>uploads/images/thumbnails/<?=$this->image?>"></span>
            <?php }else {?>
            <span class="icon"><img src="<?=base_url()?>assets/opencollege/admin/img/no-person.png"></span>
            <? } ?>
            </a>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
              <li><a href="<?=base_url()?>admin/admin/form/<?=$this->admin_id?>"><i class=" icon-user"></i> My Profile</a></li>
              <!--<li><a href="forms_general.html"><i class=" icon-cog"></i>Settings</a></li>-->
              <li><a href="<?php echo site_url($this->config->item('admin_folder').'/login/logout');?>"><i class=" icon-unlock"></i><?php echo lang('common_log_out') ?></a></li>
              <li><a href="<?=base_url()?>"><i class=" icon-flag"></i>Help</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <!-- End top-right --> 
</div>