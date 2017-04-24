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
        <img class="large_icon round" src="<?=user_page_icon($_GET['username'] ?? "");?>" />
      </div>
      <h1 class="shadow_title">~<?=user_page_name($_GET['username'] ?? "");?>~</h1>
    </div>
    <?=user_info_grid_block($_GET['username'] ?? "");?>
  </div>
  <div class="row grid center mobile_column">
    <div class="grid_column w_normal">
      <?=location_grid_item($_GET['username']);?>
      <div class="grid_block h_mini w_full">
        <div id="user_meets_attended">
          <div class="number">
            <p>33</p>
          </div>
          <div class="title">
            Meets Attended
          </div>
        </div>
      </div>
      <div class="grid_block h_mini w_full">
        <div id="user_meets_hosted">
          <div class="title">
            Meets Hosted
          </div>
          <div class="number">
            <p>10</p>
          </div>
        </div>
      </div>
      <div class="grid_block h_mini w_full">
        <div id="user_member_groups">
          <div class="number">
            <p>444</p>
          </div>
          <div class="title">
            Groups I'm In
          </div>
        </div>
      </div>
    </div>
    <?=contact_info_grid_block($_GET['username'] ?? "");?>
  </div>
  <div class="row grid center mobile_column">
    <div class="grid_block h_normal w_medium">
      em_info (personal)
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