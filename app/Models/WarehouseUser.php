<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseUser extends Model
{
    use HasFactory;
    protected $table = 'wms_warehouse_users';

    protected $fillable = [
        'wh_id',
        'user_id',
    ];
}
