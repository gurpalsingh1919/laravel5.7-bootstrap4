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
  <!-- plugins:css -->
  <link href="{{ asset('fontend/styles/css.css') }}" rel="stylesheet">
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
  <!-- <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css"> -->
   <link rel="stylesheet" href="{{url('css/jquery.dataTables.min.css')}}">
  <link rel="stylesheet" href="{{url('css/responsive.dataTables.css')}}">
<link rel="stylesheet" href="{{url('css/buttons.dataTables.min.css')}}">
    <link href="{{ asset('css/product.css') }}" rel="stylesheet">
 <link href="{{url('/clockpicker/dist/bootstrap-clockpicker.css')}}" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/all.min.css') }}" />
  
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" /> -->

 <link href="{{asset('css/bootstrap-multiselect.css')}}"
        rel="stylesheet" type="text/css" />

<link href="{{ asset('theme/plugins/date_time_pickers/bootstrap_date_range_picker/daterangepicker.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('theme/plugins/date_time_pickers/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css">
    <!-- <link href="plugins/timepicker/jquery.timepicker.css" rel="stylesheet" type="text/css"> -->
    <link href="{{ asset('theme/plugins/date_time_pickers/custom_datetimepicker_style/custom_datetimepicker.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/assets/css/design-css/design.css') }}">
<link href="{{ asset('theme/plugins/file-upload/file-upload-with-preview.css') }}" rel="stylesheet" type="text/css" />
</head>
<body>
  <div class="container-scroller">

    <!-- partial:partials/_navbar.html -->
    @if (Auth::check() && Auth::user()->isAdministrator())
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="index.html">
          <img src="{{ asset('images/logo-1.png') }}" alt="logo" />
        </a>
        <!-- <a class="navbar-brand brand-logo-mini" href="index.html">
          <img src="{{ asset('images/logo-mini.svg') }}" alt="logo" />
        </a> -->
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown d-none d-xl-inline-block">
            <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <span class="profile-text">Hello , {{ Auth::user()->name }} !</span>
              <img class="img-xs rounded-circle" src="{{ asset('images/user')}}/{{Auth::user()->image}}" alt="Profile image">
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              
             
              <a class="dropdown-item" href="{{route('changepassword')}}">
                Change Password
              </a>
              <a class="dropdown-item" href="{{ url('/logout') }}">Sign Out</a>
               <!-- <a class="dropdown-item" href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
              </a>
               <form id="logout-form" action="{{ url('/logout') }}" method="get" style="display: none;">
                  @csrf
              </form> -->
              
            </div>
          </li>
        </ul>
       <!--  <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button> -->
      </div>
      <div id="salesreport" data-sales='{{$salesArr}}'></div>
    </nav>
    @endif

    <main">
        @yield('content')
    </main>


  </div>
  <script src="{{ asset('js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('js/vendor.bundle.addons.js') }}"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="{{ asset('js/off-canvas.js') }}"></script>
  <script src="{{ asset('js/misc.js') }}"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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
  <script src="{{url('js/custom-file-input.js')}}"></script>




 <script type="text/javascript" src="{{url('/clockpicker/dist/bootstrap-clockpicker.js')}}"></script>

 


<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{url('/css/daterangepicker.min.css')}}" />
 <script src="{{url('/js/jquery.daterangepicker.min.js')}}"></script>
  <script src="{{asset('js/bootstrap-multiselect.js')}}" type="text/javascript"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script> -->
 
<!-- <script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>   -->

<script src="{{ asset('js/shieldui-all.min.js') }}"></script>

 <script src="{{ asset('theme/assets/js/design-js/design.js') }}"></script>
