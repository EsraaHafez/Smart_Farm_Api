<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    protected $table = 'disease';
    protected $primaryKey = 'Disease_id';

    use HasFactory;

    protected $fillable = [


        'Name'


    ];
}
