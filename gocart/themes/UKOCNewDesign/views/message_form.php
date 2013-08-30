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
                    <h3>Add New Message</h3>
                   <?php 
         
                      if(empty($reply))
                      {
                                
                        echo form_open('/topics/message_form/'.$topic_id.'/'.$id, array('class' => '', 'id' => 'validateForm')); 
                      }
                      else
                      {              
                        echo form_open('/topics/message_form/'.$topic_id, array('class' => '', 'id' => 'validateForm'));
                      }
                      ?>
                    <table width="100%">
                      <tbody>
                        <tr>
                            <td>
                            <div class="col3">
                                <label class="control-label span1" for="hint-field">Title</label>
                             </div>
                             <div class="col12">  
                               <input type="text" class="redactor" name="message_title" value="<?=set_value('message_title', $message_title)?>">      
                             </div>
                            </td>                 
                        </tr>
                        
                        <tr>
                            <td>
                            <div class="col3"> 
                                <label class="control-label span1" for="hint-field">Message</label>
                                </div>
                             <div class="col12">  
                                 <textarea rows="3" cols="80" name="message_message" class="redactor" ><?=set_value('message_message', $message_message)?></textarea> 
                             </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input class="submitbutton" name="submitted" id="wp-submit" value="Save" type="submit">
                            </td>
                        </tr>
                     </tbody>
                    </table>
                  </div>                 
                                                   
                        </div>
                    
                </div> 
            </section>        
            <div class="clear"></div>
        
   <?php include('footer.php')?> 
