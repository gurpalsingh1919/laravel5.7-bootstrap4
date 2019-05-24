@extends('layouts.sellers-app')

@section('content')
    <<<<<<< Updated upstream
    <div class="container-fluid page-body-wrapper">
    @include('sellers.sidebar')
    <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-sm-12 ">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-4">{{__('Update Your Gym Details ')}}</h4>
                                @if($errors->all())
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger">{{ $error }}</div>
                                    @endforeach
                                @endif
                                @if(session('error'))
                                    <div class="error alert alert-danger alert-dismissable">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <strong>Error : </strong> {{ session('error') }}
                                    </div>
                                @endif
                                @if(session('success'))
                                    <div class="error alert alert-success alert-dismissable">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        {!! session('success') !!}
                                    </div>
                                @endif
                                <form method="POST" id="update_gym" action="{{ route('gym.update') }}"
                                      enctype="multipart/form-data">
                                    @method('PATCH')
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="gym_name"
                                                       class="col-form-label"><strong>{{ __('Gym Name') }}</strong></label>
                                                <input class="form-control{{ $errors->has('gym_name') ? ' is-invalid' : '' }}"
                                                       type="text" name="gym_name" value="{{ $gym_info->gym_name }}"
                                                       required autofocus>
                                                @if ($errors->has('gym_name'))
                                                    <span class="invalid-feedback">
