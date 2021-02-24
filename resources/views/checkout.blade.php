@extends('layouts.app')

@section('content')
@if ($order->order_status != "completed")
<div class="container">
    <div class="my-5">
        <div class="row justify-content-between">
            @if (session()->has('msg'))
            <div class="alert alert-danger my-4 col-sm-12">
                {{session()->get('msg')}}
            </div>
			@endif
            <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header"><strong>Shipping Order Information</strong></div>
                        <div class="card-body">
                            <div class="my-2">
                                <p><strong>Order No:</strong> {{$order->order_no}} </p>
                            </div>
                            <div class="my-2">
                                <p><strong>Customer Name:</strong> {{$order->customer_name}}</p>
                            </div>
                            <div class="my-2">
                                <p><strong>Address:</strong> {{$order->address}}</p>
                            </div>
                            <div class="my-2">
                                <p><strong>Email:</strong> {{$order->email}}</p>
                            </div>
    
                            <div class="my-2">
                                <p><strong>Country Shipping From:</strong> {{$order->shipping_country}}</p>
                            </div>
    
                            <div class="my-2">
                                <p><strong>Transport Mode:</strong> {{Ucfirst($order->transportMode->name)}}</p>
                            </div>
                            
                            <div class="my-2">
                                <p><strong>Item Weight (Kg):</strong> {{$order->item_weight}}</p>
                            </div>
    
                            <div class="my-2">
                                <p><strong>Item Description:</strong> {{$order->item_description}}</p>
                            </div>
                        </div>
                    </div>
              </div>
              <!-- /.col-->
            <div class="col-sm-5 col-md-4">
                <div class="card">
                    <div class="card-header"><strong>Shipping Order Cost Summary</strong></div>
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <span class="col-sm-6 border-bottom py-2">Shipping Cost:</span>
                            <span class="col-sm-6 border-bottom py-2">&#8358; {{number_format($order->shipping_cost)}}</span>
                        </div>
                        <div class="d-flex">
                            <span class="col-sm-6 border-bottom py-2">Tax:</span>
                            <span class="col-sm-6 border-bottom py-2">&#8358;{{number_format($order->tax)}}</span>
                        </div>
                        <div class="d-flex">
                            <span class="col-sm-6 border-bottom py-2">Total:</span>
                            <span class="col-sm-6 border-bottom py-2">&#8358;{{number_format($order->total_cost)}}</span>
                        </div>
                        <div class="d-flex">
                            <span class="col-sm-6 border-bottom py-2">estimated delivery date:</span>
                            <span class="col-sm-6 border-bottom py-2">{{$order->transportMode->shippingEstimatedDate}}</span>
                        </div>
                        <div class="row my-3 px-4">
                            <form action="{{route('payment.initialize', $order->id)}}" method="POST" class="w-100">
                                @csrf
                                <button class="mx-auto btn btn-primary w-100">Pay</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@else 
<div class="container">
    <div class="my-5">
        <div class="alert alert-success">Order payment already completed</div>
    </div>
</div>  
@endif
  <!-- /.col-->
@endsection