@extends('layouts.app')

@section('content')
<main class="c-main">
    <div class="container-fluid">
      <div class="fade-in">
        <div class="row">
          <div class="col-sm-6">
            <div class="card">
              <div class="card-header">Pricing</div>
              <div class="card-body">
                <div class="row">
					<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis eveniet voluptates ex asperiores aspernatur, ipsum reprehenderit beatae voluptate esse voluptas libero non nam laudantium deserunt cum, est adipisci nulla animi.</p>
                </div>
                
              </div>
            </div>
          </div>
          <!-- /.col-->
          <div class="col-sm-6">
            <div class="card">
              <div class="card-header"><strong>Ship to Nigeria</strong></div>
              <div class="card-body">
				@if ($errors->any())
					<div class="alert alert-danger my-4">
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif
               <form action="{{route('order.store')}}" method="POST">
					@csrf
					<div class="form-group">
						<label for="name">Customer Name</label>
						<input class="form-control" id="name" name="name" type="text" placeholder="Enter your name" value="{{old('name')}}">
					</div>
					<div class="form-group">
						<label for="email">Email Address</label>
						<input class="form-control" id="email" name="email" type="text" placeholder="Enter email address" value="{{old('email')}}">
					</div>
					<div class="form-group">
						<label for="address">Address</label>
						<input class="form-control" name="address" id="address" type="text" placeholder="Enter your street address" value="{{old('address')}}">
					</div>
					<div class="form-group">
						<label for="transport-mode">Transportation Mode</label>
						<select name="transport_mode" class="form-control">
							@foreach ($transportModes as $mode)
								<option value="{{$mode->id}}" {{ old('transport_mode') == $mode->id? 'selected' : null }}>{{ucFirst($mode->name)}}</option>
							@endforeach
						</select>
					</div>
					
					<div class="row">
						<div class="form-group col-sm-8">
							<label for="shipping-country">From country</label>
							<select name="shipping_country" id="shipping-country" class="form-control">
								<option value="">Select country</option>
								@foreach ($countries as $country)
									<option value="{{$country->country_code}}" {{ old('transport_mode') == $mode->id? 'selected' : null }}>{{ucFirst($country->country)}}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group col-sm-4">
							<label for="postal-code">Item Weight in Kg</label>
							<input class="form-control" name="item_weight" id="postal-code" type="number" placeholder="" value="{{old('item_weight')}}" step=".1">
						</div>
					</div>

					<div class="form-group">
						<label for="item-description">Item Description</label>
						<textarea class="form-control" id="item-description"name="item_description" rows="2">{{old('item_weight')}}</textarea>
					</div>

					<div class="form-group">
						<button class="btn btn-primary mr-3">Make Order</button>
					</div>

				</form>

              </div>
            </div>
          </div>
          <!-- /.col-->
        </div>
        <!-- /.row-->

      </div>
    </div>
</main>
@endsection