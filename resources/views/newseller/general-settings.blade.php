@extends('layouts.newseller-app')
{{--<link href="{{url('/theme/plugins/multi-select/multi-select.css')}}" rel="stylesheet" type="text/css">--}}

<link rel="stylesheet" type="text/css" href="{{url('/theme/plugins/select2/select2.min.css')}}">

@section('content')
<!--  BEGIN CONTENT PART  -->
<div id="content" class="main-content">
<div class="container">
  <div class="page-header">
    <div class="page-title">
      <h3><i class="flaticon-settings-1 mr-2"></i> General Setting</h3>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
      <div class="statbox widget box box-shadow">
        <div class="widget-header">
          <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12 col-12 ">
              <div class="border-bottom d-flex justify-content-between">
                <div><h4><i class="flaticon-settings-1 mr-2"></i>Update your gym detail</h4>
                </div>
              </div>
            </div>
          </div>
          <div class="widget-content widget-content-area">
            <div class="row justify-content-center">
              <div class="col-md-12 col-lg-10 border-right border-left">
                @if($errors->all())
                  @foreach ($errors->all() as $index=>$error)
                   <div class="alert alert-danger">{{$error}}
                    </div>
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
                <form class="needs-validation" name="general-setting" method="post"
                        enctype="multipart/form-data" action="{{ route('gym.update') }}">
                        @method('PATCH')
                  @csrf
                  <div class="form-row">
                    <div class="col-md-6">
                      <div class="col-md-12 mb-4">
                        <label for="validationCustom01"><b>{{ __('Gym Name') }}</b></label>
                        <input class="form-control{{ $errors->has('gym_name') ? ' is-invalid' : '' }}"
                               type="text" name="gym_name"
                               value="{{ $gym_info->gym_name }}"
                               required autofocus>
                        @if ($errors->has('gym_name'))
                            <span class="invalid-feedback">
                          <strong>{{ $errors->first('gym_name') }}</strong>
                          </span>
                        @endif
                      </div>
                       <?php $sellercategories = $gym_info->category_id;
                          $cat_arr = explode("|", $sellercategories);
                          ?>
                      <div class="col-md-12 mb-4">
                        <label class=" col-form-label"><strong>{{ __('Gym Categories (Multi-select)') }}</strong></label></br>
                        <select name="category[]" id="category" class="selectpicker" multiple data-selected-text-format="count">
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
                      
                      <div class="col-md-12 mb-4">
                        <?php $images = explode('|', $gym_info->gym_images); ?>
                        <div class="mb-3">
                            <label class="label"><b>{{ __('Gym Images') }} (*
                                jpeg,png,jpg)</b></label><br/>
                            @foreach($images as $image)
                                <img class="imageThumb" src="{{asset('gyms/'.$image)}}"
                                     height="70">
                            @endforeach
                        </div>
                        <div class="increment mb-3 general-set">
                          <input placeholder="Upload your gym video here."
                                  name="gym_images[]" id="file-8" type="file"
                                  class="form-control-file form-control-file-rounded">
                          
                        </div>
                        <button class="btn btn-secondary add_more btn-sm" type="button">
                            Add More</button>
                        @if ($errors->has('gym_images'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('gym_images') }}</strong>
                            </span>
                        @endif
                      </div>
                    </div>
                      {{--end col 6--}}
                    <div class="col-md-6">
                      <div class="col-md-12 mb-4">
                          <label for="gym_description"
                                 class=" col-form-label text-md-right"><strong>{{ __('About') }}</strong></label>
                          <textarea class="form-control" rows="5" type="text"
                                    name="gym_description"
                                    required autofocus>{{ $gym_info->gym_description }}
                                </textarea>
                          @if ($errors->has('gym_description'))
                              <span class="invalid-feedback">
                          <strong>{{ $errors->first('gym_description') }}</strong>
                          </span>
                          @endif
                      </div>
                      <div class="col-md-12 mb-4">
                        <label class=" col-form-label">
                          <b>{{ __('Video') }} (* mp4,webm,3gp,mov,flv,avi,wmv,ts)</b>
                        </label>
                        <div class="float-right">
                          @if(!empty($gym_info->video_link))
                            <button type="button" class="btn btn-sm btn-primary"
                                    data-toggle="modal"
                                    data-target="#video-play">Play Video
                            </button>
                          @endif
                        </div>
                        </br>
                        <div class="form-group mb-4 mt-3 general-set">
                          <input placeholder="Upload your gym video here."
                                   name="gym_video" id="file-1" type="file"
                                   class="form-control-file form-control-file-rounded" autofocus>
                        </div>
                        @if ($errors->has('gym_video'))
                          <span class="invalid-feedback">
                            <strong>{{ $errors->first('gym_video') }}</strong>
                          </span>
                        @endif
                      </div><?php 
                          $sellerfacilities = $gym_info->facilities;
                          $fac_arr = explode("|", $sellerfacilities);   ?>
                      <div class="col-md-12 mb-4">
                        <label class=" col-form-label"><strong>{{ __('Gym Facilities (Multi-select)') }}</strong></label></br>
                        <select name="facilities[]" id="facility" class="form-control tagging"  multiple="multiple">
                          @foreach($gymFacility as $facility)
                            <option value="{{$facility->name}}" @if(in_array($facility->name, $fac_arr)) {{__('selected')}} @endif>{{$facility->name}}
                            </option>
                          @endforeach
                        </select>
                        @if ($errors->has('facilities'))
                          <span class="invalid-feedback">
                            <strong>{{ $errors->first('facilities') }}</strong>
                          </span>
                        @endif
                      </div>
                    </div>
                        {{--end col 6--}}
                              <?php 
                    $amTimings=PackagetoPrice::am_timing();
                    $pmTimings=PackagetoPrice::pm_timing(); 
                    $week_days=PackagetoPrice::week_days(); 
                    $timings=json_decode($gym_info->timing);
                    //echo $timings->Monday;die;
                     ?>
                    <div class="col-md-12">
                      <label><strong>Gym scheduling</strong></label>
                      <p>Please select your gym opening and closing time.</p>
                      <!-- <div class="row">
                        <div class="col-md-4">
                          <select class="form-control basic" id="gettimings">
                            <option value="1">Custom Hours</option>
                            <option value="2">Any time</option>
                          </select>
                        </div>
                      </div> -->
                      <hr/>
                      <div class="select-outer" id="custom_hours">
                        @foreach($week_days as $week_day)
                        <?php $exactime=array();
                        $tim='';
                        if(isset($timings->$week_day))
                        {
                          $tim=$timings->$week_day;
                          if($tim !="Closed")
                          {
                            $exactime=explode("-", $tim);
                          }
                        }

                              //echo "<pre>";print_r($exactime[0]);die;
                                ?>
                        
                        <div class="row mb-3">
                          <div class="col-md-3">
                              <label>{{$week_day}}</label>
                          </div>
                          @if($tim !='Closed')
                          <div class="col-md-3 timingselect">
                            <select class="form-control" name="gym_timing[{{$week_day}}][start_time]">
                              @foreach($amTimings as $amTiming)
                                <option value="{{$amTiming}}" 
                                @if(isset($exactime[0]) && trim($exactime[0])==$amTiming)
                                  {{__('selected')}}
                                @endif
                                >{{$amTiming}}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="col-md-3 timingselect">
                            <select class="form-control" name="gym_timing[{{$week_day}}][end_time]">
                              @foreach($pmTimings as $pmTiming)
                                <option value="{{$pmTiming}}" 
                                @if(isset($exactime[1]) && trim($exactime[1])==$pmTiming)
                                  {{__('selected')}}
                                @endif
                                >{{$pmTiming}}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="col-md-6 noads" style="display: none;"> 
                            Closed <input type="hidden" name="gym_timing[{{$week_day}}][close]" value="Closed"></div> 
                          
                          <div class="col-md-3">
                              <span class="closetiming flaticon-close-fill"></span>
                          </div>
                          @else
                          <div class="col-md-6 noads"> 
                            Closed <input type="hidden" name="gym_timing[{{$week_day}}][close]" value="Closed"></div> 
                          @endif
                          

                        </div>
                        @endforeach
                        </div>
                      
                    </div>
                  </div>
                  <button class="btn btn-primary" type="submit">Submit form</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
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
{{--<script src="{{url('theme/plugins/multi-select/jquery.multi-select.js')}}"></script>--}}
<script src="{{url('theme/plugins/select2/select2.min.js')}}"></script>
<script src="{{url('theme/plugins/select2/custom-select2.js')}}"></script>
<script src="{{url('/theme/plugins/dropzone/dropzone.min.js')}}"></script>
<script src="{{url('/theme/plugins/dropzone/custom-dropzone.js')}}"></script>
<script src="{{url('theme/plugins/file-upload/file-upload-with-preview.js')}}"></script>


