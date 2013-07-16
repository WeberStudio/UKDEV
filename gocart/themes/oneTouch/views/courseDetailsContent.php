<?php echo theme_css('simpletabs.css', true); ?>    
<script type="text/javascript">
        jQuery =    jQuery.noConflict();
        jQuery(document).ready(function() {
            /*
             *  Simple image gallery. Uses default settings
             */

            jQuery('.fancybox').fancybox();



        });
    </script>
    
      


<div class="row">
    <div class="fifteen columns" id="page-title" style="padding-left: 0px;">
        <div class="breadcrumbs"><a href="<?=base_url()?>">All Courses</a> <span class="delim">/</span><a href="<?=base_url().$product->categories[0]->slug?>"> <? echo $product->categories[0]->name;?></a><span class="delim">/</span> <a href="<?=base_url().$product->slug?>"><?=$product->name?></a>
        <span style="float: right; margin-top: -10px;"> 
                    <div class="sort-panel">  
                   <ul class="filter clearfix">
                   <li>
                   <a href="<?=base_url()?>cart/allcourses/" rel="nofollow" data-product_id="868" class="button" style=" width:180px;">  All Courses</a>
                    </li>
                   </ul>
                   </div>
                   </span>
        </div>

    </div>

    <div class="fifteen columns" id="page-title" style="padding-left: 0px;">
         <div class="line"></div>
    </div>

</div>

<div class="row">

