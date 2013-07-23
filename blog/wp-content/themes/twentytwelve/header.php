<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title>
<?php wp_title( '|', true, 'right' ); ?>
</title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
<link href="http://87.106.234.213/gocart/themes/oneTouch/assets/css/google-font.css" type="text/css" rel="stylesheet" />
<link href="http://87.106.234.213/gocart/themes/oneTouch/assets/css/aqpb-view.css" type="text/css" rel="stylesheet" />
<link href="http://87.106.234.213/gocart/themes/oneTouch/assets/css/bootstrap.css" type="text/css" rel="stylesheet" />
<link href="http://87.106.234.213/gocart/themes/oneTouch/assets/css/js_composer_front.css" type="text/css" rel="stylesheet" />
<link href="http://87.106.234.213/gocart/themes/oneTouch/assets/css/revslider-settings.css" type="text/css" rel="stylesheet" />
<link href="http://87.106.234.213/gocart/themes/oneTouch/assets/css/revslider-captions.css" type="text/css" rel="stylesheet" />
<link href="http://87.106.234.213/gocart/themes/oneTouch/assets/css/frontend.css" type="text/css" rel="stylesheet" />
<link href="http://87.106.234.213/gocart/themes/oneTouch/assets/css/foundation.min.css" type="text/css" rel="stylesheet" />
<link href="http://87.106.234.213/gocart/themes/oneTouch/assets/css/app.css" type="text/css" rel="stylesheet" />
<link href="http://87.106.234.213/gocart/themes/oneTouch/assets/css/shortcodes.css" type="text/css" rel="stylesheet" />
<link href="http://87.106.234.213/gocart/themes/oneTouch/assets/css/responsive.css" type="text/css" rel="stylesheet" />
<link href="http://87.106.234.213/gocart/themes/oneTouch/assets/css/options.css" type="text/css" rel="stylesheet" />
<link href="http://87.106.234.213/gocart/themes/oneTouch/assets/css/menu.css" type="text/css" rel="stylesheet" />
<link href="http://87.106.234.213/gocart/themes/oneTouch/assets/css/woocommerce.css" type="text/css" rel="stylesheet" />
<link href="http://87.106.234.213/gocart/themes/oneTouch/assets/css/chosen.css" type="text/css" rel="stylesheet" />
<link href="http://87.106.234.213/gocart/themes/oneTouch/assets/css/jquery.fancybox-1.3.1.css?c-v=24739" type="text/css" rel="stylesheet" />
<script type="text/javascript">
        // needed to check if the LoginConflictModal popup is displayed.
        var isLoginConflited = 'False'
    </script>
<!--   End search     -->
<script type="text/javascript" src="http://87.106.234.213/gocart/themes/oneTouch/assets/js/jquery-1-8-3.js?c-v=24739"></script>
<script type="text/javascript" src="http://87.106.234.213/gocart/themes/oneTouch/assets/js/jquery.plugins.min.js"></script>
<script type="text/javascript" src="http://87.106.234.213/gocart/themes/oneTouch/assets/js/jquery.themepunch.plugins.min.js"></script>
<script type="text/javascript" src="http://87.106.234.213/gocart/themes/oneTouch/assets/js/jquery.themepunch.revolution.min.js"></script>
<script type="text/javascript" src="http://87.106.234.213/gocart/themes/oneTouch/assets/js/modernizr.foundation.js"></script>
<script type="text/javascript" src="http://87.106.234.213/gocart/themes/oneTouch/assets/js/app.js"></script>
<script type="text/javascript" src="http://87.106.234.213/gocart/themes/oneTouch/assets/js/modernizr.foundation.js"></script>
<script type="text/javascript" src="http://87.106.234.213/gocart/themes/oneTouch/assets/js/simpletabs_1.3.js"></script>
<script type="text/javascript" src="http://87.106.234.213/gocart/themes/oneTouch/assets/js/chosen.js"></script>
</head>
<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
<header id="masthead" class="site-header" role="banner">
<?php /*?><hgroup>
			
            <img src="<?php echo get_template_directory_uri(); ?>/images/logouk.png" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>">
			
		</hgroup>

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<h3 class="menu-toggle"><?php _e( 'Menu', 'twentytwelve' ); ?></h3>
			<a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentytwelve' ); ?>"><?php _e( 'Skip to content', 'twentytwelve' ); ?></a>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
		</nav><!-- #site-navigation -->

		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>
		<?php endif; ?><?php */?>
