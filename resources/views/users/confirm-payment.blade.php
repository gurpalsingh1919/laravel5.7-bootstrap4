@extends('layouts.users-app')

@section('content')
<!-- $id = Auth::user()->id; -->
<div class="container mt-5">
  <div class="row">
    @include('users.left-sidebar')
 
    <div class="col-md-9">
  	 <div class="col-md-12">
      @if(session('error')) 
        <div class="error alert alert-danger alert-dismissable">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Error : </strong>   {{ session('error') }}
        </div>
        <script type="text/javascript">
          Swal({
              type: 'info',
              title: "Sorry!!!",
              text: "{{ session('error') }}",
              //footer: '<a href>Why do I have this issue?</a>'
            })
        </script>
      @endif
      @if(session('success')) 
      <div class="error alert alert-success alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      {!! session('success') !!}

      </div>
       <script type="text/javascript">
        Swal(
          'Good job!',
          "{{ session('success') }}",
          'success'
        )
      </script>
      @endif
    </div> 
      <div class="card">
        <div class="card-body">
          <h3 class="mb-4">Order Detail</h3>
          <br/>
          <table class="table table-hover  small">
            <tbody >
              @foreach($result_allOrder as $index=>$order)
                <tr>
                  <td colspan="4" class="p-0">
                    <div>
                      <div class="card-body" style="background: #fff">
                        <div class="media"><?php 
                          $gym_imagess=explode('|', $order->gymdetail->gym_images);  ?>
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
                              <h4>{{ucfirst($order->gymdetail->gym_name)}}</h4>
                              <p>{{$order->gymdetail->gym_address .', '. $order->gymdetail->city .', '.$order->gymdetail->zip}}</p>
                            </div>
                        </div>
                        <?php $orderdetail=$order->orderDetail; ?>
                        <div class="cartvalue mt-3"> 
                          @foreach($orderdetail as $packdetail)
                          <?php $yrdata= strtotime($packdetail->start_from);
                                
                           ?>
                          <legend  class="w-auto pl-2 pr-2 mt-2 mb-0 small badge-primary">Starting from {{date("F jS, Y",$yrdata)}}</legend>
                            <div class="cartoption border-bottom d-flex justify-content-between">
                              <div class="l_cart">
                                <?php $duration=PackagetoPrice::get_duration_fullname($packdetail->membershipDetails->duration);?>
                                 <div class="cartitem"><b>{{ ucfirst($packdetail->packageDetails->title) }} </b><br/>{{$duration}}</div>
                                  
                              </div>
                              <div class="r_cart">
                                  <div class="r_cart_inner">
                                      
                                      <div class="option_price">{{$packdetail->quantity." X "}} {{'₹ '.number_format((float)$packdetail->user_amount, 2, '.', '')}}</div>
                                  </div>
                              </div>
                            </div>
                          @endforeach
                        </div>
                        <br>
                        <div class="justify-content-between d-flex">
                          <div class="item_total"><b>Total</b></div>
                          <div class="item_total"><b>{{'₹ '.number_format((float)$order->net_payment, 2, '.', '')}}</b></div>
                        </div><!-- <a href="http://localhost/gym/public/check-out"> -->
                      </div>
                    </div>
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


@include('users.footer')

@endsection('content')

