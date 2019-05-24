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
                <div class="card-header"><b>{{$gymPackage->title}}</b>
                   <div class="float-right">
                      <a href="{{ route('getAllPackages') }}" class="btn btn-primary editseller">Package List</a>
                    </div>
                 

                    <div class="float-right mr-4">
                      <a href="{{url('admin/package/edit/'.$gymPackage->id)}}" class="btn btn-warning editseller"><i class="menu-icon mdi mdi-account-edit"></i>Edit</a>
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
                <p>{{$gymPackage->description}}</p>
                  <br/>
                  <div class="row">
                    <div class="col-md-6">
                      <table class="table table-bordered">
                         <tr>
                          <th>Gym Name:</th>
                          <td>{{$gymPackage->gymDetail->gym_name}}</td>
                      </tr>
                      <tr>
                          <th>Package Name:</th>
                          <td>{{$gymPackage->title}}</td>
                      </tr>
                      <tr>
                          <th>Memberships:</th>
                          <td><div class="table-responsive">
                      <table id="membershiplisting" class="table table-bordered table-striped mb-4">
                        <tbody>
                        @if($gymPackage->packageMemberships)
                          @foreach($gymPackage->packageMemberships as $membership)
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
                      </div></td>
                      </tr>
                      
                     <tr>
                          <th>Status:</th>
                          <td> @if($gymPackage->status==1)
                                  <span class="badge badge-success">Approved</span>
                              @else
                                  <span class="badge badge-warning">Pending</span>
                              @endif</td>
                      </tr>

                      </table>
                      
                    </div>
                    <div class="col-md-6">
                      <table class="table table-bordered">                      
                       
                      <tr>
                        <td colspan="2" id="neargym_image1" class="thumbnail-image">
                          <strong  class="d-block">Image</strong>     <br/>
                          <img style="border-radius: 0; height:200px;width:200px;" class="img-fluid imageThumb"  src="{{asset('package/'.$gymPackage->image)}}">
                        </td>
                      </tr>
                      <tr>
                        
                         <th>Refund Policy:</th>
                        <td> {{$gymPackage->refund}}</td>
                      </tr>
                      <tr>
                        
                         <th>Cancellation Policy:</th>
                         <?php $cancellation=PackagetoPrice::cancellation_policy($gymPackage->cancellation); 
                         ?>
                        <td>{{$cancellation}} </td>
                      </tr>

                  </table>
                    </div>
                  </div> 
                  


                      <hr/>
                    <!--  @if($gymPackage->status !=1)
                    <input type="button"class="btn btn-primary status"  value="Approve" />
                    @else
                    <input type="button"class="btn btn-warning status" value="Dispprove" />
                    @endif -->

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
