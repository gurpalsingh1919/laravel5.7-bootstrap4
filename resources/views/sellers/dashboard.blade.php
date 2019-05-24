@extends('layouts.sellers-app')

@section('content')
 <div class="container-fluid page-body-wrapper">
     @include('sellers.sidebar')
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
         
          <div class="row">
            <div class="col-sm-4 col-md-4 grid-margin">
              <div class="card card-statistics" style="min-height: auto">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-cube text-danger icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Packages</p>
                      <div class="fluid-container">
                        <h2 class="font-weight-medium text-right mb-0">{{count($packages)}}</h2>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <a href="{{ route('packages') }}" class="btn btn-block btn-primary">View All</a>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-sm-4 col-md-4 grid-margin">
              <div class="card card-statistics" style="min-height: auto">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-account-location text-info icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Customers</p>
                      <div class="fluid-container">
                        <h2 class="font-weight-medium text-right mb-0">{{count($users)}}</h2>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <a href="{{ route('getmycustmer') }}" class="btn btn-block btn-primary">View All</a>
                  </p>
                </div>
              </div>
            </div>
             <div class="col-sm-4 col-md-4 grid-margin" >
              <div class="card card-statistics" style="min-height: auto">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <!-- <i class="mdi mdi-account-location text-info icon-lg"></i> -->
                      <i class="mdi mdi-receipt text-warning icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Orders</p>
                      <div class="fluid-container">
                        <h2 class="font-weight-medium text-right mb-0">{{count($myOrders)}}</h2>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <a href="{{ route('getmyorder') }}" class="btn btn-block btn-primary">View All</a>
                  </p>
                </div>
              </div>
            </div>
          </div>
         <div id="salesreport" data-sales='{{$salesArr}}'></div>
          <div class="row">
              <div class="col-md-12">
                <div class="card ">
                    <div class="card-header">
                        <h3>Total Sales</h3>
                    </div>
                    <div class="card-block">
                        <div id="chart1"></div>
                    </div>
                </div>
            </div>
          </div>

       
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
         @include('sellers.footer')
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>

@endsection
