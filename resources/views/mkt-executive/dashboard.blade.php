@extends('layouts.mktexecutive-app')

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
                        <p class="widget-text mb-0">Sellers</p>
                        <p class="widget-numeric-value">{{$Sellers}}</p>
                    </div>
                </div>
                 <a href="{{route('mysellers')}}">
                <button class="btn btn-outline-dark btn-sm" type="button">View All </button>
              </a>
                 
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
                        <p class="widget-text mb-0">Packages</p>
                        <p class="widget-numeric-value">{{$Packages}}</p>
                    </div>
                </div>
                <a href="{{route('salesExePackagesList')}}">
                 <button class="btn btn-outline-dark btn-sm" type="button">View All </button>
                </a>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 mb-sm-0 mb-4">
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
    </div>


</div>
<div class="row layout-spacing">
        <div class="col-lg-12">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">                                
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Timeseries Descendent Chart</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <div id="timeseries_descendent_charts"></div>
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

