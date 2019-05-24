@extends('layouts.sellers-app')
@section('content')
 <div class="container-fluid page-body-wrapper">
     @include('sellers.sidebar')
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
           <form method="get" action="">
          <div class="row">
            
                  <div class="form-group col-md-3">
                    <label class="label">{{ __('Select a customer') }}</label>
                    <div class="input-group">
                       
                       <select name="user" class="form-control">
                        <option value="0">All</option>
                        @foreach($users as $user)
                         <option value="{{$user->userDetail->id}}" {{app('request')->input('user') ==$user->userDetail->id?'selected':''}}>{{$user->userDetail->name}}</option>
                         @endforeach
                       </select>
                      
                    </div>
                  </div>
                  <div class="form-group col-md-3">
                    <label class="label">{{ __('Select Date range') }}</label>
                    <div class="input-group">
                       
                      <input type="text" id="dom-id" name="daterange" value="{{app('request')->input('daterange')}}" autocomplete="off" />

                      
                      
                    </div>
                  </div>
                  <div class="form-group col-md-3"><br/>
                    <button type="submit" class="btn btn-primary" >Submit</button>
                  </div>
                  <!-- </div> -->
                </form>


            <div class="col-sm-12 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-header"><b>{{__('Orders')}}</b>
                   @if($errors->all())
                   @foreach ($errors->all() as $error)
                      <div class="alert alert-danger">{{ $error }}</div>
                  @endforeach
                @endif
                 @if(session('error')) 
                <div class="error alert alert-danger alert-dismissable">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Error : </strong>   {{ session('error') }}
                </div>
               
                @endif
                 @if(session('success')) 
            <div class="error alert alert-success alert-dismissable">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              {!! session('success') !!}
            </div>
               @endif

                </div>
              <div class="card-body">

                   <table id="users-table" class="display responsive nowrap" width="100%">
                                <thead>
                                <th>Sr.</th>
                                <th>Payment Id</th>
                                <th>Customer Name</th>
                                <th>Package Name | Qty</th>
                                <th>Purchase Date</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Action</th>
                                </thead>
                                <tbody>
                                @foreach($myOrders as $index=>$order)
                                <tr>
                                    <td> {{$index+1}}</td>

                                     <td>{{$order->payment_id}}</td>
                                    <td>{{$order->userDetail->name}}</td>
                                   
                                    <td>
                                    @foreach($order->orderDetail as $pack)
                                      <span>{{$pack->packageDetails->title}} | ({{$pack->quantity}})</span><br/>
                                    
                                    @endforeach
                                    </td>
                                    <td>{{ Carbon\Carbon::parse($order->created_at)->format('Y m d') }}</td>
                                     <td>{{$order->seller_amount}}</td>
                                   <td>
                                     @if($order->status==1)
                                           <span class="badge badge-success">Success</span>
                                     @elseif($order->status==2)
                                           <span class="badge badge-danger"> Fail</span>
                                     @else
                                           <span class="badge badge-warning">Pending</span>
                                     @endif
                                   </td>
                                   <td>
                                     <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          Action
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                          <a class="dropdown-item" target="_blank" href="{{route('getmyordersummary',$order->id)}}">View</a>
                                         
                                        </div>
                                      </div>
                                   </td>
                                </tr>
                                    @endforeach

                                </tbody>
                            </table>
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
  <script>

        $(function() {
          $('#users-table').DataTable({
              responsive: true,
             dom: 'Bfrtip',
              buttons: [
                  'copy', 'csv', 'excel', 'pdf', 'print'
              ]
            });
});

        </script>
        <script type="text/javascript">
                      $(function() {
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

       
@endsection
