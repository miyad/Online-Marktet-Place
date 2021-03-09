<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deliveryman_model extends Model
{
    protected $table='deliveryman';
    protected $primaryKey='id';
    protected $fillable=['name','email','isavailable','mobile'];

}
