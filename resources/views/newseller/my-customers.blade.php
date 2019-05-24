@extends('layouts.newseller-app')

@section('content') 
    <!--  BEGIN CONTENT PART  -->
    <div id="content" class="main-content">
        <div class="container">
            <div class="page-header">
                <div class="page-title">
                    <h3><i class="flaticon-user-group mr-2"></i> {{__('My Customers')}}</h3>
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
                          <td>
                            <div class="d-flex">
                              <div class="usr-img-frame mr-2 rounded-circle">
                                   <img class="img-fluid rounded-circle" src="{{asset('images/user/'.$order->userDetail->image)}}"  />
                              </div>
                            </div>
                          </td>
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