<?php
require_once($_SERVER['DOCUMENT_ROOT']."/components/common.php");
require_once($_SERVER['DOCUMENT_ROOT']."/components/user.php");
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
        <img class="large_icon round" src="<?=user_icon($_GET['username'] ?? "");?>" />
      </div>
      <h1 class="shadow_title">~<?=user_name($_GET['username'] ?? "");?>~</h1>
    </div>
    <?=user_info_grid_block($_GET['username'] ?? "");?>
  </div>
  <div class="row grid center mobile_column">
    <?=contact_info_grid_block($_GET['username'] ?? "");?>
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