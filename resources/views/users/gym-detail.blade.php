@extends('layouts.users-app')

@section('content')
<!-- content start here -->
<?php $gym_imagess=explode('|', $gymdetail[0]->gym_images);
//echo "<pre>";print_r($settings->maintenance_charges);die; ?>

@if($gymdetail[0]->seller_type !='2')
<div class="sidebar-right sidebar-left">
    <div class="image-container">
        <img class="img-fluid" style="height: 200px;" src="http://localhost/gym/public/package/5876_arsxk8.jpg" alt="Card image cap">
    </div>
    <div class="d-flex justify-content-between p-3">
        <div class="p-social-link">
            <a href="#"><img src="{{url('images/facebook-copy-min.png')}}"/> </a>
            <a href="#"><img src="{{url('images/twitter-copy-min.png')}}"/> </a>
            <a href="#"><img src="{{url('images/linkedin-copy-min.png')}}"/> </a>
            <a href="#"><img src="{{url('images/email-min.png')}}"/> </a>
        </div>
        <button type="button" class="btn btn-primary">Book Now</button>

    </div>

    <div class="p-3 p-description">
    <div class="list-group">
        <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-th-large"></i> Dapibus ac facilisis in</a>
    </div>
    <div class="p-detail mt-3">
        <h6>Details</h6>
        <ul class="small mt-2">
            <li><i class="far fa-calendar-alt"></i> 1 Month</li>
            <li><i class="fas fa-tags"></i> 10,000.00 INR</li>
            <li><i class="fas fa-tags"></i> Joining Fee: 10.00 INR</li>
        </ul>
    </div>
        <div class="p-detail mt-3 border-top pt-3">
            <h6>Description</h6>
            <p>This is dummy Text</p>

        </div>
    </div>


</div>
  <div class="inner-banner detail-ban">
 <div class="container">
  <div class="row">
    <div class="col-md-3">
      @if($gymdetail[0]->seller_type=='1')
        @foreach($gym_imagess as $index=>$image)
          @if($index==0)
          <img src="{{ asset('/gyms') }}/{{$image}}" class="img-fluid"   />
          @endif
        @endforeach
      @elseif($gymdetail[0]->seller_type=='2')
        <img src="{{ asset('/images/user/'.$gymdetail[0]->user->image) }}" class="img-fluid"   />
      @endif
    </div>
    <div class="col-md-9">
      @if($gymdetail[0]->seller_type=='1')
        <h3>{{$gymdetail[0]->gym_name}}</h3>
        <p>{{$gymdetail[0]->gym_description}}</p>
      @elseif($gymdetail[0]->seller_type=='2')
        <h3>{{$gymdetail[0]->user->name}}</h3>
        <p>Experience:: {{$gymdetail[0]->experience}}</p>
        <p>Expertise:: {{$gymdetail[0]->expertise}}</p>
      @endif

      <ul class="gyminfo">
        <li>
          <span>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half"></i>
          </span>
          4.5 star Rating
        </li>
         @if($gymdetail[0]->seller_type=='1')
        <li>
          <p>
          <b class="text-uppercase">closed</b>
          12pm - 1pm
          
          </p>
        </li>
        @endif
      </ul>
       @if($gymdetail[0]->seller_type=='1')
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Play Video</button>
      @endif
    </div>
  </div>
