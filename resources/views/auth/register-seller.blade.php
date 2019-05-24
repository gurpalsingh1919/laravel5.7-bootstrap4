@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
              
            
                <div class="card-header">{{ __('Partner With us') }}
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

                <div class="card-body">
                    <form method="POST" action="{{ route('registerasseller') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="gym_name" class="col-md-4 col-form-label text-md-right">{{ __('Gym Name') }}</label>

                            <div class="col-md-6">
                                <input id="gym_name" type="text" class="form-control{{ $errors->has('gym_name') ? ' is-invalid' : '' }}" name="gym_name" value="{{ old('gym_name') }}" required autofocus>

                                @if ($errors->has('gym_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('gym_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('Owner Full Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone_no" class="col-md-4 col-form-label text-md-right">{{ __('Contact Number') }}</label>

                            <div class="col-md-6">
                                <input id="phone_no" type="phone_no" class="form-control{{ $errors->has('phone_no') ? ' is-invalid' : '' }}" name="phone_no" value="{{ old('phone_no') }}" required>

                                @if ($errors->has('phone_no'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('phone_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gym_description" class="col-md-4 col-form-label text-md-right">{{ __('Gym Description') }}</label>

                            <div class="col-md-6">
                                <input id="gym_description" type="text" class="form-control{{ $errors->has('gym_description') ? ' is-invalid' : '' }}" name="gym_description" value="{{ old('gym_description') }}" required autofocus>

                                @if ($errors->has('gym_description'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('gym_description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gym_address" class="col-md-4 col-form-label text-md-right">{{ __('Gym Address') }}</label>

                            <div class="col-md-6">
                                <input id="gym_address" type="text" class="form-control{{ $errors->has('gym_address') ? ' is-invalid' : '' }}" name="gym_address" value="{{ old('gym_address') }}" required autofocus>

                                @if ($errors->has('gym_address'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('gym_address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="zip" class="col-md-4 col-form-label text-md-right">{{ __('zip code') }}</label>

                            <div class="col-md-6">
                                <input id="zip" type="text" class="form-control{{ $errors->has('zip') ? ' is-invalid' : '' }}" name="zip" value="{{ old('zip') }}" required autofocus>

                                @if ($errors->has('zip'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('zip') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>

                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" value="{{ old('city') }}" required autofocus>

                                @if ($errors->has('city'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gym_licence" class="col-md-4 col-form-label text-md-right">{{ __('Gym Licence') }}</label>

                            <div class="col-md-6">
                                <input id="gym_licence" type="file" class="form-control{{ $errors->has('gym_licence') ? ' is-invalid' : '' }}" name="gym_licence" value="{{ old('gym_licence') }}" required autofocus>

                                @if ($errors->has('gym_licence'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('gym_licence') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gym_images" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>

                            <div class="col-md-6">
                                <input id="gym_images" type="file" class="form-control{{ $errors->has('gym_images') ? ' is-invalid' : '' }}" name="gym_images" value="{{ old('gym_images') }}" required autofocus>

                                @if ($errors->has('gym_images'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('gym_images') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                       


                        <div class="form-group row mb-4">
                            <div class="col-md-6 offset-md-4">
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
</div>
@endsection