<style>
        #body-wrapper {
            background-attachment:fixed!important;
            background-repeat:repeat;
        }
    </style>
<style type="text/css">
        .facebookOuter {
            background-color: transparent;
            padding-bottom: 1px;
            border: 1px solid #687f8e;
        }
        .facebookInner {
            height:275px;
            border:none;
            background: transparent;
        }
    </style>
<style type="text/css">
.fb_hidden{position:absolute;top:-10000px;z-index:10001}
.fb_invisible{display:none}
.fb_reset{background:none;border:0;border-spacing:0;color:#000;cursor:auto;direction:ltr;font-family:"lucida grande", tahoma, verdana, arial, sans-serif;font-size:11px;font-style:normal;font-variant:normal;font-weight:normal;letter-spacing:normal;line-height:1;margin:0;overflow:visible;padding:0;text-align:left;text-decoration:none;text-indent:0;text-shadow:none;text-transform:none;visibility:visible;white-space:normal;word-spacing:normal}
.fb_reset > div{overflow:hidden}
.fb_link img{border:none}
.fb_dialog{background:rgba(82, 82, 82, .7);position:absolute;top:-10000px;z-index:10001}
.fb_dialog_advanced{padding:10px;-moz-border-radius:8px;-webkit-border-radius:8px;border-radius:8px}
.fb_dialog_content{background:#fff;color:#333}
.fb_dialog_close_icon{background:url(http://static.ak.fbcdn.net/rsrc.php/v2/yq/r/IE9JII6Z1Ys.png) no-repeat scroll 0 0 transparent;_background-image:url(http://static.ak.fbcdn.net/rsrc.php/v2/yL/r/s816eWC-2sl.gif);cursor:pointer;display:block;height:15px;position:absolute;right:18px;top:17px;width:15px;top:8px\9;right:7px\9}
.fb_dialog_mobile .fb_dialog_close_icon{top:5px;left:5px;right:auto}
.fb_dialog_padding{background-color:transparent;position:absolute;width:1px;z-index:-1}
.fb_dialog_close_icon:hover{background:url(http://static.ak.fbcdn.net/rsrc.php/v2/yq/r/IE9JII6Z1Ys.png) no-repeat scroll 0 -15px transparent;_background-image:url(http://static.ak.fbcdn.net/rsrc.php/v2/yL/r/s816eWC-2sl.gif)}
.fb_dialog_close_icon:active{background:url(http://static.ak.fbcdn.net/rsrc.php/v2/yq/r/IE9JII6Z1Ys.png) no-repeat scroll 0 -30px transparent;_background-image:url(http://static.ak.fbcdn.net/rsrc.php/v2/yL/r/s816eWC-2sl.gif)}
.fb_dialog_loader{background-color:#f2f2f2;border:1px solid #606060;font-size:24px;padding:20px}
.fb_dialog_top_left,
.fb_dialog_top_right,
.fb_dialog_bottom_left,
.fb_dialog_bottom_right{height:10px;width:10px;overflow:hidden;position:absolute}
.fb_dialog_top_left{background:url(http://static.ak.fbcdn.net/rsrc.php/v2/ye/r/8YeTNIlTZjm.png) no-repeat 0 0;left:-10px;top:-10px}
.fb_dialog_top_right{background:url(http://static.ak.fbcdn.net/rsrc.php/v2/ye/r/8YeTNIlTZjm.png) no-repeat 0 -10px;right:-10px;top:-10px}
.fb_dialog_bottom_left{background:url(http://static.ak.fbcdn.net/rsrc.php/v2/ye/r/8YeTNIlTZjm.png) no-repeat 0 -20px;bottom:-10px;left:-10px}
.fb_dialog_bottom_right{background:url(http://static.ak.fbcdn.net/rsrc.php/v2/ye/r/8YeTNIlTZjm.png) no-repeat 0 -30px;right:-10px;bottom:-10px}
.fb_dialog_vert_left,
.fb_dialog_vert_right,
.fb_dialog_horiz_top,
.fb_dialog_horiz_bottom{position:absolute;background:#525252;filter:alpha(opacity=70);opacity:.7}
.fb_dialog_vert_left,
.fb_dialog_vert_right{width:10px;height:100%}
.fb_dialog_vert_left{margin-left:-10px}
.fb_dialog_vert_right{right:0;margin-right:-10px}
.fb_dialog_horiz_top,
.fb_dialog_horiz_bottom{width:100%;height:10px}
.fb_dialog_horiz_top{margin-top:-10px}
.fb_dialog_horiz_bottom{bottom:0;margin-bottom:-10px}
.fb_dialog_iframe{line-height:0}
.fb_dialog_content .dialog_title{background:#6d84b4;border:1px solid #3b5998;color:#fff;font-size:14px;font-weight:bold;margin:0}
.fb_dialog_content .dialog_title > span{background:url(http://static.ak.fbcdn.net/rsrc.php/v2/yd/r/Cou7n-nqK52.gif)
no-repeat 5px 50%;float:left;padding:5px 0 7px 26px}
body.fb_hidden{-webkit-transform:none;height:100%;margin:0;left:-10000px;overflow:visible;position:absolute;top:-10000px;width:100%
}
.fb_dialog.fb_dialog_mobile.loading{background:url(http://static.ak.fbcdn.net/rsrc.php/v2/ya/r/3rhSv5V8j3o.gif)
white no-repeat 50% 50%;min-height:100%;min-width:100%;overflow:hidden;position:absolute;top:0;z-index:10001}
.fb_dialog.fb_dialog_mobile.loading.centered{max-height:590px;min-height:590px;max-width:500px;min-width:500px}
#fb-root #fb_dialog_ipad_overlay{background:rgba(0, 0, 0, .45);position:absolute;left:0;top:0;width:100%;min-height:100%;z-index:10000}
#fb-root #fb_dialog_ipad_overlay.hidden{display:none}
.fb_dialog.fb_dialog_mobile.loading iframe{visibility:hidden}
.fb_dialog_content .dialog_header{-webkit-box-shadow:white 0 1px 1px -1px inset;background:-webkit-gradient(linear, 0 0, 0 100%, from(#738ABA), to(#2C4987));border-bottom:1px solid;border-color:#1d4088;color:#fff;font:14px Helvetica, sans-serif;font-weight:bold;text-overflow:ellipsis;text-shadow:rgba(0, 30, 84, .296875) 0 -1px 0;vertical-align:middle;white-space:nowrap}
.fb_dialog_content .dialog_header table{-webkit-font-smoothing:subpixel-antialiased;height:43px;width:100%
}
.fb_dialog_content .dialog_header td.header_left{font-size:12px;padding-left:5px;vertical-align:middle;width:60px
}
.fb_dialog_content .dialog_header td.header_right{font-size:12px;padding-right:5px;vertical-align:middle;width:60px
}
.fb_dialog_content .touchable_button{background:-webkit-gradient(linear, 0 0, 0 100%, from(#4966A6),
color-stop(0.5, #355492), to(#2A4887));border:1px solid #29447e;-webkit-background-clip:padding-box;-webkit-border-radius:3px;-webkit-box-shadow:rgba(0, 0, 0, .117188) 0 1px 1px inset,
rgba(255, 255, 255, .167969) 0 1px 0;display:inline-block;margin-top:3px;max-width:85px;line-height:18px;padding:4px 12px;position:relative}
.fb_dialog_content .dialog_header .touchable_button input{border:none;background:none;color:#fff;font:12px Helvetica, sans-serif;font-weight:bold;margin:2px -12px;padding:2px 6px 3px 6px;text-shadow:rgba(0, 30, 84, .296875) 0 -1px 0}
.fb_dialog_content .dialog_header .header_center{color:#fff;font-size:16px;font-weight:bold;line-height:18px;text-align:center;vertical-align:middle}
.fb_dialog_content .dialog_content{background:url(http://static.ak.fbcdn.net/rsrc.php/v2/y9/r/jKEcVPZFk-2.gif) no-repeat 50% 50%;border:1px solid #555;border-bottom:0;border-top:0;height:150px}
.fb_dialog_content .dialog_footer{background:#f2f2f2;border:1px solid #555;border-top-color:#ccc;height:40px}
#fb_dialog_loader_close{float:left}
.fb_dialog.fb_dialog_mobile .fb_dialog_close_button{text-shadow:rgba(0, 30, 84, .296875) 0 -1px 0}
.fb_dialog.fb_dialog_mobile .fb_dialog_close_icon{visibility:hidden}
.fb_iframe_widget{display:inline-block;position:relative}
.fb_iframe_widget span{display:inline-block;position:relative;text-align:justify}
.fb_iframe_widget iframe{position:absolute}
.fb_iframe_widget_lift{z-index:1}
.fb_hide_iframes iframe{position:relative;left:-10000px}
.fb_iframe_widget_loader{position:relative;display:inline-block}
.fb_iframe_widget_fluid{display:inline}
.fb_iframe_widget_fluid span{width:100%}
.fb_iframe_widget_loader iframe{min-height:32px;z-index:2;zoom:1}
.fb_iframe_widget_loader .FB_Loader{background:url(http://static.ak.fbcdn.net/rsrc.php/v2/y9/r/jKEcVPZFk-2.gif) no-repeat;height:32px;width:32px;margin-left:-16px;position:absolute;left:50%;z-index:4}
.fb_connect_bar_container div,
.fb_connect_bar_container span,
.fb_connect_bar_container a,
.fb_connect_bar_container img,
.fb_connect_bar_container strong{background:none;border-spacing:0;border:0;direction:ltr;font-style:normal;font-variant:normal;letter-spacing:normal;line-height:1;margin:0;overflow:visible;padding:0;text-align:left;text-decoration:none;text-indent:0;text-shadow:none;text-transform:none;visibility:visible;white-space:normal;word-spacing:normal;vertical-align:baseline}
.fb_connect_bar_container{position:fixed;left:0 !important;right:0 !important;height:42px !important;padding:0 25px !important;margin:0 !important;vertical-align:middle !important;border-bottom:1px solid #333 !important;background:#3b5998 !important;z-index:99999999 !important;overflow:hidden !important}
.fb_connect_bar_container_ie6{position:absolute;top:expression(document.compatMode=="CSS1Compat"? document.documentElement.scrollTop+"px":body.scrollTop+"px")}
.fb_connect_bar{position:relative;margin:auto;height:100%;width:100%;padding:6px 0 0 0 !important;background:none;color:#fff !important;font-family:"lucida grande", tahoma, verdana, arial, sans-serif !important;font-size:13px !important;font-style:normal !important;font-variant:normal !important;font-weight:normal !important;letter-spacing:normal !important;line-height:1 !important;text-decoration:none !important;text-indent:0 !important;text-shadow:none !important;text-transform:none !important;white-space:normal !important;word-spacing:normal !important}
.fb_connect_bar a:hover{color:#fff}
.fb_connect_bar .fb_profile img{height:30px;width:30px;vertical-align:middle;margin:0 6px 5px 0}
.fb_connect_bar div a,
.fb_connect_bar span,
.fb_connect_bar span a{color:#bac6da;font-size:11px;text-decoration:none}
.fb_connect_bar .fb_buttons{float:right;margin-top:7px}
.fb_edge_widget_with_comment{position:relative;*z-index:1000}
.fb_edge_widget_with_comment span.fb_edge_comment_widget{position:absolute}
.fb_edge_widget_with_comment span.fb_send_button_form_widget{z-index:1}
.fb_edge_widget_with_comment span.fb_send_button_form_widget .FB_Loader{left:0;top:1px;margin-top:6px;margin-left:0;background-position:50% 50%;background-color:#fff;height:150px;width:394px;border:1px #666 solid;border-bottom:2px solid #283e6c;z-index:1}
.fb_edge_widget_with_comment span.fb_send_button_form_widget.dark .FB_Loader{background-color:#000;border-bottom:2px solid #ccc}
.fb_edge_widget_with_comment span.fb_send_button_form_widget.siderender
.FB_Loader{margin-top:0}
.fbpluginrecommendationsbarleft,
.fbpluginrecommendationsbarright{position:fixed !important;bottom:0;z-index:999}
.fbpluginrecommendationsbarleft{left:10px}
.fbpluginrecommendationsbarright{right:10px}
</style>
</head>
<body class="home page page-template page-template-page-no_top-php theme-onetouch wpb-js-composer js-comp-ver-3.4.12 vc_responsive">
<script> var customStyleImgUrl = "images/custom-slider-img";</script>
<!--        
-->

<section id="header" class="row" role="banner">
  <div class="four columns logo"> <a  href="http://87.106.234.213/cart/"> <img src="http://87.106.234.213/gocart/themes/oneTouch/assets/images/custom-slider-img/logouk.png" alt="OneTouch"></a> </div>
  <nav class="eleven columns" id="topmenu"  >
    <div class="clear"> </div>
    <div align="right" style="font-size:16px; color:#57BAE8;"> </div>
    <div id="eyebrow">
      <div class="clear"> </div>
    </div>
    <div class="clear"></div>
    <ul class="main_menu">
            <li class="pages_1">
           		<a href="http://87.106.234.213/">
                	<div class="home" align="center">
                    	<img class="home_img" src="http://87.106.234.213/gocart/themes/oneTouch/assets/images/pre_final/home.png"/> 
                    </div>
                    <div class="home_h" align="center">
                    	<img class="home_h" src="http://87.106.234.213/gocart/themes/oneTouch/assets/images/pre_final/home_h.png"/> 
					</div>
                    <span class="page_name">Home</span>
                </a>
            </li>
			<li class="pages_2">           		
				<a href="http://87.106.234.213/cart/allcourses/">
                	<div class="all_courses" align="center">
                    	<img class="all_courses" src="http://87.106.234.213/gocart/themes/oneTouch/assets/images/pre_final/all_courses.png"/> 
                    </div>
                    <div class="all_courses_h" align="center">
                    	<img class="all_courses_h" src="http://87.106.234.213/gocart/themes/oneTouch/assets/images/pre_final/all_courses.png"/> 
					</div>
                    <span class="page_name">All courses</span>
                </a>
            </li>			 
            <li class="pages_4">
            	<a href="http://87.106.234.213/tutors">
                	<div class="tutors" align="center">
                    	<img class="tutors" src="http://87.106.234.213/gocart/themes/oneTouch/assets/images/pre_final/tutors.png"/> 
                    </div>
                    <div  class="tutors_h" align="center">
                    	<img class="tutors_h" src="http://87.106.234.213/gocart/themes/oneTouch/assets/images/pre_final/tutors_h.png"/>
                    </div>
                    <span class="page_name">tutor</span>
                </a>
            </li>
            <li class="pages_5">
            	 <a href="http://87.106.234.213/faq">
                	<div class="faq" align="center">
                    	 <img class="faq" src="http://87.106.234.213/gocart/themes/oneTouch/assets/images/pre_final/faq.png"/> 
                    </div>
                    <div class="faq_h" align="center">
                    	<img class="faq_h" src="http://87.106.234.213/gocart/themes/oneTouch/assets/images/pre_final/faq_h.png"/>
                    </div>
                    <span class="page_name">faq's</span>
                </a>
            </li>
            <li class="pages_6 last_menu">
            	<a href="http://87.106.234.213/contact-us1">
                	<div class="contect" align="center">
                    	<img class="contect" src="http://87.106.234.213/gocart/themes/oneTouch/assets/images/pre_final/contect.png"/>
                    </div>
                    <div class="contect_h" align="center">
                    	<img class="contect_h" src="http://87.106.234.213/gocart/themes/oneTouch/assets/images/pre_final/contect_h.png"/>
                    </div>
                    <span class="page_name">contact</span>
                </a>
            </li>
            
        </ul>
  </nav>
 
</section>
</header>
<!-- #masthead -->
<div id="main" class="wrapper">
