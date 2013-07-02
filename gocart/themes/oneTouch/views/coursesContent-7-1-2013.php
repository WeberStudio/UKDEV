<!-- Fullscreen jQuery template -->
     <div class="row">
     <div id="aq-block-5" class="aq-block aq-block-aq_recent_block fifteen columns aq-first cf"> 
                    <h1 class="page-title">
                   All Courses
                   <span style="float: right;"> 
                    <div class="sort-panel">  
                   <ul class="filter clearfix">
                   <li>
                   <a href="<?=base_url()?>cart/allcourses/" rel="nofollow" data-product_id="868" class="button" style=" width:180px;">  All Courses </a>
                    </li>
                   </ul>
                   </div>
                   </span>
                   
                   </h1>
                   <div class="line"> </div> 
                                        
                <div id="recent" class="section-block clearing-container">
                    <div class="sort-panel">
                        <ul class="filter clearfix">
                           <!-- <li class="active">
                                <a href="javascript:void(0)" class="all">All /</a>
                            </li>  -->
                            
                            <? 
                                $last_cat =  end($this->categories);
                                
                            ?>
                            <?php //echo print_r($this->categories);exit;?>
                            <?php foreach($this->categories as $cat_menu):?> 
                              <?php if($cat_menu['category']->publish_by_super == 1){ ?>
                            <li class="active">
                                <a href="javascript:void(0)" class="<?php echo str_replace(' ','',$cat_menu['category']->id);?>" style="color: black";> <?php echo $cat_menu['category']->name;?><? if(!empty($last_cat['category']->name) && $last_cat['category']->name != $cat_menu['category']->name){ echo '/'; }?>   </a>
                            </li>
                               <?php }?> 
                              <?php  endforeach;?>
                           
                        </ul>
                    </div>
					
					<style>
						  	.item{ width:267px;}
						  </style>

                    <div class="works-list">
                        <ul class="filterable-grid">
                          <?php  
                         
                          $counter = 0;
                          $class = '';
                          $marginleft = '';
                          if(!empty($allProduct)){
                          foreach($allProduct as $course):
                            if($counter%2 == 0)
                            {
                                $class = 'even';
                            }
                            else{
                                 $class = 'odd';
                            }
                             if($counter%4 == 0)
                            {
                                $marginleft = 'margin0';
                            }
                            else{
                                 $marginleft = 'margin36';
                            }
                             
                          ?>  
						  
                            <a href="<?=base_url().$course['slug']?>" class="all">
                            
                            
                            <li class="item" style="height: 226px;"  data-id="id-1" data-type="<?php echo $course['category_id'];?>">
                             
                                <div class="half <?=$class?>" style="height: 300px; width: 300px">
                                    <div class="pic" style="height: 300px; width: 300px"><img  src="<?php echo catogery_img('images/medium/'.$course['images']); ?>" style="margin:0 0 0 0;" alt="Watchers" title="Watchers" ></div>
                                    <div class="description">
                                           <div class="title" align="center">
                                                    
                                                    <h4><?php echo $course['name'];?></h4>
                                                     <h4 align="center" style="color: black;"><?php echo 'Detail';?></h4>
                                                    
                                                </div>
                                    </div>
                                </div>
                            </li>
                            </a>   
                               <?php $counter++; endforeach; 
                          }
                          else{echo'<div><p class="woocommerce_info">Currently there is no  product.</p></div>';}
                               ?>   
                        </ul>
                        <div style="display: none;" id="show_empty_message"><p class="woocommerce_info">Currently there is no any product in this category.</p> </div>
                    </div> 
                </div>


                <script type="text/javascript">
                    /*-----------------------------------------------------------------------------------

                    Custom JS - All front-end jQuery

                    -----------------------------------------------------------------------------------*/

                    jQuery(document).ready(function($) {
                        var customStyleImgUrl = ''
                        function portfolio_quicksand() {

                            // Setting Up Our Variables
                            var $filter;
                            var $container;
                            var $containerClone;
                            var $filterLink;
                            var $filteredItems

                            // Set Our Filter
                            $filter = $('.filter li.active a').attr('class');
                               
                            // Set Our Filter Link
                            $filterLink = $('.filter li a');

                            // Set Our Container
                            $container = $('ul.filterable-grid');

                            // Clone Our Container
                            $containerClone = $container.clone();

                            // Apply our Quicksand to work on a click function
                            // for each for the filter li link elements
                            $filterLink.click(function(e)
                            {
                                // Remove the active class
                                $('.filter li').removeClass('active');

                                // Split each of the filter elements and override our filter
                                $filter = $(this).attr('class').split(' ');

                                // Apply the 'active' class to the clicked link
                                $(this).parent().addClass('active');

                                // If 'all' is selected, display all elements
                                // else output all items referenced to the data-type
                                //console.log($filter);
                                if ($filter == 'button') {
                                    $filteredItems = $containerClone.find('li');
                                }
                                else {
                                    $filteredItems = $containerClone.find('li[data-type~=' + $filter + ']');
                                  
                                }
                                 //console.log($filteredItems.length);
                                 if($filteredItems.length == 0)
                                 {
                                      $('#show_empty_message').show();                          
                                 }
                                 else
                                 {
                                     
                                        $('#show_empty_message').hide();  
                                 }
                                  
                                // Finally call the Quicksand function
                                $container.quicksand($filteredItems,
                                {
                                    // The Duration for animation
                                    duration: 1000,
                                    // the easing effect when animation
                                    easing: 'easeInOutQuad'
                                    // height adjustment becomes dynamic

                                });

                                //Initalize our PrettyPhoto Script When Filtered
                                /*$container.quicksand($filteredItems,
                                function () { lightbox(); 
                                }
                                );  */
                            });
                        }

                        if(jQuery().quicksand) {
                            portfolio_quicksand();
                        }


                    }); // END OF DOCUMENT
                </script>
            </div>
     </div>

<script type="text/javascript">
    jQuery(document).ready(function(){


        var $container = jQuery('#container');

        $container.imagesLoaded( function(){
            $container.masonry({
                itemSelector : 'div.block'
            });
        });


    });
</script>






<a href="#" id="linkTop" class="backtotop">
    <span></span>
</a>
