@extends('layouts.sellers-app')

@section('content')
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth register-bg-1 theme-one">
        <div class="row w-100">
          <div class="col-lg-8 mx-auto">
            <h2 class="text-center mb-4"><img src="images/logo-1.png"/></h2>
            <div class="auto-form-wrapper pt-4">
              <h2 class="text-center mb-4 pt-0">{{ __('Partner With us') }}</h2>
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
              <form method="POST" action="{{ route('registerasseller') }}" enctype="multipart/form-data">
                @csrf
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
                       <input id="phone_no" type="phone_no" class="form-control{{ $errors->has('phone_no') ? ' is-invalid' : '' }}" name="phone_no" value="{{ old('phone_no') }}" required autofocus>
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
                      <input id="zip" type="text" class="form-control{{ $errors->has('zip') ? ' is-invalid' : '' }}" name="zip" value="{{ old('zip') }}" required autofocus>
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
                    <label class="label">{{ __('Gym Licence') }}</label>
                    <div class="input-group">
                    <input id="gym_licence" type="file" class="form-control{{ $errors->has('gym_licence') ? ' is-invalid' : '' }}" name="gym_licence" value="{{ old('gym_licence') }}" required autofocus>
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                      </div>
                      @if ($errors->has('gym_licence'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('gym_licence') }}</strong>
                        </span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group col-md-6">
                    <label class="label">{{ __('Image') }}</label>
                    <div class="input-group">
                      <input id="gym_images" type="file" class="form-control{{ $errors->has('gym_images') ? ' is-invalid' : '' }}" name="gym_images" value="{{ old('gym_images') }}" required autofocus>
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                      </div>
                      @if ($errors->has('gym_images'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('gym_images') }}</strong>
                        </span>
                      @endif
                    </div>
                  </div>
                </div>

                
                
               
                <div class="form-group d-flex justify-content-center">
                  <div class="form-check form-check-flat mt-0">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" checked> I agree to the terms
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <button class="btn btn-primary submit-btn btn-block">{{ __('Submit') }}</button>
                </div>
                <div class="text-block text-center my-3">
                  <span class="text-small font-weight-semibold">{{ __('Already have and account ?') }}</span>
                  <a href="{{ route('sellerlogin') }}" class="text-black text-small">{{ __('Login') }}</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
 <!--  </div> -->
 @endsection