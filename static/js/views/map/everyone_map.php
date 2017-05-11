<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?=\Nefuzz\Php\Auth::google_maps_key?>&callback=initMap">
</script>

<script>
function initMap() {
  var map = new google.maps.Map(document.getElementById('everyone_map'), {
    zoom: 7,
    center: {lat: 42.9956, lng: -71.4548}, 
    mapTypeId: 'roadmap'
  });
  var locations = <?=json_encode($this->users_by_city());?>;
  locations.forEach(function(location) {
    var cityCircle = new google.maps.Circle({
      strokeColor: 'green',
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: 'lightgreen',
      fillOpacity: 0.35,
      map: map,
      center: {lat: location.coords.lat, lng: location.coords.lng},
      radius: location.users.length * 400
    });
    var content = "";
    var cityWindow = new google.maps.InfoWindow({
      content: location.users.toString()
    });
    google.maps.event.addListener(cityCircle, 'click', function() {
      $.ajax({
        type: "POST",
        url: "/map/request/get_user_icons",
        data: {user_list: location.users},
        dataType: "json",
        success: function(data) {
          cityWindow.setContent(data);
          cityWindow.setPosition(cityCircle.getCenter());
          cityWindow.open(map, cityCircle);
        }
      });
    });
  });
}
</script>