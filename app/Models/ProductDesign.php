<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDesign extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_category_id',
        'product_name',
        'product_color_id',
        'product_version',
        'status',
    ];

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function productColor()
    {
        return $this->belongsTo(Color::class, 'product_color_id');
    }

    // ProductDesign model
    public function rawMaterials()
    {
        return $this->hasMany(ProductDesignUseRawMaterial::class);
    }

}
