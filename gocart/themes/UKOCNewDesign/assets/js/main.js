//don't hide if mouse is hovering over all-courses

$('#all-courses').hover(function(e){
	
	e.preventDefault();
	
	if($("#sub-menu").outerHeight() != 0)
	{
		submenuhide();
	}else
	{
		submenushow();
	}
}, function() {
	
		submenuhide();
	});

//don't hide if mouse is hovering over sub-menu

$('#sub-menu').hover(function(e){
	
	e.preventDefault();
	
	if($("#sub-menu").outerHeight() >0)
	{
		submenushow();
	}else
	{
		submenuhide();
	}
}, function() {
	
		submenuhide();
	});

	
function submenushow(){
	
	$("#sub-menu").stop().animate({
		height: "195px",
	},300);
};
function submenuhide(){	
	$("#sub-menu").stop().animate({
		height: "0px",
	},300);
};

/*$(".search-btn").click(function(e){
	e.preventDefault();
	$(".filters-menu").stop().fadeIn(300);
});

$(".filters-menu").mouseleave(function(){
	$(this).stop().fadeOut(300);
	$(".down-arrow").stop().fadeOut(300);
});
*/

$(".search-btn").click(function(e){
	e.preventDefault();
	
	$(".filters-menu").toggle(300);
	$(".down-arrow").fadeToggle(300);
	
	if($(".filters-menu").css('height') != '0px')
	{
		/*$(".filters-menu").stop().fadeOut(300);
		$(".down-arrow").stop().fadeOut(300);*/
		
	}else
	{
		
	}
	
	
});

$(".top-res-menu").click(function(e){
	e.preventDefault();
	$(".menu-responsive").toggle(300);
	
});


//for tabs 

$('ul.tabs').each(function(){
  // For each set of tabs, we want to keep track of
  // which tab is active and it's associated content
  var $active, $content, $links = $(this).find('a');

  // If the location.hash matches one of the links, use that as the active tab.
  // If no match is found, use the first link as the initial active tab.
  $active = $($links.filter('[href="'+location.hash+'"]')[0] || $links[0]);
  $active.addClass('active');
  $content = $($active.attr('href'));

  // Hide the remaining content
  $links.not($active).each(function () {
    $($(this).attr('href')).hide();
  });

  // Bind the click event handler
  $(this).on('click', 'a', function(e){
    // Make the old tab inactive.
    $active.removeClass('active');
    $content.hide();

    // Update the variables with the new link and content
    $active = $(this);
    $content = $($(this).attr('href'));

    // Make the tab active.
    $active.addClass('active');
    $content.fadeIn(300);

    // Prevent the anchor's default click action
    e.preventDefault();
  });
});


// views

$("#list-view").click(function()
{
	$(this).addClass("view-active");
	$("#grid-view").removeClass("view-active");
	
	$("#courses").stop().fadeOut(300);
	$("#courses-list").stop().fadeIn(300);
});

$("#grid-view").click(function()
{
	$(this).addClass("view-active");
	$("#list-view").removeClass("view-active");
	
	$("#courses").stop().fadeIn(300);
	$("#courses-list").stop().fadeOut(300);
});


// all courses hover

$(".c-hover").mouseenter(function(){
	
	$(this).children('img').stop().animate({
		opacity:0.75,	
	},300);
});

$(".c-hover").mouseleave(function(){
	
	$(this).children('img').stop().animate({
		opacity:1,	
	},300);
});



