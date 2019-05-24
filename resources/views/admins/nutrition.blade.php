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
                <div class="card-header"><b>Nutrition Schedule List</b>

                   
                   <div class="float-right"> <a href="{{ route('assignNutritions') }}" class="btn btn-primary">Add Nutrition Schedule</a></div><br/><br/>
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
                <tr>
                  <th>#</th>
                        <th>Member Name</th>
                        <th>Week Days</th>
                        <th>Nutritions</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Option</th>
                </tr>
                </thead>
                <tbody>
                 @foreach($mynutritions as $index=>$nutrition)
                    <?php $nutritions=json_decode($nutrition->nutritions); 
                    $days=json_decode($nutrition->week_days);
                           ?>
                    <tr>
                      <td>{{$index+1}}</td>
                        <td>{{$nutrition->userDetail->name}}</td>
                        <td>
                            @foreach($days as $day)
                              <span>{{$day}}</span><br/>
                            @endforeach
                        </td>
                        <td>
                          @foreach($nutritions as $key=>$val)
                            <b>{{$key}} ::</b> {{$val}}<br/>
                          @endforeach
                        </td>
                        <td>{{$nutrition->start_date}}</td>
                        <td>{{$nutrition->end_date}}</td>
                        <td><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" class="btn btn-primary" onclick="deleteNutrition({{$nutrition->id}})">
                          <i class="mdi mdi-delete"></i>Delete
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

         
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        @include('admins.footer')
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
<!-- END PAGE LEVEL SCRIPTS -->     
<script type="text/javascript">
  function deleteNutrition(id)
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
          url: "{{route('deleteAssignNutritions')}}",
          type: "POST",
          data: {nutrition_id: id,_token: "{{ csrf_token() }}"}, 
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