<strong>{{ $errors->first('gym_name') }}</strong>
</span>
                                                @endif
                                            </div>
                                            <div class="js form-group">
                                                <label class=" col-form-label"><strong>{{ __('Video') }} (*
                                                        mp4,webm,3gp,mov,flv,avi,wmv,ts)</strong></label>
                                                <div class="float-right">

                                                    @if(!empty($gym_info->video_link))
                                                        <button type="button" class="btn btn-sm btn-primary"
                                                                data-toggle="modal"
                                                                data-target="#video-play">Play Video
                                                            =======
                                                            {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/css/bootstrap-select.min.css">--}}
                                                            {{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css" type="text/css"/>--}}
                                                            {{--
                                                                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
                                                            --}}


                                                            <div class="container-fluid page-body-wrapper">
                                                            @include('sellers.sidebar')
                                                            <!-- partial -->
                                                                <div class="main-panel">
                                                                    <div class="content-wrapper">
                                                                        <div class="row">
                                                                            <div class="col-sm-12 ">
                                                                                <div class="card">
                                                                                    <div class="card-body">
                                                                                        <h4 class="mb-4">{{__('Update Your Gym Details ')}}</h4>
                                                                                        @if($errors->all())
                                                                                            @foreach ($errors->all() as $error)
                                                                                                <div class="alert alert-danger">{{ $error }}</div>
                                                                                            @endforeach
                                                                                        @endif
                                                                                        @if(session('error'))
                                                                                            <div class="error alert alert-danger alert-dismissable">
                                                                                                <a href="#"
                                                                                                   class="close"
                                                                                                   data-dismiss="alert"
                                                                                                   aria-label="close">&times;</a>
                                                                                                <strong>Error
                                                                                                    : </strong> {{ session('error') }}
                                                                                            </div>
                                                                                        @endif
                                                                                        @if(session('success'))
                                                                                            <div class="error alert alert-success alert-dismissable">
                                                                                                <a href="#"
                                                                                                   class="close"
                                                                                                   data-dismiss="alert"
                                                                                                   aria-label="close">&times;</a>
                                                                                                {!! session('success') !!}
                                                                                            </div>
                                                                                        @endif
                                                                                        <form method="POST"
                                                                                              id="update_gym"
                                                                                              action="{{ route('gym.update') }}"
                                                                                              enctype="multipart/form-data">
                                                                                            @method('PATCH')
                                                                                            @csrf
                                                                                            <div class="row">
                                                                                                <div class="col-md-6">
                                                                                                    <div class="form-group">
                                                                                                        <label for="gym_name"
                                                                                                               class="col-form-label"><strong>{{ __('Gym Name') }}</strong></label>
                                                                                                        <input class="form-control{{ $errors->has('gym_name') ? ' is-invalid' : '' }}"
                                                                                                               type="text"
                                                                                                               name="gym_name"
                                                                                                               value="{{ $gym_info->gym_name }}"
                                                                                                               required
                                                                                                               autofocus>
                                                                                                        @if ($errors->has('gym_name'))
                                                                                                            <span class="invalid-feedback">
                        <strong>{{ $errors->first('gym_name') }}</strong>
                    </span>
                                                                                                        @endif
                                                                                                    </div>
                                                                                                    <div class="js form-group">
                                                                                                        <label class=" col-form-label"><strong>{{ __('Video') }}
                                                                                                                (*
                                                                                                                mp4,webm,3gp,mov,flv,avi,wmv,ts)</strong></label>
                                                                                                        <div class="float-right">

                                                                                                            @if(!empty($gym_info->video_link))
                                                                                                                <button type="button"
                                                                                                                        class="btn btn-sm btn-primary"
                                                                                                                        data-toggle="modal"
                                                                                                                        data-target="#video-play">
                                                                                                                    Play
                                                                                                                    Video
                                                                                                                </button>
                                                                                                            @endif
                                                                                                        </div>

                                                                                                        </br>
                                                                                                        <input id="file-1"
                                                                                                               class="form-control inputfile inputfile-2"
                                                                                                               type="file"
                                                                                                               name="gym_video"
                                                                                                               value=""
                                                                                                               placeholder="Upload your gym video here.">
                                                                                                        <label for="file-1">
                                                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                                 width="20"
                                                                                                                 height="17"
                                                                                                                 viewBox="0 0 20 17">
                                                                                                                <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
                                                                                                            </svg>
                                                                                                            <span>Upload your gym video here.&hellip;</span></label>
                                                                                                        @if ($errors->has('gym_video'))
                                                                                                            <span class="invalid-feedback">
                        <strong>{{ $errors->first('gym_video') }}</strong>
                      </span>
                                                                                                        @endif
                                                                                                    </div>
                                                                                                    <?php $time = explode('to', $gym_info->timing);?>
                                                                                                    <div class="form-group">
                                                                                                        <label for="timing"
                                                                                                               class="col-form-label text-md-right"><b>{{ __('Timing') }}</b></label>
                                                                                                        <div class="form-group">
                                                                                                            <div class='input-group date'
                                                                                                                 id='datetimepicker1'>
                                                                                                                <input type='text'
                                                                                                                       class="form-control"/>
                                                                                                                <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                                                                                            </div>
                                                                                                        </div>

                                                                                                    <!--  <div class="row">
                            <div class="clockpicker col-md-6" >
                               <label for="start_time">{{ __('Opening Time') }}</label>
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
                                                                                                                <label for="end_time">{{ __('Closing Time') }}</label>
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
                                                                                                          </div> -->


                                                                                                    </div>

                                                                                                    <div class="js">
                                                                                                        <div class="form-group">


                                                                                                            <?php $images = explode('|', $gym_info->gym_images); ?>
                                                                                                            <div class="float-left">
                                                                                                                <label class="label">{{ __('Gym Images') }}
                                                                                                                    (*
                                                                                                                    jpeg,png,jpg)</label><br/>
                                                                                                                @foreach($images as $image)
                                                                                                                    <img class="imageThumb"
                                                                                                                         src="{{asset('gyms/'.$image)}}"
                                                                                                                         height="70">
                                                                                                                @endforeach
                                                                                                            </div>
                                                                                                            <div class="input-group increment ">
                                                                                                                <input name="gym_images[]"
                                                                                                                       type="file"
                                                                                                                       class="form-control form-control-sm inputfile inputfile-2"
                                                                                                                       id="file-8">
                                                                                                                <label for="file-8">
                                                                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                                         width="20"
                                                                                                                         height="17"
                                                                                                                         viewBox="0 0 20 17">
                                                                                                                        <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
                                                                                                                    </svg>
                                                                                                                    <span>Gym Images&hellip;</span></label>

                                                                                                            </div>
                                                                                                            <button class="btn btn-secondary add_more btn-sm"
                                                                                                                    type="button">
                                                                                                                Add
                                                                                                                More
                                                                                                            </button>
                                                                                                            @if ($errors->has('gym_images'))
                                                                                                                <span class="invalid-feedback">
                          <strong>{{ $errors->first('gym_images') }}</strong>
                      </span>
                                                                                                            @endif
                                                                                                        </div>
                                                                                                    </div>

                                                                                                </div>
                                                                                                <div class="col-md-6">
                                                                                                    <div class="form-group">
                                                                                                        <label for="gym_description"
                                                                                                               class=" col-form-label text-md-right"><strong>{{ __('About') }}</strong></label>
                                                                                                        <textarea
                                                                                                                class="form-control"
                                                                                                                rows="5"
                                                                                                                type="text"
                                                                                                                name="gym_description"
                                                                                                                required
                                                                                                                autofocus>{{ $gym_info->gym_description }}
                   </textarea>
                                                                                                        @if ($errors->has('gym_description'))
                                                                                                            <span class="invalid-feedback">
                        <strong>{{ $errors->first('gym_description') }}</strong>
                    </span>
                                                                                                        @endif

                                                                                                    </div>
                                                                                                    <?php $sellercategories = $gym_info->category_id;
                                                                                                    $cat_arr = explode("|", $sellercategories);
                                                                                                    ?>
                                                                                                    <div class="form-group">
                                                                                                        <label class=" col-form-label"><strong>{{ __('Gym Categories (Multi-select)') }}</strong></label></br>


                                                                                                        <select id="example-getting-started"
                                                                                                                class=""
                                                                                                                multiple="multiple">
                                                                                                            <option value="cheese">
                                                                                                                Cheese
                                                                                                            </option>
                                                                                                            <option value="tomatoes">
                                                                                                                Tomatoes
                                                                                                            </option>
                                                                                                            <option value="mozarella">
                                                                                                                Mozzarella
                                                                                                            </option>
                                                                                                            <option value="mushrooms">
                                                                                                                Mushrooms
                                                                                                            </option>
                                                                                                            <option value="pepperoni">
                                                                                                                Pepperoni
                                                                                                            </option>
                                                                                                            <option value="onions">
                                                                                                                Onions
                                                                                                            </option>
                                                                                                        </select>


                                                                                                        <select name="category[]"
                                                                                                                id="category"
                                                                                                                class="form-control form-control-sm"
                                                                                                                multiple
                                                                                                                data-live-search="true">
                                                                                                            <!-- <option value="" selected disabled>Category*</option> -->
                                                                                                            @foreach($categories as $category)
                                                                                                                <option value="{{$category->id}}"
                                                                                                                @if(in_array($category->id, $cat_arr))
                                                                                                                    {{__('selected')}}
                                                                                                                        @endif>{{$category->name}}
                                                                                                                </option>
                                                                                                            @endforeach
                                                                                                        </select>
                                                                                                        @if ($errors->has('category'))
                                                                                                            <span class="invalid-feedback">
                      <strong>{{ $errors->first('category') }}</strong>
                  </span>
                                                                                                        @endif
                                                                                                    </div>
                                                                                                    <?php $gymfacilities = $gym_info->facilities;
                                                                                                    $facility_arr = explode("|", $gymfacilities);
                                                                                                    ?>
                                                                                                    <div class="form-group">
                                                                                                        <label class=" col-form-label"><strong>{{ __('Gym Facilities') }}
                                                                                                                (Multi-select)</strong></label>
                                                                                                        <select name="facility[]"
                                                                                                                id="facility"
                                                                                                                class="form-control form-control-sm"
                                                                                                                multiple
                                                                                                                data-live-search="true">
                                                                                                            <!-- <option value="" selected disabled>Category*</option> -->
                                                                                                            @foreach($gymFacility as $facility)
                                                                                                                <option value="{{$facility->id}}"
                                                                                                                @if(in_array($facility->id, $facility_arr))
                                                                                                                    {{__('selected')}}
                                                                                                                        @endif>{{$facility->name}}
                                                                                                                </option>
                                                                                                            @endforeach
                                                                                                        </select>
                                                                                                        @if ($errors->has('facility'))
                                                                                                            <span class="invalid-feedback">
                      <strong>{{ $errors->first('facility') }}</strong>
                  </span>
                                                                                                        @endif
                                                                                                    </div>


                                                                                                </div>


                                                                                            </div>

                                                                                            <!-- </div>
                                                                                            <hr/> -->
                                                                                            <div class="form-group text-center border-top pt-3">

                                                                                                <button type="submit"
                                                                                                        class="btn btn-primary">
                                                                                                    {{ __('Submit') }}
                                                                                                    >>>>>>> Stashed
                                                                                                    changes
                                                                                                </button>
                                                                                                @endif
                                                                                            </div>
                                                                                            </br>
                                                                                            <input id="file-1"
                                                                                                   class="form-control inputfile inputfile-2"
                                                                                                   type="file"
                                                                                                   name="gym_video"
                                                                                                   value=""
                                                                                                   placeholder="Upload your gym video here.">
                                                                                            <label for="file-1">
                                                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                     width="20"
                                                                                                     height="17"
                                                                                                     viewBox="0 0 20 17">
                                                                                                    <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
                                                                                                </svg>
                                                                                                <span>Upload your gym video here.&hellip;</span></label>
                                                                                            @if ($errors->has('gym_video'))
                                                                                                <span class="invalid-feedback">
<strong>{{ $errors->first('gym_video') }}</strong>
</span>
                                                                                        @endif
                                                                                    </div>
                                                                                    <?php $time = explode('to', $gym_info->timing);?>
                                                                                    <div class="form-group">
                                                                                        <label for="timing"
                                                                                               class="col-form-label text-md-right"><b>{{ __('Timing') }}</b></label>
                                                                                        <div class="form-group">
                                                                                            <div class='input-group date'
                                                                                                 id='datetimepicker1'>
                                                                                                <input type='text'
                                                                                                       class="form-control"/>
                                                                                                <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
                                                                                            </div>
                                                                                        </div>

                                                                                    <!--  <div class="row">
    <div class="clockpicker col-md-6" >
       <label for="start_time">{{ __('Opening Time') }}</label>
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
                                                                                                <label for="end_time">{{ __('Closing Time') }}</label>
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
                                                                                          </div> -->


                                                                                    </div>

                                                                                    <div class="js">
                                                                                        <div class="form-group">


                                                                                            <?php $images = explode('|', $gym_info->gym_images); ?>
                                                                                            <div class="float-left">
                                                                                                <label class="label">{{ __('Gym Images') }}
                                                                                                    (*
                                                                                                    jpeg,png,jpg)</label><br/>
                                                                                                @foreach($images as $image)
                                                                                                    <img class="imageThumb"
                                                                                                         src="{{asset('gyms/'.$image)}}"
                                                                                                         height="70">
                                                                                                @endforeach
                                                                                            </div>
                                                                                            <div class="input-group increment ">
                                                                                                <input name="gym_images[]"
                                                                                                       type="file"
                                                                                                       class="form-control form-control-sm inputfile inputfile-2"
                                                                                                       id="file-8">
                                                                                                <label for="file-8">
                                                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                                                         width="20"
                                                                                                         height="17"
                                                                                                         viewBox="0 0 20 17">
                                                                                                        <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/>
                                                                                                    </svg>
                                                                                                    <span>Gym Images&hellip;</span></label>

                                                                                            </div>
                                                                                            <button class="btn btn-secondary add_more btn-sm"
                                                                                                    type="button">Add
                                                                                                More
                                                                                            </button>
                                                                                            @if ($errors->has('gym_images'))
                                                                                                <span class="invalid-feedback">
  <strong>{{ $errors->first('gym_images') }}</strong>
</span>
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label for="gym_description"
                                                                                               class=" col-form-label text-md-right"><strong>{{ __('About') }}</strong></label>
                                                                                        <textarea class="form-control"
                                                                                                  rows="5" type="text"
                                                                                                  name="gym_description"
                                                                                                  required autofocus>{{ $gym_info->gym_description }}
</textarea>
                                                                                        @if ($errors->has('gym_description'))
                                                                                            <span class="invalid-feedback">
<strong>{{ $errors->first('gym_description') }}</strong>
</span>
                                                                                        @endif

                                                                                    </div>
                                                                                    <?php $sellercategories = $gym_info->category_id;
                                                                                    $cat_arr = explode("|", $sellercategories);
                                                                                    ?>
                                                                                    <div class="form-group">
                                                                                        <label class=" col-form-label"><strong>{{ __('Gym Categories (Multi-select)') }}</strong></label></br>
                                                                                        <select name="category[]"
                                                                                                id="category"
                                                                                                class="form-control form-control-sm"
                                                                                                multiple
                                                                                                data-live-search="true">
                                                                                            <!-- <option value="" selected disabled>Category*</option> -->
                                                                                            @foreach($categories as $category)
                                                                                                <option value="{{$category->id}}"
                                                                                                @if(in_array($category->id, $cat_arr))
                                                                                                    {{__('selected')}}
                                                                                                        @endif>{{$category->name}}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                        @if ($errors->has('category'))
                                                                                            <span class="invalid-feedback">
<strong>{{ $errors->first('category') }}</strong>
</span>
                                                                                        @endif
                                                                                    </div>
                                                                                    <?php $gymfacilities = $gym_info->facilities;
                                                                                    $facility_arr = explode("|", $gymfacilities);
                                                                                    ?>
                                                                                    <div class="form-group">
                                                                                        <label class=" col-form-label"><strong>{{ __('Gym Facilities') }}
                                                                                                (Multi-select)</strong></label>
                                                                                        <select name="facility[]"
                                                                                                id="facility"
                                                                                                class="form-control form-control-sm"
                                                                                                multiple
                                                                                                data-live-search="true">
                                                                                            <!-- <option value="" selected disabled>Category*</option> -->
                                                                                            @foreach($gymFacility as $facility)
                                                                                                <option value="{{$facility->id}}"
                                                                                                @if(in_array($facility->id, $facility_arr))
                                                                                                    {{__('selected')}}
                                                                                                        @endif>{{$facility->name}}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                        @if ($errors->has('facility'))
                                                                                            <span class="invalid-feedback">
<strong>{{ $errors->first('facility') }}</strong>
</span>
                                                                                        @endif
                                                                                    </div>


                                                                                </div>


                                                                            </div>
                                                                            <<<<<<< Updated upstream

                                                                            <!-- </div>
                                                                            <hr/> -->
                                                                            <div class="form-group text-center border-top pt-3">

                                                                                <button type="submit"
                                                                                        class="btn btn-primary">
                                                                                    {{ __('Submit') }}
                                                                                </button>
                                                                            </div>
                                </form>
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


            <!---------------------- Video Play Modal ------------------------->
            <div class="modal fade" id="video-play">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Gym Video</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <video width="img-fluid" id="yt-player" height="240" controls>
                                <source src="{{asset('gyms/'.$gym_info->video_link)}}" type="video/mp4">

                            </video>

                        </div>

                    </div>
                </div>
            </div>
        <!-- <link href="{{url('/css/bootstrap-datepicker.css')}}" rel="stylesheet" />
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="{{url('/js/bootstrap-datepicker.js')}}"></script> -->

            <script type="text/javascript">
                // $('#datetimepicker1').timepicker({ 'timeFormat': 'h:i A' });
                $(document).ready(function () {
                ======
                    =
                <
                    /div>
                    < !-- < link
                    href = "{{url('/css/bootstrap-datepicker.css')}}"
                    rel = "stylesheet" / >
                        < script
                    src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" ></script>
            <script type="text/javascript" src="{{url('/js/bootstrap-datepicker.js')}}"></script>
            -->
            {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/js/bootstrap-select.min.js"></script>--}}


            <script type="text/javascript">
                // $('#datetimepicker1').timepicker({ 'timeFormat': 'h:i A' });
                $(document).ready(function () {
                    $('#example-getting-started').multiselect();
                >>>>>>>
                    Stashed
                    changes

                    //     $('#datetimepicker1').datetimepicker({
                    //   format: "dddd: HH:mm"
                    // });
                    << < < < < < Updated
                    upstream
//$('.clockpicker').clockpicker({donetext: 'Done'});
//$('#category').selectpicker();
// $('#facility').selectpicker();
                    $('#video-play').on('hidden.bs.modal', function () {
                        $('#yt-player')[0].pause();
                    });
                ======
                    =
                        //$('.clockpicker').clockpicker({donetext: 'Done'});
                        $('#category').selectpicker();
                    $('#facility').selectpicker();
                    $('#video-play').on('hidden.bs.modal', function () {
                        $('#yt-player')[0].pause();
                    });
                >>>>>>>
                    Stashed
                    changes


                    $(".add_more").click(function () {
//var html = $(".clone").html();
                        var html = ' <div class="col-xs-12 mt-3"> <div class="showhide row"><div class="col-md-8"> ' +
                            '<input type="file" name="gym_images[]" + class="form-control "></div>' +
                            '<div class="col-md-3"> <button class="btn btn-danger remove" type="button">Remove</button>' +
                            '</div></div></div>';
                        $(".increment").append(html);
                    });

                    $("body").on("click", ".remove", function () {
                        $(this).parents(".showhide").remove();
                    });

                });
                // $('#image_preview').hide();

                //   $("#uploadFile").change(function(){

                //      $('#image_preview').html("");

                //      var total_file=document.getElementByName("gym_images").files.length;
                // console.log(total_file);
                //      for(var i=0;i<total_file;i++)

                //      {

                //       $('#image_preview').append("<img height='50' src='"+URL.createObjectURL(event.target.files[i])+"'>");
                //       $('#image_preview').show();

                //      }

                //   });
            </script>



@endsection
