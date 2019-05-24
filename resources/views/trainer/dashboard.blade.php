@extends('layouts.trainer-app')

@section('content') 
<!--  BEGIN CONTENT PART  -->
<div id="content" class="main-content">
  <div class="container">
    <div class="page-header">
      <div class="page-title">
        <h3>Dashboard</h3>
      </div>
    </div>
    <div class="row layout-spacing ">
      <div class="col-xl-4 mb-xl-0 col-lg-6 mb-4 col-md-6 col-sm-6">
        <div class="widget-content-area  data-widgets br-4">
          <div class="widget  t-sales-widget">
            <div class="media">
              <div class="icon ml-2">
                <i class="flaticon-3d-cube"></i>
              </div>
              <div class="media-body text-right">
                <p class="widget-text mb-0">Packages</p>
                <p class="widget-numeric-value">{{$packages}}</p>
              </div>
            </div>
            <a href="{{ route('packages') }}" class="btn btn-outline-dark btn-sm">View All</a>
          </div>
        </div>
      </div>
      <div class="col-xl-4 mb-xl-0 col-lg-6 mb-4 col-md-6 col-sm-6">
        <div class="widget-content-area  data-widgets br-4">
          <div class="widget  t-order-widget">
            <div class="media">
              <div class="icon ml-2">
                <i class="flaticon-user-11"></i>
              </div>
              <div class="media-body text-right">
                <p class="widget-text mb-0">Customers</p>
                <p class="widget-numeric-value">{{count($users)}}</p>
              </div>
            </div>
              <a class="btn btn-outline-dark btn-sm" href="{{ route('getmycustmer') }}">
              View All </a>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 mb-sm-0 mb-4">
        <div class="widget-content-area  data-widgets br-4">
          <div class="widget  t-customer-widget">
            <div class="media">
              <div class="icon ml-2">
                <i class="flaticon-copy-document"></i>
              </div>
              <div class="media-body text-right">
                <p class="widget-text mb-0">Orders</p>
                <p class="widget-numeric-value">{{count($myOrders)}}</p>
              </div>
            </div>
            <a class="btn btn-outline-dark btn-sm" href="{{ route('getmyorder') }}">View All </a>
          </div>
        </div>
      </div>
    </div>
    <div class="row layout-spacing">
      <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 layout-spacing">
        <div class="widget-content widget-content-area h-100 br-4 p-0">
          <div class="total-page-views">
            <div class="t-page-views-header">
              <div class="row">
                <div class="col-md-6 col-6">
                  <h6>Monthly sales</h6>
                </div>
                <div class="col-md-6 col-6">
                  <ul class="nav justify-content-sm-end justify-content-center total-page-views-tab nav-pills" id="pills-tab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="total-page-views-monthly-tab" data-toggle="pill" href="#total-page-views-monthly" role="tab" aria-controls="total-page-views-monthly" aria-selected="true">Monthly</a>
                    </li>
                    <!-- <li class="nav-item">
                      <a class="nav-link" id="total-page-views-yearly-tab" data-toggle="pill" href="#total-page-views-yearly" role="tab" aria-controls="total-page-views-yearly" aria-selected="false">Yearly</a>
                    </li> -->
                  </ul>
                </div>
              </div>
            </div>
            <div class="t-page-views-body">
              <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="total-page-views-monthly" role="tabpanel" aria-labelledby="total-page-views-monthly-tab">
                  <div class="d-flex">
                    <div class="d-m-rate align-self-center mr-1 data-marker"></div>
                    <span class="rate"><?php if(isset($totalIncome->sales)){echo $totalIncome->sales;} ?> </span>
                  </div>
                  <div id="page-views-monthly" class="mt-4"></div>
                </div>
                <!-- <div class="tab-pane fade" id="total-page-views-yearly" role="tabpanel" aria-labelledby="total-page-views-yearly-tab">
                  <div class="d-flex">
                    <div class="d-m-rate align-self-center mr-1 data-marker"></div>
                    <span class="rate">2,70,040</span>
                  </div>
                  <div id="page-views-yearly" class="mt-4"></div>
                </div> -->
              </div>
            </div>
          </div>                            
        </div>
      </div>
      <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 layout-spacing">
        <div class="row">
          <div class="col-md-12 mb-4">
            <div class="widget-content-area p-0 br-4">
              <div class="widget-content widget-content-area h-100 br-4 p-0 text-center">
                <div class="row">
                  <div class="col-md-6 col-sm-6 col-12 pr-sm-0">
                    <div class="date br-4">
                      <div id="month"></div>
                      <div id="day"></div>
                      <div id="week"></div>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-6 col-12 pl-0">
                    <div class="time">
                      <p id="hour" class="mb-0"></p>
                      <p id="minut" class="mb-0"></p>
                      <p id="date" class="mb-0"></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>                                
          </div>
          <div class="col-md-12">
            <div class="widget-content widget-content-area h-100 br-4 p-0">
              <div class="reviews">
                <div class="reviews-header">
                  <div class="row">
                    <div class="col-md-12">
                      <h6>Reviews</h6>
                    </div>
                  </div>
                </div>
                <div class="reviews-body text-center">
                  <div class="row">
                    <div class="col-md-6 col-6">
                      <p class="r-positive-txt">Positive</p>
                        <img alt="emoji" class="icon-positive mt-2" src="{{asset('theme/assets/img/simple-smile.png')}}">
                      <p class="r-positive-percentage mb-0 mt-4">78%</p>
                    </div>
                    <div class="col-md-6 col-6">
                      <p class="r-negative-txt">Negative</p>
                        <img alt="emoji" class="icon-positive mt-2" src="{{asset('theme/assets/img/simple-sad-smile.png')}}">
                      <p class="r-negative-percentage mb-0 mt-4">22%</p>
                    </div>
                    <div class="col-md-12 mt-4 mb-2">
                        <button class="btn btn-primary btn-rounded">View Details</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>                                
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END PAGE LEVEL SCRIPTS --> 
@endsection

