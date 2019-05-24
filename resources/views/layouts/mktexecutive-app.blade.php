<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
<title>Neargym</title>
<link rel="icon" type="image/x-icon" href="{{ asset('theme/assets/img/favicon.ico') }}"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
<link href="{{ asset('theme/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<!-- <link href="{{ asset('fontend/styles/bootstrap.css') }}" rel="stylesheet"> -->
<link href="{{ asset('theme/assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
<link href="{{ asset('theme/assets/css/support-chat.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('theme/plugins/maps/vector/jvector/jquery-jvectormap-2.0.3.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('theme/plugins/charts/chartist/chartist.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('theme/assets/css/default-dashboard/style.css') }}" rel="stylesheet" type="text/css" />

 <link rel="stylesheet" type="text/css" href="{{ asset('theme/plugins/table/datatable/datatables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/plugins/table/datatable/custom_dt_html5.css') }}">  
<link rel="stylesheet" href="{{url('css/buttons.dataTables.min.css')}}">
 <link rel="stylesheet" type="text/css" href="{{ asset('theme/plugins/bootstrap-select/bootstrap-select.min.css') }}">
 <link href="{{ asset('theme/assets/css/forms/form-validation.css') }}" rel="stylesheet" type="text/css" />
 <link href="{{ asset('theme/plugins/charts/c3charts/c3.min.css') }}" rel="stylesheet" type="text/css" />

  <link href="{{ asset('theme/assets/css/ecommerce/addedit_product.css') }}" rel="stylesheet" type="text/css">
 <link href="{{ asset('theme/plugins/file-upload/file-upload-with-preview.css') }}" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->   
<script src="{{ asset('theme/assets/js/libs/jquery-3.1.1.min.js') }}"></script>

<!-------------------- Sweet alert ------------------------->
    <link href="{{ asset('theme/plugins/animate/animate.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('theme/plugins/sweetalerts/promise-polyfill.js') }}"></script>
    <link href="{{ asset('theme/plugins/sweetalerts/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('theme/plugins/sweetalerts/sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('theme/assets/css/ui-kit/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
   <link href="{{ asset('theme/assets/css/classic-dashboard/style.css') }}" rel="stylesheet" type="text/css" />
</head>
<body class="default-sidebar">
<!-- Tab Mobile View Header -->
<header class="tabMobileView header navbar fixed-top d-lg-none">
    <div class="nav-toggle">
            <a href="javascript:void(0);" class="nav-link sidebarCollapse" data-placement="bottom">
                <i class="flaticon-menu-line-2"></i>
            </a>
        <a href="{{ route('mktDashboard') }}" class=""> <img src="{{ asset('images/logo-1.png') }}" class="img-fluid" alt="logo"></a>
    </div>
    <ul class="nav navbar-nav">
        <li class="nav-item d-lg-none"> 
            <form class="form-inline justify-content-end" role="search">
                <input type="text" class="form-control search-form-control mr-3">
            </form>
        </li>
    </ul>
</header>
<!-- Tab Mobile View Header -->

<!--  BEGIN NAVBAR  -->
<header class="header navbar fixed-top navbar-expand-sm">
  <a href="javascript:void(0);" class="sidebarCollapse d-none d-lg-block" data-placement="bottom"><i class="flaticon-menu-line-2"></i>
  </a>
  <!-- <a href="javascript:void(0);" class="nav-link active" id="userProfileDropdown">
    <span class="flaticon-idea-bulb mt-2 mr-5"><b>  NEAR GYM Trainer</b></span>
  </a> -->
  <div class="row ml-lg-auto">
    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
        <h4 style="color: #FB8019;"><span class="flaticon-idea-bulb"><b>  NEAR GYM SALES EXECUTIVE</b></span></h4>
    </div>
  </div>
  <ul class="navbar-nav flex-row ml-lg-auto">
    <li class="nav-item  d-lg-block d-none">
      <form class="form-inline" role="search">
          <input type="text" class="form-control search-form-control" placeholder="Search...">
      </form>
    </li>
    <li class="nav-item dropdown user-profile-dropdown ml-lg-0 mr-lg-2 ml-3 order-lg-0 order-1">
      <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="flaticon-user-12"></span>
      </a>
      <div class="dropdown-menu  position-absolute" aria-labelledby="userProfileDropdown">
      <a class="dropdown-item" href="{{route('mySettings')}}">
          <i class="mr-1 flaticon-user-6"></i> <span>General settings</span>
      </a>
      <a class="dropdown-item" href="{{route('executivechangepassword')}}">
          <i class="mr-1 flaticon-locked"></i> <span>change Password</span>
      </a>

      <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{ route('logout') }}">
            <i class="mr-1 flaticon-power-button"></i> <span>Log Out</span>
        </a>
      </div>
    </li>
  </ul>
</header>
<!--  END NAVBAR  -->
 <!--  BEGIN MAIN CONTAINER  -->
<div class="main-container" id="container">
     <div class="overlay"></div>
    <div class="cs-overlay"></div>
     @include('mkt-executive.left-sidebar')
     @yield('content')
</div>
<!-- END MAIN CONTAINER -->

