<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CropsDisease extends Model
{
    use HasFactory;
    protected $table = 'crops_disease';


     protected $fillable = [
         'id' ,
         'Crops_Name',
         'Disease'



     ];
}
