 <div id="darktf" >
        <div class="row">
<div class="topfooter">
  <div class="t_footer_contect"> <br/>
    <div class="t_footer_title"> want to know about us?</div>
    <div class="t_footer_img">
      img
    </div>
    <div class="block_content" >
     	<div class="seven columns">
         <div class="two columns firstt">
        <span class=""><img class="icon" src="<?php echo theme_img('t_icons/Payments.png');?>"\> 
        
        </span>
         <b  class="bottom_page_head">Payment</b>
        <p class="bottom_page_content">We accept all types of debit and credit card. All cards can be processed using... <b class="read_more"><a href="<?=base_url()?>payment" >Read More</a></b></p>
        </div>
        
         <div class="two columns">
        <span><img class="icon" src="<?php echo theme_img('t_icons/index-page-02-Recovered_05.gif');?>"\> </span>
        <b  class="bottom_page_head">NUS Extra Card</b>
        <p class="bottom_page_content">UK Open College is pleased to announce that we are now an NUS...<b class="read_more"><a href="<?=base_url()?>nus-extra-card" >Read More</a></b> </p>
        </div>
        
         <div class="two columns">
        <span><img class="icon" src="<?php echo theme_img('t_icons/index-page-02-Recovered_07.gif');?>"\></span>
        <b  class="bottom_page_head">Complaints</b>
        <p class="bottom_page_content">Our aim at UK Open College is to provide a professional yet...<b class="read_more"><a href="<?=base_url()?>complaints" >Read More</a></b></p>
        </div>
        
         <div class="two columns lastone">
        <span><img class="icon" src="<?php echo theme_img('t_icons/index-page-02-Recovered_09.gif');?>"\> </span>
        <b  class="bottom_page_head">How It Works?</b>
        <p class="bottom_page_content">Home study courses are now seen as the ideal way of learning...<b class="read_more"><a href="<?=base_url()?>how-it-works" >Read More</a></b></p>
        </div>
       
       
         <div class="two columns firstt">
        <span><img class="icon" src="<?php echo theme_img('t_icons/index-page-02-Recovered_16.gif');?>"\> </span>
        <b  class="bottom_page_head">Qualifications</b>
        <p class="bottom_page_content">We have complied an overview below to try and help explain the...<b class="read_more"><a href="<?=base_url()?>qualification" >Read More</a></b> </p>
        </div>
        
         <div class="two columns">
        <span><img class="icon" src="<?php echo theme_img('t_icons/index-page-02-Recovered_17.gif');?>"\> </span>
        <b  class="bottom_page_head">Price Promise</b>
        <p class="bottom_page_content">We offer a price promise to beat any quote you have received from... <b class="read_more"><a href="<?=base_url()?>price-promise" >Read More</a></b></p>
        </div>
        
         <div class="two columns">
        <span><img class="icon" src="<?php echo theme_img('t_icons/index-page-02-Recovered_15.gif');?>"\> </span>
        <b  class="bottom_page_head">Special Considerations</b>
        <p class="bottom_page_content">Here at UK Open College we endeavour to make our courses...<b class="read_more"><a href="<?=base_url()?>special-considerations" >Read More</a></b>   </p>
        </div>
        
         <div class="two columns lastone">
        <span><img class="icon" src="<?php echo theme_img('t_icons/index-page-02-Recovered_18.png');?>"\> </span>
        <b  class="bottom_page_head">UCAS Points</b>
        <p class="bottom_page_content">UCAS points or credits, what they are and what they are used for...<b class="read_more"><a href="<?=base_url()?>ucas-points" >Read More</a></b></p>
        </div>
         </div>
    </div>
  </div>
</div>
</div>
</div>
 

<div id="darkf" >


