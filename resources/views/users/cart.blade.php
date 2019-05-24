  <?php $total = 0; $items=session('cart');
$settings=session('settings');
//echo "<pre>";print_r($items);die;
   ?>
      @if( session('cart') && count(session('cart')) > 0)
      <div class="col-md-3">
      	<div class="card-body">

           @foreach(session('cart') as $index=>$item)   
              <?php $total += $item['price'] * $item['quantity'] ?>
              @if ($item == reset($items))
          			<div class="media">
                   @if($item['seller_type']=='2')
          			  <img src="{{asset('images/user/'.$item['user_image'])}}" alt="{{$item['gym_name']}}" class="mr-3" style="width:60px;">
                  @else
                     <img src="{{asset('gyms/'.$item['gym_image'])}}" alt="{{$item['gym_name']}}" class="mr-3" style="width:60px;">
                  @endif

          			  <div class="media-body">
          				<h4>{{$item['gym_name']}}</h4>
          				<p>{{$item['gym_address']}}</p>
          			  </div>
          			</div>
      			   @endif
      			<div class="cartvalue"> 
              <legend  class="w-auto pl-2 pr-2 mt-2 mb-0 small badge-primary">Starting from {{$item['start_from']}}</legend>
      				<div class="cartoption border-bottom">
      					<div class="l_cart">
      						<div class="deleteitem remove-from-cart" data-id="{{ $item['pack_id'] }}">
      							<a href="#"><i class="fas fa-times-circle"></i></a>
      						</div>
      						<div class="cartitem"><b>{{$item['name']}}</b><br/> {{$item['membership']}}</div>
      						
      					</div>
      					<div class="r_cart">
      						<div class="r_cart_inner">
      							<!-- <div class="option_no">
      							<input type="number" value="1" class="form-control">
      							</div> -->
                    <?php //$t_price=$item['price'] * $item['quantity']; ?>
      							<div class="option_price">{{$item['quantity']." X "}} {{'₹ '.number_format((float)$item['price'], 2, '.', '')}}</div>
      						</div>
      					</div>
      				</div>
      			
      			</div>
      			@endforeach
      			<!-- <div class="border coupon-block">
      			<a href="" class="d-block p-3"><i class="fas fa-percentage"></i> Apply Coupon</a>
      			</div> -->
      	<br>
      			   <!-- <br> -->
      		<!-- 	<div class="items_price justify-content-between d-flex  pb-2">
      				<div class="item_total">Item Total</div>
      				<div class="item_total"><b>{{number_format((float)$total, 2, '.', '')}} INR</b></div>
      			</div> -->
      			<!-- <div class="items_price justify-content-between d-flex">
      				<div class="item_total">GST({{$settings['tax_percentage']}}%)</div>
      				<div class="item_total"><b> <?php $tax=$total*$settings['tax_percentage']/100; ?>{{number_format((float)$tax, 2, '.', '')}} INR</b></div>
      			</div> -->
           <!--  <div class="items_price justify-content-between d-flex">
              <div class="item_total">Maintenace Charges({{$settings['maintenance_charges']}})</div>
              <div class="item_total"><b>{{number_format((float)$settings['maintenance_charges'], 2, '.', '')}} INR</b></div>
            </div> -->
            <!-- <div class="items_price justify-content-between d-flex border-bottom pb-3 mb-3">
              <div class="item_total">Service Charges({{$settings['services_charges']}})</div>
              <div class="item_total"><b>{{number_format((float)$settings['services_charges'], 2, '.', '')}} INR</b></div>
            </div> -->
      			<div class="justify-content-between d-flex pb-3 mb-4">
      				<div class="item_total"><b>Total</b></div>
              <?php //$alltotal=$item['price'] * $item['quantity']; ?>
      				<div class="item_total"><b>{{'₹ '.number_format((float)$total, 2, '.', '')}}</b></div>
      			</div>
            <a href="{{route('checkout')}}">
      			<button class="btn-primary btn text-uppercase btn-block">Checkout</button></a>

      	</div>
      </div>
      @else
       <div class="col-md-3">
        <div class="card-body pt-5 pb-5 text-center"> 
          <h4 class="mb-4 text-uppercase">Cart Items</h4>
          <img src="{{ asset('/fontend/images/emptycart.png') }}">
          <br/><br/>

        </div>
    </div>
      @endif