<?php include('mainHeader.php'); ?>  

<script> var customStyleImgUrl = "images/custom-slider-img";</script>

<?php
    //$company        = array('id'=>'bill_company', 'class'=>'input-text', 'placeholder'=>'Company', 'name'=>'company', 'value'=> set_value('company'));
    $first            = array('id'=>'dbilling_first_name','class'=>'input-text','placeholder'=>'First Name','name'=>'firstname','value'=> set_value('firstname', $customer['firstname']));
    $last            = array('id'=>'dbilling_last_name','class'=>'input-text','placeholder'=>'Last Name','name'=>'lastname','value'=> set_value('lastname', $customer['lastname']));
    $email            = array('id'=>'dbill_email', 'class'=>'input-text', 'placeholder'=>'E-Mail', 'name'=>'email', 'value'=>set_value('email', $customer['email']));

    $phone        = array('id'=>'dbill_phone', 'class'=>'input-text', 'name'=>'phone', 'placeholder'=>'Phone', 'value'=> set_value('telephone', $customer['telephone']));

    $f_city            = array('id'=>'df_city', 'class'=>'input-text', 'placeholder'=>'City', 'name'=>'city', 'value'=>set_value('city',$customer['city']));
    $f_zip            = array('id'=>'df_zip',  'class'=>'input-text', 'placeholder'=>'Post Code', 'name'=>'post_code', 'value'=> set_value('zip', $customer['post_code']));
    $f_address1        = array('id'=>'df_address1', 'placeholder'=>'Address', 'class'=>'input-text', 'name'=>'street_address', 'value'=>set_value('address1', $customer['street_address']));
    $f_address2        = array('id'=>'df_address2','class'=>'input-text','placeholder'=>'Address  (optional)','name'=>'address_line2', 'value'=> set_value('address2', $customer['address_line2']));
    //$password         = array('id'=>'password','name'=>'password','class'=>'input-text','placeholder'=>'Password'); 
    //$con_password     = array('id'=>'confirm','name'=>'confirm','class'=>'input-text','placeholder'=>'Confirm'); 
    //$gender_m     = array('id'=>'gender_m', 'class'=>'','name'=>'gender', 'value'=>'male' );
    //$gender_f     = array('id'=>'gender_f', 'class'=>'', 'name'=>'gender', 'value'=>'female' );
?>




