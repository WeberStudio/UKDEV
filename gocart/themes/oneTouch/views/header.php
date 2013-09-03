<body class="home page page-template page-template-page-no_top-php theme-onetouch wpb-js-composer js-comp-ver-3.4.12 vc_responsive">
<div id="body-wrapper" >
<div id="body-wrapper-padding"   >
<!--[if lt IE 7]>
<div class="alert">Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different
browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to
experience this site.
</div><![endif]-->
<section id="" class="row" role="banner">
<div class="four columns logo">
    <a  href="<?=base_url()?>cart/" style="margin:0px !important">
        <img src="<?php echo theme_img("custom-slider-img/logouk.png")?>" alt="OneTouch"></a>
</div>
<? $categories = $this->dropdown_menu->get_all_categories(); 
//echo"<pre>";print_r($categories);

?>

<nav class="eleven columns" id="topmenu" style="margin-top: 20px;" >


<div class="clear"> </div>
<div align="right" style="font-size:16px; color:#57BAE8;"> </div>

    
     <script>
        jQuery(document).ready(function(){
            jQuery(".chosen").data("placeholder","Select Frameworks...").chosen();
        });
  </script>  

  
     
   <div id="eyebrow">
     <div class="clear"> </div>
    </div>
    <div class="clear"></div>
 
<div class="search-course">
      <select class="chosen" style="width:300px;" >
         <option value="-1">Search Course</option>
   <?php foreach($this->courses as $course):?>        
          <option value="<?=base_url().$course['slug']?>"><?=$course['name']?></option>                            
   <?php  endforeach;?>
       </select>                
     </div>
    <div class="top_menu">
             
    <div class="cart" >        
      
        <a href="<?php echo site_url('cart/view_cart');?>">
        
        <p class="cart_text"><span class="cart_img"><img src=" <?php echo theme_img("t_icons/cart.png");?>"/></span>There are (<?=$this->go_cart->total_items()?>) item in your cart</p>
        </a>
    </div>
    
    </div>
   

