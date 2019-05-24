@extends('layouts.trainer-app')

@section('content')
<!--  BEGIN CONTENT PART  -->
<div id="content" class="main-content">
  <div class="container">
    <div class="page-header">
      <div class="page-title">
        <h3><i class="flaticon-settings-1 mr-2"></i> General Setting</h3>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
          <div class="widget-header">
            <div class="row">
              <div class="col-xl-12 col-md-12 col-sm-12 col-12 ">
                <div class="border-bottom d-flex justify-content-between">
                  <div><h4> <i class="flaticon-settings-1 mr-2"></i>Update your detail</h4></div>
                 
              </div>
            </div>
          </div>
          <div class="widget-content widget-content-area">
            <div class="row justify-content-center">
              <div class="col-md-12 col-lg-8 border-right border-left">
                @if($errors->all())
                  @foreach ($errors->all() as $index=>$error)
                     @if($index==0)
                  <div class="alert alert-danger">One or more fields have an error. Please check and try again.</div>
                   @endif
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
               <form class="needs-validation" name="general-setting" method="post"  enctype="multipart/form-data" action="{{route('updateGeneralSettingspost',$trainer_info[0]->seller->id)}}">
                @csrf
                  <div class="form-row">

                     <div class="col-md-6 mb-4">
                      <label for="validationCustom01"><b>{{ __('Name') }}</b></label>
                     <input type="text" class="form-control" name="trainer_name" value="{{ $trainer_info[0]->name }}" placeholder="Enter your full name" autocomplete="off">
                     @if ($errors->has('trainer_name'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('trainer_name') }}</strong>
                    </span>
                    @endif
                  </div>
                  <div class="col-md-6 mb-4">
                     <label><b>Address</b></label>
                      <textarea class="form-control" type="text" name="trainer_address" rows="4">
                        {{ $trainer_info[0]->seller->gym_address }}
                      </textarea>
                       @if ($errors->has('trainer_address'))
                      <span class="invalid-feedback">
                          <strong>{{ $errors->first('trainer_address') }}</strong>
                      </span>
                      @endif
                  </div>
                  <div class="col-md-6 mb-4">
                    <label><b>Postal Code</b></label>
                    <input type="number" class="form-control" name="trainer_zip" value="{{ $trainer_info[0]->seller->zip }}" placeholder="Enter your postal code" autocomplete="off">
                     @if ($errors->has('trainer_zip'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('trainer_zip') }}</strong>
                    </span>
                    @endif
                  </div>
                  <div class="col-md-6 mb-4">
                    <label><b>Contact Number</b></label>
                    <input type="text" class="form-control" name="trainer_tel" value="{{ $trainer_info[0]->phone_no }}" placeholder="Enter your contact number" autocomplete="off">
                     @if ($errors->has('trainer_tel'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('trainer_tel') }}</strong>
                    </span>
                    @endif
                  </div>
                  <div class="col-md-6 mb-4">
                    <label><b>City</b></label>
                    <select class="form-control" name="trainer_city">
                       @foreach($cities as $city)
                     <option value="{{$city->name}}" {{$city->name==$trainer_info[0]->seller->city?'selected':''}}>{{$city->name}}</option>
                     @endforeach
                    </select>
                  </div>
                  <div class="col-md-6 mb-4">
                    <label><b>City</b></label>
                    <select class="form-control" name="trainer_city">
                       @foreach($cities as $city)
                     <option value="{{$city->name}}" {{$city->name==$trainer_info[0]->seller->city?'selected':''}}>{{$city->name}}</option>
                     @endforeach
                    </select>
                  </div>
                  <div class="col-md-6 mb-4">
                    <label><b>Expertise</b></label>
                    <input class="form-control" type="text" name="trainer_Expertize" value="{{$trainer_info[0]->seller->expertise}}" placeholder="Enter your Expertise">
                     @if ($errors->has('trainer_Expertize'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('trainer_Expertize') }}</strong>
                    </span>
                    @endif
                  </div>
                  <div class="col-md-6 mb-4">
                   <label><b>Area of Expertise</b></label>
                    <select class="form-control" name="trainer_area_expertize">
                       <option value="Yoga Trainer" {{$trainer_info[0]->seller->type_of_expertise =='Yoga Trainer'?'selected':''}}>Yoga Trainer</option>
                        <option value="Personal Trainer" {{$trainer_info[0]->seller->type_of_expertise =='Personal Trainer'?'selected':''}}>Personal Trainer</option>
                    </select>
                  </div>
                  <div class="col-md-6 mb-4">
                    <label><b>Experience</b></label>
                    <input class="form-control" type="text" name="trainer_experince" value="{{ $trainer_info[0]->seller->experience }}" placeholder="Enter how much years of experience.">
                     @if ($errors->has('trainer_experince'))
                      <span class="invalid-feedback">
                          <strong>{{ $errors->first('trainer_experince') }}</strong>
                      </span>
                      @endif
                  </div>
                  <div class="col-md-6 mb-4">
                    <label><b>Payment Type</b></label>
                    <select class="form-control" name="payment_mode">
                      <option value="1" {{$trainer_info[0]->seller->payment_mode =='1'?'selected':''}}>Monthly</option>
                        <option value="2" {{$trainer_info[0]->seller->payment_mode =='2'?'selected':''}}>Hourly</option>
                    </select>
                   
                  </div>
                  <div class="col-md-6 mb-4">
                    <label><b>Gender</b></label>
                    <select class="form-control"  name="gender">
                      <option value="1" {{$trainer_info[0]->seller->gender =='1'?'selected':''}}>Male</option>
                        <option value="2" {{$trainer_info[0]->seller->gender =='2'?'selected':''}}>Female</option>
                    </select>
                  </div>
                    


                  </div>
                  <button class="btn btn-primary" type="submit">Submit form</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection