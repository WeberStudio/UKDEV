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
                    <h3>Messages</h3>
                    <p class="button"><a class="button"  href="<?php echo base_url().'topics/message_form/'.$topic_id; ?>">Add New Message </a>
                     </p>
                    <section id="comments">
                      <h3>Coversation Area For Tutor And Student</h3>
                      <div class="col12">
                      <ol class="commentlist">
                      
                      <?php  foreach($messages as $message){?>
                      <div class="col12">  
                        <li class="comment even thread-even depth-1">
                          <article id="comment-2" class="clearing-container"> <img alt="" src="<?=base_url().'assets/img/avatar.png'?>" class="avatar avatar-60 photo avatar-default" height="60" width="60">
                             <div class="col9">
                            <header class="comment-author vcard"><?=$this->first_name?> <cite class="fn">( <?=$message->message_user_role?> )</cite>
                              <time datetime="<?=$message->message_time?>"><?=$message->message_time?></time>
                              <p class="button" style="float: right;margin-right: 10px;">
                              <a class="" href="<?=base_url().'topics/message_form/'.$message->topic_id.'/'.$message->message_id.'/reply'?>">Reply</a> 
                               </p>
                              <?php
                            
                             if($message->message_login_id == $user_id ){
                             ?>
                             <p style="float: right;margin-right: 10px;" class="button">
                              <a class="" href="<?=base_url().'topics/message_form/'.$message->topic_id.'/'.$message->message_id?>">Edit</a>
                              </p>
                              <p class="button" style="float: right; margin-right: 10px;">
                              <a class="" href="<?=base_url().'topics/message_delete/'.$message->topic_id.'/'.$message->message_id?>">Delete</a> 
                              </p>
                              <?php }?>                             
                              </header>                              
                             </div>
                             <div class="col12" style="padding: 0px;">
                            <section class="comment">
                              <p><?=$message->message_title?><br>
                                <?=$message->message_message?></p>
                            </section>
                            </div>
                          </article>

                        </li>
                        </div>
                         <?
                      } 
                         ?>
                      </ol>
                      </div>
                    </section>
                  </div>                   
                                                   
                        </div>
                    
                </div> 
            </section>        
            <div class="clear"></div>
        
   <?php include('footer.php')?> 
