@extends('layouts.users-app')

@section('content')
<!-- $id = Auth::user()->id; -->
<div class="container mt-5">
<div class="row">
@include('users.left-sidebar')
<div class="col-md-9">
<div class="card">
  <div class="card-body">
      <h3 class="mb-4">Order History</h3>
      <br/>
         
  @if(count($result_allOrder) >0)
      <table class="table table-hover  small">
          <thead>
          <tr >
              <th scope="col">Gym/Trainer Name</th>
              <th scope="col">Date of Purchase</th>
              <th scope="col">Amount</th>
              <th scope="col">Status</th>

          </tr>
          </thead>
          <tbody >
         
              @foreach($result_allOrder as $index=>$order)
                  <tr data-toggle="collapse" data-target="#collapse_{{$index}}" aria-expanded="true" aria-controls="collapseOne">
                      
                      <th>{{ucfirst($order->gymdetail->gym_name)}}</th>
                      <td>{{$order->created_at}}</td>
                      <td>{{'₹ '.number_format((float)$order->net_payment, 2, '.', '')}}</td>
                      <td>@if($order->status=='1')
                          {{ __('Success') }}
                          @elseif($order->status=='0')
                          {{__('Pending')}}
                          @else($order->status=='2')
                          {{__('Fail')}}
                          @endif
                         <!--  <a href="{{url('profile/order/'.$order->id)}}">more</a> -->
                      </td>

                  </tr>
                  <tr>
                      <td colspan="4" class="p-0">

                          <div id="collapse_{{$index}}" class="collapse" aria-labelledby="headingOne" >
                              <div class="card-body" style="background: #fff">
                               <div class="media">
                                   <?php $gym_imagess=explode('|', $order->gymdetail->gym_images);  ?>
                                <!-- <img src="{{asset('/gyms/'.$order->gymdetail->gym_images)}}" alt="{{$order->gymdetail->gym_name}}" class="mr-3" style="width:150px;"> -->
                              @if($order->gymdetail->seller_type=='1')  
                                 @foreach($gym_imagess as $index=>$image)
                                  @if($index==0)
                                  <img src="{{ asset('/gyms') }}/{{$image}}" alt="{{$order->gymdetail->gym_name}}" class="mr-3" style="width:150px;"  />
                                  @endif
                                  @endforeach
                              @elseif($order->gymdetail->seller_type=='2')
                                   <img src="{{ asset('/images/user/'.$order->gymdetail->user->image) }}" alt="{{$order->gymdetail->gym_name}}" class="mr-3" style="width:150px;"  />
                              @endif
                                <div class="media-body">
                                  @if($order->gymdetail->gym_name)
                                  <h4>{{$order->gymdetail->gym_name}}</h4>
                                  @endif

                                  <p>{{$order->gymdetail->gym_address .', '. $order->gymdetail->city .', '.$order->gymdetail->zip}}</p>
                                </div>
                              </div>

                              <?php $orderdetail=$order->orderDetail;

                              //echo "<pre>";print_r($orderdetail);die;
                               ?>
                          <div class="cartvalue mt-3"> 
                              @foreach($orderdetail as $packdetail)

                          <?php $yrdata= strtotime($packdetail->start_from);
                                
                           ?>
                          <legend  class="w-auto pl-2 pr-2 mt-2 mb-0 small badge-primary">Starting from {{date("F jS, Y",$yrdata)}}</legend>
                              <div class="cartoption border-bottom d-flex justify-content-between">
                                  <div class="l_cart">
                                     <?php  $duration='';
                                     if(isset($packdetail->membershipDetails->duration)){
                                      $duration=PackagetoPrice::get_duration_fullname($packdetail->membershipDetails->duration);
                                     }
                                     ?>
                                      <div class="cartitem"><b>{{$packdetail->packageDetails->title}} </b><br/>{{$duration}}</div>
                                      
                                  </div>
                                  <div class="r_cart">
                                      <div class="r_cart_inner">
                                          
                                          <div class="option_price">
                                            {{$packdetail->quantity." X "}} {{'₹ '.number_format((float)$packdetail->user_amount, 2, '.', '')}}</div>
                                      </div>
                                  </div>

                              </div>
                              @endforeach
                          </div>
                                  <br>
                                
                                  <div class="justify-content-between d-flex">
                                      <div class="item_total"><b>Total</b></div>
                                      <div class="item_total"><b>{{'₹ '.number_format((float)$order->net_payment, 2, '.', '')}}</b></div>
                                  </div><a href="http://localhost/gym/public/check-out">
                                  

                          </div>
                          </div>
                      </td>
                  </tr>
              @endforeach
         

          </tbody>
      </table>
   @else
        <p class="no-order-yet">
              <h4>
                  <i class="fab fa-first-order"></i>
                   {{__("You don't have order yet")}}
              </h4>
          </p>   
             
  @endif


  </div>
</div>

</div>

</div>
</div>


@include('users.footer')

@endsection('content')

