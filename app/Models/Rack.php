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
        return $this->belongsToMany(Tag::class, 'rack_tags', 'rack_id','rack_tag_id');
    }

}
