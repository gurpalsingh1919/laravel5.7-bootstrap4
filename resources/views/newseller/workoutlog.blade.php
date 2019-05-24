@extends('layouts.newseller-app')
@section('content') 
<!--  BEGIN CONTENT PART  -->
<div id="content" class="main-content">
  <div class="container">
    <div class="page-header">
      <div class="page-title">
          <h3><i class="flaticon-notes-4 mr-2"></i>Workout Management</h3>
      </div>
    </div>
    <div class="row layout-spacing" id="cancel-row">
      <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="statbox widget box box-shadow">
          <div class="widget-header">
            <div class="row">
              <div class="col-xl-12 col-md-12 col-sm-12 col-12 ">
                <div class="border-bottom d-flex justify-content-between">
                    <div><h4><i class="flaticon-notes-4 mr-1"></i> Workout List</h4></div>
                    <div class="pt-3"> <a href="{{ route('assignWorkoutnewUser') }}" class="btn btn-primary">Assign Workout</a></div>
                </div>
              </div>
            </div>
          </div>
          <div class="widget-content widget-content-area">
            <div class="table-responsive mb-4">
              <table id="html5-extension" class="table table-striped table-hover table-bordered" style="width:100%">
               <thead>
                <tr>
                  <th>#</th>
                        <th>Member Name</th>
                        <th>Description</th>
                        <th>Week Days</th>
                        <th>Workout details</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Option</th>
                </tr>
                </thead>
                <tbody>
                 @foreach($myworkouts as $index=>$workout)
                    <?php $workouts=json_decode($workout->workouts); 
                    $days=json_decode($workout->week_days);
                           ?>
                    <tr>
                      <td>{{$index+1}}</td>
                        <td>{{$workout->userDetail->name}}</td>
                        <td>{{$workout->description}}</td>
                        <td>
                            @foreach($days as $day)
                              <span>{{$day}}</span><br/>
                            @endforeach
                        </td>
                        <td>
                          @foreach($workouts as $key=>$val)
                            <b>{{$key}} ::</b>
                              @foreach($val as $valk=>$values)
                                {{$valk}}  {{$values}} ,
                              @endforeach
                             <br/>
                          @endforeach
                        </td>
                        <td>{{$workout->start_date}}</td>
                        <td>{{$workout->end_date}}</td>
                        <td><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" onclick="deleteWorkouts({{$workout->id}})">
                          <i class="flaticon-delete  bg-danger p-1 text-white br-6 mb-1"></i>
                        </a></td>
                    </tr>
                    @endforeach    
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- END PAGE LEVEL SCRIPTS -->     
<script type="text/javascript">
  function deleteWorkouts(id)
  {
        Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      console.log(result)
      if (result.value) {
         $.ajax({
          url: "{{route('deleteAssignWorkouts')}}",
          type: "POST",
          data: {workout_id: id,_token: "{{ csrf_token() }}"}, 
          success: function(res)
          { //console.log(res);
            //console.log(res.status);
            if(res.status=='success')
            {
                Swal.fire(
                'Deleted!',
                res.message,
                'success'
              )
              location.reload(true);
            }
            else
            {
                 Swal.fire(
                'Error!',
                res.message,
                'error'
              )
            }
          }});
        }
      })
   }
</script>     
@endsection

