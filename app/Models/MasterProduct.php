<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterProduct extends Model
{
    use HasFactory;
    protected $table = 'wms_master_products';
    protected $fillable = [
        'mas_prod_no',
        'mas_prod_barcode',
        'mas_prod_name',
        'mas_prod_image',
        'mas_prod_size',
        'cat_id',
    ];

    public function categories()
    {
        return $this->belongsTo(Category::class, 'cat_id', 'cat_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'wms_master_product_tags', 'mas_prod_id	','mas_tag_id');
    }
}
