<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application_model extends Model
{
    protected $table='applications';
    protected $primaryKey='id';
    protected $fillable = [
        'name', 'email', 'address','city','country','mobile'
    ];
}
