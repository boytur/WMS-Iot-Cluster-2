<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnShelfProduct extends Model
{
    use HasFactory;
    protected $table = 'wms_onshelf_products';
    protected $primaryKey = "on_prod_id";

    protected $fillable = [
        'on_prod_amount',
        'on_prod_status',
        'on_prod_note',
        'space_id',
        'inbound_id',
    ];

    public function spaces()
    {
        return $this->belongsTo(Space::class, 'space_id', 'space_id');
    }

    public function inbound_orders()
    {
        return $this->belongsTo(InboundOrder::class, 'inbound_id', 'inbound_id');
    }
}
