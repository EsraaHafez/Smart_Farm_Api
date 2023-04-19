<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HarvestofCrops extends Model
{
    use HasFactory;
    protected $table = 'grow';
    public $incrementing = false;

   protected $fillable = [

        'id',
        'Harvest_id',
        'Crops_Name'

    ];
}
