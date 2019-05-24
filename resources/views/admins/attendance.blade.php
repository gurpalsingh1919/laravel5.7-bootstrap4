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
                <div class="card-header"><b>{{__('Member Attendance')}}</b>
                  
                </div>
                <div class="widget-content widget-content-area mt-4">
              <form>
                <div class="form-group mb-4 row">
                  <label class="col-md-3 text-right" for="exampleFormControlSelect1"><b>Date </b> <span style="color: #ff3743">*</span></label>
                  <div class="col-md-4">
                    <div class=" text" data-role="datepicker" data-preset="<?php 
                    if(isset($_GET['date'])) 
                    {
                      $date=str_replace(".","-",$_GET['date']);
                      echo $date;
                    }
                    else
                    {
                      echo date('Y-m-d');
                    } ?>">
                        <input class="form-control" type="text" name="date" >
                    </div>
                  </div>
                </div>
                <div class="form-group mb-4 row">
                    <label class="col-md-3 text-right" for="exampleFormControlSelect1">
                      <b>Select Package </b>
                    <span style="color: #ff3743">*</span></label>
                    <div class="col-md-4">
                        <select class="form-control-rounded form-control" id="exampleFormControlSelect1" name="package_id">
                          @foreach($packages as $package)
                            <option value="{{$package->id}}" <?php if(isset($_GET['package_id']) && $_GET['package_id']==$package->id) {echo 'selected';} ?>>{{$package->title}}</option>
                          @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group mb-4 row">
                  <label class="col-md-3 text-right" for="exampleFormControlSelect1"></label>
                  <div class="col-md-6">
                    <button class="btn btn-primary" type="submit">Take/View Attendance</button>
                  </div>
              </div>
              </form>
                <br>
                <br>
                @if(count($mycustomers)>0)
                <fieldset class="border p-2">
                  <legend  class="w-auto pl-2 pr-2 small badge-primary">
                  Class : {{$pack_name}} , Date : {{$formatted_date}}</legend>
                  
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

                  <div class="table-responsive">
                    <table class="table table-bordered table-striped mb-4">
                      <thead>
                        <tr>
                          <th>Mark Present</th>
                          <th>Photo</th>
                          <th>Member Name</th>
                          <th>email</th>
                          <th class="text-center">Status</th>
                        </tr>
                      </thead>
                      <tbody>
                      <form method="post" action="{{route('attandanceMark')}}" enctype="multipart/form-data">
                        @csrf
                          <input type="hidden" name="package_id" value="{{$package_id}}">
                          <input type="hidden" name="attendance_date" value="{{$_GET['date']}}">
                      @foreach($mycustomers as $index=>$mycustomer)
                        <tr>
                          <td class="checkbox-column">
                            <div class="custom-control custom-checkbox checkbox-primary">
                              <input type="checkbox" class="custom-control-input todochkbox" id="todo-{{$index+1}}" name="attendance[{{$mycustomer->orderDetails['user_id']}}]" <?php 
                              if(in_array($mycustomer->orderDetails['user_id'],$present)){
                                echo "checked";}  ?>   >
                              <label class="custom-control-label" for="todo-{{$index+1}}"></label>
                            </div>
                          </td>
                          <td class="text-primary sorting_1">
                            <img src="{{asset('images/user/'.$mycustomer->orderDetails['userDetail']['image'])}}" width="40" class="rounded-circle">
                          </td>
                          <td>{{$mycustomer->orderDetails['userDetail']['name']}}</td>
                          <td>
                          {{$mycustomer->orderDetails['userDetail']['email']}}
                          </td>
                          <td class="text-center"><?php 
                              if(in_array($mycustomer->orderDetails['user_id'],$present)){
                                echo '<span class="badge badge-info">Present</span>';}else{
                                  echo '<span class="badge badge-warning">Absent/Not Taken</span>';
                                }  ?></td>
                        </tr>
                        @endforeach
                        
                          
                       
                      
                      </tbody>
                    </table>
                  </div>
                  <button class="btn btn-primary" type="submit">Mark Attendance</button>
                </fieldset>
               </form>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    @include('admins.footer')
    <!-- partial -->
  </div>
  <!-- main-panel ends -->
</div>

@endsection
