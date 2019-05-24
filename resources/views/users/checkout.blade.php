@extends('layouts.users-app')

@section('content')
	<style>
		body{
			background:#e9ecee
		}
	</style>
	  <?php $total = 0; $items=session('cart');
		$settings=session('settings');
//echo "<pre>";print_r($items);die;
   ?>
	<div class="container pt-5">
	<div class="row"> 
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
     <div class="col-md-8">
	 
	 	@if (!Auth::check())
	 	<div class="mb-4">
		<div class="border-left stickyborder"></div>

			<div class="address-icon">
				<i class="fas fa-user"></i>
			</div> 

			<div class="card-body p-5">
				<div class="d-flex justify-content-between">
				<div class="col-md-9">
				<h3>Account</h3>
				<div class="mt-3">
					<button type="button" onclick="getAuthview('login')" class="btn border-orange border-radius-none p-3 text-center">
						<small>Have an account?</small><br/>Log in
					</button>
					<button type="button" onclick="getAuthview('register')" class="btn btn-primary border-radius-none p-3 text-center">
						<small>New to NearGym?</small><br/>	Sign Up
					</button><br/><br/>
					<!-- <p>To place your order now, log in to your existing account or sign up.</p> -->
					
				</div>
			</div>
				<div class="col-md-3">
					<img src="{{asset("fontend/images/gymicon1.png")}}" class="img-fluid" />
			</div> 
			</div> 
				 @if($errors->all())
		                @foreach ($errors->all() as $error)
		                  <div class="alert alert-danger">{{ $error }}</div>
		                @endforeach
		              @endif
		             
			<div class="login mt-3">
				<form action="{{route('sellerLoginPost')}}" class="user-signup" method="post" >
					 @csrf
				  <div class="form-group">
					<label for="email">Email:</label>
					<input type="text" name="email" class="form-control col-md-12" >
					 @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                      @endif
				  </div>
				  <div class="form-group">
					<label for="pwd">Password:</label>
					<input type="password" name="password" class="form-control col-md-12" >
					 @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                      @endif
				  </div>
				  <input type="hidden" name="panel" value="1">
				  <div class="form-group form-check">
					<label class="form-check-label">
					  <input class="form-check-input" type="checkbox"> Remember me
					</label>
				  </div>
				  <button type="submit" class="btn btn-primary">Login</button><br/><br/><br/>
				 <div class="form-group">
				  	
					<a class="btn btn-facebook btn-block text-uppercase col-md-6" href="{{ url('/auth/facebook') }}">
					<i class="fab fa-facebook-f mr-2"></i> Sign in with Facebook</a>
					<a  class="btn btn-google btn-block text-uppercase col-md-6" href="{{ url('/auth/google') }}">
					<i class="fab fa-google mr-2"></i> Sign in with Google</a>
					</div>
				</form>
			</div>
			<div class="register mt-3">
				<form action="{{route('usersignup')}}" method="post" class="user-signup">
					 @csrf
				  <div class="form-group">
					<label for="name">Name:</label>
					<input type="text"  name="name" class="form-control col-md-12" >
					 @if ($errors->has('name'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                      @endif
				  </div>
				    <div class="form-group">
					<label for="email">Phone:</label>
					<input type="number" name="phone_no" class="form-control col-md-12" >
					 @if ($errors->has('phone_no'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('phone_no') }}</strong>
                        </span>
                      @endif
				  </div>
				  <div class="form-group">
					<label for="email">Email:</label>
					<input type="Email" name="email" class="form-control col-md-12" >
					 @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                      @endif
				  </div>
				  <div class="form-group">
					<label for="pwd">Password:</label>
					<input type="password" name="password" class="form-control col-md-12" >
					 @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                      @endif
				  </div>
				  <div class="form-group">
					<label for="pwd">Confirm Password:</label>
					<input type="password" name="confirm-password" class="form-control col-md-12" >
					 @if ($errors->has('confirm-password'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('confirm-password') }}</strong>
                        </span>
                      @endif
				  </div>
				  <div class="form-group form-check">
					<label class="form-check-label">
					  <input class="form-check-input" type="checkbox"> Remember me
					</label>
				  </div>
				  <button type="submit" class="btn btn-primary">Submit</button>

				</form>
				 </div>

			</div>

			
		</div>
		@endif

		<div class="card">
			<div class="border-left stickyborder"></div>

			<div class="address-icon">
				<i class="fab fa-paypal"></i>
			</div> 

			<div class="card-body p-5">
				<h3>Payment</h3>
				<div class="row">
					<img src="{{asset('icons/paypal.png')}}" class="img-fluid">
				</div>
				
				<div class="mt-3"> <!-- * To pay using PayPal as your payment, simply proceed to checkout as usual by clicking the pay now button. <br/> -->
					* You will be redirected to paypal to complete your purchase securely.
				</div>
			</div>
		</div>



    </div>
	  <div class="col-md-4">
		<div class="card-body">
			<div class="media">
				<?php $gym_imagess=explode('|', $gym_detail[0]->gym_images); ?>
				@if($gym_detail[0]->seller_type=='2')
				 	<img src="{{ asset('/images/user/'.$gym_detail[0]->user->image) }}" alt="{{$gym_detail[0]->gym_name}}" class="mr-3" style="width:100px;height: 100px"   />
			    @else
			    	 @foreach($gym_imagess as $index=>$image)
			        @if($index==0)
			        <img src="{{ asset('/gyms') }}/{{$image}}" alt="{{$gym_detail[0]->gym_name}}" class="mr-3" style="width:100px;height: 100px"   />
			        @endif
			      @endforeach
			    @endif
			  <div class="media-body">
				<h4>{{ucfirst($gym_detail[0]->gym_name)}}</h4>
				<p>{{$gym_detail[0]->gym_address.','.$gym_detail[0]->zip.', '.$gym_detail[0]->city}}, </p>
			  </div>
			</div>
			
			<div class="cartvalue">
				 <?php $total = 0 ?>
            @if( session('cart') && count(session('cart')) > 0)
             @foreach(session('cart') as $item)   
                 <?php $total += $item['price'] * $item['quantity'] ?>
                 <legend  class="w-auto pl-2 pr-2 mt-2 mb-0 small badge-primary">Starting from {{$item['start_from']}}</legend>
				<div class="cartoption border-bottom">

					<div class="l_cart">
						<div class="deleteitem remove-from-cart" data-id="{{ $item['pack_id'] }}">
							<a href="#"><i class="fas fa-times-circle"></i></a>
						</div>
						<div class="cartitem"><b>{{$item['name']}}</b>  <br/>  {{$item['membership']}}</div>
						
					</div>
					<div class="r_cart">
						<div class="r_cart_inner">
							<!-- <div class="option_no">
							<input type="number" value="1" class="form-control" />
							</div> -->
							<div class="option_price"><b>{{$item['quantity']." X "}} {{'₹ '.number_format((float)$item['price'], 2, '.', '')}}</b></div>
						</div>
					</div>
				</div>
				@endforeach
				@endif
				<?php //$maintenace="30.00";?>
			</div>
			
			<br/>
			
			 
			<div class="justify-content-between d-flex pb-3 mb-4">
				<div class="item_total"><b>Total</b></div>
				<div class="item_total"><b>{{'₹ '.number_format((float)$total, 2, '.', '')}}</b></div>
			</div>
			
			@if (Auth::check())
			<form method="post" action="{{route('create-payment')}}">
				{{ csrf_field() }}
				<input type="hidden" name="amount" value="{{$total}}">
				<button type="submit" class="btn-primary btn text-uppercase btn-block">Pay Now</button>
			</form>
			@endif

		</div>
      </div>
	</div>
  </div>
  @include('users.footer')

 <script type="text/javascript">
  	
$(document).ready(function(){

  // Activate Carousel
  $("#myCarousel").carousel();
 
  // Enable Carousel Controls
  $(".carousel-control-prev").click(function(){
    $("#myCarousel").carousel("prev");
  });
  $(".carousel-control-next").click(function(){
    $("#myCarousel").carousel("next");
  });
});

			var getview= sessionStorage.getItem("view");
			//alert(getview);
			if(sessionStorage.getItem("view")=='register')
			{
					$('.register').show();
					$('.login').hide();
			}
			else
			{
				$('.register').hide();
				$('.login').hide();
			}
			
			//$(document).ready(function(){
				sessionStorage.setItem("view", "login");
			  function getAuthview(view)
			  {
			  	if(view=='register')
			  	{
			  		$('.register').show();
					$('.login').hide();
					sessionStorage.setItem("view", "register");

			  	}
			  	else
			  	{
			  		$('.register').hide();
					$('.login').show();
			  	}

			  }
			//});
		</script>
@endsection('content')
 