<div style="border-bottom: 5px solid #14166f;"></div>   

    <section id="footer" role="contentinfo">
        <div class="row">
            <div class="five columns">
                <section id="crum_latest_tweets-2" class="widget-1 widget-first widget twitter-widget">
                    <div class="widget-inner">
                        <div class="subtitle">Our latest twitter news</div>
                        <h3>Latest Tweets</h3>
                        <?php  

                            $userid = 'UKOpen'; //your handle
                            $count = '3';
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
                                            echo '<div class="tweet">';  
                                            $tweet_text = $tweet->text; //get the tweet

                                            // make links link to URL
                                            $tweet_text = preg_replace("#(^|[\n ])([\w]+?://[\w\#$%&~/.\-;:=,?@\[\]+]*)#is", "\\1<a href='\\2'>\\2</a>", $tweet_text); 

                                            // make hashtags link to a search for that hashtag
                                            $tweet_text = preg_replace("/#([a-z_0-9]+)/i", "<a href=\"http://twitter.com/search/$1\">$0</a>", $tweet_text);

                                            // make mention link to actual twitter page of that person
                                            $tweet_text = preg_replace("/@([a-z_0-9]+)/i", "<a href=\"http://twitter.com/$1\">$0</a>", $tweet_text);

                                            // display each tweet in a list item
                                            echo  $tweet_text ;
                                            echo "<div class='time'>$days days ago</div> " ;
                                            echo '</div>';  
                                        }

                                    } 
                                }

                            }

                       
?>


                        <!--  Crumina: Check this! Great #themeforest item 'One Touch - Multifunctional Metro Stylish Theme'
                        <div class='time'>77 days ago</div>

                        <div class='tweet'>Crumina: BGs
                        <div class='time'>105 days ago</div>
                        </div>
                        <div class='tweet'>Crumina: Check this! Great creative Photo and video WP Theme - Boson.
                        <div class='time'>111 days ago</div>
                        </div> -->
                    </div>
                </section>
            </div>
			
            <div class="five columns">   
                <section id="recent_posts-2" class="widget-1 widget-first widget recent-posts-widget">
                    <div class="widget-inner">
                        <div class="subtitle"> Some latest news</div>
                        <h3>Recent posts</h3>
                        <?
                            $recent_blog_post = $this->Category_model->get_blog_posts(); 
                            for($i=0; $i<count($recent_blog_post);$i++)    
                            {
                               /* $date = new DateTime($recent_blog_post[$i]->post_date_gmt);
                                $newFormate = $date->format('F j, Y, g:i a');
                                $newFormate =   explode(',',$newFormate);
                                $monthDay =  explode(' ', $newFormate[0]);*/

                                //DebugBreak();
                                $length = strlen($recent_blog_post[$i]->post_content);
                                $post_content = '';
                                if($length> 600)
                                {
                                    $post_content = substr($recent_blog_post[$i]->post_content,0,150); 
                                }
                                else
                                {
                                    $post_content = $recent_blog_post[$i]->post_content;
                                }

                            ?>
                            <article class="mini date">
                               
                                <time datetime="<?=$recent_blog_post[$i]->post_date_gmt?>"> <img src="<?php echo theme_img("icons/post.png");?>" alt="">  </time> 
                                <div class="entry-content"> <a href='<?=$recent_blog_post[$i]->guid?>' class="title" target="_blank"><?=$recent_blog_post[$i]->post_title?></a>
                                    <p> <?=$post_content?> </p>
                                </div>
                            </article>
                            <? } ?>
                    </div>
                </section>
            </div>
			
            <div class="five columns">
                <section id="facebook_widget-2" class="widget-1 widget-first widget widget_facebook_widget">
                    <div id="fb-root"></div>
                    <script>(function(d, s, id) {
                            var js, fjs = d.getElementsByTagName(s)[0];
                            if (d.getElementById(id)) return;
                            js = d.createElement(s); js.id = id;
                            js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&status=0";
                            fjs.parentNode.insertBefore(js, fjs);
                        }(document, 'script', 'facebook-jssdk'));</script>
                    <div class="widget-inner">
                        <div class="subtitle">Integrated facebook widget</div>
                        <h3>Facebook widget</h3>    
                        <div class="fb-like-box" data-href="https://www.facebook.com/pages/UK-Open-College/411574175557181" data-width="292" data-show-faces="true" data-colorscheme="dark" data-stream="false" data-show-border="false" data-header="false"></div>            
                    </div>
                </section>
            </div>
        </div>

        <div class="row">
            <div class="five columns"></div>
            <div class="five columns">
            
            <a target="_blank" href="" ><img align="right" style="margin-left: 10px; margin-top: 5px" src="<?php echo theme_img("img/twiter-logo.png");?>" alt=""></a>
            <a target="_blank" href="http://www.linkedin.com/pub/uk-open-college-uoc/6a/5a0/2b7" ><img align="right" style="margin-left: 10px; margin-top: 5px" src="<?php echo theme_img("img/link-in.png");?>" alt=""></a>
            <a target="_blank" href="https://www.youtube.com" ><img align="right" style="margin-left: 10px; margin-top: 5px" src="<?php echo theme_img("img/youtube.png");?>" alt=""></a>
            <a target="_blank" href="https://www.facebook.com/pages/UK-Open-College/411574175557181" ><img align="right" style="margin-left: 10px; margin-top: 5px" src="<?php echo theme_img("img/face-book.png");?>" alt=""></a>
          
                   
            </div>
        </div>
       
       
    </section>
 <div style="border-top : 5px solid #14166f;"></div>
 <section style="padding: 30px 0 10px 0;margin: 0 auto 0 auto; background: #282a2b !important;">    
 <div class="row">
            <div style="float: left;">
            Copyrights @ 2013 & All Rights Reserved
            </div>
             <div class="" style="text-align: right">
                 <a href="<?php echo site_url('tutor_login');?>"  style="font-size:12px;"><?php echo "Tutor Login"; ?></a> / <a href="privacy-policy">Privacy Policy</a> / <a href="terms-of-service">Terms of Service</a> / <a href="faq">FAQ's</a> / <a href="about-us">About Us</a> / <a href="cancellation-returns">Cancellation Returns</a> / <a href="student-feedback">Student Feedback</a> / <a href="corporate-clients">Corporate Clients</a> / <a href="student-forum">Student Forum</a>
            </div>
        </div> 
 </section>      
