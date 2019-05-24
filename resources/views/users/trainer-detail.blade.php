@extends('layouts.users-app')

@section('content')
  <?php $gym_imagess = explode('|', $gymdetail->gym_images); ?>
    @if($gymdetail->seller_type =='1')
      <div class="inner-banner detail-ban">
        <div class="container">
          <div class="row">
            <div class="col-md-3">
              @if($gymdetail->seller_type=='1')
                @foreach($gym_imagess as $index=>$image)
                  @if($index==0)
                    <img src="{{ asset('/gyms') }}/{{$image}}" class="img-fluid"/>
                  @endif
                @endforeach
              @elseif($gymdetail->seller_type=='2')
                <img src="{{ asset('/images/user/'.$gymdetail->user->image) }}" class="img-fluid"/>
              @endif
            </div>
            <div class="col-md-9">
              @if($gymdetail->seller_type=='1')
                  <h3>{{$gymdetail->gym_name}}</h3>
                  <p>{{$gymdetail->gym_description}}</p>
              @elseif($gymdetail->seller_type=='2')
                  <h3>{{$gymdetail->user->name}}</h3>
                  <p>Experience:: {{$gymdetail->experience}}</p>
                  <p>Expertise:: {{$gymdetail->expertise}}</p>
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
                @if($gymdetail->seller_type=='1')
                <li>
                  <p><b class="text-uppercase">closed</b>12pm - 1pm </p>
                </li>
                @endif
              </ul>
              @if($gymdetail->seller_type=='1')
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                    Play Video
                </button>
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
                <a href="{{ url('/mygym/'.$gymdetail->id) }}"><i class="fas fa-info"></i>About</a>
              </li>
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
            </ul>
          </div>
          <br/>
          <div class="facilities">
            <?php $facilit=explode("|", $gymdetail->facilities);
                  $timings=json_decode($gymdetail->timing)   ?>
            <h6>Facilities</h6>
            <div class="tags mt-2 border-bottom pb-3">
                @if(isset($facilit) && is_array($facilit))
                @foreach($facilit as $facility)
                <span class="badge badge-secondary mb-2">{{$facility}}</span>
                @endforeach
                @else
                <span class="badge badge-secondary mb-2">Facilities not added.</span>
                
                @endif
            </div>
            <br/>
            <div class="border-bottom pb-3">
              <h6>Timings</h6>
                <table class="small custom-table">
                  <tbody>
                    @if(isset($timings))
                      @foreach($timings as $key=>$val)
                      <tr class="K7Ltle">
                          <td class="SKNSIb">{{$key}}</td>
                          <td>{{$val}}</td>
                      </tr>
                      @endforeach
                    @else
                    <tr>
                        <td colspan="2">Timings not added.</td>
                    </tr>
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="col-lg-6 right-content">
            @if(session('error'))
              <div class="error alert alert-danger alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Error : </strong> {{ session('error') }}
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
              @if($gymdetail->seller_type=='1')
                <div class="row" id="aboutgym">
                  <div class="col-md-12">
                    <div class="gallerybio">
                      <div id="carousel-thumb" class="carousel slide carousel-fade  carousel-thumbnails" data-ride="carousel">
                        <!--Slides-->
                        <div class="carousel-inner" role="listbox">
                          @foreach($gym_imagess as $index=>$image)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                              <img src="{{ asset('/gyms') }}/{{$image}}" class="img-fluid imageThumb"/>
                            </div>
                          @endforeach
                        </div>
                          <!--Controls-->
                        <a class="carousel-control-prev" href="#carousel-thumb" role="button"
                           data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel-thumb" role="button"
                           data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                        <!--/.Controls-->
                        <ol class="carousel-indicators">
                            @foreach($gym_imagess as $index=>$image)
                                <li data-target="#carousel-thumb" data-slide-to="{{$index}}"
                                    class="{{ $loop->first ? 'active' : '' }}">
                                    <img class="d-block" src="{{ asset('/gyms') }}/{{$image}}"
                                         class="img-fluid">
                                </li>
                            @endforeach
                        </ol>
                      </div>
                      <!--/.Carousel Wrapper-->
                    </div>
                    <h3>About</h3>
                    <p>{{$gymdetail->gym_description}}<br/>
                      <div class="address alert-info alert">
                      <h5>Address</h5>
                  <p>{{$gymdetail->gym_address.' ,'.$gymdetail->zip.','.$gymdetail->city}}
                        <br/>
                    <div class="rating small">
                      <span style="color: #ffc107"><i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i></span><b> 5 Start Rating</b>
                    </div>
                    <hr style="border-color: #d2d2d2"/>
                    <div class="d-flex justify-content-between">
                      @if($gymdetail->website_link !='')
                        <a href="{{$gymdetail[0]->website_link}}" target="_blank">Visit Website</a>
                      @endif
                      <button type="button" class="btn btn-primary" data-toggle="modal"
                              data-target="#myModal">Watch Video
                      </button>
                    </div>
                  </p>
                </div>
                <div class="clearfix"></div>
                <div class="mb-5"></div>
              </div>
            </div>
            @elseif($gymdetail->seller_type=='2')
              <div class="row" id="aboutgym">
                <div class="col-md-12">
                  <h3>About</h3>
                  <div class="d-flex justify-content-between">
                      <div class="">
                          <table class="table table-borderless mt-2 mb-5 small">
                              <tr>
                                  <th>Experience</th>
                                  <td>{{$gymdetail->experience}}</td>
                              </tr>
                              <tr>
                                  <th>Expertise</th>
                                  <td>{{$gymdetail->expertise}}</td>
                              </tr>
                              <tr>
                                  <th>Area of Expertise</th>
                                  <td>{{$gymdetail->type_of_expertise}}</td>
                              </tr>
                              <tr>
                                  <th>Payment Mode</th>
                                  <td>@if($gymdetail->payment_mode=='1'){{__('Monthly')}}@else{{__('Hourly')}}@endif</td>
                              </tr>
                              <tr>
                                  <th>Gender</th>
                                  <td>@if($gymdetail->gender=='1'){{__('Male')}}@else{{__('Female')}}@endif</td>
                              </tr>
                          </table>
                      </div>
                      <div class="profile-outer">
                          <div class="profile">
                              <div class="image-container">
                                  <img src="{{asset('/images/user/'.$gymdetail->user->image)}}" height="100px">
                              </div>
                              <p>{{$gymdetail->user->name}}</p>
                          </div>
                      </div>
                  </div>
                  <div class="address alert-info alert">
                    <h5>Address</h5>
                    <p>{{$gymdetail->gym_address.' ,'.$gymdetail->zip.','.$gymdetail->city}}
                        <br/>
                    <div class="rating small">
                      <span style="color: #ffc107"><i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i>
                      <i class="fas fa-star"></i></span><b> 5 Start Rating</b>
                    </div>
                    <hr style="border-color: #d2d2d2"/>
                    <div class="d-flex justify-content-between">
                        @if($gymdetail->website_link !='')
                            <a href="{{$gymdetail[0]->website_link}}" target="_blank">Visit Website</a>
                    @endif
                    <!--  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Watch Video</button> -->
                    </div>
                    </p>
                  </div>
                  <div class="clearfix"></div>
                  <div class="mb-5"></div>
                </div>
              </div>
            @endif
            @else
             <div id="gympackages">
              <div class="row">
                <div class="col-md-12">
                  <div class="d-flex justify-content-between">
                  <h3>Packages</h3>
                    <small class="dropdown ">
                      <p class="small dropdown-toggle btn border-bottom" data-toggle="dropdown">
                          Sort By <span>Popularity</span>
                      </p>
                      <div class="dropdown-menu">
                          <a class="dropdown-item" href="#">Link 1</a>
                          <a class="dropdown-item" href="#">Link 2</a>
                          <a class="dropdown-item" href="#">Link 3</a>
                      </div>
                    </small>
                  </div>
                </div>
              </div>
              <br/>
              <div class="row">
                <div class="col-md-12">
                  <ul class="c_listing row">
                    @foreach($gymdetail->packages as $package)
                      <li class="col-md-6">
                        <div class="card">
                          <div class="image-container">
                            <img class="card-img-top" src="{{ asset('/package/'.$package->image) }}"
                                   alt="Card image cap">
                            <div class="p_price">
                                  <?php $pack = ''; $allpacks = ''; $prices = ''; ?>
                              @foreach($package->packageMemberships as $index=>$membership)
                                <?php
                                $allpack = PackagetoPrice::get_duration_fullname($membership->duration);
                                $total_price = PackagetoPrice::get_package_price($membership->price, $membership->admin_comission);
                                $price_format = '₹' . number_format((float)$total_price, 2, '.', '');
                                if (!$loop->last) {
                                    $allpacks .= $allpack . ', ';
                                    $prices .= $price_format . ', ';
                                } else {
                                    $allpacks .= $allpack;
                                    $prices .= $price_format;
                                }

                                ?>
                                @if($index==0)
                                    <?php $pack = PackagetoPrice::get_duration_fullname($membership->duration);?>
                                    {{$price_format}}
                                @elseif($loop->last)
                                    <?php $pack .= " - " . PackagetoPrice::get_duration_fullname($membership->duration);

                                    ?>
                                    {{' - '.$price_format}}
                                @endif
                              @endforeach
                            </div>
                            <div class="membership">
                                #membership
                            </div>
                          </div>
                          <div class="r_content pb-0 pt-2">
                            <br/>
                            <a href="{{ url('/mygym/packages/'.$package->id) }}"/>
                            <h6 class="card-title mb-0">{{substr(ucfirst($package->title), 0, 20)}}</h6>
                            </a>
                            <div class="d-flex small justify-content-between"
                                 style="color: #9b9b9b;">
                              <div>{{$pack}}</div>
                              <div>
                                <a href="javascript:void(0);" class="packagedetail"
                                  data-title="{{ucfirst($package->title)}}"
                                  data-package="{{$package->id}}" 
                                  data-description="{{ucfirst($package->description)}}" data-allpacks="{{$allpacks}}" data-price="{{$prices}}"
                                  data-image="{{ asset('/package/'.$package->image) }}">
                                  View Detail
                                </a>
                              </div>
                            </div>
                            <p class="d-none card-text">{{substr(ucfirst($package->description), 0, 40)}}
                                <a href="{{ url('/mygym/packages/'.$package->id) }}"/> ...Read
                                More</a></p>
                          </div>
                          <hr/>
                          <div class="d-block text-right pl-2 pr-2">
                              <a href="{{ url('/mygym/packages/'.$package->id) }}"
                                 class="btn  btn-sm btn-primary">Book Now</a>
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
                        <source src="{{asset('gyms/'.$gymdetail->video_link)}}" type="video/mp4">
                    </video>
                </div>
            </div>
        </div>
    </div>
    <!------------------ Sidebar ------------------------>
    <div class="sidebar-right sidebar-left">
        <div class="image-container">
            <img class="img-fluid" id="pack_image" style="height: 200px;"
                 src="http://localhost/gym/public/package/5876_arsxk8.jpg" alt="Card image cap">
        </div>
        <div class="d-flex justify-content-between p-3">
            <div class="p-social-link">
                <a href="#"><img src="{{url('images/facebook-copy-min.png')}}"/> </a>
                <a href="#"><img src="{{url('images/twitter-copy-min.png')}}"/> </a>
                <a href="#"><img src="{{url('images/linkedin-copy-min.png')}}"/> </a>
                <a href="#"><img src="{{url('images/email-min.png')}}"/> </a>
            </div>
            <a href="{{ url('/mygym/packages/') }}" id="pack_url">
              <button type="button" class="btn btn-primary">Book Now</button>
            </a>
        </div>
        <div class="p-3 p-description">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action">
                    <i class="fas fa-th-large mr-2"></i><b><label id="pack_title"></label></b> </a>
            </div>
            <div class="p-detail mt-3">
                <h6>Details</h6>
                <ul class="small mt-2">
                    <li><i class="far fa-calendar-alt mr-2"></i><span id="pack_duration"></span></li>
                    <li><i class="fas fa-tags mr-2"></i><span id="pack_price"></span></li>
                    <!-- <li><i class="fas fa-tags"></i> Joining Fee: 10.00 INR</li> -->
                </ul>
            </div>
            <div class="p-detail mt-3 border-top pt-3">
                <h6>Description</h6>
                <p id="pack_description"></p>
            </div>
        </div>
    </div>

    @include('users.footer')

    <script>
        $(document).ready(function () {

            $(".packagedetail").click(function () {
                console.log();
                $("#pack_title").html($(this).data('title'));
                $("#pack_description").html($(this).data('description'));
                $("#pack_duration").html($(this).data('allpacks'));
                $("#pack_price").html($(this).data('price'));
                $("#pack_image").attr("src", $(this).data('image'));
                var url='{{url("/mygym/packages/")}}/'+ $(this).data('package');
                $("#pack_url").attr("href", url);


                $("body").addClass("sidebar_active_right")
            })
            $(".overlay-sidebar").click(function () {
                $("body").removeClass("sidebar_active_right")
            })


            $("#g_about").click(function () {
                $("#aboutgym").fadeIn();
                $("#gympackages").fadeOut();
                $("#g_about").addClass("active");
                $("#g-package").removeClass("active");
            });
            $("#g-package").click(function () {
                $("#aboutgym").fadeOut();
                $("#gympackages").fadeIn();
                $("#g-package").addClass("active");
                $("#g_about").removeClass("active");
            })


            $('.success-box').hide();
            /* 1. Visualizing things on Hover - See next part for action on click */
            $('#stars li').on('mouseover', function () {
                var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on

                // Now highlight all the stars that's not after the current hovered star
                $(this).parent().children('li.star').each(function (e) {
                    if (e < onStar) {
                        $(this).addClass('hover');
                    } else {
                        $(this).removeClass('hover');
                    }
                });

            }).on('mouseout', function () {
                $(this).parent().children('li.star').each(function (e) {
                    $(this).removeClass('hover');
                });
            });


            /* 2. Action to perform on click */
            $('#stars li').on('click', function () {
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
                    msg = "Thanks! You rated this " + '<b>' + ratingValue + '</b>' + " stars.";
                } else {
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