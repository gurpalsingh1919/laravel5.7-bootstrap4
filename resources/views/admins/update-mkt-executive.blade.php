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
                <div class="card-header"><b>{{__('Update Marketing Executive Detail')}}</b>
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

                <form method="POST" action="{{ route('updateMarketingExecutivePost',$mktexecutive_id) }}" enctype="multipart/form-data">
                 
                  @csrf
                  <div class="card-body">
                   <div class="form-group row">
                       <div class="col-md-6">
                        <?php $name=explode(" ", $marketingExecutivesDetail[0]->name);
                       // print_r($name);
                         ?>
                           <label for="first_name" class="col-form-label"><b>{{ __('First Name') }}</b></label>
                           <input class="form-control" type="text" name="first_name" value="{{$name[0]}}" required autofocus>
                            @if ($errors->has('first_name'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('first_name') }}</strong>
                            </span>
                            @endif
                       </div>
                        <div class="col-md-6">
                           <label for="last_name" class="col-form-label"><b>{{ __('Last Name') }}</b></label>
                           <input class="form-control" type="text" name="last_name" value="{{$name[1]}}" required autofocus>
                            @if ($errors->has('last_name'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                            @endif
                       </div>
                        <div class="col-md-6">
                           <label for="username" class="col-form-label"><b>{{ __('Username') }}</b></label>
                           <input class="form-control" type="text" name="username" value="{{$marketingExecutivesDetail[0]->username}}" required autofocus>
                            @if ($errors->has('username'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                            @endif
                       </div>
                        <div class="col-md-6">
                           <label for="email" class="col-form-label"><b>{{ __('Email') }}</b></label>
                           <input class="form-control" type="email" name="email" value="{{$marketingExecutivesDetail[0]->email}}" required autofocus>
                            @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                       </div>
                        <div class="col-md-6">
                           <label for="phone_no" class="col-form-label"><b>{{ __('Contact Number') }}</b></label>
                           <input class="form-control" type="number" name="phone_no" value="{{$marketingExecutivesDetail[0]->phone_no}}" required autofocus>
                            @if ($errors->has('phone_no'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('phone_no') }}</strong>
                            </span>
                            @endif
                       </div>
                       
                     </div>
                    
                   
                   

                  
                 
                </div>
                  <div class="form-group row mb-4">
                    <div class="col-md-6 offset-md-2">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Update') }}
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
