@extends('layouts.sellers-app')

@section('content')
    <div class="auth register-bg-1 js">
        <div class="container pt-5 pb-5">
            <div class="pt-5 pt-5">
                <div class="col-md-12"><br/><br/></div>
                <div class="justify-content-center d-flex">
                <div class="col-md-8 text-center">
                    <h1 class="white">Are you a Trainer?<br/>
                    Make Near Gym work for you.
                    </h1>
                    <br/>
                    <h5 class="white">We connect Fitness trainers with clients looking for personalised training.
Come, Join India’s largest fitness discovery platform.</h5>
                    <br/>
                    <br/>
                    <br/>
                    <a href="#trainerwithus" class="btn btn-primary btn-lg pl-5 pr-5">Register Now</a>
                </div>
                </div>
                <div class="col-md-12"><br/><br/></div>

            </div>
        </div>
    </div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="container">
                <div class="row ayt-sp">
                    <div class="col-lg-offset-2 offset-md-2 col-lg-2 col-md-2 col-sm-3 col-xs-12 spots sp-1">
                        <ul class="list-unstyled no-mar">
                            <li><h2>1.</h2></li>
                            <li class="text-uppercase f-20">REGISTER</li>
                            <li><p class="no-mar">Register yourself as a Trainer on Near Gym and avail access to a suite of apps to aid you in personal training. </p></li>
                            <li><img src="{{ asset('fontend/images/register.png') }}" alt="" width="58" height="80"></li>
                        </ul>
                    </div>

                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 no-mar spots sp-2">
                    <ul class="list-unstyled no-mar">
                        <li><h2>2.</h2></li>
                        <li class="text-uppercase f-20">DISCOVER</li>
                        <li><p class="no-mar">Discover thousands of clients looking for professional trainers right from your mobile app.</p></li>
                        <li><img src="{{ asset('fontend/images/discover.png') }}" alt="" width="87" height="80"></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 no-mar spots sp-3">
                    <ul class="list-unstyled no-mar">
                        <li><h2>3.</h2></li>
                        <li class="text-uppercase f-20">CONNECT</li>
                        <li><p class="no-mar">Connect with the clients of your choice, and with transparent pricing and terms, it’s never been so easy. </p></li>
                        <li><img src="{{ asset('fontend/images/connect.png') }}" alt="" width="80" height="80"></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 no-mar spots sp-4">
                    <ul class="list-unstyled no-mar">
                        <li><h2>4.</h2></li>
                        <li class="text-uppercase f-20">COACH</li>
                        <li><p class="no-mar">Congratulations on being a Coach! It’s now your turn to make this world a little better and fitter place! </p></li>
                        <li><img src="{{ asset('fontend/images/coach.png') }}" alt="" width="80" height="80"></li>
                    </ul>
                </div>
                </div>
            </div>
        </div>
    </div>
        
</div>
<div class="ayt-vectors-outer">  
            <div class="ayt-vectors">  
                <div class="container">
                    <div class="">
                        <a class="btn btn-primary ayt-signup" href="#ayt-form">GET ME ONBOARD</a>
                    </div>
                </div>
        </div>
    </div>
<div class="container">
    <br/>
    <br/>
    <br/>
 <div class="d-flex justify-content-center">
 <div class="col-md-9">
    <div class="text-center">
    <h3 class="mb-4" id="trainerwithus">Sign up with NearGym and give a jumpstart to your career</h3>
    <p>To Signup with NearGym as a trainer, please fill the form below with your details and we will get back to you with our representatives. It’s just one step towards jumpstarting a successfully rewarding career as a Fitness Training Professional with NearGym.</p>
