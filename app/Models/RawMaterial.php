<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawMaterial extends Model
{
    use HasFactory;
    protected $fillable = [
        'raw_material_section_id',
        'raw_material_supplier_id',
        'raw_material_name',
        'raw_material_unit',
        'raw_material_code',
        'raw_material_price',
        'raw_material_qty',
        'status',
    ];

    public function rawMaterialSection()
    {
        return $this->belongsTo(RawMaterialSection::class, 'raw_material_section_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'raw_material_supplier_id');
    }
}
