<?php include('main_header.php')?>   
    <body>
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo theme_css('jquery-ui.css');?>">
        <script type="text/javascript" src="<?php echo theme_js('js/jquery.min.js');?>"></script>
        <script type="text/javascript" src="<?php echo theme_js('js/jquery-ui.min.js');?>"></script>

        <!-- elFinder CSS (REQUIRED) -->
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo theme_css('elfinder.min.css');?>">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo theme_css('theme.css');?>">

        <!-- elFinder JS (REQUIRED) -->
        <script type="text/javascript" src="<?php echo theme_js('js/elfinder.min.js');?>"></script>

        <!-- elFinder translation (OPTIONAL) -->
        <script type="text/javascript" src="<?php echo theme_js('js/elfinder.ru.js');?>"></script>   
<?  
$customer_details             = $this->go_cart->customer();
$role = '';
if(empty($customer_details['tutor_id']))
{
    $id     = $customer_details['id'];
    $role   = 'customer';                  
}
else
{
    $id     = $customer_details['tutor_id'];
    $role   = 'tutor';                   
}
//echo '<pre>';print_r($customer_details);
?>

<script type="text/javascript" charset="utf-8">
    $().ready(function() {
        var elf = $('#elfinder').elfinder({
            url : '<?=base_url('php')."/connector.php?id=".$id.'&role='.$role;?>'  // connector URL (REQUIRED)                    
            // lang: 'ru',             // language (OPTIONAL)
        }).elfinder('instance');
    });
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
                  <?php include('dashboard_leftpanal.php')?>      
                        <div class="col8">
                            <? if(!empty($file_directory)){ ?>
                                <div class="">
                                     <h3>File Manager</h3>
                                          <div id="elfinder"></div>
                                </div>
                                <? } else{ ?>

                                   <h3>Currently There is no any file shared with you.</h3>
                                <? } ?>
                        </div>
                    
                </div> 
            </section>        
            <div class="clear"></div>
        
   <?php include('footer.php')?> 
