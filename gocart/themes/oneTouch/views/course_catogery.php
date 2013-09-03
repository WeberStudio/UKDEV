<?php echo theme_css('stylesheet.css', true); ?> 
<div class="row">

<div id="banner">

			<table width="100%" border="0" cellspacing="0" cellpadding="0" id="contentMainWrapper" style="border:none !important;">
				<tr >
				  <td valign="top">
					<div class="centerColumn" id="indexCategories">     
					
					<?
					$counter = 0;
					 foreach($this->categories as $key => $cat_info)
					   {
					   	
						if(count($cat_info['children'])>0)
						{
							$counter = $counter + 1;
					   ?>
							<div class="categoryListBoxContents" style="width:33%; float:left;">
							<a href="<?=base_url().$cat_info['category']->slug?>"><?=$cat_info['category']->name?></a>
							
							<?
							
								if(count($cat_info['children'])>0)
								{?>
								
									
								<?	foreach($cat_info['children'] as  $children)
									{?>
										<div class="subcat">
										<a href="<?=base_url().$children['category']->slug?>"><?=$children['category']->name?></a>
										</div>
								<? 	}
																
								}								
								
							?>
							</div>						
					<?	
						}
							if($counter%3==0)
							{
								
								echo '<br class="clearBoth" />';
							
							}
					}							
					?>
					 <!-- <div class="categoryListBoxContents" style="width:33%;">
						<a href="http://www.ukopencollege.co.uk/animal-care-courses-c-214.html">Animal Care Courses</a>
						<div class="subcat"><a href="http://www.ukopencollege.co.uk/animal-care-courses-equine-courses-c-214_130.html">Equine Courses</a></div>
						
					  </div>
					  
					  <br class="clearBoth" />-->
					</div>
				  </td>
				</tr>
			</table>
		</div>
		
</div>		
		
		
		
		
		
<?php /*?><? //echo "<pre>";  print_r($this->categories); exit;?>

<?
 foreach($this->categories as $key => $cat_info)
   {?>
		<a href="<?=base_url().$cat_info['category']->slug?>"><?=$cat_info['category']->name?></a>
		
		<?
		
			if(count($cat_info['children'])>0)
			{?>
			
				
			<?	foreach($cat_info['children'] as  $children)
				{?>
					
					<a href="<?=base_url().$children['category']->slug?>"><?=$children['category']->name?></a>
			<? 	}
											
			}								
			
		?>
<?	}							
?><?php */?>

<?  

/* foreach($this->categories as $key => $cat_info)
   {
		//print_r($cat_info);
		
		echo $cat_info['category']->name;
		
		if(count($cat_info['children'])>0)
		{
			foreach($cat_info['children'] as  $children)
			{
				//echo '<pre>';print_r($children['category']->name);
				echo '----'.$children['category']->name."<br>";
			}										
		}
		
	}		*/					
?>	




