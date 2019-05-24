@extends('layouts.users-app')

@section('content')
    <!-- content start here -->
    <div class="container pt-5">
        <div class="row equal outer" >
            <div class="col-md-6 text-center pt-4 align-self-center">
                <div class="gym-icon"> <i class="fas fa-dumbbell"></i></div>
                <br/>
                <h3 class="mb-4">Not A Member Yet?</h3>
                <p>If you appreciate quality, then we are for you. Join now and start enjoying the exclusive benefits and privileges of Near Gym.</p>

                <br/>
                <h5 class="text-uppercase">Not Register Yet!</h5>
                <p class="text-center"> <a class="btn btn-primary" href="{{route('signup')}}">Register Now</a></p>

                <br/>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <h3 class="text-uppercase mb-3">Forgot Password</h3>
                            <p>Enter your email id to reset your password</p>
                        </div>

                        <form method="post" class="user-signup" action="" enctype="multipart/form-data">
                            @csrf
                            <div class="d-flex justify-content-center">
                                <div class="col-lg-10 col-md-8">

                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control" placeholder="Email">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Send</button>


                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
    @include('users.footer')

@endsection('content')
