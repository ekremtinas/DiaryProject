<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $table ='maintenance';
    protected $fillable = [
        'maintenanceTitle','maintenanceMinute'
    ];
    protected $primaryKey = 'id';
}
