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
            <h3 class="mb-4">Nutritions</h3>
            <br/>
            <table class="table table-hover  small">
              <thead>
              <tr >
                <!-- <th scope="col">Gym/Trainer Name</th> -->
                <th scope="col">Duration</th>
                <th scope="col">Nutrition/Workout</th>
                <th scope="col">Week day</th>
              </tr>
              </thead>
              <tbody >
                @foreach($myNutritions as $myNutrition)
                <?php $start_date= strtotime($startDate=$myNutrition->start_date);
                $end_date= strtotime($startDate=$myNutrition->end_date);
                $mainntriton=json_decode($myNutrition->nutritions);
                $week_days=json_decode($myNutrition->week_days);

                 ?>
                <tr>
                    <!-- <td>{{$myNutrition->sellerDetail->gym_name}}</td> -->
                    <td><small><b>{{date("F jS, Y",$start_date)}}</b> To <b>{{date("F jS, Y",$end_date)}}</b></small></td>
                    <td>
                      @foreach($mainntriton as $key=>$nutr)
                        <small><b>{{$key}} :</b>{{$nutr}}</small><br/>
                      @endforeach
                    </td>
                    <td>
                      @foreach($week_days as $weekday)
                        <small>{{$weekday}}</small><br/>
                      @endforeach
                    </td>
                    
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-------------------- Workout -------------------->
          <div class="card-body">
            <h3 class="mb-4">Workouts</h3>
            <br/>
            <table class="table table-hover  small">
              <thead>
              <tr >
                <!-- <th scope="col">Gym/Trainer Name</th> -->
                <th scope="col">Duration</th>
                <th scope="col">Workout</th>
                <th scope="col">Week day</th>
                <th scope="col">Description</th>
                <th scope="col">Video</th>
              </tr>
              </thead>
              <tbody >
                @foreach($myWorkouts as $myWorkout)
                <?php $start_date= strtotime($startDate=$myWorkout->start_date);
                $end_date= strtotime($startDate=$myWorkout->end_date);
                $workouts=json_decode($myWorkout->workouts);
                $week_days=json_decode($myWorkout->week_days);

                 ?>
                <tr>
                    <!-- <td>{{$myNutrition->sellerDetail->gym_name}}</td> -->
                    <td><small><b>{{date("F jS, Y",$start_date)}}</b> To <b>{{date("F jS, Y",$end_date)}}</b></small></td>
                    <td>
                      @foreach($workouts as $key=>$val)
                      <b>{{$key}} ::</b>
                        @foreach($val as $valk=>$values)
                          {{$valk}}  {{$values}} ,
                        @endforeach
                       <br/>
                    @endforeach
                    </td>
                    <td>
                      @foreach($week_days as $weekday)
                        <small>{{$weekday}}</small><br/>
                      @endforeach
                    </td>
                    <td>{{$myWorkout->description }}</td>
                    <td>{{$myWorkout->video_link}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@include('users.footer')
@endsection('content')

