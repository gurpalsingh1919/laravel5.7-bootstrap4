@extends('layouts.users-app')

@section('content')
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <!-- content start here -->
  <?php $gym_imagess = explode('|', $packagedetail->gym_images);
  //echo "<pre>";print_r($gym_imagess);die; ?>
  @if($packagedetail->seller_type !='2')
    <div class="inner-banner detail-ban">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            @if($packagedetail->seller_type=='1')
              @foreach($gym_imagess as $index=>$image)
                @if($index==0)
                  <img src="{{ asset('/gyms') }}/{{$image}}" class="img-fluid"/>
                @endif
              @endforeach
            @elseif($packagedetail->seller_type=='2')
              <img src="{{ asset('/images/user/'.$sellerDetails[0]->user->image) }}" class="img-fluid"/>
            @endif
          </div>
          <div class="col-md-8">
            @if($packagedetail->seller_type=='1')
              <a href="{{ url('/mygym/'.$sellerDetails[0]->id) }}">
                  <h3>{{$packagedetail->gym_name}}</h3></a>
              <p>{{$packagedetail->gym_description}}</p>
            @elseif($packagedetail->seller_type=='2')
              <h3>{{$packagedetail->user->name}}</h3>
              <p>Experience:: {{$packagedetail->experience}}</p>
              <p>Expertise:: {{$packagedetail->expertise}}</p>
            @endif
            <ul class="gyminfo">
              <li>
                <span>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star"></i>
                  <i class="fas fa-star-half"></i>
                </span>4.5 star Rating
              </li>
              @if($packagedetail->seller_type=='1')
                <li><p><b class="text-uppercase">closed</b>12pm - 1pm</p>
                </li>
              @endif
            </ul>
            @if($packagedetail->seller_type=='1')
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Play Video
              </button>
            @endif
          </div>
        </div>
      </div>
    </div>
  @endif
  <div class="breadcrumb p-0 m-0 pt-2">
  <div class="container">
  {{ Breadcrumbs::render('package',$packagedetail) }}
  </div>
  </div>

