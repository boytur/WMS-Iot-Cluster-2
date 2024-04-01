<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RackTag extends Model
{
    use HasFactory;
    protected $table = 'wms_rack_tags';
    protected $primaryKey = "rack_tag_id";
    protected $fillable = [
        'tag_id',
        'rack_id',
    ];
}
