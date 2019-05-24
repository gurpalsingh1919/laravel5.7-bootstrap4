@extends('layouts.trainer-app')
@section('content')
 <div class="container-fluid page-body-wrapper">
     @include('trainer.sidebar')
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
         
          <div class="row">
            <div class="col-sm-12">
              <div class="card">
              <div class="card-body">
                <h4>General Setting</h4>
                <br/>
                <form name="general-setting" method="post"  enctype="multipart/form-data" action="{{route('updateGeneralSettingspost',$trainer_info[0]->seller->id)}}">
                  @csrf
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="trainer_name" value="{{ $trainer_info[0]->name }}" placeholder="Enter your full name" autocomplete="off">
                     @if ($errors->has('trainer_name'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('trainer_name') }}</strong>
                    </span>
                    @endif
                  </div>
                 
                  <div class="form-group">
                    <label>Address</label>
                    <textarea class="form-control" type="text" name="trainer_address" rows="4">
                      {{ $trainer_info[0]->seller->gym_address }}
                    </textarea>
                     @if ($errors->has('trainer_address'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('trainer_address') }}</strong>
                    </span>
                    @endif

                  </div>
                  <div class="form-group">
                    <label>Postal Code</label>
                    <input type="number" class="form-control" name="trainer_zip" value="{{ $trainer_info[0]->seller->zip }}" placeholder="Enter your postal code" autocomplete="off">
                     @if ($errors->has('trainer_zip'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('trainer_zip') }}</strong>
                    </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label>Contact Number</label>
                    <input type="text" class="form-control" name="trainer_tel" value="{{ $trainer_info[0]->phone_no }}" placeholder="Enter your contact number" autocomplete="off">
                     @if ($errors->has('trainer_tel'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('trainer_tel') }}</strong>
                    </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label>City</label>
                    <select class="form-control" name="trainer_city">
                       @foreach($cities as $city)
                     <option value="{{$city->name}}" {{$city->name==$trainer_info[0]->seller->city?'selected':''}}>{{$city->name}}</option>
                     @endforeach
                    </select>
                  </div>
                    

                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                    <label>Expertise</label>
                    <input class="form-control" type="text" name="trainer_Expertize" value="{{$trainer_info[0]->seller->expertise}}" placeholder="Enter your Expertise">
                     @if ($errors->has('trainer_Expertize'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('trainer_Expertize') }}</strong>
                    </span>
                    @endif
                  </div>
                  <div class="form-group">
                    <label>Area of Expertise</label>
                    <select class="form-control" name="trainer_area_expertize">
                       <option value="Yoga Trainer" {{$trainer_info[0]->seller->type_of_expertise =='Yoga Trainer'?'selected':''}}>Yoga Trainer</option>
                        <option value="Personal Trainer" {{$trainer_info[0]->seller->type_of_expertise =='Personal Trainer'?'selected':''}}>Personal Trainer</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Experience</label>
                    <input class="form-control" type="text" name="trainer_experince" value="{{ $trainer_info[0]->seller->experience }}" placeholder="Enter how much years of experience.">
                     @if ($errors->has('trainer_experince'))
                      <span class="invalid-feedback">
                          <strong>{{ $errors->first('trainer_experince') }}</strong>
                      </span>
                      @endif
                  </div>
                  <div class="form-group">
                    <label>Payment Type</label>
                    <select class="form-control" name="payment_mode">
                      <option value="1" {{$trainer_info[0]->seller->payment_mode =='1'?'selected':''}}>Monthly</option>
                        <option value="2" {{$trainer_info[0]->seller->payment_mode =='2'?'selected':''}}>Hourly</option>
                    </select>
                   
                  </div>
                  <div class="form-group">
                    <label>Gender</label>
                    <select class="form-control"  name="gender">
                      <option value="1" {{$trainer_info[0]->seller->gender =='1'?'selected':''}}>Male</option>
                        <option value="2" {{$trainer_info[0]->seller->gender =='2'?'selected':''}}>Female</option>
                    </select>
                  </div>


                  </div>
                </div>
                <div class="text-center">
                  <hr />
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
                </form>

                </div>
                <!--end card body -->
              </div>
            </div>
            
          </div>
         

       
        </div>

         
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        @include('trainer.footer')
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>

        

       
@endsection
