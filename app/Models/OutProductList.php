<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutProductList extends Model
{
    use HasFactory;
    protected $table = 'wms_out_product_lists';
    protected $primaryKey = "out_prod_list_id";

    protected $fillable = [
        'out_prod_list_amount',
        'on_prod_id',
        'outbound_id',
    ];

    public function onshelf_products()
    {
        return $this->belongsTo(OnshelfProduct::class, 'on_prod_id', 'on_prod_id');
    }

    public function outbound_orders()
    {
        return $this->belongsTo(OutboundOrder::class, 'outbound_id', 'outbound_id');
    }

}
