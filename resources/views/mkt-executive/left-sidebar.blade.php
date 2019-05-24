<!--  BEGIN SIDEBAR  -->
<div class="sidebar-wrapper sidebar-theme">
  <div id="dismiss" class="d-lg-none"><i class="flaticon-cancel-12"></i></div>
    <nav id="sidebar">
      
      <ul class="navbar-nav theme-brand flex-row  d-none d-lg-flex">
        <li class="nav-item">
            <a href="{{ route('mktDashboard') }}" class="navbar-brand">
                <img src="{{ asset('images/logo-1.png') }}" class="img-fluid" alt="logo">
            </a>

        </li>
        <li class="nav-item theme-text d-none">
            <a href="{{ route('mktDashboard') }}" class="nav-link"> Neargym </a>
        </li>
      </ul>
      <ul class="list-unstyled menu-categories" id="accordionExample">
        <li class="menu">
          <a href="{{ route('mktDashboard') }}" data-toggle="collapsew" aria-expanded="true" class="dropdown-toggle">
            <div class="">
                <i class="flaticon-computer-6 ml-3"></i>
                <span>Dashboard</span>
            </div>
           <!--  <div>
                <span class="badge badge-pill badge-secondary mr-2">7</span>
            </div> -->
          </a>
        </li>
        <li class="menu">
          <a href="#nutrition" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <div class="">
                <i class="flaticon-controller-1"></i>
                <span>My Sellers</span>
            </div>
            <div>
                <i class="flaticon-right-arrow"></i>
            </div>
          </a>
          <ul class="collapse submenu list-unstyled" id="nutrition" data-parent="#accordionExample">
            <li>
              <a href="{{ route('mysellers') }}"> My Sellers List </a>
            </li>
            <li>
              <a href="{{ route('createNewSeller') }}">New Seller Registration </a>
            </li>                           
          </ul>
        </li>
        <li class="menu">
          <a href="#package" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
            <div class="">
                <i class="flaticon-package"></i>
                <span>Package</span>
            </div>
            <div>
                <i class="flaticon-right-arrow"></i>
            </div>
          </a>
          <ul class="collapse submenu list-unstyled" id="package" data-parent="#accordionExample">
            <li>
              <a href="{{ route('salesExePackagesList') }}"> Packages List </a>
            </li>
            <li>
              <a href="{{ route('salesExePackagesAdd') }}">Add New Package</a>
            </li>                           
          </ul>
        </li>
        <li class="menu">
          <a href="{{ route('myWallet') }}" class="dropdown-toggle">
            <div class="">
              <i class="flaticon-wallet"></i>
              <span>My Wallet</span>
            </div>
          </a>
        </li>
        <li class="menu">
          <a href="{{ route('mySettings') }}" class="dropdown-toggle">
            <div class="">
              <i class="flaticon-settings-1"></i>
              <span>General Settings</span>
            </div>
          </a>
        </li>
        <li class="menu">
          <a href="{{ route('executivechangepassword') }}" class="dropdown-toggle">
            <div class="">
              <i class="flaticon-locked"></i>
              <span>Change Password</span>
            </div>
          </a>
        </li>
      <li class="menu">
        <a href="{{url('/logout')}}" class="dropdown-toggle">
          <div class="">
            <i class="flaticon-power-button"></i>
            <span>Logout</span>
          </div>
        </a>
      </li>
    </ul>
  </nav>
</div>

<!--  END SIDEBAR  -->