</div>


<a href="#" id="linkTop" class="backtotop"> <span></span> </a> 


<?php echo theme_css('farbtastic1.3.css', true); ?>
<?php echo theme_css('grid.css', true); ?>
<?php echo theme_js('js/jquery-plugins.min.js', true);?> 
<?php echo theme_js('js/aqpb-view.js', true);?> 
<?php echo theme_js('js/add-to-cart.min.js', true);?> 
<?php echo theme_js('js/jquery.ui.core.min.js', true);?> 
<?php echo theme_js('js/jquery.ui.widget.min.js', true);?> 
<?php echo theme_js('js/jquery.ui.tabs.min.js', true);?>
<?php echo theme_js('js/jquery-ui-tabs-rotate.js', true);?>
<?php echo theme_js('js/js_composer_front.js', true);?> 
<?php echo theme_js('js/jquery.isotope.min.js', true);?>
<?php echo theme_js('js/metro-list.js', true);?> 
<?php echo theme_js('js/jquery.easing.1.3.js', true);?>
<?php echo theme_js('js/jquery.nicescroll.js', true);?>
<?php echo theme_js('js/jquery.colorbox.js', true);?>
<?php echo theme_js('js/jflickrfeed.min.js', true);?>
<?php echo theme_js('js/site.js', true);?> 
<?php echo theme_js('js/farbtastic.js', true);?> 
<?php echo theme_js('js/custom_style.js', true);?> 
<?php echo theme_js('js/jquery.quicksand.js', true);?>
<?php echo theme_js('js/jquery.prettyPhoto.js', true);?>
<?php echo theme_js('js/jquery.masonry.min.js', true);?>
<?php echo theme_js('js/scrolling.js', true);?>
<?php echo theme_js('js/woocommerce.min.js?ver=1.6.6', true);?>


</body>
</html>