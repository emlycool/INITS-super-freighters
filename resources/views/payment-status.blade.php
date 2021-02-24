@extends('layouts.app')

@section('content')
<div class="container">
    <div class="my-5">
        <div class="row justify-content-center">

            <div class="col-sm-9">
                @if ($payment->status == 'completed')
                    <div class="col-sm-12 alert alert-success">Payment Success.</div>
                    <div class="mx-auto">
                        <h4>Transaction Ref {{$payment->reference}}</h4>
                        <h6>Amount: &#8358;{{number_format($payment->amount/100)}}</h6>
                    </div>
                @else
                    <div class="col-sm-12 alert alert-danger">Payment Failed. <a href="{{route('order.summary', $payment->metadata['order_no'])}}">Try again</a>.</div>
                    <div class="mx-auto">
                        <h4>Transaction Ref {{$payment->reference}}</h4>
                        <h6>Amount: &#8358;{{number_format($payment->amount/100)}}</h6>
                    </div>

                @endif
            </div>
              <!-- /.col-->

        </div>
    </div>
</div>
  <!-- /.col-->
@endsection