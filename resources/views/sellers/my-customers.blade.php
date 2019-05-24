@extends('layouts.sellers-app')

@section('content')
 <div class="container-fluid page-body-wrapper">
     @include('sellers.sidebar')
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
         
          <div class="row">
            <div class="col-sm-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                 <h4>{{__('Customers')}}</h4>
                 <hr/>
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
<div class="card-body">
                
              

                   <table id="users-table" class="display responsive nowrap" width="100%">
                                <thead>
                                <th>Sr.</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>E-mail</th>
                                <th>Contact No</th>
                                <th>Status</th>
                                </thead>
                                <tbody>
                                @foreach($myOrders as $index=>$order)
                                <tr>
                                    <td> {{$index+1}}</td>
                                     <td><img src="{{asset('images/user/'.$order->userDetail->image)}}" height="50" width="50" /></td>
                                    <td>{{$order->userDetail->name}}</td>
                                    <td>{{$order->userDetail->email}}</td>
                                    <td>{{$order->userDetail->phone_no}}</td>
                                    
                                    <td>
                                    @if($order->userDetail->status==1)
                                      <span class="badge badge-success">Verified</span>
                                    @else
                                     <span class="badge badge-warning">Unverified</span>
                                    @endif
                                    </td>
                                   <!-- <td>
                                     @foreach($order->orderDetail as $pack)
                                      <span>{{$pack->packageDetails->title}} | ({{$pack->quantity}})</span><br/>
                                    
                                    @endforeach
                                    </td>
                                    <td>{{ Carbon\Carbon::parse($order->created_at)->format('Y m d') }}</td> -->
                                   
                                </tr>
                                    @endforeach

                                </tbody>
                            </table>
                </div></div>
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
