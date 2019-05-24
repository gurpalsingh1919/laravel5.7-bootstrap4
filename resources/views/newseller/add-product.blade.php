@extends('layouts.newseller-app')
<!-- <link href="{{ asset('theme/plugins/dropzone/basic.min.css') }}" rel="stylesheet" type="text/css"/> -->

@section('content')
<style>
#myCarousel .list-inline {
white-space: nowrap;
overflow-x: auto;
}

#myCarousel .carousel-indicators {
position: static;
left: initial;
width: initial;
margin-left: initial;
}

#myCarousel .carousel-indicators > li {
width: initial;
height: initial;
text-indent: initial;
}

#myCarousel .carousel-indicators > li.active img {
opacity: 0.7;
}
.astrict-sign
{
    color: #ff3743;
    border-bottom: none !important;
}
</style>
<!--  BEGIN CONTENT PART  -->
<div id="content" class="main-content">
  <div class="container">
    
    <form action="{{route('NewProductPost')}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
    @csrf
    <div class="page-header">
      <div class="page-title">
          <h3><i class="flaticon-gift mr-2"> </i>Add / Manage Product</h3>
      </div>
    </div>
     @if($errors->all())
      @foreach ($errors->all() as $index=>$error)
        @if($index==0)
      <div class="alert alert-danger">One or more fields have an error. Please check and try again.</div>
       @endif
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
    <!--Carousel Wrapper-->
    <div class="row" id="cancel-row">
      <div class="col-xl-12 col-lg-12 col-sm-12   layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
              <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12 ">
                  <div class="border-bottom d-flex justify-content-between">
                    <div><h4> <i class="flaticon-computer-line mr-2"></i>Product Image Upload</h4></div>
                    <div class="pt-3"> <a href="{{ route('getMyProductList') }}" class="btn btn-primary">Product List</a></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="widget-content widget-content-area mb-5">
              <div class="row">
                <label class="col-md-4">Images <span class="astrict-sign">* (jpeg,png,jpg allowed)</span> :</label>
                <div class="col-md-12 text-center ">
                  <div class="add-manage-product-1">
                    <div class="product-img">
                        <img src="{{url('theme/assets/img/640x435.jpg')}}" alt="img">
                    </div>
                    <div class="d-flex thumbs-img mt-4 justify-content-center">
                      <div class="thumbnail d-flex justify-content-center">

                      </div>
                      <br/>
                      <div  class="field file-input position-relative">
                        <i class="flaticon-circle-plus"></i>
                        <input type="file" id="files" name="product_images[]" multiple="multiple" />
                      </div>
                    </div>
                  </div>
                    @if ($errors->has('product_images.*'))
                      <span class="invalid-feedback">
                        <strong>{{ $errors->first('product_images.*') }}</strong>
                      </span>
                    @endif
                    @if ($errors->has('product_images'))
                      <span class="invalid-feedback">
                        <strong>{{ $errors->first('product_images') }}</strong>
                      </span>
                    @endif
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="widget-header">
                    <h4 class="border-bottom mb-3">GENERAL</h4>
                </div>
                <div class="widget-content widget-content-area">
                  <div class="form-group mb-4">
                    <div class="row">
                      <label class="col-md-4">Name <span class="astrict-sign">*</span> :</label>
                      <div class="col-md-8">
                          <input class="form-control" name="product_name" value="{{old('product_name')}}" type="text" autocomplete="off">
                          @if ($errors->has('product_name'))
                            <span class="invalid-feedback">
                              <strong>{{ $errors->first('product_name') }}</strong>
                            </span>
                          @endif
                      </div>
                    </div>
                  </div>
                    <div class="form-group mb-4">
                      <div class="row">
                        <label class="col-md-4">Description <span class="astrict-sign">*</span>:</label>
                        <div class="col-md-8">
                          <textarea rows="3" cols="5" name="product_description" class="form-control" autocomplete="off">{{old('product_description')}}</textarea>
                          @if ($errors->has('product_description'))
                            <span class="invalid-feedback">
                              <strong>{{ $errors->first('product_description') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>
                    </div>
                            
                    <div class="form-group mb-4">
                      <div class="row">
                        <label class="col-md-4">Product Category <span class="astrict-sign">*</span> :</label>
                        <div class="col-md-8">
                          <select class="form-control form-custom mb-3" name="product_category">
                            <option disabled>Select a Category</option>
                            @foreach($productCategory as $category)
                            <option value="{{$category->id}}" @if($category->id==old('product_category')){{'Selected'}}@endif >{{$category->title}}</option>
                            @endforeach
                           
                          </select>
                          @if ($errors->has('product_category'))
                            <span class="invalid-feedback">
                              <strong>{{ $errors->first('product_category') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="form-group mb-4">
                      <div class="row">
                          <label class="col-md-12"><span>Variations</span></label>
                      </div>
                    </div>
                    <?php $colors=PackagetoPrice::product_colors(); 
                          $sizes=PackagetoPrice::product_sizes(); ?>
                    <div class="form-group mb-4">
                      <div class="row">
                        <label class="col-md-4">Color <span class="astrict-sign">*</span> :</label>
                        <div class="col-md-8">
                          <select class="selectpicker col-md-8" multiple data-actions-box="true" title="Select Product colors" name="product_color[]">
                           @foreach($colors as $key=>$val)
                            <option value="{{$key}}" @if($key==old('product_color')){{'Selected'}}@endif>{{$val}}</option>
                           @endforeach
                          </select>
                          @if ($errors->has('product_color'))
                            <span class="invalid-feedback">
                              <strong>{{ $errors->first('product_color') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="form-group mb-4">
                      <div class="row">
                        <label class="col-md-4">Size <span class="astrict-sign">*</span>  :</label>
                        <div class="col-md-8">
                          <select  class="selectpicker" multiple data-actions-box="true" name="product_size[]" title="Select Product Sizes">
                            @foreach($sizes as $keys=>$vals)
                            <option value="{{$keys}}" @if($keys==old('product_size')){{'Selected'}}@endif>{{$vals}}</option>
                           @endforeach
                          </select>
                          @if ($errors->has('product_size'))
                            <span class="invalid-feedback">
                              <strong>{{ $errors->first('product_size') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>
                    </div>
                    
                    
                    
                    </div>
                </div>
                <div class="col-md-6">
                  <div class="widget-header">
                      <h4 class="border-bottom mb-3">PRICING</h4>
                  </div>
                  <div class="widget-content widget-content-area">
                    <div class="form-group mb-4">
                      <div class="row">
                          <label class="col-md-5">Price (After discout) <span class="astrict-sign">*</span>:</label>
                          <div class="col-md-7">
                              <input class="form-control" name="product_price" type="number" value="{{old('product_price')}}">
                              @if ($errors->has('product_price'))
                            <span class="invalid-feedback">
                              <strong>{{ $errors->first('product_price') }}</strong>
                            </span>
                          @endif
                          </div>
                      </div>
                    </div>
                    <div class="form-group mb-4">
                      <div class="row">
                          <label class="col-md-5">Discount (%) :</label>
                          <div class="col-md-7">
                              <input class="form-control" name="discount" type="number" value="{{old('discount')}}">
                              @if ($errors->has('discount'))
                            <span class="invalid-feedback">
                              <strong>{{ $errors->first('discount') }}</strong>
                            </span>
                          @endif
                          </div>
                      </div>
                    </div>
                    <div class="form-group mb-4">
                      <div class="row">
                        <label class="col-md-5">Weight :</label>
                        <div class="col-md-7">
                            <input class="form-control" name="weight" type="text" value="{{old('weight')}}">
                            @if ($errors->has('weight'))
                            <span class="invalid-feedback">
                              <strong>{{ $errors->first('weight') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="form-group mb-4">
                      <div class="row">
                          <label class="col-md-12"><span>INVENTORY</span></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <label class="col-md-4">QTY <span class="astrict-sign">*</span> :</label>
                        <div class="col-md-8">
                            <input class="form-control" name="available_quantity" type="number" value="{{old('available_quantity')}}">
                            @if ($errors->has('available_quantity'))
                            <span class="invalid-feedback">
                              <strong>{{ $errors->first('available_quantity') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="form-group mb-4">
                      <div class="row">
                        <label class="col-md-4">Status <span class="astrict-sign">*</span> :</label>
                        <div class="col-md-8">
                          <select class="form-control form-custom" name="status">
                            <option value="1" @if(old('status')=='1'){{'Selected'}}@endif>In Stock</option>
                              <option value="2"  @if(old('status')=='2'){{'Selected'}}@endif>Out of Stock</option>
                          </select>
                          @if ($errors->has('status'))
                            <span class="invalid-feedback">
                              <strong>{{ $errors->first('status') }}</strong>
                            </span>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <button class="btn btn-primary col-md-4 mt-2 ml-6" type="submit" style="margin-left: 24rem!important;">Submit</button>
        </div>
      </div>
    </div>
   
  </form>

  </div>
  
   
</div>
{{--https://stackoverflow.com/questions/37205438/image-upload-with-preview-and-delete-option-javascript-jquery--}}
<script>
$(document).ready(function () {

$(document).ready(function() {



    if (window.File && window.FileList && window.FileReader) {
        $("#files").on("change", function(e) {
            var files = e.target.files,
                filesLength = files.length;
                $(".thumbnail").html('');
            for (var i = 0; i < filesLength; i++) {
                var f = files[i]
                var fileReader = new FileReader();
                fileReader.onload = (function(e) {
                    var file = e.target;
                   
                    
                    // $("<span class=\"pip\">" +
                    //     "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                    //     "<br/><small class=\"remove\">remove</small>" +
                    //     "</span>").appendTo(".thumbnail");
                    $("<span class=\"pip\">" +
                         "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                         "<br/>" +
                        "</span>").appendTo(".thumbnail");
                    $(".product-img img").attr('src', file.result);
                    $(".remove").click(function(){
                        $(this).parent(".pip").remove();
                        $(".product-img img").attr('src', "{{url('theme/assets/img/640x435.jpg')}}");
                        //console.log($(this).parent(".pip img").attr("src").val());
                    });
                    $('.pip img').click(function () {
                        var imgsrc = $(this).attr('src');

                        $(".product-img img").attr('src', imgsrc);
                    })


                    // Old code here
                    /*$("<img></img>", {
                      class: "imageThumb",
                      src: e.target.result,
                      title: file.name + " | Click to remove"
                    }).insertAfter("#files").click(function(){$(this).remove();});*/

                });
                fileReader.readAsDataURL(f);
            }
        });
    } else {
        alert("Your browser doesn't support to File API")
    }
});

})
</script>
<!-- <style>
        .special {font-weight: bold !important;color: #fff !important;background: #e7515a !important;text-transform: uppercase;}
        .bootstrap-select.btn-group .dropdown-menu a.dropdown-item span.dropdown-item-inner { color: #171820; }
        .dropdown-item:active { background-color: #f1f3f9; }
        .dropdown-menu.select-dropdown .dropdown-item:focus, .dropdown-menu.select-dropdown .dropdown-item:hover { background-color: #e6e3fe; }
        .dropdown-item.active { background-color: #f1f3f0; }
        .row [class*="col-"] .widget .widget-header h4 { color: #6156ce; }
        .btn-group.bootstrap-select.dropup:focus { outline: none; }
    </style> -->
<!-- END PAGE LEVEL PLUGINS -->
@endsection