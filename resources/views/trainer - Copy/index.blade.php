@extends('layouts.users-app')

@section('content')

<header class="masthead">
      <div class="container h-100">
        
        <div class="row ">
          <div class="col-md-12 ">
            <div class="header-content text-center ">
              <h3>Fight for Fitness</h3>
              <h1 class="mb-5">
                Find near Gym
              </h1>
               <div id="lat_long" class="error alert alert-danger alert-dismissable"></div>
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
              <div class="search-input ">

                <input id="location" type="text" placeholder="Enter your location" class="searchinput form-control" autocomplete="off">
              <div class="locateme">
                <span onclick="getLocation()" >Locate Me</span>
              </div>
              <a href="#" class="searchbtn btn btn-primary btn-lg" onclick="getGym()">
                  <i class="fas fa-spinner fa-spin"></i>
                  <span>Find Gym</span></a>
              </div>
              <ul class="mt-4">
                 
                <li class="list-inline-item"><a href=""> </a></li>
                
              </ul>
              
              
            </div>
          </div>
          
        </div>
       
      </div>
  </header>
	<!-- banner end here -->
	<br/>
	<br/>
	<br/>
	<!-- content start here -->
	<div class="container about-gym">
		<div class="row">
        <div class="col-lg-4 col-sm-6 text-center">
  
            <a href="#"><img class="img-fluid" src="{{ asset('fontend/images/img.jpg') }}" alt=""></a>
              <h6 class="mt-2 text-uppercase">
                <a href="#">Bodybuilding Program</a>
              </h6>          
        </div>
        <div class="col-lg-4 col-sm-6 text-center">
  
            <a href="#"><img class="img-fluid" src="{{ asset('fontend/images/img1.jpg') }}" alt=""></a>
              <h6 class="mt-2 text-uppercase">
                <a href="#">Bodybuilding Program</a>
              </h6>          
        </div>
        <div class="col-lg-4 col-sm-6 text-center">
  
            <a href="#"><img class="img-fluid" src="{{ asset('fontend/images/img2.jpg') }}" alt=""></a>
              <h6 class="mt-2 text-uppercase">
                <a href="#">Bodybuilding Program</a>
              </h6>          
        </div>
        <div class="text-center col-md-12 mt-5">
          <button type="button" class="btn btn-primary">View All</button>
        </div>
        
      </div>
	  <br/>
	  <br/>
	</div>
	
	<div class="container-fluid p-0 showcase">
        <div class="row no-gutters">

          <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('fontend/images/img3.jpg');"></div>
          <div class="col-lg-6 order-lg-1 my-auto showcase-text">
            <h2 class="mb-4">About Us</h2>
            <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries</p>
            <br/>
            <a href="#" class="btn btn-primary">Learn More</a>
          </div>
        </div>
  </div>
	  
	<section class="feature pt-5 pb-5">
		<div class="container pt-5 pb-5">
		 
				<div class="row">
        <div class="col-lg-4 col-sm-6 text-center">
          <div class="f_image f_image_a">
            
          </div>
          <p class="text-uppercase">Best Cardio Program</p>
          <span>What does this team member to? Keep it short! This is also a great spot for social links!</span>
          <br/><br/>
          <a href="#" class="btn btn-primary">Read More</a>
        </div>
        <div class="col-lg-4 col-sm-6 text-center">
          <div class="f_image f_image_b">
          
          </div>
          <p class="text-uppercase">Best Cardio Program</p>
          <span>What does this team member to? Keep it short! This is also a great spot for social links!</span>
          <br/><br/>
          <a href="#" class="btn btn-primary">Read More</a>
        </div>
        <div class="col-lg-4 col-sm-6 text-center">
          <div class="f_image f_image_c">
           
          </div>
          <p class="text-uppercase">Best Cardio Program</p>
          <span>What does this team member to? Keep it short! This is also a great spot for social links!</span>
          <br/><br/>
          <a href="#" class="btn btn-primary">Read More</a>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-4 col-sm-6 text-center">
          <div class="f_image f_image_d">
         
          </div>
          <p class="text-uppercase">Best Cardio Program</p>
          <span>What does this team member to? Keep it short! This is also a great spot for social links!</span>
          <br/><br/>
          <a href="#" class="btn btn-primary">Read More</a>
        </div>
        <div class="col-lg-4 col-sm-6 text-center">
          <div class="f_image f_image_e">
           
          </div>
          <p class="text-uppercase">Best Cardio Program</p>
          <span>What does this team member to? Keep it short! This is also a great spot for social links!</span>
          <br/><br/>
          <a href="#" class="btn btn-primary">Read More</a>
        </div>
        <div class="col-lg-4 col-sm-6 text-center">
          <div class="f_image f_image_f">
           </div>
          <p class="text-uppercase">Best Cardio Program</p>
          <span>What does this team member to? Keep it short! This is also a great spot for social links!</span>
          <br/><br/>
          <a href="#" class="btn btn-primary">Read More</a>
        </div>
      </div>
		</div>
	</section>
	<div class="container pt-5">
		<div class="row">
			<div class="text-center col-md-12">
				<h2>Newly Gym Added</h2>
			</div>
			</div>
			<br/>
			<br/>
		 
		<div class="row">
			<div class="col-md-4">
				 <div class="card">
          <img class="card-img-top" src="{{ asset('fontend/images/img1.jpg') }}" alt="Card image cap">
          <div class="card-body text-center">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Read More</a>
          </div>
        </div>
			</div>
			<div class="col-md-4">
				<div class="card">
          <img class="card-img-top" src="{{ asset('fontend/images/img1.jpg') }}" alt="Card image cap">
          <div class="card-body text-center">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Read More</a>
          </div>
        </div>
			</div>
      <div class="col-md-4">
        <div class="card">
          <img class="card-img-top" src="{{ asset('fontend/images/img1.jpg') }}" alt="Card image cap">
          <div class="card-body text-center">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Read More</a>
          </div>
        </div>
      </div>
		</div>
	</div>
  @include('users.footer')


 @endsection('content')