@extends('layouts.mktexecutive-app')

@section('content') 
<!--  BEGIN CONTENT PART  -->
<div id="content" class="main-content">
  <div class="container">
    <div class="page-header">
        <div class="page-title">
            <h3><i class="flaticon-package mr-2"></i>{{__('Package Management')}}</h3>
        </div>
    </div>
    <div class="row" id="cancel-row">
      <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="statbox widget box box-shadow">
          <div class="widget-header">
            <div class="row">
              <div class="col-xl-12 col-md-12 col-sm-12 col-12 ">
                <div class="border-bottom d-flex justify-content-between">
                  <div><h4> <i class="flaticon-package mr-2"></i>Package List</h4></div>
                  <div class="pt-3"> <a href="{{ route('salesExePackagesAdd') }}" class="btn btn-primary">Add New Package</a></div>
                </div>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md-2"></div>
                <div class="col-md-8">
               <form method="get" action="">
                <label class="mb-2 mt-0">Sellect a Seller or Gym</label>
                  <select name="seller"  class="selectpicker mb-2 ml-2" data-style="btn btn-outline-primary">
                      <option value="0">All</option>
                      @foreach($sellers as $seller)
                       <option value="{{$seller->id}}" 
                        {{app('request')->input('seller') ==$seller->name?'selected':''}}>{{$seller->gym_name}}</option>
                       @endforeach
                  </select>
                  
                 

                  <button type="submit" class="btn btn-primary mb-4 ml-2" data-style="btn btn-outline-success">
                     Submit
                  </button>

               </form></div>
               <div class="col-md-2"></div>
            </div>
          </div>
          <div class="widget-content widget-content-area">
            <div class="table-responsive mb-4">
              @if($errors->all())
                  @foreach ($errors->all() as $index=>$error)
                     
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
                <thead>
                  <th>Sr.</th>
                  <th>Seller</th>
                  <th>Title</th>
                  <th style="width: 30%">Description</th>
                  <th>Memberships</th>
                  <th>Status</th>
                  <th>Action</th>
                </thead>
                <tbody>
                @if(count($gymPackage)>0) 
                  @foreach($gymPackage as $package)
                  <tr>
                    
                    <td>{{$loop->iteration}}</td>
                    <td>{{$package->gymDetail->gym_name}}</td>
                    <td>{{$package->title}}</td>
                    <td>{{$package->description}} </td>
                    <td>
                      <div class="table-responsive">
                      <table id="membershiplisting" class="table table-bordered table-striped mb-4">
                        <tbody>
                        @if($package->packageMemberships)
                          @foreach($package->packageMemberships as $membership)
                            <tr><?php $time=explode('-', $membership->duration);$mstime='';
                                if($time[1]=="M"){$mstime="Months";}
                                if($time[1]=="W"){$mstime="Weeks";}
                                if($time[1]=="D"){$mstime="Days";}
                                if($time[1]=="Y"){$mstime="Year";}
                               
                             ?>
                              <th>{{$time[0].' '.$mstime}}</th>
                              <td>{{$membership->price}}</td>
                            </tr>

                          @endforeach
                        @endif
                        </tbody>
                      </table>
                      </div>
                    </td>
                    @if($package->status==1)
                      <td> <span class="badge badge-info badge-pills">Approved</span></td>
                     @else
                      <td> <span class="badge badge-warning badge-pills">Pending</span></td>
                     @endif
                     <td class="text-center">
                        <ul class="table-controls">
                           <!--  <li><a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="" data-original-title="Settings"><i class="flaticon-settings-4  bg-primary p-1 text-white br-6 mb-1"></i></a> </li> -->
                            <li><a href="{{route('salesExe-package.edit',$package->id)}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="flaticon-edit  bg-success p-1 text-white br-6 mb-1"></i></a></li>
                            <li><a href="javascript:void(0);" onclick="deletepacakge({{$package->id}})" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="flaticon-delete  bg-danger p-1 text-white br-6 mb-1"></i></a></li>
                        </ul>
                    </td>
                   
                  </tr>

                  @endforeach 
                @else
                  <tr><td colspan="7" class="align-center">No data available in table</td></tr>
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
//$(document).ready(function()
//{
  function deletepacakge(pack_id)
  {
      Swal.fire({
      title: 'Are you sure?',
      text: "You want to delete this package",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Delete it!'
    }).then((result) => {
      //console.log(result)
      if (result.value) {
         $.ajax({
          url: "{{route('DeletePackage')}}",
          type: "POST",
          data: { package_id:pack_id,_token:"{{ csrf_token() }}" }, 
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
      
  
//})
</script> 
@endsection