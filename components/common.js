
$(document).ready(function(){
  //modal open/close buttons
  $('.modal_container .activator').click(function() {
    $(this).siblings('.modal').css('display', 'block');
  });
  $('.modal_container .close').click(function() {
    $(this).closest ('.modal').css ('display', 'none');
	  });

  //block open/close
  $('.block .extend').click(function() {
  	//console.log($(this).closest('.header').siblings('.body'));
    $(this).toggleClass('rotated');
    $(this).closest('.header').siblings('.body').slideToggle();
  });
});