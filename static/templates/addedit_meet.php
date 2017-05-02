<div class="row center">
  <h1 class="page_title">Add/Edit Meet</h1>
</div>
<form 
  class="main"
  id="addedit_meet-form"
  method="POST"
  action="/controllers/addedit_meet.php?action=<?=$this->add_or_edit()?>"
>
  <?=new Block([
    "title" => "Meet Info",
    "content" => new Names_AddEdit_Meet_View()
  ]);?>
  <?=new Block([
    "title" => "Upload an Icon",
    "template" => "registration/upload_icon",
    "is_expandable" => true,
    "starts_closed" => true
  ]);?>
  <?=new Block([
    "title" => "Default Event Info",
    "content" => new Basic_Event_Details_View()
  ]);?>
  <?=new Block([
    "title" => "Default Event Address",
    "content" => new Event_Address_View()
  ]);?>
  <?=new Block([
    "title" => "Alternative Host Info",
    "content" => new Alternate_Event_Host_View(),
    "is_expandable" => true,
    "starts_closed" => true
  ]);?>
  <?=new Block([
    "title" => "RRule (Advanced)",
    "content" => new RRule_View(),
    "is_expandable" => true,
    "starts_closed" => true
  ]);?>
</form>