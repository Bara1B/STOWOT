<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOpnameHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'stock_opname_id',
        'user_id',
        'field_name',
        'old_value',
        'new_value',
        'action',
    ];

    public function stockOpname()
    {
        return $this->belongsTo(StockOpname::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
