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
                <div class="card-header"><b>{{__('Add Nutrition Schedule')}}</b>
                  <div class="float-right"> <a href="{{ route('getNutritions') }}" class="btn btn-primary">Nutrition Schedule List</a></div><br/><br/>
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
                <form method="POST" action="{{ route('assignNutritionsPost') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group mb-4 row">
                <label class="col-md-3 ml-4 text-right" for="exampleFormControlSelect1"><b>Select Member</b>
                <span style="color: #ff3743">*</span></label>
                <div class="col-md-3">
                  <select class="form-control" id="customer" multiple="multiple" name="customer[]">
                     @foreach($mycustomers as $customer)
                      <option value="{{$customer->orderDetails->userDetail['id']}}" >{{$customer->orderDetails->userDetail['name']}}</option>
                  @endforeach
                </select>
                  </div>
                  <label class="text-left" for="exampleFormControlSelect1">
                  <b>Enter Video url</b><span style="color: #ff3743">*</span>
                </label>
                <div class="col-md-3">
                  <input class="form-control" type="text" name="video" autocomplete="off">
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


                <label class="text-left" for="exampleFormControlSelect1"><b>End Date </b><span style="color: #ff3743">*</span></label>
                    <div class="col-md-3">
                               <div class=" text" data-role="datepicker" data-preset="{{ date('Y-m-d H:i:s')}}">
                            <input class="form-control" type="text" name="end_date">
                             
                        </div>
                    </div>

              </div>
               

                <div class="col-md-12 justify-content-center d-flex ">

                    <div class="border col-md-12 col-lg-9 p-3 typo-section">
                    <div class="row">
                    <div class="col-md-4  ">
                        <h5><b>Select Days</b></h5><hr/>
                        <div class="widget-content widget-content-area">
                            <div class="n-chk">
                                <label class="new-control new-checkbox checkbox-primary">
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
                                <label class="new-control new-checkbox checkbox-primary">
                                    <input type="checkbox" class="new-control-input" name="week_days[Tuesday]">
                                    <span class="new-control-indicator"></span>Tuesday
                                </label>
                            </div>
                            <div class="n-chk">
                                <label class="new-control new-checkbox checkbox-primary">
                                    <input type="checkbox" class="new-control-input" name="week_days[Wednesday]">
                                    <span class="new-control-indicator"></span>Wednesday
                                </label>
                            </div>
                            <div class="n-chk">
                                <label class="new-control new-checkbox checkbox-primary">
                                    <input type="checkbox" class="new-control-input" name="week_days[Thursday]">
                                    <span class="new-control-indicator"></span>Thursday
                                </label>
                            </div>
                            <div class="n-chk">
                                <label class="new-control new-checkbox checkbox-primary">
                                    <input type="checkbox" class="new-control-input" name="week_days[Friday]">
                                    <span class="new-control-indicator"></span>Friday
                                </label>
                            </div>
                            <div class="n-chk">
                                <label class="new-control new-checkbox checkbox-primary">
                                    <input type="checkbox" class="new-control-input" name="week_days[Saturday]">
                                    <span class="new-control-indicator"></span>Saturday
                                </label>
                            </div>



                        </div>

                    </div>
                    <div class="badge=-warning col-md-8" id="nutritionlist" >
                        <h5><b>Select Nutrition to add on selected days</b></h5><hr/>
                        <div class="widget-content widget-content-area">
                            <div class="n-chk">
                                <label class="new-control new-checkbox">
                                    <input type="checkbox" id="1" class="nutrition_fixture new-control-input" data-name="Break Fast">
                                    <span class="new-control-indicator"></span>Break Fast
                                </label>
                                <div id="nutritionfixture_1" >

                                </div>
                            </div>

                            <div class="n-chk">
                                <label class="new-control new-checkbox checkbox-primary">
                                    <input type="checkbox" id="2" class="nutrition_fixture new-control-input" data-name="Mid-Morning Snacks" >
                                    <span class="new-control-indicator"></span>Mid-Morning Snacks
                                </label>
                                <div id="nutritionfixture_2" >

                                </div>
                            </div>

                            <div class="n-chk">
                                <label class="new-control new-checkbox checkbox-success">
                                    <input type="checkbox" id="3" class="nutrition_fixture new-control-input" data-name="Lunch">
                                    <span class="new-control-indicator"></span>Lunch
                                </label>
                                <div id="nutritionfixture_3" >

                                </div>
                            </div>

                            <div class="n-chk">
                                <label class="new-control new-checkbox checkbox-info">
                                    <input type="checkbox"  id="4" class="nutrition_fixture new-control-input" data-name="Afternoon Snacks">
                                    <span class="new-control-indicator"></span>Afternoon Snacks
                                </label>
                                <div id="nutritionfixture_4" >

                                </div>
                            </div>

                            <div class="n-chk">
                                <label class="new-control new-checkbox checkbox-warning">
                                  <input type="checkbox" id="5" class="nutrition_fixture new-control-input" data-name="Dinner">
                                    <span class="new-control-indicator"></span>Dinner
                                </label>
                                <div id="nutritionfixture_5" >

                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary"> Add Nutrition</button>

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


$("body").on("change", ".nutrition_fixture", function () {


    if ($(this).is(":checked")) {

        id = $(this).attr('id');
        var name = $(this).data('name');
        console.log(id);
        string = '';

        string += '<div class="row"> <div class="col-md-12"> <div class="row"> <div class="col-md-12 col-lg-12 form-group"><input type="text" class="form-control" name="nutrition['+name+']"  > </div></div></div></div>';



        $("#nutritionfixture_" + id).html(string);

    } else {
        id = $(this).attr('id');
        $("#nutritionfixture_" + id).html('');
        //$(".achilactiveadd").hide();
    }
});


</script>

@endsection
