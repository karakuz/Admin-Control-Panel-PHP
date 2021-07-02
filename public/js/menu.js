
$('.ui.left.sidebar').sidebar({
  transition: 'overlay',
  mobileTransition: 'overlay'
});
// left is opened by button
$('.ui.left.sidebar')
.sidebar('attach events', '#menu-icon');

$('.ui .dropdown').dropdown('show');

$('.ui .dropdown').click( (e) => {
  if($('.dd-icon').hasClass("right"))
    $('.dd-icon').removeClass("right").addClass("down");
  else if($('.dd-icon').hasClass("down"))
    $('.dd-icon').removeClass("down").addClass("right");
  
});

$(document).click( () => {
  if($('#charts-dropdown-menu').hasClass("in"))
    $('.dd-icon').removeClass("right").addClass("down");
  else if($('#charts-dropdown-menu').hasClass("out"))
    $('.dd-icon').removeClass("down").addClass("right");
}); 