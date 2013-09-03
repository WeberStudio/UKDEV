<div id="main" style="min-height:1000px">
  <div class="container">
    <? include_once('includes/admin_profile.php');?>
<!--========  velidation error start    ==========-->
<?php include('error.php');?>
            
<!--========  velidation error end   ==========-->
    <div id="main_container">
        <div class="row-fluid">
            <div class="span12">
              <div class="box paint color_0">
            
                <div class="title">
                  <div class="row-fluid">
                    <h4> Category Details</h4>
                  </div>
                </div>
				                
                <div class="content">
                <br><br>
                    <div class="row-fluid">
                            <div class="span6">
                              <div class="box paint color_0">
                                <div class="title">
                                  <div class="row-fluid">
                                    <h4> Description </h4>
                                  </div>
                                </div>
                                <!-- End .title -->
                                <div class="content">
                                <br>
                                  <div class="accordion" id="accordion2">
                                    <div class="accordion-group">
                                      <div class="accordion-heading"> <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#name"> Name </a> </div>
                                      <div id="name" class="accordion-body collapse" style="height: 0px; ">
                                        <div class="accordion-inner"> <?php echo $category_details->name; ?> </div>
                                      </div>
                                    </div>
                                    <div class="accordion-group">
                                      <div class="accordion-heading"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#course_description"> Course Description </a> </div>
                                      <div id="course_description" class="accordion-body collapse" style="height: 0px; ">
                                        <div class="accordion-inner"> <?php echo $category_details->description; ?> </div>
                                      </div>
                                    </div>
                                    <div class="accordion-group">
                                      <div class="accordion-heading"> <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#category_status"> Category Status </a> </div>
                                      <div id="category_status" class="accordion-body collapse" style="height: 0px; ">
                                        <div class="accordion-inner"> <?php if($category_details->delete == 0) { echo "Currently Inactive ";} else { echo "Currently Active ";}  ?>  </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <!-- End .content --> 
                              </div>
                              <!-- End .box --> 
                            </div>
                            <!-- End .span6 -->
                            <div class="span6">
                              <div class="box paint color_0">
                                <div class="title">
                                  <div class="row-fluid">
                                    <h4> Attributes </h4>
                                  </div>
                                </div>
                                <!-- End .title -->
                                <div class="content">
                                <br>
                                  <div class="accordion" id="accordion2">
                                    <div class="accordion-group">
                                      <div class="accordion-heading"> <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#old_slug"> Old Slug </a> </div>
                                      <div id="old_slug" class="accordion-body collapse" style="height: 0px; ">
                                        <div class="accordion-inner"> <?php echo $category_details->old_route; ?> </div>
                                      </div>
                                    </div>
                                    <div class="accordion-group">
                                      <div class="accordion-heading"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#slug"> Slug </a> </div>
                                      <div id="slug" class="accordion-body collapse" style="height: 0px; ">
                                        <div class="accordion-inner"> <?php echo $category_details->slug; ?> </div>
                                      </div>
                                    </div>
                                    <div class="accordion-group">
                                      <div class="accordion-heading"> <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#sequence"> Sequence </a> </div>
                                      <div id="sequence" class="accordion-body collapse" style="height: 0px; ">
                                        <div class="accordion-inner"> <?php echo $category_details->sequence;   ?>  </div>
                                      </div>
                                    </div>
                                    <div class="accordion-group">
                                      <div class="accordion-heading"> <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#parent"> Parent </a> </div>
                                      <div id="parent" class="accordion-body collapse" style="height: 0px; ">
                                        <div class="accordion-inner"> <?php echo $category_details->parent_id;   ?>  </div>
                                      </div>
                                    </div>
                                    <div class="accordion-group">
                                      <div class="accordion-heading"> <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#excerpt"> Excerpt  </a> </div>
                                      <div id="excerpt" class="accordion-body collapse" style="height: 0px; ">
                                        <div class="accordion-inner"> <?php echo $category_details->excerpt;   ?>  </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <!-- End .content --> 
                              </div>
                              <!-- End .box --> 
                            </div>
                            <!-- End .span6 --> 
                            <div class="span6">
          <div class="box paint color_0">
            <div class="title">
              <div class="row-fluid">
                <h4> Images </h4>
              </div>
            </div>
            <!-- End .title -->
            <div class="content">
              <div class="tabbable tabs-left">
                <ul id="tabExample2" class="nav nav-tabs">
                  <li class="active"><a href="#image" data-toggle="tab"> Image </a></li>
                  <li><a href="#image_title" data-toggle="tab">Image Title</a></li>
                  <li class="dropdown"> <a href="#image_alt" data-toggle="tab">Image Alt </a> </li>
                  <li class="dropdown"> <a href="#image_url" data-toggle="tab">Image URL </a> </li>
                  <li class="dropdown"> <a href="#image_description" data-toggle="tab">Image Description </a> </li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane fade in active" id="image">
                    <p> <img src="<?php echo base_url()."uploads/images/small/". $category_details->image; ?>" </p>
                  </div>
                  <div class="tab-pane fade" id="image_title">
                    <p><?php echo $category_details->img_title; ?></p>
                  </div>
                  <div class="tab-pane fade" id="image_alt">
                    <p><?php echo $category_details->img_alt; ?></p>
                  </div>
                  <div class="tab-pane fade" id="image_url">
                    <p><?php if(empty($category_details->img_url)) { echo "Not Available";} else{ echo $category_details->url;}  ?></p>
                  </div>
                  <div class="tab-pane fade" id="image_description">
                    <p><?php if(empty($category_details->img_description)) { echo "Not Available";} else{ echo $category_details->img_description;} ?></p>
                  </div>
                  <div class="tab-pane fade" id="dropdown2">
                    <p><?php echo $category_details->img_title; ?></p>
                  </div>
                </div>
              </div>
            </div>
            <!-- End .content --> 
          </div>
          <!-- End  .box --> 
        </div>
        <div class="span6">
          <div class="box paint color_0">
            <div class="title">
              <div class="row-fluid">
                <h4> SEO </h4>
              </div>
            </div>
            <!-- End .title -->
            <div class="content">
              <div class="tabbable tabs-left">
                <ul id="tabExample2" class="nav nav-tabs">
                  <li class="active"><a href="#seo_title" data-toggle="tab"> SEO Title </a></li>
                  <li><a href="#meta_description" data-toggle="tab">Meta Description</a></li>
                  <li class="dropdown"> <a href="#meta_keywords" data-toggle="tab"> Meta Keywords </a> </li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane fade in active" id="seo_title">
                    <p> <?php echo $category_details->seo_title; ?> </p>
                  </div>
                  <div class="tab-pane fade" id="meta_description">
                    <p><?php echo $category_details->meta; ?></p>
                  </div>
                  <div class="tab-pane fade" id="meta_keywords">
                    <p><?php echo $category_details->meta_key; ?></p>
                  </div>
                  
                </div>
              </div>
            </div>
            <!-- End .content --> 
          </div>
          <!-- End  .box --> 
        </div>
                          </div>
                </div>
                
              </div>
            </div>    
        </div>
	</div>
</div>


<script type="text/javascript">

j = jQuery.noConflict() ;
j('form').submit(function() {
	j('.btn').attr('disabled', true).addClass('disabled');
});
 var funcNode = ''
 var foldername = ''
j(document).ready(function() {
    j (".various").fancybox({
        maxWidth    : 800,
        maxHeight    : 600,
        fitToView    : false,
        width        : '70%',
        height        : '70%',
        autoSize    : false,
        openEffect    : 'none',
        closeEffect    : 'none',
        beforeClose:function(){
           
         funcNode    = $(".fancybox-iframe").contents().find("#insert-filename").val();
         foldername  = $(".fancybox-iframe").contents().find("#folder-name").val();
          //console.log(funcNode)
          $(".uneditable-input").html("<span>"+foldername+"</span>")
           document.getElementById('media_image').value = funcNode;
           document.getElementById('image_path').value  = foldername;
        },
        afterClose:function(){
           // alert("shahid")
            //document.getElementById('unique_image_id').disabled = false;
           
        }
                       
       
    });
    
   // window.setInterval(function(){alert(greeting);},6000)
});
</script>