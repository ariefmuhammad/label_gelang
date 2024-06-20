<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderResep extends Model
{
    protected $connection = 'mysql3';
    protected $table = 'order_resep';
}
