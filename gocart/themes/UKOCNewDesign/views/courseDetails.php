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
div#buttonSet input
{
   color:#808080;  
}
form#informationRequest h4
{
       color:#808080;
}
form#informationRequest p
{
       color:#808080;
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
                            <p>Home  /  Courses  / <?=$product->name?></p>
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
                        <div class="col12">
                            
                              <h2><?=$product->name?></h2> 
                             <div id="price_select_error" style="display:none; color:#FF0000; font-weight:bold;">Please select a price option before you enrol</div> 
                            <?php if(!empty($product->price_options)){ ?>
                            <span class="custom-dropdown custom-dropdown--white">                                
                                <select class="custom-dropdown__select custom-dropdown__select--white" name="price_option" id="price_option">
                                    <option value="0">Price Options</option>
                                     <?php foreach($product->price_options as $price){?>
                                <option value="<?php echo $price->p_option_price?>"><?php echo $price->p_option_title?></option>
                                <?php }?>
                                </select>
                                </span>
                        
                                <?php } else{?>
                                <p itemprop="price" class="price"><span class="amount"><?=format_currency($product->price)?></span></p>
                                <?php }?>
                                <input type="hidden" name="id" value="<?php echo $product->id?>"/>
                                
                                <input style="float: right;margin-right: 28px;" type="submit" value=" Enrol Now" class="button" onClick=" return check_payment_price()" /> 
                        </div>
                        </form>
                        
                       
                        
                      <div class="col12">    
                       <ul class='tabs'>
                                 <li><a href='#question'>Question</a></li>
                                 <li><a href='#update'>Updates</a></li>
                                <li><a href='#tab2'>Reviews</a></li>
                                
                              </ul>
                              <div id='question'> 
                                <div class="details">
                                    <div class="reviews"><h2>Question</h2>
                                        <ul>
                                            <form method="post" action="<?php echo site_url();?>cart/question">
                                            <label>Your Question</label>
                                            <input type="text" name="question" >
                                            <input type="hidden" id="" name="product_id" value="<?php echo $product->id;?>">
                                            <input type="hidden" name="slug" value="<?php if($this->uri->segment(2)==""){echo $this->uri->segment(1);}
                                                            if($this->uri->segment(2)!=""){echo $this->uri->segment(1)."/".$this->uri->segment(2);}?>"/>
                                            <br/>
                                            <input style="float: right;margin-right: 31px;margin-top: 10px;" type="submit" value="Submit" class="button" /> 
                                            </form>

                                        </ul>
                                        <ul>
                                                  <?php $questions = $this->Product_model->get_question($product->id);
                                                //echo $this->show->pe($questions); exit;
                                                if(empty($questions)){echo "<i> There is No Question Yet</i>";}
                                                if(!empty($questions)){
                                                    foreach($questions as $question){
                                            ?>
                                                                       <br/>
                                                                       <br/>
                                                                       <br/>
                                                                       
                                                                         <hr/>
                                                                        <h4><?php echo 'User Name'.ucwords(strtolower($question->name));?></h4>
                                                                        <?php echo trim(ucwords(strtolower($question->question)));?>
                                                                        <div style="float: right;">
                                                                            <p class="button"><a class="button" href="javascript:void(0);"> Reply</a></p>
                                                                            <div class="clear"  style="margin-bottom: 10px;"></div>

                                                                        </div>
                                            
                                            <?php }}?>
                                        </ul>
                                     </div>
                                </div>
                                
                              </div>
                              <div id='update'> 
                                <div class="details">
                                    <div class="reviews"><h2>Updates</h2>
                                        <ul>
                                            <form><input type="text" >
                                            </form>
                                        </ul>
                                     </div>
                                </div>
                                
                              </div>
                              <div id='tab2'>
                                
                                <div class="details">
                                
                                    <div class="reviews"><h2>Reviews</h2>
                                         <p class="button"> <a  class="fancybox" href="#inline<?php if($this->go_cart->customer() != ""){echo "1";}if($this->go_cart->customer() == ""){echo"2";}?>"> Review</a></p>
                                        <ul>
                                            
                                    
                                               
                                        </ul>
                                     </div>
                                
                                </div>
                                
                              </div>
                              

                    </div>
                        <div id="inline1" style="width:400px;display: none;">
                        <div id="review_form">
                            <div id="respond">
                                <h3 id="reply-title">Add a review</h3>
                                <form action="<?=base_url()?>cart/review" method="post" id="commentform" name="review_form">
                                    <p class="comment-form-author">
                                        <label for="author">Name</label> <span class="required">*</span>
                                        <input id="author" name="name" type="text" value="" size="30" aria-required="true">
                                    </p>
                                    <p class="comment-form-email">
                                        <label for="email">Email</label> <span class="required">*</span>
                                        <input id="email" name="email" type="text" value="" size="30" aria-required="true">
                                    </p>
                                    <p class="comment-form-rating">
                                    <label for="rating">Rating</label>
                                    <script>
                                        function review1()
                                        {
                                            document.getElementById('rating').value = 1;
                                            return false;
                                        }
                                        function review2()
                                        {
                                            document.getElementById('rating').value = 2;
                                            return false;
                                        }
                                        function review3()
                                        {
                                            document.getElementById('rating').value = 3;
                                            return false;
                                        }
                                        function review4()
                                        {
                                            document.getElementById('rating').value = 4;
                                            return false;
                                        }
                                        function review5()
                                        {
                                            document.getElementById('rating').value = 5;
                                            return false;
                                        }
                                    </script>

                                    <p class="stars">
                                        <span>
                                            <a class="star-1" href="javascript:void(0)" onClick="return review1();">1</a>
                                            <a class="star-2" href="javascript:void(0)" onClick="return review2();">2</a>
                                            <a class="star-3" href="javascript:void(0)" onClick=" return review3();">3</a>
                                            <a class="star-4" href="javascript:void(0)" onClick="return review4();">4</a>
                                            <a class="star-5" href="javascript:void(0)" onClick=" return review5();">5</a>
                                        </span>
                                    </p>
                                    <input type="hidden" class="" id="rating" name="rating" value=""/>
                                    </p>
                                    <p class="comment-form-comment">
                                        <label for="comment">Your Review  </label>
                                        <textarea id="comment" name="review" cols="45" rows="8" aria-required="true"></textarea>
                                    </p>

                                    <input type="hidden" id="" name="product_id" value="<?php echo $product->id;?>">
                                    <input type="hidden" name="slug" value="<?php if($this->uri->segment(2)==""){echo $this->uri->segment(1);}
                                            if($this->uri->segment(2)!=""){echo $this->uri->segment(1)."/".$this->uri->segment(2);}?>"/>
                                    <p class="form-submit">

                                        <input name="submit" type="submit" id="submit" value="Submit Review" >


                                        <input type="hidden" name="comment_post_ID" value="850" id="comment_post_ID">
                                        <input type="hidden" name="comment_parent" id="comment_parent" value="0">
                                    </p>
                                </form>
                            </div><!-- #respond -->
                        </div>
                        </div>
                        <div id="inline2" style=" width:337px; display: none;">

                        <div class="simpleTabs" style="padding-left: 0px;">
                            <ul class="simpleTabsNavigation">
                                <li class="description_tab active"><a href="#question">Customer Login</a></li>
                                <li class="description_tab active"><a href="#updates">Tutor Login</a></li>


                            </ul>
                            <div  class="simpleTabsContent" id="question">


                                <div class="widget-inner">

                                    <h3>Customer Login</h3>

                                    <form method="post" action="<?=base_url()?>secure/login" name="customer_form">

                                        <p>

                                            <label for="user_login">Username or email</label>

                                            <input name="email" class="input-text" id="user_login" type="text">

                                        </p>

                                        <p>

                                            <label for="user_pass">Password</label>

                                            <input name="password" class="input-text" id="user_pass" type="password">

                                        </p>

                                        <p>
                                            <input type="hidden" name="review_login" value="customer_review"/>
                                            <input type="hidden" id="" name="product_id" value="<?php echo $product->id;?>">
                                            <input type="hidden" name="slug" value="<?php if($this->uri->segment(2)==""){echo $this->uri->segment(1);}
                                                    if($this->uri->segment(2)!=""){echo $this->uri->segment(1)."/".$this->uri->segment(2);}?>"/>
                                            <input class="submitbutton" name="submitted" id="wp-submit" value="Login →" type="submit" />
                                            <a class="button" href="<?php echo site_url('secure/register')?>"> Register</a>
                                            <a href="<?php echo site_url('secure/forgot_password')?>">Lost password?</a></p>

                                        <div>

                                            <!--<input name="redirect_to" class="redirect_to" value="" type="hidden">-->

                                            <input name="testcookie" value="1" type="hidden">

                                            <input name="woocommerce_login" value="1" type="hidden">

                                            <input name="rememberme" value="forever" type="hidden">

                                        </div>

                                    </form>

                                    <ul class="pagenav">

                                    </ul>

                                </div>

                            </div>

                            <div  class="simpleTabsContent" id="updates">

                                <div class="widget-inner">
                                    <h3>Tutor Login</h3>
                                    <form class="bs-docs-example form-horizontal" accept-charset="utf-8" method="post" action="<?=base_url()?>tutor_login/login">
                                        <p style="width: 325px;">
                                            <label for="user_login">Username or email</label>
                                            <input name="email" class="input-text" id="user_login" type="text">
                                        </p>
                                        <p style="width: 325px;">
                                            <label for="user_pass">Password</label>
                                            <input name="password" class="input-text" id="user_pass" type="password">
                                        </p>
                                        <p style="width: 325px;">
                                            <input type="hidden" id="" name="product_id" value="<?php echo $product->id;?>">
                                            <input type="hidden" name="slug" value="<?php if($this->uri->segment(2)==""){echo $this->uri->segment(1);}
                                                    if($this->uri->segment(2)!=""){echo $this->uri->segment(1)."/".$this->uri->segment(2);}?>"/>
                                            <input type="hidden" name="review_login" value="tutor_review"/>
                                            <input class="submitbutton" name="submitted" id="wp-submit" value="Login →" type="submit">
                                            <a class="button" href="<?php echo site_url('tutor_login/register')?>"> Register</a>

                                            <a href="<?php echo site_url('tutor_login/forgot_password')?>">Lost password?</a></p>
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

                            </div>


                        </div>

                    </div>

                        
                         
                        
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
                                    <p><?=$tabs['tab_content']?></p>
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
                            <img src="<?php echo theme_assets('img/image_nus.png');?>" alt="NUS Extra Card" /> 
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
</script>        
   <?php include('footer.php')?> 
