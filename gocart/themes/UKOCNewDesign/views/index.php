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
               
                
                    <!-- banner section -->
                    <section class="banner-area">
                                   
                                    <div id="slides">
                                      <div class="slides_container">
                                        
                                        <div class="slide"> <img src="<?php echo theme_assets('img/College-Students-Strengthen-your-Time-Management-Skills-Research.jpg')?>" style="height: 795px; width: 1180px;" alt="Slide1" >
                                        </div>
                                        
                                        <div class="slide"> <img src="<?php echo theme_assets('img/college-students.jpg')?>" style="height: 795px; width: 1180px;" alt="Slide2">
                                        </div>

                                      </div>
                              
                              <a href="#" class="prev"><img src="<?php echo theme_assets('img/prev.png')?>" alt="Previous" /></a> <a href="#" class="next"><img src="<?php echo theme_assets('img/next.png')?>" alt="Next" /></a>
                        
                        
                            <article class="slider-wrapper">
                                <?php
                                $i=1;   
                                foreach($menu_categories as $menu_category)
                                {
                                if($i<=6){  
                                ?>
                                <a href="<?php echo base_url().$menu_category['category']->slug?>"> 
                                <div class="featured-course blue-featured-<?php echo $i;?>">
                                 <p style="padding-top: 165px;text-align: center;font-size: 22px;"><b><?php echo $menu_category['category']->name;?></b></p>
                                </div>
</a>
                                
                                <?php
 
                                  $i++;
                                 
                                } 
                                }?>
                                

                            </article>
                        
                        
                          </div><!-- end slides-->
                    </section>
                     <!-- /banner section -->
                     
                 </div>
                 
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
				 
                    <div class="col4 nus-res">
                        <!--<img src="<?php echo theme_assets('img/image_nus.png');?>" alt="NUS Extra Card" />-->
						 <img style="width:380px; height:190px;" src="<?php echo 'http://87.106.234.213/uploads/images/full/'.$special_pages->image //theme_assets('img/image_nus.png');?>"  />
                        <h2><?php echo $special_pages->title?></h2>
                        <p><?php echo $special_pages->fornt_content;?></p>
                        <p class="button nus-btn"><a href="<?php echo base_url().$special_pages->slug?>">Details</a></p>
                    </div>
                    
                    <div class="col4 video-res">
                        <iframe src="http://player.vimeo.com/video/72632269" width="350" height="225" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe> <p><a href="http://vimeo.com/72632269">BEYOND, sci fi short film</a> from <a href="http://vimeo.com/lightworker">Raphael Rogers</a> on <a href="https://vimeo.com">Vimeo</a>.</p>
                    </div>
                    
                    <div class="col4 twitter-res">
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
                
                
                 <!-- six new sections -->
                 <div class="onerow">
                      <div class="onerow">
                    <?php
                       if(!empty($grid_pages)){
                          // echo '<pre>';print_r($grid_pages);echo '</pre>';exit;
                     foreach($grid_pages as $grid_page){
                         if( $grid_page->id!='1' && $grid_page->id!='12'){
                         ?>
                         
                      <div class="col4 nus-res">
                            <img style="width:380px; height:190px;" src="<?php echo 'http://87.106.234.213/uploads/images/full/'.$grid_page->image //theme_assets('img/image_nus.png');?>"  />
                            <h2><?php echo $grid_page->title;?></h2>
                            <p><?php echo $grid_page->fornt_content;?></p>
                            <p class="button nus-btn"><a href="<?php echo $grid_page->slug;?>">Details</a></p>
                      </div>
                      <?php }}}?>

                     
                     </div>
                     
                     
                     </div>
                
                
                 
          </section>
            
            <div class="clear"></div>
        
   <?php include('footer.php')?> 