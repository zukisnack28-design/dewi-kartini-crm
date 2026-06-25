<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockReport extends Model {
    protected $fillable = ['visit_id', 'product_variant', 'current_stock', 'order_quantity'];

    public function visit() {
        return $this->belongsTo(Visit::class);
    }
}