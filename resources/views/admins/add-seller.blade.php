@extends('layouts.admin-app')

@section('content')
 <div class="container-fluid page-body-wrapper">
     @include('admins.sidebar')
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
         
          <div class="row">
            <div class="col-sm-12 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-header"><b>{{__('Add New Seller')}}</b>
                   @if($errors->all())
                   @foreach ($errors->all() as $error)
                      <div class="alert alert-danger">{{ $error }}</div>
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

                </div>

                <form method="POST" action="{{ route('addSellerByAdminPost') }}" enctype="multipart/form-data">
                 
                  @csrf
                  <div class="card-body js">
                  <div class="row">
                  <div class="form-group col-md-6">
                    <label class="label">{{ __('Gym Name') }}</label>
                    <div class="input-group">
                      <input id="gym_name" type="text" class="form-control{{ $errors->has('gym_name') ? ' is-invalid' : '' }}" name="gym_name" value="{{ old('gym_name') }}" required autofocus>
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                      </div>
                      @if ($errors->has('gym_name'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('gym_name') }}</strong>
                        </span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group col-md-6">
                    <label class="label">{{ __('Owner Full Name') }}</label>
                    <div class="input-group">
                      <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                      </div>
                      @if ($errors->has('name'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                      @endif
                    </div>
                  </div>
                </div>
                    
                <div class="row">
                  <div class="form-group col-md-6">
                    <label class="label">{{ __('E-Mail Address') }}</label>
                    <div class="input-group">
                     <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                      </div>
                      @if ($errors->has('email'))
                        <span class="invalid-feedback">
                          <strong>{{ $errors->first('email') }}</strong>
                        </span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group col-md-6">
                    <label class="label">{{ __('Contact Number') }}</label>
                    <div class="input-group">
                       <input id="phone_no" type="number" class="form-control{{ $errors->has('phone_no') ? ' is-invalid' : '' }}" name="phone_no" value="{{ old('phone_no') }}" required autofocus>
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                      </div>
                      @if ($errors->has('phone_no'))
                      <span class="invalid-feedback">
                          <strong>{{ $errors->first('phone_no') }}</strong>
                      </span>
                     @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label class="label">{{ __('Gym Description') }}</label>
                    <div class="input-group">
                       <input id="gym_description" type="text" class="form-control{{ $errors->has('gym_description') ? ' is-invalid' : '' }}" name="gym_description" value="{{ old('gym_description') }}" required autofocus>
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                      </div>
                      @if ($errors->has('gym_description'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('gym_description') }}</strong>
                        </span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group col-md-6">
                    <label class="label">{{ __('Gym Address') }}</label>
                    <div class="input-group">
                      <input id="gym_address" type="text" class="form-control{{ $errors->has('gym_address') ? ' is-invalid' : '' }}" name="gym_address" value="{{ old('gym_address') }}" required autofocus>
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                      </div>
                      @if ($errors->has('gym_address'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('gym_address') }}</strong>
                        </span>
                      @endif
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group col-md-6">
                    <label class="label">{{ __('zip code') }}</label>
                    <div class="input-group">
                      <input id="zip" type="number" class="form-control{{ $errors->has('zip') ? ' is-invalid' : '' }}" name="zip" value="{{ old('zip') }}" required autofocus>
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                      </div>
                      @if ($errors->has('zip'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('zip') }}</strong>
                        </span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group col-md-6">
                    <label class="label">{{ __('City') }}</label>
                    <div class="input-group">
                       <!-- <input id="city" type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" value="{{ old('city') }}" required autofocus> -->
                       <select name="city" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" required autofocus>
                        @foreach($cities as $city)
                         <option value="{{$city->name}}">{{$city->name}}</option>
                         @endforeach
                       </select>
                      <!-- <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                      </div> -->
                      @if ($errors->has('city'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('city') }}</strong>
                        </span>
                      @endif
                    </div>
                  </div>
                </div>
                
                <div class="row">
                    <div class="form-group col-md-6">
                      <label class="label">{{ __('Website Link') }}</label>
                      <div class="input-group">
                        <input name="website_link" value="{{ old('website_link') }}" autocomplete="off" class="form-control" type="text" placeholder="Website Link/online listing link">
                        <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                      </div>
                          @if ($errors->has('website_link'))
                          <span class="invalid-feedback">
                              <strong>{{ $errors->first('website_link') }}</strong>
                          </span>
                          @endif
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                       <label class="label">{{ __('Gym Category') }}</label>
                       <div class="input-group">
                           <select name="category[]" id="category"  class="form-control" multiple="multiple" >
                              <!-- <option value="" selected disabled>Category*</option> -->
                              @foreach($categories as $category)
                               <option value="{{$category->id}}">{{$category->name}}</option>
                               @endforeach
                          </select>
                          <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                      </div>
                          @if ($errors->has('category'))
                          <span class="invalid-feedback">
                              <strong>{{ $errors->first('category') }}</strong>
                          </span>
                          @endif
                        </div>
                    </div>
                </div>
                    


                <div class="row">
                  <div class="form-group col-md-6">
                    <label class="label">{{ __('Gym Licence') }} (* pdf,jpeg,png,jpg)</label>
                    <div class="input-group">
                    <input id="file-1" type="file" class="form-control form-control-sm inputfile inputfile-2" name="gym_licence" value="{{ old('gym_licence') }}" required autofocus>
                      <label for="file-1"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Gym Licence&hellip;</span></label>
                      @if ($errors->has('gym_licence'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('gym_licence') }}</strong>
                        </span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group js col-md-6">
                     <label class=" col-form-label"><b>{{ __('Video') }} (* mp4,webm,3gp,mov,flv,avi,wmv,ts)</b></label>
                    <div class="input-group">
                      <input id="file-3" class="form-control form-control-sm inputfile inputfile-2" type="file" name="gym_video" value="" placeholder="Upload your gym video here.">
                     <label for="file-3"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Gym Video&hellip;</span></label>

                       @if ($errors->has('gym_video'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('gym_video') }}</strong>

                         @endif
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 locateme-outer form-group">
                        <label class="label">{{ __('By clicking locate me you will set your current location as gym location') }}</label>
                   <div class="input-group">             
                  <input type="text" placeholder="Location" name="location" class="searchinput form-control" autocomplete="off">
                      <div class="locateme">
                    <span onclick="getLocation()" class="locationloader">
                      <i class="fas fa-spinner fa-spin"></i> 
                      <i class="fas fa-location-arrow"></i> Locate Me</span><br/>
                     
                    <input type="hidden" id="latitude" name="lat">
                    <input type="hidden" id="longitude" name="lon">
                  </div>
                  <span class="bg-info text-white  invalid-feedback" id="msg"></span>
                </div><br/>

                 <div class="form-group iframe" id="show-map">
                          
                        </div>

                  </div>
                
                <div class="col-md-6">
                  <p class="label">{{ __('GSTIN/PAN') }} (*pdf,jpeg,png,jpg)</p>
                   <input  class="form-control form-control-sm inputfile inputfile-2" id="file-20" type="file" placeholder="GSTIN/PAN" name="gym_pan" value="{{ old('gym_pan') }}" autocomplete="off">
                    <label for="file-20"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>GSTIN/PAN&hellip;</span></label>

                             
                    @if ($errors->has('gym_pan'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('gym_pan') }}</strong>
                    </span>
                    @endif
                     
                    </div>

                </div>
                <div class="row">
                  <div class="form-group col-md-6">
                  <label class="label">{{ __('Gym Images') }} (* jpeg,png,jpg)</label>
                    <div class="input-group increment ">
                        <input name="gym_images[]" type="file" class="form-control form-control-sm inputfile inputfile-2" id="file-8">
                        <label for="file-8"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Gym Images&hellip;</span></label> 
                       
                    </div>
                     <button class="btn btn-secondary add_more btn-sm" type="button">Add More</button>
                      @if ($errors->has('gym_images'))
                      <span class="invalid-feedback">
                          <strong>{{ $errors->first('gym_images') }}</strong>
                      </span>
                      @endif
                </div>
                </div>                   
                   

                  
                 
                </div>
                  <div class="form-group row mb-4">
                    <div class="col-md-12 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Submit') }}
                        </button>
                    </div>
                  </div>

                       

                    </form>


              </div>
            </div>
            
          </div>
         

       
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        @include('admins.footer')
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
<script type="text/javascript">
  $(document).ready(function() {
$('#category').multiselect({
                includeSelectAllOption: true
            });


      $(".add_more").click(function(){ 
          //var html = $(".clone").html();
          var html =' <div class="col-xs-12 mt-3"> <div class="showhide row"><div class="col-md-8"> '+
                      '<input type="file" name="gym_images[]" + class="form-control "></div>'+
                        '<div class="col-md-3"> <button class="btn btn-danger remove" type="button">Remove</button>'+
                            '</div></div></div>';
          $(".increment").append(html);
      });

      $("body").on("click",".remove",function(){ 
          $(this).parents(".showhide").remove();
      });

    });

  </script>

<!-- 
<script type="text/javascript">
   function getLocation() 
  {
      $(".locationloader").addClass('loader')
      var x = document.getElementById("lat_long");
    if (navigator.geolocation) {
     
      navigator.geolocation.getCurrentPosition(showPosition);
    } else {
      x.innerHTML = "Geolocation is not supported by this browser.";
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
      $('#msg').html("<b>Your current location set for this Gym.</b>");
    }
  }


     jQuery('.extra-seller-info').hide();
    
     
jQuery(document).ready(function(){
    jQuery('#hideshow').on('click', function(event) {        
    jQuery('.extra-seller-info').slideToggle('slow');
    $(this).find('i').toggleClass('fa-minus fa-plus');
});
    });
</script> -->
    
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