</div>
</div>
@endif
 <div class="breadcrumb p-0 m-0 pt-2">
 <div class="container">
 {{ Breadcrumbs::render('gym',$gymdetail,$gym_id) }}
    </div>
    </div>
   
  <div class="container pt-5">
  <div class="row">
    <div class="col-lg-3">
      <div class="extralink">
        <ul class="sidebar-filter">
          <li id="g_about" class="{{$cat_id == '' ? 'active' : '' }}">
            <a href="{{ url('/mygym/'.$gymdetail[0]->id) }}"><i class="fas fa-info"></i>About</a></li>
        
        </ul>
      </div>
      <hr/>
      <div class="filtergym">
      <ul class="sidebar-filter">
        <li class="{{$cat_id == '0' ? 'active' : '' }}">
        <a href="?cat_id=0">
          <i class="fa fa-align-justify" aria-hidden="true"></i>All Packages
            <span>{{$total_pack}} Options</span>
        </a>
      </li>
         @foreach($packageWiseCateory as $index=>$categgory)
       
          <li class="{{$cat_id == $categgory->package_type_id ? 'active' : '' }}">
         
          <a href="?cat_id={{$categgory->package_type_id}}">
           <i class="fas fa-dumbbell"></i>{{ucfirst($categgory->pack_categories->name)}}
           <span> {{$categgory->pack_sum}} Options</span>
        </a>
      </li>
      @endforeach
      </ul>
    </div>
    </div>
   <div class="col-lg-6 right-content">
      
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
      @if(app('request')->input('cat_id') =='')
          @if($gymdetail[0]->seller_type=='1')
            <div class="row" id="aboutgym">
               <div class="col-md-12">
                 <div class="gallerybio">
 

                     <!--Carousel Wrapper-->
                     <div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails" data-ride="carousel">
                         <!--Slides-->
                         <div class="carousel-inner" role="listbox">
                             @foreach($gym_imagess as $index=>$image)
                                 <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                     <img src="{{ asset('/gyms') }}/{{$image}}" class="img-fluid imageThumb" />
                                 </div>
                             @endforeach
                         </div>

                         <!--Controls-->
                         <a class="carousel-control-prev" href="#carousel-thumb" role="button" data-slide="prev">
                             <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                             <span class="sr-only">Previous</span>
                         </a>
                         <a class="carousel-control-next" href="#carousel-thumb" role="button" data-slide="next">
                             <span class="carousel-control-next-icon" aria-hidden="true"></span>
                             <span class="sr-only">Next</span>
                         </a>
                         <!--/.Controls-->
                         <ol class="carousel-indicators">
                             @foreach($gym_imagess as $index=>$image)
                             <li data-target="#carousel-thumb" data-slide-to="{{$index}}" class="{{ $loop->first ? 'active' : '' }}">
                                 <img class="d-block" src="{{ asset('/gyms') }}/{{$image}}" class="img-fluid">
                             </li>
                             @endforeach
                         </ol>
                     </div>

                     <!--/.Carousel Wrapper-->
                   </div>

                   <h3>About</h3>
                   <p>{{$gymdetail[0]->gym_description}}
                   <br/> 
                

                   <div class="address alert-info alert">
                     <h5>Address</h5>
                     <p>{{$gymdetail[0]->gym_address.' ,'.$gymdetail[0]->zip.','.$gymdetail[0]->city}}
                      <br/>
                      <div class="rating small">
                        <span style="color: #ffc107"><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i></span><b> 5 Start Rating</b>
                      </div>
                      <hr style="border-color: #d2d2d2" />
                      <div class="d-flex justify-content-between">
                        @if($gymdetail[0]->website_link !='')
                        <a href="{{$gymdetail[0]->website_link}}" target="_blank">Visit Website</a>
                        @endif
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Watch Video</button>
                  </div>

                     </p>
                   </div> 

                    
                   </p>
                  
                  

                   
                   <div class="clearfix"></div>
                 
                   <div class="mb-5"></div>

               </div>
            </div>
          @elseif($gymdetail[0]->seller_type=='2')
             <div class="row" id="aboutgym">
              
           <div class="col-md-12">
              <h3>About</h3>
              <div class="d-flex justify-content-between">
              <div class="">
               <table class="table table-borderless mt-2 mb-5 small">
                   
                   <tr>
                       <th>Experience</th>
                       <td>{{$gymdetail[0]->experience}}</td>
                   </tr>
                   <tr>
                       <th>Expertise</th>
                       <td>{{$gymdetail[0]->expertise}}</td>
                   </tr>
                   <tr>
                       <th>Area of Expertise</th>
                       <td>{{$gymdetail[0]->type_of_expertise}}</td>
                   </tr>
                   <tr>
                       <th>Payment Mode</th>
                       <td>@if($gymdetail[0]->payment_mode=='1'){{__('Monthly')}}@else{{__('Hourly')}}@endif</td>
                   </tr>
                   <tr>
                       <th>Gender</th>
                       <td>@if($gymdetail[0]->gender=='1'){{__('Male')}}@else{{__('Female')}}@endif</td>
                   </tr>


               </table>
             </div>
             <div class="profile-outer">
             <div class="profile">
              <div class="image-container">
                <img src="{{asset('/images/user/'.$gymdetail[0]->user->image)}}" height="100px">
              </div>
                <p>{{$gymdetail[0]->user->name}}</p>
              </div>
              </div>
             </div>


               
            

               <div class="address alert-info alert">
                 <h5>Address</h5>
                 <p>{{$gymdetail[0]->gym_address.' ,'.$gymdetail[0]->zip.','.$gymdetail[0]->city}}
                  <br/>
                  <div class="rating small">
                    <span style="color: #ffc107"><i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i></span><b> 5 Start Rating</b>
                  </div>
                  <hr style="border-color: #d2d2d2" />
                  <div class="d-flex justify-content-between">
                    @if($gymdetail[0]->website_link !='')
                    <a href="{{$gymdetail[0]->website_link}}" target="_blank">Visit Website</a>
                    @endif
               <!--  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Watch Video</button> -->
              </div>

                 </p>
               </div> 

                
               </p>
              
              

               
               <div class="clearfix"></div>
             
               <div class="mb-5"></div>

           </div>
        </div>
          @endif




      @else
    <div id="gympackages">
    <div class="row">
      <div class="col-md-12">
        <h3>Packages</h3>
      </div>
      </div>
      <br/>

    <div class="row">
      <div class="col-md-12">
        <ul class="c_listing row">
          @foreach($gymdetail[0]->packages as $package)
          <li class="col-md-6">
            <div class="card">
             
               <?php $gym_imagess=explode('|', $package->package_images);
