 <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          
          <li class="nav-item">
            <a class="nav-link" href="{{ route('adminDashboard') }}">
              <i class="menu-icon mdi mdi-television"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon mdi mdi-content-copy"></i>
              <span class="menu-title">Seller</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('getAllSellers') }}">All</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('approvedSeller') }}">Approved</a>
                </li>
                 <li class="nav-item">
                  <a class="nav-link" href="{{ route('UnapprovedSeller') }}">Approval Pending</a>
                </li>
                 <li class="nav-item">
                  <a class="nav-link" href="{{ route('addSellerByAdmin') }}">Add Seller</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#trainer-basic" aria-expanded="false" aria-controls="trainer-basic">
              <i class="menu-icon mdi mdi-run-fast"></i>
              <span class="menu-title">Trainer</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="trainer-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('getAllTrainers') }}">All</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('approvedTrainers') }}">Approved</a>
                </li>
                 <li class="nav-item">
                  <a class="nav-link" href="{{ route('UnapprovedTrainers') }}">Approval Pending</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('addTrainer') }}">Add Trainer</a>
                </li>
                
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#mkt-basic" aria-expanded="false" aria-controls="mkt-basic">
              <i class="menu-icon mdi mdi-account-search"></i>
              <span class="menu-title">Marketing Executive</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="mkt-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('allMarketingExecutive') }}">List All</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('addMarketingExecutive') }}">Add Marketing Executive</a>
                </li>
                 
                
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#pack-basic" aria-expanded="false" aria-controls="pack-basic">
              <i class="menu-icon mdi mdi-chart-line"></i>
              <span class="menu-title">Packages</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="pack-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="{{route('getAllPackages')}}">All</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('getApprovePackages')}}">Approved</a>
                </li>
                 <li class="nav-item">
                  <a class="nav-link" href="{{route('getUnapprovePackages')}}">Approval Pending</a>
                </li>
                 <li class="nav-item">
                  <a class="nav-link" href="{{ route('AddPackageByAdmin') }}">Add New Package</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#product-basic" aria-expanded="false" aria-controls="product-basic">
              <i class="menu-icon mdi mdi-weight"></i>
              <span class="menu-title">Product</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="product-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="{{route('getAllProducts')}}">All</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('getApprovedProducts')}}">Approved</a>
                </li>
                 <li class="nav-item">
                  <a class="nav-link" href="{{route('getUnapprovedProducts')}}">Approval Pending</a>
                </li>
                 <li class="nav-item">
                  <a class="nav-link" href="{{ route('addProductByAdmin') }}">Add New Product</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#store-basic" aria-expanded="false" aria-controls="store-basic">
              <i class="menu-icon mdi mdi-store"></i>
              <span class="menu-title">Store</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="store-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="{{route('getAllStores')}}">All</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('getApprovedStores')}}">Approved</a>
                </li>
                 <li class="nav-item">
                  <a class="nav-link" href="{{route('getUnapprovedStores')}}">Approval Pending</a>
                </li>
                
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#order-basic" aria-expanded="false" aria-controls="order-basic">
              <i class="menu-icon mdi mdi-cart"></i>
              <span class="menu-title">Orders History</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="order-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="{{route('getAllOrders')}}">All</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('getCompletedOrder')}}">Success</a>
                </li>
                 <li class="nav-item">
                  <a class="nav-link" href="{{route('getFailedOrder')}}">Fail</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#promo-basic" aria-expanded="false" aria-controls="promo-basic">
              <i class="menu-icon mdi mdi-airballoon"></i>
              <span class="menu-title">Promotion and offers</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="promo-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="{{route('getAllPromotions')}}">List all</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('addnewPromotion')}}">Add New</a>
                </li>
                 
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#city-basic" aria-expanded="false" aria-controls="city-basic">
              <i class="menu-icon mdi mdi-city"></i>
              <span class="menu-title">City</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="city-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="{{route('getAllCities')}}">List all</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('addnewcity')}}">Add New</a>
                </li>
                 
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#category-basic" aria-expanded="false" aria-controls="category-basic">
              <i class="menu-icon mdi mdi-keyboard-close"></i>
              <span class="menu-title">Gym Category</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="category-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="{{route('getAllGymCategories')}}">List all</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('addnewcategory')}}">Add New</a>
                </li>
                 
              </ul>
            </div>
          </li>
           <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#facilities-basic" aria-expanded="false" aria-controls="facilities-basic">
              <i class="menu-icon mdi mdi-keyboard-close"></i>
              <span class="menu-title">Facilities</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="facilities-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="{{route('getAllGymfacilities')}}">List all</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('addnewfacilities')}}">Add New</a>
                </li>
                 
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#Workouts-basic" aria-expanded="false" aria-controls="Workouts-basic">
              <i class="menu-icon mdi mdi-account-network"></i>
              <span class="menu-title">Workouts</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="Workouts-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="{{route('getAllAssignedWorkouts')}}">List all</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('assignNewWorkout')}}">Assign Workouts</a>
                </li>
                 
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#nutritions-basic" aria-expanded="false" aria-controls="nutritions-basic">
              <i class="menu-icon mdi mdi-leaf"></i>
              <span class="menu-title">Nutritions</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="nutritions-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="{{route('getNutritions')}}">All Nutritions</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('assignNutritions')}}">Assign Nutritions</a>
                </li>
                 
              </ul>
            </div>
          </li>
           <li class="nav-item">
            <a class="nav-link" href="{{ route('markOrCheckAttendance') }}">
              <i class="menu-icon mdi mdi-calendar-multiple-check"></i>
              <span class="menu-title">Attendance</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('getallusers') }}">
              <i class="menu-icon mdi mdi-backup-restore"></i>
              <span class="menu-title">Users</span>
            </a>
          </li>
          
           <li class="nav-item">
            <a class="nav-link" href="{{ route('getAllPayment') }}">
              <i class="menu-icon mdi mdi-wallet"></i>
              <span class="menu-title">Wallet</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('generalSettigs')}}">
              <i class="menu-icon mdi mdi-settings"></i>
              <span class="menu-title">Settings</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('adminChangePassword')}}">
              <i class="menu-icon mdi mdi-table"></i>
              <span class="menu-title">Change Password</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('/logout')}}">
              <i class="menu-icon mdi mdi-logout"></i>
              <span class="menu-title">Logout</span>
            </a>
          </li>
          
        </ul>
      </nav>

      <script type="text/javascript">
        $(".nav-item").click(function () {

            $(this).find('.collapse').slideToggle('slow');

        });
      </script>
     