<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = [
        'block_id',
        'name',
        'status',
    ];

    public function block()
    {
        return $this->hasOne(Block::class, 'id', 'block_id');
    }
}
