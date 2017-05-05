<div class="center_column">
  <form method="POST" action="controllers/login_logout.php?action=login" id="login-form">
    <div class="row center">
      <?=new \Nefuzz\Components\Text_Input([
        "id" => "login-username",
        "label" => "Username",
        "name" => "username",
        "max_characters" => 20,
        "size" => "full",
        "is_required" =>  true
      ]);?>
    </div>
    <div class="row center">
      <?=new \Nefuzz\Components\Text_Input([
        "id" => "login-password",
        "label" => "Password",
        "name" => "password",
        "max_characters" => 20,
        "size" => "full",
        "is_required" =>  true,
        "is_password" => true
      ]);?>
    </div>
    <div class="center">
      <?=new \Nefuzz\Components\Button([
        "label" => "Login",
        "is_submit" => true,
        "extra_classes" => "right"
      ]);?>
      <?=new \Nefuzz\Components\Button([
        "label" => "Register",
        "link" => "/registration",
        "extra_classes" => "right"
      ]);?>
    </div>
  </form>
</div>