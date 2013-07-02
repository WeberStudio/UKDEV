<body class="home page page-template page-template-page-no_top-php theme-onetouch wpb-js-composer js-comp-ver-3.4.12 vc_responsive">
<div id="body-wrapper" >
<div id="body-wrapper-padding"   >
<!--[if lt IE 7]>
<div class="alert">Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different
browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to
experience this site.
</div><![endif]-->
<section id="header" class="row" role="banner">
<div class="four columns logo">
    <a  href="<?=base_url()?>cart/">
        <img src="<?php echo theme_img("custom-slider-img/logouk.png")?>" alt="OneTouch"></a>
</div>
<? $categories = $this->dropdown_menu->get_all_categories(); 
//echo"<pre>";print_r($categories);

?>

<nav class="eleven columns" id="topmenu"  >


<div class="clear"> </div>
<div align="right" style="font-size:16px; color:#57BAE8;"> </div>

	
   
   <div id="eyebrow">
     <div class="clear"> </div>
    </div>
    <div class="clear"></div>	
    <ul id="menu-primary-navigation" class="tiled-menu" style="margin-left: 0px;">
        <li   class="menu-portfolio" >
            <span class="menu-item-wrap">
                <a  href="<?=base_url()?>cart/allcourses/" style='background-color:#cecece; background-size:cover; background-image:none;' >
                    <span class="link-text">All Courses</span><span class="arrow">&nbsp;</span>                      
                    <span class='tile-icon' style='background-image:url(<?php echo theme_img("icons/text_w@2x.png");?>)'></span>
                </a>				
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
        <?php //print_r($this->top_page);exit;
		$counter = 1;
		?>
		<?php foreach($this->menu_pages as $menu_page):?>
        <li class="menu_over_color_<?=$counter?>">
			<span class="menu-item-wrap">
			<?php if(empty($menu_page->content)):?>
					<a style='background-color:#cecece; background-size:cover; background-image:none;' href="<?php echo $menu_page->url;?>" <?php if($menu_page->new_window ==1){echo 'target="_blank"';} ?>>
					<span class="link-text"><?php echo $menu_page->menu_title;?></span>
					<span class="arrow">&nbsp;</span><span class='tile-icon' style='background-image:url(<?php echo theme_img("icons/!.png");?>);'></span>
					</a>
					<?php else:?>
					<a style='background-color:#cecece; background-size:cover; background-image:none;' href="<?php echo site_url($menu_page->slug);?>"><?php echo $menu_page->menu_title;?>
                    <?php //echo $menu_page->image;?>
                    <span class='tile-icon' style='background-image:url(<?php echo theme_img('icons/'.$menu_page->image);?>)'></span>
                    </a>
					<?php endif;?>
			</span>           
        </li>
		<?php $counter++; endforeach;?>
	</ul> 
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
<div class="row">
    <div class="fifteen columns" id="top-social">

        <a class="open-soc" id="show-social" href="#">
            <div class="twit-open"></div>
            <span>expand panel</span>
            Social icons
        </a>

        <div class="soc-wrap">

            <div class="soc-icons">


                <a class="rss" href="#" data-original-title="RSS feed">RSS</a>

                <a href="http://twitter.com" class="tw" data-original-title="Twitter">Twitter</a>
                <a href="http://facebook.com" class="fb" data-original-title="Facebook">Facebook</a>
                <a href="http://flickr.com" class="fl" data-original-title="Flickr">Flickr</a>
                <a href="http://vimeo.com" class="vi" data-original-title="Vimeo">Vimeo</a>
                <a href="http://dribble.com" class="dr" data-original-title="Dribble">Dribble</a>
                <a href="http://lastfm.com" class="lf" data-original-title="Last FM">Last FM</a>
                <a href="http://youtube.com" class="yt" data-original-title="YouTube">YouTube</a>
                <a href="https://accountservices.passport.net/" class="ms" data-original-title="Microsoft ID">Microsoft ID</a>
                <a href="http://linkedin.com" class="li" data-original-title="LinkedIN">LinkedIN</a>
                <a href="https://accounts.google.com/" class="gp" data-original-title="Google +">Google +</a>
                <a href="http://picasa.com" class="pi" data-original-title="Picasa">Picasa</a>
                <a href="http://pinterest.com" class="pt" data-original-title="Pinterest">Pinterest</a>
                <a href="http://wordpress.com" class="wp" data-original-title="Wordpress">Wordpress</a>
                <a href="http://dropbox.com" class="db" data-original-title="Dropbox">Dropbox</a>

            </div>

        </div>
    </div>

</div>
<div class="row">
<div align="right">


<a href="<?php echo site_url('cart/view_cart');?>" style='background-image:url(<?php echo theme_img('icons/cart.png');?>); background-repeat:no-repeat; padding-bottom:15px;' ><strong style="padding-left:40px;">There are (<?=$this->go_cart->total_items()?>) items in your cart.</strong></a>
</div>
</div>
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
<div class="row" style="">
<div class="promo" style="padding-bottom: 0px; padding-top: 0px;"><span class="icon info" style="color:red; top:-5px;"></span>
    <h1 class="page-title">Call us on 1221 288 0181 now to talk to course advisor - 
        <a href="<?=base_url()?>contact-us1" style="color:red;">Contact Us</a>
        <span>
        
        <?php if($this->Tutor_model->is_logged_in(false, false)):?>
        <a href="<?php echo  site_url('dashboard/');?>" style="color:red;">Dashboard</a><!--<span style="color:red;">/</span>--> <!--<a href="<?php echo site_url('secure/logout');?>" style="color:red;"><?php echo lang('logout');?></a>--></span>
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
          
</div></div> 
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
	
    