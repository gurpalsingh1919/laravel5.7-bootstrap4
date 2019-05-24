@extends('layouts.app')

@section('content')
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDnjQOYC8PVe5a3eqhdmoA9Wtv0Ow2miN4&libraries=places"></script> -->
<script type="text/javascript" src='https://maps.google.com/maps/api/js?libraries=places&key=AIzaSyDnjQOYC8PVe5a3eqhdmoA9Wtv0Ow2miN4'></script>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
      </script>
<div class="row w-100">
    <div class="col-lg-4 mx-auto">
        <div class="flex-center position-ref full-height">
           
              <div class="content">
              


               
              
              
                @foreach($yourlocationgyms as $value)
                <!-- <div class="row"> -->
                  <div class="form-group col-md-6">
                    <label class="label"><b>{{$value['gym_name']}}</b></label>
                    <div class="input-group">
                      <?php $gym_imagess=explode('|', $value['gym_images']); ?>
                      @foreach($gym_imagess as $index=>$image)
                        @if($index==0)
                        <img height="250" width="250" src="{{ asset('/gyms') }}/{{$image}}" alt="{{$value['gym_name']}}"  />
                        @endif
                      @endforeach
                     
                    </div>
                  </div>
                  
                <!-- </div> -->
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection('content')
