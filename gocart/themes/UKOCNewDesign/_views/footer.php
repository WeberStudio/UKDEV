
<footer>
            
                <div class="onerow">
                
                    <div class="col12" id="facebook-lower">
                        <div class="col6 facebook-res">
                            <h2>facebook</h2>
                            
                            
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
                           
                        <div class="fb-like-box" data-href="https://www.facebook.com/pages/UK-Open-College/411574175557181" data-width="292" data-show-faces="true" data-colorscheme="dark" data-stream="false" data-show-border="false" data-header="false"></div>            
                    </div>
                </section>
            
                            
                        </div>
                        
                        <div class="col6 recent-res">
                            <h2> Recent Posts </h2>
                            
                            <ul>
                            
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
                               
                                <time datetime="<?=$recent_blog_post[$i]->post_date_gmt?>"> <!--<img src="<?php echo theme_img("icons/post.png");?>" alt="">-->  </time> 
                                 
                                 
                             <li>
                             <p> <?=$post_content?> </p>
                                <div class="entry-content"> <a href='<?=$recent_blog_post[$i]->guid?>' class="title" target="_blank"><?=$recent_blog_post[$i]->post_title?></a>
                                    
                                </div>
                              </li>
                                 
                            </article>
                            <? } ?>
                                
                            </ul>
                        </div>
                    </div>
                    
                
                </div>
                
                <div class="onerow">
                    <div class="col12 footer">
                        
                        <div class="col9 copyright-menu">
                            <ul>
                            <li><a href="<?php echo base_url().'tutor_login/login'?>">Tutor_login</a></li>
                           <?php
                          $footer_pages = $this->Page_model->get_pages_by_position('footer_page');
                          foreach($footer_pages as $footer_page)
                          { ?>
                                <li><a href="<?php echo $footer_page->slug; ?>"><?php echo $footer_page->title;?></a></li>    
                          <?php
                          } 
                          ?>
                            </ul>
                        </div>
                        
                        <div class="col3 copyright">
                            Copyrights &copy; - All Rights Reserved
                        </div>
                        
                    </div>
                </div>
            
            </footer>
            
        </div><!-- close onepcssgrid-1200 -->
        
        
       <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
       <script>window.jQuery || document.write('<script src="<?php echo theme_js('js/vendor/migrate-1.2.1.js')?>"><\/script>')</script>
       
       <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
       <script>window.jQuery || document.write('<script src="<?php echo theme_js('js/vendor/jquery-1.9.1.min.js')?>"><\/script>')</script>
        
<!--        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>-->


        
       <script src="<?php echo theme_js('js/plugins.js')?>"></script>
       <script src="<?php echo theme_js('js/main.js')?>"></script>
        
       <script src="<?php echo theme_js('js/slides.jquery.js')?>"></script>
       <script>
        $(function(){
            $('#slides').slides({
                preload: true,
                preloadImage: 'img/loading.gif',
                play: 5000,
                pause: 2500,
                hoverPause: true,
                pagination: false,
                effect: 'fade',
                crossfade: true,
                generatePagination: false,
                
            });
        });
        
        function cycleImages(){
          var $active = $('#cycler .active');
          var $next = ($active.next().length > 0) ? $active.next() : $('#cycler img:first');
          $next.css('z-index',2);//move the next image up the pile
          $active.fadeOut(1500,function(){//fade out the top image
          $active.css('z-index',1).show().removeClass('active');//reset the z-index and unhide the image
              $next.css('z-index',3).addClass('active');//make the next image the top one
          });
        }
    
        $(document).ready(function(){
        // run every 7s
        setInterval('cycleImages()', 7000);
        })
        
        </script>
    
    
        <script type="text/javascript" src="<?php echo theme_js('js/jquery.easing.1.3.js')?>"></script>
        <!-- the jScrollPane script -->
        <script type="text/javascript" src="<?php echo theme_js('js/jquery.mousewheel.js')?>"></script>
        <script type="text/javascript" src="<?php echo theme_js('js/jquery.contentcarousel.js')?>"></script>
        
        <script>
           $('#ca-container').contentcarousel({
                scroll : 6,
            });
        </script>
        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src='//www.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
        
       
    </body>
</html>