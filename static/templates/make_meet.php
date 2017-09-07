<?=$this->redirect();?>

<div class="row center">
  <h1 class="page_title">Add New Meet</h1>
</div>
<form 
  class="main"
  id="make-meet-form"
  method="POST"
  action=""
>
  <?=new Block([
    "title" => "Meet Info",
    "content" => new \Nefuzz\Views\Make_Meet\Names()
  ]);?>
  <?=new Block([
    "title" => "Upload an Icon",
    "template" => "registration/upload_icon",
    "is_expandable" => true,
    "starts_closed" => true
  ]);?>
  <?=new Block([
    "title" => "Default Event Info",
    "content" => new \Nefuzz\Views\Make_Meet\Basic_Details()
  ]);?>
  <?=new Block([
    "title" => "Default Event Address",
    "content" => new \Nefuzz\Views\Make_Meet\Address()
  ]);?>
  <?=new Block([
    "title" => "Alternative Host Info",
    "content" => new \Nefuzz\Views\Make_Meet\Alternate_Host(),
    "is_expandable" => true,
    "starts_closed" => true
  ]);?>
  <?=new Block([
    "title" => "RRule (Advanced)",
    "content" => new \Nefuzz\Views\Make_Meet\RRule(),
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
                You have successfully subbmitted a new meet!
                Taking you back to your meets page...</p>"
]);?>  

<?=new Modal([
  "title" => "Error :(",
  "id" => "registration-failed",
  "content" =>  "<p class=\"modal_text\">
                We applologize but it seems
                something went wrong trying
                to make this new meet. Try
                verifying everything you've entered
                and submitting again, if the
                issue persists contact a site
                administrator.</br></br> ERROR:
                <div class=\"error_message\"><p></p></div></p>"
]);?>