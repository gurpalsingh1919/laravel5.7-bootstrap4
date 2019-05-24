@extends('layouts.trainer-app')
<link href="{{ asset('theme/assets/css/ecommerce/view_payments.css') }}" rel="stylesheet" type="text/css"/>

@section('content')
<!--  BEGIN CONTENT PART  -->
<div id="content" class="main-content">
  <div class="container">
    <div class="page-header">
      <div class="page-title">
          <h3><i class="flaticon-business mr-2"></i>{{__('My Store')}}</h3>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
          <div class="widget-header">
              <div class="border-bottom mb-3">
                  <h4>{{__('Quickly set up your Business.')}}</h4>
              </div>
          </div>
          <div class="widget-content widget-content-area">
            @if($errors->all())
              @foreach ($errors->all() as $index=>$error)
                @if($index=='0')
                  <div class="alert alert-danger">{{ $error }}</div>
                @endif
              @endforeach
            @endif
            @if(session('error'))
                <div class="error alert alert-danger alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert"
                       aria-label="close">&times;</a>
                    <strong>Error : </strong> {{ session('error') }}
                </div>

            @endif
            @if(session('success'))
                <div class="error alert alert-success alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert"
                       aria-label="close">&times;</a>
                    {!! session('success') !!}
                </div>
            @endif
            <form method="post" action="{{route('StoreRequest')}}" enctype="multipart/form-data">
            @csrf
            <div class="row justify-content-center">
              <div class="col-md-12 col-lg-8 border-right border-left">
                <div class="row">
                  <div class="col-md-6">
                    <label for="validationCustom01"><b>{{ __('Your Business Name') }}</b></label>
                    <input type="text" class="form-control" placeholder="" name="business_name" autocomplete="off" value="{{$business_detail->business_name}}">
                    @if ($errors->has('business_name'))
                      <span class="invalid-feedback">
                        <strong>{{ $errors->first('business_name') }}</strong>
                      </span>
                    @endif
                  </div>
                  <div class="col-md-6">
                    <label><b>Your Business URL</b></label>
                    <div class="form-inline">
                    <input type="text" class="form-control" name="business_url" value="{{$business_detail->business_url}}" />.neargym.tk
                    @if ($errors->has('business_url'))
                      <span class="invalid-feedback">
                        <strong>{{ $errors->first('business_url') }}</strong>
                      </span>
                    @endif
                    </div>
                  </div>
                  </div>
                  <div class="col-md-12 payment-top-section selecttype mb-5">
                    <div class="row mt-4">
                      <label class="col-12">
                          <label><b>Are you a Professional or a Business ?</b></label>
                      </label>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-2 text-center">
                          <a href="javascript:void(0);" class="p-linkout" id="professional" data-btype="1">
                              <div class="p-cards">
                                <i class="ico-net-bnk flaticon-user-11 mb-4"></i>
                                  <h5>Professional</h5>
                                  <h5 class="txt-net-bnk small">Single User</h5>
                              </div>
                          </a>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-2 text-center">
                        <a href="javascript:void(0);" class="p-linkout" id="business" data-btype="2">
                          <div class="p-cards">
                            <input type="hidden" name="business_type" id="business_type" value="{{$business_detail->business_type}}">
                              <i class="ico-paypal flaticon-user-group-2 mb-4"></i>
                              <h5>Business</h5>
                              <h5 class="txt-paypal small">Many User</h5>
                          </div>
                        </a>
                      </div>
                      @if ($errors->has('business_type'))
                        <span class="invalid-feedback" style="text-align: center;">
                          <strong>{{ $errors->first('business_type') }}</strong>
                        </span>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-12 mb-4">
                      <div class="row">
                          <div class="col-md-6">
                              <label><b>Country</b></label>
                              <select class="form-control">
                                  <option>India</option>
                                  <option></option>
                              </select>
                          </div>
                          <div class="col-md-6">
                              <label><b>Time Zone</b></label>
                              <select class="form-control">
                                  <option>Asia/Kolkata</option>
                                  <option></option>
                              </select>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-12 mb-4">
                      <label><b>Chooose a Category</b></label>
                      <br/>
                      <div class="row">
                      <div class="col-md-6">
                        @foreach($storeCategory as $index=>$storecat)
                        @if($index <=4)
                        <div class="form-check mb-2 mr-sm-2">
                          <div class="n-chk">
                            <label class="new-control new-radio radio-info">
                              <input type="radio" class="new-control-input" name="business_category" value="{{$storecat->id}}" @if($business_detail->business_category==$storecat->id){{"checked"}} @endif>
                              <span class="new-control-indicator"></span>{{$storecat->title}}
                            </label>
                          </div>
                        </div>
                        @endif
                        @endforeach
                      </div>
                      <div class="col-md-6">
                        @foreach($storeCategory as $index=>$storecat)
                          @if($index >4)
                            <div class="form-check mb-2 mr-sm-2">
                              <div class="n-chk">
                                <label class="new-control new-radio radio-info">
                                  <input type="radio" class="new-control-input" name="business_category" value="{{$storecat->id}}" @if($business_detail->business_category==$storecat->id){{"checked"}} @endif>
                                  <span class="new-control-indicator"></span>{{$storecat->title}}
                                </label>
                              </div>
                            </div>
                          @endif
                        @endforeach
                          
                      </div>
                      @if ($errors->has('business_category'))
                        <span class="invalid-feedback">
                          <strong>{{ $errors->first('business_category') }}</strong>
                        </span>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function () {
  var b_type=$("#business_type").val();
  if(b_type=='1')
  {
    $("#professional").addClass('active');
  }
  else if(b_type=='2')
  {
    $("#business").addClass('active');
  }
$(".p-linkout").click(function () {
    if ( $(this).hasClass('active') ) {
        $(this).removeClass('active');
    } else {
        $('.p-linkout').removeClass('active');
        $(this).addClass('active');
        $("#business_type").val($(this).data("btype"));
        //console.log($(this).data("btype"));
    }
})
})
</script>
<style type="text/css">
  .invalid-feedback{
    display: block;
  }
</style>
@endsection