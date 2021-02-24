<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\ShippingDuration;
use App\Models\ShippingCostAggregator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransportMode extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function costAggregator(){
        return $this->hasOne(ShippingCostAggregator::class, 'transport_mode_id');
    }

    public function duration(){
        return $this->hasOne(ShippingDuration::class, 'transport_mode_id');
    }

    public function getshippingEstimatedDateAttribute(){
        $now = Carbon::now();
        if(is_null($this->duration)) return;
        return $now->addDays($this->duration->period)->format('l j M, Y');
    }
}
