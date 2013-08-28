<?php include('main_header.php')?>   
    <body>
 
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        
        
        <!-- mail grid -->
        <div class="onepcssgrid-1200">
        
            <!-- header -->
            <?php include('header.php')?> 
            <!-- /header -->
            
            <section>
                <div class="onerow">
                  <?php include('dashboard_leftpanal.php')?>      
                        <div class="col8">
                            <div class="">
     <h3>My Fourms</h3>

<table border="2" width="100%">
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
</div>                         </div>
                    
                </div> 
            </section>        
            <div class="clear"></div>
        
   <?php include('footer.php')?> 
