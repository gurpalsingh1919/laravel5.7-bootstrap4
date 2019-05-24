@extends('layouts.newseller-app')

@section('content')
<!--  BEGIN CONTENT PART  -->
<div id="content" class="main-content">
  <div class="container">
    <div class="page-header">
      <div class="page-title">
          <h3><i class="flaticon-locked mr-2"></i>{{__('Password Management')}}</h3>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
          <div class="widget-header">
            <div class="row">
              <div class="col-xl-12 col-md-12 col-sm-12 col-12 ">
                <div class="border-bottom d-flex justify-content-between">
                  <div><h4> <i class="flaticon-locked mr-2"></i>Update your password</h4></div>
                 
              </div>
            </div>
          </div>
          <div class="widget-content widget-content-area">
            <div class="row justify-content-center">
              <div class="col-md-12 col-lg-6 border-right border-left">
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
               <form method="POST" action="{{ route('updateAuthUserPassword') }}" enctype="multipart/form-data">
                @csrf
                  <div class="form-row">
                    <div class="col-md-12 mb-4">
                      <label for="validationCustom01"><b>{{ __('Current Password') }}</b></label>
                     <input type="password" class="form-control" id="validationCustom01" placeholder="Current password" name="current" value="{{ old('current') }}"  autocomplete="off">
                      @if ($errors->has('current'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('current') }}</strong>
                        </span>
                      @endif
                    </div>
                    <div class="col-md-12 mb-4">
                      <label for="validationCustom02"><b>{{ __('New Password') }}</b></label>
                      <input type="password" class="form-control" id="validationCustom02" placeholder="New password"  name="password" value="{{ old('password') }}"  autocomplete="off">
                       @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                      @endif
                    </div>
                    <div class="col-md-12 mb-4">
                      <label for="validationCustom02"><b>{{ __('Confirm Password') }}</b></label>
                      <input type="password" class="form-control" id="validationCustom03" placeholder="Confirm new password" name="password_confirmation" value="{{ old('password_confirmation') }}"  autocomplete="off">
                      @if ($errors->has('password_confirmation'))
                      <span class="invalid-feedback">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                      </span>
                       @endif
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