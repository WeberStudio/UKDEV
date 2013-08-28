<?php include('main_header.php')?>   
    <body>
    <?php if ($this->session->flashdata('message')):?>
            <div class="alert alert-info">
                <a class="close" data-dismiss="alert">×</a>
                <?php //echo $this->session->flashdata('message');?>
            </div>
        <?php endif;?>
        
        <?php if ($this->session->flashdata('error')):?>
            <div class="alert alert-error">
                <a class="close" data-dismiss="alert">×</a>
                <?php //echo $this->session->flashdata('error');?>
            </div>
        <?php endif;?>
        
        <?php if (!empty($error)):?>
            <div class="alert alert-error">
                <a class="close" data-dismiss="alert">×</a>
                <?php //echo $error;?>
            </div>
        <?php endif;?>
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
                 
                 <div class="seperator">
                     <div class="col6">
                        <h1 class="sep">Open the Door of Opportunity</h1>
                        <p class="sep"><a href="<?=base_url().'cart/allcourses/'?>">view all of our courses</a></p>
                    </div>
                    
                    
                     <div class="col6 social-icons">
                        <a href="https://twitter.com/UKOpen" target="_blank"> <img align="right" alt="" src="http://87.106.234.213/gocart/themes/oneTouch/assets/images/img/twiter-logo.png" style="margin-left: 10px; margin-top: 5px"></img> </a>
                        <a href="http://www.linkedin.com/company/uk-open-college/products?trk=tabs_biz_product" target="_blank"> <img align="right" alt="" src="http://87.106.234.213/gocart/themes/oneTouch/assets/images/img/link-in.png" style="margin-left: 10px; margin-top: 5px"></img> </a>
                        <a href="http://www.youtube.com/watch?v=4dabsHc8yNE&feature=youtube" target="_blank"> <img align="right" alt="" src="http://87.106.234.213/gocart/themes/oneTouch/assets/images/img/youtube.png" style="margin-left: 10px; margin-top: 5px"></img> </a>
                        <a href="https://www.facebook.com/pages/UK-Open-College/411574175557181" target="_blank"><img align="right" alt="" src="http://87.106.234.213/gocart/themes/oneTouch/assets/images/img/face-book.png" style="margin-left: 10px; margin-top: 5px"></img></a>
                     </div>
                     
                   </div>
                 </div><!-- end seperator row -->
                 
                 
                 
                 <div class="onerow">
                     <div class="col12">
                        <div class="col6">
                                           <?php if (!empty($error)): ?>
          <div class="alert alert-error" id="closee"> <a href="javascript:void(0)"  class="close" data-dismiss="alert" onClick="hide_error(); return false;">x</a> <?php echo"<div style='margin-left: 70px;'>". $error. "</div>"; ?> </div>
          <?php endif; ?>
          
      
<?php if (!empty($message)): ?>
        <div class="alert alert-success">
            <a class="close" data-dismiss="alert">×</a>
            <?php echo $message; ?>
        </div>
 <?php endif; ?>
                          <div class="col12">
                            <h2>Reset Password</h2>
                                  <?php //echo form_open('secure/login', 'class="form-horizontal"'); ?>
                                    <? if(isset($tutor_view) && $tutor_view =='tutor_view'){ ?>
                                    <form class="bs-docs-example form-horizontal" accept-charset="utf-8" method="post" action="<?=base_url()?>secure/forgot_password">
                                    <? }else{ ?>
                                    <form class="bs-docs-example form-horizontal" accept-charset="utf-8" method="post" action="<?=base_url()?>secure/forgot_password">
                                    <? } ?>
                                  <p>
                                <label for="user_login">Enter Username or email</label>
                                <input name="email" class="input-text" id="user_login" type="text">
                              </p>
                               <input name="redirect_to" class="redirect_to" value="" type="hidden">
            <input name="testcookie" value="1" type="hidden">
            <input name="woocommerce_login" value="1" type="hidden">
            <input name="rememberme" value="forever" type="hidden">
            <input type="hidden" value="<?php //echo $redirect; ?>" name="redirect"/>
            <input type="hidden" value="submitted" name="submitted"/> 
                                <input class="submitbutton" name="submitted" id="wp-submit" value="Send →" type="submit"> 
                                </form>
                           </div><!-- end col12 -->
                              
                        </div>
                          
                           
                    
                    </div><!-- end col12 -->
                   
                 </div><!-- end one row -->
                 
                 
                                   
                 
                 
                 
          </section>             
            <div class="clear"></div>
        
   <?php include('footer.php')?> 