</div>
<div class="d-flex justify-content-center mt-5">
 <div class="col-md-9">
 @if($errors->all())
                @foreach ($errors->all() as $index=>$error)
                    @if($index==0)
                  <div class="alert alert-danger">One or more fields have an error. Please check and try again.</div>
                   @endif
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
    <form method="POST" action="{{ route('trainerasseller') }}" enctype="multipart/form-data">
        @csrf 
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="trainer_name" value="{{ old('trainer_name') }}" placeholder="Enter your full name" autocomplete="off">
                    @if ($errors->has('trainer_name'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('trainer_name') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
             <div class="col-md-6">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="trainer_email" value="{{ old('trainer_email') }}" placeholder="Enter your email here ...." autocomplete="off">
                    @if ($errors->has('trainer_email'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('trainer_email') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                     <label>Address</label>
                    <input type="text" class="form-control" name="trainer_address" value="{{ old('trainer_address') }}" placeholder="Enter your address" autocomplete="off"> 
                    @if ($errors->has('trainer_address'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('trainer_address') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Postal Code</label>
                    <input type="number" class="form-control" name="trainer_zip" value="{{ old('trainer_zip') }}" placeholder="Enter your postal code" autocomplete="off"> 
                    @if ($errors->has('trainer_zip'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('trainer_zip') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>
         <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Contact Number</label>
                    <input type="number" class="form-control" name="trainer_tel" value="{{ old('trainer_tel') }}" placeholder="Enter you 10 digit contact number" autocomplete="off"> 
                    @if ($errors->has('trainer_tel'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('trainer_tel') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
             <div class="col-md-6">
                <div class="form-group">
                    <label>City</label>
                    <select name="trainer_city" class="form-control">
                    @foreach($cities as $city)
                     <option value="{{$city->name}}">{{$city->name}}</option>
                     @endforeach
                    </select>
                    @if ($errors->has('trainer_city'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('trainer_city') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>

         <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Expertise</label>
                   <input class="form-control" type="text" name="trainer_Expertize" value="{{ old('trainer_Expertize') }}">
                    @if ($errors->has('trainer_Expertize'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('trainer_Expertize') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
             <div class="col-md-6">
                <div class="form-group">
                    <label>Area of Expertise</label>
                    <select class="form-control" name="trainer_area_expertize">
                        <option value="Yoga Trainer">Yoga Trainer</option>
                        <option value="Personal Trainer">Personal Trainer</option>
                    </select>
                    @if ($errors->has('trainer_area_expertize'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('trainer_area_expertize') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>
         <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Experince</label>
                    <input type="text" class="form-control" name="trainer_experince" value="{{ old('trainer_experince') }}" autocomplete="off">
                    @if ($errors->has('trainer_experince'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('trainer_experince') }}</strong>
                            </span>
                            @endif
                </div>
            </div>
             <div class="col-md-6">
                <div class="form-group">
                    <label>Payment Type</label>
                    <select class="form-control" name="payment_mode">
                        <option value="1">Monthly</option>
                        <option value="2">Hourly</option>
                    </select>
                    @if ($errors->has('trainer_area_expertize'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('trainer_area_expertize') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Gender</label>
                    <select class="form-control" name="gender">
                        <option value="1">Male</option>
                        <option value="2">Female</option>
                       
                    </select>
                    @if ($errors->has('gender'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('gender') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>
       
        <hr/>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Register</button>
        </div>
        <div class="small text-center mt-4">
            <p>By clicking “Sign Up”, You agree to the <a href="#">Terms of Use</a> 
and <a href="#">Privacy Policy</a>.</p>
        </div>
    </form>
</div>
</div>
</div>
</div>
</div>
<!-- form end here -->


 <br/>
        
        <div class="success"  style="background-color: #fff">
            <br/>
        <br/>
            <div class="container">
                <div class="text-center mb-5">
                    <h3>OUR SUCCESS IS YOUR SUCCESS</h3>
                </div>
                <div class="row">
                    <div class="col-md-4 text-center">
                        <img src="{{url('/images/1customers.png')}}">
                        <h4 class="mt-4">Million customers on Near Gym and growing</h4>
                    </div>
                    <div class="col-md-4 text-center">
                        <img src="{{url('/images/2locations.png')}}">
                        <h4 class="mt-4">Presence across 30+ cities and expanding</h4>
                    </div>
                  <div class="col-md-4 text-center">
                        <img src="{{url('/images/3restaurants.png')}}">
                        <h4 class="mt-4">40K+ Gyms on Near Gym and increasing</h4>
                    </div>
                </div>
            </div>
             <br/>
        <br/>
        </div>
        <br/>
       

              <div class="success-stories">
        <div class="container">
            <div id="demo" class="carousel slide" data-ride="carousel"> 
  <!-- The slideshow -->
  <div class="carousel-inner">
    <div class="carousel-item active">
        <div class="row justify-content-center">

  <div class="col-md-9 text-center" >
      <h4><i>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores.</i></h4>
      <br/>
      <img src="{{url('/images/img.jpeg')}}" class="rounded-circle" alt="Los Angeles">
  </div>
 <br/>
      <br/>
      

  </div>
    </div>
        <div class="carousel-item">
        <div class="row justify-content-center">

  <div class="col-md-9 text-center" >
      <h4><i>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores.</i></h4>
      <br/>
      <img src="{{url('/images/img.jpeg')}}" class="rounded-circle" alt="Los Angeles">
  </div>
 <br/>
      <br/>
      

  </div>
    </div>
        <div class="carousel-item">
        <div class="row justify-content-center">

  <div class="col-md-9 text-center" >
      <h4><i>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores.</i></h4>
      <br/>
      <img src="{{url('/images/img.jpeg')}}" class="rounded-circle" alt="Los Angeles">
  </div>
 <br/>
      <br/>
      

  </div>
    </div>
  </div>
  
  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>
        </div>
        </div>


<footer class="mt-0">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <h6>COMPANY</h6>
                <ul class="p-0">
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Team</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Blog</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h6>CONTACT</h6>
                <ul class="p-0">
                    <li>987654320 | 9876543232</li>
                    <li><a href="#">Faq</a></li>
                    <li><a href="#">Help & Support</a></li>
                    <li><a href="#">Partner with us</a></li>
                </ul>
            </div>
        </div>
        <div class="Copyright text-center d-flex justify-content-center">
        <div class="col-md-9">
            <ul class="list-inline">
              @foreach($cities as $city)
              <li class="list-inline-item"><a href="#">{{$city->name}}</a></li>
              @endforeach
                
             <!--    <li class="list-inline-item"><a href="#">Ahmedabad</a></li>
                <li class="list-inline-item"><a href="#">Allahabad</a></li>
                <li class="list-inline-item"><a href="#">Amritsar</a></li>
                <li class="list-inline-item"><a href="#">Aurangabad</a></li>
                <li class="list-inline-item"><a href="#">Bangalore</a></li>
                <li class="list-inline-item"><a href="#">Bareilly</a></li>
                <li class="list-inline-item"><a href="#">Bhopal</a></li>
                <li class="list-inline-item"><a href="#">Bhubaneswar</a></li>
                <li class="list-inline-item"><a href="#">Chandigarh</a></li>
                <li class="list-inline-item"><a href="#">Agra</a></li>
                <li class="list-inline-item"><a href="#">Ahmedabad</a></li>
                <li class="list-inline-item"><a href="#">Allahabad</a></li>
                <li class="list-inline-item"><a href="#">Amritsar</a></li>
                <li class="list-inline-item"><a href="#">Aurangabad</a></li>
                <li class="list-inline-item"><a href="#">Bangalore</a></li>
                <li class="list-inline-item"><a href="#">Bareilly</a></li>
                <li class="list-inline-item"><a href="#">Bhopal</a></li>
                <li class="list-inline-item"><a href="#">Bhubaneswar</a></li>
                <li class="list-inline-item"><a href="#">Chandigarh</a></li> -->
            </ul>
        </div>
        </div>
<div class="Copyright">
                    <div class="d-flex justify-content-between row">
                        <div class="logo-image col-lg-2 col-md-3 mb-3">
                            <img src="http://localhost/gym/public/fontend/images/logo.png" class="img-fluid">
                        </div>
                        <div>
                            <p class="mb-0">© Copyright 2019 Near Gym. All Right Reserved</p>
                        </div>
                        <div>
                            <ul class="mt-0">
                                <li class="list-inline-item"><a href=""><i class="fab fa-facebook-square"></i></a></li>
                                <li class="list-inline-item"><a href=""><i class="fab fa-twitter"></i></a></li>
                                <li class="list-inline-item"><a href=""><i class="fab fa-instagram"></i></a></li>
                                <li class="list-inline-item"><a href=""><i class="fab fa-linkedin-in"></i></a></li>
                                <li class="list-inline-item"><a href=""><i class="fab fa-google-plus-g"></i></a></li>

                            </ul>
                        </div>
                    </div>

            </div>
    </div>
</footer>
<style type="text/css">
    .invalid-feedback
    {
        display: block;
        font-weight: 300;
    }
</style>
@endsection
