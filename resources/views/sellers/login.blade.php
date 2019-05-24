@extends('layouts.sellers-app')

@section('content')
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
		  <h2 class="text-center mb-4"><img src="{{ asset('images/logo-1.png') }}"/></h2>
            <div class="auto-form-wrapper pt-4">
			<h2 class="text-center mb-4 pt-0">{{ __('Seller Login') }}</h2>
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
              <form method="POST" action="{{ route('sellerLoginPost') }}">
                        @csrf

                <div class="form-group">
                   <label for="email" class="label">{{ __('E-Mail Address') }}</label>
                  <div class="input-group">
                      <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                     @if ($errors->has('email'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="form-group">
                  <label class="label">{{ __('Password') }}</label>
                  <div class="input-group">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                    <input type="hidden" name="panel" value="2">
                    @if ($errors->has('password'))
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="form-group">
                  <button class="btn btn-primary submit-btn btn-block">Login</button>
                </div>
                <div class="form-group d-flex justify-content-between">
                  <div class="form-check form-check-flat mt-0">
                    <label class="form-check-label">
                      <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Keep me signed in
                    </label>
                  </div>
                  <!-- <a href="#" class="text-small forgot-password text-black">Forgot Password</a> -->
                </div>

                <div class="text-block text-center my-3">
                  <span class="text-small font-weight-semibold">Not a member ?</span>
                  <a href="{{ route('partnerwithus') }}" class="text-black text-small">Create new account</a>
                </div>
                
              </form>
            </div>
            <br/>
            <p class="footer-text text-center">copyright © 2019 Near Gym. All rights reserved.</p>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
@endsection
   
  