<div class="container pt-5">
  <div class="row">
    <div class="col-lg-3">
      <div class="filtergym">
        <ul class="sidebar-filter">
          <li class="">
            <a href="{{url('mygym/'.$packagedetail->gymDetail->id.'/?cat_id=0')}}">
              <i class="fa fa-align-justify" aria-hidden="true"></i>Packages
              <span>{{$total_pack}} Options</span>
            </a>
          </li>
        </ul>
    </div>
    <br/>
    <div class="facilities">
      <?php $facilit=explode("|", $packagedetail->gymDetail->facilities);
            $timings=json_decode($packagedetail->gymDetail->timing)   ?>
      <h6>Facilities</h6>
      <div class="tags mt-2 border-bottom pb-3">
          @if(isset($facilit) && is_array($facilit))
          @foreach($facilit as $facility)
          <span class="badge badge-secondary mb-2">{{$facility}}</span>
          @endforeach
          @else
          <span class="badge badge-secondary mb-2">Facilities not added.</span>
          
          @endif
      </div>
      <br/>
      <div class="border-bottom pb-3">
        <h6>Timings</h6>
        <table class="small custom-table">
          <tbody>
            @if(isset($timings))
              @foreach($timings as $key=>$val)
              <tr class="K7Ltle">
                  <td class="SKNSIb">{{$key}}</td>
                  <td>{{$val}}</td>
              </tr>
              @endforeach
            @else
            <tr>
                <td colspan="2">Timings not added.</td>
            </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="right-content col-md-6">
    <div class="row">
      <div class="col-md-12">
        @if($errors->all())
          @foreach ($errors->all() as $index=>$error)
             @if($index==0)
              <div class="alert alert-danger">One or more fields have an error. Please check and try again.</div>
            @endif
          @endforeach
        @endif
        @if(session('error'))
          <div class="error alert alert-danger alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error : </strong> {{ session('error') }}
          </div>
          <script type="text/javascript">
              Swal({
                  type: 'info',
                  title: "Sorry!!!",
                  text: "{{ session('error') }}",
                  //footer: '<a href>Why do I have this issue?</a>'
              })
          </script>
        @endif
        @if(session('success'))
          <div class="error alert alert-success alert-dismissable">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {!! session('success') !!}
          </div>
          <script type="text/javascript">
               Swal(
                    'Good job!',
                    "{{ session('success') }}",
                    'success'
                )
          </script>
        @endif
      </div>
      <div class="col-md-12">
        <h3>{{$packagedetail->title}}</h3>
        <p>{{$packagedetail->description}}</p>
      </div>
      <div class="col-md-12 packages-detail mt-4">
        <form method="post" action="{{route('addToCart')}}" enctype="multipart/form-data">
        @csrf
          <input type="hidden" name="package_id" value="{{$pack_id}}">
          <div id="accordion">
            <div class="card">
              <div class="card-header" id="headingOne">
                <a class="d-block d-flex justify-content-between" data-toggle="collapse"
                    data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> Memberships
                  <i class="fas fa-angle-down pull-right"></i>
                </a>
              </div>
              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                         data-parent="#accordion">
                <div class="card-body ">
                  <table class="table  small" style="background: #fff;">
                    @foreach($packagedetail->packageMemberships as $index=>$membership)
                    <?php $duration=PackagetoPrice::get_duration_fullname($membership->duration);
                    $admin_comission=$packagedetail->admin_comission;
                      $total_price = PackagetoPrice::get_package_price($membership->price,   $admin_comission);   ?>
                    <tr>
                      <th scope="row">{{$duration}}</th>
                      <td>{{'₹ '.number_format((float)$total_price, 2, '.', '')}}</td>
                      <td>
                        <div class="custom-control custom-radio">
                          <input type="radio" class="custom-control-input" id="customCheck_{{$index}}" name="membership" value="{{$membership->id}}">
                            <label class="custom-control-label" for="customCheck_{{$index}}"></label>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                   
                  </table>
                   @if($errors->has('membership'))
                        <span class="invalid-feedback">
                          <strong>Please select at least one membership.</strong>
                        </span>
                    @endif
                </div>
              </div>
            </div>
          </div>
          <div class="mt-4">
          <div class="form-group   justify-content-between">
            <label for="staticEmail" class="small-text"><b>Starting Date</b></label>
            <input type="text" id="datepicker" class="form-control" id="staticEmail" value="{{date('Y-m-d')}}" name="start_date">
            @if ($errors->has('start_date'))
              <span class="invalid-feedback">
                <strong>{{$errors->first('start_date')}}</strong>
              </span>
            @endif
          </div>
          <div class="form-group   justify-content-between">
            <label for="staticEmail" class="  col-form-label"><b>Booking For</b></label>
            <div class="input-group ">
              <select class="custom-select" id="inputGroupSelect03" name="booking_for">
                <option value="1" selected>Only Myself</option>
                <option value="2">Me & Others</option>
              </select>
              @if ($errors->has('booking_for'))
              <span class="invalid-feedback">
                <strong>{{$errors->first('booking_for')}}</strong>
              </span>
            @endif
            </div>
          </div>
          <div class="form-group   row">
            <div class="col-md-6">
              <label for="staticEmail" class="  col-form-label"><b>Cancellation
                <?php $policy=PackagetoPrice::cancellation_policy($packagedetail->cancellation); ?>
              </b></label>
              <p>{{$policy}}</p>
            </div>
            <div class="col-md-6">
              <label for="staticEmail" class="  col-form-label"><b>Refund</b></label>
              <p>{{$packagedetail->refund}}</p>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Add to cart</button>
        </form>
      </div>
    </div>
  </div>
  <br/>
</div>
@include('users.cart')

</div>
</div>
@include('users.footer')

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$(document).ready(function () {
// Activate Carousel
$("#myCarousel").carousel();

// Enable Carousel Controls
$(".carousel-control-prev").click(function () {
    $("#myCarousel").carousel("prev");
});
$(".carousel-control-next").click(function () {
    $("#myCarousel").carousel("next");
});



    $( "#datepicker" ).datepicker({ minDate:new Date() });


});


</script>
<style type="text/css">
  .invalid-feedback {
    display: block;
  }
</style>
@endsection('content')