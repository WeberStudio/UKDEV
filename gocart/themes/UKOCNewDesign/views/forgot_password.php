<?php include('main_header.php')?>   
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
                    <h1 class="page-title" style="padding: -9px;">
	<a class="all" href="javascript:void(0)"></a>
	</h1>
    <div class="row">
    <div class="line"> </div>
 	</div>   
    <div class="four columns" style="left:30%;">
    <section id="woocommerce_login-2" class="widget-1 widget-first widget widget_login">
      <div class="widget-inner">
        <h3>Reset Password</h3>
        
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
          
          <p>
            <input class="submitbutton" name="submitted" id="wp-submit" value="Send →" type="submit">
            </p>
          <div>
            <input name="redirect_to" class="redirect_to" value="" type="hidden">
            <input name="testcookie" value="1" type="hidden">
            <input name="woocommerce_login" value="1" type="hidden">
            <input name="rememberme" value="forever" type="hidden">
            <input type="hidden" value="<?php //echo $redirect; ?>" name="redirect"/>
			<input type="hidden" value="submitted" name="submitted"/>
          </div>
        </form>
        <ul class="pagenav">
        </ul>
      </div>
    </section>
    
  </div>
  
            </div>
        </div>
        <?php include_once('footer.php'); ?> 
        
       
    </body>
</html>

