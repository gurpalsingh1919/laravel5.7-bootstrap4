<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>{{ config('app.name', 'Laravel') }}</title>

   <link href="{{ asset('fontend/styles/bootstrap.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
     <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <link href="{{ asset('fontend/styles/css.css') }}" rel="stylesheet">
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('css/vendor.bundle.addons.css') }}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
   <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />
   <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">></script>
      <script src="{{ asset('js/sweetalert2.min.js') }}"></script> 
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script> 
  <link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert2.min.css') }}">
  <link rel="stylesheet" href="{{url('css/jquery.dataTables.min.css')}}">
  <link rel="stylesheet" href="{{url('css/responsive.dataTables.css')}}">
<link rel="stylesheet" href="{{url('css/buttons.dataTables.min.css')}}">
</head>
<body>
  <div class="container-scroller">

    <!-- partial:partials/_navbar.html -->
    @if (Auth::check() && Auth::user()->isFreelancer())
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="{{ route('trainerDashboard') }}">
          <img src="{{ asset('images/logo-1.png') }}" alt="logo" />
        </a>
        <!-- <a class="navbar-brand brand-logo-mini" href="index.html">
          <img src="{{ asset('images/logo-mini.svg') }}" alt="logo" />
        </a> -->
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
         <button class="navbar-toggler" id="slide-nav" type="button"  >
          <span class="mdi mdi-menu"></span>
        </button>
         <ul class="navbar-nav navbar-nav-right">

                      <li class="nav-item dropdown d-none d-xl-inline-block">
            <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" >
              <span class="profile-text">Hello , {{ Auth::user()->name }} !</span>
              <img class="img-xs rounded-circle" src="{{ asset('images/user/'.Auth::user()->image)}}" alt="Profile image">
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown">
              <a class="dropdown-item mt-2" href="{{route('generalsettings')}}">
                General settings
              </a>
              <a class="dropdown-item" href="{{route('trainerchangepassword')}}">
                Change Password
              </a>
             
              <a class="dropdown-item" href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
              </a>
               <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
            </div>
          </li>
        </ul>
       
      </div>
    </nav>
    @else 
    <!-- navigation start here -->
    <nav class="navbar navbar-expand-lg navbar-white bg-white" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="{{url('/')}}">
            <img src="{{ asset('/images/logo-white-1.png') }}" class="img-fluid" /></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
             <li class="nav-item ">
              <a class="nav-link js-scroll-trigger help" href="{{url('/')}}">
               <i class="fa fa-question-circle-o fa-2x" aria-hidden="true"></i> Help</a>
            </li>
            <!--  @if (Auth::guest())
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="{{route('signin')}}">Login</a>
            </li>
            <li class="nav-item">
             <a href="{{route('signup')}}">
              <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Sign up</button></a>
            </li>
            @endif -->
        
          </ul>
        </div>
      </div>
    </nav>
    @endif

    <main id="main">
        @yield('content')
    </main>


  </div>
  <script src="{{ asset('js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('js/vendor.bundle.addons.js') }}"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
  <script src="{{ asset('js/off-canvas.js') }}"></script>
  <script src="{{ asset('js/misc.js') }}"></script>


        <script src="{{url('js/jquery.dataTables.min.js')}}"></script>
        <script src="{{url('js/dataTables.responsive.js')}}"></script>
        <script src="{{url('/js/chart.js')}}"></script>


         <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
         <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>

        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

  <script>

        $(function() {
          $('#slide-nav').click(function(){
            $("#main").toggleClass('active')

          })
});

        </script>
       
</body>
</html>