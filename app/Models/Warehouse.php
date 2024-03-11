<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;
    protected $table = 'warehouses';
    protected $primaryKey = "wh_id";

    protected $fillable = [
        'wh_name',
        'wh_location',
    ];
}
