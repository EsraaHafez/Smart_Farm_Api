<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartStorge extends Model
{
    protected $table = 'contain2';
    //protected $primaryKey = 'Disease_id';
    public $incrementing = false;

    use HasFactory;

    protected $fillable = [


        'id' , 'Cart_id', 'Storge_id'


    ];
}
