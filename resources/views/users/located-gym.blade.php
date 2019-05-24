@extends('layouts.users-app')

@section('content')
<!-- content start here -->
<div class="inner-banner">
<div class=" container">
<div class="owl-carousel owl-theme">
    @foreach($promotions as $promotion)
        <div><img src="{{ asset('promotion/'.$promotion->image) }}"/></div>
@endforeach
<!-- <div> <img src="{{ asset('fontend/images/ads2.png') }}" /></div>
<div> <img src="{{ asset('fontend/images/ads3.png') }}" /></div> -->

</div>
</div>
</div>
<div class="breadcrumb p-0 m-0 pt-2">
<div class="container">
{{ Breadcrumbs::render('location',$city,$cat_id) }}
</div>
</div>
<div class="container pt-5">
<div class="row">
<div class="col-lg-3">
    <ul class="sidebar-filter">
        <li class="{{$cat_id == '0' ? 'active' : '' }}">
            <a href="0">
                <i class="fa fa-align-justify" aria-hidden="true"></i>All
                <span>{{$total}} Options</span>
            </a>
        </li>
        @foreach($new_category_sum as $key=>$category)

            <li class="{{$cat_id == $key ? 'active' : '' }}">
                <a href="{{$key}}">
                    @if($key=='1')
                        <i class="fas fa-dumbbell"></i>


                    @elseif($key=='2')
                        <i class="fa fa-american-sign-language-interpreting"></i>

                    @elseif($key=='3')
                        <i class="fa fa-assistive-listening-systems" aria-hidden="true"></i>

                    @elseif($key=='4')
                        <img height="25" src="{{asset('icons/yoga.png')}}">

                    @elseif($key=='5')
                        <img height="25" src="{{asset('icons/dance.png')}}">

                    @endif

                    {{ucfirst($category['gym_name'])}}
                    <span>

{{$category['gym_sum']}}

Options</span>
                </a>
            </li>

        @endforeach

    </ul>
</div>
<div class="col-lg-9 gymlisting">
    @if(session('error'))
        <div class="error alert alert-danger alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error : </strong> {{ session('error') }}
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
            <h3>{{$title}}</h3>
        </div>
    </div>
    <br/>

    <div class="row">

        <?php $flag = 0; ?>
        @foreach($yourlocationgyms as $value)

            <?php $category_id = explode('|', $value['category_id']);

            //echo "<pre>";print_r($category_id);die;
            ?>
            @if($value['seller_type']=='1' && (in_array($cat_id, $category_id) || $cat_id==0 ))





                <div class="col-md-4 mb-4">

                    <div class="card">
                        <a href="{{ url('/mygym/'.$value['id']) }}">

                            <div class="image-container">

                                <?php $gym_imagess = explode('|', $value['gym_images']); ?>
                                @foreach($gym_imagess as $index=>$image)
                                    @if($index==0)
                                        <img height="250" width="250" class="card-img-top"
                                             src="{{ asset('/gyms') }}/{{$image}}"
                                             alt="{{$value['gym_name']}}"/>
                                    @endif
                                @endforeach
                            </div>
                        </a>
                        <div class="card-body pl-0 pr-0 pt-2 pb-0">

                            <strong class="card-title">{{substr($value['gym_name'], 0, 20)}}</strong>
                            <p class="card-text small mb-2">{{substr($value['gym_description'], 0, 40)}}</p>
                            <div class="d-flex justify-content-between">
                                <small class="badge badge-success mb-2 mr-2">
                                    <i class="fas fa-star"></i> 4.1
                                </small>
                                <small class="offers-info" style=""><i class="fas fa-percentage"></i> 20%
                                    off on all orders
                                </small>
                            </div>
                            <hr/>
                            @if(count($value['packages']) >0)
                                <div class="text-center">

                                    <a title="<div class='quickview'> 
                                <div class='row hoverdivs'> 
                                    <div class='col-md-4 text-center justify-content-center align-self-center'> 
                                        <div class=''> 
                                            <strong>{{$value->gym_name}}</strong> <hr/> <small class='text-left'>{{$value->gym_address.' ,'.$value->zip.','.$value->city}}</small> 
                                        </div>
                                    </div>
                                    <div class='col-md-8 pt-3'> 
                                        <div class='row'> 
                                            @foreach($value->packages as $index=>$packages)
                                              @if ($index <= 3)
                                              <?php $images = explode('|', $packages->package_images);  ?>
                                                <div class='col-md-6'> 
                                                    <div class=''> 
                                                        <div class='image-container'> 
                                                            <img height='100' width='80' class='img-fluid' src='{{  asset('/package/'.$images[0]) }}/'/> 
                                                        </div>
                                                        <div class='card-body pl-0 pr-0 pt-2'> 
                                                            <strong>{{$packages->title}}</strong> 
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>"
                            href="{{ url('/mygym/'.$value['id']) }}" class=" cus-tooltip small  custom-popup"
                            data-toggle="tooltip" data-html="true">Quick View</a>

                                </div>
                            @endif

                        </div>

                    </div>

                </div>


                <?php $flag++ ?>
            @endif
        @endforeach
    </div>
</div>
</div>
</div>
@include('users.footer')
<script src="{{ asset('fontend/js/owl.carousel.js') }}"></script>

<script type="text/javascript">
$(document).ready(function () {
$(".owl-carousel").owlCarousel({
    nav: true,
    loop: true,
    autoplay: true,
    autoplayTimeout: 2000,
    autoplayHoverPause: true,
    navText: ["<img src='{{ asset('fontend/images/left.png') }}'>", "<img src='{{ asset('fontend/images/right.png') }}'>"],
    margin: 10,

    responsive: {
        0: {
            items: 1,
        },
        600: {
            items: 3,
        },
        1000: {
            items: 4,
        }
    }
});
$('.owl-carousel').find('.owl-nav').removeClass('disabled');
$('.owl-carousel').on('changed.owl.carousel', function (event) {
    $(this).find('.owl-nav').removeClass('disabled');
});
});


</script>
@endsection('content')