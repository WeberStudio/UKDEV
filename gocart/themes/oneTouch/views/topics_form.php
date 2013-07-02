<?php include('mainHeader.php'); ?>
<?php echo theme_css('basee.css', true); ?>
<body class="home page page-template page-template-page-no_top-php theme-onetouch wpb-js-composer js-comp-ver-3.4.12 vc_responsive">
<script> var customStyleImgUrl = "images/custom-slider-img";</script>
<?php //include('leftPanel.php'); ?>
<!--        
-->
<div id="body-wrapper" >
  <div id="body-wrapper-padding">
    <!--[if lt IE 7]>
                <div class="alert">Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different
                browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to
                experience this site.
                </div><![endif]-->
    <?php include('header.php'); ?>
    <div class="row">
    <div class="line"> </div>
    </div>
    <div id="main">
      <div class="container">
        <div id="main_container">
          <div class="row-fluid">
            <?php include('dashboard_leftpanal.php');?>
            <!-- End .span3 -->
            <div class="span6">
              <div class="row">
                <div id="content" class="fifteen columns">
                  <div class="col-1">
                    <h3>Add New Topic</h3>
                    <form action="<?=base_url().'topics/topic_form/'.$forum_id.'/'.$id?>" method="post">
                    <table width="100%">
                      <tbody>
                        <tr>
                            <td>
                                <label class="control-label span1" for="hint-field">Title</label>
                                <input type="text" class="redactor" name="topic_title" value="<?=set_value('topic_title', $topic_title)?>">   
                            </td>                 
                        </tr>
                        
                        <tr>
                            <td>
                                <label class="control-label span1" for="hint-field">Message</label>
                                <textarea name="topic_message" class="redactor" ><?=set_value('topic_message', $topic_message)?></textarea> 
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input class="submitbutton" name="submitted" id="wp-submit" value="Save" type="submit">
                            </td>
                        </tr>
                     </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- End .span9 -->
          </div>
          <!-- End .row-fluid -->
        </div>
        <!-- End #container -->
      </div>
    </div>
  </div>
</div>
<?php include_once('footer.php'); ?>
</body>
</html>