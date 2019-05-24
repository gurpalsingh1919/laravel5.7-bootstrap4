@extends('layouts.mktexecutive-app')

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
               <form class="needs-validation" name="general-setting" method="post"  enctype="multipart/form-data" action="{{route('updateGeneralSettingspost',$executive_info->id)}}">
                @csrf
                <?php $name=explode(" ", $executive_info->name);  ?>
                  <div class="form-row">

                     <div class="col-md-6 mb-4">
                      <label for="validationCustom01"><b>{{ __('First Name') }}</b></label>
                     <input type="text" class="form-control" name="first_name" value="{{ $name[0] }}" placeholder="Enter your first name" autocomplete="off">
                     @if ($errors->has('first_name'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('first_name') }}</strong>
                    </span>
                    @endif
                  </div>
                  
                  <div class="col-md-6 mb-4">
                    <label><b>Last Name </b></label>
                    <input type="text" class="form-control" name="last_name" 
                    value="{{$name['1']}}" placeholder="Enter your last name" autocomplete="off">
                     @if ($errors->has('last_name'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('last_name') }}</strong>
                    </span>
                    @endif
                  </div>
                  <div class="col-md-6 mb-4">
                    <label><b>Contact Number</b></label>
                    <input type="text" class="form-control" name="contact_no" value="{{ $executive_info->phone_no }}" placeholder="Enter your contact number" autocomplete="off">
                     @if ($errors->has('contact_no'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('contact_no') }}</strong>
                    </span>
                    @endif
                  </div>
                  
                  <div class="col-md-6 mb-4">
                    <label><b>Username</b></label>
                    <input class="form-control" type="text" name="username" value="{{ $executive_info->username }}" placeholder="Enter your username">
                     @if ($errors->has('username'))
                      <span class="invalid-feedback">
                          <strong>{{ $errors->first('username') }}</strong>
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