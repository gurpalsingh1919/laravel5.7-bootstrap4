@extends('layouts.admin-app')

@section('content')
 <div class="container-fluid page-body-wrapper">
     @include('admins.sidebar')
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
         
          <div class="row">
            <div class="col-sm-12 grid-margin stretch-card">
              <div class="card card-statistics">
                 <div class="card-header mb-4">
                <b>{{__('Edit package')}}</b>
                 <div class="float-right"> <a href="{{ route('getAllPackages') }}" class="btn btn-primary">Package List</a></div>
                 <div class="float-right mr-4">
                  @if($packagedetail->status !=1)
                    <button type="submit" class="btn btn-secondary float-right status"/>Approve</button>
                    @else
                    <button class="btn btn-warning  float-right status" value="" />Dispprove</button>
                    @endif
                  </div>
                   
                <hr/>
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

              <div>
              <div class="card-body">   
                <form method="POST" action="{{ route('updatePackageDetailsPost',$pack_id) }}" enctype="multipart/form-data">
                     @method('PATCH')
                  @csrf
                   
                  <div class="form-row">
                     <div class="col-md-6 mb-4">
                      <label for="validationCustom01"><b>{{ __('Select trainer/seller or Gym') }}</b></label>
                       <select class="form-control" name="seller">
                         @foreach($sellers as $seller)
                         <option value="{{$seller->id}}" <?php if($packagedetail->seller_id==$seller->id){echo "selected";}  ?>>{{$seller->gym_name}}
                         </option>
                         @endforeach
                        </select>
                          @if ($errors->has('seller'))
                          <span class="invalid-feedback">
                              <strong>{{ $errors->first('seller') }}</strong>
                          </span>
                          @endif
                    </div>
                    <div class="col-md-6 mb-4">
                           <label for="admin_comission" class=" col-form-label text-md-right"><b>{{ __('Admin Comission (%)') }}</b></label>
                           <input class="form-control{{ $errors->has('admin_comission') ? ' is-invalid' : '' }}" type="text" name="admin_comission" value="{{ $packagedetail->admin_comission }}" autofocus>
                            @if ($errors->has('admin_comission'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('admin_comission') }}</strong>
                            </span>
                            @endif
                    </div>
                    <div class="col-md-6 mb-4">
                      <label for="validationCustom01"><b>{{ __('Title') }}</b></label>
                      <input type="text" class="form-control" id="validationCustom01"  placeholder="Package title" name="title" value="{{ $packagedetail->title }}"  autocomplete="off">
                      @if ($errors->has('title'))
                        <span class="invalid-feedback">
                          <strong>{{ $errors->first('title') }}</strong>
                        </span>
                      @endif
                    </div>
                    <div class="col-md-6 mb-4">
                      <label for="validationCustom02"><b> {{ __('Enter Package Description') }}</b></label>
                      <textarea class="form-control" placeholder="Enter Package Description" name="description" rows="4"> {{ $packagedetail ->description }}</textarea>
                      @if ($errors->has('description'))
                        <span class="invalid-feedback">
                          <strong>{{ $errors->first('description') }}</strong>
                        </span>
                      @endif
                    </div>
                    <div class="col-md-12">
                      <br/><br/>
                    </div>
                    <div class="col-md-6 mb-4">
                      <div class="d-flex justify-content-between border-bottom mb-2">
                        <h5 class="mb-4"><b>{{ __('Add Membership Types') }}</b></h5>
                        <div>
                          <button type="button" class="btn btn-primary mb-4 mr-2"
                                  data-toggle="modal" data-target="#exampleModal">
                              Add More
                          </button>
                        </div>
                      </div>
                      @if ($errors->has('memberships'))
                        <span class="invalid-feedback">
                          <strong>Please add at least one membership</strong>
                        </span>
                      @endif
                      <div class="col-md-12">
                       <div class="table-responsive">
                      <table id="membershiplisting" class="table table-bordered table-striped mb-4">
                        <tbody>
                        @if($packagedetail->packageMemberships)
                          @foreach($packagedetail->packageMemberships as $membership)
                            <tr><?php $time=explode('-', $membership->duration);$mstime='';
                                if($time[1]=="M"){$mstime="Months";}
                                if($time[1]=="W"){$mstime="Weeks";}
                                if($time[1]=="D"){$mstime="Days";}
                                if($time[1]=="Y"){$mstime="Year";}
                               
                             ?>
                              <th>{{$time[0].' '.$mstime}}</th>
                              <td>{{'Price: '.$membership->price}}</td>
                              <td class=" text-center"> 
                                <i class="close menu-icon mdi mdi-delete"></i> 
                                <input type="hidden" name="memberships[{{$membership->duration}}]" value="{{$membership->price}}">
                              </td>
                            </tr>

                          @endforeach
                        @endif
                        </tbody>
                      </table>
                      </div>
                    </div>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                      <div class="widget-content widget-content-area">
                        <div class="custom-file-container" data-upload-id="myFirstImage">
                          <label><b>Add Membership Image</b>
                            <span> (The image should be less than 2MB)</span>
                         </label>
                          <label class="custom-file-container__custom-file" >
                          <input type="file" class="custom-file-container__custom-file__custom-file-input" accept="image/*" name="membership_image">
                          <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                          <span class="custom-file-container__custom-file__custom-file-control">
                            
                          </span>
                          </label>
                          <div class="mt-2 text-right">
                           <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image"><i class="flaticon-circle-cross"></i></a>
                         </div>
                         <div class="custom-file-container__image-preview"></div>
                          @if ($errors->has('membership_image'))
                        <span class="invalid-feedback">
                          <strong>{{$errors->first('membership_image')}}</strong>
                        </span>
                      @endif
                        </div>
                      </div>
                    </div>

                    
                    <div class="col-md-12"></div>
                    <div class="col-md-6 mb-4 ">
                      <label><b>Add Cancellation Policy</b></label><br/>
                      <div class="form-inline">This Membership can be cancelled 
                        <select class="ml-2 mr-2 form-control form-control-rounded" name="cancellation">
                        @foreach($cancellations as $cancellation)
                          <option value="{{$cancellation->id}}" 
                            @if($packagedetail->cancellation==$cancellation->id)
                                {{__("selected")}}
                            @endif
                             >{{$cancellation->title}}
                          </option>
                        @endforeach
                        </select> to the start date.
                      </div>
                    </div>
                    <div class="col-md-6 mb-4 ">
                      <label><b>Refund Policy</b></label><br/>
                      <select class="form-control form-control-rounded" name="refund">
                        <option value="No Refund" 
                        <?php if($packagedetail->refund=="No Refund")
                        {echo "selected";} ?>>No Refund</option>
                        <option value="Partial Refund" <?php if($packagedetail->refund=="Partial Refund")
                        {echo "selected";} ?>>Partial Refund</option>
                        <option value="Full Refund" <?php if($packagedetail->refund=="Full Refund")
                        {echo "selected";} ?>>Full Refund</option>
                        
                      </select>
                    </div>
                  </div>
                  <button class="btn btn-primary" type="submit">Update</button>
                   

                </form>

            </div>
          </div>
        </div>
      </div>
    </div>
     @include('admins.footer')
  </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Membership Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="addmembershopform">
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 mb-4">
            <label>Enter Membership Duration</label>
            <div class="row">
              <div class="col-md-6">
                <input class="form-control" name="ms_value" type="number" placeholder="Enter Value" value="1" required autocomplete="off">
                <span class="invalid-feedback membershipval"></span>
              </div>
              <div class="col-md-6">
                <select class="form-control form-control-rounded" name="membership_duration">
                  <option disabled="disabled">Default select</option>
                  <option value="D">Day</option>
                  <option value="W">Week</option>
                  <option value="M" selected>Month</option>
                  <option value="Y">Year</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <label>Enter Membership Price</label>
            <div class="input-group mb-4">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">&#8377
                  <i class="flaticon-inr-coin"></i></span>
              </div>
              <input type="number" class="form-control" name="membership_price" placeholder="100.00" autocomplete="off">
              <span class="invalid-feedback membershipprice"></span>
            </div>
          </div>
        </div>
      </div>
    <div class="modal-footer">
      <button type="submit" id="add-membershipbtn" class="btn btn-primary btn-rounded mb-4 mt-2">Save changes </button>
      <button type="button" class="btn btn-dark btn-rounded mb-4 mt-2" data-dismiss="modal">Close</button>
    </div>
    </form>
  </div>
