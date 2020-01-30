<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventsJoinMaintenance extends Model
{
    protected $table ='eventsjoinmaintenance';
    protected $fillable = [
        'eventId','maintenanceId'
    ];
}
