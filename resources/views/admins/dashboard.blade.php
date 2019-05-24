@extends('layouts.admin-app')

@section('content')
 <div class="container-fluid page-body-wrapper">
     @include('admins.sidebar')
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
         
          <div class="row">
            <div class="col-sm-4 grid-margin stretch-card">
              <div class="card card-statistics" style="min-height: 200px;">
                <div class="card-body" >
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-cube text-danger icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Packages</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">{{$gymPackage}}</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <a href="{{route('getAllPackages')}}" class="btn btn-block btn-primary">View All</a>
                  </p>
                </div>
              </div>
            </div>
            <div class="  col-sm-4 grid-margin stretch-card">
              <div class="card card-statistics" style="min-height: 200px;">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-account-location text-info icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Users</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">{{count($users)}}</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <a href="{{ route('getallusers') }}" class="btn btn-block btn-primary">View All</a>
                  </p>
                </div>
              </div>
            </div>
            <div class="  col-sm-4 grid-margin stretch-card">
              <div class="card card-statistics" style="min-height: 200px;">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-ticket-account text-warning icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Sellers</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">{{$sellers}}</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <a href="{{route('getAllSellers')}}" class="btn btn-block btn-primary">View All</a>
                  </p>
                </div>
              </div>
            </div>
            <div class="  col-sm-4 grid-margin stretch-card">
              <div class="card card-statistics" style="min-height: 200px;">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-ticket-account text-warning icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Trainers</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">{{$trainers}}</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <a href="{{route('getAllTrainers')}}" class="btn btn-block btn-primary">View All</a>
                  </p>
                </div>
              </div>
            </div>
             <div class="  col-sm-4 grid-margin stretch-card">
              <div class="card card-statistics" style="min-height: 200px;">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-cart-outline text-warning icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Orders</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">{{$orders}}</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <a href="{{route('getAllOrders')}}" class="btn btn-block btn-primary">View All</a>
                  </p>
                </div>
              </div>
            </div>
             <div class="  col-sm-4 grid-margin stretch-card">
              <div class="card card-statistics" style="min-height: 200px;">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-city icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Cities</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">{{$gymCity}}</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <a href="{{route('getAllCities')}}" class="btn btn-block btn-primary">View All</a>
                  </p>
                </div>
              </div>
            </div>
             <div class="  col-sm-4 grid-margin stretch-card">
              <div class="card card-statistics" style="min-height: 200px;">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-keyboard-close text-danger icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Gym Category</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">{{$gymCategory}}</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <a href="{{route('getAllGymCategories')}}" class="btn btn-block btn-primary">View All</a>
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
              <div class="col-md-6">
                <div class="card ">
                    <div class="card-header">
                        <h3>Total Sales</h3>
                    </div>
                    <div class="card-block">
                        <div id="chart1"></div>
                    </div>
                </div>
            </div>
                  <div class="col-md-6">
                <div class="card ">
                    <div class="card-header">
                        <h3>Total/Admin Sales</h3>
                    </div>
                    <div class="card-block">
                        <div id="chart2"></div>
                    </div>
                </div>
            </div>
            </div>

       
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        @include('admins.footer')
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>

@endsection
