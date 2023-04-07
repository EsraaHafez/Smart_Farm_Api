<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farmer extends Model
{
    use HasFactory;
    protected $table = 'farmer';
    protected $primaryKey = 'Farmer_id';


    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'Address',
        'Harvest_id',
        'Actor_Name',


    ];
}
