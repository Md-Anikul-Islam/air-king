<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RawMaterialSection extends Model
{
    use HasFactory , SoftDeletes;
    protected $fillable = [
        'name',
        'status',
    ];

    public function rawMaterial()
    {
        return $this->hasMany(RawMaterial::class, 'raw_material_section_id');
    }
}