//echo "<pre>";print_r($gym_imagess);die; ?>
            <div class="image-container">
              {{--<a href="{{ url('/mygym/packages/'.$package->id) }}" />--}}
              <img class="card-img-top" src="{{ asset('/package') }}/{{$gym_imagess[0]}}" alt="Card image cap">
             {{--</a>--}}
                <div class="p_price">
                    <?php
                    $total_price=PackagetoPrice::get_package_price($package->price,$package->admin_comission);
                    ?>
                    {{number_format((float)$total_price, 2, '.', '')}} INR
                </div>
                <div class="membership">
                  #membership
                </div>
            </div>
            <div class="r_content pb-0 pt-2">
                <div class="p_duration mb-2">
                    1 WEEK
                </div>
                <a href="{{ url('/mygym/packages/'.$package->id) }}" />
            <h6 class="card-title mb-0">{{substr(ucfirst($package->title), 0, 20)}}</h6></a>
            <div class="d-flex small justify-content-between" style="color: #9b9b9b;">
              <div>Joining Fee: <span class="">10.00</span> INR</div>
              <div><a href="javascript:void(0);" class="packagedetail">View Detail</a></div>
            </div>
                  <p class="d-none card-text">{{substr(ucfirst($package->description), 0, 40)}}<a href="{{ url('/mygym/packages/'.$package->id) }}" />  ...Read More</a></p>
                  
            </div>
                   <hr/>
            {{--<div class="cart-btn d-block">--}}
            <div class="d-block text-right pl-2 pr-2">
                  {{--<button class="btn btn-secondary btn-sm float-left">
                    </button>--}}
                 
                  <!-- <a href="{{ url('/add-to-cart/'.$package->id) }}" class="btn  btn-sm btn-primary">Book Now</a> -->
                  <a href="{{ url('/mygym/packages/'.$package->id) }}" class="btn  btn-sm btn-primary">Book Now</a>
                  </div>     
            </div>
          </li>
          @endforeach
     
        </ul>
      </div>
    </div>
  </div>
  @endif
              
  </div>


  
 @include('users.cart')
</div>
  </div>

  <div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Gym Video</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <video width="img-fluid" height="240" controls>
                      <source src="{{asset('gyms/'.$gymdetail[0]->video_link)}}" type="video/mp4">
                      
                    </video>
      </div>

    </div>
  </div>
</div>
  @include('users.footer')

    <script>
        $(document).ready(function(){

  $(".packagedetail").click(function(){
          $("body").addClass("sidebar_active_right")
        })
         $(".overlay-sidebar").click(function(){
          $("body").removeClass("sidebar_active_right")
        })


          $("#g_about").click(function(){
            $("#aboutgym").fadeIn();
            $("#gympackages").fadeOut();
            $("#g_about").addClass("active");
            $("#g-package").removeClass("active");
          });
          $("#g-package").click(function(){
            $("#aboutgym").fadeOut();
            $("#gympackages").fadeIn();
            $("#g-package").addClass("active");
            $("#g_about").removeClass("active");
          })



            $('.success-box').hide();
            /* 1. Visualizing things on Hover - See next part for action on click */
            $('#stars li').on('mouseover', function(){
                var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on

                // Now highlight all the stars that's not after the current hovered star
                $(this).parent().children('li.star').each(function(e){
                    if (e < onStar) {
                        $(this).addClass('hover');
                    }
                    else {
                        $(this).removeClass('hover');
                    }
                });

            }).on('mouseout', function(){
                $(this).parent().children('li.star').each(function(e){
                    $(this).removeClass('hover');
                });
            });


            /* 2. Action to perform on click */
            $('#stars li').on('click', function(){
                var onStar = parseInt($(this).data('value'), 10); // The star currently selected
                var stars = $(this).parent().children('li.star');

                for (i = 0; i < stars.length; i++) {
                    $(stars[i]).removeClass('selected');
                }

                for (i = 0; i < onStar; i++) {
                    $(stars[i]).addClass('selected');
                }

                // JUST RESPONSE (Not needed)
                var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
                var msg = "";
                if (ratingValue > 1) {
                    msg = "Thanks! You rated this " + '<b>' +ratingValue+ '</b>' + " stars.";
                }
                else {
                    msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
                }
                responseMessage(msg);

            });


        });


        function responseMessage(msg) {

            $('.success-box').fadeIn(200);
            $('.success-box .text-message').html("<span>" + msg + "</span>");
        }
    </script>
 @endsection('content')