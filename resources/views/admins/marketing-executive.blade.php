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
                <div class="card-header"><b>{{__('Add Marketing Executive')}}</b>
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

                <form method="POST" action="{{ route('addMarketingExecutivePost') }}" enctype="multipart/form-data">
                 
                  @csrf
                  <div class="card-body">
                   <div class="form-group row">
                       <div class="col-md-6">
                           <label for="first_name" class="col-form-label"><b>{{ __('First Name') }}</b></label>
                           <input class="form-control" type="text" name="first_name" value="" required autofocus>
                            @if ($errors->has('first_name'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('first_name') }}</strong>
                            </span>
                            @endif
                       </div>
                        <div class="col-md-6">
                           <label for="last_name" class="col-form-label"><b>{{ __('Last Name') }}</b></label>
                           <input class="form-control" type="text" name="last_name" value="" required autofocus>
                            @if ($errors->has('last_name'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                            @endif
                       </div>
                        <div class="col-md-6">
                           <label for="username" class="col-form-label"><b>{{ __('Username') }}</b></label>
                           <input class="form-control" type="text" name="username" value="" required autofocus>
                            @if ($errors->has('username'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                            @endif
                       </div>
                        <div class="col-md-6">
                           <label for="email" class="col-form-label"><b>{{ __('Email') }}</b></label>
                           <input class="form-control" type="email" name="email" value="" required autofocus>
                            @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                       </div>
                        <div class="col-md-6">
                           <label for="phone_no" class="col-form-label"><b>{{ __('Contact Number') }}</b></label>
                           <input class="form-control" type="number" name="phone_no" value="" required autofocus>
                            @if ($errors->has('phone_no'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('phone_no') }}</strong>
                            </span>
                            @endif
                       </div>
                        <div class="col-md-6">
                           <label for="password" class="col-form-label"><b>{{ __('Password') }}</b></label>
                           <input class="form-control" type="password" name="password" value="" required autofocus>
                            @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                       </div>
                        <div class="col-md-6">
                           <label for="confirm-password" class="col-form-label"><b>{{ __('Confirm Password') }}</b></label>
                           <input class="form-control" type="password" name="confirm-password" value="" required autofocus>
                            @if ($errors->has('confirm-password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('confirm-password') }}</strong>
                            </span>
                            @endif
                       </div>
                     </div>
                    
                   
                   

                  
                 
                </div>
                  <div class="form-group row mb-4">
                    <div class="col-md-6 offset-md-2">
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






@endsection
