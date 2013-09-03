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
<!--Socil Icon Share Button Files-->
<script type="text/javascript">var switchTo5x=false;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "39c7f6c5-ccfb-494c-b58a-2fd80efbe0c2", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
<!--Socil Icon Share Button Files--> 
<script type="text/javascript">
    jQuery =    jQuery.noConflict();
    jQuery(document).ready(function() {
        /*
        *  Simple image gallery. Uses default settings
        */

        jQuery('.fancybox').fancybox();



    });
</script>
 <style>


form#informationRequest h4
{
       color:#808080;
}
form#informationRequest p
{
       color:#808080;
}
div#homeFormCenter p label {
					  color:#000; 
					 }
</style>  
<section>
    <div class="onerow"> 
        <div class="seperator">
            <div class="col6">
                <h1 class="sep">Open the Door of Opportunity</h1>
                <p class="sep"><a href="<?php echo base_url().'cart/allcourses/';?>">view all of our courses</a></p>
            </div>


            <div class="col6 social-icons">
                <a href="https://twitter.com/UKOpen" target="_blank"> <img align="right" alt="" src="http://87.106.234.213/gocart/themes/oneTouch/assets/images/img/twiter-logo.png" style="margin-left: 10px; margin-top: 5px"></img> </a>
                <a href="http://www.linkedin.com/company/uk-open-college/products?trk=tabs_biz_product" target="_blank"> <img align="right" alt="" src="http://87.106.234.213/gocart/themes/oneTouch/assets/images/img/link-in.png" style="margin-left: 10px; margin-top: 5px"></img> </a>
                <a href="http://www.youtube.com/watch?v=4dabsHc8yNE&feature=youtube" target="_blank"> <img align="right" alt="" src="http://87.106.234.213/gocart/themes/oneTouch/assets/images/img/youtube.png" style="margin-left: 10px; margin-top: 5px"></img> </a>
                <a href="https://www.facebook.com/pages/UK-Open-College/411574175557181" target="_blank"><img align="right" alt="" src="http://87.106.234.213/gocart/themes/oneTouch/assets/images/img/face-book.png" style="margin-left: 10px; margin-top: 5px"></img></a>
            </div>

        </div>
    </div>
    <div class="onerow">
        <div class="col8">

            <div class="bread">
			
                            <p><a style="color:#000;" href="<?=base_url();?>">Home</a>  /  <a style="color:#000;" href="<?=base_url().'cart/allcourses/';?>">Courses</a>  / <a style="color: #000;" href="<?=$product->slug?>"><?=$product->name?></a></p>
            </div>
                  <div class="col12">
                            <h2><?=$product->name?></h2>
							<h2 style="float:right; float: right; margin: -40px 20px 0px 0px; ">
							<?
                            foreach($product->price_options as $price) {
                                
                                $price_option_title = strtolower($price->p_option_title);
                                
                                if(strpos($price_option_title, 'full')) { 
                                
                                    echo $price->p_option_title;
                                }
                            }
                            ?> 
                        </h2>       
                        </div>
            <div class="single-course-details">

                <img src="<?php echo base_url('uploads/images/medium/'.$product->images);?>" alt="<?=$product->img_alt?>" title="<?=$product->img_title?>" />

            </div> 


            <?php echo form_open('cart/add_to_cart', 'class=""');?>
            <!-- <div class="col7 halfwidth">

            <h2><?=$product->name?></h2>

            <p> description of the course</p>

            </div>-->

            <div class="col12">
                <span class='st_sharethis_large' displayText='ShareThis'></span>
                <span class='st_facebook_large' displayText='Facebook'></span>
                <span class='st_googleplus_large' displayText='Google +'></span>
                <span class='st_twitter_large' displayText='Tweet'></span>
                <span class='st_linkedin_large' displayText='LinkedIn'></span>
                <span class='st_pinterest_large' displayText='Pinterest'></span>
                <span class='st_email_large' displayText='Email'></span>


            </div>         
            <div class="col12 price-op">

              
                <div id="price_select_error" style="display:none; color:#FF0000; font-weight:bold;">Please select a price option before you enrol</div> 
                <?php if(!empty($product->price_options)){ ?>
                    <span class="custom-dropdown custom-dropdown--white">                                
                        <select class="custom-dropdown__select custom-dropdown__select--white" name="price_option" id="price_option" onChange="set_price_text()">
                            <option value="0">Price Options</option>
                            <?php foreach($product->price_options as $price){?>
                                <option value="<?php if($product->discount != ""){$pricee = $price->p_option_price-($price->p_option_price*$product->discount); echo $pricee;}else{echo $price->p_option_price;}?>"><?php echo $price->p_option_title;?></option>
                                <?php }?>
                        </select>
						<input type="hidden" name="price_text" id="price_text"  value=""/>
                    </span>

                    <?php } else{?>
                    <p itemprop="price" class="price"><span class="amount"><?=format_currency($product->price)?></span></p>
                    <?php }?>
                <input type="hidden" name="id" value="<?php echo $product->id?>"/>

                <input type="submit" value=" Enrol Now" class="button enrol-btn" onClick=" return check_payment_price()" /> 
            </div>
            </form>



          



            <div class="col12" style="margin-right: 0 !importent;">

                <ul class='tabs'>
                    <?php
                        if(!empty($product_tabs)){ 
                            foreach($product_tabs as $tabs)
                            {    
                            ?>
                            <li style=" margin-bottom: 0px;" class="reviews_tab"><a class="" href="#<?=str_replace(' ', '-', strtolower($tabs['tab_title']))?>"><?=$tabs['tab_title']?></a></li> 

                            <?php
                        }}
                    ?> 



                </ul>
				
                <?php
                    if(!empty($product_tabs)){
                        foreach($product_tabs as $tabs)
                        {?>
                        <div id='<?php echo str_replace(' ', '-', strtolower($tabs['tab_title']))?>'>

                            <div class="details">
                                <h2><?=$tabs['tab_title'];?></h2>								 
                                    <?php if($tabs['tab_title'] == "Request Info") 
									{ ?>
											
											<form action="<?php echo base_url()."cart/send_request_mail/" ?>" method="post">
												<p><?=$tabs['tab_content']?></p>												
											</form>
                                   <?php 
								   } 
								   else 
								   { 
								   ?>
                                   			<p><?=$tabs['tab_content']?></p>
                                  <?php 
								  }
								   ?>                                
                            </div>
                        </div>
                        <?php }}?>




            </div><!-- end col12 -->


        </div><!-- end col8 -->



        <div class="col4">

            <div class="col12 twitter-res">
                <img src="<?php echo theme_assets('img/twitter_icon.png')?>" alt="" />
                <h2>twitter</h2>
                <ul>
                    <section id="crum_latest_tweets-2" class="widget-1 widget-first widget twitter-widget">
                        <div class="widget-inner">
                            <div class="subtitle">Our latest twitter news</div>

                            <?php  

                                $userid = 'UKOpen'; //your handle
                                $count = '2';
                                //();
                                // $responseJson = file_get_contents('http://api.twitter.com/1/statuses/user_timeline.json?screen_name='.$userid.'&include_rts=1&count='.$count);

                                require_once('TwitterAPIExchange.php');

                                /** Set access tokens here - see: https://dev.twitter.com/apps/ **/
                                $settings = array(
                                'oauth_access_token' => "1513184167-xtUDzVoO5ztCrkBI44Qd9KGJ9WX1QHe1dfYsrgc",
                                'oauth_access_token_secret' => "KpEdVP6kO7UsSM9hKt3dQM4q4DnD9Y1W2s6AdWHkAY",
                                'consumer_key' => "NKFo3oq7of6RN6t9IgQ",
                                'consumer_secret' => "H85s1YgsEBnH2geJPRzCFn52Wy75RwLz5o3syazfc88"
                                );
                                /** Perform a GET request and echo the response **/
                                /** Note: Set the GET field BEFORE calling buildOauth(); **/
                                $url = 'http://api.twitter.com/1.1/statuses/user_timeline.json';
                                $getfield = '?screen_name='.$userid.'&include_rts=1&count='.$count;
                                $requestMethod = 'GET';
                                $twitter = new TwitterAPIExchange($settings);
                                $responseJson = $twitter->setGetfield($getfield)
                                ->buildOauth($url, $requestMethod)
                                ->performRequest();


                                if ($responseJson) {
                                    $response = json_decode($responseJson);
                                } 
                                else
                                {
                                    $response = '';   
                                }
                                //echo '<pre>'; print_r($responseJson);echo '</pre>';
                                function dateDiff ($d1, $d2) {
                                    // Return the number of days between the two dates:

                                    return round(abs(strtotime($d1)-strtotime($d2))/86400);

                                }  // end function dateDiff
                                if(!empty($response))
                                {

                                    if(!empty($response->errors))
                                    {
                                        echo '<div class="tweet">'.$response->errors[0]->message.'</div>';        
                                    }
                                    else
                                    {
                                        foreach ($response as $tweet) {
                                            //$current = new DateTime(date('m/d/Y h:i:s a'));
                                            //$db_date = new DateTime($tweet->created_at);
                                            if(!empty($tweet))
                                            {
                                                // DebugBreak();
                                                $days = dateDiff(date('m/d/Y h:i:s a'),$tweet->created_at);
                                                echo '<li><div class="tweet">';  
                                                $tweet_text = $tweet->text; //get the tweet

                                                // make links link to URL
                                                $tweet_text = preg_replace("#(^|[\n ])([\w]+?://[\w\#$%&~/.\-;:=,?@\[\]+]*)#is", "\\1<a href='\\2'>\\2</a>", $tweet_text); 

                                                // make hashtags link to a search for that hashtag
                                                $tweet_text = preg_replace("/#([a-z_0-9]+)/i", "<a href=\"http://twitter.com/search/$1\">$0</a>", $tweet_text);

                                                // make mention link to actual twitter page of that person
                                                $tweet_text = preg_replace("/@([a-z_0-9]+)/i", "<a href=\"http://twitter.com/$1\">$0</a>", $tweet_text);

                                                // display each tweet in a list item
                                                echo  $tweet_text ;
                                                //echo "<div class='time'>$days days ago</div> " ;
                                                echo "</div>
                                                <a href='https://twitter.com/UKOpen' class='t_link'>$days days ago - view full tweet</a>
                                                </li>";  
                                            }
                                        } 
                                    }
                                }
                            ?>
                        </div>
                    </section>


                </ul>      
            </div>

            <div class="col12 nus-res">
                <img src="http://87.106.234.213/uploads/images/full/Payments.png" alt="NUS Extra Card" /> 
                <h2><?php echo $special_pages->title?></h2> 
                <p><?php echo $special_pages->fornt_content;?></p> 
                <p class="button nus-btn"><a href="<?php echo base_url().$special_pages->slug?>">Details</a></p>
            </div>

            <div class="col12 user-login">

                <h2>User Login</h2>
                <form accept-charset="utf-8" method="post" action="<?=base_url()?>secure/login" autocomplete="on">
                    <p class="username">
                        User Name
                    </p>
                    <input type="text" name="email" id="name" placeholder="" required />
                    <!--<label for="name">Name</label>-->

                    <p class="password">
                        Password</p>
                    <input type="password" name="password" id="password"  placeholder="" autocomplete="off" required />
                    <!--<label for="email">Email</label>-->
                    <p class="submit">
                        <input type="submit" value="Submit" class="button" />
                    </p>

                    <a class="align-left" href="#">forget password?</a>
                </form>
            </div>


        </div>


    </div>
      <script type="text/javascript" src="https://www.pubble.co/resources/javascript/QAInit.js">
            </script>
            <script type="text/javascript">
                var lpQA = lpQA({
                    appID:"1566",
                    genQ: "true",
                    identifier: "entry1445"
                });
            </script> 

    <div class="onerow">

        <h2>Related Courses</h2>
        <?php if(empty($related)){?>
            <div class="onerow"> 
                <div class="seperator">
                    <div class="col6">
                        <h1 class="sep">No Realted Courses</h1>

                    </div>                    
                </div>
            </div>

            <?php }?>
        <?php
            if(!empty($related)){
                foreach($related as $relateds){    
                ?>
                <div class="col4 nus-res">
                    <img style="height: 231px;" src="<?php echo base_url('uploads/images/small/'.$relateds->images);?>" alt="" />
                    <h3><?= $relateds->name;?></h3>
                    <p><?=word_limiter($relateds->excerpt,15); ?></p>
                    <p class="button nus-btn"><a href="<?=base_url().$relateds->slug;?>">Details</a></p>
                </div>
                <?}}?>
        <!--<div class="col4 nus-res">
        <img src="img/inner_image.png" alt="" />
        <h3>Name of Course </h3>
        <p>a short description of this course ...</p>
        <p class="button nus-btn"><a href="#">Details</a></p>
        </div>-->
    </div> 
</section>

<div class="clear"></div>
<script type="text/javascript">
    function check_payment_price()
    {
        //alert('Please select price option before enrol.');

        price_val = jQuery('#price_option').val();        
        //alert(price_val);
        if(price_val == 0)
            {
            jQuery('#price_select_error').show();
            return false;
        }
        else
            {
            return true;
        }



    }
	
function set_price_text()
{
	
	var elt 	= document.getElementById('price_option');
    text 		= elt.options[elt.selectedIndex].text;
	document.getElementById("price_text").value = text;
	    
}
</script>        
   <?php include('footer.php')?> 
