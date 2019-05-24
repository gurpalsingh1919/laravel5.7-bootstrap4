@extends('layouts.newseller-app')

@section('content') 
<!--  BEGIN CONTENT PART  -->
<div id="content" class="main-content">
  <div class="container">
    <div class="page-header">
      <div class="page-title">
          <h3><i class="flaticon-leaf mr-1"></i> My Store</h3>
       </div>
    </div>
    <div class="row layout-spacing" id="cancel-row">
      <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="statbox widget box box-shadow">
          <div class="widget-header">
              <div class="row">
                  <div class="col-xl-12 col-md-12 col-sm-12 col-12 ">
                      <div class="border-bottom d-flex justify-content-between">
                          <div><h4> <i class="flaticon-computer-line mr-2"></i>Product List</h4></div>
                          <div class="pt-3"> <a href="{{ route('addProduct') }}" class="btn btn-primary">Add Product</a></div>
                      </div>
                  </div>
              </div>
          </div>
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
          <div class="widget-content widget-content-area">
            <div class="table-responsive mb-4">
              <table id="html5-extension" class="table table-striped table-hover table-bordered" style="width:100%">
                <thead>
                  <tr>
                      <th>ID</th>
                      <th>Image</th>
                      <th>Name</th>
                      <th>Category</th>
                      <th>Price</th>
                      <th>Quantity</th>
                      <th class="align-center">Status</th>
                      <th class="align-center">Action</th>
                  </tr>
              </thead>
              <tbody>
                @foreach($gymProduct as $product)
                <?php $images=json_decode($product->images) ?>
                  <tr>
                      <td>000{{$product->id}}</td>
                      <td class="text-center">
                      <a class="product-list-img" href="javascript: void(0);">
                        <img src="{{asset('product/'.$images[0])}}" alt="product"></a></td>
                      <td>{{$product->name}}</td>
                      <td>{{$product->category}}</td>
                      <td>{{$product->price}}</td>
                      <td>{{$product->quantity}}</td>
                      <td class="text-center"> 
                        @if($product->status=='0')
                         <span class="badge badge-info">Approval Pending</span>
                        @elseif($product->status=='1')
                         <span class="badge badge-success">Approved</span>
                        @elseif($product->status=='2')
                          <span class="badge badge-warning">Out of Stock</span>
                        @elseif($product->status=='3')
                          <span class="badge badge-warning">Deleted</span>
                        @endif
                      </td>
                      <td class="align-center">
                        <ul class="table-controls">
                          <li>
                              <a href="{{route('updateProduct',$product->id)}}" data-toggle="tooltip" data-placement="top" title="Edit">
                                  <i class="flaticon-edit"></i>
                              </a>
                          </li>
                          <li>
                            <a href="javascript:void(0);" data-toggle="tooltip" title="Delete" onclick="deletemyproduct({{$product->id}})"  data-placement="top" >
                            <i class="flaticon-delete-5"></i>
                            </a>
                          </li>
                        </ul>
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
  </div>
</div>


<!-- END PAGE LEVEL SCRIPTS -->
<script type="text/javascript">
  function deletemyproduct(id)
  {
      Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      console.log(result)
      if (result.value) {
         $.ajax({
          url: "{{route('deleteMyProduct')}}",
          type: "POST",
          data: {product_id: id,_token: "{{ csrf_token() }}"}, 
          success: function(res)
          { //console.log(res);
            //console.log(res.status);
            if(res.status=='success')
            {
                Swal.fire(
                'Deleted!',
                res.message,
                'success'
              )
              location.reload(true);
            }
            else
            {
                 Swal.fire(
                'Error!',
                res.message,
                'error'
              )
            }
          }});
        }
      })
  }
</script>
     
@endsection

