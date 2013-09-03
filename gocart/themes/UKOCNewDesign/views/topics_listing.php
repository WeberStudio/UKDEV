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
                                <h3>My Topics</h3>
                                <p style="margin-bottom: 10px;" class="button"><a class=""  href="<?php echo base_url().'topics/topic_form/'.$form_id; ?>">Add New Topic </a></p>
                                <table border="1" width="100%">
                                  <thead>
                                    <tr>
                                      <!--<th><input type="checkbox" id="gc_check_all" /> <button type="submit" class="btn btn-small btn-danger"><i class="icon-trash icon-white"></i></button></th>-->
                                      <th>Topic</th>
                                      <th>Message</th>
                                      <th>Last post</th>
                                      <th>Status</th>
                                      <th>oprations</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php //echo (count($orders) < 1)?'<tr><td style="text-align:center;" colspan="8">'.lang('no_orders') .'</td></tr>':''?>
                                    <?php 
                
                
                                        //$this->show->pe($topics);exit;
                                    foreach($topics as $topic):   
                                    ?>
                                        <tr>
                        
                                        <td>
                                        <p class="button"><a class="button"  href="<?php echo base_url().'topics/message_converstion/'.$topic->topic_id; ?>" ><?=$topic->topic_title?></a>
                                        </p>
                                        </td>
                                        <td><?=substr($topic->topic_message, 0, 15).'...'?></td>
                                        <td><?=$topic->topic_time?></td>
                                        <td><?=$topic->topic_status?></td>
                                        <td>
                                        <div class="btn-group">
                                        <?php
                                        
                                         if($topic->topic_login_id == $user_id ){
                                         ?>                    
                                        <p class="button" style="margin-right: 10px;"><a class=""  href="<?=base_url().'topics/topic_form/'.$form_id.'/'.$topic->topic_id?>"> Edit </a>
                                        </p>
                                        <p class="button">
                                        <a class="button" onClick="return confirm('If you delete this order you will not be able to recover it later. Are you sure you want to permanently delete this order?');"  href="<?=base_url().'topics/topic_delete/'.$form_id.'/'.$topic->topic_id?>"> Remove </a>    
                                         </p>
                                        <?php }?>
                                        </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                  </tbody>
                                </table>
                                                   
                             </div>                       
                        </div>
                    
                </div> 
            </section>        
            <div class="clear"></div>
        
   <?php include('footer.php')?> 
