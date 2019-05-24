@extends('layouts.trainer-app')

@section('content') 
<!--  BEGIN CONTENT PART  -->
<div id="content" class="main-content">
  <div class="container">
    <div class="page-header">
        <div class="page-title">
            <h3><i class="flaticon-cart-2 mr-2"></i>{{__('Orders history')}}</h3>
        </div>
    </div>
    <div class="row" id="cancel-row">
      <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="statbox widget box box-shadow">

          <div class="widget-header">
            <div class="row">
              <div class="col-xl-12 col-md-12 col-sm-12 col-12 ">
                <div class="border-bottom d-flex justify-content-between">
                  <div><h4> <i class="flaticon-package mr-2"></i>Order History</h4></div>
                  <!-- <div class="pt-3"> <a href="{{ route('salesExePackagesAdd') }}" class="btn btn-primary">Add New Package</a></div> -->
                </div>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-4"></div>
                <div class="col-md-8">
               <form method="get" action="">
                <label class="mb-2 mt-0">Sellect Customer</label>
                  <select name="customer"  class="selectpicker mb-2 ml-2" data-style="btn btn-outline-primary">
                      <option value="0">All</option>
                     @foreach($mycustomers as $user)
                     <option value="{{$user->userDetail->id}}" {{app('request')->input('customer') ==$user->id?'selected':''}}>{{$user->userDetail->name}}</option>
                     @endforeach
                  </select>
                 <button type="submit" class="btn btn-primary mb-4 ml-2 mt-2" data-style="btn btn-outline-success">
                     Submit
                  </button>

               </form></div>
               <!-- <div class="col-md-2"></div> -->
            </div>
          </div>

          <div class="widget-content widget-content-area">
            <div class="table-responsive mb-4">
              <table id="html5-extension" class="table table-striped table-bordered table-hover" style="width:100%">
                <thead>
                  <th>Sr.</th>
                  <th>Payment Id</th>
                  <th>Customer Name</th>
                  <th>Package Name | Qty</th>
                  <th>Purchase Date</th>
                  <th>Status</th>
                </thead>
                <tbody>
                @if(count($myOrders)>0)
                  @foreach($myOrders as $index=>$order)
                  <tr>
                    <td> {{$index+1}}</td>
                    <td>{{$order->payment_id}}</td>
                    <td>{{ucfirst($order->userDetail->name)}}</td>
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
                  </tr>
                  @endforeach
                @else
                  <tr><td colspan="6" class="align-center">No data available in table</td></tr>
                @endif 


                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--  END CONTENT PART  -->
@endsection