<div class="eleven columns" style="padding-left: 0px;">

    <div id="container">



        <div id="content" role="main">


        <?  if ($quantities != "")
            {
            $show_things = array('quantitty'=>'1');
            $this->session->unset_userdata($show_things); 
            ?>

            <div class="woocommerce_message">
            <a href="<?php echo site_url('cart/view_cart');?>" class="button">View Cart →</a> Course successfully added to your cart.</div>

              <? }?>
              

            <div  id="product-855" class="post-855 product type-product status-publish hentry">

              
                  <? if(isset($product->images)){ ?>
                <div class="images"> <a itemprop="image" href="<?php echo base_url('uploads/images/full/'.$product->images);?>" class="zoom cboxElement" rel="thumbnails" alt="<?=$product->img_alt?>" title="<?=$product->img_title?>">
                
                <img  src="<?php echo base_url('uploads/images/medium/'.$product->images);?>" alt="<?=$product->img_alt?>" title="<?=$product->img_title?>" >
                
                </a> 
                </div>
                <? } ?>
                <div class="summary">

                    <h1 itemprop="name" class="product_title entry-title"><?=$product->name?></h1>

                    <div itemprop="offers" itemscope="" >

                        <p itemprop="price" class="price"><span class="amount"><?=format_currency($product->price)?></span></p>

                    </div>



                    <?php echo form_open('cart/add_to_cart', 'class="cart"');?>

                    <input type="hidden" name="cartkey" value="<?php echo $this->session->flashdata('cartkey');?>" />

                    <input type="hidden" name="id" value="<?php echo $product->id?>"/>
                    <input type="hidden" name="slug" value="<?php if($this->uri->segment(2)==""){echo $this->uri->segment(1);}
                    if($this->uri->segment(2)!=""){echo $this->uri->segment(1)."/".$this->uri->segment(2);}?>"/>
                    <div class="quantity buttons_added"><input type="button" value="-" class="minus"><input name="quantity" data-min="1" data-max="0" value="1" size="4" title="Qty" class="input-text qty text" maxlength="12"><input type="button" value="+" class="plus"></div>
                    <button type="submit" class="single_add_to_cart_button button alt">Add to cart</button>
                    <br/>
                    <div>
                    <!--<fieldset>
                    <?php if(count($options) > 0): ?>
                        <?php foreach($options as $option):
                            $required    = '';
                            if($option->required)
                            {
                                $required = ' <p class="help-block">Required</p>';
                            }
                            ?>
                            <div class="control-group">
                                <label class="control-label"><?php echo $option->name;?></label>
                                <?php
                                /*
                                this is where we generate the options and either use default values, or previously posted variables
                                that we either returned for errors, or in some other releases of Go Cart the user may be editing
                                and entry in their cart.
                                */

                                //if we're dealing with a textfield or text area, grab the option value and store it in value
                                if($option->type == 'checklist')
                                {
                                    $value    = array();
                                    if($posted_options && isset($posted_options[$option->id]))
                                    {
                                        $value    = $posted_options[$option->id];
                                    }
                                }
                                else
                                {
                                    if(isset($option->values[0]))
                                    {
                                        $value    = $option->values[0]->value;
                                        if($posted_options && isset($posted_options[$option->id]))
                                        {
                                            $value    = $posted_options[$option->id];
                                        }
                                    }
                                    else
                                    {
                                        $value = false;
                                    }
                                }

                                if($option->type == 'textfield'):?>
                                    <div class="controls">
                                        <input type="text" name="option[<?php echo $option->id;?>]" value="<?php echo $value;?>" class="span4"/>
                                        <?php echo $required;?>
                                    </div>
                                <?php elseif($option->type == 'textarea'):?>
                                    <div class="controls">
                                        <textarea class="span4" name="option[<?php echo $option->id;?>]"><?php echo $value;?></textarea>
                                        <?php echo $required;?>
                                    </div>
                                <?php elseif($option->type == 'droplist'):?>
                                    <div class="controls">
                                        <select name="option[<?php echo $option->id;?>]">
                                            <option value=""><?php echo lang('choose_option');?></option>

                                        <?php foreach ($option->values as $values):
                                            $selected    = '';
                                            if($value == $values->id)
                                            {
                                                $selected    = ' selected="selected"';
                                            }?>

                                            <option<?php echo $selected;?> value="<?php echo $values->id;?>">
                                                <?php echo($values->price != 0)?'('.format_currency($values->price).') ':''; echo $values->name;?>
                                            </option>

                                        <?php endforeach;?>
                                        </select>
                                        <?php echo $required;?>
                                    </div>
                                <?php elseif($option->type == 'radiolist'):?>
                                    <div class="controls">
                                        <?php foreach ($option->values as $values):

                                            $checked = '';
                                            if($value == $values->id)
                                            {
                                                $checked = ' checked="checked"';
                                            }?>
                                            <label class="radio">
                                                <input<?php echo $checked;?> type="radio" name="option[<?php echo $option->id;?>]" value="<?php echo $values->id;?>"/>
                                                <?php echo $option->name;?> <?php echo($values->price != 0)?'('.format_currency($values->price).') ':''; echo $values->name;?>
                                            </label>
                                        <?php endforeach;?>
                                        <?php echo $required;?>
                                    </div>
                                <?php elseif($option->type == 'checklist'):?>
                                    <div class="controls">
                                        <?php foreach ($option->values as $values):

                                            $checked = '';
                                            if(in_array($values->id, $value))
                                            {
                                                $checked = ' checked="checked"';
                                            }?>
                                            <label class="checkbox">
                                                <input<?php echo $checked;?> type="checkbox" name="option[<?php echo $option->id;?>][]" value="<?php echo $values->id;?>"/>
                                                <?php echo($values->price != 0)?'('.format_currency($values->price).') ':''; echo $values->name;?>
                                            </label>
                                            
                                        <?php endforeach; ?>
                                    </div>
                                    <?php echo $required;?>
                                <?php endif;?>
                                </div>
                        <?php endforeach;?>
                    <?php endif;?>
                    
                    
                    
                    </fieldset>-->
                    </div>

                    </form>









                </div>

                <!-- .summary -->
               
                <script>
                function toggle() {
                
                    var el = document.getElementById('obj');
                
                    if ( el.style.display != 'none' ) {
                
                        el.style.display = 'none';
                
                    }
                
                    else {
                
                        el.style.display = '';
                
                    }
                return false;
                }

            </script>
                   <div class="eleven columns" style="padding-left: 0px; width: 854px;">
                <p class="woocommerce_info">Click Here To → <a href="javascript:void(0)" class="" onClick="return toggle()"> Ask A Question</a></p>
                <div <?php if($open==""){echo 'style="display:none;"';}?> id="obj" method="post" class="login">
                <?php if($open!="")
                {    
                    $open = array('open'=>'1');
                    $this->session->unset_userdata($open);
                }?>
                 <div class="simpleTabs"  style="padding-left: 0px; ">
                 <ul class="simpleTabsNavigation">
                  <li class="description_tab active"><a href="#question">Question</a></li>
                  <li class="description_tab active"><a href="#updates">Updates</a></li>
                  <li class="description_tab active"><a href="#reviews">Reviews</a></li>
                 
                 </ul>
                  <div  class="simpleTabsContent" id="question">
                      <div id="reviews">
                        <div id="comments">
                        <form action="<?php echo site_url();?>cart/question"  method="post">
                            <label>Your Question</label>
                            <textarea id="comment" name="question" cols="45" rows="8" aria-required="true"></textarea>
                            <div align="right">
                            <input type="hidden" id="" name="product_id" value="<?php echo $product->id;?>">
                            <input type="hidden" name="slug" value="<?php if($this->uri->segment(2)==""){echo $this->uri->segment(1);}
                    if($this->uri->segment(2)!=""){echo $this->uri->segment(1)."/".$this->uri->segment(2);}?>"/>
                            <input id="wp-submit" class="submitbutton" type="submit" value="Submit Question" name="submitted">
                            </div>
                        </form>
                        </div>
                    </div>
                     <?php $questions = $this->Product_model->get_question($product->id);
                     //echo $this->show->pe($questions); exit;
                     if(empty($questions)){echo "<i> There is No Question Yet</i>";}
                        if(!empty($questions)){
                         foreach($questions as $question){
                     ?>
                     <div id="reviews">
                        <div id="comments">
                            <ol class="commentlist">
                                <li itemprop="reviews" itemscope="" itemtype="" class="comment even thread-even depth-1" id="li-comment-338">
                                    <div id="comment-338" class="comment_container">
                                        <img alt="" src="<?php  echo theme_img('review_img.png');?>" class="" height="80" width="80">
                                        <div class="comment-text">
                                        
                                        <div itemprop="description" class="description" title="user reply div">
                                            <p><h4><?php echo ucwords(strtolower($question->name));?></h4></p>
                                            <p><?php echo ucwords(strtolower($question->question));?></p>
                                            <div  align="right">
                                                 <a class="button" href="javascript:void(0);"> Reply</a>
                                                 <div class="clear"  style="margin-bottom: 10px;"></div>
                                                
                                             </div>
                                        </div>
                                        
                                        <div class="clear"></div>
                                        </div>
                                    <div class="clear"></div>
                                    </div>
                                </li>
                            </ol>
                        </div>
                        </div>
                      <?php }}?> 
                    
                  </div>
                  
                  <div  class="simpleTabsContent" id="updates">
                      <h2> Updates div</h2>
                  </div>
                  
                  
                  <div  class="simpleTabsContent" id="reviews">
                  
                          <a class="fancybox button" href="#inline<?php if($this->go_cart->customer() != ""){echo "1";}if($this->go_cart->customer() == ""){echo"2";}?>">Reviews </a>
                        <div class="clear"  style="margin-bottom: 20px;"></div>
                        <?php $reviews = $this->Product_model->get_reviews($product->id);
                        if(empty($reviews)){echo "<i> There is No review Yet</i>";}
                        if(!empty($reviews)){
                         foreach($reviews as $review){
                         
                         ?>
                        <div id="reviews">
                        <div id="comments">
                            <ol class="commentlist">
                                <li itemprop="reviews" itemscope="" itemtype="" class="comment even thread-even depth-1" id="li-comment-338">
                                    <div id="comment-338" class="comment_container">
                                        <img alt="" src="<?php  echo theme_img('review_img.png');?>" class="" height="80" width="80">
                                        <div class="comment-text">
                                        <div itemprop="reviewRating" itemscope="" itemtype="" class="star-rating" title="3">
                                            <span <?php 
                                             if($review->rating == ""){echo "style='width:0px'";}
                                             if($review->rating == 1){echo "style='width:15px'";}
                                             if($review->rating == 2){echo "style='width:30px'";}
                                             if($review->rating == 3){echo "style='width:48px'";}
                                             if($review->rating == 4){echo "style='width:65px'";}
                                             if($review->rating == 5){echo "style='width:80px'";}?>>
                                            
                                                <span itemprop="">3</span> out of 5
                                            </span>
                                        
                                        </div>
                                        <p class="meta"><em>Your comment is awaiting approval</em></p>
                                        <div itemprop="description" class="description">
                                            <p><?php echo $review->review;?></p>
                                        </div>
                                        <div class="clear"></div>
                                        </div>
                                    <div class="clear"></div>
                                    </div>
                                </li>
                            </ol>
                        </div>
                        </div>
                        <?php }}?>
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
                        <a class="star-1" href="javascript:void(0)" onclick="return review1();">1</a>
                        <a class="star-2" href="javascript:void(0)" onclick="return review2();">2</a>
                        <a class="star-3" href="javascript:void(0)" onclick=" return review3();">3</a>
                        <a class="star-4" href="javascript:void(0)" onclick="return review4();">4</a>
                        <a class="star-5" href="javascript:void(0)" onclick=" return review5();">5</a>
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
            
                <!--<div class="simpleTabs" style="padding-left: 0px;">
                 <ul class="simpleTabsNavigation">
                  <li class="description_tab active"><a href="#question">Question</a></li>
                  <li class="description_tab active"><a href="#updates">Updates</a></li>
                  <li class="description_tab active"><a href="#reviews">Reviews</a></li>
                 
                 </ul>
                  <div  class="simpleTabsContent" id="question">
                  
                      <h2> Question div</h2>
                  </div>
                  
                  <div  class="simpleTabsContent" id="updates">
                      <h2> Updates div</h2>
                  </div>
                  
                  <div  class="simpleTabsContent" id="reviews">
                           <h2> Reviews div</h2>
                   </div>
                </div>-->
                
                <?php if(!empty($product_tabs)){?>
                <div class="simpleTabs" style="padding-left: 0px;">

                    <ul class="simpleTabsNavigation" >
                    

                        <!--<li class="description_tab active"><a href="#tab-description">Description</a></li>-->

                       <!-- <li class="reviews_tab"><a href="#tab-reviews">Reviews (0)</a></li>-->

                        <? if(!empty($product_tabs)){

                                foreach($product_tabs as $tabs)

                                {

                                ?>

                                <li style="margin-bottom: 0px;" class="reviews_tab"><a href="#<?=str_replace(' ', '-', strtolower($tabs['tab_title']))?>"><?=$tabs['tab_title']?></a></li>



                                <?    }

                            } 



                        ?>

                    </ul>

                    <!--<div  class="simpleTabsContent" id="tab-description">

                        <h2>Product Description</h2>

                        <p><?=$product->description?></p>

                    </div>-->

                   
                        <br style="margin-top: 40px;"/>
                        <br/>
                        
                        
                        
                    <? if(!empty($product_tabs)){
                                      
                            foreach($product_tabs as $tabs)

                            {
                                  // DebugBreak() ;
                            ?>            

                            <div  class="simpleTabsContent" id="<?php echo str_replace(' ', '-', strtolower($tabs['tab_title']))?>" >

                                <h2><?=$tabs['tab_title'];?></h2>

                                <p><?=$tabs['tab_content']?></p>
                                                   <? //print_r($tabs['tab_content']);  ?>
                            </div>

                            <?    

                            }

                        }              

                    ?>            

                </div>
                <?php }?>


                </div>

                <!-- #product-855 -->

                <div class="clear"></div>

            </div>

        </div>

    </div>

