@extends('layouts.users-app')
@section('content')

    <link href="{{ asset('css/product.css') }}" rel="stylesheet">
    <div class="breadcrumb p-0 m-0 pt-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="http://localhost/gym/public">Home</a></li>
                <li class="breadcrumb-item active">vijayawada</li>
            </ol>
        </div>
    </div>
    <div class="container">

        <div class="row ">
            <div class="col-lg-12 pt-5">

                <br/>
                <div class="gymlisting products row">
                    <div class="col-md-6 pl-0">
                        <img class="img-fluid" src="{{asset(url('images/excite_climb_unity_businessuse.jpg'))}}">
                    </div>
                    <div class="col-md-6">
                        <h4>Ascend beyond your limits</h4>
                        <p>What makes Excite® Climb so unique is the SPLIT STEP TECHNOLOGY (patent pending). Developed
                            by Technogym’s R&D Department, this breakthrough transforms this stair climber into one of
                            the most sought-after pieces of cardio equipment on the gym floor, thanks to its welcoming
                            design, ease of use and effectiveness.
                        </p>
                    </div>
                </div>
            </div>
            <br/>


        </div>
    </div>
    <div class="container-fluid">
        <div class="">
        <div class="row slider_pro">
            <div id="demo" class="carousel slide productslider" data-ride="carousel">

                <!-- Indicators -->
                <ul class="carousel-indicators">
                    <li data-target="#demo" data-slide-to="0" class="active"></li>
                    <li data-target="#demo" data-slide-to="1"></li>
                    <li data-target="#demo" data-slide-to="2"></li>
                </ul>

                <!-- The slideshow -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="pt-3 m-5 col-md-8">
                                    <br/>
                                    <strong class="text-uppercase text-muted">Features</strong>
                                    <br/>
                                    <br/>
                                    <h3 class="mb-4">Ascend beyond your limits</h3>
                                    <p>An innovative breakthrough in the market by Technogym, the 26.5 cm/10 in low
                                        Courtesy Step™ (patent pending) automatically repositions itself at the
                                        lowest height at the end of the workout to simplify getting on.
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <img class="img-fluid"
                                     src="{{asset(url('/images/excite_climb_unity_mainfeature_07.jpg'))}}">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="pt-3 m-5 col-md-8">
                                    <br/>
                                    <strong class="text-uppercase text-muted">Features</strong>
                                    <br/>
                                    <br/>
                                    <h3 class="mb-4">Ascend beyond your limits</h3>
                                    <p>An innovative breakthrough in the market by Technogym, the 26.5 cm/10 in low
                                        Courtesy Step™ (patent pending) automatically repositions itself at the
                                        lowest height at the end of the workout to simplify getting on.
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <img class="img-fluid"
                                     src="{{asset(url('/images/excite_climb_unity_mainfeature_07.jpg'))}}">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="pt-3 m-5 col-md-8">
                                    <br/>
                                    <strong class="text-uppercase text-muted">Features</strong>
                                    <br/>
                                    <br/>
                                    <h3 class="mb-4">Ascend beyond your limits</h3>
                                    <p>An innovative breakthrough in the market by Technogym, the 26.5 cm/10 in low
                                        Courtesy Step™ (patent pending) automatically repositions itself at the
                                        lowest height at the end of the workout to simplify getting on.
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <img class="img-fluid"
                                     src="{{asset(url('/images/excite_climb_unity_mainfeature_07.jpg'))}}">
                            </div>
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


        <div class="row">
            <div class="col-md-4 text-center">
                <img src="{{asset(url('/images/excite_climb_unity_secondaryfeature_01.jpg'))}}"/><br/>
                <h6>Lowest height in the market</h6>
                <p>
                    Thanks to its reduced height (189 cm/74 in), it is not only less intimidating, but it also
                    overcomes ceiling restraints and harmonizes with lower height
                    equipment.
                </p>
            </div>
            <div class="col-md-4 text-center">
                <img src="{{asset(url('/images/excite_climb_unity_secondaryfeature_01.jpg'))}}"/><br/>
                <h6>Lowest height in the market</h6>
                <p>
                    Thanks to its reduced height (189 cm/74 in), it is not only less intimidating, but it also
                    overcomes ceiling restraints and harmonizes with lower height
                    equipment.
                </p>
            </div>
            <div class="col-md-4 text-center">
                <img src="{{asset(url('/images/excite_climb_unity_secondaryfeature_01.jpg'))}}"/><br/>
                <h6>Lowest height in the market</h6>
                <p>
                    Thanks to its reduced height (189 cm/74 in), it is not only less intimidating, but it also
                    overcomes ceiling restraints and harmonizes with lower height
                    equipment.
                </p>
            </div>
        </div>
        <br/><br/>
    </div>

    <div class="specifications pt-5 pb-5">
        <div class="container">
            <h3>SPECIFICATIONS</h3>
            <div class="row mt-5">
                <div class="col-md-3">
                    <strong>Dimensions (LxWxH)</strong>
                    <p>1300 x 770 x 1890 mm (51’’x 30’’x 74”)</p>
                </div>
                <div class="col-md-3">
                    <strong>First step height from the ground</strong>
                    <p>265 mm (10”)</p>
                </div>
                <div class="col-md-3">
                    <strong>Step depth</strong>
                    <p>281 mm (11”)</p>
                </div>
                <div class="col-md-3">
                    <strong>Number of steps always available</strong>
                    <p>3</p>
                </div>

            </div>
            <div class="row mt-2">
                <div class="col-md-3">
                    <strong>Split Step Technology</strong>
                    <p class="text-success"><i class="fas fa-check"></i></p>
                </div>
                <div class="col-md-3">
                    <strong>Goal-Oriented Routines</strong>
                    <p>B-Side, Sweat it out, Body Buster</p>
                </div>
                <div class="col-md-3">
                    <strong>Courtesy StepTM for easy access</strong>
                    <p>yes; height: 265 mm (10”)</p>
                </div>
                <div class="col-md-3">
                    <strong>ToeSmart Design™ for anti-toe pinching</strong>
                    <p class="text-success"><i class="fas fa-check"></i></p>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-3">
                    <strong>Smart Lateral Footrest</strong>
                    <p class="text-success"><i class="fas fa-check"></i></p>
                </div>
                <div class="col-md-3">
                    <strong>Immersive workout on infinite stairs</strong>
                    <p class="text-success"><i class="fas fa-check"></i></p>
                </div>
                <div class="col-md-3">
                    <strong>Easy cleaning</strong>
                    <p class="text-success"><i class="fas fa-check"></i></p>
                </div>
                <div class="col-md-3">
                    <strong>Footprint (sqm | sq.f)</strong>
                    <p>1 sqm (10,7 sqf)</p>
                </div>
            </div>

        </div>
    </div>

<style>
    footer{margin-top:0 }
</style>
    @include('users.footer')

@endsection('content')