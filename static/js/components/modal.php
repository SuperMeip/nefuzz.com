<script>
//modal open/close
$(document).ready(function(){
  $('.modal_container .activator').click(function() {
    $(this).siblings('.modal').css('display', 'block');
  });
  $('.modal_container .close').click(function() {
    $(this).closest ('.modal').css ('display', 'none');
  });
});
</script>