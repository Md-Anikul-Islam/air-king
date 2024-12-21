<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDesignUseRawMaterial extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_design_id',
        'raw_material_id',
        'quantity',
        'per_unit_price',
        'status',
    ];

    public function rawMaterial()
    {
        return $this->belongsTo(RawMaterial::class);
    }


}