<ul class="main_menu">
            <li class="pages_1">
                   <a href="<?=base_url()?>">
                    <div class="home" align="center">
                        <img class="home" src="<?php echo theme_img("pre_final/home.png");?>"/>
                    </div>
                    <div class="home_h" align="center">
                        <img class="home_h" src="<?php echo theme_img("pre_final/home_h.png");?>" />
                    </div>
                    
                    <span class="page_name"><a href="<?=base_url()?>"><span class="link-text">Home</span></a></span>
                </a>
            </li>
            <li class="pages_2">
                <a  href="<?=base_url()?>cart/allcourses/">
                
                    
                    
                    <ul id="menu-primary-navigation" class="tiled-menu" style="margin-left: 0px;">
                        <li   class="menu-portfolio"  style="margin:0px;">
                            <span class="menu-item-wrap">                            
                            
                            <div class="all_courses" align="center" style="margin-left: -10px; margin-bottom:3px; margin-bottom: -2px;">
                                <img class="all_courses" src=" <?php echo theme_img("pre_final/all_courses.png");?>"/>
                            </div>
                            <div class="all_courses_h" align="center">
                                <img class="all_courses_h" src="<?php echo theme_img("pre_final/all_courses_h.png");?>" />
                            </div>
                                       <span class="page_name"><a  href="<?=base_url()?>cart/allcourses/"><span class="link-text">All Courses</span></a></span> 
                                    <!--<span class="arrow">&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;</span>    -->                           
                                                                     
                            </span>    
                        <ul class="ltrs" >          
                          <li><a href="" onClick="toggleSubjectLetter(this.innerHTML);return false;">A</a></li>
                          <li><a href="" onClick="toggleSubjectLetter(this.innerHTML);return false;">B</a></li>
                          <li><a href="" onClick="toggleSubjectLetter(this.innerHTML);return false;">C</a></li>
                          <li><a href="" onClick="toggleSubjectLetter(this.innerHTML);return false;">D</a></li>
                          <li><a href="" onClick="toggleSubjectLetter(this.innerHTML);return false;">E</a></li>
                          <li><a href="" onClick="toggleSubjectLetter(this.innerHTML);return false;">F</a></li>
                          <li><a href="" onClick="toggleSubjectLetter(this.innerHTML);return false;">G</a></li>
                          <li><a href="" onClick="toggleSubjectLetter(this.innerHTML);return false;">H</a></li>
                          <li><a href="" onClick="toggleSubjectLetter(this.innerHTML);return false;">I</a></li>
                          <li><a href="" onClick="toggleSubjectLetter(this.innerHTML);return false;">J</a></li>
                          <li><a href="" onClick="toggleSubjectLetter(this.innerHTML);return false;">K</a></li>
                          <li><a href="" onClick="toggleSubjectLetter(this.innerHTML);return false;">L</a></li>
                          <li><a href="" onClick="toggleSubjectLetter(this.innerHTML);return false;">M</a></li>
                          <li><a href="" onClick="toggleSubjectLetter(this.innerHTML);return false;">N</a></li>
                          <li><a href="" onClick="toggleSubjectLetter(this.innerHTML);return false;">O</a></li>
                          <li><a href="" onClick="toggleSubjectLetter(this.innerHTML);return false;">P</a></li>
                          <li><a href="" onClick="toggleSubjectLetter(this.innerHTML);return false;">Q</a></li>
                          <li><a href="" onClick="toggleSubjectLetter(this.innerHTML);return false;">R</a></li>
                          <li><a href="" onClick="toggleSubjectLetter(this.innerHTML);return false;">S</a></li>
                          <li><a href="" onClick="toggleSubjectLetter(this.innerHTML);return false;">T</a></li>
                          <li><a href="" onClick="toggleSubjectLetter(this.innerHTML);return false;">U</a></li>
                          <li><a href="" onClick="toggleSubjectLetter(this.innerHTML);return false;">V</a></li>
                          <li><a href="" onClick="toggleSubjectLetter(this.innerHTML);return false;">W</a></li>
                          <li><a href="" onClick="toggleSubjectLetter(this.innerHTML);return false;">X</a></li>
                          <li><a href="" onClick="toggleSubjectLetter(this.innerHTML);return false;">Y</a></li>
                          <li><a href="" onClick="toggleSubjectLetter(this.innerHTML);return false;">Z</a></li>                        
                          <li>   
                            <div class="mm-data cols_2" id="subjectMenuItems" > 
                              <ul class="sub-menu with-counts lhome" id="home" style="margin:0px !important; padding:10px 0 5px 10px !important; width:100%; display:block ;">
                                <?
                                foreach($categories as $key => $cat_info)
                                   {
                                        if(count($cat_info)>0)
                                        {
                                            
                                            foreach($cat_info as $cat)
                                            { 
                                            
                                                if($cat['count'] != 0){
                                            ?>                              
                                                
                                                
                                                <li><a href="<?=base_url().$cat['slug']?>"><?=$cat['name']?><span> (<?=$cat['count']?>)</span></a></li>                                    
                                                
                                            
                                            <?
                                                } 
                                            } 
                                        } 
                                    }                            
                                ?>
                              </ul>
                            <?php                      
                           foreach($categories as $key => $cat_info)
                           {
                                if(count($cat_info)>0)
                                {
                                    
                          
                          ?>                      
                                  <ul class="sub-menu with-counts l<?=$key?>"  style="margin:0px !important; padding:10px 0 5px 10px !important; width:100%; display:none ;">
                                  <? foreach($cat_info as $cat)
                                    { 
                                        if($cat['count'] != 0){
                                    ?>                              
                                        <li><a href="<?=base_url().$cat['slug']?>"><?=$cat['name']?><span> (<?=$cat['count']?>)</span></a></li>                                    
                                    <?
                                        } 
                                    }
                                    ?> 
                                  </ul>
                            <? } 
                            }
                            ?>            
                          </div>
                          </li>
                        </ul>
                    </li>
                </ul>
                </a>
            </li>
            <li class="pages_3">
                 <a href="<?=base_url()?>blog">
                    <div class="blog" align="center">
                        <img class="blog"  src="<?php echo theme_img("pre_final/blogs.png");?>"/>
                    </div>
                    <div class="blogs_h"  align="center">
                        <img class="blogs_h" src="<?php echo theme_img("pre_final/blogs_h.png");?>"/>
                    </div>
                    <span class="page_name"><a href="<?=base_url()?>blog"><span class="link-text">Blog</span></a></span>
                </a>
            </li>
            <li class="pages_4">
                <a href="<?=base_url()?>tutors">
                    <div class="tutors" align="center">
                        <img class="tutors" src="<?php echo theme_img("pre_final/tutors.png");?>"/>
                    </div>
                    <div  class="tutors_h" align="center">
                        <img class="tutors_h" src="<?php echo theme_img("pre_final/tutors_h.png");?>"/>
                    </div>
                    <span class="page_name"><a href="<?=base_url()?>tutors"> <span class="link-text">Tutors</span></a></span>
                </a>
            </li>
            <li class="pages_5">
                 <a href="<?=base_url()?>faq">
                    <div class="faq" align="center">
                        <img class="faq" src="<?php echo theme_img("pre_final/faq.png");?>"/>
                    </div>
                    <div class="faq_h" align="center">
                        <img class="faq_h" src="<?php echo theme_img("pre_final/faq_h.png");?>" />
                    </div>
                    <span class="page_name"><a href="<?=base_url()?>faq"><span class="link-text">FAQ's</span></a></span>
                </a>
            </li>
            <li class="pages_6 last_menu">
                <a href="<?=base_url()?>contact-us1">
                    <div class="contect" align="center">
                        <img  class="contect" src="<?php echo theme_img("pre_final/contect.png");?>"/>
                    </div>
                    <div class="contect_h" align="center">
                        <img class="contect_h" src="<?php echo theme_img("pre_final/contect_h.png");?>"/ >
                    </div>
                    <span class="page_name"><a href="<?=base_url()?>contact-us1"> <span class="link-text">Contact</span></a></span>
                </a>
            </li>
            
        </ul>

    
   <?php /*?><ul id="menu-primary-navigation" class="tiled-menu" style="margin-left: 0px;">
        <li   class="menu-portfolio" >All Courses
            <span class="menu-item-wrap">
                <a  href="<?=base_url()?>cart/allcourses/" style='background-color:#cecece; background-size:cover; background-image:none;' >
                    <span class="link-text">All Courses</span><span class="arrow">&nbsp;</span>                      
                    
                </a>
                All Courses                
            </span>    
            <ul class="ltrs" >
              
              <li><a href="#" onClick="#">View all - by location - by author - by subject</a></li>
              <li><a href="" onClick="toggleSubjectLetter(this.innerHTML);return false;">A</a></li>
              <li><a href="" onClick="toggleSubjectLetter(this.innerHTML);return false;">B</a></li>
              <li><a href="" onClick="toggleSubjectLetter(this.innerHTML);return false;">C</a></li>
              <li><a href="" onClick="toggleSubjectLetter(this.innerHTML);return false;">D</a></li>
              <li><a href="" onClick="toggleSubjectLetter(this.innerHTML);return false;">E</a></li>
              <li><a href="" onClick="toggleSubjectLetter(this.innerHTML);return false;">F</a></li>
              <li><a href="" onClick="toggleSubjectLetter(this.innerHTML);return false;">G</a></li>
              <li><a href="" onClick="toggleSubjectLetter(this.innerHTML);return false;">H</a></li>
              <li><a href="" onClick="toggleSubjectLetter(this.innerHTML);return false;">I</a></li>
              <li><a href="" onClick="toggleSubjectLetter(this.innerHTML);return false;">K</a></li>
              <li><a href="" onClick="toggleSubjectLetter(this.innerHTML);return false;">L</a></li>
              <li><a href="" onClick="toggleSubjectLetter(this.innerHTML);return false;">M</a></li>
              <li><a href="" onClick="toggleSubjectLetter(this.innerHTML);return false;">N</a></li>
              <li><a href="" onClick="toggleSubjectLetter(this.innerHTML);return false;">O</a></li>
              <li><a href="" onClick="toggleSubjectLetter(this.innerHTML);return false;">P</a></li>
              <li><a href="" onClick="toggleSubjectLetter(this.innerHTML);return false;">R</a></li>
              <li><a href="" onClick="toggleSubjectLetter(this.innerHTML);return false;">S</a></li>
              <li><a href="" onClick="toggleSubjectLetter(this.innerHTML);return false;">T</a></li>
              <li><a href="" onClick="toggleSubjectLetter(this.innerHTML);return false;">U</a></li>
              <li><a href="" onClick="toggleSubjectLetter(this.innerHTML);return false;">V</a></li>
              <li><a href="" onClick="toggleSubjectLetter(this.innerHTML);return false;">W</a></li>              
              <li>   
                  <div class="mm-data cols_2" id="subjectMenuItems" > 
                  <ul class="sub-menu with-counts lhome" id="home" style="margin:0px !important; padding:10px 0 5px 10px !important; width:100%; display:block ;">
                    <?
                    foreach($categories as $key => $cat_info)
                       {
                            if(count($cat_info)>0)
                            {
                                foreach($cat_info as $cat)
                                { ?>                              
                                    <li><a href="<?=base_url().$cat['slug']?>"><?=$cat['name']?><span> (<?=$cat['count']?>)</span></a></li>                                    
                                <? } 
                            } 
                        }                            
                    ?>
                  </ul>
                  <?php                      
               foreach($categories as $key => $cat_info)
               {
                    if(count($cat_info)>0)
                    {
                        
              
              ?>                      
                      <ul class="sub-menu with-counts l<?=$key?>"  style="margin:0px !important; padding:10px 0 5px 10px !important; width:100%; display:none ;">
                      <? foreach($cat_info as $cat)
                        { ?>                              
                            <li><a href="<?=base_url().$cat['slug']?>"><?=$cat['name']?><span> (<?=$cat['count']?>)</span></a></li>                                    
                        <? } ?>
                      </ul>
                <? } 
                }
                ?>            
              </div>
              </li>
              
              
            </ul>
                     
             
        </li>
      
    </ul><?php */?>
