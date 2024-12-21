<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    use HasFactory;
    protected $fillable = [
        'production_design_id',
        'batch_id',
        'brand_id',
        'unit_price',
        'production_qty',
        'production_status',
        'warehouse_id',
    ];
}
