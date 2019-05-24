@extends('layouts.sellers-app')

@section('content')
 <div class="container-fluid page-body-wrapper">
     @include('sellers.sidebar')
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
         
          <div class="row">
            <div class="col-sm-12">
              <div class="card">
                 <div class="card-body">
                <h4>{{__('Add new package')}}</h4>
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

                 
                  <form method="POST" action="{{ route('addPackagePost') }}" enctype="multipart/form-data">
                        @csrf
             
                   <div class="form-group row">
                       <div class="col-md-6">
                           <label for="title" class="col-form-label">{{ __('Title') }}</label>
                           <input class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" type="text" name="title" value="{{ old('title') }}" required autofocus>
                            @if ($errors->has('title'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @endif
                       </div>
                       <div class="col-md-6">
                           <label for="description" class=" col-form-label text-md-right">{{ __('About') }}</label>
                           <input class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" type="text" name="description" value="{{ old('description') }}" required autofocus>
                            @if ($errors->has('description'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                            @endif
                       </div>
                   </div>
                   <div class="form-group row">
                       <div class="col-md-6">
                           <label for="timing" class="col-form-label text-md-right">{{ __('timing') }}</label>
                           <!-- <input class="form-control{{ $errors->has('timing') ? ' is-invalid' : '' }}" type="text" name="timing" value="{{ old('timing') }}" required autofocus>
                           @if ($errors->has('timing'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('timing') }}</strong>
                            </span>
                            @endif -->
                            <div class="row">
                            <div class="clockpicker col-md-6" >
                               <label for="start_time">{{ __('Start Time') }}</label>
                               <div class="input-group">
                              <input type="text" name="start_time" class="form-control" value="09:30">
                              <div class="input-group-append">
                                <span class="input-group-text">
                                  <i class="mdi mdi-timer"></i>
                                </span>
                              </div>
                               @if ($errors->has('start_time'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('start_time') }}</strong>
                            </span>
                            @endif
                            </div>
                            </div>
                             <div class="clockpicker col-md-6">
                                <label for="end_time">{{ __('End Time') }}</label>
                                 <div class="input-group">
                              <input type="text" name="end_time" class="form-control" value="09:30">
                              <div class="input-group-append">
                                <span class="input-group-text">
                                  <i class="mdi mdi-timer"></i>
                                </span>
                              </div>
                               @if ($errors->has('end_time'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('end_time') }}</strong>
                            </span>
                            @endif
                            </div>
                            </div>
                          </div>

        <script type="text/javascript">
            $(function () {
                $('.clockpicker').clockpicker({
                    donetext: 'Done'});
            });
        </script>
                       </div>
                       <div class="col-md-6">
                           <label for="price" class=" col-form-label text-md-right">{{ __('price') }}</label>
                           <input class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" type="text" name="price" value="{{ old('price') }}" required autofocus>
                           @if ($errors->has('price'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('price') }}</strong>
                            </span>
                            @endif
                       </div>
                   </div>
                   <div class="form-group row">
                       <div class="col-md-6">
                           <label for="health_benefits" class=" col-form-label text-md-right">{{ __('Health Benefits') }}</label>
                           <input class="form-control{{ $errors->has('health_benefits') ? ' is-invalid' : '' }}" type="text" name="health_benefits" value="{{ old('health_benefits') }}" required autofocus>
                           @if ($errors->has('health_benefits'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('health_benefits') }}</strong>
                            </span>
                            @endif
                       </div>
                       <div class="col-md-6">
                           <label for="average_cal_burn" class=" col-form-label text-md-right">{{ __('Average Calorie Burn') }}</label>
                           <input class="form-control{{ $errors->has('average_cal_burn') ? ' is-invalid' : '' }}" type="text" name="average_cal_burn" value="{{ old('average_cal_burn') }}" required autofocus>
                           @if ($errors->has('average_cal_burn'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('average_cal_burn') }}</strong>
                            </span>
                            @endif
                       </div>
                   </div>
                   <div class="form-group row">
                       <div class="col-md-6">
                           <label for="good_read" class="col-form-label text-md-right">{{ __('Good reads on Certified Trainers') }}</label>
                           <input class="form-control{{ $errors->has('good_read') ? ' is-invalid' : '' }}" type="text" name="   good_read" value="{{ old('good_read') }}" required autofocus>
                            @if ($errors->has('good_read'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('good_read') }}</strong>
                            </span>
                            @endif
                       </div>
                       <div class="col-md-6">
                           <label for="nutrition" class="col-form-label text-md-right">{{ __('Nutritions') }}</label>
                           <input class="form-control{{ $errors->has('nutrition') ? ' is-invalid' : '' }}" type="text" name="nutrition" value="{{ old('nutrition') }}" required autofocus>
                            @if ($errors->has('nutrition'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('nutrition') }}</strong>
                            </span>
                            @endif
                       </div>
                   </div>
                   <div class="form-group row">
                       <div class="col-md-6">
                           <label for="diet" class=" col-form-label text-md-right">{{ __('Diet') }}</label>
                           <input class="form-control{{ $errors->has('diet') ? ' is-invalid' : '' }}" type="text" 
                           name="diet" value="{{ old('diet') }}" required autofocus>
                           @if ($errors->has('diet'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('diet') }}</strong>
                            </span>
                            @endif
                       </div>
                       <div class="col-md-6">
                           <label for="results" class="col-form-label text-md-right">{{ __('results') }}</label>
                           <input class="form-control{{ $errors->has('results') ? ' is-invalid' : '' }}" type="text" value="{{ old('results') }}" required autofocus name="results">
                            @if ($errors->has('results'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('results') }}</strong>
                            </span>
                            @endif
                       </div>
                   </div>

                   <div class="form-group row">
                       <div class="col-md-6">
                           <label for="package_type_id" class=" col-form-label text-md-right">{{ __('Package type') }}</label>
                           <select class="form-control{{ $errors->has('package_type_id') ? ' is-invalid' : '' }}"  
                           name="package_type_id">

                           @foreach($packages_types as $paktypes)
                           <option value="{{$paktypes->id}}">{{$paktypes->name}}
                           </option>
                           @endforeach
                       </select>
                           @if ($errors->has('diet'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('diet') }}</strong>
                            </span>
                            @endif
                       </div>
                        <div class="col-md-6">
                           <label for="images" class="col-form-label text-md-right">{{ __('Images') }}</label>
                           <div id="image_preview"></div>
                          <div class="increment">
                            <div class="js">
                           <input class="form-control form-control-sm inputfile inputfile-2" type="file" id="file-10"  name="package_images[]" autocomplete="off">
                            <label for="file-10"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Upload here.&hellip;</span></label>
                          </div>
                            <div class="form-group morefileinput ">

                                       </div>
                            <button class="btn btn-success btn-sm" type="button">Add</button>
                          </div>
                         <!--  <div class="clone hide">
                           
                          </div>  -->
                          
                            @if ($errors->has('gym_images'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('gym_images') }}</strong>
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
        @include('sellers.footer')
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
<script type="text/javascript">
  $(document).ready(function() {

      $(".btn-success").click(function(){ 
          //var html = $(".clone").html();
          var html =' <div class="col-xs-12 mb-3"> <div class="showhide row"><div class="col-md-8">'+
                      '<input type="file" name="package_images[]" + class="form-control"></div>'+
                        '<div class="col-md-3"><button class="btn btn-danger remove" type="button">Remove</button>'+
                            '</div></div></div>';
          $(".morefileinput").after(html);
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
