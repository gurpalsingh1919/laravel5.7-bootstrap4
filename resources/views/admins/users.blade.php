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
                <div class="card-header"><b>{{__('Users')}}</b>
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

                   <table id="admins-table" class="display responsive nowrap" width="100%">
                                <thead>
                                <th>Sr.</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>E-mail</th>
                                <th>Contact No</th>
                                <th>Status</th>
                                </thead>
                                <tbody>
                                @foreach($users as $index=>$user)
                                <tr>
                                    <td> {{$index+1}}</td>
                                     <td><img src="{{asset('images/user/'.$user->image)}}" height="50" width="50" /></td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->phone_no}}</td>
                                    
                                    <td>
                                    @if($user->status==1)
                                      <i class="fa fa-check"></i>&nbsp;Verified
                                    @else
                                    <i class="fa fa-circle-o-notch"></i>&nbsp;Unverified
                                    @endif
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
