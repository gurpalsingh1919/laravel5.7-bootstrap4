@extends('layouts.users-app')

@section('content')
 <!-- $id = Auth::user()->id; -->
 <?php $user = Auth::user(); ?>
 <div class="container mt-5">
   <div class="row">

       @include('users.left-sidebar')
     <div class="col-md-8">
         <div class="card">
         <div class="card-body">
             <h3 class="mb-4">Profile</h3>
             <br/>
              <!-- <p>Ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p> -->


             <strong class="mb-2 d-block">About</strong>
             <div class="row">
             <div class="col-md-8">

             <div class="mb-2 row">
                 <div class="col-md-6">Name</div>
                 <div class="col-md-6">{{$user->name}}</div>
             </div>
                 <div class="dropdown-divider"></div>
                 <div class="mb-2 row">
                     <div class="col-md-6">Email</div>
                     <div class="col-md-6">{{$user->email}}</div>
                 </div>
                 <div class="dropdown-divider"></div>
                 <div class="mb-2 row">
                     <div class="col-md-6">Phone Number</div>
                     <div class="col-md-6">{{$user->phone_no}}</div>
                 </div>
             </div>
             </div>
         </div>
         </div>

     </div>

   </div>
 </div>
 
       
  @include('users.footer')
 
 @endsection('content')

