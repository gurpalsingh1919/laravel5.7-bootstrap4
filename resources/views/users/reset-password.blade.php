@extends('layouts.users-app')

@section('content')
    <!-- $id = Auth::user()->id; -->
    <div class="container mt-5">
        <div class="row">
             @include('users.left-sidebar')
           
            <div class="col-md-9">
                <div class="col-md-12">
                @if(session('error')) 
              <div class="error alert alert-danger alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Error : </strong>   {{ session('error') }}
              </div>
               <script type="text/javascript">
                Swal({
                    type: 'info',
                    title: "Sorry!!!",
                    text: "{{ session('error') }}",
                    //footer: '<a href>Why do I have this issue?</a>'
                  })
              </script>
              @endif
              @if(session('success')) 
              <div class="error alert alert-success alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              {!! session('success') !!}

              </div>
               <script type="text/javascript">

                Swal(
                  'Good job!',
                  "{{ session('success') }}",
                  'success'
                )
              </script>
              @endif

                </div> 
                <div class="card">
                    <div class="card-body">
                        <h3 class="mb-4">Reset Password</h3>
                        <br/>
                             <form action="{{route('updateAuthUserPassword')}}" class="user-signup" method="post" >
                     @csrf
                  <div class="form-group">
                    <label for="current">Current Password:</label>
                    <input type="password" name="current" placeholder="Enter Your Current Password" class="form-control col-md-8" >
                     @if ($errors->has('current'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('current') }}</strong>
                        </span>
                      @endif
                  </div>
                  <div class="form-group">
                    <label for="pwd">New Password:</label>
                    <input type="password" name="password" placeholder="Enter Your New Password" class="form-control col-md-8" >
                     @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                      @endif
                  </div>
                   <div class="form-group">
                    <label for="pwd">Confirm New Password:</label>
                    <input type="password" name="password_confirmation" placeholder="Enter Your Confirm New Password" class="form-control col-md-8" >
                     @if ($errors->has('password_confirmation'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                      @endif
                  </div>
                  <br/>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    @include('users.footer')

@endsection('content')

