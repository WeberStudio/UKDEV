<?php include('mainHeader.php'); ?>

<body class="home page page-template page-template-page-no_top-php theme-onetouch wpb-js-composer js-comp-ver-3.4.12 vc_responsive">


<div id="body-wrapper" >

<div id="body-wrapper-padding">

<?php include('header.php'); ?>

<? //Content Area Start ?>

<div class="row">
<div class="page-header">

  <h1><?php echo $page_title; ?></h1>

</div>
</div>

<div class="row">

  <div class="fifteen columns">

    <div id="main">

      <? $photo	= theme_img('no_picture.png', lang('no_image_available')); ?>

	  <!--- All Courses Start  ---->
     <!--<div class="row">

	  <?php foreach($products as $product):?>

        <article  class="mini masonry-brick" >          

          <div class="entry-content clearing-container">

            <div class="entry-thumb">

          		<a href="<?php echo site_url(implode('/', $base_url).'/'.$product->slug); ?>">				
				<? if(isset($product->images)){ ?>
		  		<img src="<?=base_url('uploads/images/small/'.$product->images)?>" alt="<?=$product->seo_title?>">
				<? } ?>
				</a>

        	</div>          

            <h2><a href="<?php echo site_url(implode('/', $base_url).'/'.$product->slug); ?>"><?=$product->name?></a></h2>        

            <p><?=substr($product->excerpt,0,200)?></p>

          </div>		  

        </article>

		<?php endforeach?>
               </div>-->
	 <!--- All Courses End  ---->		
     <!-- Static Code Start -->
     <div class="row"> 
     	<div class="works-list boxstyle1">
        	<ul class="filterable-grid">
             <?php foreach($products as $product):?>

                <a class="all" href="<?php echo site_url(implode('/', $base_url).'/'.$product->slug); ?>">
                            <li data-type="1" data-id="id-1" class="item">
                             
                                <div class="half even">
                                    <div class="pic"><img title="Watchers" alt="Watchers" src="<?=base_url('uploads/images/medium/'.$product->images)?>"></div>
                                    <div class="description">
                                           <div class="title">
                                                    
                                                    <h4><?=$product->name?></h4>
                                                    <p><?php echo substr($product->excerpt,0,100)?></p> 
                                                    <p><span class="button" style="margin:0px auto 0px 90px;">Read More</span></p>
                                                    <div class="row">
    												<div class="line"> </div>
													</div>
                                                </div>
                                    </div>
                                </div>
                             
                            </li>
                            
                            </a> 
               <?php endforeach?>
            </ul>
			<div class="category-bottom-gap" ></div>
     	</div>  
     </div>  
     <!-- Stayic Code End --->
     

    </div>

    <? //Content Area End ?>

  </div>

</div>



</div>

</div>

<?php include_once('footer.php'); ?>

</body>

</html>