<!--  BEGIN FOOTER  -->
<footer class="footer-section theme-footer">

    <div class="footer-section-1  sidebar-theme">
        
    </div>

    <div class="footer-section-2 container-fluid">
        <div class="row">
            <div id="toggle-grid" class="col-xl-7 col-md-6 col-sm-6 col-12 text-sm-left text-center">
                <ul class="list-inline links ml-sm-5">
                    <li class="list-inline-item mr-3">
                        <a href="javascript:void(0);">Home</a>
                    </li>
                    <li class="list-inline-item mr-3">
                        <a href="javascript:void(0);">Blog</a>
                    </li>
                    <li class="list-inline-item mr-3">
                        <a href="javascript:void(0);">About</a>
                    </li>
                    <li class="list-inline-item">
                        <a href="javascript:void(0);">Buy</a>
                    </li>
                </ul>
            </div>
            <div class="col-xl-5 col-md-6 col-sm-6 col-12">
                <ul class="list-inline mb-0 d-flex justify-content-sm-end justify-content-center mr-sm-3 ml-sm-0 mx-3">
                    <li class="list-inline-item  mr-3">
                        <p class="bottom-footer">&#xA9; 2019 <a target="_blank" href="https://designreset.com/equation">Equation Admin Theme</a></p>
                    </li>
                    <li class="list-inline-item align-self-center">
                        <div class="scrollTop"><i class="flaticon-up-arrow-fill-1"></i></div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<!--  END FOOTER  -->




<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->

<script src="{{ asset('theme/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('theme/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('theme/plugins/scrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{ asset('theme/assets/js/app.js') }}"></script>
<script>
    $(document).ready(function() {
        App.init();
           checkall('todoAll', 'todochkbox');
        $('[data-toggle="tooltip"]').tooltip()
    });
</script>

<script src="{{ asset('theme/assets/js/custom.js') }}"></script>

<!-- END GLOBAL MANDATORY SCRIPTS -->




<!--  <script src="{{ asset('theme/plugins/table/datatable/button-ext/jszip.min.js') }}"></script>    
<script src="{{ asset('theme/plugins/table/datatable/button-ext/buttons.html5.min.js') }}"></script>
<script src="{{ asset('theme/plugins/table/datatable/button-ext/buttons.print.min.js') }}"></script>
-->

<!-- Spinner Buttons -->
<!--  <script src="{{ asset('theme/assets/js/ui-kit/button/spinner/spinner.js') }}"></script>
<script src="{{ asset('theme/assets/js/ui-kit/button/spinner/spin.min.js') }}"></script>
<script src="{{ asset('theme/assets/js/ui-kit/button/spinner/ladda.min.js') }}"></script>
<script src="{{ asset('theme/assets/js/ui-kit/button/custo-spinner.js') }}"></script> -->
<!--  END CUSTOM SCRIPT FILES  -->

<!--  <script>
    $('#html5-extension').DataTable( {
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5 mb-md-0 mb-5"i><"col-md-7"p>>> >',
        buttons: {
            buttons: [
                { extend: 'copy' },
                { extend: 'csv' },
                { extend: 'excel'},
                { extend: 'print'}
            ]
        },
        "language": {
            "paginate": {
              "previous": "<i class='flaticon-arrow-left-1'></i>",
              "next": "<i class='flaticon-arrow-right'></i>"
            },
            "info": "Showing page _PAGE_ of _PAGES_"
        }
    } );
</script> -->

<script src="{{ asset('theme/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('theme/assets/js/forms/bootstrap_validation/bs_validation_script.js') }}"></script>

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->

<script src="{{ asset('theme/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('theme/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('theme/plugins/scrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{ asset('theme/plugins/blockui/jquery.blockUI.min.js') }}"></script>
<script src="{{ asset('theme/assets/js/app.js') }}"></script>



<script>
    $(document).ready(function() {
        App.init();
    });
</script>
<!-- <script src="{{ asset('theme/assets/js/custom.js') }}"></script> -->


<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{ asset('theme/plugins/charts/d3charts/d3.v3.min.js') }}"></script>


<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{ asset('theme/plugins/charts/c3charts/c3.min.js') }}"></script>
<script src="{{ asset('theme/plugins/charts/c3charts/c3-chart-script.js') }}"></script>
<script src="{{ asset('theme/plugins/sweetalerts/sweetalert2.min.js') }}"></script> 
<script src="{{ asset('theme/plugins/sweetalerts/custom-sweetalert.js') }}"></script>
<link href="{{ asset('theme/assets/css/classic-dashboard/style.css') }}" rel="stylesheet" type="text/css" />
<!-- <script src="{{ asset('theme/assets/js/ecommerce/autocomplete-addedit_product.js') }}"></script> -->
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<script src="{{ asset('theme/plugins/charts/amcharts/amcharts.js') }}"></script>
    <script src="{{ asset('theme/plugins/maps/vector/ammaps/ammap_amcharts_extension.js') }}"></script>
    <script src="{{ asset('theme/plugins/maps/vector/ammaps/worldLow.js') }}"></script>
    <script src="{{ asset('theme/plugins/charts/amcharts/serial.js') }}"></script>
    <script src="{{ asset('theme/plugins/charts/amcharts/pie.js') }}"></script>
    <!-- <script src="{{ asset('theme/plugins/progressbar/progressbar.min.js') }}"></script> -->
    <script src="{{ asset('theme/assets/js/classic-dashboard/classic-custom.js') }}"></script>
</body>
</html>