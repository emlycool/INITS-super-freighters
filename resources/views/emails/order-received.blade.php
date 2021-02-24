@component('mail::message')
# Dear {{$order->name}},

We are pleased to inform you that we have received the payment of &#8358;{{number_format($order->total_cost) }} for the order {{$order->order_no}}



@component('mail::panel')
<h5>Shipping Address</h5>
<address>
    {{$order->address}}
</address>
<h5>Item Weight</h5>
{{$order->item_weight}}

<h5>Country to be shipped from</h5>
{{$order->shipping_country}}

<h5>Item estimated arrival</h5>
{{$order->transportMode->shippingEstimatedDate}}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
