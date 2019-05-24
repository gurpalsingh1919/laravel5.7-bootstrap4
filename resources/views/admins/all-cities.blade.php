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

                   <table id="admins-table" class="display responsive nowrap" width="100%" >
                                <thead>
                                <th>Sr.</th>
                                <th>Name</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Action</th>
                                </thead>
                                <tbody>
                                @foreach($gymCity as $index=>$city)
                                <tr>
                                    <td> {{$index+1}}</td>
                                    <td>{{$city->name}}</td>
                                    <td>{{$city->lat}}</td>
                                    <td>{{$city->lon}}</td>
                                    <td>
                                       <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          Action
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                          <a class="dropdown-item" href="{{route('city.edit',$city->id)}}">Edit</a>
                                          <a class="dropdown-item" href="{{route('city.delete',$city->id)}}">Delete</a>
                                         
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
