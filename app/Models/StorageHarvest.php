<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StorageHarvest extends Model
{
    use HasFactory;
    protected $table = 'contain';
    public $incrementing = false;


    protected $fillable = [
        'id',
        'Harvest_id',
        'Storge_id'

    ];
}
