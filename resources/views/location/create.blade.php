@extends ('layouts.admin')
@section ('contenido')
    <style type="text/css">
        #map-canvas {
          width: 350px;
         height: 250px;
        }
    </style>
    <div>
    <form action="{{asset('location/store')}}" method="POST">
      {{Form::token()}}
      <div class="form-group">
      <div>
        <label for="nombre">Name</label>
        <input type="text" class="form-control" id="nombre" name="nombre"
        placeholder="Enter the name of the location" required autocomplete="off">     
      </div>

      <div>
        <label>Map</label>
        <input type="text" name="map" id="searchmap" class="form-control">
        <div id="map-canvas"></div>
      </div>

      <div>
        <input type="text" name="lat" id="lat" class="form-control hidden" readonly>
      </div>
      <div>
        <input type="text" name="lng" id="lng" class="form-control hidden" readonly>
      </div>    

      <button type="submit" class="btn btn-default">Save</button>
    </form>
  </div>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAMj_VfarmBKwf6CDbOGLxknLm23prAL6g&libraries=places" type="text/javascript"></script>
 
    <script type="text/javascript">
    //setea las coordenadas por defecto del mapa
    var myLatlng = new google.maps.LatLng(9.232249097344258,-66.62109362499996);
    var mapOptions = {
        zoom: 4,
        center: myLatlng
    };
    //determina el id del elemento que presenta el mapa
    var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
    //Genera el marcador arrastrable
    var marker = new google.maps.Marker({
        position: myLatlng,
        draggable: true,
       
    });
    // To add the marker to the map, call setMap();
    marker.setMap(map);
    //Genera el buscador en el mapa.
    var searchBox = new google.maps.places.SearchBox(document.getElementById("searchmap"));
    google.maps.event.addListener(searchBox,'places_changed',function(){
      var places= searchBox.getPlaces();
      var bounds= new google.maps.LatLngBounds();
      var i, place;
      for (i = 0; place = places[i]; i++) {
         bounds.extend(place.geometry.location);
         marker.setPosition(place.geometry.location);
      }
      map.fitBounds(bounds);
      map.setZoom(15); 
    })
    google.maps.event.addListener(marker,'position_changed',function(){
      var lat=marker.getPosition().lat(); 
      var lng=marker.getPosition().lng();
      document.getElementById("lat").value = lat;
      document.getElementById("lng").value = lng;
    })
    </script>

@endsection