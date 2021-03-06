@extends('layouts.mktexecutive-app')

@section('content') 
<!--  BEGIN CONTENT PART  -->
<div id="content" class="main-content">
  <div class="container">
    <div class="page-header">
      <div class="page-title">
          <h3>{{__('My Wallet Transactions')}}</h3>
      </div>
    </div>
    <div class="row layout-spacing">
      <div class="col-lg-12">
        <div class="statbox widget box box-shadow">
          <div class="widget-header pb-0">
            <div class="row">
              <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                  <h4>Filters</h4> 
              </div>                         
            </div>
          </div>
          <div class="widget-content widget-content-area datepicker-section pt-0">
            <form>
            <div class="row padding35">
              <div class="col-xl-6 col-lg-6 col-md-6">
                <h5>{{ __('Select Date range') }}</h5><br/>
                <div class="form-group mb-5">
                  
                <input type="text" class="form-control" name="datefilter" value="{{app('request')->input('datefilter')?app('request')->input('datefilter'):''}}" autocomplete="off" />
                </div>
              </div>
              
              <div class="col-xl-2 col-lg-2 col-md-2 mt-5">
                <!-- <h5>{{ __('Select a customer') }}</h5> -->
                <button class="btn btn-primary" type="submit">Submit</button>
              </div>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
           
   <div class="row layout-spacing">
      <div class="col-md-6">
          <div class="widget-content-area  data-widgets br-4">
              <div class="widget  t-sales-widget">
                  <div class="media">
                      <div class="icon ml-2">
                          <i class="flaticon-3d-cube"></i>

                      </div>
                      <div class="media-body text-right">
                          <p class="widget-text mb-0">Total Earning</p>
                          <p class="widget-numeric-value">0.00<span class="small ">INR</span></p>
                      </div>
                  </div>
                   
                 <!--  <a href="{{ route('packages') }}" class="btn btn-outline-dark btn-sm">View All </a> -->
                   
              </div>
          </div>
      </div>

      <div class="col-md-6">
          <div class="widget-content-area  data-widgets br-4">
              <div class="widget  t-order-widget">
                  <div class="media">
                      <div class="icon ml-2">
                          <i class="flaticon-user-11"></i>
                      </div>
                      <div class="media-body text-right">
                          <p class="widget-text mb-0">Pending Amount</p>
                          <p class="widget-numeric-value">0.00 <span class="small ">INR</p>
                      </div>
                  </div>
                   <!-- <a class="btn btn-outline-dark btn-sm" href="{{ route('getmycustmer') }}">View All </a> -->
              </div>
          </div>
      </div>
    </div>

  <div class="row" id="cancel-row">
   <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
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


      <div class="statbox widget box box-shadow">
        <div class="widget-content widget-content-area">
          <div class="table-responsive mb-4">
            <table id="html5-extension" class="table table-striped table-bordered table-hover" style="width:100%">
              <thead>
                <th>Sr.</th>
                      <th>Payment Id</th>
                      <th>Customer Name</th>
                      <th>Registration Date</th>
                      <th>Amount</th>
                      <th>Status</th>
              </thead>
              <tbody>
             @foreach($mysellers as $index=>$order)
              <tr>
                <td> {{$index+1}}</td>
                <td>{{$order->user->name}}</td>
                <td>{{ Carbon\Carbon::parse($order->created_at)->format('Y m d') }}</td>
                <td></td>
                 <td>
                   @if($order->status==1)
                         <span class="badge badge-success">success</span>
                   @elseif($order->status==2)
                         <span class="badge badge-danger"> Fail</span>
                   @else
                         <span class="badge badge-warning">Pending</span>
                   @endif
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
</div>
</div>
<!--  END CONTENT PART  -->
@endsection