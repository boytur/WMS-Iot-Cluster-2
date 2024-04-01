<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InboundOrder extends Model
{
    use HasFactory;
    protected $table = 'wms_inbound_orders';
    protected $fillable = [
        'inbound_amount',
        'inbound_status',
        'inbound_exp',
        'mas_prod_id',
        'lot_in_id',
    ];

    public function master_products()
    {
        return $this->belongsTo(MasterProduct::class, 'mas_prod_id', 'mas_prod_id');
    }

    public function lot_ins()
    {
        return $this->belongsTo(LotIn::class, 'lot_in_id', 'lot_in_id');
    }

}