<div class="four columns">

        <section id="woocommerce_login-2" class="widget-1 widget-first widget widget_login">

            <div class="widget-inner">

                <h3>Customer Login</h3>

                <form method="post" action="<?=base_url()?>secure/login">

                    <p>

                        <label for="user_login">Username or email</label>

                        <input name="email" class="input-text" id="user_login" type="text">

                    </p>

                    <p>

                        <label for="user_pass">Password</label>

                        <input name="password" class="input-text" id="user_pass" type="password">

                    </p>

                    <p>

                        <input class="submitbutton" name="submitted" id="wp-submit" value="Login →" type="submit">

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

        </section>

        <section id="shopping_cart-2" class="widget-2 widget widget_shopping_cart">

            <div class="widget-inner">

                <h3>Cart</h3>

                <!--mfunc woocommerce_mini_cart() -->

                

                <?  if ($this->go_cart->total_items()==0)

                    { ?>

                    <ul class="cart_list product_list_widget ">

                        <li class="empty">No products in the cart.</li>

                    </ul>

                <?   } else{  ?>

                

                   <ul class="cart_list product_list_widget ">    

                <?

                  

                   foreach ($this->go_cart->contents() as $cartkey=>$product_data)

                   {

                         $productName = $product_data['name'] ;

                         $price = $product_data['price'];

                         $qty = $product_data['quantity'] ;

                         $imgpath = $product_data['images'] ;



                  ?>



                    <li>

                        <a href="#">

                            <? if(!empty($imgpath)){ ?>

                            <img width="200" height="200" src="<?=base_url('uploads/images/thumbnails/'.$imgpath)?>" class="attachment-shop_thumbnail wp-post-image" alt="746867-1">
                            <? } ?>
                            <?=$productName?>

                        </a>





                        <span class="quantity"><?=$qty?> × $<span class="amount"><?=$price?></span></span>

                    </li>

                     <? }

                    

                    ?>

                </ul><!-- end product list -->

                <p class="total"><strong>Subtotal:</strong> <span class="amount"><?=$this->go_cart->subtotal()?></span></p>

                <p class="buttons">

                    <a href="<?php echo site_url('cart/view_cart');?>" class="button">View Cart →</a>

                    <a href="#" class="button checkout">Checkout →</a>

                </p>

                  <? }?>

                <!-- end product list -->

                <!--/mfunc-->

            </div>

        </section>

    </div>

