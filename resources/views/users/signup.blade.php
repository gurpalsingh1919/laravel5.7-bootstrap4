@extends('layouts.users-app')

@section('content')
	<!-- content start here -->
	<div class="container pt-5">
		<div class="row equal outer">
			<div class="col-md-6 text-center pt-4 align-self-center">
				<div class="gym-icon"> <i class="fas fa-dumbbell"></i></div>
				<br/>
				<h3 class="mb-4">Not A Member Yet?</h3>
				<p>Those who do not find time for exercise will have to find time for illness.</p>

				<br/>
				<h5 class="text-uppercase">Already Have an account !</h5>
				<p class="text-center"> <a class="btn btn-primary" href="{{route('signin')}}">Signin Now</a></p>

				<br/>
			</div>
		  <div class="col-md-6">
			<div class="card">
				<div class="card-body p-5">
					<div class="text-center mb-4">
					<h3 class="text-uppercase mb-3">Regiser</h3>
					<p>Please enter your detail</p>
					
					</div>
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
					<form method="post" class="user-signup" action="{{route('usersignup')}}" enctype="multipart/form-data">
						 @csrf
					<div class="d-flex justify-content-center">
						<div class="col-lg-10 col-md-8">
						 <div class="form-group">
							<input type="text" class="form-control" name="name" placeholder="Name" value="{{ old('name') }}" required autofocus>
							 @if ($errors->has('name'))
		                        <span class="invalid-feedback">
		                            <strong>{{ $errors->first('name') }}</strong>
		                        </span>
		                      @endif
						 </div>
						  <div class="form-group">
							<input type="number" name="phone_no" class="form-control" placeholder="Phone number" value="{{ old('phone_no') }}" required autofocus>
							 @if ($errors->has('phone_no'))
		                        <span class="invalid-feedback">
		                            <strong>{{ $errors->first('phone_no') }}</strong>
		                        </span>
		                      @endif
						 </div>
						  <div class="form-group">
							<input type="email" name="email" class="form-control" id="email" placeholder="Email Address" value="{{ old('email') }}" required autofocus>
							 @if ($errors->has('email'))
		                        <span class="invalid-feedback">
		                            <strong>{{ $errors->first('email') }}</strong>
		                        </span>
		                      @endif
						 </div>
						<div class="form-group">
							<input type="password" name="password" class="form-control" id="password" placeholder="Password" required autofocus>
							 @if ($errors->has('password'))
		                        <span class="invalid-feedback">
		                            <strong>{{ $errors->first('password') }}</strong>
		                        </span>
		                      @endif
						</div>
						<div class="form-group">
							<input type="password" name="confirm-password" class="form-control" placeholder="Confirm Password" required autofocus>
							 @if ($errors->has('confirm-password'))
		                        <span class="invalid-feedback">
		                            <strong>{{ $errors->first('confirm-password') }}</strong>
		                        </span>
		                      @endif
						</div>
						<input type="hidden" name="roles" value="9">
						<button type="submit" class="btn btn-primary">Register now</button>
						<hr/>
						<p class="text-center">Not Register Yet! <a href="{{route('signin')}}">Login  Now</a></p>
						<hr/>
						<a  class="btn btn-google btn-block text-uppercase" href="{{ url('/auth/google') }}">
						<i class="fab fa-google mr-2"></i> Sign in with Google</a>
						<a class="btn btn-facebook btn-block text-uppercase" href="{{ url('/auth/facebook') }}">
						<i class="fab fa-facebook-f mr-2"></i> Sign in with Facebook</a>
						
						</div>
					</div>
				</form>
				</div>
			</div>
		  </div>
		  
		
		</div>
  </div>
  @include('users.footer')

  <script>
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
</script>

@endsection('content')
 