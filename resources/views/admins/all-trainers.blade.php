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
                <div class="card-header"><b>{{$title}}</b>
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
              <div class="card-body">

                   <table id="admins-table" class="display responsive nowrap" width="100%" >
                                <thead>
                                <th>Sr.</th>
                                <th>Trainer Name</th>
                                <th>E-mail</th>
                                <th>Contact No</th>
                                <th>City</th>
                                
                                
                                <th>Experience</th>
                                <th>Status</th>
                                <th>Action</th>
                                <th>Address</th>
                                <th>Gender</th>
                                <th>Payment Mode</th>
                                 <th>Price</th>
                                
                                <th>Expertise</th>
                                <th>Area of Expertise</th>
                                </thead>
                                <tbody>
                                @foreach($trainers as $index=>$trainer)
                                <tr>
                                    <td> {{$index+1}}</td>
                                    <td>{{$trainer->user['name']}}</td>
                                    <td>{{$trainer->user['email']}}</td>
                                    <td>{{$trainer->user['phone_no']}}</td>
                                    <td>{{$trainer->city}}</td>
                                   
                                  
                                    <td>{{$trainer->experience}}</td>
                                     <td>
                                    @if($trainer->status==1)
                                     <span class="badge badge-success">Approved</span>
                                    @else
                                     <span class="badge badge-warning">Pending</span>
                                    @endif
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          Action
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                         <!--  <a class="dropdown-item" target="_blank" href="{{url('admin/trainer/'.$trainer->id)}}">View</a> -->
                                          <a class="dropdown-item" target="_blank" 
                                          href="{{url('admin/trainer/edit/'.$trainer->id)}}">Edit</a>
                                         
                                        </div>
                                      </div>
                                    <td>{{$trainer->gym_address .','.$trainer->zip}}</td>
                                    <td>@if($trainer->gender=='1')
                                          {{__('Male')}}
                                        @elseif($trainer->gender=='2')
                                          {{__('Female')}}
                                        @else{{__('Other')}}
                                        @endif
                                      </td>
                                    <td>@if($trainer->payment_mode=='1')
                                          {{__('Monthly')}}
                                        @elseif($trainer->payment_mode=='2')
                                          {{__('Hourly')}}
                                        @endif
                                    </td>
                                    <td>{{$trainer->price}}</td>
                                      <td>{{$trainer->expertise}}</td>
                                    <td>{{$trainer->type_of_expertise}}</td>



                                    </td>
                                  
                                   
                                </tr>
                                    @endforeach

                                </tbody>
                            </table>
                </div>
              </div>
            </div>
            
          </div>
         

       
        </div>
 <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script> -->
<script type="text/javascript">
   function approvetrainer(updatestatus,trainer_id)
    {
       $.ajax({
              type: 'POST',
              url: "{{url('admin/updateTrainer')}}",
              data: { update_status:updatestatus,id:trainer_id,_token:"{{csrf_token()}}" },
              success:  function(response)
              {
                  console.log(response);
                  window.location.reload();

                    Swal(
                  'Good job!',
                  message,
                  'success'
                )
                   

              }
            });
    }
 /*   $(document).ready(function(){
     
$('.status').click( function() {
   var status=$('.status').val();
   var trainer_id=$('.status').attr("trainer");
    console.log(trainer_id+'--'+status)
    var updatestatus=0;
     var message="You have sucessfully unapproved seller !!!";
    if(status=='Approve')
    {
      updatestatus=1;
      var message="You have sucessfully approved seller !!!";
    }
    $.ajax({
              type: 'POST',
              url: "{{url('admin/updateSeller')}}",
              data: { update_status:updatestatus,id:trainer_id,_token:"{{csrf_token()}}" },
              success:  function(response)
              {
                  console.log(response);
                  window.location.reload();

                    Swal(
                  'Good job!',
                  message,
                  'success'
                )
                   

              }
            });
});


  
})*/
</script>
         
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        @include('admins.footer')
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>

@endsection
