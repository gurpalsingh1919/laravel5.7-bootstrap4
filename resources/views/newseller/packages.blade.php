@extends('layouts.newseller-app')

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
                  <div class="pt-3"> <a href="{{ route('add-package') }}" class="btn btn-primary">Add New Package</a></div>
                </div>
              </div>
            </div>
          </div>
          <div class="widget-content widget-content-area">
            <div class="table-responsive mb-4">
              <table id="html5-extension" class="table table-striped table-bordered table-hover" style="width:100%">
                <thead>
                  <th>Sr.</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Memberships</th>
                  <th>Status</th>
                  <th>Action</th>
                </thead>
                <tbody>
                  @foreach($packages as $package)
                  <tr>
                    <td>{{$loop->iteration}}</td>
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
                            <li><a href="{{route('package.edit',$package->id)}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="flaticon-edit  bg-success p-1 text-white br-6 mb-1"></i></a></li>
                            <!-- <li><a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="flaticon-delete  bg-danger p-1 text-white br-6 mb-1"></i></a></li> -->
                        </ul>
                    </td>
                   <!--  <td>
                      <div class="btn-group">
                        <button type="button" class="btn btn-primary btn-sm">Action</button>
                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                        <span class="sr-only">Toggle Dropdown</span> 
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuReference1">
                        
                        <a class="dropdown-item" href="{{route('trainer-package.edit',$package->id)}}">Edit</a>
                        </div>
                      </div>
                    </td> -->
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
<!--  END CONTENT PART  -->
@endsection