<div id="body-wrapper" >        
    <div id="body-wrapper-padding">            
        <!--[if lt IE 7]>
        <div class="alert">Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different
        browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to
        experience this site.
        </div><![endif]-->
        <?php  include('header.php'); ?> 
        <?php $last            = array('id'=>'billing_last_name','class'=>'input-text','placeholder'=>'Last Name','name'=>'lastname','value'=> set_value('lastname'));?>
        <!--===================main content start=======================-->
        <div class="row">
            <h1 class="page-title" style="margin-left:20px;">
                <a class="black" href="javascript:void(0)">CHANGE THE DELIVERY ADDRESS</a>
            </h1>

        </div>
        <div class="row">
            <div class="forteen columns delivery_information">
                <h3>Current Delivery Address</h3>
                <div class="five columns">
                    <br/>
                    <p><?php echo $firstname." ".$lastname;?></p>

                    <p style="margin-top:-15px  !important;"> <?php echo $street_address;?></p>
                    <p style="margin-top:-15px !important;"><?php echo $address_line2;?></p>
                    <p style="margin-top:-15px !important;"><?php echo $city." ".$post_code;?></p>
                    <p style="margin-top:-15px !important;"> <?php echo $state." ".$country_id;?></p>
                </div>


                <div class="six columns" style="margin-right: 120px;"><p> <b>Please use the following form to create a new Delivery address for use with this order.</b></p></div>
            </div>

            <!----- main content section start---->
            <div class="row">
            <div id="content" class="fifteen columns">

            <?php echo form_open('shipping_order/delivery_address'); ?>
            <input type="hidden" name="submitted" value="submitted" />
            <input type="hidden" name="redirect" value="<?php //echo $redirect; ?>" />
            <div class="col2-set" id="customer_details">
            <div class="col-1">
            <h3>Address Details</h3>
            <p class="form-row " id="billing_company_field">
            <label style="margin-bottom: -5px;" for="billing_company" class="">Mr. <input type="radio" name="gender" value="mr"/> Ms.<input type="radio" name="gender" value="ms"/></label>
            </p>
            <p class="form-row form-row-first" id="billing_first_name_field">
            <label for="billing_first_name" class=""><?php echo lang('account_firstname');?><abbr class="required" title="required">*</abbr> </label>
            <?php echo form_input($first);?> </p>
            <p class="form-row form-row-last" id="billing_last_name_field">
            <label for="billing_last_name" class=""><?php echo lang('account_lastname');?> <abbr class="required" title="required">*</abbr> </label>
            <?php echo form_input($last);?> </p>
            <div class="clear"></div>

            <!--<p class="form-row " id="billing_company_field">
            <label for="billing_company" class=""><?php echo lang('account_company');?></label>
            <?php echo form_input($company);?> </p>-->
            <div class="clear"></div>

            <p class="form-row form-row-first" id="billing_address_1_field">
                <label for="billing_address_1" class="">Street Address<abbr class="required" title="required">*</abbr></label>
            <?php echo form_input($f_address1);?> </p>
            <p class="form-row form-row-last" id="billing_address_2_field">
                <label for="billing_address_2" class="">Address Line 2</label>
            <?php echo form_input($f_address2);?> </p>
            <div class="clear"></div>

            <p class="form-row form-row-first" id="billing_city_field">
                <label for="billing_city" class=""><?php echo lang('address_city');?><abbr class="required" title="required">*</abbr> </label>
            <?php echo form_input($f_city);?> </p>
            <p class="form-row form-row-last update_totals_on_change" id="billing_postcode_field">
                <label for="billing_postcode" class="">State/County<abbr class="required" title="required">*</abbr> </label>
            <?php echo form_dropdown('zone_id', $zones_menu, set_value('zone_id', $zone_id), 'id="f_zone_id" class="country_to_state form-row-first update_totals_on_change country_select chzn-done"');?> </p>
            <!--<p class="form-row form-row-last update_totals_on_change" id="billing_postcode_field">
            <label for="billing_postcode" class=""><?php echo lang('address_postcode');?> <abbr class="required" title="required">*</abbr> </label>
            <?php echo form_input($f_zip);?> </p>-->
            <div class="clear"></div>

            <p class="form-row form-row-first update_totals_on_change" id="billing_postcode_field">
                <label for="billing_postcode" class=""><?php echo lang('address_postcode');?> <abbr class="required" title="required">*</abbr> </label>
            <?php echo form_input($f_zip);?> </p>
            <p class="form-row form-row-last" id="billing_city_field">
                <label for="billing_city" class=""><?php echo lang('address_country');?><abbr class="required" title="required">*</abbr> </label>
            <?php echo form_dropdown('country_id', $countries_menu, set_value('country_id', $country_id), 'id="country_id" class="country_to_state form-row-first update_totals_on_change country_select chzn-done"');?> </p>
            <div class="clear"></div>


            <p>
                <b>Continue</b> - to Delivery method.
            </p>
            <div class="clear"></div>
            <!--<p class="form-row " id="billing_company_field">
            <label class="checkbox">
            <input type="checkbox" name="email_subscribe" value="1" <?php echo set_radio('email_subscribe', '1', TRUE); ?>/>
            <?php echo lang('account_newsletter_subscribe');?> </label>
            </p>-->
            <p class="form-row " id="billing_company_field">
                <input type="submit" value="Continue " class="button" name="continue" style="height: 34px; width: 74px;" />
            </p>  

        </div>
    </div>
    </form>

    <section id="shopping_cart-2" class="widget-2 widget widget_shopping_cart"> </section>
</div>
</div>

<script type="text/javascript">
    var j = jQuery.noConflict();
    j(function(){
        j('#country_id').change(function(){
            j.post('<?php echo site_url('locations/get_zone_menu');?>',{id:j('#country_id').val()}, function(data) {
                j('#f_zone_id').html(data);
            });

        });
    });



</script>
        <!--===================main content start=======================-->
    </div>
        </div>
        

        <?php include_once('footer.php'); ?> 
        
       
  
