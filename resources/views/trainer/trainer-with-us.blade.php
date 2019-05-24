@extends('layouts.sellers-app')

@section('content')
<link href="{{url('/css/smart_wizard.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{url('/css/bootstrap-pincode-input.css')}}" rel="stylesheet">
<link href="{{url('/css/smart_wizard_theme_dots.css')}}" rel="stylesheet" type="text/css"/>


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
                <li><p class="no-mar">Register yourself as a Trainer on Near Gym and avail access to a
                        suite of apps to aid you in personal training. </p></li>
                <li><img src="{{ asset('fontend/images/register.png') }}" alt="" width="58" height="80">
                </li>
            </ul>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 no-mar spots sp-2">
              <ul class="list-unstyled no-mar">
                  <li><h2>2.</h2></li>
                  <li class="text-uppercase f-20">DISCOVER</li>
                  <li><p class="no-mar">Discover thousands of clients looking for professional trainers
                          right from your mobile app.</p></li>
                  <li><img src="{{ asset('fontend/images/discover.png') }}" alt="" width="87" height="80">
                  </li>
              </ul>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 no-mar spots sp-3">
                <ul class="list-unstyled no-mar">
                    <li><h2>3.</h2></li>
                    <li class="text-uppercase f-20">CONNECT</li>
                    <li><p class="no-mar">Connect with the clients of your choice, and with transparent
                            pricing and terms, it’s never been so easy. </p></li>
                    <li><img src="{{ asset('fontend/images/connect.png') }}" alt="" width="80" height="80">
                    </li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 no-mar spots sp-4">
                <ul class="list-unstyled no-mar">
                    <li><h2>4.</h2></li>
                    <li class="text-uppercase f-20">COACH</li>
                    <li><p class="no-mar">Congratulations on being a Coach! It’s now your turn to make this
                            world a little better and fitter place! </p></li>
                    <li><img src="{{ asset('fontend/images/coach.png') }}" alt="" width="80" height="80">
                    </li>
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
          <p>To Signup with NearGym as a trainer, please fill the form below with your details and we will get
              back to you with our representatives. It’s just one step towards jumpstarting a successfully
              rewarding career as a Fitness Training Professional with NearGym.</p>
      </div>
      <div class="d-flex justify-content-center mt-5">
      </div>
      <div id="smartwizard" class="sw-main">
        <ul>
          <li>
            <a href="#step-1">OTP Generate<br/><small>Step 1</small></a>
          </li>
          <li>
            <a href="#step-2">Personal Info<br/><small>Step 2</small></a>
          </li>
          <li>
            <a href="#step-3">Extra Info<br/><small>Step 3</small></a>
          </li>
        </ul>
        <div>
          <div id="step-1" class="">
            <div class="d-flex justify-content-center">
              <div class="col-md-7">
                <div class="row">
                  <div class="col-md-12 numbercontainer">
                    <div class="form-group">
                      <label>Enter Phone Number</label>
                      <input type="number" class="form-control" name="contact_no" id="contact_number" />
                       @if ($errors->has('contact_no'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('contact_no') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="otpbtn">
                      <button class="btn btn-primary" data-value="0">Sent OTP</button>
                    </div>
                  </div>
                  <div class="col-md-12 otpcontainer text-center" style="display:none">
                    <div class="form-group mb-3">
                      <label>We have send the OTP on XXXX will apply auto to the
                              fields
                      </label>
                      <div id="divInner" class="mb-3">
                          <input id="pincode-input1" type="text" maxlength="4" value=""/>
                      </div>
                      <p>If you didn't receive a code! <a href="#">Resend</a></p>
                      <input type="hidden" id="checkvalidate" data-value="0"/>
                      <div id="numb_verify" class="alert alert-danger" role="alert"
                           style="display: none;">
                          Please verify your number First
                      </div>
                    </div>
                    <div class="verify_otp">
                      <button class="btn btn-primary" data-value="0">verify OTP</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="step-2" class="">
            <div class="col-md-12">
              @if($errors->all())
                @foreach ($errors->all() as $index=>$error)
                  @if($index==0)
                    <div class="alert alert-danger">One or more fields have an error. Please
                          check and try again.</div>
                  @endif
                @endforeach
              @endif
              @if(session('error'))
                <div class="error alert alert-danger alert-dismissable">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Error : </strong> {{ session('error') }}
                </div>
              @endif
              @if(session('success'))
                <div class="error alert alert-success alert-dismissable">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  {!! session('success') !!}
                </div>
              @endif
              <form method="POST" action="{{ route('trainerasseller') }}"enctype="multipart/form-data">
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
                      <input type="email" class="form-control" name="trainer_email"
                               value="{{ old('trainer_email') }}"
                               placeholder="Enter your email here ...." autocomplete="off">
                        @if ($errors->has('trainer_email'))
                          <span class="invalid-feedback">
                            <strong>{{ $errors->first('trainer_email') }}</strong>
                          </span>
                        @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Postal Code</label>
                      <input type="number" class="form-control" name="trainer_zip"
                             value="{{ old('trainer_zip') }}"
                             placeholder="Enter your postal code" autocomplete="off">
                      @if ($errors->has('trainer_zip'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first('trainer_zip') }}</strong>
                      </span>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-4">
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
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Gender</label>
                      <select class="form-control" name="gender">
                          <option value="1">Male</option>
                          <option value="2">Female</option>
                          <option value="2">Transgender</option>
                      </select>
                      @if ($errors->has('gender'))
                        <span class="invalid-feedback">
                          <strong>{{ $errors->first('gender') }}</strong>
                        </span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <label>Specialization</label>
                    <div class="form-group col-md-12">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="optradio">   Weight Management
                            </label>
                          </div>
                          <div class="">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="optradio">Strength Endurance
                            </label>
                          </div>
                          <div class="">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="optradio">   Muscle Toning
                            </label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="optradio">Crossfit Workouts
                            </label>
                          </div>
                          <div class="">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="optradio">Finantial Training
                            </label>
                          </div>
                          <div class="">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="optradio">Kettlebell Training
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Are you a certified Fitness Instructor</label>
                      <div>
                        <div class="form-check-inline">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="optradio">Yes
                          </label>
                        </div>
                        <div class="form-check-inline">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="optradio">No
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="mb-0">Qualification
                        <small class="d-block mb-2  mt-2 small"> Add your qualification or write the name of the gyms where you've worked
                        </small>
                      </label>
                      <input type="text" class="form-control" name="trainer_experince"
                             value="{{ old('trainer_experince') }}" autocomplete="off">
                      @if ($errors->has('trainer_experince'))
                        <span class="invalid-feedback">
                          <strong>{{ $errors->first('trainer_experince') }}</strong>
                        </span>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Type of professional</label>
                      <select class="form-control" name="payment_mode">
                        <option value="1">Freelancer (I work alone)</option>
                        <option value="2">Business ( Have a team working with me)</option>
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
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Address</label>
                      <textarea type="text" class="form-control" name="" placeholder="Enter your address" rows="3">
                      </textarea>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div id="step-3" class="">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" class="form-control"/>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Confirm Password</label>
                  <input type="password" class="form-control"/>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 js">
                <div class="form-group">
                  <label>Upload Identity Doc </label>
                <div>
                  <div class="form-check-inline">
                      <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="optradio">Aadhar
                      </label>
                  </div>
                  <div class="form-check-inline">
                      <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="optradio">Driving
                          Licence
                      </label>
                  </div>
                  <div class="form-check-inline">
                      <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="optradio">Voter
                          Card
                      </label>
                  </div>
                  <div class="form-check-inline">
                      <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="optradio">Other
                      </label>
                  </div>
                </div>
                <div class="row">
                  <div class="mt-2 col-md-6">
                    <input class="form-control form-control-sm inputfile inputfile-2" type="file" id="file-2" placeholder="Images" name="" value="" autocomplete="off">
                    <label for="file-2">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
                        <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
                      </svg>
                      <span>Upload Identity Proof</span></label>
                  </div>
                </div>
              </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Service Area <small class="small d-block mt-2 mb-2">Enter location where you want to receive customer leads</small></label>
                  <input type="password" class="form-control"/>
                </div>
              </div>
              <div class="col-md-4 js">
                <div class="form-group">
                  <label>Personal Photo</label>
                  <input class="form-control form-control-sm inputfile inputfile-2" id="file-3" type="file" placeholder="Images" name="" value="" autocomplete="off">
                  <label for="file-3">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
                    <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
                  </svg>
                  <span>Upload Personal Image</span></label>
                </div>
              </div>
            </div>
            <hr/>
            <div class="small text-center mt-4">
              <p><input type="checkbox" class="mr-2 mt-1" id="label"><label for="label">By clicking “Sign Up”, You agree to the <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a>.</label></p>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- form end here -->


<br/>

<div class="success" style="background-color: #fff">
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

                <div class="col-md-9 text-center">
                    <h4><i>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                            doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore
                            veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam
                            voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                            consequuntur magni dolores.</i></h4>
                    <br/>
                    <img src="{{url('/images/img.jpeg')}}" class="rounded-circle" alt="Los Angeles">
                </div>
                <br/>
                <br/>


            </div>
        </div>
        <div class="carousel-item">
            <div class="row justify-content-center">

                <div class="col-md-9 text-center">
                    <h4><i>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                            doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore
                            veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam
                            voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                            consequuntur magni dolores.</i></h4>
                    <br/>
                    <img src="{{url('/images/img.jpeg')}}" class="rounded-circle" alt="Los Angeles">
                </div>
                <br/>
                <br/>


            </div>
        </div>
        <div class="carousel-item">
            <div class="row justify-content-center">

                <div class="col-md-9 text-center">
                    <h4><i>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium
                            doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore
                            veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam
                            voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                            consequuntur magni dolores.</i></h4>
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
    .invalid-feedback {
        display: block;
        font-weight: 300;
    }

    .btn-toolbar.show {
        opacity: 1;
    }

    .btn-toolbar {
        opacity: 0;
    }

    #partitioned {
        padding-left: 15px;
        letter-spacing: 42px;
        border: 0;
        background-image: linear-gradient(to left, black 70%, rgba(255, 255, 255, 0.1) 0%);
        background-position: bottom;
        background-size: 50px 1px;
        background-repeat: repeat-x;
        background-position-x: 35px;
        background-color: transparent;
        width: 220px;
        min-width: 220px;

    }

    #divInner {
        left: 0;
        position: sticky;
    }

    #divOuter {
        width: 190px;
        overflow: hidden
    }
