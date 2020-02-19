<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BridgeDateTime extends Model
{
    protected $table ='bridge_datetime';
    protected $fillable = [
        'start','end','bridge_id'
    ];
    protected $primaryKey = 'id';
}
