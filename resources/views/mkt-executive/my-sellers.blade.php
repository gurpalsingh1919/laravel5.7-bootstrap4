@extends('layouts.mktexecutive-app')

@section('content') 
<!--  BEGIN CONTENT PART  -->
<div id="content" class="main-content">
  <div class="container">
    <div class="page-header">
      <div class="page-title">
        <h3><i class="flaticon-controller mr-2"></i>{{$title}}</h3>
      </div>
    </div>
    <div class="row" id="cancel-row">
      <div class="col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
          <div class="widget-header">
            <div class="row">
              <div class="col-xl-12 col-md-12 col-sm-12 col-12 ">
                <div class="border-bottom d-flex justify-content-between">
                  <div><h4> <i class="flaticon-controller mr-2"></i>Seller's List</h4></div>
                  <div class="pt-3"> <a href="{{ route('createNewSeller') }}" class="btn btn-primary">Register new seller or gym</a></div>
                </div>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-3"></div>
                <div class="col-md-9">
               <form method="get" action="">
                  <select name="city"  class="selectpicker mb-4 ml-2" data-style="btn btn-outline-primary">
                      
                      <option value="0">Select a city</option>
                      <option value="0">All</option>
                      @foreach($cities as $city)
                       <option value="{{$city->name}}" 
                        {{app('request')->input('city') ==$city->name?'selected':''}}>{{$city->name}}</option>
                       @endforeach
                  </select>
                  
                  <select name="category" class="selectpicker mb-4 ml-2" data-style="btn btn-outline-info">
                      <option value="0">Select a category</option>
                      <option value="0">All</option>
                      @foreach($gymCategory as $category)
                       <option value="{{$category->id}}" {{app('request')->input('category') ==$category->id?'selected':''}}>{{$category->name}}</option>
                       @endforeach
                  </select>

                  <button type="submit" class="btn btn-primary mb-4 ml-2" data-style="btn btn-outline-success">
                     Submit
                  </button>

               </form></div>
               <!-- <div class="col-md-2"></div> -->
            </div>
          </div>
          <div class="widget-content widget-content-area text-center">
            <div class="table-responsive mb-4">
                 @if($errors->all())
                  @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">{{$error}}</div>
                   
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
          <table id="html5-extension" class="table table-striped table-bordered table-hover" style="width:100%">
            <thead><tr>
              <th>Sr.</th>
              <th>Seller Name</th>
              <th>Gym Name</th>
              <th>E-mail</th>
              <th>City</th>
              <th>Contact No</th>
              <th>Status</th>
              <th>Action</th>
              </tr>
            </thead>
            <tbody>
            @if(count($mysellers)>0) 
              @foreach($mysellers as $index=>$seller)         <?php 
                  $sellercategories=$seller->category_id;
                  $cat_arr=explode("|", $sellercategories);    ?>
                @if(in_array($cat_id, $cat_arr) || $cat_id =='0')
                  <tr>
                    <td> {{$index+1}}</td>
                    <td>{{$seller->user['name']}}</td>
                    <td>{{$seller->gym_name}}</td>
                    <td>{{$seller->user['email']}}</td>
                    <td>{{$seller->city}}</td>
                    <td>{{$seller->user['phone_no']}}</td>
                     <td>
                    @if($seller->status==1)
                    <span class="badge badge-info badge-pills">Approved</span>
                    @else 
                    <span class="badge badge-warning badge-pills">Pending</span>
                    @endif
                    </td>
                    <td class="text-center">
                      <ul class="table-controls">
                         <!--  <li><a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="" data-original-title="Settings"><i class="flaticon-settings-4  bg-primary p-1 text-white br-6 mb-1"></i></a> </li> -->
                          <li><a href="{{url('sales-executive/edit/'.$seller->id)}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit or view"><i class="flaticon-edit  bg-success p-1 text-white br-6 mb-1"></i></a></li>
                          <li><a href="javascript:void(0);" onclick="deleteSeller({{$seller->id}})" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="flaticon-delete  bg-danger p-1 text-white br-6 mb-1"></i></a></li>
                      </ul>
                    </td>
                  </tr>
                @endif
              @endforeach 
            @else
              <tr><td colspan="8">No data available in table</td></tr>
            @endif           
            </tbody>
            </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--  END CONTENT PART  -->
<script type="text/javascript">
function deleteSeller(seller_id)
  {
      Swal.fire({
      title: 'Are you sure?',
      text: "If you delete this seller then package associated with this seller also will be deleted.",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Delete it!'
    }).then((result) => {
      console.log(result)
      if (result.value) {
         $.ajax({
          url: "{{route('deleteSeller')}}",
          type: "POST",
          data: { sellerid:seller_id,_token:"{{ csrf_token() }}" }, 
          success: function(res)
          { console.log(res);
            console.log(res.status);
            if(res.status=='success')
            {
                Swal.fire(
                'success!',
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