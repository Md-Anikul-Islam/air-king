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

    public function product_design()
    {
        return $this->belongsTo(ProductDesign::class, 'production_design_id');
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function warehouse()
    {
        return $this->belongsTo(WareHouse::class, 'warehouse_id');
    }
}
