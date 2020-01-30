<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workplace extends Model
{
    protected $table ='workplace';
    protected $fillable = [
        'workplaceName','defaultDate','minTime','maxTime','weekends','defaultView'
    ];
    protected $primaryKey = 'id';
}
