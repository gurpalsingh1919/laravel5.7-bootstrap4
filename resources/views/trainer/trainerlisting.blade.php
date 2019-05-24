@extends('layouts.users-app')

@section('content')
<!-- content start here -->
  <div class="inner-banner">
 <div class=" container">
  <div class="owl-carousel owl-theme">
   
    <div> <img src="http://localhost/gym/public/promotion/1549133636-promotion.png" /></div>
    <div> <img src="http://localhost/gym/public/promotion/1549133636-promotion.png" /></div>
    <div> <img src="http://localhost/gym/public/promotion/1549133636-promotion.png" /></div>
    <div> <img src="http://localhost/gym/public/promotion/1549133636-promotion.png" /></div>
    <div> <img src="http://localhost/gym/public/promotion/1549133636-promotion.png" /></div>
    <div> <img src="http://localhost/gym/public/promotion/1549133636-promotion.png" /></div>
    <div> <img src="http://localhost/gym/public/promotion/1549133636-promotion.png" /></div>
    <div> <img src="http://localhost/gym/public/promotion/1549133636-promotion.png" /></div>
  
<!-- <div> <img src="{{ asset('fontend/images/ads2.png') }}" /></div>
<div> <img src="{{ asset('fontend/images/ads3.png') }}" /></div> -->

</div>
</div>
</div>
 <div class="breadcrumb p-0 m-0 pt-2">
 <div class="container">
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="http://localhost/gym/public">Home</a></li>
  <li class="breadcrumb-item active">vijayawada</li>
</ol>
</div></div>
<div class="container pt-5">
  <div class="row">
    <div class="col-lg-3">
      <ul class="sidebar-filter">
         <ul class="sidebar-filter">
   <li class="active">
      <a href="0">
      <i class="fa fa-align-justify" aria-hidden="true"></i>All
      <span>3 Options</span>
      </a>
   </li>
   <li class="">
      <a href="1">
      <i class="fas fa-dumbbell"></i>
      Gyms
      <span>
      2
      Options</span>
      </a>
   </li>
   <li class="">
      <a href="2">
      <i class="fa fa-american-sign-language-interpreting"></i>
      Aerobics
      <span>
      1
      Options</span>
      </a>
   </li>
