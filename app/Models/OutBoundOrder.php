<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutBoundOrder extends Model
{
    use HasFactory;
    protected $table = 'wms_outbound_orders';

    protected $fillable = [
        'outbound_amount',
        'outbound_status',
        'outbound_exp',
        'mas_prod_id',
        'lot_out_id',
    ];

    public function master_products()
    {
        return $this->belongsTo(MasterProduct::class, 'mas_prod_id', 'mas_prod_id');
    }

    public function lot_outs()
    {
        return $this->belongsTo(LotOut::class, 'lot_out_id', 'lot_out_id');
    }
}