</div>
<div class="row">

                <div class="line"></div>



                <!--- Related Products Starts ---->
<? //$this->show->pe($product->related_products); ?>
                <?php if(!empty($product->related_products)):?>

                    <div class="related_products">

                    <div class="row">

                    <div class="span4">

                    <h2>Related Products</h2>

                    <ul class="thumbnails">    

                    <?php foreach($product->related_products as $relate):?>

                        <li class="span2 product">

                        <?php

                            $photo    = theme_img('no_picture.png', lang('no_image_available'));

                            $relate->images    = array_values((array)json_decode($relate->images));



                            if(!empty($relate->images[0]))

                            {

                                $primary    = $relate->images[0];

                                $photo    = '<img src="'.base_url('uploads/images/small/'.$primary).'" alt="'.$relate->seo_title.'" style="width: 270px; height: 200px;"/>';

                            }

                        ?>

                        <a  href="<?php  echo site_url(implode('/', $base_url).'/'.$relate->slug); ?>">

                        <?php echo $photo; ?>

                        </a>

                        <h5 style="margin-top:5px;" align="center"><a href="<?php echo site_url($relate->slug); ?>"><?php echo $relate->name;?></a></h5>                   

                        </li>

                        <?php endforeach;?>

                    </ul>

                    </div>

                    </div>

                    </div>

                    <?php endif;?>



                <!--- Related Products Ends ---->

</div>