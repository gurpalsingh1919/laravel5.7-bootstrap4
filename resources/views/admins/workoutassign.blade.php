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
                <div class="card-header"><b>{{__('Assign Workout')}}</b>
                  <div class="float-right"> <a href="{{ route('getAllAssignedWorkouts') }}" class="btn btn-primary">Workout List</a></div><br/><br/>
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
                <div class="form-group mb-4 row">
                <label class="col-md-3 text-right" for="exampleFormControlSelect1"><b>Select Package</b>
                <span style="color: #ff3743">*</span></label>
                <div class="col-md-3">
                  <form action="" >
                    <select class="form-control-rounded form-control" id="exampleFormControlSelect1" onchange="this.form.submit()" name="package">
                        <option value="0">Select Package</option>
                         @foreach($myPackages as $package)
                           <option value="{{$package->gym_package_id}}" @if($package->gym_package_id==$packag_id){{'Selected'}}@endif>{{$package->packageDetails['title']}}</option>
                         @endforeach
                    </select>
                    @if ($errors->has('package'))
                       <span class="invalid-feedback">
                          <strong>{{ $errors->first('package') }}</strong>
                       </span>
                    @endif
                  </form>
                </div>
              </div>
                <form method="POST" action="{{ route('workoutAssignpost') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group mb-4 row">
                    <label class="col-md-3 ml-4 text-right" for="exampleFormControlSelect1"><b>Select Member </b> <span style="color: #ff3743">*</span></label>
                    <div class="col-md-3">
                      <select class="form-control" id="customer" multiple="multiple" name="customer[]">
                     @foreach($mycustomers as $customer)
                      <option value="{{$customer->orderDetails->userDetail['id']}}" >{{$customer->orderDetails->userDetail['name']}}</option>
                  @endforeach
                    </select>
                    </div>
                    <label class="text-left" for="exampleFormControlSelect1"><b>Description </b><span style="color: #ff3743">*</span></label>
                    <div class="col-md-3">
                      <textarea class="form-control-rounded form-control" id="exampleFormControlTextarea1" name="description" rows="3"></textarea>
                   </div>
                  </div>
              
                  <div class="form-group mb-4 row">
                    <label class="col-md-3 text-right" for="exampleFormControlSelect1">
                      <b>Start Date</b><span style="color: #ff3743">*</span></label>
                    <div class="col-md-3">
                        <div class=" text" data-role="datepicker" data-preset="{{ date('Y-m-d')}}">
                            <input class="form-control" type="text" name="start_date">
                             
                        </div>
                    </div>


                    <label class="text-left" for="exampleFormControlSelect1"><b>End Date</b> <span style="color: #ff3743">*</span></label>
                        <div class="col-md-3">
                                   <div class=" text" data-role="datepicker" data-preset="{{ date('Y-m-d H:i:s')}}">
                                <input class="form-control" type="text" name="end_date">
                                 
                            </div>
                        </div>

                 <label class="col-md-3 text-right mt-4" for="exampleFormControlSelect1">
                  <b>Enter Video url</b><span style="color: #ff3743">*</span>
                </label>
                <div class="col-md-3 mt-4">
                  <input class="form-control" type="text" name="video" autocomplete="off">
                </div>

                  </div>                                
                  <div class="col-md-12 justify-content-center d-flex typo-section">
                    <div class="border col-md-12 col-lg-9 p-3 ">
                      <div class="row">
                        <div class="col-md-6 ">
                          <h5><b>Select Days</b></h5><hr/>
                          <div class="widget-content widget-content-area">
                            <div class="n-chk">
                              <label class="new-control new-checkbox">
                              <input type="checkbox" class="new-control-input" name="week_days[Sunday]">
                              <span class="new-control-indicator"></span>Sunday
                              </label>
                            </div>
                            <div class="n-chk">
                              <label class="new-control new-checkbox checkbox-primary">
                              <input type="checkbox" class="new-control-input" name="week_days[Monday]">
                              <span class="new-control-indicator"></span>Monday
                              </label>
                            </div>
                            <div class="n-chk">
                              <label class="new-control new-checkbox checkbox-success">
                              <input type="checkbox" class="new-control-input" name="week_days[Tuesday]">
                              <span class="new-control-indicator"></span>Tuesday
                              </label>
                            </div>
                            <div class="n-chk">
                              <label class="new-control new-checkbox checkbox-info">
                              <input type="checkbox" class="new-control-input" name="week_days[Wednesday]">
                              <span class="new-control-indicator"></span>Wednesday
                              </label>
                            </div>
                            <div class="n-chk">
                              <label class="new-control new-checkbox checkbox-warning">
                              <input type="checkbox" class="new-control-input" name="week_days[Thursday]">
                              <span class="new-control-indicator"></span>Thursday
                              </label>
                            </div>
                            <div class="n-chk">
                              <label class="new-control new-checkbox checkbox-danger">
                                <input type="checkbox" class="new-control-input" name="week_days[Friday]">
                                <span class="new-control-indicator"></span>Friday
                              </label>
                            </div>
                            <div class="n-chk">
                              <label class="new-control new-checkbox checkbox-secondary">
                                <input type="checkbox" class="new-control-input" name="week_days[Saturday]">
                                <span class="new-control-indicator"></span>Saturday
                              </label>
                            </div>
                            
                        </div>
                      </div>
                      <div class="badge=-warning col-md-6" id="nutritionlist" style="display: none;">
                        <h5><b>Select Workout Activity To Add On Selected Days</b></h5><hr/>
                        <div class="widget-content widget-content-area">
                          <div class="n-chk">
                            <label class="new-control new-checkbox">
                              <input type="checkbox" id="1" class="workout_fixture new-control-input" data-name="Hyperextension">
                              <span class="new-control-indicator"></span>Hyperextension
                            </label>
                            <div id="workoutfixture_1">
                            </div>
                          </div>
                          <div class="n-chk">
                            <label class="new-control new-checkbox checkbox-primary">
                              <input type="checkbox" id="2" class="workout_fixture new-control-input" data-name="Crunch">
                              <span class="new-control-indicator"></span>Crunch
                            </label>
                            <div id="workoutfixture_2" >
                            
                            </div>
                          </div>
                          <div class="n-chk">
                            <label class="new-control new-checkbox checkbox-success">
                              <input type="checkbox" id="3" class="workout_fixture new-control-input" data-name="Leg Curl">
                              <span class="new-control-indicator"></span>Leg Curl
                            </label>
                            <div id="workoutfixture_3"></div>
                          </div>
                          <div class="n-chk">
                            <label class="new-control new-checkbox checkbox-info">
                              <input type="checkbox" id="4" class="workout_fixture new-control-input" data-name="Reverse Leg Curl">
                              <span class="new-control-indicator"></span>Reverse Leg Curl
                            </label>
                            <div id="workoutfixture_4"></div>
                          </div>
                          <div class="n-chk">
                            <label class="new-control new-checkbox checkbox-warning">
                              <input type="checkbox" id="5" class="workout_fixture new-control-input" data-name="Body Conditioning">
                              <span class="new-control-indicator"></span>Body Conditioning
                            </label>
                            <div id="workoutfixture_5"></div>
                          </div>
                          <div class="n-chk">
                            <label class="new-control new-checkbox checkbox-danger">
                            <input type="checkbox" id="6" class="workout_fixture new-control-input" data-name="Free Weights">
                            <span class="new-control-indicator"></span>Free Weights
                            </label>
                            <div id="workoutfixture_6"></div>
                          </div>
                          <div class="n-chk">
                            <label class="new-control new-checkbox checkbox-secondary">
                              <input type="checkbox" id="7" class="workout_fixture new-control-input" data-name="Fixed Weights">
                              <span class="new-control-indicator"></span>Fixed Weights
                            </label>
                            <div id="workoutfixture_7"></div>
                          </div>
                          <div class="n-chk">
                            <label class="new-control new-checkbox checkbox-dark  mb-4">
                              <input type="checkbox" id="8" class="workout_fixture new-control-input" data-name="Resisted Crunch">
                              <span class="new-control-indicator"></span>Resisted Crunch
                            </label>
                            <div id="workoutfixture_8"></div>
                          </div>
                          <div class="n-chk">
                            <label class="new-control new-checkbox checkbox-dark  mb-4">
                              <input type="checkbox" id="9" class="workout_fixture new-control-input" data-name="Plank">
                              <span class="new-control-indicator"></span>Plank
                            </label>
                            <div id="workoutfixture_9"></div>
                          </div>
                          <div class="n-chk">
                            <label class="new-control new-checkbox checkbox-dark  mb-4">
                              <input type="checkbox" id="10" class="workout_fixture new-control-input" data-name="High Leg Pull-In">
                              <span class="new-control-indicator"></span>High Leg Pull-In
                            </label>
                            <div id="workoutfixture_10"></div>
                          </div>
                          <div class="n-chk">
                            <label class="new-control new-checkbox checkbox-dark  mb-4">
                              <input type="checkbox" id="11" class="workout_fixture new-control-input" data-name="Low Leg Pull-In">
                              <span class="new-control-indicator"></span>Low Leg Pull-In
                            </label>
                            <div id="workoutfixture_11"></div>
                          </div>
                          <button type="submit" class="btn btn-primary"> Submit</button>
                        </div>
                      </div>
                    </div>
                    </div>
                  </div>
                  </div>
                </form>
              </div>
            </div>
        </div>
      </div>
    @include('admins.footer')
    <!-- partial -->
  </div>
  <!-- main-panel ends -->
