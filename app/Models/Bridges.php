<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bridges extends Model
{
    protected $table ='bridges';
    protected $fillable = [
        'bridge_name'
    ];
    protected $primaryKey = 'id';
}
