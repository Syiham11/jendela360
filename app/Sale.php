<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'nm_pembeli','email','tlp','car_id'
    ];
}
