<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellProduction extends Model
{
    use HasFactory;
    protected $fillable = [
        'production_id',
        'customer_id',
        'sell_qty',
        'sell_date',
        'unit_price',
    ];
}
