@extends('layouts.mktexecutive-app')

@section('content') 
<!--  BEGIN CONTENT PART  -->
<div id="content" class="main-content">
<div class="container">
  <div class="page-header">
      <div class="page-title">
          <h3>Seller</h3>
      </div>
  </div>
  <div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
      <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
              <div class="col-xl-12 col-md-12 col-sm-12 col-12 ">
                <div class="d-flex justify-content-between">
                  <div><h4> <i class="flaticon-package mr-2"></i>{{$title}}</h4></div>
                  <div class="float-right pt-3 mr-3"> <a href="{{route('mysellers')}}" class="btn btn-primary">My Sellers</a></div>
                </div>
              </div>
            </div>
          </div>
        <div class="widget-content widget-content-area">
          <div class="row">
            <div class="col-xl-12 col-md-12">
              <div class="card card-default">
                <!-- <div class="card-heading">
                  <h2 class="card-title"><span>{{$title}}</span></h2>
                </div> -->
                <div class="card-body">
                   @if($errors->all())
                  @foreach ($errors->all() as $index=>$error)
                   <!--   @if($index==0)
                  <div class="alert alert-danger">One or more fields have an error. Please check and try again.</div>
                   @endif -->
                   <div class="alert alert-danger">{{$error}}</div>
                  @endforeach
                @endif
                @if(session('error'))
                <div class="error alert alert-danger alert-dismissable">
                  <a href="#" class="close" data-dismiss="alert"
                       aria-label="close">&times;</a>
                  <strong>Error : </strong> {{ session('error') }}
                </div>
                @endif
                @if(session('success'))
                <div class="error alert alert-success alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert"
                       aria-label="close">&times;</a>
                    {!! session('success') !!}
                </div>
                @endif
                     <form class="needs-validation" action="{{route('createSellerPost')}}" novalidate enctype="multipart/form-data" method="post">
                       @csrf 
                        <div class="form-row">
                            <div class="col-md-4 mb-4">
                                <label for="validationCustom01"><b>{{ __('Gym Name') }}</b></label>
                                <input type="text" class="form-control" id="validationCustom01" placeholder="Gym Name" name="gym_name" value="{{ old('gym_name') }}" required autocomplete="off">
                                @if ($errors->has('gym_name'))
                                  <span class="invalid-feedback">
                                      <strong>{{ $errors->first('gym_name') }}</strong>
                                  </span>
                                @endif
                            </div>
                            <div class="col-md-4 mb-4">
                                <label for="validationCustom02"><b>{{ __('Owner`s Full Name') }}</b></label>
                                <input type="text" class="form-control" id="validationCustom02" placeholder="Owner's Full Name"  name="name" value="{{ old('name') }}" required autocomplete="off">
                                 @if ($errors->has('name'))
                                  <span class="invalid-feedback">
                                      <strong>{{ $errors->first('name') }}</strong>
                                  </span>
                                @endif
                            </div>
                            <div class="col-md-4 mb-4">
                                <label for="validationCustom03"><b>{{ __('E-Mail Address') }}</b></label>
                                <div class="input-group">
                                   
                                    <input type="eamil" class="form-control" id="validationCustom03" placeholder="Please enter E-Mail address" name="email" value="{{ old('email') }}" required autocomplete="off">
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                      <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                     @endif
                                </div>
                            </div>
                                                 
                            <div class="col-md-6 mb-4">
                                <label for="validationCustom05"><b>{{ __('Gym Description') }}</b></label>
                                
                                 <textarea rows="10" cols="5" name="gym_description" class="form-control">{{ old('gym_description') }}</textarea>
                                @if ($errors->has('gym_description'))
                                  <span class="invalid-feedback">
                                      <strong>{{ $errors->first('gym_description') }}</strong>
                                  </span>
                                @endif
                            </div>
                            <div class="col-md-6 mb-4">
                               <label class="label"><b>{{ __('By clicking locate me you will set your current location as gym location') }}</b></label>
                                  <a onclick="getLocation()" class="btn btn-outline-success btn-lg mb-4 mr-3 flaticon-location-fill">
                                  <i class="locationloader flaticon-spinner-circle spin"></i>Locate Me</a> 
                                  <div class="locateme">
                                  <input type="hidden" id="latitude" name="lat">
                                  <input type="hidden" id="longitude" name="lon">
                                  <span class="bg-info text-white  invalid-feedback" id="msg"></span>
                                  </div>
                                <div class="form-group iframe" id="show-map">
                                </div>
                            </div>
                          <div class="col-md-4 mb-4">
                                <label for="validationCustom08"><b>{{ __('City') }}</b></label>
                                <select name="city" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" required autofocus>
                                @foreach($cities as $city)
                                 <option value="{{$city->name}}" @if($city->name==old('city')){{'selected'}}@endif>{{$city->name}}</option>
                                 @endforeach
                               </select>
                                @if ($errors->has('city'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('city') }}</strong>
                                </span>
                                @endif
                          </div>
                          <div class="col-md-4 mb-4">
                                <label for="validationCustom06"><b>{{ __('Gym Address') }}</b></label>
                                <input type="text" class="form-control" id="validationCustom06" placeholder="Gym Address" name="gym_address" value="{{ old('gym_address') }}" required autocomplete="off">
                                @if ($errors->has('gym_address'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('gym_address') }}</strong>
                                </span>
                                @endif
                          </div>
                          <div class="col-md-4 mb-4">
                                <label for="validationCustom07"><b>{{ __('zip code') }}</b></label>
                                <input type="text" class="form-control" id="validationCustom07" placeholder="Contact Number"   name="zip" value="{{ old('zip') }}" required  autocomplete="off">
                               @if ($errors->has('zip'))
                                  <span class="invalid-feedback">
                                      <strong>{{ $errors->first('zip') }}</strong>
                                  </span>
                                @endif
                          </div>
                          <div class="col-md-4 mb-4">
                                <label for="validationCustom04"><b>{{ __('Contact Number') }}</b></label>
                                <input type="text" class="form-control" id="validationCustom04" placeholder="Contact Number"  name="phone_no" value="{{ old('phone_no') }}" required autocomplete="off">
                               @if ($errors->has('phone_no'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('phone_no') }}</strong>
                                </span>
                               @endif
                          </div>
                          <div class="col-md-4 mb-4">
                                <label for="validationCustom12"><b>{{ __('Website Link') }}</b></label>
                                 <input name="website_link" id="validationCustom12" value="{{ old('website_link') }}" autocomplete="off" class="form-control" type="text" placeholder="Website Link/online listing link">
                               @if ($errors->has('website_link'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('website_link') }}</strong>
                                </span>
                                @endif
                          </div>
                          <div class="col-md-4 mb-4">
                            <label class="label"><b>{{ __('Gym Licence') }} (* pdf,jpeg,png,jpg)</b></label>
                            <div class="input-group">
                              <input id="file-1" type="file" class="form-control form-control-sm inputfile inputfile-2" name="gym_licence" value="{{ old('gym_licence') }}" required autofocus>
                              
                              @if ($errors->has('gym_licence'))
                                <span class="invalid-feedback">
                                  <strong>{{ $errors->first('gym_licence') }}</strong>
                                </span>
                              @endif
                            </div>
                          </div>
                          <div class="col-md-4 mb-4">
                                <label for="validationCustom09"><b>{{ __('Video') }} (* mp4,webm,3gp,mov,flv,avi,wmv,ts)</b></label>
                                 <input id="file-3" class="form-control form-control-sm inputfile inputfile-2" type="file" name="gym_video" value="" placeholder="Upload your gym video here.">
                               @if ($errors->has('gym_video'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('gym_video') }}</strong>
                                </span>
                                @endif
                          </div>
                          <div class="col-md-4 mb-4">
                                <label for="validationCustom09"><b>{{ __('GSTIN/PAN') }} (*pdf,jpeg,png,jpg)</b></label>
                                 <input  class="form-control form-control-sm inputfile inputfile-2" id="file-20" type="file" placeholder="GSTIN/PAN" name="gym_pan" value="{{ old('gym_pan') }}" autocomplete="off">
                               @if ($errors->has('gym_pan'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('gym_pan') }}</strong>
                                </span>
                                @endif
                          </div>
                          <div class="col-md-4 mb-4">
                            <label for="validationCustom08"><b>{{ __('Gym Category') }}</b></label>
                             <select name="category[]" class="selectpicker form-control" multiple >
                            @foreach($gymCategory as $category)
                             <option value="{{$category->id}}">{{$category->name}}</option>
                             @endforeach
                            </select>
                            @if ($errors->has('category'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('category') }}</strong>
                            </span>
                            @endif
                          </div>
                          <div class="col-md-4 mb-4">
                            <label for="validationCustom09"><b>{{ __('Gym Images') }} (* jpeg,png,jpg)</b></label>
                             <div class="input-group increment">
                            <input  class="form-control form-control-sm inputfile inputfile-2" id="file-20" type="file" placeholder="GSTIN/PAN" name="gym_pan" value="{{ old('gym_pan') }}" autocomplete="off">
                              <button class="btn btn-primary add_more btn-sm" type="button">Add More</button>
                              @if ($errors->has('gym_images'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('gym_images') }}</strong>
                                </span>
                              @endif
                          </div>
                        </div>
                        </div>
                        <button class="btn btn-gradient-danger mb-4 mt-3" type="submit">Submit form</button>
                      </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<!--  END CONTENT PART  -->
   <!-- <script src="{{ asset('theme/plugins/maps/google_maps/g_events.js') }}"></script> -->
    <!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDoOlJCERKYB1Cp-C89_sscNkelSfeeBnw&callback=initMap&libraries=places"></script> -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDnjQOYC8PVe5a3eqhdmoA9Wtv0Ow2miN4&callback=initMap"  async defer></script>
<script type="text/javascript">
  $(document).ready(function() {

      $(".add_more").click(function(){ 
          //var html = $(".clone").html();
          console.log("asd");
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
<script type="text/javascript">

        var map;
        
        function initMap(latitude,longitude) {                            
         // var latitude = 31.00; // YOUR LATITUDE VALUE
           // var longitude = 85.3239605; // YOUR LONGITUDE VALUE
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


 $(".locationloader").hide();
   function getLocation() 
  {
    $(".form-group.iframe").show();
     $(".locationloader").show();
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
      $(".locationloader").hide();
      initMap(latitude,longitude);
      $('#msg').html("<b>Your current location set for this Gym.</b>");
      //$("#show-map").show();
    }
  }

  </script>

@endsection