</ul>
        
     
      </ul>
    </div>
   <div class="col-lg-9 gymlisting">
     @if(session('error')) 
              <div class="error alert alert-danger alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Error : </strong>   {{ session('error') }}
              </div>
               <script type="text/javascript">
                Swal({
                    type: 'info',
                   // title: "{{ session('error') }}",
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
    <div class="row">
      <div class="col-md-12">
        <h3>Trainer Listing</h3>
      </div>
      </div>
      <br/>
       
    <div class="row">  
      <div class="col-md-4 mb-4">
   <div class="card">
      <a href="http://localhost/gym/public/mygym/26">
         <div class="image-container">
            <img height="250" width="250" class="card-img-top" src="http://localhost/gym/public/gyms/1548696086-1.jpg" alt="Surya Teja Gym Body Building And Fitness Center">
         </div>
      </a>
      <div class="card-body pl-0 pr-0 pt-2 pb-0">
         <strong class="card-title">Surya Teja Gym Body </strong>
         <p class="card-text small mb-2">Surya Teja Gym Body Building And Fitness</p>
         <div class="d-flex justify-content-between">
            <small class="badge badge-success mb-2 mr-2">
            <i class="fas fa-star"></i> 4.1
            </small>
            <small class="offers-info" style=""><i class="fas fa-percentage"></i> 20% off on all orders</small>
         </div>
         <hr>
      </div>
   </div>
</div>
<div class="col-md-4 mb-4">
   <div class="card">
      <a href="http://localhost/gym/public/mygym/26">
         <div class="image-container">
            <img height="250" width="250" class="card-img-top" src="http://localhost/gym/public/gyms/1548696086-1.jpg" alt="Surya Teja Gym Body Building And Fitness Center">
         </div>
      </a>
      <div class="card-body pl-0 pr-0 pt-2 pb-0">
         <strong class="card-title">Surya Teja Gym Body </strong>
         <p class="card-text small mb-2">Surya Teja Gym Body Building And Fitness</p>
         <div class="d-flex justify-content-between">
            <small class="badge badge-success mb-2 mr-2">
            <i class="fas fa-star"></i> 4.1
            </small>
            <small class="offers-info" style=""><i class="fas fa-percentage"></i> 20% off on all orders</small>
         </div>
         <hr>
      </div>
   </div>
</div>
<div class="col-md-4 mb-4">
   <div class="card">
      <a href="http://localhost/gym/public/mygym/26">
         <div class="image-container">
            <img height="250" width="250" class="card-img-top" src="http://localhost/gym/public/gyms/1548696086-1.jpg" alt="Surya Teja Gym Body Building And Fitness Center">
         </div>
      </a>
      <div class="card-body pl-0 pr-0 pt-2 pb-0">
         <strong class="card-title">Surya Teja Gym Body </strong>
         <p class="card-text small mb-2">Surya Teja Gym Body Building And Fitness</p>
         <div class="d-flex justify-content-between">
            <small class="badge badge-success mb-2 mr-2">
            <i class="fas fa-star"></i> 4.1
            </small>
            <small class="offers-info" style=""><i class="fas fa-percentage"></i> 20% off on all orders</small>
         </div>
         <hr>
      </div>
   </div>
</div>
        </div>
      </div>
    </div>
  </div>
  @include('users.footer')
 <script src="{{ asset('fontend/js/owl.carousel.js') }}"></script>

  <script type="text/javascript">
       $(function() {
  'use strict';

  // ---------------------------------------------------------------------------
  // positioning
  var W = $(window);
  var PI = $('.custom-popup');

  // W.on('resize', function () {
  //   PI.tooltip('update');
  // });

  PI.hover(function () {
    console.log()
    var gymname=$(this).attr("gym_name");
    var gymaddress=$(this).attr("gym_address");
    var gympackages=$(this).data("packages");
    //console.log($(this).val());
    var packages='';
         $.each(gympackages, function (key, val) {
        if(key>3) return false;
      var packagesimages=val.package_images;
      var image = packagesimages.split('|');

      packages +='<div class="col-md-6"><div class=""><div class="image-container"><img height="100" width="100" src="{{  asset("/package") }}/'+image[0]+'" alt='+val.title+'> </div><div class="card-body pl-0 pr-0 pt-2"><strong>'+val.title+'</strong></div></div></div>';

          
       });
     
    $(this).tooltip({
      /*content: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit ...',*/
      template: '<div class="jq-tooltip"><div class="quickview"> <div class="row hoverdivs pt-3"> <div class="col-md-4 text-center justify-content-center align-self-center"> <div class=""> <strong>'+gymname+'</strong> <hr/> <small class="text-left">'+gymaddress+'</small> </div> </div> <div class="col-md-8 "> <div class="row">'+packages+
       '</div> </div> </div> </div></div>',
      position: 'left',

    });
  }, function () {
    $(this).tooltip('close');
  });
  // ---------------------------------------------------------------------------
});
   


  $(document).ready(function(){

 


  $(".owl-carousel").owlCarousel({
    nav:true,
    loop:true,
      autoplay:true,
      autoplayTimeout:2000,
      autoplayHoverPause:true,
      navText: ["<img src='{{ asset('fontend/images/left.png') }}'>","<img src='{{ asset('fontend/images/right.png') }}'>"],
    margin:10,

    responsive:{
        0:{
            items:1,
        },
        600:{
            items:3,
        },
        1000:{
            items:4,
        }
    }
  });
      $('.owl-carousel').find('.owl-nav').removeClass('disabled');
      $('.owl-carousel').on('changed.owl.carousel', function(event) {
          $(this).find('.owl-nav').removeClass('disabled');
      });
});


</script>
 @endsection('content')