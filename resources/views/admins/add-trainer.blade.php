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
                <div class="card-header">
                  <b>{{__('Register Trainer')}}</b>
                 
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

                <form method="POST" action="{{ route('addTrainerPost') }}" enctype="multipart/form-data">
                 
                  @csrf
                  <div class="card-body">
                   <div class="form-group row">
                       <div class="col-md-6">
                      
                        
                           <label for="trainer_name" class="col-form-label"><b>{{ __('Name') }}</b></label>
                           <input class="form-control" type="text" name="trainer_name" value="{{ old('trainer_name') }}" required autofocus>
                            @if ($errors->has('trainer_name'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('trainer_name') }}</strong>
                            </span>
                            @endif
                       </div>
                        <div class="col-md-6">
                           <label for="trainer_email" class="col-form-label"><b>{{ __('Email') }}</b></label>
                           <input class="form-control" type="email" name="trainer_email" value="{{ old('trainer_email')}}" required autofocus>
                            @if ($errors->has('trainer_email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('trainer_email') }}</strong>
                            </span>
                            @endif
                       </div>
                        <div class="col-md-6">
                           <label for="trainer_address" class="col-form-label"><b>{{ __('Address') }}</b></label>
                           <input class="form-control" type="text" name="trainer_address" value="{{old('trainer_address')}}" required autofocus>
                            @if ($errors->has('trainer_address'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('trainer_address') }}</strong>
                            </span>
                            @endif
                       </div>
                        <div class="col-md-6">
                           <label for="trainer_zip" class="col-form-label"><b>{{ __('Postal Code') }}</b></label>
                           <input class="form-control" type="text" name="trainer_zip" value="{{old('trainer_zip')}}" required autofocus>
                            @if ($errors->has('trainer_zip'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('trainer_zip') }}</strong>
                            </span>
                            @endif
                       </div>
                       
                        <div class="col-md-6">
                           <label for="trainer_tel" class="col-form-label"><b>{{ __('Contact Number') }}</b></label>
                           <input class="form-control" type="number" name="trainer_tel" value="{{old('trainer_tel')}}" required autofocus>
                            @if ($errors->has('trainer_tel'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('trainer_tel') }}</strong>
                            </span>
                            @endif
                       </div>
                        <div class="col-md-6">
                           <label for="trainer_city" class="col-form-label"><b>{{ __('City') }}</b></label>
                           <select name="trainer_city" class="form-control">
                          @foreach($cities as $city)
                           <option value="{{$city->name}} {{old('trainer_city')==$city->name?'selected':''}}" >{{$city->name}}</option>
                           @endforeach
                          </select>
                          @if ($errors->has('trainer_city'))
                          <span class="invalid-feedback">
                              <strong>{{ $errors->first('trainer_city') }}</strong>
                          </span>
                          @endif
                       </div>
                        <div class="col-md-6">
                           <label for="trainer_expertize" class="col-form-label"><b>{{ __('Expertise') }}</b></label>
                           <input class="form-control" type="text" name="trainer_expertize" 
                           value="{{old('trainer_Expertize')}}" required autofocus>
                            @if ($errors->has('trainer_expertize'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('trainer_expertize') }}</strong>
                            </span>
                            @endif
                       </div>
                       <div class="col-md-6">
                           <label for="phone_no" class="col-form-label"><b>{{ __('Area of Expertise') }}</b></label>
                           <select class="form-control" name="trainer_area_expertize">
                            <option value="Yoga Trainer" {{old('trainer_area_expertize')=='Yoga Trainer'?'selected':''}} >Yoga Trainer</option>
                            <option value="Personal Trainer" {{old('trainer_area_expertize')=='Personal Trainer'?'selected': ''}} >Personal Trainer</option>
                        </select>
                        @if ($errors->has('trainer_area_expertize'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('trainer_area_expertize') }}</strong>
                        </span>
                        @endif
                       </div>
                       <div class="col-md-6">
                           <label for="trainer_experince" class="col-form-label"><b>{{ __('Experience') }}</b></label>
                           <input class="form-control" type="text" name="trainer_experince" value="{{old('trainer_experince')}}" required autofocus>
                            @if ($errors->has('trainer_experince'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('trainer_experince') }}</strong>
                            </span>
                            @endif
                       </div>
                        <div class="col-md-6">
                           <label for="payment_mode" class="col-form-label"><b>{{ __('Payment Type') }}</b></label>
                           <select class="form-control" name="payment_mode">
                        <option value="1" {{old('payment_mode')=='1'?'selected': ''}}>Monthly</option>
                            <option value="2" {{old('payment_mode')=='2'?'selected': ''}}>Hourly</option>
                        </select>
                        @if ($errors->has('payment_mode'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('payment_mode') }}</strong>
                        </span>
                        @endif
                       </div>
                        <div class="col-md-6">
                           <label for="gender" class="col-form-label"><b>{{ __('Gender') }}</b></label>
                           <select class="form-control" name="gender">
                        <option value="1" {{old('gender')=='1'?'selected': ''}}>Male</option>
                        <option value="2" {{old('gender')=='2'?'selected': ''}}>Female</option>
                       
                          </select>
                          @if ($errors->has('gender'))
                          <span class="invalid-feedback">
                              <strong>{{ $errors->first('gender') }}</strong>
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

<script type="text/javascript">
   function approvetrainer(updatestatus,trainer_id)
    {

        Swal({
                    title: 'Are you sure?',
                    text: "You want to approve this trainer!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Approve It!'
                  }).then((result) => {
              if (result.value) 
              {
                     $.ajax({
                            type: 'POST',
                            url: "{{url('admin/updateTrainer')}}",
                            data: { update_status:updatestatus,id:trainer_id,_token:"{{csrf_token()}}" },
                            success:  function(response)
                            {
                                console.log(response);
                                //window.location.reload();
                                var message=response.message;
                                  Swal(
                                'Good job!',
                                message,
                                'success'
                              )
                                 

                            }
                          });


        }
                  })



    }
  </script>




@endsection
