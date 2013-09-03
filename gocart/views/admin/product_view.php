<?php 
$GLOBALS['option_value_count']        = 0;
?>
<script type="text/javascript">
//<![CDATA[
function remove_option(id)
{
	if(confirm('<?php echo lang('confirm_remove_option');?>'))
	{
		$('#option-'+id).remove();
	}
}

//]]>
</script>
<div id="main">
  <div class="container">
    <? include_once('includes/admin_profile.php');?>
 <!--========  velidation error start    ==========-->
<?php include('error.php');?>
            
 <!--========  velidation error end   ==========-->
    <div id="main_container">
    <?php /*?><?php echo form_open_multipart($this->config->item('admin_folder').'/products/form/'.$id); ?><?php */?>
    <form class="form-horizontal" action="<? //= // base_url().$this->config->item('admin_folder').'/products/form/'.$id ?>" method="post" enctype="multipart/form-data">
      <div class="row-fluid">
        <div class="span12">
          <div class="box paint color_0">
            <div class="title">
              <div class="row-fluid">
                <h4>Course Details </h4>
              </div>
            </div>
            <!-- End .title -->
            <div class="content">
            <br><br>
            	<div class="row-fluid">
        <div class="span6">
          <div class="box paint color_0">
            <div class="title">
              <div class="row-fluid">
                <h4> Product Details </h4>
              </div>
            </div>
            <!-- End .title -->
            <div class="content">
              <div class="tabbable tabs-left">
                <ul id="tabExample2" class="nav nav-tabs">
                  <li class="active"><a href="#Course_Name" data-toggle="tab">Course Name</a></li>
                  <li><a href="#Course_Price" data-toggle="tab">Course Price</a></li>
                  <li class="dropdown"> <a href="#Description" data-toggle="tab">Description </a> </li>
                  <li class="dropdown"> <a href="#Excerpt" data-toggle="tab">Excerpt </a> </li>
                  <li class="dropdown"> <a href="#Course_Status" data-toggle="tab">Course Status </a> </li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane fade in active" id="Course_Name">
                    <p><?php echo $products->name; ?></p>
                  </div>
                  <div class="tab-pane fade" id="Course_Price">
                	<?php
						//echo '<pre>'; print_r($price_options);  
						$price_op = str_replace(array("[", "]",  '"'),'', $price_options);
						$price_op = explode(',',$price_op);
						
						if(isset($all_price_options)){	
							
							$i = 1;
							
							foreach ($all_price_options as $price_options) {  
							                                 
								if(in_array($price_options['p_option_id'], $price_op)) { 				
									
									echo $i++ . " - " . $price_options['p_option_title'].' : '.$price_options['p_option_price']."<br /><br />";
								}
							}
						} 
					 ?> 
                  </div>
                  <div class="tab-pane fade" id="Description">
                    <p style="color:white;"><?php echo $products->description; ?></p>
                  </div>
                  <div class="tab-pane fade" id="Excerpt">
                    <p><?php echo $products->excerpt; ?></p>
                  </div>
                  <div class="tab-pane fade" id="Course_Status">
                    <p><?php if($products->delete > 0) {echo "Currently Active";} else { echo "Currently Inactive";} ?></p>
                  </div>
                </div>
              </div>
            </div>
            <!-- End .content --> 
          </div>
          <!-- End  .box --> 
        </div>
        <!-- End .span6 -->
        <div class="span6">
          <div class="box paint color_0">
            <div class="title">
              <div class="row-fluid">
                <h4> <i class=" icon-bar-chart"></i> SEO Details </h4>
              </div>
            </div>
            <!-- End .title -->
            <div class="content" style="height: 298px;">
              <div class="tabbable tabs-right">
                <ul id="tabExample4" class="nav nav-tabs">
                  <li class="active"><a href="#Old_Slug" data-toggle="tab">Old Slug</a></li>
                  <li><a href="#Slug" data-toggle="tab">Slug</a></li>
                  <li class="dropdown"> <a href="#Title_Tag" data-toggle="tab">Title Tag </a> </li>
                  <li class="dropdown"> <a href="#Meta_Description" data-toggle="tab">Meta Description </a> </li>
                  <li class="dropdown"> <a href="#Meta_Keywords" data-toggle="tab">Meta Keywords </a> </li>
                  <li class="dropdown"> <a href="#Related_Products" data-toggle="tab">Related Products </a> </li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane fade in active" id="Old_Slug">
                    <p> <?php echo $products->old_route; ?> </p>
                  </div>
                  <div class="tab-pane fade" id="Slug">
                    <p> <?php echo $products->slug; ?>  </p>
                  </div>
                  <div class="tab-pane fade" id="Title_Tag">
                    <p> <?php echo $products->seo_title; ?> </p>
                  </div>
                  <div class="tab-pane fade" id="Meta_Description">
                    <p> <?php echo $products->meta; ?>  </p>
                  </div>
                  <div class="tab-pane fade" id="Meta_Keywords">
                    <p><?php if(empty($products->meta_key)){echo "Meta keywords are not available";} else { echo $products->meta_key; } ?></p>
                  </div>
                  <div class="tab-pane fade" id="Related_Products">
                    <p><?php foreach($related_products as $related_product)
					{?>
						<b> <?=$related_product->name?></b><br/>
					<?php }?> 
					
					
					
                    
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <!-- End .content --> 
          </div>
          <!-- End .box --> 
        </div>
        <!-- End .span6  --> 
      </div>
      			<div class="row-fluid">
        <div class="span6">
          <div class="box paint color_0">
            <div class="title">
              <div class="row-fluid">
                <h4> Image Details </h4>
              </div>
            </div>
            <!-- End .title -->
            <div class="content">
              <div class="tabbable tabs-left">
                <ul id="tabExample2" class="nav nav-tabs">
                  
                  <li class="active"><a href="#Image" data-toggle="tab">Image</a></li>
                  <li><a href="#Image_Title" data-toggle="tab">Image Title</a></li>
                  <li class="dropdown"> <a href="#Image_Alt" data-toggle="tab">Image Alt </a> </li>
                  <li class="dropdown"> <a href="#Image_URL " data-toggle="tab">Image URL </a> </li>
                  <li class="dropdown"> <a href="#Image_Description" data-toggle="tab">Image Description </a> </li>
                </ul>
                <div class="tab-content">
                
                  <div class="tab-pane fade in active" id="Image">
                  
                    <p><img src="<?php echo base_url()."uploads/images/small/". $products->images; ?>"></p>
                  </div>
                  <div class="tab-pane fade" id="Image_Title">
                    <p><?php echo $products->img_title; ?></p>
                  </div>
                  <div class="tab-pane fade" id="Image_Alt">
                    <p> <?php echo $products->img_alt; ?> </p>
                  </div>
                  <div class="tab-pane fade" id="Image_URL">
                    <p><?php if(empty($products->img_url)) {echo "No URL found";} else { echo $products->img_url;} ?></p>
                  </div>
                  <div class="tab-pane fade" id="Image_Description">
                    <p><?php if(empty($products->img_desc)) {echo "No URL description found";} else { echo $products->img_desc;} ?></p>
                  </div>
                </div>
              </div>
            </div>
            <!-- End .content --> 
          </div>
          <!-- End  .box --> 
        </div>
        <!-- End .span6 -->
        <div class="span6">
          <div class="box paint color_0">
            <div class="title">
              <div class="row-fluid">
                <h4> <i class=" icon-bar-chart"></i> Tab Details </h4>
              </div>
            </div>
            <!-- End .title -->
            <div class="content">
              <div class="tabbable tabs-right">
                <ul id="tabExample4" class="nav nav-tabs">
                <?php foreach($product_tabs as $all_tabs) { ?>
                  <li><a href="#<?php echo $all_tabs['tab_id']; ?>" data-toggle="tab"><?php echo $all_tabs['tab_title']; ?></a></li>
                <?php } ?>
                  
                </ul>
                <div class="tab-content">
                <?php foreach($product_tabs as $all_tabs) { ?>
                  <div class="tab-pane fade in active" id="<?php echo $all_tabs['tab_id']; ?>">
                    <p><?php echo  $all_tabs['tab_content'];  ?></p>
                  </div>
                  <?php } ?>
                  <div class="tab-pane fade" id="profile6">
                    <p>All I want is to be a monkey of moderate intelligence who wears a suit… that's why I'm transferring to business school! I had more, but you go ahead. Man, I'm sore all over. I feel like I just went ten rounds with mighty Thor. File not found.</p>
                  </div>
                  <div class="tab-pane fade" id="dropdown16">
                    <p>And I'd do it again! And perhaps a third time! But that would be it. Are you crazy? I can't swallow that. And I'm his friend Jesus. No, I'm Santa Claus! And from now on you're all named Bender Jr.</p>
                  </div>
                </div>
              </div>
            </div>
            <!-- End .content --> 
          </div>
          <!-- End .box --> 
        </div>
        <!-- End .span6  --> 
      </div>
            </div>
            <!-- End .content -->
          </div>
          <!-- End  .box -->
        </div>
        
      </div>
      
    </form>
   </div>
    <!-- End #container --> 
  </div>
  <script type="text/javascript">
    
    $( "#add_option" ).click(function(){
        if($('#option_options').val() != '')
        {
            add_option($('#option_options').val());
            $('#option_options').val('');
        }
    });
    
    function add_option(type)
    {
        //increase option_count by 1
        option_count++;
        
        <?php
        $value            = array(array('name'=>'', 'value'=>'', 'weight'=>'', 'price'=>'', 'limit'=>''));
        $js_textfield    = (object)array('name'=>'', 'type'=>'textfield', 'required'=>false, 'values'=>$value);
        $js_textarea    = (object)array('name'=>'', 'type'=>'textarea', 'required'=>false, 'values'=>$value);
        $js_radiolist    = (object)array('name'=>'', 'type'=>'radiolist', 'required'=>false, 'values'=>$value);
        $js_checklist    = (object)array('name'=>'', 'type'=>'checklist', 'required'=>false, 'values'=>$value);
        $js_droplist    = (object)array('name'=>'', 'type'=>'droplist', 'required'=>false, 'values'=>$value);
        
        if (function_exists('add_option')) {
        ?>
        
        if(type == 'textfield')
        {
            $('#options_container').append('<?php add_option($js_textfield, "'+option_count+'");?>');
        }
        else if(type == 'textarea')
        {
            $('#options_container').append('<?php add_option($js_textarea, "'+option_count+'");?>');
        }
        else if(type == 'radiolist')
        {
            $('#options_container').append('<?php add_option($js_radiolist, "'+option_count+'");?>');
        }
        else if(type == 'checklist')
        {
            $('#options_container').append('<?php add_option($js_checklist, "'+option_count+'");?>');
        }
        else if(type == 'droplist')
        {
            $('#options_container').append('<?php add_option($js_droplist, "'+option_count+'");?>');
        }
        <? } ?>
    }
    
    function add_option_value(option)
    {
        
        option_value_count++;
        <?php
        $js_po    = (object)array('type'=>'radiolist');
        $value    = (object)array('name'=>'', 'value'=>'', 'weight'=>'', 'price'=>'');
        
        if (function_exists('add_option')) {
        ?>
        $('#option-items-'+option).append('<?php add_option_value($js_po, "'+option+'", "'+option_value_count+'", $value);?>');
        
        <? } ?>
    }
        j = jQuery.noConflict() ; 
    j(document).ready(function(){
        j('body').on('click', '.option_title', function(){
            j(j(this).attr('href')).slideToggle();
            return false;
        });
        
        j('body').on('click', '.delete-option-value', function(){
            if(confirm('<?php echo lang('confirm_remove_value');?>'))
            {
                j(this).closest('.option-values-form').remove();
            }
        });
        
        
        
        $('#options_container').sortable({
            axis: "y",
            items:'tr',
            handle:'.handle',
            forceHelperSize: true,
            forcePlaceholderSize: true
        });
        
        $('.option-items').sortable({
            axis: "y",
            handle:'.handle',
            forceHelperSize: true,
            forcePlaceholderSize: true
        });
        
        
         var funcNode = ''  ;
         var foldername = '';
        j(".various").fancybox({
            maxWidth    : 800,
            maxHeight    : 600,
            fitToView    : false,
            width        : '70%',
            height        : '70%',
            autoSize    : false,
            openEffect    : 'none',
            closeEffect    : 'none',
            beforeClose:function(){
               
             funcNode    = j(".fancybox-iframe").contents().find("#insert-filename").val();
             foldername  = j(".fancybox-iframe").contents().find("#folder-name").val();
              //console.log(funcNode)
              j(".uneditable-input").html("<span>"+foldername+"</span>");
               document.getElementById('media_image').value = funcNode;
               document.getElementById('image_path').value  = foldername;
            },
            afterClose:function(){
               // alert("shahid")
                //document.getElementById('unique_image_id').disabled = false;
               
            }
        });
    });
    </script>
    <style type="text/css">
        .option-form {
            display:none;
            margin-top:10px;
        }
        .option-values-form
        {
            background-color:#fff;
            padding:6px 3px 6px 6px;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            margin-bottom:5px;
            border:1px solid #ddd;
        }
        
        .option-values-form input {
            margin:0px;
        }
        .option-values-form a {
            margin-top:3px;
        }
    </style>

