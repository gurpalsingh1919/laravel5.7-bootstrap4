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
                <div class="card-header"><b>{{__('General Settings')}}</b>
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

                <form method="POST" id="update_gym" action="{{ route('setting.update') }}" enctype="multipart/form-data">
                  @method('PATCH')
                  @csrf
                  <div class="card-body">
                   <div class="form-group row">
                       <!-- <div class="col-md-6">
                           <label for="admin_comission" class="col-form-label"><b>{{ __('Admin Comission (%)') }}</b></label>
                           <input class="form-control{{ $errors->has('admin_comission') ? ' is-invalid' : '' }}" type="text" name="admin_comission" value="{{ $setting[0]->admin_comission }}" required autofocus>
                            @if ($errors->has('admin_comission'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('admin_comission') }}</strong>
                            </span>
                            @endif
                       </div> -->
                        <div class="col-md-6">
                           <label for=" services_charges" class="col-form-label text-md-right"><b>{{ __('Service Charges (%)') }}</b></label>
                           <input class="form-control{{ $errors->has('services_charges') ? ' is-invalid' : '' }}" type="text" name="services_charges" placeholder="Enter Service charges." value="{{ $setting[0]->services_charges }}" required autofocus>
                          
                            @if ($errors->has('services_charges'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('services_charges') }}</strong>
                            </span>
                            @endif
                       </div>
                       <div class="col-md-6">
                           <label for="maintenance_charges" class=" col-form-label text-md-right"><b>{{ __('Maintenance Charges (%)') }}</b></label>
                           <input class="form-control" type="text" value="{{ $setting[0]->maintenance_charges }}"  name="maintenance_charges"  required autofocus>
                          
                            @if ($errors->has('maintenance_charges'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('maintenance_charges') }}</strong>
                            </span>
                            @endif
                       </div>
                   </div>
                   
                   
                   <div class="form-group row">
                       <div class="col-md-6">
                           <label for="tax_percentage" class="col-form-label text-md-right"><b>{{ __('Tax (%)') }}</b></label>
                           <input class="form-control{{ $errors->has('tax_percentage') ? ' is-invalid' : '' }}" type="text" name="tax_percentage" placeholder="Enter tax in percentage." value="{{ $setting[0]->tax_percentage }}" required autofocus>
                          
                            @if ($errors->has('tax_percentage'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('tax_percentage') }}</strong>
                            </span>
                            @endif
                       </div>
                      
                  </div>
                 


                  

                  
                 
                </div>
                  <div class="form-group row mb-4">
                    <div class="col-md-6 offset-md-4">
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

      $(".add_more").click(function(){ 
          //var html = $(".clone").html();
          var html =' <div class="row showhide">'+
                      '<input type="file" name="gym_images[]" + class="form-control col-md-8">'+
                        '<button class="btn btn-danger col-md-3 remove" type="button">Remove</button>'+
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
