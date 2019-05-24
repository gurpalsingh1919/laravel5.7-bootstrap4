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
                <b>{{__('Add Product')}}</b>
                 <div class="float-right"> <a href="{{ route('getAllProducts') }}" class="btn btn-primary">Product List</a></div>
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
                <form method="POST" action="{{ route('addProductByAdminPost') }}" enctype="multipart/form-data">
                   
                  @csrf
                   
                  <div class="form-row">
                     <div class="col-md-6 mb-4">
                      <label for="validationCustom01"><b>{{ __('Select trainer/seller or Gym') }}</b></label>
                       <select class="form-control" name="seller">
                         @foreach($Sellers as $seller)
                         <option value="{{$seller->id}}" <?php if($seller->id==old('seller')){echo "selected";}  ?>>{{$seller->gym_name}}
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
                           <input class="form-control{{ $errors->has('admin_comission') ? ' is-invalid' : '' }}" type="text" name="admin_comission" value="{{ old('admin_comission') }}" autofocus>
                            @if ($errors->has('admin_comission'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('admin_comission') }}</strong>
                            </span>
                            @endif
                    </div>
                    <div class="col-md-6 mb-4">
                      <label for="validationCustom01"><b>{{ __('Name') }}</b></label>
                      <input type="text" class="form-control" id="validationCustom01"  placeholder="Product Name" name="product_name" value="{{ old('product_name') }}"  autocomplete="off">
                      @if ($errors->has('product_name'))
                        <span class="invalid-feedback">
                          <strong>{{ $errors->first('product_name') }}</strong>
                        </span>
                      @endif
                    </div>
                    <div class="col-md-6 mb-4">
                      <label for="validationCustom02"><b> {{ __('Enter Package Description') }}</b></label>
                      <textarea class="form-control" placeholder="Enter Package Description" name="product_description" rows="4"> {{ old('product_description') }}</textarea>
                      @if ($errors->has('product_description'))
                        <span class="invalid-feedback">
                          <strong>{{ $errors->first('product_description') }}</strong>
                        </span>
                      @endif
                    </div>
                    
                        <?php 
                         $sizes=PackagetoPrice::product_sizes();

                         $colors=PackagetoPrice::product_colors();

                          ?>                
                    <!-- <div class="col-md-12"></div> -->
                    <div class="col-md-6 mb-4">
                      <label><b>Product Sizes</b></label><br/>
                     <select class="form-control" id="productsizes" name="product_size[]"  multiple="multiple" >
                        @foreach($sizes as $keye=>$size)
                          <option value="{{$keye}}" 
                           
                             >{{$size}}
                          </option>
                        @endforeach
                        </select> 
                      
                    </div>
                    <div class="col-md-6 mb-4 ">
                      <label><b>Product Colors</b></label><br/>
                      <select class="form-control" id="productcolors" name="product_color[]" multiple="multiple">
                      	 @foreach($colors as $key=>$color)
                      	 		<option value="{{$key}}" 
                            
                             >{{$color}}
                          </option>
                      	 @endforeach
                                                
                      </select>
                    </div>
                    <div class="col-md-6 mb-4">
                      <label><b>Product Category</b></label><br/>
                      <select class="form-control" name="product_category">
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
                    <div class="col-md-6 mb-4">
                      <label><b>Price (After discout)</b></label>
                      <input class="form-control" name="product_price" type="number" value="{{old('product_price')}}">
                        @if ($errors->has('product_price'))
                          <span class="invalid-feedback">
                            <strong>{{ $errors->first('product_price') }}</strong>
                          </span>
                        @endif
                    </div>
                    <div class="col-md-6 mb-4">
                      <label><b>Discount (%)</b></label>
                      <input class="form-control" name="discount" type="number" value="{{old('discount')}}">
                        @if ($errors->has('discount'))
                          <span class="invalid-feedback">
                            <strong>{{ $errors->first('discount') }}</strong>
                          </span>
                        @endif
                    </div>
                    <div class="col-md-6 mb-4">
                      <label><b>Weight</b></label>
                      <input class="form-control" name="weight" type="text" value="{{old('weight')}}">
                        @if ($errors->has('weight'))
                          <span class="invalid-feedback">
                            <strong>{{ $errors->first('weight') }}</strong>
                          </span>
                        @endif
                    </div>
                    <div class="col-md-6 mb-4">
                      <label><b>Product Images</b></label><br/>
                     
                      <div class="input-group increment mt-3">
                        <input name="product_images[]" type="file" class="form-control form-control-sm inputfile inputfile-2 d-none" id="file-28">
                        <label for="file-28"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Product Images&hellip;</span></label> 
                       
                    </div>
                     <button class="btn btn-secondary add_more btn-sm mt-3" type="button">Add More</button>
                      @if ($errors->has('product_images'))
                      <span class="invalid-feedback">
                          <strong>{{ $errors->first('product_images') }}</strong>
                      </span>
                      @endif
                    </div>
                  </div>
                  <button class="btn btn-primary" type="submit">Submit</button>
                </form>
              </div>
          </div>
        </div>
      </div>
    </div>
     @include('admins.footer')
  </div>
</div>
<script type="text/javascript">
   $(document).ready(function() {
  $('#productsizes').multiselect({
                includeSelectAllOption: true
            });
    
   $('#productcolors').multiselect({
                includeSelectAllOption: true
            });
    });

    $(".add_more").click(function(){ 
          //var html = $(".clone").html();
          var html =' <div class="col-xs-12 mt-3"> <div class="showhide row"><div class="col-md-8"> '+
                      '<input type="file" name="product_images[]" + class="form-control "></div>'+
                        '<div class="col-md-3"> <button class="btn btn-danger remove" type="button">Remove</button>'+
                            '</div></div></div>';
          $(".increment").append(html);
      });

      $("body").on("click",".remove",function(){ 
          $(this).parents(".showhide").remove();
      });

   
</script>

@endsection
