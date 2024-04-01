<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Space extends Model
{
    use HasFactory;
    protected $table = 'wms_spaces';
    protected $primaryKey = "space_id";
    protected $fillable = [
        'space_name',
        'space_capacity',
        'rack_id',
    ];

    public function racks()
    {
        return $this->belongsTo(Rack::class, 'rack_id', 'rack_id');
    }
}
