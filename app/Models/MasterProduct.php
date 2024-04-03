<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'wms_master_product_tags', 'mas_prod_id', 'tag_id');
    }

    public function get_tags_name($mas_prod_id)
    {
        $tags = self::select('wms_tags.tag_name')
        ->leftJoin('wms_master_product_tags', 'wms_master_products.mas_prod_id', '=', 'wms_master_product_tags.mas_prod_id')
        ->leftJoin('wms_tags', 'wms_master_product_tags.tag_id', '=', 'wms_tags.tag_id')
        ->where('wms_master_products.mas_prod_id', $mas_prod_id)
        ->get();

        return  $tags->toArray();
    }
}