</div>
<script type="text/javascript">
 $(document).ready(function() {
$('#customer').multiselect({
                includeSelectAllOption: true
            });
});

jQuery("body").on("click", ".new-control-input", function(event){
$("#nutritionlist").css('display','block');
});

/*  jQuery("body").on("click", ".workout_fixture", function(event){
$(".nutritionfixture").toggle();
});*/


 $("body").on("change", ".workout_fixture", function () {


    if ($(this).is(":checked")) {

        id = $(this).attr('id');
        var name = $(this).data('name');
        string = '';

        string += '<div class="row"> <div class="col-md-6"> <div class="row"> <div class="col-md-12 form-group"><input type="text" name="workout['+name+'][sets]" class="form-control-rounded form-control" placeholder="Sets"> </div><div class="col-md-12 form-group"> <input type="text" name="workout['+name+'][kg]" class="form-control-rounded form-control" placeholder="KG"> </div></div></div><div class="col-md-6"> <div class="row"> <div class="col-md-12 form-group"><input type="text" name="workout['+name+'][reps]" class="form-control-rounded form-control" placeholder="Reps"> </div><div class="col-md-12 form-group"><input type="text" name="workout['+name+'][Rest Time]" class="form-control-rounded form-control" placeholder="Rest Time"> </div></div></div></div>';



        $("#workoutfixture_" + id).html(string);

    } else {
        id = $(this).attr('id');
        $("#workoutfixture_" + id).html('');
        //$(".achilactiveadd").hide();
    }
});
</script>
@endsection
