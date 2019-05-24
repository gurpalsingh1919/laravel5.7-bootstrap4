@extends('layouts.sellers-app')

@section('content')
 <div class="container-fluid page-body-wrapper">
     @include('sellers.sidebar')
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
         
          <div class="row">
            <div class="col-sm-12 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-header"><b>{{__('Update package')}}</b>
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

                  <form method="POST" action="{{ route('packages.update',$packagedetail) }}" enctype="multipart/form-data">
     @method('PATCH')
 
                        @csrf
                        <input type="hidden" name="seller_id" value="{{$packagedetail->seller_id}}">
                <div class="card-body">
                   <div class="form-group row">
                       <div class="col-md-6">
                           <label for="title" class=" col-form-label text-md-right">{{ __('title') }}</label>
                           <input class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" type="text" name="title" value="{{ $packagedetail->title }}" required autofocus>
                            @if ($errors->has('title'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @endif
                       </div>
                       <div class="col-md-6">
                           <label for="description" class=" col-form-label text-md-right">{{ __('About') }}</label>
                           <input class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" type="text" name="description" value="{{ $packagedetail ->description }}" required autofocus>
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
                          <!--  <input class="form-control{{ $errors->has('timing') ? ' is-invalid' : '' }}" type="text" name="timing" value="{{ $packagedetail ->timing }}" required autofocus>
                           @if ($errors->has('timing'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('timing') }}</strong>
                            </span>
                            @endif -->
                            <?php $time=explode('-', $packagedetail->timing);?>
                            <div class="row">
                            <div class="clockpicker col-md-6" >
                               <label for="start_time">{{ __('Start Time') }}</label>
                               <div class="input-group">
                              <input type="text" name="start_time" class="form-control" value="{{$time[0]?$time[0]:''}}">
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
                              <input type="text" name="end_time" class="form-control" value="{{$time[1]?$time[1]:''}}">
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
                           <input class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" type="text" name="price" value="{{ $packagedetail ->price }}" required autofocus>
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
                           <input class="form-control{{ $errors->has('health_benefits') ? ' is-invalid' : '' }}" type="text" name="health_benefits" value="{{ $packagedetail ->health_benefits }}" required autofocus>
                           @if ($errors->has('health_benefits'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('health_benefits') }}</strong>
                            </span>
                            @endif
                       </div>
                       <div class="col-md-6">
                           <label for="average_cal_burn" class=" col-form-label text-md-right">{{ __('Average Calorie Burn') }}</label>
                           <input class="form-control{{ $errors->has('average_cal_burn') ? ' is-invalid' : '' }}" type="text" name="average_cal_burn" value="{{ $packagedetail ->average_cal_burn }}" required autofocus>
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
                           <input class="form-control{{ $errors->has('good_read') ? ' is-invalid' : '' }}" type="text" name="good_read" 
                           value="{{ $packagedetail->good_read }}" required autofocus>
                            @if ($errors->has('good_read'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('good_read') }}</strong>
                            </span>
                            @endif
                       </div>
                       <div class="col-md-6">
                           <label for="nutrition" class="col-form-label text-md-right">{{ __('Nutritions') }}</label>
                           <input class="form-control{{ $errors->has('nutrition') ? ' is-invalid' : '' }}" type="text" name="nutrition" value="{{ $packagedetail->nutrition }}" required autofocus>
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
                           name="diet" value="{{ $packagedetail ->diet }}" required autofocus>
                           @if ($errors->has('diet'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('diet') }}</strong>
                            </span>
                            @endif
                       </div>
                       <div class="col-md-6">
                           <label for="results" class="col-form-label text-md-right">{{ __('results') }}</label>
                           <input class="form-control{{ $errors->has('results') ? ' is-invalid' : '' }}" type="text" value="{{ $packagedetail ->results }}" required autofocus name="results">
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
                           <option 
                           @if( $paktypes->id == $packagedetail->package_type_id) selected  @endif 
                           value="{{$paktypes->id}}" >{{$paktypes->name}}
                           </option>
                           @endforeach
                       </select>
                           @if ($errors->has('diet'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('diet') }}</strong>
                            </span>
                            @endif
                       </div>
                      
                   </div>

                </div>

                 <div class="form-group row mb-4">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
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

@endsection
