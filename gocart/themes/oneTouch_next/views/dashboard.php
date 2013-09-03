<?php include('main_header.php')?>   
    <body>
    <style>
#menu {
background: #9cb925;
border-right: 3px solid #ee4e1d;
width: 100px;
height: 100px;
padding: 30px;
/*position: fixed;*/
/*z-index: 100000;*/
 
box-shadow: 4px 0 10px rgba(0,0,0,0.25);
-moz-box-shadow: 4px 0 10px rgba(0,0,0,0.25);
-webkit-box-shadow: 4px 0 10px rgba(0,0,0,0.25);
}
 
#menu {
left: 0; /* Change to right: 0; if you want the panel to display on the right side. */
}
 
#menu:hover, #menu:focus {
left: 0 !important; /* Change to right: 0 !important; if you want the panel to display on the right side. */
}
#menu .arrow {
right: 2px; /* Change to left: 2px; if you want the panel to display on the right side. */
}
 
#menu .arrow {
font: normal 400 25px/25px 'Acme', Helvetica, Arial, sans-serif; /* Acme font is required for .arrow */
color: rgba(0,0,0,0.75); /* Arrow color */
width: 16px;
height: 25px;
display: block;
position: absolute;
top: 20px;
cursor: default;
}
 
#menu:hover .arrow {
transform: rotate(-180deg) translate(6px,-3px);
-moz-transform: rotate(-180deg) translate(6px,-3px);
-webkit-transform: rotate(-180deg) translate(6px,-3px);
}
#menu nav {
position: relative;
top: 75px;
}
 
#menu nav a {
padding: 10px 5px;
border-bottom: 1px dotted #c0c0c0;
display: block;
clear: both;
font: bold 13px/18px 'Open Sans', Helvetica, Arial, sans-serif;
/*color: #fff; */
text-decoration: none;
}
 
#menu nav a:hover {
color: #ee4e1d;
}
</style>
<script type="text/javascript">
//$(document).ready(function() {
//$("#menu").height($(document).height());
//});
</script>
<script type="text/javascript">
//$(document).ready(function() {
//setTimeout( function(){$('#menu').css('left','100px');},2000); <!-- Change 'left' to 'right' for panel to appear to the right -->
//});
</script>
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
            
            <div id="menu">
<div class="arrow"><</div>
<nav>
<a href="#">Home</a>
<a href="#">An introduction: Design in 2012</a>
<a href="#">Relevant figures in design</a>
<a href="#">Where is design heading?</a>
<a href="#">Influences</a>
<a href="#">Video</a>
<a href="#">Sources</a>
</nav>
</div>
</body>

            </div> 
            </section>        
            <div class="clear"></div>
        
   <?php include('footer.php')?> 
