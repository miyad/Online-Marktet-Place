<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shopowner_model extends Model
{
    protected $table='shopowners';
    protected $primaryKey='shopownerid';
    protected $fillable = [
        'name', 'email', 'password','address','city','country','mobile'
    ];
}