</div>
</div>
<script src="{{ asset('theme/plugins/file-upload/file-upload-with-preview.js') }}"></script>
<script>
$(document).ready(function () {
$("#addmembershopform").submit(function(e) {

    //prevent Default functionality
    e.preventDefault();



    var $value = $("input[name=ms_value]").val();
    var $duration = $("select[name=membership_duration]").find('option:selected').text();
    var $price = $("input[name=membership_price]").val();
    var time_period=$value+'-'+ $("select[name=membership_duration]").val();
    if($value=='' || $value<=0)
    {
      $('.membershipval').html("Please enter a value greater than 0");
      return false;
    }
    if($price=='' || $price<=0)
    {
        $('.membershipprice').html("Please enter membership price.");
        return false;
    }
    var tr = $('<tr>');
    tr.append($('<th>' +  $value + "&nbsp; " + $duration + '</th>'));
    tr.append($('<td>Price: ' + $price + '</td>'));
    tr.append($('<td class=" text-center"> <i class="close menu-icon mdi mdi-delete"></i> '+ 
      '<input type="hidden" name="memberships['+time_period+']" value="'+$price+'"></td>'));
    
    $('table#membershiplisting tbody').append(tr);
    $('.modal').modal('hide')


})
$('table#membershiplisting').on('click', '.close', function(e){
    //console.log("safasfasdf")
    $(this).parent().parent().remove();
})

})
</script>
<script>
//First upload
var firstUpload = new FileUploadWithPreview('myFirstImage')
console.log(firstUpload);
var imageUrl="{{asset('package/'.$packagedetail->image)}}";
$('.custom-file-container__image-preview').css('background-image', 'url(' + imageUrl + ')');
</script>
<script type="text/javascript">
   /* $(document).ready(function(){

      $('.status').click( function() {
    var seller_id='{{$packagedetail->id}}';
    var status=$('.status').text();
    console.log(seller_id+'--'+status)
    var updatestatus=0;
    if(status=='Approve')
    {
      updatestatus=1;
    }
    $.ajax({
              type: 'POST',
              url: "{{url('admin/updatepackage')}}",
              data: { update_status:updatestatus,id:seller_id,_token:"{{ csrf_token() }}" },
              success:  function(response)
              {
                console.log(response);
                  window.location.reload();
                   

              }
            });
});


  
})*/
</script>
<script type="text/javascript">
  $(document).ready(function(){

      $('.status').click( function() {
    var seller_id='{{$packagedetail->id}}';
    var status=$('.status').text();
    console.log(seller_id+'--'+status)
    var updatestatus=0;
    if(status=='Approve')
    {
      updatestatus=1;
    }

        Swal.fire({
      title: 'Are you sure?',
      text: "You want to "+status+ " this package",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, '+status+' it!'
    }).then((result) => {
      console.log(result)
      if (result.value) {
         $.ajax({
          url: "{{url('admin/updatepackage')}}",
          type: "POST",
          data: { update_status:updatestatus,id:seller_id,_token:"{{ csrf_token() }}" }, 
          success: function(res)
          { console.log(res);
            console.log(res.status);
            if(res.status=='success')
            {
                Swal.fire(
                'success!',
                res.message,
                'success'
              )
              location.reload(true);
            }
            else
            {
                 Swal.fire(
                'Error!',
                res.message,
                'error'
              )
            }
          }});
        }
      })
  });


  
})
</script> 
@endsection
