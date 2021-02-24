@component('mail::message')
# Hi Admin

New Order received

@component('mail::panel')
<h5>Customer Name</h5>
<span>
    {{$order->name}}
</span>

<h5>Customer Email</h5>
<span>
    {{$order->email}}
</span>

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
