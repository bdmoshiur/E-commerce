<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    public function payment()
    {
        return $this->belongsTo(Payment::class,"payment_id","id");
    }
    public function shipping()
    {
        return $this->belongsTo(Shipping::class,"shipping_id","id");
    }
    public function order_details()
    {
        return $this->hasMany(OrderDetail::class,"order_id","id");
    }
}
