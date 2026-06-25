<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model {
    protected $fillable = ['user_id', 'store_id', 'check_in_time', 'check_out_time', 'selfie_image', 'display_image'];

    public function store() { 
        return $this->belongsTo(Store::class); 
    }
    
    public function stockReports() { 
        return $this->hasMany(StockReport::class); 
    }
}