<?php
/***********  Some Important Function Area*********************/

function add_option($po, $count)
{
    ob_start();
    ?>
    <tr id="option-<?php echo $count;?>">
        <td>
            <a class="handle btn btn-mini"><i class="icon-align-justify"></i></a>
            <strong><a class="option_title" href="#option-form-<?php echo $count;?>"><?php echo $po->type;?> <?php echo (!empty($po->name))?' : '.$po->name:'';?></a></strong>
            <button type="button" class="btn btn-mini btn-danger pull-right" onClick="remove_option(<?php echo $count ?>);"><i class="gicon-trash"></i></button>
            <input type="hidden" name="option[<?php echo $count;?>][type]" value="<?php echo $po->type;?>" />
            <div class="option-form" id="option-form-<?php echo $count;?>">
                <div class="row-fluid">
                
                    <div class="span5">
                        <input type="text" class="span10" placeholder="<?php echo lang('option_name');?>" name="option[<?php echo $count;?>][name]" value="<?php echo $po->name;?>"/>
                    </div>
                    
                    <div class="span3" style="text-align:right;">
                        <input class="checkbox" type="checkbox" name="option[<?php echo $count;?>][required]" value="1" <?php echo ($po->required)?'checked="checked"':'';?>/> <?php echo lang('required');?>
                    </div>
                </div>
                <?php if($po->type!='textarea' && $po->type!='textfield'):?>
                <div class="row-fluid">
                    <div class="span12">
                        <a class="btn" onClick="add_option_value(<?php echo $count;?>);"><?php echo lang('add_item');?></a>
                    </div>
                </div>
                <?php endif;?>
                <div style="margin-top:10px;">

                    <div class="row-fluid">
                        <?php if($po->type!='textarea' && $po->type!='textfield'):?>
                        <div class="span1">&nbsp;</div>
                        <?php endif;?>
                        <div class="span5"><strong>&nbsp;&nbsp;<?php echo lang('name');?></strong></div>
                        <div class="span4"><strong>&nbsp;<?php echo lang('value');?></strong></div>
                        <div class="span2"><strong>&nbsp;<?php echo ($po->type=='textfield')?lang('limit'):'';?></strong></div>
                    </div>
                    <div class="option-items" id="option-items-<?php echo $count;?>">
                    <?php if($po->values):?>
                        <?php
                        foreach($po->values as $value)
                        {
                            $value = (object)$value;
                            add_option_value($po, $count, $GLOBALS['option_value_count'], $value);
                            $GLOBALS['option_value_count']++;
                        }?>
                    <?php endif;?>
                    </div>
                </div>
            </div>
        </td>
    </tr>
    
    <?php
    $stuff = ob_get_contents();

    ob_end_clean();
    
    echo replace_newline($stuff);
}

