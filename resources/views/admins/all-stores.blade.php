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
                <div class="card-header"><b>{{$title}}</b>
                 
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
                    <th>Seller/trainer name</th>
                    <th>Business name</th>
                    <th>Business URL</th>
                    <th>Business type</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Action</th>
                  </thead>
                <tbody>
                  @foreach($allStores as $store)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$store->gym_name}}</td>
                    <td>{{$store->business_name}}</td>
                    <td>{{$store->business_url}}</td>
                    <td>
                      @if($store->business_type==1)
                        <span class="badge badge-info badge-pills">Professional</span>
                      @elseif($store->business_type==2)
                        <span class="badge badge-info badge-pills">Business</span>
                      @endif
                    </td>
                    <td>{{$store->business_category}} </td>
                    @if($store->store_status==1)
                      <td> <span class="badge badge-info badge-pills">Approved</span></td>
                     @else
                      <td> <span class="badge badge-warning badge-pills">Pending</span></td>
                     @endif
                     <td class="text-center">
                       
                        <div class="dropdown">
                          <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{url('admin/store/'.$store->id)}}">View</a>
                            <!-- <a class="dropdown-item" href="{{url('admin/package/edit/'.$store->id)}}">Edit</a> -->
                           
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
