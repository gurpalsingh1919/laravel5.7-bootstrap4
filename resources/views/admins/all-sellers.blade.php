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
                    <label class="label">{{ __('Select a City') }}</label>
                    <div class="input-group">
                       
                       <select name="city" class="form-control" >
                        <option value="0">All</option>
                        @foreach($cities as $city)
                         <option value="{{$city->name}}" 
                          {{app('request')->input('city') ==$city->name?'selected':''}}>{{$city->name}}</option>
                         @endforeach
                       </select>
                      
                    </div>
                  </div>
                  <div class="form-group col-md-4">
                    <label class="label">{{ __('Select a Category') }}</label>
                    <div class="input-group">
                       
                       <select name="category" class="form-control">
                        <option value="0">All</option>
                        @foreach($gymCategory as $category)
                         <option value="{{$category->id}}" {{app('request')->input('category') ==$category->id?'selected':''}}>{{$category->name}}</option>
                         @endforeach
                       </select>
                      
                    </div>
                  </div>
                  <div class="form-group col-md-4"><br/>
                    <button type="submit" class="btn btn-primary" >Submit</button>
                  </div>
                  <!-- </div> -->
                </form>
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
                                <th>Seller Name</th>
                                <th>Gym Name</th>
                                <th>E-mail</th>
                               
                                <!-- <th>Address</th> -->
                                <th>City</th>
                                <th>Status</th>
                                <th>Action</th>
                                 <th>Contact No</th>
                                </thead>
                                <tbody>
                                @foreach($sellers as $index=>$seller)
                                <?php $sellercategories=$seller->category_id;
                                  $cat_arr=explode("|", $sellercategories);
                                 ?>
                                  @if(in_array($cat_id, $cat_arr) || $cat_id =='0')
                                <tr>
                                    <td> {{$index+1}}</td>
                                    <td>{{$seller->user['name']}}</td>
                                    <td>{{$seller->gym_name}}</td>
                                    <td>{{$seller->user['email']}}</td>
                                  
                                    <!-- <td>{{$seller->gym_address .','.$seller->zip}}</td> -->
                                     <td>{{$seller->city}}</td>
                                    <td>
                                     @if($seller->status==1)
                                      <span class="badge badge-success">Approved</span>
                                    @else
                                    <span class="badge badge-warning">Pending</span>
                                    @endif

                                    </td>
                                   <td><!-- <a href="{{url('admin/seller/'.$seller->id)}}" target="_blank">Detail</a> -->
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          Action
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                          <a class="dropdown-item" target="_blank" href="{{url('admin/seller/'.$seller->id)}}">View</a>
                                          <a class="dropdown-item" target="_blank" 
                                          href="{{url('admin/seller/edit/'.$seller->id)}}">Edit</a>
                                         
                                        </div>
                                      </div>
                                   </td>
                                     <td>{{$seller->user['phone_no']}}</td>
                                </tr>
                                @endif
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
