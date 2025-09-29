<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOpname extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'file_id',
        'location_system',
        'location_actual',
        'item_number',
        'description',
        'manufacturer',
        'lot_serial',
        'reference',
        'quantity_on_hand',
        'stok_fisik',
        'unit_of_measure',
        'expired_date',
        'keterangan',
        'location_actual_status',
        'location_actual_keterangan',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'expired_date' => 'date',
        'quantity_on_hand' => 'decimal:5',
        'stok_fisik' => 'decimal:5',
    ];

    public function file()
    {
        return $this->belongsTo(StockOpnameFile::class, 'file_id');
    }

    public function histories()
    {
        return $this->hasMany(StockOpnameHistory::class);
    }

    // Accessor untuk selisih dengan decimal
    public function getSelisihAttribute()
    {
        return $this->stok_fisik - $this->quantity_on_hand;
    }
}
