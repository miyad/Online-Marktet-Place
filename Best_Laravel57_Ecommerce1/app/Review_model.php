<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review_model extends Model
{
    protected $table='reviews';
    protected $primaryKey='id';
    protected $fillable=['productid','name','eamil','description','rating'];
}