<script src="{{ asset('theme/plugins/date_time_pickers/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('theme/plugins/date_time_pickers/bootstrap_date_range_picker/daterangepicker_examples.js') }}"></script>
    <script src="{{ asset('theme/plugins/timepicker/custom-timepicker.js') }}"></script>
  <script>
 $(function() {
          $('#admins-table').DataTable({
              // responsive: true,
             dom: 'Bfrtip',
              buttons: [
                  'copy', 'csv', 'excel', 'pdf', 'print'
              ]
            });
//});

//$(document).ready(function() {
  //$('#users-table').DataTable();

    var report=$("#salesreport").data("sales");
   var data1=[0,0,0,0,0,0,0,0,0,0,0,0];
    var data2=[0,0,0,0,0,0,0,0,0,0,0,0];
    $.each( report, function( key, value ) {
      console.log( key + ": " + value['sales'] );
     // data1.push(value['sales']);
      //data2.push(value['admin_comission']);
      var month= value['month'];
      data1[month-1]=parseFloat(value['sales']);
      data2[month-1]=parseFloat(value['admin_comission']) + parseFloat(value['maintence_charges']) + parseFloat(value['tax']) + parseFloat(value['service_charges']);
    });
     console.log( data1);
    //var data1 = [500, 3, 4, 2, 12, 3, 4, 17, 22, 34, 54, 67];
       //var data2 = [3, 9, 12, 14, 22, 32, 45, 12, 67, 45, 55, 7];
        //var data3 = [23, 19, 11, 134, 242, 352, 435, 22, 637, 445, 555, 57];
       $("#chart1").shieldChart({
          theme: "light",
            exportOptions: {
                image: false,
                print: false
            },
            axisX: {
                categoricalValues: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "July", "Aug", "Sept", "Oct", "Nov", "Dec"]
            },
            axisY: {
                title: {
                    text: "Amount in (INR)"
                }
            },
            dataSeries: [{
                seriesType: "bar",
                  collectionAlias: "Months",
                data: data1
            }]
        });
        $("#chart2").shieldChart({
            exportOptions: {
                image: false,
                print: false
            },
            axisX: {
                categoricalValues: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "July", "Aug", "Sept", "Oct", "Nov", "Dec"]
            },
            axisY: {
                title: {
                    text: "Amount in (INR)"
                }
            },
            dataSeries: [{
                seriesType: "bar",
                 collectionAlias: "Total Sale",
                data: data1
            }, {
                seriesType: "bar",
                 collectionAlias: "Admin Comission",
                data: data2
            }]
        });

$( "tspan:contains('Demo')" ).css( "display", "none" );
$( "tspan:contains('Shield')" ).css( "display", "none" );

       

   
// });

//                       $(function() {
                          //$('input[name="daterange"]').daterangepicker();
                          $('#dom-id').dateRangePicker(configObject);
                          var configObject=
                          {
                            autoClose: false,
                            format: 'YYYY-MM-DD',
                            separator: '-',
                            language: 'auto',
                            startOfWeek: 'sunday',// or monday
                            getValue: function()
                            {
                              return $(this).val();
                            },
                            setValue: function(s)
                            {
                              if(!$(this).attr('readonly') && !$(this).is(':disabled') && s != $(this).val())
                              {
                                $(this).val(s);
                              }
                            },
                            startDate: true,
                            endDate: true,
                            time: {
                              enabled: false
                            },
                            minDays: 0,
                            maxDays: 0,
                            showShortcuts: false,
                            shortcuts:
                            {
                              //'prev-days': [1,3,5,7],
                              //'next-days': [3,5,7],
                              //'prev' : ['week','month','year'],
                              //'next' : ['week','month','year']
                            },
                            customShortcuts : [],
                            inline:false,
                            container:'body',
                            alwaysOpen:false,
                            singleDate:false,
                            lookBehind: false,
                            batchMode: false,
                            duration: 200,
                            stickyMonths: false,
                            dayDivAttrs: [],
                            dayTdAttrs: [],
                            applyBtnClass: '',
                            singleMonth: 'auto',
                            hoveringTooltip: function(days, startTime, hoveringTime)
                            {
                              return days > 1 ? days + ' ' + lang('days') : '';
                            },
                            showTopbar: true,
                            swapTime: false,
                            selectForward: false,
                            selectBackward: false,
                            showWeekNumbers: false,
                            getWeekNumber: function(date) //date will be the first day of a week
                            {
                              return moment(date).format('w');
                            },
                            monthSelect: false,
                            yearSelect: false
                          }
                      });
                      </script>
</body>
</html>