<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rack extends Model
{
    use HasFactory;
    protected $table = 'wms_racks';
    protected $primaryKey = 'rack_id';

    protected $fillable = [
        'rack_name',
        'rack_height',
        'rack_width',
        'wh_id',
    ];

    public function warehouses()
    {
        return $this->belongsTo(Warehouse::class, 'wh_id', 'wh_id');
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'rack_tags', 'rack_id', 'rack_tag_id');
    }
    public function get_tags_name($rack_id)
    {
        $tags = self::select('wms_tags.tag_name')
            ->leftJoin('wms_rack_tags', 'wms_racks.rack_id', '=', 'wms_rack_tags.rack_id')
            ->leftJoin('wms_tags', 'wms_rack_tags.tag_id', '=', 'wms_tags.tag_id')
            ->where('wms_racks.rack_id', $rack_id)
            ->get();

        return $tags->toArray();
    }

}
