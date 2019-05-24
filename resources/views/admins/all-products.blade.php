@extends('layouts.admin-app')

@section('content')
 <div class="container-fluid page-body-wrapper">
     @include('admins.sidebar')
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <form method="get" action="">
          <div class="row">

                <!-- <div class="row"> -->
             <div class="form-group col-md-4">
                    <label class="label">{{ __('Select a Gym') }}</label>
                    <div class="input-group">
                       
                       <select name="seller" class="form-control" >
                        <option value="0">All</option>
                        @foreach($Sellers as $Seller)
                         <option value="{{$Seller->id}}" 
                          {{app('request')->input('seller') ==$Seller->id?'selected':''}}>{{$Seller->gym_name}}</option>
                         @endforeach
                       </select>
                      
                    </div>
                  </div>
                  <!-- <div class="form-group col-md-4">
                    <label class="label">{{ __('Select a Category') }}</label>
                    <div class="input-group">
                       
                       <select name="category" class="form-control">
                        <option value="0">All</option>
                        @foreach($gymPackageType as $category)
                         <option value="{{$category->id}}" {{app('request')->input('category') ==$category->id?'selected':''}}>{{$category->name}}</option>
                         @endforeach
                       </select>
                      
                    </div>
                  </div> -->
                  <div class="form-group col-md-4"><br/>
                    <button type="submit" class="btn btn-primary" >Submit</button>
                  </div>
                  <!-- </div> -->
                </form>

            <div class="col-sm-12 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-header"><b>{{$title}}</b>
                 <!--  <div class="float-right"> <a href="{{ route('AddPackageByAdmin') }}" class="btn btn-primary">Add Product</a>
                  </div> -->
                  <br/><br/>
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
              <div class="card-body">
                <table id="admins-table" class="table table-striped table-bordered table-hover" width="100%" >
                  <thead>
                    <th>Sr.</th>
                    <!-- <th>Image</th> -->
                    <th>Seller/Trainer Name</th>
                    <th >Name</th>
                    <th >Description</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th style="width: 15%">Action</th>
                  </thead>
                  <tbody>
                    @foreach($allproducts as $product)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$product->gymDetail->gym_name}}</td>
                      <td>{{$product->name}} </td>
                      <td>{{$product->description}} </td>
                      <td>{{$product->productCategories->title}} </td>
                      <td>{{number_format((float)$product->price, 2, '.', '')}}</td>
                     
                      <td>
                        @if($product->status==1)
                           <span class="badge badge-info badge-pills">Approved</span>
                        @elseif($product->status==0)
                          <span class="badge badge-secondary badge-pills">Pending</span>
                        @elseif($product->status==2)
                          <span class="badge badge-primary badge-pills">Out of Stock</span>
                        @else
                          <span class="badge badge-warning badge-pills">Inactive</span>
                        @endif
                     <td class="text-center">
                        <div class="dropdown">
                          <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{url('admin/product/'.$product->id)}}">View</a>
                            <a class="dropdown-item" href="{{url('admin/product/edit/'.$product->id)}}">Edit</a>
                          </div>
                        </div>
                    </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
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
