<script>
//Block open/close
$(document).ready(function(){
  $('.block .extend').click(function() {
    $(this).toggleClass('rotated');
    $(this).closest('.header').siblings('.body').slideToggle();
  });
});
</script>