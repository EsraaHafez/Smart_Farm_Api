<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart';
    protected $primaryKey = 'Cart_id';


    protected $fillable = [
        'Name',
        'Image',
        'Quantity',
        'Total_Price',
        'id',


    ];
}
 