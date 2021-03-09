<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop_model extends Model
{
    protected $table='shops';
    protected $primaryKey='id';
    protected $fillable=['shopid','area','price','shopownerid','shop_name','description','isrent','bookedstatus','rentdate','expireddate','floor'];

}
