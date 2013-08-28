<?php include('main_header.php')?>
    <body>
<?php
if($this->session->flashdata('message'))
    {
        $message    = $this->session->flashdata('message');
    }
    
if($this->session->flashdata('error'))
    {
        $error    = $this->session->flashdata('error');
    }
if(validation_errors() != '')
    {
        $error    = validation_errors();
    } 

$company    = array('id'=>'company', 'class'=>'input-text', 'name'=>'company', 'value'=> set_value('company', @$customer['company']));
$first        = array('id'=>'firstname', 'class'=>'input-text', 'name'=>'firstname', 'value'=> set_value('firstname', @$customer['firstname']));
$f_city        = array('id'=>'f_city', 'class'=>'input-text', 'name'=>'city', 'value'=>set_value('city',@$customer['city']));
$f_zip        = array('id'=>'f_zip', 'maxlength'=>'10', 'class'=>'input-text', 'name'=>'zip', 'value'=> set_value('zip', @$customer['post_code']));
$f_address1    = array('id'=>'f_address1', 'class'=>'input-text', 'name'=>'address1', 'value'=>set_value('address1', @$customer['address_street']));
$f_address2    = array('id'=>'f_address2', 'class'=>'input-text', 'name'=>'address2', 'value'=> set_value('address2', @$customer['address_line']));
$last        = array('id'=>'lastname', 'class'=>'input-text', 'name'=>'lastname', 'value'=> set_value('lastname', @$customer['lastname']));
$email        = array('id'=>'email', 'class'=>'input-text', 'name'=>'email', 'value'=> set_value('email', @$customer['email']));
$phone        = array('id'=>'phone', 'class'=>'input-text', 'name'=>'phone', 'value'=> set_value('phone', @$customer['phone']));
?>

<style>
   .alert-error
   {
             background-color:#F88C8C;
             color:#FFFFFF;
   }      
</style>

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
                 
                 <div class="seperator">
                     <div class="col6">
                        <h1 class="sep">Open the Door of Opportunity</h1>
                        <p class="sep"><a href="<?=base_url().'cart/allcourses/'?>">view all of our courses</a></p>
                    </div>
                    
                    
                     <div class="col6 social-icons">
                        <a href="https://twitter.com/UKOpen" target="_blank"> <img align="right" alt="" src="http://87.106.234.213/gocart/themes/oneTouch/assets/images/img/twiter-logo.png" style="margin-left: 10px; margin-top: 5px"></img> </a>
                        <a href="http://www.linkedin.com/company/uk-open-college/products?trk=tabs_biz_product" target="_blank"> <img align="right" alt="" src="http://87.106.234.213/gocart/themes/oneTouch/assets/images/img/link-in.png" style="margin-left: 10px; margin-top: 5px"></img> </a>
                        <a href="http://www.youtube.com/watch?v=4dabsHc8yNE&feature=youtube" target="_blank"> <img align="right" alt="" src="http://87.106.234.213/gocart/themes/oneTouch/assets/images/img/youtube.png" style="margin-left: 10px; margin-top: 5px"></img> </a>
                        <a href="https://www.facebook.com/pages/UK-Open-College/411574175557181" target="_blank"><img align="right" alt="" src="http://87.106.234.213/gocart/themes/oneTouch/assets/images/img/face-book.png" style="margin-left: 10px; margin-top: 5px"></img></a>
                     </div>
                     
                   </div>
                 </div><!-- end seperator row -->
                 
                 
                 
                 <div class="onerow">
                     <div class="col12">
                        
                        <div class="col3"  >
                        <h2><a onMouseOver="change_text_color();" href="<?php echo base_url().'checkout/' ?>">1. Personal Details </a></h2>
                        </div>
                        
                        <div class="col3"  onMouseOver="change_text_color();">
                        <h2 align="right" class="dull"><a class="option_links" href="<?php echo base_url().'checkout/step2' ?>">2. Address Details </a></h2>
                        </div>
                        
                        <div class="col3"  onMouseOver="change_text_color();">
                        <h2 align="right" class="dull"><a class="option_links" href="<?php echo base_url().'checkout/step3' ?>">3. Confirm </a></h2>
                        </div>
                        
                        <div class="col3"  onMouseOver="change_text_color();">
                        <h2 align="right" class="dull"><a class="option_links" href="<?php echo base_url().'checkout/step4' ?>">4. Payment </a></h2>
                        </div>
                       
                        
                        
                        <div class="col6">
                        
                          <div class="col12">
                         

<?php if (!empty($error)): ?>
          <div class="alert alert-error" id="closee"> <a href="javascript:void(0)"  class="close" data-dismiss="alert" onClick="hide_error(); return false;">x</a> <?php echo"<div style='margin-left: 70px;'>". $error. "</div>"; ?> </div>
          <?php endif; ?>
          
      
