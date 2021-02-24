<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Events\NewOrderCompleted;
use Illuminate\Support\Facades\Redirect;
use Unicodeveloper\Paystack\Facades\Paystack;

class PaymentController extends Controller
{
    public function __construct(){

    }

    public function initialize(Order $order, Request $request){
        $request->request->add([
            'reference' => Paystack::genTranxRef(),
            'amount' => (int) round($order->total_cost) * 100,
            'email' => $order->email,           
            'metadata' => [
                'order_no' => $order->order_no,
                'order_id' => $order->id,
                'name' => $order->customer_name,
                'shipping_cost' => (int) round($order->shipping_cost) * 100,
                'tax' => (int) round($order->tax) * 100,
                'item_weight' => $order->item_weight,
                'order_description' => $order->description,
                'order_no' => $order->order_no,
                'custom_fields' => [
                    [
                        "display_name" => "Order N0",
                        "variable_name" => "Order NO",
                        "value" => $order->order_no
                    ]
                ],
            ]
        ]);

        try{
            return Paystack::getAuthorizationUrl()->redirectNow();
        }catch(\Exception $e) {
            session()->flash('msg', 'Token expired. Please refresh the page and try again.');
            return Redirect::back();
        }        
        
    }


    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        $order_id = $paymentDetails['data']['metadata']['order_id'];
        $status = $paymentDetails['data']['status'];
        $payment = Payment::create(
        [
            'reference' => $paymentDetails['data']['reference'],
            'status' => $status == "success" ? 'completed': 'failed',
            'amount' => $paymentDetails['data']['amount'],
            'metadata' => $paymentDetails['data']['metadata'],
            'order_id' => $order_id
        ]);
        if($status == 'success'){
            $order = Order::find($order_id);
            $order->order_status = "completed";
            $order->fulfilment_status = "processing";
            $order->save();

            event(new NewOrderCompleted($order));
        }

        return redirect(route('payment.status', $payment->id));
    }

    public function paymentStatus(Payment $payment){
        return view('payment-status', ['payment' => $payment]);
    }

}
