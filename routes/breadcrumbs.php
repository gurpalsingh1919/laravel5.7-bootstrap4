<?php

 Breadcrumbs::for('home', function ($trail) {
     $trail->push('Home', route('welcome'));
});

Breadcrumbs::for('location', function ($trail,$city,$cat_id) {
    $trail->parent('home');
    $trail->push($city, route('gymsNearYou',['location'=>$city,'cat_id'=>$cat_id]));
});


Breadcrumbs::for('gym', function ($trail,$gymdetail,$gym_id) {
    $trail->parent('location',$gymdetail->city,$gymdetail->category_id);
    $trail->push($gymdetail->gym_name, route('gymdetail',['id'=>$gym_id]));
});

Breadcrumbs::for('package', function ($trail,$packagedetail) {
    $trail->parent('gym',$packagedetail->gymDetail,$packagedetail->gymDetail->id);
    $trail->push($packagedetail->title, route('packdetailetail',['id'=>$packagedetail->id]));
});