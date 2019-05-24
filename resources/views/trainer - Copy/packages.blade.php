@extends('layouts.trainer-app')

@section('content')
 <div class="container-fluid page-body-wrapper">
     @include('trainer.sidebar')
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
         
          <div class="row">
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
                                <th>Description</th>
                                <th>Timing</th>
                                <th>Price</th>
                                <th>Status</th>
                                 <th>Action</th>
                                </thead>
                                <tbody>
                                @foreach($packages as $package)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$package->title}}</td>
                                    <td>{{$package->description}} </td>
                                    <td>{{$package->timing}} </td>
                                    <td>{{$package->price}} </td>
                                    
                                    @if($package->status==1)
                                           <td> <span class="badge badge-success">Approved</span></td>
                                     @else
                                           <td> <span class="badge badge-warning">Pending</span></td>
                                     @endif
                                   <!--  <td class="d-flex">
                                        <a class="dropdown-item" href="{{route('package.edit',$package->id)}}"><i class="fas fa-ban"></i> Edit</a> -->
                                        <!-- <a class="dropdown-item" href="{{url('delete-package').'/'.$package->id}}"><i class="fas fa-ban"></i> Delete</a> -->
                                        
                                    <!-- </td> -->
                                    <td>
                                      <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          Action
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                          <a class="dropdown-item" href="{{route('trainer-package.edit',$package->id)}}">Edit</a>
                                         
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
        @include('trainer.footer')
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
