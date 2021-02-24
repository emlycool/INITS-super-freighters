<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['metadata', 'status', 'amount', 'order_id', 'reference'];

    protected $casts = ['metadata' => 'array'];


    public function order(){
        return $this->belongsTo(Order::class, 'order_id');
    }
}
