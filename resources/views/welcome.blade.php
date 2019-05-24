@extends('layouts.app')

@section('content')
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDnjQOYC8PVe5a3eqhdmoA9Wtv0Ow2miN4&libraries=places"></script> -->
<script type="text/javascript" src='https://maps.google.com/maps/api/js?libraries=places&key=AIzaSyDnjQOYC8PVe5a3eqhdmoA9Wtv0Ow2miN4'></script>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
      </script>
<div class="row w-100">
    <div class="col-lg-4 mx-auto">
        <div class="flex-center position-ref full-height">
            <div id="lat_long" class="error alert alert-danger alert-dismissable">
                   
                    </div>
              <div class="content">
                <div class="input-group">
                      <input id="location" type="email" class="form-control" name="location" id="location" autocomplete="off" tabindex="1" value="" placeholder="Enter your location" maxlength="30">

                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div><button onclick="getLocation()">Locate me</button><button onclick="getGym()">Find Gym</button>
                   
                  </div>



               
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    google.maps.event.addDomListener(window, 'load', function () {
        var places = new google.maps.places.Autocomplete(document.getElementById('location'));
        //console.log(places);
        google.maps.event.addListener(places, 'place_changed', function () {

        });
    });

function getLocation() {
    var x = document.getElementById("lat_long");
  if (navigator.geolocation) {
    //console.log("asdfasd");
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
    var x = document.getElementById("lat_long");
    console.log(position.coords.latitude);
  x.innerHTML = "Latitude: " + position.coords.latitude + 
  "<br>Longitude: " + position.coords.longitude; 
}
function getGym()
{
   var x = document.getElementById("lat_long");
    var location_address = $("#location").val();
    console.log(location_address);
    $.ajax({
              type: 'POST',
              url: "{{url('findGymNearByYou')}}",
              data: { address:location_address,_token:"{{csrf_token()}}" },
              success:  function(response)
              {
                    console.log(response);
                    if(response.status=='1')
                    {
                       window.location.href = response.url;
                    }
                    else
                    {
                      x.innerHTML = response.message;
                    }

              }
            });
}
     
</script>
   @endsection('content')
