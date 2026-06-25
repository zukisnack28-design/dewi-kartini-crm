<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model {
    protected $fillable = ['store_name', 'qr_code_token', 'latitude', 'longitude'];
    
    public function visits() {
        return $this->hasMany(Visit::class);
    }
}