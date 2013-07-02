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
                    <h3>Messages</h3>
                    <a class="button"  href="<?php echo base_url().'topics/message_form/'.$topic_id; ?>">Add New Message </a>
                    <section id="comments">
                      <h3>Coversation Area For Tutor And Student</h3>
                      <ol class="commentlist">
                      
                      <?php  foreach($messages as $message){?>  
                        <li class="comment even thread-even depth-1">
                          <article id="comment-2" class="clearing-container"> <img alt="" src="<?=base_url().'assets/img/avatar.png'?>" class="avatar avatar-60 photo avatar-default" height="60" width="60">
                            <header class="comment-author vcard"><?=$this->first_name?> <cite class="fn">( <?=$message->message_user_role?> )</cite>
                              <time datetime="<?=$message->message_time?>"><?=$message->message_time?></time>
                              <a class="button" href="<?=base_url().'topics/message_form/'.$message->topic_id.'/'.$message->message_id.'/reply'?>">Reply</a> 
                              <?php
							
							 if($message->message_login_id == $user_id ){
							 ?>
                              <a class="button" href="<?=base_url().'topics/message_form/'.$message->topic_id.'/'.$message->message_id?>">Edit</a>
                              <a class="button" href="<?=base_url().'topics/message_delete/'.$message->topic_id.'/'.$message->message_id?>">Delete</a> 
                              <?php }?>                             
                              </header>                              
                            <section class="comment">
                              <p><?=$message->message_title?><br>
                                <?=$message->message_message?></p>
                            </section>
                          </article>
                      <!--    <ul class="children">
                            <li class="comment odd alt depth-2">
                              <article id="comment-3" class="clearing-container"> <img alt="" src="http://0.gravatar.com/avatar/44fcef106d4dcee6e4c90ba39e0c97d6?s=60&amp;d=http%3A%2F%2F0.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D60&amp;r=G" class="avatar avatar-60 photo" height="60" width="60">
                                <header class="comment-author vcard"> <cite class="fn"><a href="http://theme.crumina.net/preeminent" rel="external nofollow" class="url">modxcms.com</a></cite>
                                  <time datetime="2012-11-28T12:16:37+00:00"> <a href="http://theme.crumina.net/onetouch/hello-world-2/#comment-3">November 28, 2012</a> </time>
                                  <a class="comment-reply-link" href="/onetouch/hello-world-2/?replytocom=3#respond" onClick="return addComment.moveForm(comment-3, 3, respond, 43)">Reply</a> </header>
                                <section class="comment">
                                  <p>Björk has a history of stunning music videos, but she may have outdone herself with this latest effort. The clip for Mutual Core, taken from last year’s Biophilia album, features the Icelandic singer up to the waist in quicksand surrounded by shapeshifting geological creatures and explosions of lava. It was commissioned</p>
                                </section>
                              </article>
                            </li>
                          </ul> -->
                        </li>
                         <?
                      } 
                         ?>
                      </ol>
                    </section>
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