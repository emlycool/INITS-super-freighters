<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingCostAggregator extends Model
{
    use HasFactory;

    public function mode(){
        $this->belongsTo(TransportMode::class, 'transport_mode_id');
    }
}
