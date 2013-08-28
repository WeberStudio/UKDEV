<?php include('main_header.php')?>
<body>


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


            <div class="col3">
                <h2  class="dull" onMouseOver="change_text_color();">1. Personal Details</h2>
            </div>

            <div class="col3">
                <h2 align="right" class="dull" onMouseOver="change_text_color();">2. Address Details</h2>
            </div>

            <div class="col3">
                <h2 align="right" class="dull" onMouseOver="change_text_color();">3. Confirm</h2>
            </div>

            <div class="col3">
                <h2 align="right" onMouseOver="change_text_color();">4. Payment</h2>
            </div>
            <h3 >Payment Options</h3>   
            <div class="col6">



                <!--<div class="col12">

                <h3>Credit / Debit Card Payment</h3>
                <p>
                <input type="radio" name="pay_method" value="" onClick="" checked />            <b>Credit/Debit Card (Secured by Protx) </b>
                </p>
                <p class="cc">
                <img src="img/p-options.png" alt="credit/debit cards" class="cc" />            
                </p>

                </div>-->

                <div class="col12">

                    <h3>Checkout with PayPal </h3>

                    <div class="paypal-img">
                        <a href="<?=base_url()?>checkout/place_order">
                            <img src="<?=theme_assets('img/paypal.png')?>" alt="PayPal" />
                        </a>
                    </div>

                    <div class="gap"></div>

                    <p class="button"><a href="<?=base_url()?>checkout/place_order">Paypal Checkout</a></p>

                </div>





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
                </div>
                <h3>Credit/Debit Card Information</h3> 

                <form action="<?=base_url()?>checkout/place_order_paypal_pro" method="POST" autocomplete="on" class="padding-left-right">
                    <p class="username">
                        Name as on Card
                    </p>
                    <input type="text" name="cardowner" id="cardowner" placeholder="" required />
                    <!--<label for="name">Name</label>-->


                    <p class="username">
                        Select Card Type</p>
                    <?php 
                        $option    = array(''=>'Select Card Type','VISA'=>'Visa','MC'=>'MasterCard' ,'DELTA'=>'Visa Debit' ,'SOLO'=>'Solo' ,'MAESTRO'=>'Maestro' ,'UKE'=>'Visa Electron (UKE)' );
                        echo form_dropdown('select_card',$option ,'','class="select-country-state"');    
                    ?>
                    <!--<label for="email">Email</label>-->
                    <p class="username">
                        Card Number</p>
                    <input type="text" name="cardnumber" id="cardnumber"  placeholder="" autocomplete="off" required />
                    <!--<label for="email">Email</label>-->
                    <div class="col6">
                        <p class="username"> Card Expiry Month</p>
                        <?php 
                            $option    = array(''=>'Select Month','01'=>'January','02'=>'February' ,'03'=>' March' ,'04'=>'April' ,'05'=>'May' ,'06'=>'  June','07'=>'July' ,'08'=>'August' ,'09'=>'September' ,'10'=>'October' ,'11'=>'November' ,'12'=>'December');
                            echo form_dropdown('select_month',$option,'', 'class="select-country-state"');    

                        ?>
                    </div>

                    <div class="col6">
                        <p class="username"> Card Expiry Year</p>
                        <?php
                            $option    = array(''=>'Select Year','2013'=>'2013','2014'=>'2014' ,'2015'=>' 2015' ,'2016'=>'2016' ,'2017'=>'2017' ,'2018'=>' 2018','2019'=>'2019' ,'2020'=>'2020' ,'2021'=>'2021' ,'2022'=>'2022');
                            echo form_dropdown('select_year',$option, '', 'class="select-country-state"');
                        ?>
                    </div>
                    <p class="username">C.V.V Number</p>
                    <input type="text" name="cardnumber" id="cardnumber"  placeholder="" autocomplete="off" required />
                    <!--<label for="email">Email</label>-->
                    <div class="col6">
                        <p class="username"> Card Start Date(If On Card)</p>
                        <?php 
                            $option    = array(''=>'Select Month','01'=>'January','02'=>'February' ,'03'=>' March' ,'04'=>'April' ,'05'=>'May' ,'06'=>'  June','07'=>'July' ,'08'=>'August' ,'09'=>'September' ,'10'=>'October' ,'11'=>'November' ,'12'=>'December');
                            echo form_dropdown('select_month',$option,'', 'class="select-country-state"');    

                        ?>
                    </div>

                    <div class="col6" style="padding-top: 62px;">
                        <p class="username"> </p>
                        <?php
                            $option    = array(''=>'Select Year','2008'=>'2008','2009'=>'2009','2010'=>'2010','2011'=>'2011','2012'=>'2012','2013'=>'2013','2014'=>'2014' ,'2015'=>' 2015' ,'2016'=>'2016' ,'2017'=>'2017' ,'2018'=>' 2018','2019'=>'2019' ,'2020'=>'2020' ,'2021'=>'2021' ,'2022'=>'2022');
                            echo form_dropdown('select_year',$option, '', 'class="select-country-state"');
                        ?>
                    </div>
                    <p class="username">Card Issue No (If On Card)</p>
                    <input type="text" name="cardnumber" id="cardnumber"  placeholder="" autocomplete="off" required />
                    <!--<label for="email">Email</label>-->

                    <p class="submit" style="margin-right:25px;">
                        <input type="submit" value="Checkout" class="button" />
                    </p>




                </form>

            </div>


        </div><!-- end col12 -->

    </div><!-- end one row -->






          </section>       
            <div class="clear"></div>

  <?php include('footer.php')?>