<?php if (!empty($message)): ?>
        <div class="alert alert-success">
            <a class="close" data-dismiss="alert">×</a>
            <?php echo $message; ?>
        </div>
 <?php endif; ?>
                                <form action="<?php base_url().'checkout'?>" method="post" class="personal-form-1" id="personal-form" name="personalDetails">
                                    <fieldset>
                                        <legend><h3>Personal Details</h3></legend>
                                           
                                        <p>Fields marked with a * are mandatory</p>
                                            <p><label for="Email" id="Email_Label">First Name*</label>
                                            <?php echo form_input($first);?>
                                            </p>
                                            <p><label for="Email" id="Email_Label">Last Name*</label>
                                            <?php echo form_input($last);?>
                                            </p>
                                            <p><label for="Email" id="Email_Label">Company</label>
                                            <?php echo form_input($company);?>
                                            </p>
                                            <p><label for="Email" id="Email_Label">Address*</label>
                                            <?php echo form_input($f_address1);?>
                                            <?php echo form_input($f_address2);?>
                                            </p>
                                            <p><label for="Email" id="Email_Label">City*</label>
                                            <?php echo form_input($f_city);?>
                                            </p>
                                            <p><label for="Email" id="Email_Label">Post Code *</label>
                                            <?php echo form_input($f_zip);?>
                                            </p>
                                        <div class="col6" style=" padding-top: 0px;">
                                        <p class="username"> Country</p>
                                        <?php echo form_dropdown('country_id',$countries_menu, @$customer['country'], ' onchange="get_county()" id="country_id" class="select-country-state" ');?>
                                        </div>
                                        
                                        <div class="col6" style=" padding-top: 0px;">
                                        <p class="username"> State/County</p>
                                       <?php echo form_dropdown('zone_id',$zones_menu, @$customer['state'], 'id="f_zone_id" class="select-country-state"');?>
                                        </div>
                                            <p><label for="Email" id="Email_Label">Phone*</label>
                                            <?php echo form_input($phone);?>
                                            </p>
                                            <p><label for="Email" id="Email_Label">Email *</label>
                                            <?php echo form_input($email);?>
                                            </p>
                                            <div class="formDivider"></div>

                                            

                                            
                                            <p>
                                            <input type="submit" class="action primary submit" value="Next Step" />
                                            </p>
                                    </fieldset>
                                </form>
                           </div><!-- end col12 -->
                           
                              
                        </div> <!-- end col6 -->
                        <div class="col6">
                        <div class="col12">
                                      <span style="color:#666; font-size:11px; margin-left: 245px;" > We accept the following Sage Pay, PayPal, All Debit and Credit Cards. </span>
                                    <div class = "payment_options">
                                      
                                           <img align="right" style="margin-left: 10px; margin-top: 5px" src="<?=theme_assets('images/pay_cards/maestro.png')?>" alt="">
                                        <img align="right" style="margin-left: 10px; margin-top: 5px" src="<?=theme_assets('images/pay_cards/mc.png')?>" alt="">
                                        <img align="right" style="margin-left: 10px; margin-top: 5px" src="<?=theme_assets('images/pay_cards/PayPal_mark.gif')?>" alt="">
                                        <img align="right" style="margin-left: 10px; margin-top: 5px" src="<?=theme_assets('images/pay_cards/solo.png')?>" alt="">
                                        <img align="right" style="margin-left: 10px; margin-top: 5px" src="<?=theme_assets('images/pay_cards/visa.png')?>" alt="">
                                         <img align="right" style="margin-left: 10px; margin-top: 5px" src="<?=theme_assets('images/pay_cards/visa_debit.png')?>" alt="">
                                          <img align="right" style="margin-left: 10px; margin-top: 5px" src="<?=theme_assets('images/pay_cards/visa_electron.png')?>" alt="">
                                    </div>
                           </div><!-- end col12 -->
                        </div>
                        
                        
                    </div><!-- end col12 -->
                   
                 </div><!-- end one row -->
                 
                 
                 
                                   
                 
                 
                 
          </section>         
            <div class="clear"></div>
   <script type="text/javascript" language="javascript">
function get_county()
{
    
var id  = document.getElementById('country_id').value;
 j      = jQuery.noConflict();
 
 j.ajax({ 
                type: "POST",         //GET or POST or PUT or DELETE verb
                url:  '<?=base_url()?>locations/get_zone_menu',         // Location of the service
                data: 'id='+id,         //Data sent to server
                success: function (data) 
                {//On Successful service call
                 //alert(data);
                    j('#f_zone_id').html(data);
                },
                
       });
}
function hide_error() {

    var el = document.getElementById('closee');

    if ( el.style.display != 'none' ) {

        el.style.display = 'none';

    }
return false;
}
</script>           
<!--<script type="text/javascript">
  var j = jQuery.noConflict();
    j(function(){
        j('#country_id').change(function(){
                j.post('<?php echo site_url('locations/get_zone_menu');?>',{id:j('#country_id').val()}, function(data) {
                  j('#f_zone_id').html(data);
                });
                
            });
            
    });
</script>-->         

  <?php include('footer.php')?>
