<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
     <!-- Styles -->
    <link href="{{ asset('fontend/styles/bootstrap.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('fontend/styles/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontend/styles/owl.theme.default.min.css') }}">
    <link href="{{ asset('fontend/styles/css.css') }}" rel="stylesheet">
    <!-- Fonts -->
  <script type="text/javascript" src='https://maps.google.com/maps/api/js?libraries=places&key=AIzaSyDnjQOYC8PVe5a3eqhdmoA9Wtv0Ow2miN4'></script>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">></script>
      <script src="{{ asset('js/sweetalert2.min.js') }}"></script> 
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script> 
  <link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert2.min.css') }}">
  
  <link rel="stylesheet" href="{{ asset('css/tooltip.css') }}">
  


   
</head>
<body id="page-top" class="">
  <div class="sidebar-left">
    <div class="p-5">
      <div class="form-group d-none">
        <label>content</label>
        <input type="text" placeholder="" name="" value="" class="form-control" autocomplete="off" />
      </div>
      <div class="locateme-outer">
        <input type="text" placeholder="Location" name="location" value="" class="searchinput form-control" autocomplete="off" />
        <div class="locateme">
          <span onclick="getLocation()" class="locationloader">
          <i class="fas fa-spinner fa-spin"></i> <i class="fas fa-location-arrow"></i> Locate Me</span><br/>
          <input type="hidden" id="latitude" name="lat">
          <input type="hidden" id="longitude" name="lon">
        </div>
        <span class="bg-info text-white  invalid-feedback" id="msg"></span>
      </div>
      <div class="iframe mt-4">
        <div class="embed-responsive embed-responsive-16by9">
        </div>
      </div>
    </div>
  </div>
  <div class="overlay-sidebar"></div>
   

  <!-- navigation start here dark -->
    <nav class="navbar navbar-expand-lg {{Route::current()->getName()=='welcome' || Route::current()->getName() =='signup' || Route::current()->getName() =='signin'?'navbar-dark bg-dark':'navbar-white bg-white'}}" id="mainNav">
      <div class="container">
         @if(Route::current()->getName() =='welcome' || Route::current()->getName() =='signup' || Route::current()->getName() =='signin')
            <a class="navbar-brand js-scroll-trigger" href="{{url('/')}}">
            <img src="{{ asset('fontend/images/logo.png') }}" class="img-fluid" /></a>
          @else
            <a class="navbar-brand js-scroll-trigger" href="{{url('/')}}">
            <img src="{{ asset('fontend/images/logo-icon.png') }}" width="40" class="img-fluid" /></a>
             
            <a href="#" class="locationheader" id="sidebartoggle">
              <u><strong id="shortname"></strong></u>
              <span id="address"></span>
              <i class="fas fa-angle-down"></i>
            </a>
              @endif
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
             <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="{{route('welcome')}}">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" onclick="getLocation('trainer')" href="#">Trainer</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" onclick="getLocation('store')" href="#">Store</a>
            </li>
             @if (Auth::guest())
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="{{route('signin')}}">Login</a>
            </li>
            <li class="nav-item">
             <a href="{{route('signup')}}">
              <button class="btn btn-primary my-2 my-sm-0" type="submit">Sign up</button></a>
            </li>
            @endif
             <li class="nav-item dropdown dropdown-slide dropdown-hover">
            <a class="nav-link js-scroll-trigger nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#download" style="font-size:20px">
              <div class="cart-outer">
              <i class="fa" style="font-size:24px">&#xf07a;</i>
              <span class='badge badge-warning' id='lblCartCount'> 
                 @if(session('cart'))
                 {{count(session('cart'))}}
                 @else
                 0
                 @endif
              </span>
            </div>
            </a>
            <?php $total = 0 ?>
            @if( session('cart') && count(session('cart')) > 0)

            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                 @foreach(session('cart') as $item)   
                 <?php $total += $item['price'] * $item['quantity'] ?>
                <div class="cart-item">
                    <!-- Item image -->
                    <div class="cart-image ">
                      <a href="">
                        <img src="{{ asset('package/'.$item['photo']) }}" width="60px" >
                      </a>
                    </div>
                    <!-- Item info : product name, quantity, price -->
                    <div class="cart-info">
                      <div class="cart-title">
                        <a href="{{ url('/mygym/packages/'.$item['pack_id']) }}" title="">
                         {{$item['name']}}
                        </a>
                      </div>
                    </div>
                    <!-- Update item quantity -->
                    <div class="cart-meta">
                      <div class="cart-infoprice">
                        <span><span>{{$item['quantity']}}</span> x </span>
                        <b>{{$item['price']}}</b> 
                      </div>
                    </div>
                    <!-- Delete item -->
                    <div class="cart-delete-item remove-from-cart" data-id="{{ $item['pack_id'] }}">
                      <a href="/" ><i class="fas fa-trash-alt"></i></a>
                    </div>
                </div>
                @endforeach
                
                
                <div class="pb-3 text-right border-bottom mb-4">
                  <div class="item_total">Total: <strong class="orange">{{$total}} INR</strong></div>
                </div>
                <div class="justify-content-between d-flex">
                <button type="button" class="btn btn-secondary remove-all-cart">Clear Cart</button>
                <a  href="{{route('checkout')}}">
                  <button type="button" class="btn btn-primary ">Checkout</button></a>          
                </div>
          </div>
          @endif

        </li>
        @if (Auth::check() && $user = Auth::user())
          <?php $nutritions=PackagetoPrice::getUserNotifications();
                $workouts=PackagetoPrice::getUserWorkouts();
                $total_notify=count($nutritions) + count($workouts); ?>
          
          <li class="nav-item dropdown dropdown-slide dropdown-hover">
            <a href="#notificaiton" class="nav-link js-scroll-trigger nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 21px;">
              <div class="cart-outer">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning lblCartCount" style="margin-left: -15px">{{$total_notify}}</span>
              </div>
            </a>
            <div id="notificaiton" class="dropdown-menu show">
              @if(count($nutritions)>0)
              @foreach($nutritions as $nutrition )
                <?php $start_date= strtotime($startDate=$nutrition->start_date);
                $end_date= strtotime($startDate=$nutrition->end_date);

                 ?>
                 
                <div class="media border-bottom mb-2">

                   <?php $gym_imagess = explode('|', $nutrition->sellerDetail->gym_images); ?>
                  @foreach($gym_imagess as $index=>$image)
                    @if($index==0)
                    <img class="mr-3 rounded-circle" style="width:60px;" src="{{ asset('/gyms') }}/{{$image}}"  alt="{{$nutrition->sellerDetail->gym_name}}"/>
                    @endif
                  @endforeach
                  
                  <div class="media-body" style="text-transform: none;">
                    <a href="{{route('notification')}}">
                    <p class="small"><strong>{{ucfirst($nutrition->sellerDetail->gym_name)}} assign 
                      Nutrition<br/>
                      <small>From: <b>{{date("F jS, Y",$start_date)}} To {{date("F jS, Y",$end_date)}}</b></small><br/>
                    </strong>
                    </p></a>
                  </div>
                </div>
              
              @endforeach
              @endif
              @if(count($workouts)>0)
              @foreach($workouts as $workout )
                <?php $start_date= strtotime($startDate=$workout->start_date);
                $end_date= strtotime($startDate=$workout->end_date);

                 ?>
                 
                <div class="media border-bottom mb-2">

                   <?php $gym_imagess = explode('|', $workout->sellerDetail->gym_images); ?>
                  @foreach($gym_imagess as $index=>$image)
                    @if($index==0)
                    <img class="mr-3 rounded-circle" style="width:60px;" src="{{ asset('/gyms') }}/{{$image}}"  alt="{{$workout->sellerDetail->gym_name}}"/>
                    @endif
                  @endforeach
                  
                  <div class="media-body" style="text-transform: none;">
                    <a href="{{route('notification')}}">
                    <p class="small"><strong>{{ucfirst($workout->sellerDetail->gym_name)}} assign Workout<br/>
                      <small>From: <b>{{date("F jS, Y",$start_date)}} To {{date("F jS, Y",$end_date)}}</b></small><br/>
                    </strong>
                    </p></a>
                  </div>
                </div>
              
              @endforeach
              @endif
            </div>
          </li>
         
              <li class="nav-item dropdown dropdown-slide dropdown-hover profile-dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#download">
                    <img id="profile_pic" src="{{asset('/images/user/'.$user->image)}}" class="rounded-circle" width="40px" alt="User-Profile-Image">
                    <span>{{$user->name}}</span>
                    <i class="feather icon-chevron-down"></i>
                  </a>
                  <div class="dropdown-menu">
                      <ul>

                          <a class="dropdown-item" href="{{url('/profile')}}">Profile</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="{{route('changepassword')}}">Change Password</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="{{route('notification')}}">Notifications</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="{{url('/profile/order')}}">My Orders</a>
                          <div class="dropdown-divider"></div>

                          <a class="dropdown-item" href="{{ url('/logout') }}">Sign Out</a>

                      </ul>

                  </div>



              </li>
              @endif

          </ul>
        </div>
      </div>
    </nav>

        <main>
            @yield('content')
        </main>
   <div class="modal fade" id="myModal">
          <div class="modal-dialog">
              <div class="modal-content">

                  <!-- Modal Header -->
                  <div class="modal-header">
                      <h4 class="modal-title">Gym Video</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>

                  <!-- Modal body -->
                  <div class="modal-body">
                      <div class="embed-responsive embed-responsive-16by9">
                          <iframe class="embed-responsive-item" width="560" height="315" src="https://www.youtube.com/embed/5Am0MxS-5GU" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                      </div>
                  </div>

                  <!-- Modal footer -->
                  <div class="modal-footer">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                  </div>

              </div>
          </div>
      </div>

    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

  {{--<script src="{{ asset('js/tooltip.js') }}"></script>--}}


    <script type="text/javascript">


        $('.cus-tooltip').tooltip();
        /*$('.cus-tooltip').tooltip({
            trigger: 'click',
            placement: 'bottom'
        });*/

       var map;
        
        
      $(document).ready(function(){
        $("#sidebartoggle").click(function(){
          $("body").addClass("sidebar_active")
        })
         $(".overlay-sidebar").click(function(){
          $("body").removeClass("sidebar_active")
        })

      });
  

    
       $(".remove-from-cart").click(function (e) {
            e.preventDefault();
 
            var ele = $(this);
            
            Swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Remove It!'
                  }).then((result) => {
                    if (result.value) {
                      $.ajax({
                            url: '{{ url('remove-from-cart') }}',
                            method: "DELETE",
                            data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                            success: function (response) {
                               Swal(
                                  'Removed!',
                                  'Your item has been removed from cart.',
                                  'success'
                                )

                                window.location.reload();
                            }
                        });
                    }
                  })




           
        });

        $(".remove-all-cart").click(function (e) {
            e.preventDefault();
 
            var ele = $(this);
            
            Swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Remove It!'
                  }).then((result) => {
                    if (result.value) {
                      $.ajax({
                            url: '{{ url('remove-all-cart') }}',
                            method: "DELETE",
                            data: {_token: '{{ csrf_token() }}'},
                            success: function (response) {
                                window.location.reload();
                                 Swal(
                                  'Removed!',
                                  'All item has been removed from cart !!!',
                                  'success'
                                )
                            }
                      });
                    }
                  })




            
        });




  function getCookie(cname) {
  var name = cname + "=";
  var ca = document.cookie.split(';');
  for(var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}
checkCookie() 
function checkCookie() {
  var shortname = getCookie("shortname");
   var caddress = getCookie("caddress");
 // console.log(shortname);
  if (shortname != "") {
   // alert("Welcome again " + shortname);
    $("#shortname").html(shortname);
   
  } 
  if(caddress !="")
  {
     $("#address").html(caddress);
  }
}


    </script>

      <script type="text/javascript">

    $('#location').on('change', function() {
       window.setTimeout(function(){

      getGym();


       }, 100);
      //alert($('#location').val);
  //alert( this.value );
});


    $("#lat_long").hide();
    google.maps.event.addDomListener(window, 'load', function () {
        var places = new google.maps.places.Autocomplete(document.getElementById('location'));
        //console.log(places);
        google.maps.event.addListener(places, 'place_changed', function () {

        });
    });

function getLocation(gym_Cat) {
  console.log(gym_Cat);
    $("#category_type").val(gym_Cat);
    $(".searchbtn").toggleClass('loader')
    var x = document.getElementById("lat_long");
  if (navigator.geolocation) {
    //console.log("asdfasd");
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
     $(".searchbtn").toggleClass('loader')
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
  
    var x = document.getElementById("lat_long");
    //console.log(position.coords.latitude);
  //x.innerHTML = "Latitude: " + position.coords.latitude + 
 // "<br>Longitude: " + position.coords.longitude; 

  if(position.coords.latitude !='' && position.coords.longitude !='')
  {
    var latitude=position.coords.latitude;
    var longitude=position.coords.longitude;
    console.log(position.coords);
    var google_map_position = new google.maps.LatLng( latitude, longitude );
    var google_maps_geocoder = new google.maps.Geocoder();
    google_maps_geocoder.geocode(
        { 'latLng': google_map_position },
        function( results, status ) {
          //console.log();
            if ( status == google.maps.GeocoderStatus.OK && results[0] ) {
              var short_name=results[0].address_components[1].short_name;
              var address=results[0].formatted_address;
               // console.log( results[0].formatted_address );
              setCookie('shortname', short_name, 180);
              setCookie('caddress', address, 180);
              setCookie('clatitude', latitude, 180);
              setCookie('clongitude', longitude, 180);
              var gym_cat=$("#category_type").val();
              console.log(gym_cat);
              if(gym_cat=='gym')
              {
                  getMyNearGym(latitude,longitude);
              }
              if(gym_cat=='trainer')
              {
                  getMyNearTrainer(latitude,longitude);
              }
              if(gym_cat=='store')
              {
                  getMyNearStores(latitude,longitude);
              }
        }
    });
   // alert(position.coords);
   
  }
  else
  {
    $("#lat_long").show();
     x.innerHTML ="We are unable to find gym near you. we will come soon at your area."
  }
}
function getMyNearGym(latitude,longitude)
{
  var x = document.getElementById("lat_long");
  $.ajax({
    type: 'POST',
    url: "{{url('findGymNearByYouLocateMe')}}",
    data: { lat:latitude,lon:longitude,_token:"{{csrf_token()}}" },
    success:  function(response)
    {
          console.log(response);
          if(response.status=='1')
          {
             window.location.href = response.url+'/0';
          }
          else
          {
            $("#lat_long").show();
            x.innerHTML = response.message;
             $(".searchbtn").toggleClass('loader')
          }

    }
  });
}
function getMyNearTrainer(latitude,longitude)
{
  var x = document.getElementById("lat_long");
  $.ajax({
    type: 'POST',
    url: "{{url('findTrainerNearByMyLocation')}}",
    data: { lat:latitude,lon:longitude,_token:"{{csrf_token()}}" },
    success:  function(response)
    {
          console.log(response);
          if(response.status=='1')
          {
             window.location.href = response.url+'/0';
          }
          else
          {
            $("#lat_long").show();
            x.innerHTML = response.message;
             $(".searchbtn").toggleClass('loader')
          }

    }
  });
}
function getMyNearStores(latitude,longitude)
{
  var x = document.getElementById("lat_long");
  $.ajax({
    type: 'POST',
    url: "{{url('find-available-Stores')}}",
    data: { lat:latitude,lon:longitude,_token:"{{csrf_token()}}" },
    success:  function(response)
    {
          console.log(response);
          if(response.status=='1')
          {
             window.location.href = response.url+'/0';
          }
          else
          {
            $("#lat_long").show();
            x.innerHTML = response.message;
             $(".searchbtn").toggleClass('loader')
          }

    }
  });
}
function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  var expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
function getGym()
{
   var x = document.getElementById("lat_long");
    var location_address = $("#location").val();
    //alert(location_address);
    console.log(location_address);
      setCookie('shortname', location_address, 180);
     // setCookie('caddress', location_address, 180);
    $.ajax({
              type: 'POST',
              url: "{{url('findGymNearByYou')}}",
              data: { address:location_address,_token:"{{csrf_token()}}" },
              success:  function(response)
              {
                    console.log(response);
                    if(response.status=='1')
                    {
                       window.location.href = response.url+'/0';
                    }
                    else
                    {
                      $("#lat_long").show();
                      x.innerHTML = response.message;
                    }

              }
            });
}
     
</script>

</body>
</html>
