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
                  <div class="float-right"> <a href="{{ route('AddPackageByAdmin') }}" class="btn btn-primary">Add Package</a></div><br/><br/>
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
                  <th>Title</th>
                  <th>Memberships</th>
                  <th>Description</th>
                  <th>Status</th>
                  <th>Action</th>
                </thead>
                <tbody>
                  @foreach($gymPackages as $package)
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td style="width: 10%">{{$package->title}}</td>
                    
                    <td style="width: 30%">
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
                    <td style="width: 20%">{{$package->description}} </td>
                    @if($package->status==1)
                      <td> <span class="badge badge-info badge-pills">Approved</span></td>
                     @else
                      <td> <span class="badge badge-warning badge-pills">Pending</span></td>
                     @endif
                     <td class="text-center">
                        <!-- <ul class="table-controls">
                          <li><a href="{{url('admin/package/'.$package->id)}}" target="_blank">
                            <i class="close menu-icon mdi mdi-account-edit"></i> </a></li><br/>
                          <li><a href="{{url('admin/package/edit/'.$package->id)}}" target="_blank">
                            <span class="badge badge-warning badge-pills">Edit</span></a>
                          </li>
                           
                        </ul> -->
                        <div class="dropdown">
                          <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{url('admin/package/'.$package->id)}}">View</a>
                            <a class="dropdown-item" href="{{url('admin/package/edit/'.$package->id)}}">Edit</a>
                           
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
