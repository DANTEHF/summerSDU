<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Active_device extends Model
{
    protected $table='active_device';
    protected $primaryKey = "id";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'app_key','1_4s', '5_10s', '11_30s','31_60s','1_3m', '4_10m', '11_30m', '31_60m','60_m','datetime',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id','app_key','created_at','updated_at',
    ];
    public $timestamps =true;
}
