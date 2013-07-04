<?php include('mainHeader.php'); ?>
<?php echo theme_css('basee.css', true); ?>
<body class="home page page-template page-template-page-no_top-php theme-onetouch wpb-js-composer js-comp-ver-3.4.12 vc_responsive">
<script> var customStyleImgUrl = "images/custom-slider-img";</script>
<?php //include('leftPanel.php'); ?>
<!--        
-->
<div id="body-wrapper" >
  <div id="body-wrapper-padding">
    <!--[if lt IE 7]>
                <div class="alert">Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different
                browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to
                experience this site.
                </div><![endif]-->
    <?php include('header.php'); ?>
    <div class="row">
    <div class="line"> </div>
    </div>
    <div id="main">
      <div class="container">
        <div id="main_container">
          <div class="row-fluid">
            <?php include('dashboard_leftpanal.php');?>
            <!-- End .span3 -->
            <div class="span6">
              <div class="row">
                <div id="content" class="fifteen columns">
                  <div class="col-1">
                    <h3>My Topics</h3>
                    <a class="button"  href="<?php echo base_url().'Topics/topic_form/'.$form_id; ?>">Add New Topic </a>
                    <table width="100%">
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
            
                            <td><a class="button"  href="<?php echo base_url().'Topics/message_converstion/'.$topic->topic_id; ?>" ><?=$topic->topic_title?></a></td>
                            <td><?=substr($topic->topic_message, 0, 15).'...'?></td>
                            <td><?=$topic->topic_time?></td>
                            <td><?=$topic->topic_status?></td>
                            <td>
                            <div class="btn-group">
                            <?php
							
							 if($topic->topic_login_id == $user_id ){
							 ?>                    
                            <a class="button"  href="<?=base_url().'Topics/topic_form/'.$form_id.'/'.$topic->topic_id?>"> Edit </a>
                            <a class="button" onClick="return confirm('If you delete this order you will not be able to recover it later. Are you sure you want to permanently delete this order?');"  href="<?=base_url().'Topics/topic_delete/'.$form_id.'/'.$topic->topic_id?>"> Remove </a>	
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
            </div>
            <!-- End .span9 -->
          </div>
          <!-- End .row-fluid -->
        </div>
        <!-- End #container -->
      </div>
    </div>
  </div>
</div>
<?php include_once('footer.php'); ?>
</body>
</html>