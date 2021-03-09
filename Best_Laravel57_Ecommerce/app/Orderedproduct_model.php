<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderedproduct_model extends Model
{
    protected $table='orderedproduct';
    protected $primaryKey='id';
    protected $fillable=['order_id','products_id','product_name','product_code','product_color','size','price','quantity'];

}
