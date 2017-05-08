<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?=\Nefuzz\Php\Auth::google_maps_key?>&callback=initMap">
</script>

<script>
function generateMapData(users_and_locations, callback) {
  var locations = [];
  var number_complete = 0;
  var total = users_and_locations.length;
  users_and_locations.forEach(function(user) {
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode( {  address: user.location}, function(results, status) {
      number_complete++;
      if ((status == 'OK')) {
        var location_coord = results[0].geometry.location;
        var location_latlog = results[0].geometry.location.lat() + " " +results[0].geometry.location.lng();
        var found_id = 0;
        var exists = locations.find(function(location, index) {
          found_id = index;
          return location.latlog === location_latlog;
        });
        if (exists) {
          locations[found_id].users.push(user.username);
        } else {
          locations.push({
            latlog: results[0].geometry.location.lat() + " " +results[0].geometry.location.lng(),
            name: user.location,
            coord: location_coord,
            users: [user.username]
          });
        }
      } else {
        console.log('Geocode was not successful for the following reason: ' + status);
      }
      if (number_complete == total) {
        if (typeof callback == 'function') {
          callback(locations);
        }
      }
    });
  });
}

function initMap() {
  var map = new google.maps.Map(document.getElementById('everyone_map'), {
    zoom: 7,
    center: {lat: 42.9956, lng: -71.4548}, 
    mapTypeId: 'roadmap'
  });
  generateMapData(<?=json_encode($this->users_and_locations);?>, function(locations) {
    locations.forEach(function(location) {
      var cityCircle = new google.maps.Circle({
        strokeColor: 'green',
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: 'lightgreen',
        fillOpacity: 0.35,
        map: map,
        center: {lat: location.coord.lat(), lng: location.coord.lng()},
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
  });
}
</script>