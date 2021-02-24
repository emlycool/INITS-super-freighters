<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\TransportMode;
use App\Models\ShippingCountry;

class OrderController extends Controller
{
    public function __construct()
    {
        
    }

    public function create(){
        $transportModes = TransportMode::all();
        $countries = ShippingCountry::all();
        return view('order-create', compact('transportModes', 'countries'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|string|max:255',
            'address' => 'required|string|max:255',
            'transport_mode' => 'required',
            'shipping_country' => 'required',
            'item_weight' => 'required|numeric|min:1',
            'item_description' => 'nullable|string|max:255'
        ]);

        ['tax' => $tax, 'shippingCost' => $shippingCost] = $this->calculateShipping($request->all());

        $order = Order::create([
            'order_no' => $this->generateOrderNo(),
            'order_status' => 'pending',
            'fulfilment_status' => 'prending',
            'customer_name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'shipping_cost' => $shippingCost,
            'tax' => $tax,
            'transport_mode_id' => $request->transport_mode,
            'item_description' => $request->item_description,
            'shipping_country' => $request->shipping_country,
            'item_weight' => $request->item_weight,
        ]);

        return redirect(route('order.summary', $order->order_no));
    }

    public function orderSummary($orderNo){
        $order = Order::where('order_no', $orderNo)->firstOrFail();
        return view('checkout', compact('order'));
    }

    protected function calculateShipping($data){
        $data = (object) $data;
        $shippingCost = 0;
        // transport mode
        $transportMode = TransportMode::find($data->transport_mode);
        abort_if(is_null($transportMode), 404, "transport not found");

        $shippingCountry = ShippingCountry::where('country_code', $data->shipping_country)->first();
        abort_if(is_null($shippingCountry), 404, "county not found");
        

        $shippingCostAggregator = $transportMode->costAggregator;

        $shippingCost += $shippingCostAggregator->base_cost;
        
        $shippingCost += $shippingCostAggregator->cost_per_kg * round($data->item_weight);

        $shippingCost += $shippingCountry->flat_rate;
        
        $tax = $shippingCost * config('system.tax_rate');

        return compact('shippingCost', 'tax');
        
    }

    private function generateOrderNo(){

        $totalOrders = Order::count();

        $nextOrderNo = str_pad($totalOrders+1,10,"0", STR_PAD_LEFT) ;
        return $nextOrderNo;
    }
}