<script type="text/javascript">
    // $('#datetimepicker1').timepicker({ 'timeFormat': 'h:i A' });
    //First upload
    //var firstUpload = new FileUploadWithPreview('myFirstImage')
    //Second upload
    //var secondUpload = new FileUploadWithPreview('mySecondImage')

    $(document).ready(function () {
      //$("#custom_hours").find(".noads").remove();
      
      // $('#gettimings').on('change', function() {
      //   console.log( this.value );
      //   if(this.value=='1')
      //   {  console.log( this.value );
      //     $("#custom_hours").show();
      //     $("#anytime").hide();
      //   }
      //   else if(this.value=='2')
      //   {
      //     $("#custom_hours").hide();
      //     $("#anytime").show();
      //   }
      // });

        $(".tagging").select2({
            tags: true
        });
        $(".basic").select2({
            tags: true
        });
        /*$(".facilities").select2({
            tags: true,
            tokenSeparators: [',', ' ']
        });*/

        $(".closetiming").click(function () {
            $(this).parent().parent().find('.timingselect').remove();
            $(this).parent().parent().find('.noads').show();
            /*$(this).parent().addClass("d-none");*/

        })

        $('select.facilities').on('change', function (e) {
            var valueSelected = this.value;
            if (valueSelected == 2) {
                $(".showinput").show();
            } else {
                $(".select-outer").hide();
            }
        });
        $('select.timingcheck').on('change', function (e) {
            var optionSelected = $("option:selected", this);
            var valueSelected = this.value;
            if (valueSelected == 1) {
                $(".select-outer").show();
            } else {
                $(".select-outer").hide();
            }

        });

//     $('#datetimepicker1').datetimepicker({
//   format: "dddd: HH:mm"
// });
//$('.clockpicker').clockpicker({donetext: 'Done'});
//$('#category').selectpicker();
// $('#facility').selectpicker();
        //$('#my-select').multiSelect();
        $('#video-play').on('hidden.bs.modal', function () {
            $('#yt-player')[0].pause();
        });


        $(".add_more").click(function () {
//var html = $(".clone").html();
            var html = ' <div class="col-xs-12 mt-3"> <div class="showhide row"><div class="col-md-8"> ' +
                ' <input name="gym_images[]" id="file-8" type="file" class="form-control-file form-control-file-rounded">' +
                '</div>' +
                '<div class="col-md-3"> <button class="btn btn-secondary remove" type="button">Remove</button>' +
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
<style type="text/css">
.bootstrap-select.btn-group>.dropdown-toggle 
{
    height: 5% !important;
    width: 441px;
    border-radius: 62px;
}
.bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn) {
     width: 441px; 
}
.general-set input[type=file]{
    border: 1px solid #ccc;
    border-radius: 20px;
    /*border-color: #f1f3f1;*/
}

.general-set input[type=file]:hover {
    background-color: #fff;
    color: #3232b7;
    box-shadow: 0px 5px 20px 0 rgba(0, 0, 0, 0.2);
    will-change: opacity, transform;
    transition: all 0.3s ease-out;
    -webkit-transition: all 0.3s ease-out;
}
</style>

@endsection