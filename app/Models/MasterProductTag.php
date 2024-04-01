<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterProductTag extends Model
{
    use HasFactory;
    protected $table = 'wms_master_product_tags';
    protected $primaryKey = "mas_tag_id";
    protected $fillable = [
        'mas_tag_id',
        'tag_id',
        'mas_prod_id',
    ];
}
