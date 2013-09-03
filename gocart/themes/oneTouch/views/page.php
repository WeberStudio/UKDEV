<?php include('mainHeader.php'); ?>  

     <?php include('header.php'); ?> 
<div class="row"><h1><?php echo $page_title; ?></h1> 
<?php echo html_entity_decode($page->content); ?></div>
<?php include_once('footer.php'); ?> 