@extends('layouts.sellers-app')
@section('content')

<style>




</style>
<div class="auth register-bg-1 js">
    <div class="container pt-5 pb-5">
        <div class="row align-items-center">
            <div class="col-md-6">
               <h1 class="white">Sign up for lightning fast delivery to your customers</h1>
            </div>
           
           <div class="col-md-6">
             @if($errors->all())
                @foreach ($errors->all() as $index=>$error)
                    @if($index==0)
                  <div class="alert alert-danger">One or more fields have an error. Please check and try again.</div>
                   @endif
                @endforeach
               @endif
              @if(session('error')) 
              <div class="error alert alert-danger alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Error : </strong>   {{ session('error') }}
              </div>
              @endif
              @if(session('success')) 
              <div class="error alert alert-success alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              {!! session('success') !!}
              </div>
              @endif



                 <form method="POST" action="{{ route('registerasseller') }}" enctype="multipart/form-data">
               @csrf     
                    <div class="banner-form p-4">
                        <h3 class="border-0">Partner with us</h3>
                        <div class="form-group">
                            <input name="gym_name" class="form-control form-control-sm" type="text" 
                            placeholder="Gym Name*" value="{{ old('gym_name') }}" autocomplete="off">
                            @if ($errors->has('gym_name'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('gym_name') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6">
                                <input name="gym_address" class="form-control form-control-sm" type="text" placeholder="Address*"  value="{{ old('gym_address') }}" autocomplete="off">
                                @if ($errors->has('gym_address'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('gym_address') }}</strong>
                                </span>
                                @endif
                            </div>
                            
                            <div class="col-md-6">
                                <input name="zip" class="form-control form-control-sm" type="number" placeholder="ZIP (Primary Location)*" value="{{ old('zip') }}" autocomplete="off">
                                @if ($errors->has('zip'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('zip') }}</strong>
                                </span>
                                @endif
                            </div>
                            
                        </div>

                      <div class="row form-group">
                            <div class="col-md-6">
                               
                                <select name="city"  class="form-control form-control-sm">
                                    <option value="" selected disabled>City*</option>
                                    @foreach($cities as $city)
                                     <option value="{{$city->name}}">{{$city->name}}</option>
                                     @endforeach
                                </select>
                                @if ($errors->has('city'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('city') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <input  class="form-control form-control-sm" type="number" placeholder="Contact Number*"  name="phone_no" value="{{ old('phone_no') }}" autocomplete="off">
                                 @if ($errors->has('phone_no'))
                                  <span class="invalid-feedback">
                                      <strong>{{ $errors->first('phone_no') }}</strong>
                                  </span>
                                 @endif
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6">
                                <input  class="form-control form-control-sm" name="email" value="{{ old('email') }}" autocomplete="off" type="email" placeholder="E-Mail Address*">
                                 @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                  <strong>{{ $errors->first('email') }}</strong>
                                </span>
                              @endif
                            </div>
                            <div class="col-md-6">
                                <input class="form-control form-control-sm" name="name" value="{{ old('name') }}" autocomplete="off" type="text" placeholder="Owner Full Name*">
                                 @if ($errors->has('name'))
                                <span class="invalid-feedback">
                                  <strong>{{ $errors->first('name') }}</strong>
                                </span>
                              @endif
                            </div>
                        </div>
                       
                            <label class="small seemore form-group" id="hideshow">
                                <i  class="fas fa-plus"></i> See more fields
                            </label>
                        <div class="extra-seller-info">

                            <div class="form-group">
                               <input  class="form-control form-control-sm" value="{{ old('gym_description') }}" name="gym_description" placeholder="Gym Description" autocomplete="off">
                                @if ($errors->has('gym_description'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('gym_description') }}</strong>
                                </span>
                              @endif
                            </div>
                        <div class="form-group">
                                <div class="row">
                                <div class="col-md-6">
                                <input name="website_link" value="{{ old('website_link') }}" autocomplete="off" class="form-control form-control-sm" type="text" placeholder="Website Link/online listing link">
                                @if ($errors->has('website_link'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('website_link') }}</strong>
                                </span>
                                @endif
                                 </div>
                                 <div class="col-md-6">
                                 <select name="category[]" id="category"  class="form-control form-control-sm" multiple data-live-search="true">
                                    <!-- <option value="" selected disabled>Category*</option> -->
                                    @foreach($categories as $category)
                                     <option value="{{$category->id}}" >{{$category->name}}</option>
                                     @endforeach
                                </select>
                                @if ($errors->has('category'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('category') }}</strong>
                                </span>
                                @endif
                                </div>
                            </div>
                            </div>
                        <script type="text/javascript">
                            $(document).ready(function() {
                                  $('#category').selectpicker();
                                });
                        </script>
                        <div class="form-group">
                            <label>Documents(PDF,jpeg,png,jpg)</label>
                            <div class="row">
                                <div class="col-md-6">
                                    <input  class="form-control form-control-sm inputfile inputfile-2" id="file-1" type="file" placeholder="Gym Licence" name="gym_licence" value="{{ old('gym_licence') }}" autocomplete="off">
                                    <label for="file-1"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Gym Licence&hellip;</span></label>
                                    @if ($errors->has('gym_licence'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('gym_licence') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <input  class="form-control form-control-sm inputfile inputfile-2" id="file-2" type="file" placeholder="GSTIN/PAN" name="gym_pan" value="{{ old('gym_pan') }}" autocomplete="off">
                                    <label for="file-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>GSTIN/PAN&hellip;</span></label>
                                    @if ($errors->has('gym_pan'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('gym_pan') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                         <div class="form-group">
                            <label>Gym Pictures (jpeg,png,jpg)</label>
                            <div class="row">
                                <div class="col-md-6">
                                <input class="form-control form-control-sm inputfile inputfile-2" type="file" id="file-3" placeholder="Images" name="gym_images" value="{{ old('gym_images') }}" autocomplete="off">
                                    <label for="file-3"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Gym Image&hellip;</span></label>
                                @if ($errors->has('gym_images'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('gym_images') }}</strong>
                                </span>
                                @endif
                                </div>  
                                    <div class="col-md-6 locateme-outer">
                                    
                                    <input type="text" placeholder="Location" name="location" value="{{ old('gym_images') }}" class="searchinput form-control" autocomplete="off">
                                        <div class="locateme">
                                      <span onclick="getLocation()" class="locationloader"><i class="fas fa-spinner fa-spin"></i> <i class="fas fa-location-arrow"></i> Locate Me</span><br/>
                                       
                                      <input type="hidden" id="latitude" name="lat">
                                      <input type="hidden" id="longitude" name="lon">
                                    </div>
                                    <span class="bg-info text-white  invalid-feedback" id="msg"></span>
                                    </div>
                               
                            </div>

                        </div>
                        <div class="form-group iframe" id="show-map">
                          
                        </div>
                       
                      
                    </div>
                     <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>
                </form>



            </div>
            </div>
        </div>
    </div>

<br/>
<br/>
<br/>
<div class="container">
    <div class="text-center">
        <h3>Get Listed on INDIA'S Leading online Gym Marketplace Today</h3>
    </div>
    <br/>
    <br/>
    <br/>
    <div class="row steps">
        <div class="col-md-3">
            <img src="{{url('/images/p1.png')}}">

        </div>
        <div class="col-md-3">
            <img src="{{url('/images/p2.png')}}">
        </div>
        <div class="col-md-3">
            <img src="{{url('/images/p3.png')}}">
        </div>
        <div class="col-md-3">
            <img src="{{url('/images/p4.png')}}">
        </div>
        <div class="col-md-12 text-center mt-5">
            <button type="button" class="btn btn-primary">Register Now</button>
        </div>
    </div>
            <br/>
        <br/>
        <br/>
        
</div>
<div class="keybenefits">
    <br/>
    <br/>
    <br/>
            <div class="container">
                <div class="text-center">
                    <h3 class="white text-uppercase">Key benefits</h3>
                    <br/>
                    <br/>
                    <br/>
                <img src="{{url('/images/benefit1-1.png')}}" class="img-fluid">
            </div>
            </div>

    <br/>
    <br/>
    <br/>
        </div>

        <br/>
        <br/>
        <br/>
        <div class="success">
            <div class="container">
                <div class="text-center mb-5">
                    <h3>OUR SUCCESS IS YOUR SUCCESS</h3>
                </div>
                <div class="row">
                    <div class="col-md-4 text-center">
                        <img src="{{url('/images/1customers.png')}}">
                        <h4 class="mt-4">Million customers on Near Gym and growing</h4>
                    </div>
                    <div class="col-md-4 text-center">
                        <img src="{{url('/images/2locations.png')}}">
                        <h4 class="mt-4">Presence across 30+ cities and expanding</h4>
                    </div>
                  <div class="col-md-4 text-center">
                        <img src="{{url('/images/3restaurants.png')}}">
                        <h4 class="mt-4">40K+ Gyms on Near Gym and increasing</h4>
                    </div>
                </div>
            </div>
        </div>
        <br/>
        <br/>
        <br/>
        <div class="success-stories">
        <div class="container">
            <div id="demo" class="carousel slide" data-ride="carousel"> 
  <!-- The slideshow -->
  <div class="carousel-inner">
    <div class="carousel-item active">
        <div class="row justify-content-center">

  <div class="col-md-9 text-center" >
      <h4><i>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores.</i></h4>
      <br/>
      <img src="{{url('/images/img.jpeg')}}" class="rounded-circle" alt="Los Angeles">
  </div>
 <br/>
      <br/>
      

  </div>
    </div>
        <div class="carousel-item">
        <div class="row justify-content-center">

  <div class="col-md-9 text-center" >
      <h4><i>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores.</i></h4>
      <br/>
      <img src="{{url('/images/img.jpeg')}}" class="rounded-circle" alt="Los Angeles">
  </div>
 <br/>
      <br/>
      

  </div>
    </div>
        <div class="carousel-item">
        <div class="row justify-content-center">

  <div class="col-md-9 text-center" >
      <h4><i>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores.</i></h4>
      <br/>
      <img src="{{url('/images/img.jpeg')}}" class="rounded-circle" alt="Los Angeles">
  </div>
 <br/>
      <br/>
      

  </div>
    </div>
  </div>
  
  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>
        </div>
        </div>

<footer>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <h6>COMPANY</h6>
                <ul class="p-0">
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Team</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Blog</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h6>CONTACT</h6>
                <ul class="p-0">
                    <li>987654320 | 9876543232</li>
                    <li><a href="#">Faq</a></li>
                    <li><a href="#">Help & Support</a></li>
                    <li><a href="#">Partner with us</a></li>
                </ul>
            </div>
        </div>
        <div class="Copyright text-center d-flex justify-content-center">
        <div class="col-md-9">
            <ul class="list-inline">
              @foreach($cities as $city)
              <li class="list-inline-item"><a href="#">{{$city->name}}</a></li>
              @endforeach
                
             <!--    <li class="list-inline-item"><a href="#">Ahmedabad</a></li>
                <li class="list-inline-item"><a href="#">Allahabad</a></li>
                <li class="list-inline-item"><a href="#">Amritsar</a></li>
                <li class="list-inline-item"><a href="#">Aurangabad</a></li>
                <li class="list-inline-item"><a href="#">Bangalore</a></li>
                <li class="list-inline-item"><a href="#">Bareilly</a></li>
                <li class="list-inline-item"><a href="#">Bhopal</a></li>
                <li class="list-inline-item"><a href="#">Bhubaneswar</a></li>
                <li class="list-inline-item"><a href="#">Chandigarh</a></li>
                <li class="list-inline-item"><a href="#">Agra</a></li>
                <li class="list-inline-item"><a href="#">Ahmedabad</a></li>
                <li class="list-inline-item"><a href="#">Allahabad</a></li>
                <li class="list-inline-item"><a href="#">Amritsar</a></li>
                <li class="list-inline-item"><a href="#">Aurangabad</a></li>
                <li class="list-inline-item"><a href="#">Bangalore</a></li>
                <li class="list-inline-item"><a href="#">Bareilly</a></li>
                <li class="list-inline-item"><a href="#">Bhopal</a></li>
                <li class="list-inline-item"><a href="#">Bhubaneswar</a></li>
                <li class="list-inline-item"><a href="#">Chandigarh</a></li> -->
            </ul>
        </div>
        </div>
<div class="Copyright">
                    <div class="d-flex justify-content-between row">
                        <div class="logo-image col-lg-2 col-md-3 mb-3">
                            <img src="http://localhost/gym/public/fontend/images/logo.png" class="img-fluid">
                        </div>
                        <div>
                            <p class="mb-0">© Copyright 2019 Near Gym. All Right Reserved</p>
                        </div>
                        <div>
                            <ul class="mt-0">
                                <li class="list-inline-item"><a href=""><i class="fab fa-facebook-square"></i></a></li>
                                <li class="list-inline-item"><a href=""><i class="fab fa-twitter"></i></a></li>
                                <li class="list-inline-item"><a href=""><i class="fab fa-instagram"></i></a></li>
                                <li class="list-inline-item"><a href=""><i class="fab fa-linkedin-in"></i></a></li>
                                <li class="list-inline-item"><a href=""><i class="fab fa-google-plus-g"></i></a></li>

                            </ul>
                        </div>
                    </div>

            </div>
    </div>
</footer>
<script src="{{url('js/custom-file-input.js')}}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDnjQOYC8PVe5a3eqhdmoA9Wtv0Ow2miN4&callback=initMap"
        async defer></script>
<script type="text/javascript">
        var map;
        
        function initMap(latitude,longitude) {                            
          //  var latitude = latitude; // YOUR LATITUDE VALUE
            //var longitude = 85.3239605; // YOUR LONGITUDE VALUE
            console.log(latitude+'----'+longitude);
            var myLatLng = {lat: latitude, lng: longitude};
            
            map = new google.maps.Map(document.getElementById('show-map'), {
              center: myLatLng,
              zoom: 14                    
            });
                    
            var marker = new google.maps.Marker({
              position: myLatLng,
              map: map,
              //title: 'Hello World'
              
              // setting latitude & longitude as title of the marker
              // title is shown when you hover over the marker
              title: latitude + ', ' + longitude 
            });            
        }


   function getLocation() 
  {
    $(".form-group.iframe").show();
      $(".locationloader").addClass('loader')
     // var x = document.getElementById("lat_long");
    if (navigator.geolocation) {
     
      navigator.geolocation.getCurrentPosition(showPosition);
    } else {
      //x.innerHTML = "Geolocation is not supported by this browser.";
      $('#msg').html("<b>Geolocation is not supported by this browser.</b>");
    }
     // $(".locationloader").removeClass('loader')
  }

  function showPosition(position) 
  {
    
    if(position.coords.latitude !='' && position.coords.longitude !='')
    {
      var latitude=position.coords.latitude;
      var longitude=position.coords.longitude;
      $('#latitude').val(latitude);
      $('#longitude').val(longitude);
      $(".locationloader").removeClass('loader');
      initMap(latitude,longitude);
      $('#msg').html("<b>Your current location set for this Gym.</b>");
      //$("#show-map").show();
    }
  }

     jQuery('.extra-seller-info').hide();
    
     
jQuery(document).ready(function(){
    $(".form-group.iframe").hide();
    jQuery('#hideshow').on('click', function(event) {        
    jQuery('.extra-seller-info').slideToggle('slow');
    $(this).find('i').toggleClass('fa-minus fa-plus');
});
    });
</script>
    
<style type="text/css">
    .invalid-feedback
    {
        display: block;
        font-weight: 300;
    }
    #show-map 
    { 
        height: 160px;
        width: 100%;           
    }   
</style>
@endsection