</nav>
  
  <script type="text/javascript">
    jQuery(document).ready(function () {
        toggleSubjectLetter('lhome');
    });
    
    
    function toggleSubjectLetter(letter) {  
        
        jQuery('div#subjectMenuItems')
        .children('ul').hide()
        .parent().children('ul.l' + (letter == '#' ? '_' : letter))
        .show();
        if(letter != 'lhome')
        {
            jQuery("#home li").hide();
         }
         if(letter == 'showhome')
        {
           // alert('ds');
            jQuery("#home li").show();
            console.log('dddddd');
         }
                 
        jQuery('div#subjectMenuTab ul.ltrs > li > a').each(function () {
            var e = jQuery(this);
           
            if (e.html() === letter)
                e.parent().addClass('cur').siblings('li.cur').removeClass('cur');
        });
    }
</script>
</section>
<style>
#sub-menu with-counts {
    width: 100%;
    float: left;
    margin: 0 0 3em 0;
    padding: 0;
    list-style: none; }
#sub-menu with-counts li {
    float: left; }
</style>

<!--<div class="row">
<div align="right">


<a href="<?php echo site_url('cart/view_cart');?>" style='background-image:url(<?php echo theme_img('icons/cart.png');?>); background-repeat:no-repeat; padding-bottom:15px;' ><strong style="padding-left:40px;">There are (<?=$this->go_cart->total_items()?>) items in your cart.</strong></a>
</div>
</div>-->
<!--<div><span style="padding 15 15 15 15; float : right; margin-right:15px;"><a href="<?php echo site_url('cart/view_cart');?>" class="add_to_cart_button button product_type_simple" rel="nofollow" data-product_id="868">
                                <?php
                                if ($this->go_cart->total_items()==0)
                                {
                                    echo lang('empty_cart');
                                }
                                else
                                {
                                    if($this->go_cart->total_items() > 1)
                                    {
                                        echo sprintf (lang('multiple_items'), $this->go_cart->total_items());
                                    }
                                    else
                                    {
                                        echo sprintf (lang('single_item'), $this->go_cart->total_items());
                                    }
                                }
                                ?>
                                </a>
