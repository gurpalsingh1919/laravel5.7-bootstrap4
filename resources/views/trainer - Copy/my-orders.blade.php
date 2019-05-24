@extends('layouts.trainer-app')
@section('content')
 <div class="container-fluid page-body-wrapper">
     @include('trainer.sidebar')
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
         
          <div class="row">
            <div class="col-sm-12 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-header"><b>{{__('Orders')}}</b>
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

                   <table id="users-table" class="display responsive nowrap" width="100%">
                                <thead>
                                <th>Sr.</th>
                                <th>Payment Id</th>
                                <th>Customer Name</th>
                                <th>Package Name | Qty</th>
                                <th>Purchase Date</th>
                                <th>Status</th>
                                <!-- <th>Action</th> -->
                                </thead>
                                <tbody>
                                @foreach($myOrders as $index=>$order)
                                <tr>
                                    <td> {{$index+1}}</td>

                                     <td>{{$order->payment_id}}</td>
                                    <td>{{$order->userDetail->name}}</td>
                                   
                                    <td>
                                    @foreach($order->orderDetail as $pack)
                                      <span>{{$pack->packageDetails->title}} | ({{$pack->quantity}})</span><br/>
                                    
                                    @endforeach
                                    </td>
                                    <td>{{ Carbon\Carbon::parse($order->created_at)->format('Y m d') }}</td>
                                   <td>
                                     @if($order->status==1)
                                           <span class="badge badge-success">Success</span>
                                     @elseif($order->status==2)
                                           <span class="badge badge-danger"> Fail</span>
                                     @else
                                           <span class="badge badge-warning">Pending</span>
                                     @endif
                                   </td>
                                   <!-- <td>
                                     <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          Dropdown button
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                          <a class="dropdown-item" href="#">Action</a>
                                          <a class="dropdown-item" href="#">Another action</a>
                                          <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                      </div>
                                   </td> -->
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
        @include('sellers.footer')
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
  <script>

        $(function() {
          $('#users-table').DataTable({
              responsive: true,
             dom: 'Bfrtip',
              buttons: [
                  'copy', 'csv', 'excel', 'pdf', 'print'
              ]
            });
});

        </script>
        

       
@endsection
