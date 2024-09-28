<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bhavcopy extends Model
{
    use HasFactory;
    protected $fillable = [
        'symbol_id',
        'series',
        'date1',
        'prev_close',
        'open_price',
        'high_price',
        'low_price',
        'last_price',
        'close_price',
        'avg_price',
        'ttl_trd_qnty',
        'turnover_lacs',
        'no_of_trades',
        'deliv_qty',
        'deliv_per',
    ];

    // Define relationship
    public function symbol()
    {
        return $this->belongsTo(Symbol::class);
    }
}
