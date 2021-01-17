<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bandwidth extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bandwidth_network_intf', 'bandwidth_dl_speed', 'bandwidth_up_speed',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'bandwidth_dateTime' => 'datetime',
    ];


    /**
     *  The table associated with the model.
     * 
     *  @var string
     */
    protected $table = "network_bandwidth";
}
