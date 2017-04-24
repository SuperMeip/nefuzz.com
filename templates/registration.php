<?php
require_once("components/common.php");
require_once("components/registration.php");
?>

<form
  class="main"
  id="registration-form"
  action="controls/registration/add_new_user.php"
  method="POST"
>
  <?=new Block([
    "title" => "Name and Password",
    "template" => "registration/names"
  ]);?>
  
  <?=new Block([
    "title" => "Upload an Icon",
    "template" => "registration/upload_icon",
    "is_expandable" => true,
    "starts_closed" => true
  ]);?>
  
  <?=new Block([
    "title" => "Address",
    "template" => "registration/address"
  ]);?>
  
  <?=new Block([
    "title" => "Contact Information",
    "template" => "registration/contact_info"
  ]);?>
  
  <?=new Block([
    "title" => "Emergency Information",
    "template" => "registration/emergency_info",
    "is_expandable" => true,
    "starts_closed" => true
  ]);?>
  
  <?=new Button([
    "is_submit" => true,
    "label" => "Submit",
    "extra_classes" => "large lone"
  ]);?>
</form>
  
<?=new Modal([
  "uncloseable" => true,
  "title" => "Success :)",
  "id" => "registration-success",
  "content" =>  "<p class=\"modal_text\">
                Welcome to NEFuzz.com,
                you have successfully
                created a new user and 
                can log in on the next 
                page!</p>"
]);?>  

<?=new Modal([
  "title" => "Error :(",
  "id" => "registration-failed",
  "content" =>  "<p class=\"modal_text\">
                We applologize but it seems
                something went wrong trying
                to make this new user. Try
                verifying everything you've entered
                and submitting again, if the
                issue persists contact a site
                administrator.</br></br> ERROR:
                <div class=\"error_message\"><p></p></div></p>"
]);?>