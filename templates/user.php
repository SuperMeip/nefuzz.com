<?php
require_once("components/common.php");
?>

<div class="center_column">
  <div class="row grid center mobile_column">
    <div class="grid_column w_normal">
      <div 
        style="
          box-shadow: 2px 6px 10px darkgrey;
          width: 179px;
          height: 179px;
          border-radius: 100px;
          display:flex
        "
      >
        <img class="large_icon round" src="img/user/icon/151.png" />
      </div>
      <h1 class="shadow_title">~Meep~</h1>
    </div>
    <div class="grid_block h_large w_full">
      <div class="header">
        <h1>User Info</h1>
      </div>
      <div class="body">
        <?=new Info_Table([
          "values" => [
            "Fur Name:" => "Meep",
            "Primary Contact:" => "Telegram",
            "Species:" => "Salamander",
            "Bio:" => "TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT"
          ]
        ]);?>
      </div>
    </div>
  </div>
  <div class="row grid center mobile_column">
    <div class="grid_block h_big w_normal">
      test content
    </div>
    <div class="grid_column w_normal">
      <?=new Grid_Block([
        "title" => "tiny",
        "width" => "full",
        "height" => "small",
        "content" => "test content"
      ]);?>
      <div class="grid_block h_mini w_full">
        test content
      </div>
      <div class="grid_block h_mini w_full">
        test content
      </div>
    </div>
  </div>
  <div class="row grid center mobile_column">
    <div class="grid_block h_normal w_medium">
      test content
    </div>
    <div class="grid_block h_normal w_medium">
      test content
    </div>
    <div class="grid_block h_normal w_medium">
      test content
    </div>
  </div>
  <div class="row grid center mobile_column">
    <div class="grid_block h_small w_small">
      test content
    </div>
    <div class="grid_block h_small w_small">
      test content
    </div>
    <div class="grid_block h_small w_small">
      test content
    </div>
    <div class="grid_block h_small w_small">
      test content
    </div>
  </div>
</div>