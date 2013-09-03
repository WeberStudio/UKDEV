<div id="darkf" >
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
                                $date = new DateTime($recent_blog_post[$i]->post_date_gmt);
                                $newFormate = $date->format('F j, Y, g:i a');
                                $newFormate =   explode(',',$newFormate);
                                $monthDay =  explode(' ', $newFormate[0]);

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
                                <time datetime="<?=$recent_blog_post[$i]->post_date_gmt?>"> <span class="day"><?=$monthDay[1]?></span> <span class="mounth"><?=substr($monthDay[0], 0, 3);?>.</span> <span class="time"><?=$newFormate[2]?></span> </time>
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

        <div class="row dop-row">
            <div class="five columns">
                <section class="footer-logo">
                    <a  href="<?=base_url()?>cart/">
                        <img src="<?php echo theme_img("footer-logo.png")?>" alt="OneTouch">
                    </a>

                </section>
            </div>
            <div class="five columns">
                <section class="widget widget_info">
                    <div class="info-widget">
                        <div class="subtitle">IT IS REALLY INTERESTING</div>
						<? $page_data = $this->Page_model->get_page('6'); 
							//$this->show->pe($page_data);
						?>
                        <h3><a href="<?=base_url().$page_data->slug?>">About company</a></h3>                        
						<? echo str_replace(substr(substr($page_data->content, 0,150), -6),"..." ,substr($page_data->content, 0,150));?>
						</p>						
                    </div>
                </section>
            </div>
            <div class="five columns">
                <section class="adress-icon">
                    <div data-picture data-alt="adress-icon" class="inline-icon">
                        <div data-src="<?php echo theme_img("icons/map_w.png");?>"></div>
                        <div data-src="<?php echo theme_img("icons/map_w@2x.png");?>" data-media="(min-width: 400px) and (min-device-pixel-ratio: 1.5)"></div>

                        <noscript>
                            <img src="<?php echo theme_img("custom-slider-img/map_w.png");?>" alt="adress-icon" class="adress-icon">
                        </noscript>
                    </div>
                    <p>Address:   UK Open College Limited 4, Copthall House The Meridian Station Square Coventry West Midlands CV1 2FL
                        <br>
                        Phone:     (0121) 288-0181</p>
                </section>
            </div>
        </div>

        <div class="row">
            <div class="five columns">
                <a href="<?php echo site_url('tutor_login');?>"  style="color:#FFF; font-size:12px;"><?php echo "Tutor Login"; ?></a>
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