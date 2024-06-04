<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetailAttribute extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function detail()
    {
        return $this->belongsTo(ProductDetail::class);
    }
}
