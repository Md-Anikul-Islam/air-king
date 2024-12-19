<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WareHouse extends Model
{
    use HasFactory;
    protected $fillable = [
        'block_id',
        'unit_id',
        'name',
        'is_already_booked',
        'cost',
        'status',
    ];

    public function block()
    {
        return $this->hasOne(Block::class, 'id', 'block_id');
    }

    public function unit()
    {
        return $this->hasOne(Unit::class, 'id', 'unit_id');
    }
}