</span></div>
                -->
<div class="row">
<div class="contect_div">
    <div class="top_content">
        <div class="call_us"><div class="call_img"><img src="<?php echo theme_img("t_icons/phn.png");?>" alt="phone"/></div> Call us now <b>0121 288 0181</b></div>
        <div class="account_block">
        
        <?php if($this->Tutor_model->is_logged_in(false, false)):?>
            <a href="<?php echo  site_url('dashboard/');?>">
                 <div class="register"><div class="reg_img"><img src="<?php echo theme_img("t_icons/rigester.png");?>"/></div> Dashboard </div>
             </a>      
        <?php elseif($this->Customer_model->is_logged_in(false, false)):?>        
              <a href="<?php echo site_url('secure/logout');?>">
                <div class="live_chat"><div class="chat_img"> <img src="<?php echo theme_img("t_icons/live_chat.png");?>" alt="livechat"/> </div>Logout</div>
            </a>
            
            <b class="seprator">&nbsp;&nbsp;&nbsp;|</b>        
        <a href="<?php echo  site_url('dashboard/');?>">
            <div class="live_chat"><div class="chat_img"> <img src="<?php echo theme_img("t_icons/live_chat.png");?>" alt="livechat"/> </div>Dashboard</div>
        </a>
           
        <?php else: ?>            
            <a href="<?php echo site_url('secure/register'); ?>">
                 <div class="register"><div class="reg_img"><img src="<?php echo theme_img("t_icons/rigester.png");?>"/></div> Register </div>
             </a>            
            <b class="seprator">|</b>
               <a href="<?php echo site_url('secure/login');?>">
                <div class="login"><div class="login_img"><img src="<?php echo theme_img("t_icons/log_in.png");?>"></div><?php echo lang('login');?></div>
            </a>
        <?php endif; ?>
     <a href="http://87.106.234.213/livechat/client.php?locale=en&amp;style=simplicity" target="_blank" onClick="if(navigator.userAgent.toLowerCase().indexOf('opera') != -1 &amp;&amp; window.event.preventDefault) window.event.preventDefault();this.newWindow = window.open('http://87.106.234.213/livechat/client.php?locale=en&amp;style=simplicity&amp;url='+escape(document.location.href.replace('http://','').replace('https://',''))+'&amp;referrer='+escape(document.referrer.replace('http://','').replace('https://','')), 'webim', 'toolbar=0,scrollbars=0,location=0,status=1,menubar=0,width=640,height=480,resizable=1');this.newWindow.focus();this.newWindow.opener=window;return false;">
        <div class="live_chat"><div class="chat_img"> <img src="<?php echo theme_img("t_icons/live_chat.png");?>" alt="livechat"/> </div> Live chat</div>
        </a>
       </div>
        
    </div>
