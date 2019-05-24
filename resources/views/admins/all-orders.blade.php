@extends('layouts.admin-app')
@section('content')
 <div class="container-fluid page-body-wrapper">
     @include('admins.sidebar')
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <form method="get" action="">
          <div class="row">

               <!-- <div class="row"> -->
             <div class="form-group col-md-3">
                    <label class="label">{{ __('Select a Gym') }}</label>
                    <div class="input-group">
                       
                       <select name="seller" class="form-control" >
                        <option value="0">All</option>
                        @foreach($Sellers as $Seller)
                         <option value="{{$Seller->id}}" 
                          {{app('request')->input('seller') ==$Seller->id?'selected':''}}>{{$Seller->gym_name}}</option>
                         @endforeach
                       </select>
                      
                    </div>
                  </div>
                  <div class="form-group col-md-2">
                    <label class="label">{{ __('Select a customer') }}</label>
                    <div class="input-group">
                       
                       <select name="user" class="form-control">
                        <option value="0">All</option>
                        @foreach($users as $user)
                         <option value="{{$user->id}}" {{app('request')->input('user') ==$user->id?'selected':''}}>{{$user->name}}</option>
                         @endforeach
                       </select>
                      
                    </div>
                  </div>
                  <div class="form-group col-md-4">
                    <label class="label">{{ __('Select range') }}</label>
                    <div class="input-group">
                       
                      <input type="text" id="dom-id" name="daterange" 
                      value="{{app('request')->input('daterange')?app('request')->input('daterange'):Carbon\Carbon::now()->format('Y-m-d').' to '. Carbon\Carbon::now()->format('Y-m-d')}}" 

                      autocomplete="off" />

                      
                      
                    </div>
                  </div>
                  <div class="form-group col-md-3"><br/>
                    <button type="submit" class="btn btn-primary" >Submit</button>
                  </div>
                  <!-- </div> -->
                </form>

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
                                <th>Payment Id</th>
                                <th>Gym</th>
                                <th>Customer Name</th>
                                 <th>Status</th>
                                  <th>Option</th>
                                <th>Package Name | Qty</th>
                                <th>Purchase Date</th>
                               
                                <th>Sub total</th>
                                <th>Maintenance charge</th>
                                <th>Tax</th>
                                <th>Net Payment</th>
                               
                                </thead>
                                <tbody>
                                @foreach($allOrders as $index=>$order)
                                <tr>
                                    <td> {{$index+1}}</td>

                                     <td>{{$order->payment_id}}</td>
                                      <td> {{$order->gymdetail->gym_name}}</td>
                                    <td>{{$order->userDetail->name}}</td>
                                   <td>
                                     @if($order->status==1)
                                           <span class="badge badge-success">Success</span>
                                     @elseif($order->status==2)
                                           <span class="badge badge-danger"> Fail</span>
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
                                          <a class="dropdown-item" target="_blank" href="{{route('orderSummary',$order->id)}}">View</a>
                                          
                                        </div>
                                      </div>
                                   </td>
                                    <td>
                                    @foreach($order->orderDetail as $pack)
                                      <span>{{$pack->packageDetails->title}} | ({{$pack->quantity}})</span><br/>
                                    
                                    @endforeach
                                    </td>
                                    <td>{{ Carbon\Carbon::parse($order->created_at)->format('Y-m-d') }}</td>
                                   
                                   <td>{{$order->subtotal}}</td>
                                   <td>{{$order->maintence_charges}}</td>
                                   <td>{{$order->tax}}</td>
                                   <td>{{$order->net_payment}}</td>
                                   
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

@endsection
