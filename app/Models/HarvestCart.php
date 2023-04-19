<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HarvestCart extends Model
{
    use HasFactory;
    protected $table = 'add';
    public $incrementing = false;

   protected $fillable = [

        'id',
        'Cart_id',
        'Harvest_id'

    ];
}