</div>
</div>

<!--<div class="row" style="">
<div class="promo" style="padding-bottom: 0px; padding-top: 0px;"><span class="icon info" style="color:red; top:-5px;"></span>
    <h1 class="page-title">Call us on 1221 288 0181 now to talk to course advisor - 
        <a href="<?=base_url()?>contact-us1" style="color:red;">Contact Us</a>
        <span>
        
        <?php if($this->Tutor_model->is_logged_in(false, false)):?>
        <a href="<?php echo  site_url('dashboard/');?>" style="color:red;">Dashboard</a></span>
        <?php elseif($this->Customer_model->is_logged_in(false, false)):?>
        <a href="<?php echo site_url('secure/logout');?>" style="color:red;"><?php echo lang('logout');?></a>
        <span style="color:red;">/</span>  
         <a href="<?php echo  site_url('dashboard/');?>" style="color:red;">Dashboard</a>
        </h1>
        
            <?php else: ?>
        <a href="<?php echo site_url('secure/register'); ?>" style="color:red;"><?php echo lang('register');?></a>
        <span style="color:red;">/</span>
        <a href="<?php echo site_url('secure/login');?>" style="color:red;"><?php echo lang('login');?></a>
        
        </span></h1>
        <?php endif; ?>
          
</div></div>--> 
<!---------php validation----->
<?php /*if ($this->session->flashdata('message')):?>
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
        <?php endif;*/?>
    
    