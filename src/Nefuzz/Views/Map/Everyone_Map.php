<?php

namespace Nefuzz\Views\Map;

class Everyone_Map extends  \Nefuzz\Views\Base_View {
  
  public $users_and_locations = [];
  
  protected function template() {
    return 'map/everyone_map';
  }
  
  protected function js() {
    return ['map/everyone_map'];
  }
  
  public function users_by_city() {
    $users_by_city = [];
    for (
      $i = 0;
      $i < count($this->users_and_locations);
      $i++
    ) {
      try {
        if ($coordinates = $this->users_and_locations[$i]["location"]->get_coords()) {
          $key = $coordinates['lat'] . $coordinates['lng'];
          if (isset($users_by_city[$key])) {
            array_push($users_by_city[$key]['users'], $this->users_and_locations[$i]["username"]);
          } else {
            $users_by_city[$key] = [
              "coords" => $coordinates,
              "users" => [$this->users_and_locations[$i]["username"]]
            ];
          }
        }
      } catch (Exception $e){
        if ($e->getMessage() === "OVER_QUERY_LIMIT") {
          sleep(0.2);
          $i--;
        }
      }
    }
    return array_values($users_by_city);
  }
}