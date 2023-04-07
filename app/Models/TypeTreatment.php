<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeTreatment extends Model
{
    use HasFactory;
    protected $table = 'type_treatment';
    protected $primaryKey = 'Treatment_ID';


    protected $fillable = [
        'Name',
        'Farmer_id',
        'Disease_id',



    ];
}
