<?php

namespace App\Models;

use App\Models\TransportMode;
use App\Models\ShippingCountry;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    
    protected $guarded =[];

    public function transportMode(){
        return $this->belongsTo(TransportMode::class, 'transport_mode_id');
    }

    public function getTotalCostAttribute()
    {
        return $this->tax + $this->shipping_cost;
    }

}
