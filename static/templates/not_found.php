<div 
  style="
    display: flex;
    margin: auto;
    justify-content: center;
    flex-direction: column;
    align-items:center
  "
>
  <i 
    style="
      color: green;
      margin-bottom:20px
    " 
    class="
      fa 
      fa-frown-o
      fa-5x 
      fa-fw
    " 
    aria-hidden="true"
  ></i>
  <h1 class="page_title">
    <i class="fa fa-chain-broken" aria-hidden="true"></i>
    Page Not Found
    <i class="fa fa-chain-broken" aria-hidden="true"></i>
  </h1>
  <?php
    foreach (\Nefuzz\Models\User::get_all_usernames() as $username) {
      $location = \Nefuzz\Models\User::get_location_obj($username);
      $location->gen_coords();
      var_dump($location);
    }
  ?>
</div>