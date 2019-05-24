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
                <div class="card-header">
                    <b>{{$seller[0]->gym_name}}</b>
                   <div class="float-right">
                      <a href="{{url('admin/seller/edit/'.$seller[0]->id)}}" class="btn btn-primary editseller">Edit</a>
                    </div>



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
              <div class="card-body pl-0 pr-0">
                  <p>
                  <strong>About:</strong><br/>
                  {{$seller[0]->gym_description}}
                  </p>
                  <br/>

                  <div class="row">
                      <div class="col-md-6 mb-5">
                          <table class="table table-bordered">
                              <tr>
                                  <th>Seller Name:</th>
                                  <td>{{$seller[0]->user->name}}</td>
                              </tr>
                              <tr>
                                  <th>Gym Name:</th>
                                  <td>{{$seller[0]->gym_name}}</td>
                              </tr>
                              <tr>
                                  <th>Email:</th>
                                  <td>{{$seller[0]->user->email}}</td>
                              </tr>
                              <tr>
                                  <th>Contact Detail:</th>
                                  <td>{{$seller[0]->user->phone_no}}</td>
                              </tr>
                              <tr>
                                  <th>Address:</th>
                                  <td style="white-space: inherit">{{$seller[0]->gym_address .','. $seller[0]->zip}}</td>
                              </tr>
                              <tr>
                                  <th>City:</th>
                                  <td>{{$seller[0]->city}}</td>
                              </tr>
                              @if($seller[0]->website_link)
                                  <tr>
                                      <th>Website:</th>
                                      <td><a href="{{$seller[0]->website_link}}" target="_blank">Click</a></td>
                                  </tr>
                              @endif
                             
                             
                              <tr>
                                  <th>Status:</th>
                                  <td> @if($seller[0]->status==1)
                                          <label class="badge-success badge">
                                              <i class="fa fa-check"></i>&nbsp;Approved
                                          </label>
                                      @else
                                          <label class="badge-warning badge">
                                              <i class="fa fa-circle-o-notch"></i>&nbsp;Pending
                                          </label>


                                      @endif</td>
                              </tr>
                              <tr>
                                  <th>Images:</th> <?php $images = explode('|', $seller[0]->gym_images); ?>
                                  <td id="neargym_image1" class="thumbnail-image">
                                     
                                      @foreach($images as $image)
                                          <img style="border-radius: 0" class="img-fluid imageThumb" src="{{asset('gyms/'.$image)}}">

                                      @endforeach
                                     
                                  </td>
                              </tr>
                          </table>
                      </div>
                      <div class="col-md-6">
                          <table class="table table-bordered">

                              @if($seller[0]->video_link)
                                  <tr>
                                      
                                      <td colspan="2">
                                        <div class="embed-responsive embed-responsive-16by9">
                                           
                                          <video class="embed-responsive-item" controls>
                                              <source src="{{asset('gyms/'.$seller[0]->video_link)}}" type="video/mp4">

                                          </video>
                                        </div>
                                        </td>
                                  </tr>
                              @endif

                              <tr>
                                  <th>Licence:</th>
                                  <td>
                                     
                                           <a  target="_blank" href="{{asset('licences/'.$seller[0]->gym_licence)}}">
                                             <i class="fas fa-file-pdf"></i> View Attachment
                                           </a>
                                          
                                       
                                  </td>
                              </tr>
                              <tr>
                                  <th>GSTN/PAN:</th>
                              <!-- <td> <embed src="{{asset('gyms/'.$seller[0]->pan_image)}}" type="application/pdf" width="100%" height="600px" /></td> -->
                                  <td>
                                    <a href=" {{asset('gyms/'.$seller[0]->pan_image)}}"   target="_blank">
                                             <i class="fas fa-file-pdf"></i> View Attachment
                                           </a>
                                      
                                          
                                  </td>
                              </tr>
                               <tr>
                                  <th>Timing:</th>
                                  <td>{{$seller[0]->timing}} </td>
                              </tr>
                               <tr>
                                <?php  $sellercategories=$seller[0]->category_id;
                      $cat_arr=explode("|", $sellercategories);
                     ?>
                                  <th>Category:</th>
                                  <td>
                                    @foreach($categories as $category)
                                      @if(in_array($category->id, $cat_arr))
                                      {{$category->name ." , "}}
                                      @endif
                                    @endforeach

                                     </td>
                              </tr>
                          </table>

                      </div>
                  </div>

                @if($seller[0]->user->status ==0)
                 <input type="button"class="btn btn-primary status"  value="Approve" />
                @elseif($seller[0]->status !=1)
                <input type="button"class="btn btn-primary status"  value="Activate" />
                @else
                <input type="button" id="deactivate" onclick="deactivateSeller()" class="btn btn-warning" value="Deactivate" />
                @endif

                </div>
              </div>
            </div>
            
          </div>
         

       
        </div>

         
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        @include('admins.footer')
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
     <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script type="text/javascript">
  function deactivateSeller()
      {
          Swal.fire({
        title: 'Loading Please Wait',
       onBeforeOpen: () => {
          Swal.showLoading()
         
        }
      });


         $("#deactivate").addClass('loader');
          var seller_id='{{$seller[0]->id}}';
          var updatestatus=0;
           $.ajax({
              type: 'POST',
              url: "{{url('admin/deactive-seller')}}",
              data: { update_status:updatestatus,id:seller_id,_token:"{{csrf_token()}}" },
              success:  function(response)
              {
                  console.log(response);
                  window.location.reload();

                    Swal(
                  'Good job!',
                  message,
                  'success'
                )
                   

              }
            });


      }
           
    $(document).ready(function(){
      





      $('.status').click( function() {
         Swal.fire({
        title: 'Loading Please Wait',
       onBeforeOpen: () => {
          Swal.showLoading()
         
        }
      })
    var seller_id='{{$seller[0]->id}}';
    var status=$('.status').val();
    //console.log(seller_id+'--'+status)
    var updatestatus=0;
     var message="You have sucessfully unapproved seller !!!";
    if(status=='Approve' || status=='Activate')
    {
      updatestatus=1;
      var message="You have sucessfully approved seller !!!";
    }
    $.ajax({
              type: 'POST',
              url: "{{url('admin/updateSeller')}}",
              data: { update_status:updatestatus,id:seller_id,_token:"{{csrf_token()}}" },
              success:  function(response)
              {
                  console.log(response);
                  window.location.reload();

                    Swal(
                  'Good job!',
                  message,
                  'success'
                )
                   

              }
            });
});


  
})
</script>
@endsection
