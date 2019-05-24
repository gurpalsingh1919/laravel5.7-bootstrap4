@extends('layouts.users-app')
@section('content')
<style type="text/css">
  body {
      background: #f6f7f8
  }
</style>
<link href="{{ asset('css/product.css') }}" rel="stylesheet">
<div class="breadcrumb p-0 m-0 pt-2">
  <div class="container">
      <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="http://localhost/gym/public">Home</a></li>
          <li class="breadcrumb-item active">vijayawada</li>
      </ol>
  </div>
</div>
<div class="container-fluid">
  <div class="row ">
      <div class="col-lg-3 product pt-5">
          <form class="">
              <label class="text-uppercase small" for="inlineFormInputName2">Search store</label>
              <input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2"
                     placeholder="Type Search">

              <button type="submit" class="btn btn-sm btn-primary mb-2 "><i class="fas fa-search"></i> Search
              </button>
          </form>
          <br/>
         <!--  <strong>Filter products by:</strong>
          <ul class="small pl-3">
              <li><strong>Stair Climbers</strong></li>
              <li><strong>Group Cycling</strong></li>
          </ul>
          <hr/> -->
          <div class="f-sidebar">
            <a href="#demo" data-toggle="collapse">
              <h4 class="d-flex justify-content-between">
                <span>Stores </span><i class="fas fa-angle-down"></i></h4>
            </a>
            <hr/>
            <div id="demo" class="collapse show">
              <ul class="sidebar-filter">
                <li class="{{$cat_id == '0' ? 'active' : '' }}">
                  <a href="0">
                    <i class="fa fa-align-justify" aria-hidden="true"></i>All
                      <span>{{$total}} Options</span>
                  </a>
                </li>
                @foreach($stores_categories as $key=>$category)
                <li class="{{$cat_id == $category->store_category->id ? 'active' : '' }}">
                  <a href="{{$category->store_category->id}}">
                    @if($category->store_category->id=='1')
                      <i class="fa fa-dumbbell"></i>
                    @elseif($category->store_category->id=='2')
                      <i class="fa fa-child"></i>
                    @elseif($category->store_category->id=='3')
                      <img height="25" src="{{asset('icons/dance.png')}}">
                    @elseif($category->store_category->id=='4')
                      <i class="fa fa-american-sign-language-interpreting" aria-hidden="true"></i>
                    @elseif($category->store_category->id=='5')
                       <img height="25" src="{{asset('icons/yoga.png')}}">
                    @elseif($category->store_category->id=='6')
                      <i class="fa fa-futbol"></i>
                    @elseif($category->store_category->id=='7')
                      <i class="fa fa-universal-access"></i>
                    @elseif($category->store_category->id=='8')
                      <i class="fa fa-weibo"></i>
                    @elseif($category->store_category->id=='9')
                      <i class="fa fa-empire"></i>
                    @endif
                    {{$category->store_category->title}}
                      <span>{{$category->total_stores}} Options</span>
                  </a>
                </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
      <div class="col-lg-9 pt-5">
        <div class="row">
            <div class="col-md-12">
                <h3>{{$title}}</h3>
            </div>
        </div>
        <br>
        <div class="row gymlisting ">
          <?php $flag = 0; ?>
        @foreach($yourlocationStores as $value)
          <div class="col-md-4 mb-4">
            <div class="card">
              <a href="{{ url('/mygym/'.$value['id']) }}" target="_blank">
                <div class="image-container">
                  <?php $gym_imagess = explode('|', $value['gym_images']); ?>
                    @foreach($gym_imagess as $index=>$image)
                      @if($index==0)
                        <img height="250" width="250" class="card-img-top"
                               src="{{ asset('/gyms') }}/{{$image}}"
                               alt="{{$value['gym_name']}}"/>
                      @endif
                    @endforeach
                </div>
              </a>
              <div class="card-body pl-0 pr-0 pt-2 pb-0">
                <strong class="card-title">{{substr($value['gym_name'], 0, 20)}}</strong>
                <p class="card-text small mb-2">{{substr($value['gym_description'], 0, 40)}}</p>
                <div class="d-flex justify-content-between">
                    <small class="badge badge-success mb-2 mr-2">
                        <i class="fas fa-star"></i> 4.1
                    </small>
                    <small class="offers-info" style=""><i class="fas fa-percentage"></i> 20%
                        off on all orders
                    </small>
                </div>
                <hr/>
                @if(count($value['products']) >0)
                  <div class="text-center">
                    <a title="<div class='quickview'> 
                    <div class='row hoverdivs'> 
                      <div class='col-md-4 text-center justify-content-center align-self-center'> 
                        <div class=''> 
                          <strong>{{$value->gym_name}}</strong> <hr/> <small class='text-left'>{{$value->gym_address.' ,'.$value->zip.','.$value->city}}</small> 
                        </div>
                        </div>
                        <div class='col-md-8 pt-3'> 
                        <div class='row'> 
                          @foreach($value->products as $index=>$product)
                            @if ($index <= 3)
                            <?php $images =json_decode($product->images);  ?>
                              <div class='col-md-6'> 
                                <div class=''> 
                                  <div class='image-container'> 
                                    <img height='100' width='80' class='img-fluid' src='{{  asset('/product/'.$images[0]) }}/'/> 
                                  </div>
                                  <div class='card-body pl-0 pr-0 pt-2'> 
                                    <strong>{{$product->title}}</strong> 
                                  </div>
                                </div>
                              </div>
                            @endif
                          @endforeach
                        </div>
                      </div>
                    </div>
                  </div>"
                  href="{{ url('/mygym/'.$value['id']) }}" class=" cus-tooltip small  custom-popup"
                  data-toggle="tooltip" data-html="true">Quick View</a>
                </div>
                @endif
              </div>
            </div>
          </div>
          <?php $flag++ ?>
        @endforeach
      </div>
    </div>
  </div>
</div>


@include('users.footer')

@endsection('content')