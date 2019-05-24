@extends('layouts.trainer-app')

@section('content')
 <div class="container-fluid page-body-wrapper">
     @include('trainer.sidebar')
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
         
          <div class="row">
            <div class="col-sm-12">
              <div class="card">
              <div class="card-body">
                <div class="row">
<div class="col-md-6">
                <h4>{{__('Update Your Gym Details')}}</h4>
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
<hr/>

                <form method="POST" action="{{ route('updateAuthUserPassword') }}" enctype="multipart/form-data">
                 
                  @csrf
                  <div class="">
                   <div class="form-group row">
                       <div class="col-md-12">
                           <label for="current" class="col-form-label"><b>{{ __('Current Password') }}</b></label>
                           <input class="form-control{{ $errors->has('current') ? ' is-invalid' : '' }}" type="password" name="current" value="" required autofocus>
                            @if ($errors->has('current'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('current') }}</strong>
                            </span>
                            @endif
                       </div>
                       <div class="col-md-12">
                           <label for="password" class=" col-form-label text-md-right"><b>{{ __('Password') }}</b></label>
                           <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name="password" value="" required autofocus>
                            @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                       </div>
                       <div class="col-md-12">
                           <label for="password_confirmation" class=" col-form-label text-md-right"><b>{{ __('Confirm Password') }}</b></label>
                            <input class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" type="password" name="password_confirmation" 
                            value="" required autofocus>
                            @if ($errors->has('password_confirmation'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                            @endif
                       </div>
                   </div>
                   
                  
                 
                </div>
                  <div class="form-group mb-4">
                     
                        <button type="submit" class="btn btn-primary">
                            {{ __('Submit') }}
                        </button>
                     
                  </div>

                       

                    </form>


              </div>
              </div>
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





    <div class="modal fade" id="myModal">
          <div class="modal-dialog">
              <div class="modal-content">

                  <!-- Modal Header -->
                  <div class="modal-header">
                      <h4 class="modal-title">Gym Video</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>

                  <!-- Modal body -->
                  <div class="modal-body">
                      <div class="embed-responsive embed-responsive-16by9">
                         <iframe width="560" height="315" src="{{$gym_info->video_link}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                      </div>
                  </div>

                  <!-- Modal footer -->
                  <div class="modal-footer">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                  </div>

              </div>
          </div>
      </div>



<script type="text/javascript">
  $(document).ready(function() {

      $(".btn-success").click(function(){ 
          //var html = $(".clone").html();
          var html =' <div class="row showhide">'+
                      '<input type="file" name="package_images[]" + class="form-control col-md-9">'+
                        '<button class="btn btn-danger col-md-2 remove" type="button">Remove</button>'+
                            '</div>';
          $(".increment").after(html);
      });

      $("body").on("click",".remove",function(){ 
          $(this).parents(".showhide").remove();
      });

    });
$('#image_preview').hide();

  $("#uploadFile").change(function(){

     $('#image_preview').html("");

     var total_file=document.getElementByName("gym_images").files.length;
console.log(total_file);
     for(var i=0;i<total_file;i++)

     {

      $('#image_preview').append("<img height='50' src='"+URL.createObjectURL(event.target.files[i])+"'>");
      $('#image_preview').show();

     }

  });
</script>



@endsection
