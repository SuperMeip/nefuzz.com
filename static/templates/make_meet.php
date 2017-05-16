<div class="row center">
  <h1 class="page_title">Add/Edit Meet</h1>
</div>
<form 
  class="main"
  id="addedit_meet-form"
  method="POST"
  action="/make_meet/request/<?=$this->add_or_edit()?>"
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
</form>