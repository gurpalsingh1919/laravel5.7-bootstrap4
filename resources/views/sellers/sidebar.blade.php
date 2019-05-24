 <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          
          <li class="nav-item">
            <a class="nav-link" href="{{ route('sellerDashboard') }}">
              <i class="menu-icon mdi mdi-television"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon mdi mdi-content-copy"></i>
              <span class="menu-title">Packages</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('packages') }}">Packages List</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('add-package') }}">Add New Package</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-nutrition" aria-expanded="false" aria-controls="ui-nutrition">
              <i class="menu-icon mdi mdi-content-copy"></i>
              <span class="menu-title">Nutritions</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-nutrition">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('packages') }}">Nutrition Schedule List</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('add-package') }}">Add Nutrition Schedule</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('getmycustmer') }}">
              <i class="menu-icon mdi mdi-backup-restore"></i>
              <span class="menu-title">Customers</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('getmyorder') }}">
              <i class="menu-icon mdi fa-shopping-cart" aria-hidden="true"></i>
              <span class="menu-title">Orders</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('updateseller')}}">
              <i class="menu-icon mdi mdi-chart-line"></i>
              <span class="menu-title">Update Gym Detail</span>
            </a>
          </li>
           <li class="nav-item">
            <a class="nav-link" href="{{route('getmywallet')}}">
              <i class="menu-icon mdi mdi-chart-line"></i>
              <span class="menu-title">My Wallet</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('changepassword')}}">
              <i class="menu-icon mdi mdi-table"></i>
              <span class="menu-title">Change Password</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('/logout')}}">
              <i class="menu-icon mdi mdi-sticker"></i>
              <span class="menu-title">Logout</span>
            </a>
          </li>
          
        </ul>
      </nav>