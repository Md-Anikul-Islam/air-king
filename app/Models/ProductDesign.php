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
}
