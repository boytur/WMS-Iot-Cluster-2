<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LotOut extends Model
{
    use HasFactory;
    protected $table = 'wms_lot_outs';

    protected $fillable = [
        'lot_out_number',
        'lot_out_status',
        'wh_id',
        'user_id',
    ];
    public function warehouses()
    {
        return $this->belongsTo(Warehouse::class, 'wh_id', 'wh_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
