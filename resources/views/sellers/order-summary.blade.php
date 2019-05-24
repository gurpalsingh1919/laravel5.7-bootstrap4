@extends('layouts.sellers-app')

@section('content')
    <div class="container-fluid page-body-wrapper">
    @include('sellers.sidebar')
    <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="card mb-5" style="min-height: inherit">
                    <div class="card-header"><b>Order Detail</b></div>
                    <div class="card-body pl-0">

                        <table class="table table-borderless p-0">
                            <tr>
                                <td><strong class="d-block mb-2">Order ID:</strong> <span>#{{$orderdetail[0]->id}}</span></td>
                                <td><strong class="d-block mb-2">Date Added:</strong> <span>{{$orderdetail[0]->created_at}}</span></td>
                                <td><strong class="d-block mb-2">Payment Method:</strong> <span>Paypal</span></td>
                                <td><strong class="d-block mb-2">Payment ID:</strong> <span>{{$orderdetail[0]->payment_id}}</span></td>
                            </tr>
                        </table>


                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-5" style="min-height: inherit">
                            <div class="card-header"><b>Seller Detail</b></div>
                            <div class="card-body pl-0"><b>{{$orderdetail[0]->gymdetail->gym_name}}</b><br/>
                                {{$orderdetail[0]->gymdetail->gym_address.' , '.$orderdetail[0]->gymdetail->city.' , '.$orderdetail[0]->gymdetail->zip}}

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-5" style="min-height: inherit">
                            <div class="card-header"><b>User Detail</b></div>
                            <div class="card-body pl-0"><b>{{$orderdetail[0]->userDetail->name}}</b><br/>
                                {{$orderdetail[0]->userDetail->email}}<br/>
                                {{$orderdetail[0]->userDetail->phone_no}}
                            </div>
                        </div>
                    </div>
                </div>




                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Product Name</th>
                                    <!-- <th>Model</th> -->
                                    <th class="text-right">Quantity</th>
                                    <th class="text-right">Price</th>
                                    <th class="text-right">Total</th>

                                </tr>
                                @foreach($orderdetail[0]->orderDetail as $order)
                                <tr>
                                    <td>{{$order->packageDetails->title}}</td>
                                    <td class="text-right">{{$order->quantity}}</td>
                                    <td class="price text-right"><span>{{$order->amount}} INR</span></td>
                                    <td class="price text-right"><span>{{$order->sub_total}} INR</span></td>

                                </tr>
                                @endforeach
                                <tr>

                                    <td colspan="3" class="price text-right"><strong>Subtotal</strong></td>
                                    <td class="price text-right"><span>{{$orderdetail[0]->seller_amount}} INR</span></td>

                                </tr>
                              <!--  <tr>

                                    <td colspan="3" class="price text-right"><strong>Tax IGST</strong></td>
                                    <td class="price text-right"><span>{{$orderdetail[0]->tax}} INR</span></td>

                                </tr>
                                <tr>

                                    <td colspan="3" class="price text-right"><strong>Maintenance Charge</strong></td>
                                    <td class="price text-right"><span>{{$orderdetail[0]->maintence_charges}} INR</span></td>

                                </tr>
                                <tr>

                                    <td colspan="3" class="price text-right"><strong>Service Charge</strong></td>
                                    <td class="price text-right"><span>{{$orderdetail[0]->service_charges}} INR</span></td>

                                </tr>
                                <tr>

                                    <td colspan="3" class="price text-right"><strong>Admin comission</strong></td>
                                    <td class="price text-right"><span>{{$orderdetail[0]->admin_comission}} INR</span></td>

                                </tr> -->
                                <tr>

                                    <td colspan="3" class="alert-warning border-0 price text-right"><h4>Grand Total</h4></td>
                                    <td class=" alert-warning border-0 price text-right"><h4>{{$orderdetail[0]->seller_amount}} INR</h4></td>

                                </tr>
                            </table>
                        </div>



            </div>


            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
        @include('sellers.footer')
        <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>

@endsection
