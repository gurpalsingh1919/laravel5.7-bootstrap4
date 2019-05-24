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
                <div class="card-header"><b>{{__('Add New City')}}</b>
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

                <form method="POST" action="{{ route('creatnewcity') }}" enctype="multipart/form-data">
                 
                  @csrf
                  <div class="card-body">
                   <div class="form-group row">
                       <div class="col-md-6">
                           <label for="name" class="col-form-label"><b>{{ __('Name') }}</b></label>
                           <input class="form-control" type="text" name="name" value="" required autofocus>
                            @if ($errors->has('name'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                       </div>
                     </div>
                     <div class="form-group row">
                       <div class="col-md-6">
                           <label for="latitude" class=" col-form-label text-md-right"><b>{{ __('Latitude') }}</b></label>
                           <input class="form-control" type="text" name="latitude" value="" required autofocus>
                            @if ($errors->has('latitude'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('latitude') }}</strong>
                            </span>
                            @endif
                       </div>
                      
                   </div>
                    <div class="form-group row">
                       <div class="col-md-6">
                           <label for="longitude" class=" col-form-label text-md-right"><b>{{ __('Longitude') }}</b></label>
                           <input class="form-control" type="text" name="longitude" value="" required autofocus>
                            @if ($errors->has('longitude'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('longitude') }}</strong>
                            </span>
                            @endif
                       </div>
                      
                   </div>
                   
                   
                   

                  
                 
                </div>
                  <div class="form-group row mb-4">
                    <div class="col-md-6 offset-md-2">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Submit') }}
                        </button>
                    </div>
                  </div>

                       

                    </form>


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
