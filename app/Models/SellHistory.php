<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'sell_production_id',
        'payment',
        'due',
    ];

    public function sellProduction()
    {
        return $this->hasOne(SellProduction::class, 'id', 'sell_production_id');
    }

    public function sellProductions()
    {
        return $this->belongsTo(SellProduction::class, 'sell_production_id', 'id');
    }





}
