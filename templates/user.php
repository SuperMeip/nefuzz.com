
<?=$this->redirect();?>

<div class="center_column">
  <div class="row grid center mobile_column">
    <div class="grid_column w_normal">
      <?=$this->user_icon();?>
      <h1 class="shadow_title">~<?=$this->username();?>~</h1>
    </div>
    <?=$this->user_info_grid_block();?>
  </div>
  <div class="row grid center mobile_column">
    <div class="grid_column w_normal">
      <?=$this->location_grid_item();?>
      <?=$this->meets_attended();?>
      <?=$this->meets_hosted();?>
      <?=$this->group_membership();?>
    </div>
    <?=$this->contact_info_grid_block();?>
  </div>
  <div class="row grid center mobile_column">
    <?=$this->em_info_grid_block();?>
    <div class="grid_block h_large w_medium">
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