@extends('layouts.admin-app')

@section('content')
 <div class="container-fluid page-body-wrapper">
     @include('admins.sidebar')
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
         
          <div class="row">
            <div class="col-sm-12">
              <div class="card">
                <div class="card-header"><b>{{$gymProduct->name}}</b>
                   <div class="float-right">
                      <a href="{{ route('getAllProducts') }}" class="btn btn-primary editseller">Product List</a>
                    </div>
                 

                    <div class="float-right mr-4">
                      <a href="{{url('admin/product/edit/'.$gymProduct->id)}}" class="btn btn-warning editseller"><i class="menu-icon mdi mdi-account-edit"></i>Edit</a>
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
                <b>About:</b><br/>
                <p>{{$gymProduct->description}}</p>
                  <br/>
                  <div class="row">
                    <div class="col-md-6">
                      <table class="table table-bordered">
                         <tr>
                          <th>Gym Name:</th>
                          <td>{{$gymProduct->gymDetail->gym_name}}</td>
                      </tr>
                      <tr>
                          <th>Product Name:</th>
                          <td>{{$gymProduct->name}}</td>
                      </tr>
                      <tr>
                          <th>Product Price:</th>
                          <td>{{$gymProduct->price}}</td>
                      </tr>
                      <tr>
                        
                         <th>Size:</th>
                         <?php $productsize= json_decode($gymProduct->size, TRUE);
                         $sizes=PackagetoPrice::product_sizes(); ?>
                        <td>
                          @foreach($sizes as $key=>$val)
                            @if(in_array($key, $productsize))
                              @if($loop->last)
                                {{$val}}
                              @else
                                {{$val. ' ,'}}
                              @endif
                            @endif
                          @endforeach
                        </td>
                      </tr>
                      
                     <tr>
                          <th>Status:</th>
                          <td> @if($gymProduct->status==1)
                           <span class="badge badge-info badge-pills">Approved</span>
                        @elseif($gymProduct->status==0)
                          <span class="badge badge-secondary badge-pills">Pending</span>
                        @elseif($gymProduct->status==2)
                          <span class="badge badge-primary badge-pills">Out of Stock</span>
                        @else
                          <span class="badge badge-warning badge-pills">Inactive</span>
                        @endif</td>
                      </tr>

                      </table>
                      
                    </div>
                    <div class="col-md-6">
                      <table class="table table-bordered">                      
                       
                      <tr><?php $productImages= json_decode($gymProduct->images, TRUE);
                         ?>
                        <td colspan="2" id="neargym_image1" class="thumbnail-image">
                          <strong  class="d-block">Image</strong>     <br/>
                          @foreach($productImages as $image)
                          <img style="border-radius: 0; height:60px;width:60px;" class="img-fluid imageThumb"  src="{{asset('product/'.$image)}}">
                          @endforeach
                        </td>
                      </tr>
                      <tr>
                        
                         <th>Product Category:</th>
                        <td> {{$gymProduct->productCategories->title}}</td>
                      </tr>
                      <tr>
                        
                         <th>Color:</th>
                         <?php $productcolor= json_decode($gymProduct->colors, TRUE);
                         $colors=PackagetoPrice::product_colors(); //echo "<pre>";print_r($colors);die; ?>
                        <td>
                          @foreach($colors as $key=>$val)
                            @if(in_array($key, $productcolor))
                              @if($loop->last)
                                {{$val}}
                              @else
                                {{$val. ' ,'}}
                              @endif
                            @endif
                          @endforeach
                        </td>
                      </tr>

                  </table>
                    </div>
                  </div> 
                  


                      <hr/>
                   

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
     
@endsection
