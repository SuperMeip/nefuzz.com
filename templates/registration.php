<?=$this->redirect()?>

<form
  class="main"
  id="registration-form"
  action="controllers/registration.php"
  method="POST"
>
  <?=new Block([
    "title" => "Name and Password",
    "content" => new Names_Registration_View()
  ]);?>
  
  <?=new Block([
    "title" => "Upload an Icon",
    "template" => "registration/upload_icon",
    "is_expandable" => true,
    "starts_closed" => true
  ]);?>
  
  <?=new Block([
    "title" => "Address",
    "content" => new Address_Registration_View()
  ]);?>
  
  <?=new Block([
    "title" => "Contact Information",
    "content" => new Contact_Info_Registration_View()
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