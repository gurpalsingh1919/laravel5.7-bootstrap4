@extends('layouts.newseller-app')

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
          </div>
        </div>
    <!--  END CONTENT PART  -->
@endsection