</style>


<script type="text/javascript">
$(document).ready(function () {
    $('#pincode-input1').pincodeInput({
        hidedigits: false, complete: function (value, e, errorElement) {

            // check the code
            if (value.length == 4) {
                //$(errorElement).html("The code is not correct. Should be '1234'");4
                //console.log("complete")
                $(".otpbtn").show();
                var a = $('.otpbtn button').data('value');
                //$('.otpbtn button').attr('data-value',1);
            }

        }
    });


    // Step show event
    $("#smartwizard").on("showStep", function (e, anchorObject, stepNumber, stepDirection, stepPosition) {
        //alert("You are on step "+stepNumber+" now");
        if (stepPosition === 'first') {
            $("#prev-btn").addClass('disabled');
        } else if (stepPosition === 'final') {
            $("#next-btn").addClass('disabled');
        } else {
            $("#prev-btn").removeClass('disabled');
            $("#next-btn").removeClass('disabled');
        }
    });

    // Toolbar extra buttons
    var btnFinish = $('<button></button>').text('Finish')
        .addClass('btn btn-info')
        .on('click', function () {
            alert('Finish Clicked');
        });
    var btnCancel = $('<button></button>').text('Cancel')
        .addClass('btn btn-danger')
        .on('click', function () {
            $('#smartwizard').smartWizard("reset");
        });


    /*$(".sw-btn-next").addClass("disabled");*/

    // Smart Wizard
    $('#smartwizard').smartWizard({
        selected: 0,
        theme: 'dots',
        transitionEffect: 'fade',
        showStepURLhash: false,
        useURLhash: true,
        //disabledSteps:[1,2]
        /*toolbarSettings: {
            toolbarPosition:'none'
        }*/
    });
    $(".otpbtn button").click(function () {
       // $(".numbercontainer").fadeOut();
        //$(".otpcontainer").fadeIn();
        var contact=$("#contact_number").val();
        console.log("asdf"+contact);
        if(typeof contact == 'undefined'  || !isNaN(contact) || contact.length >'10' || contact.length < '10')
        {
            Swal.fire({
              type: 'warning',
              title: 'Oops...',
              text: 'Contact number should be 10 digit !!',
            })
        }



         $.ajax({
          url: "{{route('OtpVerifyOnPhone')}}",
          type: "POST",
          data: {contact_no: contact,_token: "{{ csrf_token() }}"}, 
          success: function(res)
          { 
            console.log(res);
            //console.log(res.status);
            /*if(res.status=='success')
            {
                Swal.fire(
                'Deleted!',
                res.message,
                'success'
              )
              location.reload(true);
            }
            else
            {
                 Swal.fire(
                'Error!',
                res.message,
                'error'
              )
            }*/
          }});

        


    })

    $(document).on('click', '.verify_otp button', function f() {
        $("#checkvalidate").attr("data-value", 1);
        $(".btn-toolbar ").addClass("show");
    })
    /* $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection) {
         console.log("You are on step "+stepNumber+" now");
     });*/
    $("#smartwizard").on("leaveStep", function (e, anchorObject, stepNumber, stepDirection) {
        //return confirm("Do you want to leave the step "+stepNumber+"?");
        $inputvalue = $("#checkvalidate").attr("data-value");
        //console.log($inputvalue);
        if ($inputvalue == 1) {
            //console.log("asd")
            return true;
        } else {
            //console.log("no checked")
            $("#numb_verify").show();
            return false;
        }
    });

    // External Button Events


    $("#prev-btn").on("click", function () {
        // Navigate previous
        $('#smartwizard').smartWizard("prev");
        return true;
    });

    $("#next-btn").on("click", function () {
        // Navigate next
        $('#smartwizard').smartWizard("next");
        return true;
    });


});

</script>
@endsection
