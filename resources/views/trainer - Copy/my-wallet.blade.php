@extends('layouts.trainer-app')
<link rel="stylesheet" href="{{url('css/responsive.dataTables.css')}}">
<link rel="stylesheet" href="{{url('css/buttons.dataTables.min.css')}}">
@section('content')
 <div class="container-fluid page-body-wrapper">
     @include('trainer.sidebar')
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-6">
                    <div class="card mt-5" style="min-height: auto;">
                        <div class="card-body text-center p-5">
                            <div class="d-flex justify-content-between">
                                <h2>Total Earning</h2>

                                <h1 class="orange">{{number_format((float)$totalSale, 2, '.', '')}}<span class="small ">INR</span></h1>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mt-5" style="min-height: auto;">
                        <div class="card-body text-center p-5">
                            <div class="d-flex justify-content-between">
                                <h2>Pending Amount</h2>

                                <h1 class="orange">{{number_format((float)$sellerPendingAmount, 2, '.', '')}} <span class="small ">INR</span></h1>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <br/>
            <br/>


          <div class="row">
            <div class="col-sm-12">
              <div class="card">
              <div class="card-body">
                <h4>{{__('My Wallet Transactions')}}</h4>
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

                 

                   <table id="users-table" class="display responsive nowrap" width="100%">
                                <thead>
                                <th>Sr.</th>
                                <th>Payment Id</th>
                                <th>Customer Name</th>
                                <th>Purchase Date</th>
                                <th>Amount</th>
                                <th>Status</th>
                                </thead>
                                <tbody>
                                @foreach($myOrders as $index=>$order)
                                <tr>
                                    <td> {{$index+1}}</td>

                                     <td>{{$order->payment_id}}</td>
                                    <td>{{$order->userDetail->name}}</td>
                                   
                                   
                                    <td>{{ Carbon\Carbon::parse($order->created_at)->format('Y m d') }}</td>
                                     <td>{{ $order->seller_amount  }}</td>
                                   <td>
                                     @if($order->seller_payment_status==1)
                                           <span class="badge badge-success">Paid</span>
                                     @elseif($order->seller_payment_status==2)
                                           <span class="badge badge-danger"> Fail</span>
                                     @else
                                           <span class="badge badge-warning">Pending</span>
                                     @endif
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


        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        @include('trainer.footer')
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
