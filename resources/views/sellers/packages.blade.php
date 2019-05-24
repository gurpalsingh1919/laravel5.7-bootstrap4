@extends('layouts.sellers-app')

@section('content')
 <div class="container-fluid page-body-wrapper">
     @include('sellers.sidebar')
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
         <form method="get" action="">
          <div class="row">
            
                  <div class="form-group col-md-4">
                    <label class="label">{{ __('Select a Category') }}</label>
                    <div class="input-group">
                       
                       <select name="category" class="form-control">
                        <option value="0">All</option>
                        @foreach($gymPackageType as $category)
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

            <div class="col-sm-12">
              <div class="card">
                <div class="card-body">
                <h4>{{__('Packages')}}</h4>
                <hr/>
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

                
              

                   <table id="users-table" class="display responsive nowrap" width="100%">
                                <thead>
                                <th>Sr.</th>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Option</th>
                                <th>Description</th>
                                <th>Timing</th>
                               
                               
                                
                                </thead>
                                <tbody>
                                @foreach($packages as $package)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$package->title}}</td>
                                    <td>{{$package->price}} </td>

                                    @if($package->status==1)
                                           <td> <span class="badge badge-success">Approved</span></td>
                                     @else
                                           <td> <span class="badge badge-warning">Pending</span></td>
                                     @endif
                                     <td>
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          Action
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                          <a class="dropdown-item" href="{{route('package.edit',$package->id)}}">Edit</a>
                                         
                                        </div>
                                      </div>
                                    </td>
                                    <td>{{$package->description}} </td>
                                    <td>{{$package->timing}} </td>
                                    
                                    
                                   <!--  <td class="d-flex">
                                        <a class="dropdown-item" href="{{route('package.edit',$package->id)}}"><i class="fas fa-ban"></i> Edit</a> -->
                                        <!-- <a class="dropdown-item" href="{{url('delete-package').'/'.$package->id}}"><i class="fas fa-ban"></i> Delete</a> -->
                                        
                                    <!-- </td> -->
                                  
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
        @include('sellers.footer')
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
 <script>

        $(function() {
          $('#users-table').DataTable({
              responsive: true,
             dom: 'Bfrtip',
              buttons: [
                  'copy', 'csv', 'excel', 'pdf', 'print'
              ],
              columnDefs: [
            { width: 30, targets:2 }
        ],
        fixedColumns: true
            });
});

        </script>
@endsection
