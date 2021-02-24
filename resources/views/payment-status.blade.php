@extends('layouts.app')

@section('content')
<div class="container">
    <div class="my-5">
        <div class="row justify-content-center">

            <div class="col-sm-6">
                @if ($payment->status == 'completed')
                    <div class="col-sm-12 alert alert-success">Payment Success.</div>
                @else
                    <div class="col-sm-12 alert alert-danger">Payment Failed. <a href="{{route('order.summary', $payment->metadata['order_no'])}}">Try again</a>.</div>
                @endif
            </div>
              <!-- /.col-->

        </div>
    </div>
</div>
  <!-- /.col-->
@endsection