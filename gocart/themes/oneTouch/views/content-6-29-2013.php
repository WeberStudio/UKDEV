<div class="row">
  <div id = "content" class = "fifteen columns" >
    <div class = "row" >
      <div id="aq-block-1" class="aq-block clearing-container aq-block-aq_info_row_block fifteen columns aq-first cf"> </div>
      <div id="aq-block-2" class="aq-block aq-block-aq_hslider_posts_block fifteen columns aq-first cf">
        <div class="wrap" style="margin:;  ">
          <div class="scroll-box" data-boxed="1">
            <div class = "dragger">
              <div class="grid">
                <div class = "gr-box">

                
                  <?php
                  
                  //$this->show->pe($this->categories);
                  $count = 0;
                  foreach($this->categories as $cat_info){
                 //echo '<pre>' ;print_r($cat_info);
                  $count = $count + 1; 
                  if($count%2==0)
                  {
                  ?>
                      <div class="item half even"> 
                        <img src="<?php echo catogery_img('images/small/'.$cat_info['category']->image); ?>" style="margin:0 0;" alt="The Clover Trail (Atom Z2760) Review: Acer&#8217;s W510 Tested" title="The Clover Trail (Atom Z2760) Review: Acer&#8217;s W510 Tested" >
                        <div class="description disp">
                          <time><? echo $cat_info['category']->publish_date?></time>
                          <h4><? echo $cat_info['category']->name?></h4>
                          <p><? //echo str_replace(substr(substr($cat_info['category']->description, 0,150), -6),"..." ,substr($cat_info['category']->description, 0,150));
						  		if(isset($cat_info['category']->excerpt) && !empty($cat_info['category']->excerpt))
								{
									echo word_limiter($cat_info['category']->excerpt, 150);
						  		}
						  ?>
                          </p>
                         
                        </div>
                        <a href="<?=base_url().$cat_info['category']->slug?>"></a> 
                        </div>
                  <? } else { ?>
                       <div class="item half odd">
                        <img src="<?php echo catogery_img('images/small/'.$cat_info['category']->image); ?>" style="margin:0 0;" alt="The Clover Trail (Atom Z2760) Review: Acer&#8217;s W510 Tested" title="The Clover Trail (Atom Z2760) Review: Acer&#8217;s W510 Tested" >
                        <div class="description hided">
                          <time><? echo $cat_info['category']->publish_date?></time>
                          <h4><? echo $cat_info['category']->name?></h4>
                          <p><? //echo str_replace(substr(substr($cat_info['category']->description, 0,150), -6),"..." ,substr($cat_info['category']->description, 0,150));
						  		if(isset($cat_info['category']->excerpt) && !empty($cat_info['category']->excerpt))
								{
									echo word_limiter($cat_info['category']->excerpt, 150);
						  		}
						  ?>
                          </p>
                        </div>
                        <a href="<?=base_url().$cat_info['category']->slug?>"></a> 
                        </div>
                  <? }  
                      if($count%4==0)
                      {
                        echo '</div><div class = "gr-box">';
                      }
                       
                     
                  } ?>
                
                
              </div>
            </div>
          </div>
          <script type="text/javascript">
                        jQuery(document).ready(function() {
                            var countElements = jQuery(".scroll-box .grid .gr-box").size();
                            jQuery(".scroll-box .grid").width(countElements*728);

                            var scrollbox = jQuery(".scroll-box");
                            var indent = ( jQuery(window).width() - jQuery(".fifteen.columns>.wrap").width() ) / 2;

                            setBoxedSlider();

                            var animateTime = 1,
                            offsetStep = 5;

                            scrollWrapper = jQuery('.scroll-box');
                            scrollContent = jQuery('.scroll-box .grid');

                            //event handling for buttons "left", "right"
                            jQuery('.bttL')
                            .mousedown(function() {
                                scrollContent.data('loop', true).loopingAnimation(jQuery(this), jQuery(this).is('.bttR') );
                            })
                            .bind("mouseup mouseout", function(){
                                //scrollContent.data('loop', false).stop();
                            });

                            jQuery.fn.loopingAnimation = function(el, dir){
                                if(this.data('loop')){
                                    var sign = (dir) ? '-=' : '+=';
                                    this.animate({ marginLeft: sign + offsetStep + 'px' }, animateTime, function(){ jQuery(this).loopingAnimation(el,dir) });
                                }
                                return false;
                            };
                            //jQuery('.scroll-box').tinyscrollbar({ axis: 'x'});

                        });

                        jQuery(window).resize(function(){
                            setBoxedSlider();
                            setBoxedSlider();
                        });

                        function setBoxedSlider(){
                            scrollbox = jQuery(".scroll-box");

                            if(scrollbox.data("boxed") == "3"){
                                var marginLeft = jQuery('.fifteen.columns').width();
                                marginLeft = (jQuery(window).width() - marginLeft)/2 - 9;

                                scrollbox.width(jQuery(window).width() );

                                if(marginLeft > 0)
                                    scrollbox.closest(".wrap").css("margin-left",(-marginLeft)+"px");
                                scrollbox.closest(".wrap").width(jQuery(window).width());
                            }
                            else if(scrollbox.data("boxed") == "1"){
                                scrollbox.closest(".wrap").css("width","100%");
                                scrollbox.css("width","99.2%");
                            }
                            else if(scrollbox.data("boxed") == "2") {

                                scrollbox.closest(".wrap").css("width","100%");
                                scrollbox.css("width","100%");
                                var indent = jQuery(window).width() - jQuery(".fifteen").width();
                                console.log(indent);
                                scrollbox.width(jQuery(".fifteen").width() + indent/2 + 9);
                            }
                            scrollbox.getNiceScroll().resize();
                        }
                    </script>
        </div>
      </div>
      <?php $page_content =  $this->page_model->get_page_texts();
      //print_r($page_content); exit;
      ?>
      <div class="fifteen columns" style="padding-left: 0px;">
        <div class="text-block clearing-container">
          <div class="row">
            <div id="aq-block-4" class="aq-block aq-block-aq_page_15_block fifteen aq-first cf">
              <div class="">
                <div class="row-fluid">
                  <div class="wpb_content_element span3 column_container">
                    <div class="wpb_wrapper">
                      <div class="row-fluid">
                        <div class="wpb_content_element wpb_single_image span12">
                          <div class="wpb_wrapper"><?php if(!empty($page_content)){?> <img src="<?php echo base_url('uploads/images/full/'.$page_content[0]->image); //echo theme_img("/director1.png")?>" width="335" height="367" /><?php }?>  </div>
                        </div>
                      </div>
                    </div>
                  </div>
                 
                  <div class="wpb_content_element span4 column_container">
                    <div class="wpb_wrapper">
                      <div class="row-fluid">
                        <div class="wpb_content_element span12 text-item wpb_text_column">
                          <div class="wpb_wrapper">
                         
                            <h6></h6>
                           <?php if(!empty($page_content)){?> <h2><a><?php echo $page_content[0]->title;?></a></h2>
                             <?php echo $page_content[0]->content;?>
                            <img class="icon_post" title="settings" alt=""  src="<?php echo theme_img("icons/check.png")?>" width="32" height="32" /><?php }?> </div>
                        </div>
                      </div>
                      <div class="row-fluid">
                        <div class="wpb_content_element span12 text-item no-740 wpb_text_column">
                          <!--<div class="wpb_wrapper">
                            <h6>It was hard to make it so cool</h6>
                            <h2><a>Greatest Theme Options</a></h2>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip. <img class="icon_post" title="check" alt="" src="<?php echo theme_img("icons/check.png")?>" width="32" height="32" /> </div>-->
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="wpb_content_element span4 pad-r20 column_container">
                    <div class="wpb_wrapper">
                    <?php
                     $page_url = $this->page_model->get_homepage_link();?>                     
                      <div class='tile mini' style='background-color:#ffa531; padding-top:0px; padding-left:40px;'>
                          <a href='<?php echo $page_url[0]->slug?>'></a>
                        <div class='text-tile text-big-left' >FAQs</div>
                      </div>
                      <div class='tile mini' style='background-color:#57bae8'> <a href='<?php echo $page_url[1]->slug?>'></a>
                          <div class='icon icon_center' > <img src="<?php echo theme_img("img/tile-icons/clock.png")?>" alt="OneTouch"> </div>
                        <div  style=" padding-top:6px; padding-left:30px;" class='text-tile text-big-left'  > Payments </div>
                      </div>
                      <div class='tile mini' style='background-color:#57bae8'> <a href='<?php echo base_url().'about-us'?>'></a>
                          <div class='icon icon_center' > <img src="<?php echo theme_img("img/tile-icons/comp.png")?>" alt="OneTouch"></div>
                          <div class='text-tile text-big-left' style="padding-top:0px; padding-left:25px;" >About Us</div>
                      </div>
                      <div class='tile mini' style='background-color:#90a7b1'> <a href='<?php echo site_url('cart/allcourses/');?>'></a>
                        
                        <div class='text-tile text-big-left' style="padding-left:20px;" >All Courses</div>
                      </div>                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>
