@extends('layouts.admin-app')

@section('content')
 <div class="container-fluid page-body-wrapper">
     @include('admins.sidebar')
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
         
          <div class="row">
            <div class="col-sm-12">
              <div class="card">
                <div class="card-header"><b>Business Detail</b>
                   <div class="float-right">
                      <a href="{{ route('getAllStores') }}" class="btn btn-primary editseller">Stores List</a>
                    </div>
                    
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
              <div class="card-body pl-0 pr-0">
                <b>About:</b><br/>
                <p>{{$storeDetail->gym_description}}</p>
                  <br/>
                  <div class="row">
                    <div class="col-md-6">
                      <table class="table table-bordered">
                         <tr>
                          <th>Gym Name:</th>
                          <td>{{$storeDetail->gym_name}}</td>
                      </tr>
                      <tr>
                          <th>Business Name:</th>
                          <td>{{$storeDetail->business_name}}</td>
                      </tr>
                      <tr>
                          <th>Business URL:</th>
                          <td>{{$storeDetail->business_url}}</td>
                      </tr>
                     <tr>
                          <th>Status:</th>
                          <td> @if($storeDetail->store_status==1)
                           <span class="badge badge-info badge-pills">Approved</span>
                        @elseif($storeDetail->status==3)
                          <span class="badge badge-secondary badge-pills">Requested</span>
                        @elseif($storeDetail->status==2)
                          <span class="badge badge-primary badge-pills">Pending</span>
                        @else
                          <span class="badge badge-warning badge-pills">Inactive</span>
                        @endif</td>
                      </tr>

                      </table>
                      
                    </div>
                    <div class="col-md-6">
                      <table class="table table-bordered">                      
                      
                      <tr>
                        <th>Business Category:</th>
                        <td> {{$storeDetail->business_category}}</td>
                      </tr>
                       <tr>
                        <th>Business type:</th>
                        <td> @if($storeDetail->business_type=='1')
                                {{'Professional'}}
                              @else
                                {{'Business'}}
                              @endif
                        </td>
                      </tr>
                   </table>
                </div>
              </div> 
              <hr/>
              <div class="row ml-4">
                @if($storeDetail->store_status ==3 || $storeDetail->store_status ==4)
                  <input class="btn btn-primary float-right status" value="Approve" />
                @elseif($storeDetail->store_status ==1)
                  <input class="btn btn-warning  float-right status" value="Dispprove" />
                @endif
              </div>
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
<script type="text/javascript">
   $('.status').click( function() {
         Swal.fire({
        title: 'Loading Please Wait',
       onBeforeOpen: () => {
          Swal.showLoading()
         
        }
      })
    var store_id='{{$storeDetail->id}}';
    var status=$('.status').val();
    //console.log(store_id+'--'+status)
    var updatestatus=4;
    if(status=='Approve' || status=='Activate')
    {
      updatestatus=1;
     
    }
    $.ajax({
              type: 'POST',
              url: "{{url('admin/change-store-status')}}",
              data: { update_status:updatestatus,id:store_id,_token:"{{csrf_token()}}" },
              success:  function(response)
              {
                  console.log(response);
                   Swal(
                        'Good job!',
                        response.message,
                        'success'
                      )
                  
                 window.setTimeout(function(){location.reload()},3000)
              }
            });
});
</script> 
@endsection