function add_option_value($po, $count, $valcount, $value)
{
    ob_start();
    ?>
    <div class="option-values-form">
        <div class="row-fluid">
            <?php if($po->type!='textarea' && $po->type!='textfield'):?><div class="span1"><a class="handle btn btn-mini" style="float:left;"><i class="icon-align-justify"></i></a></div><?php endif;?>
            <div class="span5"><input type="text" class="span12" name="option[<?php echo $count;?>][values][<?php echo $valcount ?>][name]" value="<?php echo $value->name ?>" /></div>
            <div class="span3"><input type="text" class="span12" name="option[<?php echo $count;?>][values][<?php echo $valcount ?>][value]" value="<?php echo $value->value ?>" /></div>
            <div class="span2">
            <?php if($po->type=='textfield'):?><input class="span12" type="text" name="option[<?php echo $count;?>][values][<?php echo $valcount ?>][limit]" value="<?php echo $value->limit ?>" />
            <?php elseif($po->type!='textarea' && $po->type!='textfield'):?>
                <a class="delete-option-value btn btn-danger btn-mini pull-right"><i class="gicon-trash"></i></a>
            <?php endif;?>
            </div>
        </div>
    </div>
    <?php
    $stuff = ob_get_contents();

    ob_end_clean();

    echo replace_newline($stuff);
}
//this makes it easy to use the same code for initial generation of the form as well as javascript additions
function replace_newline($string) {
  return trim((string)str_replace(array("\r", "\r\n", "\n", "\t"), ' ', $string));
}
?>

<script type="text/javascript">
//<![CDATA[
var option_count        = <?=$counter?> ;
var option_value_count    = <?=$GLOBALS['option_value_count']?> ;
     
//]]>
</script>