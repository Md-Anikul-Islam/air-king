<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellProduction extends Model
{
    use HasFactory;
    protected $fillable = [
        'production_id',
        'customer_id',
        'sell_qty',
        'sell_date',
        'unit_price',
        'invoice_no',
    ];

    public function production()
    {
        return $this->belongsTo(Production::class, 'production_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function sellHistory()
    {
        return $this->hasMany(SellHistory::class, 'sell_production_id', 'id');
    }

}
