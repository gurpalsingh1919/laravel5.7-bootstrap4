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
                <div class="card-header"><b>{{__('Update City')}}</b>
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

                <form method="POST" action="{{ route('city.editpost',$city_id) }}" enctype="multipart/form-data">
                 
                  @csrf
                  <div class="card-body">
                   <div class="form-group row">
                       <div class="col-md-6">
                           <label for="name" class="col-form-label"><b>{{ __('Name') }}</b></label>
                           <input class="form-control" type="text" name="name" value="{{$gymCity->name}}" required autofocus>
                            @if ($errors->has('name'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                       </div>
                     </div>
                     <div class="form-group row">
                       <div class="col-md-6">
                           <label for="latitude" class=" col-form-label text-md-right"><b>{{ __('Latitude') }}</b></label>
                           <input class="form-control" type="text" name="latitude" value="{{$gymCity->lat}}" required autofocus>
                            @if ($errors->has('latitude'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('latitude') }}</strong>
                            </span>
                            @endif
                       </div>
                       
                      
                   </div>
                   <div class="form-group row">
                       <div class="col-md-6">
                           <label for="longitude" class=" col-form-label text-md-right"><b>{{ __('Longitude') }}</b></label>
                           <input class="form-control" type="text" name="longitude" value="{{$gymCity->lon}}" required autofocus>
                            @if ($errors->has('longitude'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('longitude') }}</strong>
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
