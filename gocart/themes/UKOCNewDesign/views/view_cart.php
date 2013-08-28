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
            
            <section>
                
                 
                 <div class="onerow">
                 
                 <div class="seperator">
                     <div class="col6">
                        <h1 class="sep">Open the Door of Opportunity</h1>
                        <p class="sep"><a href="#">view all of our courses</a></p>
                    </div>
                    
                    
                     <div class="col6 social-icons">
                        <a href="https://twitter.com/UKOpen" target="_blank"> <img align="right" alt="" src="http://87.106.234.213/gocart/themes/oneTouch/assets/images/img/twiter-logo.png" style="margin-left: 10px; margin-top: 5px"></img> </a>
                        <a href="http://www.linkedin.com/company/uk-open-college/products?trk=tabs_biz_product" target="_blank"> <img align="right" alt="" src="http://87.106.234.213/gocart/themes/oneTouch/assets/images/img/link-in.png" style="margin-left: 10px; margin-top: 5px"></img> </a>
                        <a href="http://www.youtube.com/watch?v=4dabsHc8yNE&feature=youtube" target="_blank"> <img align="right" alt="" src="http://87.106.234.213/gocart/themes/oneTouch/assets/images/img/youtube.png" style="margin-left: 10px; margin-top: 5px"></img> </a>
                        <a href="https://www.facebook.com/pages/UK-Open-College/411574175557181" target="_blank"><img align="right" alt="" src="http://87.106.234.213/gocart/themes/oneTouch/assets/images/img/face-book.png" style="margin-left: 10px; margin-top: 5px"></img></a>
                     </div>
                     
                   </div>
                 </div>
                 
                 
                 <!-- end seperator row -->
                 
                 
                 
                 <div class="onerow">
                     <div class="col8">
                        
                        
                        <h2>Cart</h2>
                        <?php 
    if($this->session->flashdata('message'))
    {
        $message    = $this->session->flashdata('message');
    }
    
    if($this->session->flashdata('error'))
    {
        $error    = $this->session->flashdata('error');
    }
    if(validation_errors() != '')
    {
        $error    = validation_errors();
    }
    ?>
    
   
   
    <?php if (!empty($error)): ?>
          <div class="alert alert-error" id="closee"> <a href="javascript:void(0)"  class="close" data-dismiss="alert" onClick="showStuff(); return false;">x</a> <?php echo"<div style='margin-left: 70px;'>". $error. "</div>"; ?> </div>
          <?php endif; ?>
          
      
          <?php if (!empty($message)): ?>
        <div class="alert alert-success">
            <a class="close" data-dismiss="alert">×</a>
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
                        
                        <div class="cart-wrapper">
                             <?php echo form_open('cart/update_cart', array('id'=>'update_cart_form'));?> 
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="border-full">
                              <tr class="border-below">
                                <td><h3>Items</h3></td>
                                <td><h3>Course Name</h3></td>
                                <td><h3>Price</h3></td>
                              </tr>
                              <?php
                                foreach ($this->go_cart->contents() as $cartkey=>$product):?>
                              <tr class="border-below">
                                <td>
                                <a href="#" onclick="if(confirm('<?php echo lang('remove_item');?>')){window.location='<?php echo site_url('cart/remove_item/'.$cartkey);?>';}"><div id="cancel"></div></a>
                                <div class="cart-thumb"><img src="<?=base_url('uploads/images/thumbnails/'.$product['images'])?>" alt="" style="height: 45px; width: 45px;"/></div>
                                </td>
                                <td><a href="<?php echo $product['slug']; ?>"><?php echo $product['name']; ?></a></td>
                                <td><?php echo format_currency($product['price']);?></td>
                              </tr>
                               <?php endforeach;?> 
                              <tr class="border-below">
                                <td>&nbsp;</td>
                                <td><h3>Total Price</h3></td>
                                <td><?php echo format_currency($this->go_cart->total()); ?></td>
                              </tr>
                              <tr>
                                <td><input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" style=""> </td>
                                <td style="width: 223px;"><input style="padding: 5px;" type="submit" class="button" name="apply_coupon" value="Apply Coupon"></td>
                                <td align="right">
                                <?php if($this->Customer_model->is_logged_in(false, false))
                                {
                                ?>
                                  <a style=" padding: 5px;" class="contact-btn"  href="<?= base_url().'cart/allcourses/'?>"> Return to Courses</a>
                                  <a style=" padding: 5px;" class="contact-btn" href="<?=base_url().'checkout';?>">Proceed to Checkout</a>    
                                <?php    
                                }
                                else
                                {
                                ?>
                                 <a style=" padding: 5px;" class="contact-btn"  href="<?= base_url().'cart/allcourses/'?>"> Return to Courses</a>
                                <a style="padding: 5px;" class="contact-btn" href="<?=base_url().'checkout/unregister';?>">Proceed to Checkout</a>
                                
                               <?php }?>
                                
                                </td>
                              </tr>
                            </table>
                             </form>
                         
                            
                            <div class="col6">
                            </div>
                            
                            <div class="col6">
                            
                            <h2>Cart totals</h2>
                            
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="border-full bg-grey">
                              <tr>
                                <td><h3>Total Price</h3></td>
                                <td align="right"><h2 class="dark-blue"><?php echo format_currency($this->go_cart->total()); ?></h2></td>
                              </tr>
                              
                            </table>
                            </div>
                        </div>
                          <span style="color:#666; font-size:11px; margin-left: 451px;"> We accept the following Sage Pay, PayPal, All Debit and Credit Cards. </span>
                         <div class = "payment_options">
                                        <img align="right" style="margin-left: 10px; margin-top: 5px" src="<?=theme_assets('images/pay_cards/maestro.png')?>" alt="">
                                        <img align="right" style="margin-left: 10px; margin-top: 5px" src="<?=theme_assets('images/pay_cards/mc.png')?>" alt="">
                                        <img align="right" style="margin-left: 10px; margin-top: 5px" src="<?=theme_assets('images/pay_cards/PayPal_mark.gif')?>" alt="">
                                        <img align="right" style="margin-left: 10px; margin-top: 5px" src="<?=theme_assets('images/pay_cards/solo.png')?>" alt="">
                                        <img align="right" style="margin-left: 10px; margin-top: 5px" src="<?=theme_assets('images/pay_cards/visa.png')?>" alt="">
                                         <img align="right" style="margin-left: 10px; margin-top: 5px" src="<?=theme_assets('images/pay_cards/visa_debit.png')?>" alt="">
                                          <img align="right" style="margin-left: 10px; margin-top: 5px" src="<?=theme_assets('images/pay_cards/visa_electron.png')?>" alt="">
                                    </div>
                        
                    </div><!-- end col8 -->
                    
                    
                    
                    <div class="col4">
                        
                        <div class="col12 user-login" style="margin-top:20px;">
                        
                        <h2>User Login</h2>
                            <form action="mail.php" method="POST" autocomplete="on">
                              <p class="username">
                              User Name
                              </p>
                                <input type="text" name="name" id="name" placeholder="" required />
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
                        
                        
                        
                        <div class="col12 twitter-res">
                            <img src="<?php echo theme_assets('img/twitter_icon.png')?>" alt="" />  
                                <h2>twitter</h2>
                                <ul>
                                    <section id="crum_latest_tweets-2" class="widget-1 widget-first widget twitter-widget">
                                        <div class="widget-inner">
                                            <div class="subtitle">Our latest twitter news</div>
                                            <h3>Latest Tweets</h3>
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
                        
                    </div>
                   
                 </div><!-- end all courses row -->
                 
                 
                 <!--<div class="onerow">
                 
                 <h2>Related Courses</h2>
                 
                         <div class="col4 nus-res">
                            <img src="img/inner_image.png" alt="" />
                            <h3>Name of Course </h3>
                            <p>a short description of this course ...</p>
                            <p class="button nus-btn"><a href="#">Details</a></p>
                        </div>
                        
                        <div class="col4 nus-res">
                            <img src="img/inner_image.png" alt="" />
                            <h3>Name of Course </h3>
                            <p>a short description of this course ...</p>
                            <p class="button nus-btn"><a href="#">Details</a></p>
                        </div>
                        
                        <div class="col4 nus-res">
                            <img src="img/inner_image.png" alt="" />
                            <h3>Name of Course </h3>
                            <p>a short description of this course ...</p>
                            <p class="button nus-btn"><a href="#">Details</a></p>
                        </div>
                 </div>-->
                 
                 
                 
                 
          </section>             
            <div class="clear"></div>
            

  <?php include('footer.php')?>
